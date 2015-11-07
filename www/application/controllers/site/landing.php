<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * Landing page functions
 * @author Teamtweaks
 *
 */

class Landing extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('product_model');

		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->product_model->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];

		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->product_model->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];

		$this->data['loginCheck'] = $this->checkLogin('U');
		//		echo $this->session->userdata('fc_session_user_id');die;
		$this->data['likedProducts'] = array();
		if ($this->data['loginCheck'] != ''){
			$this->data['likedProducts'] = $this->product_model->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
			$this->data['LatestsellerUser'] = $this->product_model->get_latest_five_sellers();
			$this->data['currentUserData'] = $this->product_model->get_all_details(USERS,array('id'=>$this->session->userdata('fc_session_user_id')));
			
			/*geting the first categories of user for listed the top like users to that categories*/
			if($this->data['selectedcat_id'] == ''){
				$this->data['selectedcat_id'] = $this->session->userdata("selectedCatID");
				if(!$this->data['selectedcat_id']){

					$CommanCatID = array();
					$MaxLikeSPrdCat = $this->product_model->get_Cat_Max_likePrd(PRODUCT);
					$MaxLikeUPrdCat = $this->product_model->get_Cat_Max_likePrd(USER_PRODUCTS);
					/*Getting the catID SellerPrd*/
					foreach($MaxLikeSPrdCat->result() as $Cat_string){

						$Category_ID = explode(',', $Cat_string->category_id);
						foreach ($Category_ID as $key) {
							if (!in_array($key, $CommanCatID)){
								array_push($CommanCatID, $key);
							}
						}
					}
					/*Getting the catID userPrd*/
					foreach($MaxLikeUPrdCat->result() as $Cat_string){

						$Category_ID = explode(',', $Cat_string->category_id);
						foreach ($Category_ID as $key) {
							if (!in_array($key, $CommanCatID)){
								array_push($CommanCatID, $key);
							}
						}
					}
					$this->data['selectedcat_id'] = $CommanCatID;
				}
			}
		}
			
	}

	/**
	 *
	 *
	 */
	public function index(){
		$this->data['heading'] = '';


		$cat = $this->input->get('c');
		$whereCond = '';
		$qry_str = '';
		if ($cat != ''){
			
				$catDetails = $this->product_model->get_all_details(CATEGORY,array('seourl'=>$cat));
				if ($catDetails->num_rows()==1){
					$catID = $catDetails->row()->id;
					if ($catID != ''){
						$whereCond .= ' and FIND_IN_SET("'.$catID.'",p.category_id)';
					}
				}
				$newCatSearch = false;
		}else{
			$newCatSearch = true;
		}
		

			$whereCond .= ' and FIND_IN_SET("107",p.category_id)';
		
		
		if($this->input->get('pg') != ''){
			$paginationVal = $this->input->get('pg')*12;
			$limitPaging = $paginationVal.',12 ';
		} else {
			$limitPaging = ' 12';
		}
		$newPage = $this->input->get('pg')+1;
		if ($cat != ''){
			$qry_str = '?c='.$cat.'&pg='.$newPage;
		}else {
			$qry_str = '?pg='.$newPage;
		}


		$this->data['layoutList'] = $layoutList = $this->product_model->view_controller_details();
		$totalSellingProducts = $this->product_model->get_total_records(PRODUCT);
		$totalAffilProducts = $this->product_model->get_total_records(USER_PRODUCTS);
		$this->data['totalProducts'] = $totalAffilProducts->row()->total+$totalSellingProducts->row()->total;
		if($layoutList->row()->product_control == 'affiliates'){
			$sellingProductDetails = array();
		}else {

			$sellingProductDetails = $this->product_model->view_product_details(" where p.status='Publish' and p.quantity > 0 and u.group='Seller' and u.status='Active' ".$whereCond." or p.status='Publish' and p.quantity > 0 and p.user_id=0 ".$whereCond." order by p.created desc limit ".$limitPaging);
		}
		if($layoutList->row()->product_control == 'selling'){
			$affiliateProductDetails = array();
		}else {
			$affiliateProductDetails = $this->product_model->view_notsell_product_details(" where p.status='Publish' and u.status='Active' and p.sale_price <1 and p.global_visible=1 ".$whereCond." or p.status='Publish' and p.user_id=0 and p.global_visible=1 ".$whereCond." order by p.created desc limit ".$limitPaging);
		}


		$this->data['productDetails'] = $this->product_model->get_sorted_array($sellingProductDetails,$affiliateProductDetails,'created','desc');

		$paginationDisplay  = '<a title="'.$newPage.'" class="btn-more" href="'.base_url().$qry_str.'" style="display: none;">See More Products</a>';
		$this->data['paginationDisplay'] = $paginationDisplay;
		
		/*listed the users to follow on the basis of category like*/
		if($this->checkLogin('U') != ''){

			foreach ($this->data['currentUserData']->result() as $userdeta) {
		        	$followingList = explode(',', $userdeta->following);
		        	$followingList_string = $userdeta->following;
		        	$Cid = $userdeta->id;
		        	$catID = $userdeta->follow_category;
		        }
		        if($followingList_string == ''){
		        	$followingList_string = ',0';
		        }
			$this->data['LatestsellerUser'] = $this->product_model->get_latest_five_sellers($followingList_string, $Cid);
			
			$selleruserArr = array();
			$productArr = array();
			$userArr = array();
			$userCountArr = array();
			$this->data['userList'] = array();

			foreach ($this->data['LatestsellerUser']->result() as $sellerUser){
			 array_push($selleruserArr, $sellerUser->id);
			}
			$catID = explode(',', $catID);
			//$catID = $this->data['selectedcat_id'];

			$this->data['userList'] = '';
			if (count($catID)>0){
				
				foreach ($catID as $cat){
				
				$condition = " where FIND_IN_SET('".$cat."',p.category_id) and p.status='Publish' and u.status='Active' or p.status='Publish' and p.user_id=0 and FIND_IN_SET('".$cat."',p.category_id)";
				
					$sellingProductDetailsCat = $this->product_model->view_product_details($condition);
					$affiliateProductDetailsCat = $this->product_model->view_notsell_product_details($condition);
					$productDetails = $this->product_model->get_sorted_array($sellingProductDetailsCat,$affiliateProductDetailsCat,'created','desc');
					if (count($productDetails) >0){
						for($i = 0; $i < count($productDetails); $i++){

							if (!in_array($productDetails[$i]->id, $productArr)){
								array_push($productArr, $productDetails[$i]->id);
								if ($productDetails[$i]->user_id != ''){
									if(!in_array($productDetails[$i]->user_id, $selleruserArr)){
										if (!in_array($productDetails[$i]->user_id, $userArr)){
											array_push($userArr, $productDetails[$i]->user_id);
											$userCountArr[$productDetails[$i]->user_id] = 1;
										}else {
											$userCountArr[$productDetails[$i]->user_id]++;
										}
									}
									
								}
							}
						}
					}
				}
			}
			arsort($userCountArr);
			$limitCount = 0;
			$followClass = 'follow';
	        $followText = 'Follow';
	        foreach ($this->data['currentUserData']->result() as $userdetailkey) {
	        	$followingListArr = explode(',', $userdetailkey->following);
	        	$current_user_id = $userdetailkey->id;
	        }
	        
	        
			foreach ($userCountArr as $user_id => $products){
				if ($user_id!='' && !in_array($user_id, $followingListArr) && $user_id!= $current_user_id){
					$condition = array('id'=>$user_id,'status'=>'Active');
					$userDetails = $this->product_model->get_all_details(USERS,$condition);
					if ($userDetails->num_rows()==1){
						$condition = array('user_id'=>$user_id,'status'=>'Publish');
						if ($limitCount<3){
							if (in_array($userDetails->row()->id, $followingListArr)){
					        	$followClass = 'following';
					        	$followText = 'Following';
					        }
							$userImg = $userDetails->row()->thumbnail;
							if ($userImg == ''){
								$userImg = 'user-thumb1.png';
							}
							$this->data['userList'] .= '
							<li class="recom-users-item">
								<a href="user/'.$userDetails->row()->user_name.'">
							<img src="'.base_url().'images/users/'.$userImg.'" class="avartar">
								</a>
							<p class="username">
								<span class="title"><a href="user/'.$userDetails->row()->user_name.'">'.$userDetails->row()->full_name.'</a></span>
								<a uid="'.$user_id.'" class="btn-invite follow-link '.$followClass.'" href="javascript:void(0)">'.$followText.'</a>
							</p>
							</li>';
							$limitCount++;
						}
					}
				}
			}
			/*follow user list of that users which are not followed by current user and not a Category based*/
			$this->data['LatestUser'] = $this->product_model->get_latest_five_users($followingList_string, $Cid);
		}
		$this->load->view('site/landing/landing',$this->data);
	}

	public function upload_request(){
		$returnStr['status_code'] = 0;
		$returnStr['message'] = '';
		if ($this->checkLogin('U')==''){
			$returnStr['message'] = 'Login required';
		}else {
			$dataArr = array(
				'user_id' => $this->checkLogin('U'),
				'message' => $this->input->post('msg')
			);
			$this->product_model->simple_insert(UPLOAD_REQ,$dataArr);
			$this->send_upload_request_mail();
			$returnStr['status_code'] = 1;
			$returnStr['message'] = 'Your request received. We will contact you soon';
		}
		echo json_encode($returnStr);
	}

	public function send_upload_request_mail(){
		if ($this->checkLogin('U')!=''){
			$newsid='19';
			$template_values=$this->product_model->get_newsletter_template_details($newsid);
			$full_name = $this->data['userDetails']->row()->full_name;
			if ($full_name == ''){
				$full_name = $this->data['userDetails']->row()->user_name;
			}
			$adminnewstemplateArr=array(
				'logo'=> $this->data['logo'],
				'meta_title'=>$this->config->item('meta_title'),
				'msg'=>$this->input->post('msg')
			);
			extract($adminnewstemplateArr);
			$subject = $template_values['news_subject'];
			$message .= '<!DOCTYPE HTML>
                                <html>
                                <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                <meta name="viewport" content="width=device-width"/>
                                <title>'.$template_values['news_subject'].'</title><body>';
			include('./newsletter/registeration'.$newsid.'.php');

			$message .= '</body>
                                </html>';

			if($template_values['sender_name']=='' && $template_values['sender_email']==''){
				$sender_email=$this->data['siteContactMail'];
				$sender_name=$this->data['siteTitle'];
			}else{
				$sender_name=$template_values['sender_name'];
				$sender_email=$template_values['sender_email'];
			}

			$email_values = array('mail_type'=>'html',
												'from_mail_id'=>$sender_email,
												'mail_name'=>$sender_name,
												'to_mail_id'=>$this->data['siteContactMail'],
												'subject_message'=>$subject,
												'body_messages'=>$message
			);
			$email_send_to_common = $this->product_model->common_email_send($email_values);
		}
	}
	
	public function followCategory(){

		$follow_cat = $this->input->get('c');

		$follow_cat = explode(',', $follow_cat);

		foreach ($this->data['currentUserData']->result() as $userdetailkey) {
			$CurrentUserId = $userdetailkey->id;
			$followCats = $userdetailkey->follow_category;
		}		
		$condition = array('id' => $CurrentUserId);
		if($follow_cat[0] == 'Follow'){

			if(!empty($followCats)){
				$followCats .= ','.$follow_cat[1];
			}else{
				$followCats .= $follow_cat[1];
			}
			
			
			$newdata = array(
               'follow_category' => $followCats
			);
			$this->product_model->update_details(USERS,$newdata,$condition);
			$returnStr['id'] = $follow_cat[1];
			$returnStr['text'] = 'Unfollow';
			echo json_encode($returnStr);
		}else{

			$parts = explode(',', $followCats);

		    while(($i = array_search($follow_cat[1], $parts)) !== false) {
		        unset($parts[$i]);
		    }

    		$followCats = implode(',', $parts);

    		$newdata = array(
               'follow_category' => $followCats
			);
			$this->product_model->update_details(USERS,$newdata,$condition);
			$returnStr['id'] = $follow_cat[1];
			$returnStr['text'] = 'Follow';
			echo json_encode($returnStr);
		}
	}

}

/* End of file landing.php */
/* Location: ./application/controllers/site/landing.php */