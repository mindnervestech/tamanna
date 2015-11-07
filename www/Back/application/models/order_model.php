<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to Cart Page
 * @author Teamtweaks
 *
 */
class Order_model extends My_Model
{
	
	public function add_order($dataArr=''){
			$this->db->insert(PRODUCT,$dataArr);
	}

	public function edit_order($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(PRODUCT,$dataArr);
	}
	
	
	public function view_order($condition=''){
			return $this->db->get_where(PRODUCT,$condition);
			
	}
	
	public function view_order_details($status){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,u.id as uid');
		$this->db->from(PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->where('p.status = "'.$status.'"');				
		$this->db->group_by("p.dealCodeNumber"); 
		$this->db->order_by("p.created", "desc"); 
		$PrdList = $this->db->get();
		
		//echo '<pre>'; print_r($PrdList->result()); die;
		return $PrdList;
	}

/*********************************************** Payment Success Cart********************************************************/	
	
	public function PaymentSuccess($userid='', $randomId='' ,$transId = '', $payerMail = ''){
		
	
		$paymtdata = array(
				'randomNo' => $randomId,
				'fc_session_user_id' => $userid,
		);
		$this->session->set_userdata($paymtdata);
		
		$conditionCheck = array( 'user_id' => $userid, 'dealCodeNumber' => $randomId, 'status' => 'Paid');
		$statusCheck = $this->order_model->get_all_details(PAYMENT,$conditionCheck);
		
		if($statusCheck->num_rows() == 0){

			$CoupRes = $this->order_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid, 'couponID >' => 0));
		
			$couponID = $CoupRes->row()->couponID;
			$couponAmont = $CoupRes->row()->discountAmount;
			$couponType = $CoupRes->row()->coupontype;		
	
			// Update Coupon
			if($couponID != 0) {
			if($couponType == 'Gift'){
				$SelGift = $this->order_model->get_all_details(GIFTCARDS,array( 'id' => $couponID));
				$GiftCountValue = $SelGift->row()->used_amount + $couponAmont;
				$condition = array( 'id' => $couponID);
				$dataArr = array('used_amount' => $GiftCountValue);
				$this->order_model->update_details(GIFTCARDS,$dataArr,$condition);
				if($SelGift->row()->price_value <= $GiftCountValue ){
					
					$condition1 = array( 'id' => $couponID);
					$dataArr1 = array('card_status' => 'redeemed');
					$this->order_model->update_details(GIFTCARDS,$dataArr1,$condition1);
				}
			
			}else{
				$SelCoup = $this->order_model->get_all_details(COUPONCARDS,array( 'id' => $couponID));
				$CountValue = $SelCoup->row()->purchase_count + 1;
				$condition = array( 'id' => $couponID);
				$dataArr = array('purchase_count' => $CountValue);
				$this->order_model->update_details(COUPONCARDS,$dataArr,$condition);
			}
		}
			
			//Update Payment Table	
			$condition1 = array( 'user_id' => $userid, 'dealCodeNumber' => $randomId);
			if($payerMail != ''){
				$dataArr1 = array('status' => 'Paid','shipping_status' => 'Processed', 'paypal_transaction_id' => $transId, 'payer_email' => $payerMail,'payment_type' => 'Paypal');			
			}else{
			
				$dataArr1 = array('status' => 'Paid','shipping_status' => 'Processed', 'paypal_transaction_id' => $transId, 'payment_type' => 'Credit Cart' );
			}
			
			$this->order_model->update_details(PAYMENT,$dataArr1,$condition1);
			

			//Update Quantity
			$SelQty = $this->order_model->get_all_details(PAYMENT,array( 'user_id' => $userid, 'dealCodeNumber' => $randomId));

			foreach($SelQty->result() as $updPrdRow){
			
				$SelPrd = $this->order_model->get_all_details(PRODUCT,array( 'id' => $updPrdRow->product_id ));
				$PrdCount = $SelPrd->row()->purchasedCount + $updPrdRow->quantity;
				$productCount = $SelPrd->row()->quantity - $updPrdRow->quantity;
				$condition2 = array( 'id' => $updPrdRow->product_id );
				$dataArr2 = array('purchasedCount' => $PrdCount,'quantity'=>$productCount);
				$this->order_model->update_details(PRODUCT,$dataArr2,$condition2);
			}
			
			
			//Send Mail to User
			
			$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.image,pd.id as PrdID,pAr.attr_name as attr_type,sp.attr_name');
			$this->db->from(PAYMENT.' as p');
			$this->db->join(USERS.' as u' , 'p.user_id = u.id');
			$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
			$this->db->join(SUBPRODUCT.' as sp' , 'sp.pid = p.attribute_values','left');
			$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = sp.attr_id','left');
			$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
			$PrdList = $this->db->get();
		
			$this->db->select('p.sell_id,u.email');
			$this->db->from(PAYMENT.' as p');
			$this->db->join(USERS.' as u' , 'p.sell_id = u.id');
			$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
			$this->db->group_by("p.sell_id"); 	
			$SellList = $this->db->get();
		
			$this->SendMailUSers($PrdList,$SellList);
				
		
			//Empty Cart Info
			$condition3 = array('user_id' => $userid);
			$this->order_model->commonDelete(SHOPPING_CART,$condition3);
		}
		
		$paymtdata = array(	'randomNo' => '');
		$this->session->set_userdata($paymtdata);	
		echo 'Success';
	}

	
	/********************************************** Payment Gift Success ****************************************************/
	
	public function PaymentGiftSuccess($userid='' ,$transId = '', $payerMail = ''){
		
	
		$paymtdata = array(
				'fc_session_user_id' => $userid,
		);
		
		$this->session->set_userdata($paymtdata);
		$GiftTemp = $this->order_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));
		
		if($GiftTemp->num_rows() > 0){
		
		foreach($GiftTemp->result() as $GiftRows){
		
			
			$dataArr = array();
			foreach($GiftRows as $key => $val){
				if(!(in_array($key,'id'))){
					$dataArr[$key] = trim(addslashes($val));
				}
			}
			$condition ='';
			$this->order_model->simple_insert(GIFTCARDS,$dataArr);
		}
		
		
			$condition1 = array( 'user_id' => $userid,'payment_status' => 'Pending');
			if($payerMail != ''){
				$dataArr1 = array('payment_status' => 'Paid', 'paypal_transaction_id' => $transId, 'payer_email' => $payerMail,'payment_type' => 'Paypal');			
			}else{
			
				$dataArr1 = array('payment_status' => 'Paid', 'paypal_transaction_id' => $transId, 'payment_type' => 'Credit Cart' );
			}
			
			$this->order_model->update_details(GIFTCARDS,$dataArr1,$condition1);
		
		//Send Mail to User
			$GiftTempVal = $this->order_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));
			$this->SendMailUSersGift($GiftTempVal);
				
		//Empty Gift cart Temp Info
			$condition3 = array('user_id' => $userid);
			$this->order_model->commonDelete(GIFTCARDS_TEMP,$condition3);
		}
			
		echo 'Success';
	}
	
	
	/********************************************** Payment Subscribe Success ****************************************************/
	
	public function PaymentSubscribeSuccess($userid='' ,$transId = ''){
		
	
		$paymtdata = array(
				'fc_session_user_id' => $userid,
		);
		
		$this->session->set_userdata($paymtdata);
		
		$FancyboxTemp = $this->order_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));
	
		
		foreach($FancyboxTemp->result() as $FancyboxRow){
		
			
			$dataArr = array();
			foreach($FancyboxRow as $key => $val){
				if($key !='id'){
					$dataArr[$key] = trim(addslashes($val));
				}
			}
			$condition ='';
			$this->order_model->simple_insert(FANCYYBOX_USES,$dataArr);
		}
		
		
			$condition1 = array( 'user_id' => $userid);
			$dataArr1 = array('status' => 'Paid', 'trans_id' => $transId, 'payment_type' => 'Credit Cart' );
			
			$this->order_model->update_details(FANCYYBOX_USES,$dataArr1,$condition1);
			
		//Update Quantity
			foreach($FancyboxTemp->result() as $updPrdRow){
			
				$SelPrd = $this->order_model->get_all_details(FANCYYBOX,array( 'id' => $updPrdRow->fancybox_id ));
				$PrdCount = $SelPrd->row()->purchased + $updPrdRow->quantity;
				$condition2 = array( 'id' => $updPrdRow->fancybox_id );
				$dataArr2 = array('purchased' => $PrdCount);
				$this->order_model->update_details(FANCYYBOX,$dataArr2,$condition2);
			}
			
		
		//Send Mail to User
		
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city');
		$this->db->from(FANCYYBOX_USES.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->where('p.user_id = "'.$userid.'" and p.status="Paid"');
		$SubcribTempVal = $this->db->get();
		
		$this->SendMailUSersSubscribe($SubcribTempVal);
		
		//Empty Gift cart Temp Info
			$condition3 = array('user_id' => $userid);
			$this->order_model->commonDelete(FANCYYBOX_TEMP,$condition3);
			
		echo 'Success';
	}
	
	/********************************************** Send Mail to User***********************************************/
	public function SendMailUSers($PrdList,$SellList){
	
	//echo '<pre>';print_r($SellList->result()); die;
	
	$shipAddRess = $this->get_all_details(SHIPPING_ADDRESS,array( 'id' => $PrdList->row()->shippingid ));
	
	$newsid='19';
		$template_values=$this->get_newsletter_template_details($newsid);
		$adminnewstemplateArr=array(
			'logo'=> $this->data['logo'],
			'meta_title'=>$this->config->item('meta_title'),
			'ship_fullname'=>stripslashes($shipAddRess->row()->full_name),
			'ship_address1'=>stripslashes($shipAddRess->row()->address1),
			'ship_address2'=>stripslashes($shipAddRess->row()->address2),
			'ship_city'=>stripslashes($shipAddRess->row()->city),
			'ship_country'=>stripslashes($shipAddRess->row()->country),
			'ship_state'=>stripslashes($shipAddRess->row()->state),
			'ship_postalcode'=>stripslashes($shipAddRess->row()->postal_code),
			'ship_phone'=>stripslashes($shipAddRess->row()->phone),
			'bill_fullname'=>stripslashes($PrdList->row()->full_name),
			'bill_address1'=>stripslashes($PrdList->row()->address),
			'bill_address2'=>stripslashes($PrdList->row()->address2),
			'bill_city'=>stripslashes($PrdList->row()->city),
			'bill_country'=>stripslashes($PrdList->row()->country),
			'bill_state'=>stripslashes($PrdList->row()->state),
			'bill_postalcode'=>stripslashes($PrdList->row()->postal_code),
			'bill_phone'=>stripslashes($PrdList->row()->phone_no),
			'invoice_number'=>$PrdList->row()->dealCodeNumber,
			'invoice_date'=>date("F j, Y g:i a",strtotime($PrdList->row()->created))
		);
		extract($adminnewstemplateArr);
		$subject = $template_values['news_subject'];
		$message1 = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/></head>
<title>'.$template_values['news_subject'].'</title>
<body>

';
		include('./newsletter/registeration'.$newsid.'.php');

			$message = stripslashes(substr($message,0,strrpos($message,'</tbody>')));
			$message = stripslashes(substr($message,0,strrpos($message,'</tbody>')));
			$message1 .= $message;	   
			
$disTotal =0; $grantTotal = 0;
foreach ($PrdList->result() as $cartRow) { $InvImg = @explode(',',$cartRow->image); 
$unitPrice = ($cartRow->price*(0.01*$cartRow->product_tax_cost))+$cartRow->product_shipping_cost+$cartRow->price; 
$uTot = $unitPrice*$cartRow->quantity;
if($cartRow->attr_name != '' || $cartRow->attr_type != ''){ $atr = '<br>'.$cartRow->attr_type.' / '.$cartRow->attr_name; }else{ $atr = '';}
$message1.='<tr>
            <td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="'.base_url().PRODUCTPATH.$InvImg[0].'" alt="'.stripslashes($cartRow->product_name).'" width="70" /></span></td>
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->product_name).$atr.'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.strtoupper($cartRow->quantity).'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($unitPrice,2,'.','').'</span></td>
            <td style="text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($uTot,2,'.','').'</span></td>
        </tr>';
	$grantTotal = $grantTotal + $uTot;
}
	$private_total = $grantTotal - $PrdList->row()->discountAmount;
	$private_total = $private_total + $PrdList->row()->tax  + $PrdList->row()->shippingcost;
				 
$message1.='</table></td> </tr><tr><td colspan="3"><table border="0" cellspacing="0" cellpadding="0" style=" margin:10px 0px; width:99.5%;"><tr>
			<td width="460" valign="top" >';
			if($PrdList->row()->note !=''){
$message1.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"><tr>
                <td width="87" ><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Note:</span></td>
               
            </tr>
			<tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">'.stripslashes($PrdList->row()->note).'</span></td>
            </tr></table>';
			}
			
			if($PrdList->row()->order_gift == 1){
$message1.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"  style="margin-top:10px;"><tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:16px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">This Order is a gift</span></td>
            </tr></table>';
			}
			
$message1.='</td>
            <td width="174" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
            <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Sub Total</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($grantTotal,'2','.','').'</span></td>
            </tr>
			<tr>
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Discount Amount</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->discountAmount,'2','.','').'</span></td>
            </tr>
		<tr bgcolor="#f3f3f3">
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Cost</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->shippingcost,2,'.','').'</span></td>
              </tr>
			  <tr>
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Tax</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->tax ,2,'.','').'</span></td>
              </tr>
			  <tr bgcolor="#f3f3f3">
                <td width="87" style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Grand Total</span></td>
                <td width="31"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($private_total,'2','.','').'</span></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        </tr>
    </table>
        </div>
        
        <!--end of left--> 
		<div style="width:50%; float:left;">
            	<div style="float:left; width:100%;font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; width:100%; color:#000000; line-height:38px; "><span>'.stripslashes($PrdList->row()->full_name).'</span>, thank you for your purchase.</div>
               <ul style="width:100%; margin:10px 0px 0px 0px; padding:0; list-style:none; float:left; font-size:12px; font-weight:normal; line-height:19px; font-family:Arial, Helvetica, sans-serif; color:#000;">
                    <li>If you have any concerns please contact us.</li>
                    <li>Email: <span>'.stripslashes($this->data['siteContactMail']).' </span></li>
                    <li>Phone: +91 7304 22 44 88</li>
               </ul>
        	</div>
            
            <div style="width:27.4%; margin-right:5px; float:right;">
            
           
            </div>
        
        <div style="clear:both"></div>
        
    </div>
    </div></body></html>';	
		//echo $message;
		//echo '<br>'.$PrdList->row()->email;

		
		if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->config->item('site_contact_mail');
			$sender_name=$this->config->item('email_title');
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		}

		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$PrdList->row()->email,
							'cc_mail_id'=>$this->config->item('site_contact_mail'),
							'subject_message'=>$subject,
							'body_messages'=>$message1
							);
		$email_send_to_common = $this->common_email_send($email_values);
		
		
		
		
		//echo $this->email->print_debugger(); die; 
		
		/**********************************************seller Product Confirmation Mail Sent ************************************************/
		
		foreach($SellList->result() as $sellRow){
		
		//echo '<pre>';print_r($sellRow->email);
		$message2 = '';
		$subject2 = $template_values['news_subject'];
		$message2 .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/></head>
<title>'.$template_values['news_subject'].'</title>
<body>

';
			$message2 .= $message;   
			
$disTotal =0; $grantTotal = 0;
foreach ($PrdList->result() as $cartRow) { 
if($cartRow->sell_id == $sellRow->sell_id ){

$InvImg = @explode(',',$cartRow->image); 
$unitPrice = ($cartRow->price*(0.01*$cartRow->product_tax_cost))+$cartRow->product_shipping_cost+$cartRow->price; 
$uTot = $unitPrice*$cartRow->quantity;
if($cartRow->attr_name != '' || $cartRow->attr_type != ''){ $atr = '<br>'.$cartRow->attr_type.' / '.$cartRow->attr_name; }else{ $atr = '';}
$message2.='<tr>
            <td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="'.base_url().PRODUCTPATH.$InvImg[0].'" alt="'.stripslashes($cartRow->product_name).'" width="70" /></span></td>
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->product_name).$atr.'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.strtoupper($cartRow->quantity).'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($unitPrice,2,'.','').'</span></td>
            <td style="text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($uTot,2,'.','').'</span></td>
        </tr>';
	$grantTotal = $grantTotal + $uTot;
} }
				 
$message2.='</table></td> </tr><tr><td colspan="3"><table border="0" cellspacing="0" cellpadding="0" style=" margin:10px 0px; width:99.5%;"><tr>
			<td width="460" valign="top" >';
			if($PrdList->row()->note !=''){
$message2.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"><tr>
                <td width="87" ><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Note:</span></td>
               
            </tr>
			<tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">'.stripslashes($PrdList->row()->note).'</span></td>
            </tr></table>';
			}
			
			if($PrdList->row()->order_gift == 1){
$message2.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"  style="margin-top:10px;"><tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:16px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">This Order is a gift</span></td>
            </tr></table>';
			}
			
$message2.='</td>
            <td width="174" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
             <tr bgcolor="#f3f3f3">
                <td width="87" style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Grand Total</span></td>
                <td width="31"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($grantTotal,'2','.','').'</span></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        </tr>
    </table>
        </div>
        
        <!--end of left--> 
		<div style="width:50%; float:left;">
            	<div style="float:left; width:100%;font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; width:100%; color:#000000; line-height:38px; "><span>'.stripslashes($PrdList->row()->full_name).'</span>, thank you for your purchase.</div>
               <ul style="width:100%; margin:10px 0px 0px 0px; padding:0; list-style:none; float:left; font-size:12px; font-weight:normal; line-height:19px; font-family:Arial, Helvetica, sans-serif; color:#000;">
                    <li>If you have any concerns please contact us.</li>
                    <li>Email: <span>'.stripslashes($this->data['siteContactMail']).' </span></li>
                    <li>Phone: +91 7304 22 44 88</li>
               </ul>
        	</div>
            
            <div style="width:27.4%; margin-right:5px; float:right;">
            
           
            </div>
        
        <div style="clear:both"></div>
        
    </div>
    </div></body></html>';	
	
		$email_values1 = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$sellRow->email,
							'cc_mail_id'=>$this->config->item('site_contact_mail'),
							'subject_message'=>$subject2,
							'body_messages'=>$message2
							);
						
		$email_send_to_common = $this->product_model->common_email_send($email_values1);
		
	}

	
		return;
	}

	/********************************************** Send Mail to Gift***********************************************/	
	public function SendMailUSersGift($GiftRowsVals){

		//echo '<pre>';print_r($GiftRowsVals);	
	foreach($GiftRowsVals->result() as $GiftVals){
	

	
		$newsid='15';
		$template_values=$this->order_model->get_newsletter_template_details($newsid);
		$usrDetails = $this->order_model->get_all_details(USERS,array( 'id' => $GiftVals->user_id ));
		$adminnewstemplateArr=array(
		'email_title'=> $this->config->item('email_title'),
		'logo'=> $this->data['logo'],
		'meta_title'=>$this->config->item('meta_title'),
		'full_name'=>stripslashes($usrDetails->row()->full_name),
		'email'=>stripslashes($usrDetails->row()->email),
		'code'=>stripslashes($GiftVals->code),
		'price_value'=>stripslashes($GiftVals->price_value),
		'expiry_date'=>stripslashes($GiftVals->expiry_date),
		'description'=>stripslashes($GiftVals->description),
		'rname'=>stripslashes($GiftVals->recipient_name)
		);
		extract($adminnewstemplateArr);
		$subject = $template_values['news_subject'];
	
	
		$message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>Gift Card</title>
			</head>
			<body>';
		include('./newsletter/registeration'.$newsid.'.php');	
			$message .= '</body>
			</html>';
		
	if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->config->item('site_contact_mail');
			$sender_name=$this->config->item('email_title');
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		}
		
	$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$GiftVals->recipient_mail,
							'cc_mail_id'=>$this->config->item('site_contact_mail'),
							'subject_message'=>$subject,
							'body_messages'=>$message
							);
		$email_send_to_common = $this->product_model->common_email_send($email_values);
		
		
		
		
	}	
		//echo $this->email->print_debugger(); die; 
		return;
	
	}
	
	/********************************************** Send Mail to Subscribe***********************************************/	
	public function SendMailUSersSubscribe($PrdList){

		$subject = 'From: '.$this->config->item('email_title').' Subscription';

		$message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>Gift Card</title>
			</head>
			<body marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
			<table width="640" border="0" cellspacing="0" cellpadding="0" bgcolor="#7da2c1">
			<tr>
			<td style="padding:40px;">
			<table width="610" border="0" cellpadding="0" cellspacing="0" style="border:#1d4567 1px solid; font-family:Arial, Helvetica, sans-serif;">
				<tr>
				<td>
				<a href="'.base_url().'"><img src="'.base_url().'images/logo/'.$this->data['logo'].'" alt="'.$this->config->item('meta_title').'" style="margin:15px 5px 0; padding:0px; border:none;"></a>
				</td>
				</tr>
				<tr>
				<td valign="top" style="background-color:#FFFFFF;">
				<table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
					<tr>
					<td colspan="2">
					<h3 style="padding:10px 15px; margin:0px; color:#0d487a;">Subscription for '.ucfirst($this->config->item('email_title')).'</h3>
					</td>
					</tr>
				</table>';
               
				
                $message.= '<table width="611" border="0" cellpadding="0" cellspacing="0"><tr>
                		    <th width="37%" align="left">Product Title</th>
		                    <th width="30%">Quantity</th>
        		            <th width="33%">Amount</th>
                			</tr>';
                $grantTotal = 0;
                foreach ($PrdList->result() as $cartRow) { 

                $message.= '
                <tr style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#292881; padding: 0px 4px 0px 5px;">
                  <td width="38%">'.stripslashes($cartRow->name).'</td>
                  <td width="23%" align="center">'.strtoupper($cartRow->quantity).'</td>
                  <td width="28%" align="center">'.$this->data['currencySymbol'].$cartRow->indtotal.'</td>
                </tr>
                ';
                	$grantTotal = $grantTotal + $cartRow->indtotal;
                }
                $private_total = $grantTotal;
                $private_total = $private_total + ($private_total * $cartRow->tax * 0.01) + $PrdList->row()->shippingcost;
                $message.='
                <tr>
                  <td>&nbsp;</td>
                </tr>
                ';

                $message.='
                <tr>
                  <td width="30%">&nbsp;</td>
                  <td width="30%" style="font-size:14px; font-weight:bold; color:#000000;"  > Subscription Date</td>
                  <td width="40%" align="left" style="font-size:12px; font-weight:bold; color:#000000;">'.date("F j, Y, g:i a",strtotime($PrdList->row()->created)).'</td>
                </tr>';
				
				$shipAddRess = $this->order_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $PrdList->row()->shippingid ));
				

                $message.='<tr>
                  <td width="30%">&nbsp;</td>
                  <td width="30%" style="font-size:14px; font-weight:bold; color:#000000;" > Tax</td>
                  <td width="40%" align="left" style="font-size:12px; font-weight:bold; color:#000000;">$ '.$PrdList->row()->tax.' </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td width="20%" style="font-size:14px; font-weight:bold; color:#000000;" > Total </td>
                  <td width="28%" align="left" style="font-size:18px; font-weight:bold; color:#000000;">$ '.number_format($private_total+$tax, 2, '.', ' ').'</td>
                </tr>
				</table>
				
<div style="display:inline-block; float:left; width:100%; font-size:12px;">
	<div style="display:inline-block; float:left; width:50%;">

	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr style="border:1px solid #7DA2C1;">
                      <td style=" font:bold 14px/34px Arial, Helvetica, sans-serif;	color:#000;	background:#7DA2C1; border-bottom:1px solid #b6b3b3;">Billing Details</td>
                    </tr>
                  </table>
               
               
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-left:15px; font-family:Verdana, Arial, Helvetica, sans-serif;">
                    <tr>
                      <td width="100" style="color:#000000;"><strong>Full name </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($PrdList->row()->full_name).'</td>
                    </tr>
                   
                    <tr>
                      <td style="color:#000000;"><strong>Address</strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($PrdList->row()->address).'</td>
                    </tr>
                   
                    <tr>
                      <td style="color:#000000;"><strong>Country</strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($PrdList->row()->country).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>State</strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($PrdList->row()->state).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>City </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($PrdList->row()->city).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>postal code </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($PrdList->row()->postal_code).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>Phone </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($PrdList->row()->phone_no).'</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><b>Support Team</b></td>
                    </tr>
                    <tr>
                      <td style="font-size:16px; font-weight:bold; color:#935435;"><strong> '.$this->config->item('email_title').' Team</strong></td>
                    </tr>
                  </table>
</div>
<div style="display:inline-block; float:left; width:50%;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr style="border:1px solid #b6b3b3;">
                      <td style=" font:bold 14px/34px Arial, Helvetica, sans-serif;	color:#000;	background:#7DA2C1; border-bottom:1px solid #b6b3b3;">Shipping Details</td>
                    </tr>
                  </table>
               
               
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-left:15px; font-family:Verdana, Arial, Helvetica, sans-serif;">
                    <tr>
                      <td width="120" style="color:#000000;"><strong>Full name </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($shipAddRess->row()->full_name).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>Address</strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($shipAddRess->row()->address1).'</td>
                    </tr>
                   
                    <tr>
                      <td style="color:#000000;"><strong>Country</strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($shipAddRess->row()->country).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>State/province </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($shipAddRess->row()->state).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>City </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($shipAddRess->row()->city).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>Zip/postal code </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($shipAddRess->row()->postal_code).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>Phone </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($shipAddRess->row()->phone).'</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
</div>
</div>
         </div>				
				
					<table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">	
							<tr>
								<td width="50%" valign="top" style="font-size:12px; padding:10px 15px;">
									
								</td>
								<td width="50%" valign="top" style="font-size:12px; padding:10px 15px;">
									<p>
										
									</p>
									<p>
										
									</p>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
			</body>
			</html>';
		echo $message;
		
		
		
		
		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$this->config->item('site_contact_mail'),
							'mail_name'=>$this->config->item('email_title'),
							'to_mail_id'=>$PrdList->row()->email,
							'cc_mail_id'=>$this->config->item('site_contact_mail'),
							'subject_message'=>$subject,
							'body_messages'=>$message
							);
		$email_send_to_common = $this->product_model->common_email_send($email_values);
		
		
	
		return;
	
	}
	
	/********************************************** View Orders ***********************************************/
	
	public function view_orders($userid,$randomId){
	
	$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.image,pd.id as PrdID,pAr.attr_name as attr_type,sp.attr_name');
		$this->db->from(PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->join(SUBPRODUCT.' as sp' , 'sp.pid = p.attribute_values','left');				
		$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = sp.attr_id','left');				
		$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
		$PrdList = $this->db->get();
	
	$shipAddRess = $this->order_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $PrdList->row()->shippingid ));
	
	
	$newsid='19';
		$template_values=$this->get_newsletter_template_details($newsid);
		$adminnewstemplateArr=array(
			'logo'=> $this->data['logo'],
			'meta_title'=>$this->config->item('meta_title'),
			'ship_fullname'=>stripslashes($shipAddRess->row()->full_name),
			'ship_address1'=>stripslashes($shipAddRess->row()->address1),
			'ship_address2'=>stripslashes($shipAddRess->row()->address2),
			'ship_city'=>stripslashes($shipAddRess->row()->city),
			'ship_country'=>stripslashes($shipAddRess->row()->country),
			'ship_state'=>stripslashes($shipAddRess->row()->state),
			'ship_postalcode'=>stripslashes($shipAddRess->row()->postal_code),
			'ship_phone'=>stripslashes($shipAddRess->row()->phone),
			'bill_fullname'=>stripslashes($PrdList->row()->full_name),
			'bill_address1'=>stripslashes($PrdList->row()->address),
			'bill_address2'=>stripslashes($PrdList->row()->address2),
			'bill_city'=>stripslashes($PrdList->row()->city),
			'bill_country'=>stripslashes($PrdList->row()->country),
			'bill_state'=>stripslashes($PrdList->row()->state),
			'bill_postalcode'=>stripslashes($PrdList->row()->postal_code),
			'bill_phone'=>stripslashes($PrdList->row()->phone_no),
			'invoice_number'=>$PrdList->row()->dealCodeNumber,
			'invoice_date'=>date("F j, Y g:i a",strtotime($PrdList->row()->created))
		);
		extract($adminnewstemplateArr);
		$subject = $template_values['news_subject'];
		$message1 .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/></head>
<title>'.$template_values['news_subject'].'</title>
<body>

';
		include('./newsletter/registeration'.$newsid.'.php');

			$message = stripslashes(substr($message,0,strrpos($message,'</tbody>')));
			$message = stripslashes(substr($message,0,strrpos($message,'</tbody>')));
			$message1 .= $message;
	
	
$disTotal =0; $grantTotal = 0;
foreach ($PrdList->result() as $cartRow) { $InvImg = @explode(',',$cartRow->image); 
$unitPrice = ($cartRow->price*(0.01*$cartRow->product_tax_cost))+$cartRow->product_shipping_cost+$cartRow->price; 
$uTot = $unitPrice*$cartRow->quantity;
if($cartRow->attr_name != '' || $cartRow->attr_type != ''){ $atr = '<br>'.$cartRow->attr_type.' / '.$cartRow->attr_name; }else{ $atr = '';}
$message1.='<tr>
            <td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="'.base_url().PRODUCTPATH.$InvImg[0].'" alt="'.stripslashes($cartRow->product_name).'" width="70" /></span></td>
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->product_name).$atr.'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.strtoupper($cartRow->quantity).'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($unitPrice,2,'.','').'</span></td>
            <td style="text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($uTot,2,'.','').'</span></td>
        </tr>';
	$grantTotal = $grantTotal + $uTot;
}
	$private_total = $grantTotal - $PrdList->row()->discountAmount;
	$private_total = $private_total + $PrdList->row()->tax  + $PrdList->row()->shippingcost;
				 
$message1.='</table></td> </tr><tr><td colspan="3"><table border="0" cellspacing="0" cellpadding="0" style=" margin:10px 0px; width:99.5%;"><tr>
			<td width="460" valign="top" >';
			if($PrdList->row()->note !=''){
$message1.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"><tr>
                <td width="87" ><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Note:</span></td>
               
            </tr>
			<tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">'.stripslashes($PrdList->row()->note).'</span></td>
            </tr></table>';
			}
			
			if($PrdList->row()->order_gift == 1){
$message1.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"  style="margin-top:10px;"><tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:16px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">This Order is a gift</span></td>
            </tr></table>';
			}
			
$message1.='</td>
            <td width="174" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
            <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Sub Total</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($grantTotal,'2','.','').'</span></td>
            </tr>
			<tr>
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Discount Amount</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->discountAmount,'2','.','').'</span></td>
            </tr>
		<tr bgcolor="#f3f3f3">
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Cost</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->shippingcost,2,'.','').'</span></td>
              </tr>
			  <tr>
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Tax</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->tax ,2,'.','').'</span></td>
              </tr>
			  <tr bgcolor="#f3f3f3">
                <td width="87" style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Grand Total</span></td>
                <td width="31"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($private_total,'2','.','').'</span></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        </tr>
    </table>
        </div>
        
        <!--end of left--> 
		<div style="width:50%; float:left;">
            	<div style="float:left; width:100%;font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; width:100%; color:#000000; line-height:38px; "><span>'.stripslashes($PrdList->row()->full_name).'</span>, thank you for your purchase.</div>
               <ul style="width:100%; margin:10px 0px 0px 0px; padding:0; list-style:none; float:left; font-size:12px; font-weight:normal; line-height:19px; font-family:Arial, Helvetica, sans-serif; color:#000;">
                    <li>If you have any concerns please contact us.</li>
                    <li>Email: <span>'.stripslashes($this->data['siteContactMail']).' </span></li>
                    <li>Phone: +91 7304 22 44 88</li>
               </ul>
        	</div>
            
            <div style="width:27.4%; margin-right:5px; float:right;">
            
           
            </div>
        
        <div style="clear:both"></div>
        
    </div>
    </div></body></html>';	
		return $message1;
	}

public function view_orders_new($userid,$randomId){
        
        $this->db->select('p.*,u.email,u.full_name,u.address,u.address2,u.phone_no,u.postal_code,u.state,u.country,u.city,u.s_tin_no,u.s_vat_no,u.s_cst_no,pd.product_name,pd.id as PrdID,pd.image,pd.seller_product_id,pd.sku,pAr.attr_name as attr_type,sp.attr_name');
		$this->db->from(PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.sell_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->join(SUBPRODUCT.' as sp' , 'sp.pid = p.attribute_values','left');
		$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = sp.attr_id','left');
		$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
	
		$PrdList = $this->db->get();
	
	
	$shipAddRess = $this->order_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $PrdList->row()->shippingid ));
		$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/></head>
<title>Product Order Confirmation</title>
<body>
<div style="width:1012px;background:#FFFFFF; margin:0 auto;font-size:12px;font-family: Arial, Helvetica, sans-serif;">
<center><h4 style="margin:0 auto;">RETAIL INVOICE</h4></center>
<div style="width:100%;background:#FFFFFF; border:1px solid #000; float:left; margin:0 auto;">
    <p style="margin:0px 0px 2px 5px;">Bought on : </p>
    <div style="float:left; width:30%;"><a href="'.base_url().'" target="_blank" id="logo"><img src="'.base_url().'images/logo/socktail-transparent.png" alt="'.$this->data['WebsiteTitle'].'" title="'.$this->data['WebsiteTitle'].'" style=" height:77px; margin: 0px 0px 2px 5px;"></a></div>
	<div style="float:left; width:70%;">
		<div style="width:360px; float:right;">
		<table>
        	<tr>
        		<td>Seller Name : </td>
        		<td>'.stripslashes($PrdList->row()->full_name).'</td>
        	</tr>
        	<tr>
        		<td>Invoice No. : </td>
        		<td>'.$PrdList->row()->dealCodeNumber.'</td>
        	</tr>
        	<tr>
        		<td>Invoice Date. : </td>
        		<td>'.date("F j, Y g:i a",strtotime($PrdList->row()->created)).'</td>
        	</tr>
        	<tr>
        		<td>TIN / VAT / CST No. :</td>
        		<td>'.stripslashes($PrdList->row()->s_tin_no).'/'.stripslashes($PrdList->row()->s_vat_no).'/'.stripslashes($PrdList->row()->s_cst_no).'</td>
        	</tr>
        	
    	</table>
		</div>
	</div>
</div>			
<!--END OF LOGO-->
    
 <!--start of deal-->
    <div style="width:972px;background:#FFFFFF;float:left; padding:20px; border:1px solid #454B56; ">
	<div style="float:left; width:100%; margin-bottom:20px; margin-right:7px;">
		<div style="float:left; width:49%; border:1px solid #cccccc;">
		<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.8%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#000305;">If Undelivered Return to :</span>
        <table style="width:100%; float:left;">
        	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($PrdList->row()->full_name).'</td></tr>
            <tr><td style="vertical-align: baseline;width: 100px;">Address</td><td style="vertical-align: baseline;">:</td><td>'.stripslashes($PrdList->row()->address).','.stripslashes($PrdList->row()->address2).','.stripslashes($PrdList->row()->city).','.stripslashes($PrdList->row()->state).','.stripslashes($PrdList->row()->postal_code).'</td></tr>
			<!--<tr><td>Address 2</td><td>:</td><td>'.stripslashes($PrdList->row()->address2).'</td></tr>
			<tr><td>City</td><td>:</td><td>'.stripslashes($PrdList->row()->city).'</td></tr>
			<tr><td>Country</td><td>:</td><td>'.stripslashes($PrdList->row()->country).'</td></tr>
			<tr><td>State</td><td>:</td><td>'.stripslashes($PrdList->row()->state).'</td></tr>
			<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($PrdList->row()->postal_code).'</td></tr>
			<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($PrdList->row()->phone_no).'</td></tr>-->
    	</table>
    	</div>
    	<div style="float:right; width:40%;">
		<table style="width:100%; border:1px solid #cecece; float:left;">
		  	<tr bgcolor="#f3f3f3">
            	<td width="100"  style="border-right:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Id</span></td>
	            <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">#'.$PrdList->row()->dealCodeNumber.'</span></td>
	        </tr>
	        <tr bgcolor="#f3f3f3">
                <td width="100"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Date</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.date("F j, Y g:i a",strtotime($PrdList->row()->created)).'</span></td>
            </tr>	 
        </table>
        </div>
    </div>
		
    <div style="float:left; width:100%;">
	
    <div style="width:49%; float:left; border:1px solid #cccccc; margin-right:10px;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.8%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#000305;">Shipping Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($shipAddRess->row()->full_name).'</td></tr>
                    <tr><td style="vertical-align: baseline;width: 100px;">Address</td><td style="vertical-align: baseline;">:</td><td>'.stripslashes($shipAddRess->row()->address1).', '.stripslashes($shipAddRess->row()->address2).', '.stripslashes($shipAddRess->row()->city).', '.stripslashes($shipAddRess->row()->state).', '.stripslashes($shipAddRess->row()->postal_code).', '.stripslashes($shipAddRess->row()->country).'</td></tr>
					<!--<tr><td>Address 2</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($shipAddRess->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($shipAddRess->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes($shipAddRess->row()->state).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($shipAddRess->row()->postal_code).'</td></tr> -->
					<tr><td style="vertical-align: baseline;">Phone Number</td><td>:</td><td>'.stripslashes($shipAddRess->row()->phone).'</td></tr>
            	</table>
            </div>
     </div>
    
    <div style="width:49%; float:left; border:1px solid #cccccc;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.7%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#000305;">From :</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($PrdList->row()->full_name).'</td></tr>
                    <tr><td style="vertical-align: baseline;width: 100px;">Address</td><td style="vertical-align: baseline;">:</td><td>'.stripslashes($PrdList->row()->address).','.stripslashes($PrdList->row()->address2).','.stripslashes($PrdList->row()->city).','.stripslashes($PrdList->row()->state).','.stripslashes($PrdList->row()->postal_code).','.stripslashes($PrdList->row()->country).'</td></tr>
					<!--<tr><td>Address 2</td><td>:</td><td>'.stripslashes($PrdList->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($PrdList->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($PrdList->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes($PrdList->row()->state).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($PrdList->row()->postal_code).'</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($PrdList->row()->phone_no).'</td></tr>-->
            	</table>
            </div>
    </div>
</div> 
	   
<div style="float:left; width:100%; margin-right:3%; margin-top:10px; font-size:12px; font-weight:normal; line-height:28px;  font-family:Arial, Helvetica, sans-serif; color:#000; overflow:hidden;">   
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    	<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece; width:99.5%;">
        <tr bgcolor="#f3f3f3">
        	<td width="16%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Image</span></td>
        	<td width="10%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product ID</span></td>
        	<td width="10%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">SKU Code</span></td>
            <td width="30%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Name</span></td>
            <td width="10%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Qty</span></td>
            <td width="12%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Unit Price</span></td>
            <td width="12%" style="text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Sub Total</span></td>
         </tr>';	   
			
$disTotal =0; $grantTotal = 0;
foreach ($PrdList->result() as $cartRow) { $InvImg = @explode(',',$cartRow->image);
$unitPrice = ($cartRow->price*(0.01*$cartRow->product_tax_cost))+$cartRow->product_shipping_cost+$cartRow->price; 
$uTot = $unitPrice*$cartRow->quantity;
if($cartRow->attr_name != '' || $cartRow->attr_type != ''){ $atr = '<br>'.$cartRow->attr_type.' / '.$cartRow->attr_name; }else{ $atr = '';}
$message.='<tr>
            <td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="'.base_url().PRODUCTPATH.$InvImg[0].'" alt="'.stripslashes($cartRow->product_name).'" width="70" /></span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->seller_product_id).'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->sku).'</span></td>
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->product_name).$atr.'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.strtoupper($cartRow->quantity).'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($unitPrice,2,'.','').'</span></td>
            <td style="text-align:center;border-top:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($uTot,2,'.','').'</span></td>
        </tr>';
	$grantTotal = $grantTotal + $uTot;
}
	$private_total = $grantTotal - $PrdList->row()->discountAmount;
	$private_total = $private_total + $PrdList->row()->tax  + $PrdList->row()->shippingcost;
				 
$message.='</table></td> </tr><tr><td colspan="3"><table border="0" cellspacing="0" cellpadding="0" style=" margin:10px 0px; width:99.5%;"><tr>
			<td width="460" valign="top" >';
			if($PrdList->row()->note !=''){
$message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"><tr>
                <td width="87" ><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Note:</span></td>
               
            </tr>
			<tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">'.stripslashes($PrdList->row()->note).'</span></td>
            </tr></table>';
			}

			
			if($PrdList->row()->order_gift == 1){
$message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"  style="margin-top:10px;"><tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:14px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">This Order is a gift</span></td>
            </tr></table>';
			}
			
$message.='</td>
            <td width="174" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
            <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Sub Total</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($grantTotal,'2','.','').'</span></td>
            </tr>
			<tr>
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Discount Amount</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->discountAmount,'2','.','').'</span></td>
            </tr>
		<tr bgcolor="#f3f3f3">
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Cost</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->shippingcost,2,'.','').'</span></td>
              </tr>
			  <tr>
            	<td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Tax</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->tax ,2,'.','').'</span></td>
              </tr>
			  <tr bgcolor="#f3f3f3">
                <td width="87" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Grand Total</span></td>
                <td width="31" style="border-bottom:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($private_total,'2','.','').'</span></td>
              </tr>
              <tr>
                <td width="87" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Amount Paid</span></td>
                <td width="31" style="border-bottom:1px solid #cecece;"><span style="font-size:14px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;font-weight:800">'.$this->data['currencySymbol'].number_format($private_total,'2','.','').'</span></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        </tr>
    </table>
        </div>
        
        <!--end of left--> 
        <div style="width:100%; margin-right:5px; float:left; border-bottom:1px dashed #575757;">
	        <p>
		        *All octroi and entry taxes are borne by the vendor<br />
		        <p> Payment mode : Prepaid - Credit card | Debit card | Online bank transfer , COD</p>
		        <p> Have a question? Our customer service is here to help you - +91 7304 22 44 88</p>
                        <strong style="font-size:15px;"> Please note that this is computer generated invoice and hence does not need a signature</strong><br /></br>
		       <p style="font-size:11px;color:grey;"> Disclaimer : This invoice is generated and issued on behalf and under the instructions of vendor mentioned in this invoice. The goods described in the invoice are sold to the customer by the vendor and not by Redolive Platforms Pvt Ltd. Redolive Platforms Pvt Lts has merely facilitated the sale and purchase between the vendor and customer and the vendor is responsible and liable for all the warranties, quality, merchantability etc. of the goods mentioned herein. Redolive Platforms Pvt Ltd is not an agent and shall not be deemed to be construed as an agent of vendor.</p>
	        </p>
        </div>
        <div style="width:100%; margin-right:5px; margin-top:5px; float:left;">
	        <center>
	        <p>Prepaid - Credit card | Debit card | Online bank transfer , COD</p>
	        </center>
	        <div style="width:60%; float:left; border:1px solid #cccccc; margin-right:10px;">
		    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:97%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#000305;">Shipped to :</span>
		    		<div style="float:left; padding:10px; width:100%;  font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#030002; line-height:28px;">
		            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($shipAddRess->row()->full_name).'</td></tr>
		                    <tr><td style="vertical-align: baseline;width: 100px;">Address</td><td style="vertical-align: baseline;">:</td><td>'.stripslashes($shipAddRess->row()->address1).','.stripslashes($shipAddRess->row()->address2).','.stripslashes($shipAddRess->row()->city).','.stripslashes($shipAddRess->row()->state).','.stripslashes($shipAddRess->row()->postal_code).','.stripslashes($shipAddRess->row()->country).'</td></tr>
							<!--<tr><td>Address 2</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address2).'</td></tr>
							<tr><td>City</td><td>:</td><td>'.stripslashes($shipAddRess->row()->city).'</td></tr>
							<tr><td>Country</td><td>:</td><td>'.stripslashes($shipAddRess->row()->country).'</td></tr>
							<tr><td>State</td><td>:</td><td>'.stripslashes($shipAddRess->row()->state).'</td></tr>
							<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($shipAddRess->row()->postal_code).'</td></tr>-->
							<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($shipAddRess->row()->phone).'</td></tr>
		            	</table>
		            </div>
		     </div>
        </div>
        <div style="width:30%;margin-right:5px; margin-top:5px; float:right;">
	       RedOlive Platforms pvt. ltd.
               S-305, Cosmos, Magarpatta City,
               Pune - 411028
                  Customer Care: 7304 22 44 88
            </div>
        </div>
        <div style="clear:both"></div>
    </div>
    </div>
<div style="page-break-before: always">
</br>
</br>
<center><h4 style="margin:0 auto;">Socktail.com Declaration Letter</h4></center></br></br>
<center><h4 style="margin:0 auto;">To Whomsoever It May Concern</h4></center>
<div style="width:100%; margin-right:5px; margin-top:5px; float:left;">
<p>I, '.stripslashes($shipAddRess->row()->full_name).' , have placed the order for</p>
</div>
<div style="float:left; width:100%; margin-right:3%; margin-top:10px; font-size:12px; font-weight:normal; line-height:28px;  font-family:Arial, Helvetica, sans-serif; color:#000; overflow:hidden;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece; width:99.5%;">
<tr bgcolor="#f3f3f3">
        	<td width="20%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Quantity</span></td>
        	<td width="80%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Name</span></td>
 </tr>';
foreach ($PrdList->result() as $cartRow) {
$message.='<tr>
<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.strtoupper($cartRow->quantity).'</span></td>
<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->product_name).$atr.'</span></td>
</tr>';
}
$message.='</table></td></tr>
</table>
</div>
<div style="width:100%; margin-right:5px; margin-top:5px; float:left;">
</br>
</br>
<p>Order ID: '.$PrdList->row()->dealCodeNumber.'</p>
<p> '.stripslashes($shipAddRess->row()->full_name).' </p>
<p> '.stripslashes($shipAddRess->row()->address1).'</p>
<p> '.stripslashes($shipAddRess->row()->address2).'</p>
<p> '.stripslashes($shipAddRess->row()->city).', '.stripslashes($shipAddRess->row()->state).', '.stripslashes($shipAddRess->row()->postal_code).'</p>
</br>
<p> I hereby confirm that said above goods are being purchased for my internal / personal purpose and not for re-sale. I further understand and agree to Socktail Terms and Conditions of sale available at socktail.com or upon request.</p>
</div>
</div></body></html>';

		return $message;
	}	
	
}

?>