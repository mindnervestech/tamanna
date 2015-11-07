<?php
$this->load->view('site/templates/header');
?>
<link rel="stylesheet" href="css/site/my-account.css" type="text/css" media="all"/>

<script type="text/javascript" src="js/site/SpryTabbedPanels.js"></script>
<style type="text/css" media="screen">


#edit-details {
    color: #FF3333;
    font-size: 11px;
}
.option-area select.option {
    border: 1px solid #D1D3D9;
    border-radius: 3px 3px 3px 3px;
    box-shadow: 1px 1px 1px #EEEEEE;
    height: 22px;
    margin: 5px 0 12px;
}
a.selectBox.option {
    margin: 5px 0 10px;
    padding: 3px 0;
}
a.selectBox.option .selectBox-label {
    font: inherit !important;
    padding-left: 10px;
}
.button:hover {
	background: #3e73b7;
}

.button {
	cursor: pointer;
	overflow: visible;
	margin: 5px 0px;
	padding: 8px 8px 10px 7px;
	border: 0;
	border-radius: 4px;
	font-weight: bold;
	font-size: 15px;
	line-height: 22px;
	text-align: center;
	color: #fff;
	background: #588cc7;
}

</style>

 <!-- Section_start -->
<div class="lang-en wider no-subnav thing signed-out winOS">

<div id="container-wrapper">
<div class="main1" style="max-width: 100%;margin:-1px 0;border-radius:0;margin-top: 25px;">
      <div id="navigation-test">
        <div class="left" style="padding-left: 0px;">
     
<ul class="gnb-wrap" style="width:100%;font-size:11px;text-align:center;text-transform: uppercase;">
                      <?php 
                      foreach ($mainCategories->result() as $row){
                      	if ($row->cat_name != '' && $row->cat_name != 'Our Picks'){
                      ?>
            <li class="gnb" style="height:40px;text-align:left;">
    <?php
          if ($row->cat_name != 'Socktail Specials'){
         ?>
              <a class="mn-gifts"  style="line-height: 40px;color:#555555;" href="shopby/<?php echo $row->seourl;?>"><?php echo $row->cat_name;?></a>
        <?php  }
          Else
         { ?>
         <div class="mn-gifts"  style="line-height: 40px;color:#555555;" ><strong><?php echo $row->cat_name;?></strong></div>
        <?php  } ?>



              <div class="menu-contain-gift1" style="margin-top: -20px;">
                <ul style="border-top:0;">
<?php 
	                      foreach ($all_categories->result() as $row1){
	                      	if ($row1->cat_name != '' && $row->id==$row1->rootID){
	                      ?>
              <li><a  href="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>"><i class="arrow"></i><?php echo $row1->cat_name;?></a>
<?php if (in_array($row1->id, $root_id_arr)){?>
                    <div class="submenu-contain">
                      <ul>
			                      <?php 
			                      foreach ($all_categories->result() as $row2){
			                      	if ($row2->cat_name != '' && $row1->id==$row2->rootID){
			                      ?>
                        <li><a href="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>/<?php echo $row2->seourl;?>"><?php echo $row2->cat_name;?></a>
                        </li>
                      <?php 
                      	}
                      }
                      ?>
                      </ul>
                    </div>
 	<?php 
			                      	}
			                      	?>
                  </li>
			                      	<?php 
			                      	}
			                      }
			                      	?>
                </ul>
              </div>
            </li>
 <?php 
}
}
?> 
<!--<li  class="gnb"><a  class="mn-gifts" href="gift-cards"><?php if($this->lang->line('giftcard_cards') != '') { echo stripslashes($this->lang->line('giftcard_cards')); } else echo "Gift Cards"; ?></a></li>-->
</ul>        
</div>
</div>
</div>
	<div class="container " style="padding: 78px 0 20px;width: 940px;">
<?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>
	<?php 
	if ($productDetails->num_rows()==1){
		$img = 'dummyProductImage.jpg';
		$imgArr = explode(',', $productDetails->row()->image);
		if (count($imgArr)>0){
			foreach ($imgArr as $imgRow){
				if ($imgRow != ''){
					$img = $pimg = $imgRow;
					break;
				}
			}
		}
		$fancyClass = 'fancy';
		$fancyText = LIKE_BUTTON;
		if (count($likedProducts)>0 && $likedProducts->num_rows()>0){
			foreach ($likedProducts->result() as $likeProRow){
				if ($likeProRow->product_id == $productDetails->row()->seller_product_id){
					$fancyClass = 'fancyd';$fancyText = LIKED_BUTTON;break;
				}
			}
		}
	?>	
			<?php echo $breadCumps; ?> 
				<div class="wrapper-content right-sidebar" style="background:none; box-shadow:none;">
			<div id="content" style="padding:0px; background:none;width: 680px;">
            
            <div class="detail_leftbar" style="overflow: hidden;">
            
				<div class="figure-row first">
					<div class="figure-product figure-640 big">
						
						<figure>
							<span class="wrapper-fig-image" >
								<span class="fig-image" style="background:#FFFFFF;"><img itemprop="image" src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="<?php echo $productDetails->row()->product_name;?>"></span>
							</span>
                            
<br>
				<!--	<ul class="figure-list after" style="display: inline-block;float: left;">
					
						<?php 
						$limitCount = 0;
						$imgArr = explode(',', $productDetails->row()->image);
						if (count($imgArr)>0){
							foreach ($imgArr as $imgRow){
								if ($limitCount>6)break;
								if ($imgRow != '' && $imgRow != $pimg){
									$limitCount++;
						?>
						  <li style="display: inline-block;"><a href="<?php echo base_url().PRODUCTPATH.$imgRow;?>" data-bigger="<?php echo base_url();?>images/product/<?php echo $imgRow;?>" style="background-image:url(<?php echo base_url().PRODUCTPATH.$imgRow;?>);display: block;  width: 100px;  height: 100px;  position: relative;  background-size: cover;"></a></li>
						<?php 
								}
							}
						}
						?>
					</ul> -->
						<div itemprop="brand" itemscope itemtype="http://schema.org/Brand" itemref="_logo6" style="text-align:left;"><!--Brand :  <a href="<?php if ($productDetails->row()->user_id != '0'){echo base_url().'user/'.$productDetails->row()->user_name;}else {echo base_url().'user/administrator';}?>" class="username"><span itemprop="name"><?php if ($productDetails->row()->user_id != '0'){echo $productDetails->row()->full_name;}else {echo 'administrator';}?></span></a>-->

<!--<div class="rating_star" style="display: inline-block;float:none;">
<?php foreach($product_feedback as $feedbacks) {  $totals = $totals+$feedbacks['rating']; }  $totalratingstars = $totals/count($product_feedback);  ?>
<div class="rat_star1" style="width:<?php echo $totalratingstars * 20; ?>%"></div></div>
 (<?php  echo $rownum = count($product_feedback); ?>)
<span class="icon-heart-filled" style="float: right;padding-right: 10px;color: firebrick;"><?php echo $productDetails->row()->likes; ?> Likes</span>-->

<!-- AddToAny BEGIN -->
<!--<div class="a2a_kit a2a_default_style"style="float: right;">
<a class="a2a_dd" href="http://www.addtoany.com/share_save">Share</a>
<span class="a2a_divider"></span>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_google_plus"></a>
<a class="a2a_button_pinterest"></a>
</div>
<script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>-->
<!-- AddToAny END -->

</div> 
</br>

<!--<div style="float: right;" class="fb-like" data-href="<?php echo base_url();?>things/<?php echo $productDetails->row()->id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>"  data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>-->


                       <!--     <h1 style="text-align:left;margin-top: 25px;"><?php echo $productDetails->row()->product_name;?></h1> -->
						    
                        </figure>
						
						<br class="hidden">
						
                     
                        
						
   
						<br class="hidden">
						
						<!--<a href="#" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="button <?php echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?>><span><i></i></span><?php echo $fancyText;?></a>-->
                        
                        
<hr>                        
						<ul class="detail_thing_info1">
<?php 
	$img = 'dummyProductImage.jpg';
		$imgArr = explode(',', $productDetails->row()->image);
		if (count($imgArr)>0){
			foreach ($imgArr as $imgRow){
				if ($imgRow != ''){
					$img = $pimg = $imgRow;
					break;
				}
			}
		}
		$colorID = '0';
		$listNameArr = explode(',', $productDetails->row()->list_name);
		$listValueArr = explode(',', $productDetails->row()->list_value);
		if (count($listNameArr)>0){
			for ($i=0;$i<count($listNameArr);$i++){
				if ($listNameArr[$i] == '1'){
					if ($listValueArr[$i] != ''){
						$colorID = $listValueArr[$i];break;
					}
				}
			}
		}
		$color = '';
		if ($colorID != '0'){
			$listArr = $this->product_model->get_all_details(LIST_VALUES,array('id'=>$colorID));
			if ($listArr->num_rows()>0){
				$color = $listArr->row()->list_value;	
			}
		}
		$ownClass = '';
		if ($loginCheck != ''){
			$ownArr = explode(',', $userDetails->row()->own_products);
			if (in_array($productDetails->row()->seller_product_id, $ownArr)){
				$ownClass = 'own-selected';
			}
		}
?>
<!--<li><a href="javascript:void(0);" onclick="product_details_contact_form(this);" <?php if ($loginCheck==''){?>require-login="true"<?php }?> class="" id=""><i class="icon-mail"></i><?php if($this->lang->line('contact_seller') != '') { echo stripslashes($this->lang->line('contact_seller')); } else echo "Contact Seller"; ?></a></li>-->

					<!--	<li><a href="things/<?php echo $productDetails->row()->id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>" id="show-someone" class="show" uid="<?php echo $loginCheck;?>" tid="<?php echo $productDetails->row()->id;?>" tname="<?php echo $productDetails->row()->product_name;?>" tuser="<?php if ($productDetails->row()->user_id != '0'){echo $productDetails->row()->full_name;}else {echo 'administrator';}?>" data-timage="<?php //echo base_url();?>images/product/<?php echo $img;?>" price="<?php echo $productDetails->row()->sale_price;?>" reacts="<?php echo $productDetails->row()->likes;?>" username="<?php if ($loginCheck != ''){if (count($userDetails)>0){echo $userDetails->row()->user_name;}}?>" action="buy" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="icon-forward-outline"></i><?php if($this->lang->line('header_share') != '') { echo stripslashes($this->lang->line('header_share')); } else echo "Share"; ?></a></li> -->
                        
 <?php if ($loginCheck != ''  && ($userDetails->row()->id != $productDetails->row()->user_id)){?>
						<li><a href="#" onclick="" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" class="list" id="show-add-to-list-left"><i class="icon-clipboard"></i><?php if($this->lang->line('header_add_list') != '') { echo stripslashes($this->lang->line('header_add_list')); } else echo "Add to List"; ?></a></li>
<?php }?>
                        
                        
<!--<li><a href="#" class="own <?php echo $ownClass;?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" tid="<?php echo $productDetails->row()->seller_product_id;?>"><i class="icon-briefcase-1"></i><?php if($this->lang->line('product_i_ownit') != '') { echo stripslashes($this->lang->line('product_i_ownit')); } else echo "I own it"; ?></a></li>-->
                       
                        <?php if ($loginCheck != ''  && ($userDetails->row()->id == $productDetails->row()->user_id)){?>
						<li><a id="edit-details" class="" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit"><?php if($this->lang->line('product_edit_dtls') != '') { echo stripslashes($this->lang->line('product_edit_dtls')); } else echo "Edit details"; ?><i class="icon-pen"></i></a></li>
                        
						<li><a style="font-size: 11px; color: #f33;" uid="<?php echo $productDetails->row()->user_id;?>" thing_id="<?php echo $productDetails->row()->seller_product_id;?>" ntid="7220865" class="remove_new_thing" href="things/<?php echo $productDetails->row()->seller_product_id;?>/delete"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?><i class="icon-trash"></i></a></li>
						<li><a href="#" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="<?php if (count($userDetails)>0){if ($productDetails->row()->seller_product_id == $userDetails->row()->feature_product){ echo 'feature-selected';}else {echo 'feature';}}else {echo 'feature';}?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="icon-star"></i><?php if($this->lang->line('product_feature') != '') { echo stripslashes($this->lang->line('product_feature')); } else echo "Feature on my profile"; ?> </a></li>
                        <?php }?>  

                    </ul>

					</div>
					<!-- / figure-product figure-640 -->
				</div>
				<!-- / figure-row -->
                				<!-- Seller Story -->
				<?php 
					$store_img = 'user_thumb.png';
					if ($productDetails->row()->thumbnail != ''){
						$store_img = $productDetails->row()->thumbnail;
					}
					$followClass = '';
		        	$followText = 'Follow';
			        if ($loginCheck != ''){
				        $followingListArr = explode(',', $userDetails->row()->following);
				        if (in_array($productDetails->row()->user_id, $followingListArr)){
				        	$followClass = 'following';
				        	$followText = 'Following';
				        }
			        }
				?>
              
                <div class="TabbedPanels" id="TabbedPanels1">
         
                    <ul class="TabbedPanelsTabGroup">
                      <li tabindex="0" class="TabbedPanelsTab  TabbedPanelsTabSelected"><?php if($this->lang->line('item_details') != '') { echo stripslashes($this->lang->line('item_details')); } else echo "Item Details"; ?></li>
                   <!--   <li tabindex="0" class="TabbedPanelsTab">
                        		<div class="rating_star">
                        				<?php foreach($product_feedback as $feedbacks) {  $totals = $totals+$feedbacks['rating']; }  $totalratingstars = $totals/count($product_feedback);  ?>
                                        <div class="rat_star1" style="width:<?php echo round($totalratingstars) * 20; ?>%"></div>
                            </div>
                       (<?php  echo $rownum = count($product_feedback); ?>)</li> -->
                      <li tabindex="0" class="TabbedPanelsTab"><?php if($this->lang->line('shipping_policies') != '') { echo stripslashes($this->lang->line('shipping_policies')); } else echo "Shipping & Policies"; ?></li>
<?php 
$furCatArr = array('7','14','26','27','29','237');
$prodCat = $productDetails->row()->category_id;
$prodCatArr = @explode(',',$prodCat);

$combArr = array_merge($furCatArr, $prodCatArr);
$combArr1 = array_unique($combArr);

if(count($combArr) != count($combArr1)){?>                  
   <li tabindex="0" class="TabbedPanelsTab">Furniture Care</li>
<?php } ?>
<?php if($productDetails->row()->listvalue == 'Sheesham Wood' || $productDetails->row()->listvalue == 'Mango Wood' || $productDetails->row()->listvalue == 'Solid Wood'){?>
<li tabindex="0" class="TabbedPanelsTab">Color Guide</li>
<?php } ?>
                    </ul>
                        <div class="TabbedPanelsContentGroup">
                          <div class="TabbedPanelsContent  TabbedPanelsContentVisible" style="display: block;">
                          <?php  echo $productDetails->row()->description; ?><div class="clear"></div> 
                          </div>
                     <!--     <div class="TabbedPanelsContent" style="display: none;">
                           <?php  
                           $rownum = count($product_feedback); 
						   
                           if ($rownum>0){
                           foreach($product_feedback as $feedback) { 
                           	$pimg = 'dummyproductimage.jpg';
                           	$pimg_arr = array_filter(explode(',', $feedback['image']));
                           	if (count($pimg_arr)>0){
                           		foreach ($pimg_arr as $pimg_row){
                           			if (file_exists('images/product/'.$pimg_row)){
                           				$pimg = $pimg_row;break;
                           			}
                           		}
                           	}
                           	$total = $total+$feedback['rating'];?>
                            <div class="tabbed_review">
                            	<div class="tabbed_left">
                                	<a href="user/<?php echo $feedback['user_name']; ?>"><img src="images/users/<?php echo $feedback['thumbnail']; ?>" width="30px" height="30px" /></a>
                                    <span><?php if($this->lang->line('reviewed_by') != '') { echo stripslashes($this->lang->line('reviewed_by')); } else echo "Reviewed By"; ?></span>
                                    <p><a href="user/<?php echo $feedback['user_name']; ?>"><?php echo $feedback['full_name']; ?></a></p>
                                </div>
                                <div class="tabbed_right">
                                	<div class="tabbed_top">
                                		<div class="rating_star">
                                            <div class="rat_star1" style="width:<?php echo $feedback['rating']*20; ?>%"></div>
                                        </div>
                                   		<span class="date"><?php echo date("M d Y", strtotime($feedback['dateAdded'])); ?></span>
                                    </div>    
                                    <span class="tab_rev_title"><?php echo $feedback['title']; ?></span>
                                    <a style="float: left;margin: 0px 0 0 20px;width: 30px;" href="things/<?php echo $feedback['product_id']; ?>/<?php echo url_title($feedback['product_name'],'-');?>">
                                    	<img src="images/product/<?php echo $pimg; ?>" width="30px" />
                                    </a>
                                    <span class="tab_rev_txt"><?php echo $feedback['description']; ?> </span>
                                </div>
                            </div>
                            <?php } }else {?>
                            <p></p>
                            <?php }?>
                          </div> -->
                          <div class="TabbedPanelsContent" style="display: none;">
<?php 
if ($productDetails->row()->shipping_policies == '')
{
echo "<p>In case you have any questions or need any clarifications do not hesitate to call our Customer Support Team</p>

<p>In case of wooden furniture, please note that wood has inherent qualities such as marginal differences in stain and varnish, unique grain patterns etc. These are visible on a finished product and result in two otherwise identical items looking different. These are natural features of wood that provide character to each piece of wooden furniture and are accepted as per Industry standards. Small knots are also sometimes visible on the surface which is filled in by the furniture craftsmen during manufacture.</p>

<p><strong>Placing an order:</strong> Please <strong>check dimensions of the stairway and entrance to your premise before buying</strong>, so as to ensure that there is no problem in getting the product inside. In such a situation we will not be able to accept return or cancellation. There are some items that you will need to assemble on your own or you will need to arrange your own carpenter for assembly. Wherever Socktail provides, the carpenter visits will be scheduled subsequent to the delivery of the item.</p>

<p><strong>On Delivery:</strong> For all items that are expected to stand, ensure that the item is steady and straight. Unevenness up to 5 mm happens due to difference in surfaces and floor levels and is an accepted industry standard. Bushes will have to be attached to balance the item. In case of dust or a lack of shine, rubbing the surface with a cloth will help. This is an accepted method for cleaning the surface of a furniture item and making it shine.</p>

<p><strong>Damages:</strong> Socktail shipping arrangements to your doorstep have been designed to ensure a zero-damage, hassle-free experience, please contact us immediately, in case:
<ul>
<li>- Your item has any scratches or breakage that unfortunately might have occurred in the course of transit warranting your item to be fixed</li>
<li>- Any instruction manual, screws, nuts etc that might have been missed, should be informed to Customer Support immediately, so that they can arrange for the same to be delivered to you</li>
<li>- Your item arrives in damaged condition. All claims for damage must be made within 3 days of receipt of the item. Your request for a repair, refund or a replacement will be processed as soon as we receive the photographs of the damage to ascertain extent. We request you to retain all packing materials unless instructed otherwise by our team. You have an option of getting a full refund or replacement of the product that was received in damaged condition. Refunds or replacement for furniture returns will be processed when the item(s) has been picked up by us. Hence, please allow up to 2 to 3 weeks for reverse and then subsequent refund to process. A replacement will take the same amount of time as the order for shipping.</li>
</ul></p>
<p><strong>Cancellations:</strong> We accept cancellation of furniture orders up to 24 hours of placing the same.Pieces of furniture are made specifically for your order.</p>";
}
else
{
echo $productDetails->row()->shipping_policies;
}
?>


                         <div class="clear"></div>
                          </div>
                          <div class="TabbedPanelsContent" style="display: none;">
                          <?php  echo "<p><strong>Wooden Furniture Care and Cleaning Tips</strong></p>
<ul>
<li>* Keep furniture away from direct sunlight as it could cause fading.</li>
<li>* Keep furniture away from heaters, dehumidifiers and air conditioners.</li>
<li>* Use table clothes, runners, coasters and table pads on heavily used coffee and dining tables.</li>
<li>* Mop away any spills immediately. Don’t wipe. </li>
<li>* Use a damp, soft cloth to clean away dust. </li>
<li>* Clean when needed with a good quality wax or polish. </li>
<li>* Don't allow perfumes, nail polish or remover etc to come in contact with the wood. </li>
<li>* Treat your furniture with respect. Do not jump, stand, rock, swing, climb or play on. </li>
<li>* Lift furniture. Do not drag, rock or slide. Dragging can damage your furniture joints. </li>
</ul>
<br>
<p><strong>Leather Furniture Care and Cleaning Tips</strong></p>
<ul>
<li>* Keep furniture away from direct sunlight.</li>
<li>* Wipe the leather furniture down regularly with a clean, dry cloth. </li>
<li>* Use vacuum cleaner to remove dust and debris from crevices and under cushions. </li>
<li>* Apply leather conditioner regularly to keep it out of drying and developing cracks. </li>
<li>* Clean spills immediately with dry cloth.</li>
<li>* Avoid soaking the leather in water or soap.</li>
<li>* Avoid using any cleaning products not designed for leather. </li>
<li>* Buff small scratches in the leather with a microfiber cloth. </li>
</ul>
<br>
<p><strong>Fabric Upholstered Furniture Care and Cleaning Tips</strong></p>
<ul>
<li>* Regularly vacuum your furniture to remove dust, dirt and debris. </li>
<li>* Rotate & plump loose cushions to maintain their appearance and avoid uneven wear. </li>
<li>* Do not allow body/hair grease and oil to build up. </li>
<li>* Never use detergents or abrasive cleaners. </li>
<li>* Try not to place your furniture near heat sources or in direct sunlight, this could cause fading. </li>
<li>* If you accidentally spill something on your furniture, wipe excess away, do not rub. </li>
</ul>
<br>
<p><strong>Metal Furniture Care and Cleaning Tips</strong></p>
<ul>
<li>* Maintain with regular dusting. </li>
<li>* Wipe spills immediately. </li>
<li>* Clean with mild soap and water, dry thoroughly and do not use a brass cleaner. </li>
<li>* Use coasters under all beverages. </li>
<li>* Do not expose to excess humidity. </li>
</ul>
<br>
<p><strong>Wicker Furniture Care and Cleaning Tips</strong></p>
<ul>
<li>* Vacuum wicker furniture routinely with the soft brush attachment.</li>
<li>* Maintain even humidity in your home to keep antique wicker happy. </li>
<li>* To add life to the seats of your wicker furniture, use padded chair seat cushions. </li>
<li>* Use tweezers to pick out lint and trapped pet hair that the vacuum and soft brush can’t remove.</li>
<li>* If you do notice mold or mildew growing on your wicker furniture, clean immediately with a solution of bleach in water. </li>
</ul>
<br>
<!--<p><strong>Mattress Care and Cleaning Tips</strong></p>
<ul>
<li>* Keep the mattress dry. Use a mattress pad to prevent staining. </li>
<li>* Vacuum clean regularly. </li>
<li>* Turn and rotate a new mattress every few weeks to help smooth out contours. </li>
<li>* After a few months, turn and rotate a mattress twice a year to help equalize the wear and tear. </li>
<li>* Do not use dry cleaning products on your mattress. This may cause damage to some of the materials. </li>
<li>* If your mattress gets wet or soiled, blot any excess moisture using a soft cloth. </li>
<li>* To clean a stain, use mild soap with cold water gently. Pat dry. </li>
</ul>-->
"; ?><div class="clear"></div>
                          </div>
<div class="TabbedPanelsContent" style="display: none;">

<!--<p><strong>Sheesham Wood Colors</strong></p>-->
<img src="/images/Color Guide Sheesham Wood.png" alt="Sheesham Wood Color Guide"  style="width: 590px;height: 443px;">
                       
<div class="clear"></div>
</div>                          
                          
                     <script type="text/javascript" class="" style="display: none;">
                        var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
                        //--&gt;
                        </script>
                        
                        </div>
                </div>
                
				
            
                
                
                </div>
                
                
                
                <div class="detail_leftbar1">
				<?php 
				if (count($relatedProductsArr)>0 || count($affiliaterelatedProductsArr)>0){
				?>
				<div class="might-fancy">
					<h3 class="selstory-head detail_link_list"><?php if($this->lang->line('giftcard_you_might') != '') { echo stripslashes($this->lang->line('giftcard_you_might')); } else echo "You might also"; ?> Like...</h3>
					<?php if (count($relatedProductsArr)>0){ ?>                    
					<div style="padding-left: 19px;" class="figure-row fancy-suggestions anim might_box">
					<?php 
					$limitCount = 0;
					foreach ($relatedProductsArr as $relatedRow){
						if ($limitCount<6){
							$limitCount++;
						$img = 'dummyProductImage.jpg';
						$imgArr = explode(',', $relatedRow->image);
						if (count($imgArr)>0){
							foreach ($imgArr as $imgRow){
								if ($imgRow != ''){
									$img = $imgRow;
									break;
								}
							}
						}
					/*	$fancyClass = 'fancy';
						$fancyText = LIKE_BUTTON;
						if (count($likedProducts)>0 && $likedProducts->num_rows()>0){
							foreach ($likedProducts->result() as $likeProRow){
								if ($likeProRow->product_id == $relatedRow->seller_product_id){
									$fancyClass = 'fancyd';$fancyText = LIKED_BUTTON;break;
								}
							}
						}*/
					?>
							<div class="figure-product figure-200 might_box_list" style="width: 165px;">
								<a href="<?php echo base_url();?>things/<?php echo $relatedRow->id;?>/<?php echo url_title($relatedRow->product_name,'-');?>">
								<figure>
								<span class="wrapper-fig-image">
									<span class="fig-image">
										<img style="width: 200px; height: 200px;" src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="<?php echo $relatedRow->product_name;?>">
									</span>
								</span>

								<figcaption><?php echo $relatedRow->product_name;?></figcaption>
								</figure>
								</a>
								<br class="hidden">
							<!--	<span class="username"><a href="<?php if ($relatedRow->user_id != '0'){echo 'user/'.$relatedRow->user_name;}else {echo 'user/administrator';}?>"><?php if ($relatedRow->user_id != '0'){echo $relatedRow->full_name;}else {echo 'administrator';}?></a> <em>+ <?php echo $relatedRow->likes;?></em></span>-->
								<br class="hidden">
							<!--	<a href="#" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $relatedRow->seller_product_id;?>" class="button <?php echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?>><span><i></i></span><?php echo $fancyText;?></a> -->
							</div>
					<?php 
					}
				}?>
				</div>
			<?php }?>
		<!--	<?php if (count($affiliaterelatedProductsArr)>0){ ?>
					<div style="height:259px;padding-left: 19px;" class="figure-row fancy-suggestions anim">
					<?php 
					$limitCount = 0;
					foreach ($affiliaterelatedProductsArr as $relatedRow){
						if ($limitCount<3){
							$limitCount++;
						$img = 'dummyProductImage.jpg';
						$imgArr = explode(',', $relatedRow->image);
						if (count($imgArr)>0){
							foreach ($imgArr as $imgRow){
								if ($imgRow != ''){
									$img = $imgRow;
									break;
								}
							}
						}
						/*$fancyClass = 'fancy';
						$fancyText = LIKE_BUTTON;
						if (count($likedProducts)>0 && $likedProducts->num_rows()>0){
							foreach ($likedProducts->result() as $likeProRow){
								if ($likeProRow->product_id == $relatedRow->seller_product_id){
									$fancyClass = 'fancyd';$fancyText = LIKED_BUTTON;break;
								}
							}
						}*/
					?>
							<div class="figure-product figure-200">
								<a href="<?php echo base_url();?>user/<?php echo $relatedRow->user_name;?>/things/<?php echo $relatedRow->seller_product_id;?>/<?php echo url_title($relatedRow->product_name,'-');?>">
								<figure>
								<span class="wrapper-fig-image">
									<span class="fig-image">
										<img style="width: 200px; height: 200px;" src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="<?php echo $relatedRow->product_name;?>">
									</span>
								</span>
								<figcaption><?php echo $relatedRow->product_name;?></figcaption>
								</figure>
								</a>
								<br class="hidden">
								<span class="username"><a href="<?php if ($relatedRow->user_id != '0'){echo 'user/'.$relatedRow->user_name;}else {echo 'user/administrator';}?>"><?php if ($relatedRow->user_id != '0'){echo $relatedRow->full_name;}else {echo 'administrator';}?></a> <em>+ <?php echo $relatedRow->likes;?></em></span> -->
								<br class="hidden">
								<!--<a href="#" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $relatedRow->seller_product_id;?>" class="button <?php echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?>><span><i></i></span><?php echo $fancyText;?></a>
							</div>
					<?php 
					}
				}?>
				</div>
			<?php }?> -->

				</div>
				<?php }?>




				<?php 
				if ($recentLikeArr->num_rows()>0){
				?>
				</div>
                <div class="detail_leftbar1">
                <h3 id="recently-fancied-by" class="detail_link_list"><?php if($this->lang->line('recently') != '') { echo stripslashes($this->lang->line('recently')); } else echo "Recently"; ?> <?php echo LIKED_BUTTON;?> <?php if($this->lang->line('user_by') != '') { echo stripslashes($this->lang->line('user_by')); } else echo "by"; ?>...</h3>
                
				<div class="recently-fancied might_box">
					<?php 
					foreach ($recentLikeArr->result() as $userRow){
						if ($userRow->user_id != '' && $userRow->user_id != $loginCheck){
							$userImg = 'user-thumb1.png';
							if ($userRow->thumbnail != ''){
								$userImg = $userRow->thumbnail;
							}
							$followClass = 'follow';
					        $followText = 'Follow';
					        if ($loginCheck != ''){
						        $followingListArr = explode(',', $userDetails->row()->following);
						        if (in_array($userRow->user_id, $followingListArr)){
						        	$followClass = 'following';
						        	$followText = 'Following';
						        }
					        } 
					?>
					<div class="figure-row" style="display: inline-block;">
						<div class="user">
							<div class="vcard">
								<a href="<?php echo base_url().'user/'.$userRow->user_name;?>" class="url"><img width="40px" height="40px" src="<?php echo base_url();?>images/users/<?php echo $userImg;?>" alt="<?php echo $userRow->full_name;?>" class="photo"></a>
								<a href="<?php echo base_url().'user/'.$userRow->user_name;?>"><strong class="fn nickname"><?php echo $userRow->full_name;?></strong></a>
							</div>
							<!-- / vcard -->
							
							<a href="#" <?php if ($loginCheck==''){?>require_login="true"<?php }?> uid="<?php echo $userRow->user_id;?>" class="follow-link <?php echo $followClass;?>"><?php echo $followText;?></a>
							
						</div>
						<!-- /user -->
				<!--	<?php 
					if ($recentUserLikes[$userRow->user_id]->num_rows()>0){
						foreach ($recentUserLikes[$userRow->user_id]->result() as $userLikeRow){
							if ($userLikeRow->product_name != ''){
								$img = 'dummyProductImage.jpg';
								$imgArr = explode(',',$userLikeRow->image);
								if (count($imgArr)>0){
									foreach ($imgArr as $imgRow){
										if ($imgRow != ''){
											$img = $imgRow;
											break;
										}
									}
								}
					?>
						
						<div class="figure-product figure-140">
						
						
						
						<a href="<?php echo base_url().'things/'.$userLikeRow->PID.'/'.url_title($userLikeRow->product_name,'-');?>"><figure><span class="wrapper-fig-image"><span class="fig-image"><img width="140px" src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="<?php echo $userLikeRow->product_name;?>"></span></span></figure></a>
						
						
						</div>
					<?php 
							}
						}
					}
					?>	-->
						
					</div>
					<!-- / figure-row -->
				<?php 
						}
				}
				?>
				</div>
				<!-- / recently-fancied -->
				<?php 
				}
				?>
			</div>
            
            </div>
            
			<!-- / content -->

			<aside id="sidebar" style="padding:0px; width: 255px;">
          
				<section class="thing-section gift-section">
                
                		<div class="detail_sidebar">
 <h3 itemprop="name" style="font-size:15px;text-transform: uppercase;"><?php echo $productDetails->row()->product_name;?></h3></br>
<?php if ($productDetails->row()->price>$productDetails->row()->sale_price){ ?>
<div style="color: #858484;">Retail Price: 
<div style="display:inline-block; text-decoration: line-through;"><?php echo $currencySymbol;?><?php echo number_format($productDetails->row()->price); ?></div></div>
<?php }?>
<div style="font-size:18px;">Our Price: 
<span itemprop="price" id="SalePrice"><?php echo $currencySymbol;?><?php echo number_format($productDetails->row()->sale_price);?></strong></span>
</div>
            

			<!-- vinit code start -->
			<?php
                    $prodID = $productDetails->row()->id;
                    $origPrice = $productDetails->row()->sale_price;
                    $userId = $productDetails->row()->user_id;
                    $catId = $productDetails->row()->category_id;

                        $couponCode = '';
                        $discVal = 0.00;
                        $discPrice = '';
                        $discDesc = '';
                        $resultArr = $this->product_model->getDiscountedDetails($prodID,$origPrice,$userId,$catId);
                        $couponCode = $resultArr['coupon_code'];
                        $discPrice = $resultArr['disc_price'];
                        $discVal = $resultArr['disc_percent'];
                        $discDesc = $resultArr['disc_desc'];    
                        
                    
                    ?>
			<!-- vinit code end -->
<?php if($discPrice != ''){?>
<strong><?php echo $discDesc;?>
<div style="color: #ec1e20;font-size:15px;">Extra <?php echo number_format($discVal);?>% OFF</div></strong>
<div style="font-size:12px;">Use Coupon Code <div style="color: #ec1e20;font-size:13px;display:inline-block;">"<?php echo $couponCode;?>"</div> to get additional <?php echo number_format($discVal);?>% OFF on our price.</div>
<!--<div style="font-size:12px;">Use Coupon Code <div style="color: #ec1e20;font-size:13px;display:inline-block;">"<?php echo $couponCode;?>"</div> to get additional <?php echo number_format($discVal);?>% off</div>-->
<hr>
<?php }?>





                                <!--        <p class="prices"  style="font-size:18px;">Our Price:
						<strong class="price"><?php echo $currencySymbol;?> <span  itemprop="price" id="SalePrice"><?php echo $productDetails->row()->sale_price;?></span></strong><br>
						
					</p> -->

<?php if($discPrice != ''){?>
<!--</br><div style="font-size:12px;">Use Coupon Code <div style="color: #ec1e20;font-size:13px;display:inline-block;">"<?php echo $couponCode;?>"</div> to get additional <?php echo number_format($discVal);?>% OFF on this price.</div>-->
<?php }?>
<!--<?php if($discPrice != ''){?>
<div style="color: #ec1e20;font-size:19px;">You Pay: 
<span itemprop="price" id="DiscPrice"><strong><?php echo $currencySymbol;?><?php echo $discPrice;?></strong></span>
</div>
<?php }?>-->
<!--<hr>-->
<!--<p class="prices">						
<strong itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price">Retail Price: <?php echo $currencySymbol;?><b class="price" style="text-decoration: line-through;font-weight: normal;"></br>
<?php if ($productDetails->row()->price>$productDetails->row()->sale_price){echo $productDetails->row()->price;echo " ";}?></b><span itemprop="price" id="SalePrice"><?php echo $productDetails->row()->sale_price;?></span></strong> <br> -->
<!-- vinit code start -->
<!--<?php if($discPrice != '')
                    {?>
                    <strong class="price"><?php echo "You Pay "?><?php echo $currencySymbol;?><span id="DiscPrice"><?php echo $discPrice;?></br></strong>
<?php echo "Discounted Percentage "?><?php echo $discVal;?>
<?php echo "Use Coupon Code \""?><?php echo $couponCode;?>" to get 'You Pay' Price</br>
</span><br>
                    
                    <?php
                    }
                    ?>-->
			<!-- vinit code end -->	
						
					<!--</p>-->
					
              <!--      <h3 itemprop="name"><?php echo $productDetails->row()->product_name;?></h3> -->

					<!--<div class="thing-description">
					<?php 
					$short_des = word_limiter($productDetails->row()->excerpt,25);
					if ($short_des == ''){
						$short_des = word_limiter($productDetails->row()->description,25);
					}
					?>	
						<p><span itemprop="description"><?php echo $short_des;?></span> <a href="<?php echo 'things/'.$productDetails->row()->id.'/'.url_title($productDetails->row()->product_name);?>"><?php if($this->lang->line('fancy_more') != '') { echo stripslashes($this->lang->line('fancy_more')); } else echo "more"; ?></a></p>
						
					</div>-->

<!--                    <div class="quick-shipping" <?php if($productDetails->row()->ship_immediate == 'true'){?>style="display: block;"<?php }?>>
                        <span class="icon truck"></span> <?php if($this->lang->line('header_immed_ship') != '') { echo stripslashes($this->lang->line('header_immed_ship')); } else echo "Immediate Shipping"; ?> <span class="tooltip"><i class="icon"></i> <small><?php if($this->lang->line('header_ship_within') != '') { echo stripslashes($this->lang->line('header_ship_within')); } else echo "Ships within 1-3 business days"; ?> <b></b></small></span> -->
<!--<hr>-->




<?php if($productDetails->row()->listvalue == 'Sheesham Wood' || $productDetails->row()->listvalue == 'Mango Wood' || $productDetails->row()->listvalue == 'Solid Wood'){?>
             <!--   <section class="comments comments-list comments-list-new" style="padding-bottom: 0;">-->
                    
                    <!--<button id="btn-viewall-comments" class="toggle">View all 28 comments <i></i></button>
					<button id="toggle-comments" class="toggle"><span>View all 28 comments</span> <i></i></button>-->
                    
					<!-- template for normal comments -->
					
					<!-- template for reported comments -->
					
				<!--	<ol user_id="">
						
						<li class="loading"><span><?php if($this->lang->line('display_loading') != '') { echo stripslashes($this->lang->line('display_loading')); } else echo "Loading"; ?>...</span></li>
					</ol>
					<ol user_id="" id="New_Comment">
						<?php 
						if ($productComment->num_rows() > 0){
							foreach ($productComment->result() as $cmtrow){
							if ($loginCheck != '' && $cmtrow->CUID > 0 && $loginCheck == $cmtrow->CUID){
						?>
					         	<li class="comment">
							<a class="milestone" id="comment-1866615"></a>
							<p class="c-text"><?php echo $cmtrow->comments;?></p>
							<p style="float:left;width:100%;text-align:left;font-size: 11px; color: #188A0E;">
							<a style="font-size: 11px; color: #f33;margin-left:10px" onclick="javascript:deleteCmt(this);" data-tid="<?php echo $productDetails->row()->seller_product_id;?>" data-cid="<?php echo $cmtrow->id;?>"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?></a>
							</p>	
                                                        </li>
						<?php }}}
                                                 ?>
					</ol> -->
					

			<!--	</section> -->
				<!-- / comments -->
				<?php 
				if ($loginCheck != ''){
					$user_name_ud = $userDetails->row()->user_name;
					$thumbnail_ud = $userDetails->row()->thumbnail;
				}else{
					$user_name_ud = '';
					$thumbnail_ud = '';
				}
				?>
 <!-- Comment start -->  
  <script type="text/javascript">
$(function() {

$(".submit").click(function() {
	var requirelogin = $(this).attr('require-login');
	if(requirelogin){
		var thingURL = $(this).parent().next().find('a:first').attr('href');
		window.location = baseURL+thingURL;
		return false;
	}
	var comments = $("#comments").val();
	var product_id = $("#cproduct_id").val();
    var dataString = '&comments=' + comments + '&cproduct_id=' + product_id;
	
	if(comments=='')
     {
    alert('<?php if($this->lang->line('your_cmt_empty') != '') { echo stripslashes($this->lang->line('your_cmt_empty')); } else echo "Your comment is empty"; ?>');
     }
	else
	{

$.ajax({
		type: "POST",
  url: baseURL+'site/order/insert_product_comment',
   data: dataString,
  cache: false,
  dataType:'json',
  success: function(json){
		if(json.status_code == 1){
				alert('<?php echo "We have got your requirements, our team will be in touch with you shortly.."; ?>');
				$("#New_Comment").append( '<li><a class="milestone" id="comment-1866615"></a><p class="c-text">'+ comments +'</p><p style="float:left;width:100%;text-align:left;font-size: 11px; color: #188A0E;"><a style="font-size: 11px; color: #f33;margin-left:10px" onclick="javascript:deleteCmt(this);" data-tid="<?php echo $productDetails->row()->seller_product_id;?>" data-cid="'+ json.comment_ID +'"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?></a></p></li>' );
				//window.location.reload();
			}
    document.getElementById('comments').value='';
	$("#flash").hide();
	
  }
 });
}
return false;
	});



});


</script> 
<div id="flash"></div>
<div class="option-area detail_option1">
                    	<div class="detail_option">
        <div style="overflow: hidden;">
                <form action="#" method="post">
                    <input type="hidden" name="cproduct_id" id="cproduct_id" value="<?php echo $productDetails->row()->seller_product_id;?>"/>
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $loginCheck ;?>"/>
                    <p>Customize this order (optional)</p>
                   <ul><li> <textarea class="text detail_input" name="comments" placeholder="<?php echo "Tell us size, finish and more..\n\nDo mention your phone number, so that we can call you back.."; ?>..." id="comments" style="height: 100px;margin: 4px 4px 0 0;width: 92%;"></textarea> </li></ul>
                    <input type="submit" <?php if($loginCheck==''){ ?>require-login='true'<?php }?> class="submit button" value=" <?php echo "Send custom request"; ?> " style="width: 10%;float: right;height: 35px;margin: 4px 0 0 0;width: 100%;border-radius:2px;" />
                </form>
                <?php if($loginCheck==''){ ?>
                	<p><?php if($this->lang->line('product_please') != '') { echo stripslashes($this->lang->line('product_please')); } else echo "Please"; ?> <a href="login?next=things/<?php echo $productDetails->row()->id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>"><?php if($this->lang->line('product_login') != '') { echo stripslashes($this->lang->line('product_login')); } else echo "login"; ?></a> <?php if($this->lang->line('credit_or') != '') { echo stripslashes($this->lang->line('credit_or')); } else echo "or"; ?> <a href="signup?next=things/<?php echo $productDetails->row()->id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>"><?php if($this->lang->line('product_signup') != '') { echo stripslashes($this->lang->line('product_signup')); } else echo "signup"; ?></a> <?php echo "to send custom request"; ?></p>
                <?php }?>
        </div> 
</div>

                    	</div>  	
<?php }?>		

					<div class="option-area detail_option1">
                    	<div class="detail_option">
					<input type="hidden" id="original_sale_price" value="<?php echo $productDetails->row()->sale_price;?>"/>	
						<label for="quantity"><?php if($this->lang->line('header_quant_Avail') != '') { echo stripslashes($this->lang->line('header_quant_Avail')); } else echo "Quantity"; ?> </label>
						<span style="display: inline-block; position: relative;" class="input-number">
							<input name="quantity" id="quantity" data-mqty="<?php echo $productDetails->row()->quantity;?>" class="option quantity" value="1" min="1" onkeyup="javascript:changeQty(this);" type="number">
							<a style="position: absolute; top: 5px; right: 0px; height: 11px; padding: 0px 7px;" class="btn-up" onclick="javascript:increaseQty();" href="javascript:void(0);"><span></span></a>
							<a style="position: absolute; top: 17px; right: 0px; height: 11px; padding: 0px 7px;" class="btn-down" onclick="javascript:decreaseQty();" href="javascript:void(0);"><span></span></a>
						</span>
						<div style="color:#FF0000;" id="QtyErr"></div>
						 <?php  
                   	$attrValsSetLoad = ''; //echo '<pre>'; print_r($PrdAttrVal->result_array()); 
					if($PrdAttrVal->num_rows>0){ 
						$attrValsSetLoad = $PrdAttrVal->row()->pid; 
					?>
                   <label for="quantity">Available <?php if($this->lang->line('options') != '') { echo stripslashes($this->lang->line('options')); } else echo "Options"; ?></label>
                   	<select name="attr_name_id" id="attr_name_id" class="option  selectBox" style="border:1px solid #D1D3D9;width: 190px;" onchange="ajaxCartAttributeChange(this.value,'<?php echo $productDetails->row()->id; ?>');" >
                        <option value="0">--------------- <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "Select"; ?> ---------------</option>
                        <?php foreach($PrdAttrVal->result_array() as $Prdattrvals ){ ?>
                        <option value="<?php echo $Prdattrvals['pid']; ?>"><?php echo $Prdattrvals['attr_type'].':  '.$Prdattrvals['attr_name']; ?></option>
                        <?php } ?>
                        </select>
				<div style="color:#FF0000;" id="AttrErr"></div>
				<div id="loadingImg_<?php echo $productDetails->row()->id; ?>"></div>
              <?php } ?>
					<div style="color:#FF0000;" id="ADDCartErr"></div>
                <input type="hidden" class="option number" name="product_id" id="product_id" value="<?php echo $productDetails->row()->id;?>">
                <input type="hidden" class="option number" name="cateory_id" id="cateory_id" value="<?php echo $productDetails->row()->category_id;?>">                
                <input type="hidden" class="option number" name="sell_id" id="sell_id" value="<?php echo $productDetails->row()->user_id;?>">
                <input type="hidden" class="option number" name="price" id="price" value="<?php echo $productDetails->row()->sale_price;?>">
                <input type="hidden" class="option number" name="product_shipping_cost" id="product_shipping_cost" value="<?php echo $productDetails->row()->shipping_cost;?>"> 
                <input type="hidden" class="option number" name="product_tax_cost" id="product_tax_cost" value="<?php echo $productDetails->row()->tax_cost;?>">
                <input type="hidden" class="option number" name="attribute_values" id="attribute_values" value="<?php echo $attrValsSetLoad; ?>">

				<input type="button" class="greencart add_to_cart" <?php if ($loginCheck==''){echo 'require_login="true"';}?> name="addtocart" value="<?php if($this->lang->line('header_add_cart') != '') { echo stripslashes($this->lang->line('header_add_cart')); } else echo "Add to Cart"; ?>" onclick="ajax_add_cart('<?php echo $PrdAttrVal->num_rows; ?>');" />
<?php if($productDetails->row()->listvalue == 'Sheesham Wood' || $productDetails->row()->listvalue == 'Mango Wood' || $productDetails->row()->listvalue == 'Solid Wood'){?>
<p style="padding-top: 8px;">Or call 7304224488 for any customization!</p>
<?php } ?>

					</div>
					</div>

<hr>


					<ul class="figure-list after">
					
						<?php 
						$limitCount = 0;
						$imgArr = explode(',', $productDetails->row()->image);
						if (count($imgArr)>0){
							foreach ($imgArr as $imgRow){
								if ($limitCount>5)break;
								if ($imgRow != '' && $imgRow != $pimg){
									$limitCount++;
						?>
						  <li><a href="<?php echo base_url().PRODUCTPATH.$imgRow;?>" data-bigger="<?php echo base_url();?>images/product/<?php echo $imgRow;?>" style="background-image:url(<?php echo base_url().PRODUCTPATH.$imgRow;?>)"></a></li>
						<?php 
								}
							}
						}
						?>
					</ul> 
	<hr>	<div style="line-height: 2; font-weight: normal;">
                       <b>Shipping Cost:</b> <?php echo $currencySymbol;?> <?php echo $productDetails->row()->shipping_cost;?> 
					</div>
		<div style="line-height: 2; font-weight: normal;">
                       <b>Shipped in:</b> <?php $shipping = $productDetails->row()->shipping;
                       
                       
                       switch($shipping)
                       {

                       	case '1': 
                       		echo stripslashes($this->lang->line('shipping_in_option_first')); 
                       	break;

                       	case '2':
                       		echo stripslashes($this->lang->line('shipping_in_option_second')); 
                       	break;

                       	case '3':
                       		echo stripslashes($this->lang->line('shipping_in_option_third')); 
                       	break;

                       	case '4':
                       		echo stripslashes($this->lang->line('shipping_in_option_fourth')); 
                       	break;


                       	case '5':
                       		echo stripslashes($this->lang->line('shipping_in_option_fifth')); 
                       	break;


                       	case '6':
                       		echo stripslashes($this->lang->line('shipping_in_option_sixth')); 
                       	break;
                       }



                       ?>


<div style="line-height: 2; font-weight: normal;">
<b>Material:</b> <?php echo $productDetails->row()->listvalue;?>
</div>
<div style="line-height: 2; font-weight: normal;">
                       <b>Product ID:</b> <?php echo $productDetails->row()->seller_product_id;?>
					</div>

   					<div style="line-height: 2; font-weight: normal;">
                       <b>SKU Code:</b> <?php echo $productDetails->row()->sku;?>
					</div>
			
					</div>

                    
                    </div>
	<!--					<div class="detail_sidebar_list">
                        
							<h3 class="detail_link_list"><?php if($this->lang->line('actions') != '') { echo stripslashes($this->lang->line('actions')); } else echo "Actions"; ?></h3>
                            
                            
                            
                            <ul class="detail_thinginfo">
<?php 
	$img = 'dummyProductImage.jpg';
		$imgArr = explode(',', $productDetails->row()->image);
		if (count($imgArr)>0){
			foreach ($imgArr as $imgRow){
				if ($imgRow != ''){
					$img = $pimg = $imgRow;
					break;
				}
			}
		}
		$colorID = '0';
		$listNameArr = explode(',', $productDetails->row()->list_name);
		$listValueArr = explode(',', $productDetails->row()->list_value);
		if (count($listNameArr)>0){
			for ($i=0;$i<count($listNameArr);$i++){
				if ($listNameArr[$i] == '1'){
					if ($listValueArr[$i] != ''){
						$colorID = $listValueArr[$i];break;
					}
				}
			}
		}
		$color = '';
		if ($colorID != '0'){
			$listArr = $this->product_model->get_all_details(LIST_VALUES,array('id'=>$colorID));
			if ($listArr->num_rows()>0){
				$color = $listArr->row()->list_value;	
			}
		}
		$ownClass = '';
		if ($loginCheck != ''){
			$ownArr = explode(',', $userDetails->row()->own_products);
			if (in_array($productDetails->row()->seller_product_id, $ownArr)){
				$ownClass = 'own-selected';
			}
		}
?>
						<li><a href="javascript:void(0);" onclick="product_details_contact_form(this);" <?php if ($loginCheck==''){?>require-login="true"<?php }?> class="" id=""><i style="background-position: -136px -40px;"></i><?php if($this->lang->line('contact_seller') != '') { echo stripslashes($this->lang->line('contact_seller')); } else echo "Contact Seller"; ?></a></li>
						<li><a href="things/<?php echo $productDetails->row()->id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>" id="show-someone" class="show" uid="<?php echo $loginCheck;?>" tid="<?php echo $productDetails->row()->id;?>" tname="<?php echo $productDetails->row()->product_name;?>" tuser="<?php if ($productDetails->row()->user_id != '0'){echo $productDetails->row()->full_name;}else {echo 'administrator';}?>" data-timage="<?php //echo base_url();?>images/product/<?php echo $img;?>" price="<?php echo $productDetails->row()->sale_price;?>" reacts="<?php echo $productDetails->row()->likes;?>" username="<?php if ($loginCheck != ''){if (count($userDetails)>0){echo $userDetails->row()->user_name;}}?>" action="buy" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="link_icon"></i><?php if($this->lang->line('header_share') != '') { echo stripslashes($this->lang->line('header_share')); } else echo "Share"; ?></a></li>
                        
						<li><a href="#" onclick="" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" class="list" id="show-add-to-list"><i class="want_icon"></i><?php if($this->lang->line('header_add_list') != '') { echo stripslashes($this->lang->line('header_add_list')); } else echo "Add to List"; ?></a></li>
                        
						<li><a href="#" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="<?php if (count($userDetails)>0){if ($productDetails->row()->seller_product_id == $userDetails->row()->feature_product){ echo 'feature-selected';}else {echo 'feature';}}else {echo 'feature';}?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="feature_icon"></i><?php if($this->lang->line('product_feature') != '') { echo stripslashes($this->lang->line('product_feature')); } else echo "Feature on my profile"; ?> </a></li>
                        
						<li><a href="#" class="own <?php echo $ownClass;?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" tid="<?php echo $productDetails->row()->seller_product_id;?>"><i class="won_icon"></i><?php if($this->lang->line('product_i_ownit') != '') { echo stripslashes($this->lang->line('product_i_ownit')); } else echo "I own it"; ?></a></li>
                        
						<li><a href="<?php base_url();?>shopby/all?c=<?php echo $color;?>" class="color"><i class="color_icon"></i><?php if($this->lang->line('product_find_similar') != '') { echo stripslashes($this->lang->line('product_find_similar')); } else echo "Find similar colors"; ?></a></li>
                        
                        <li><a class="color" onclick="javascript:$(this).find('input').select()" id="short_url_link"><i style="background-position: -60px -60px;"></i><input type="text" readonly value="<?php echo base_url().'t/'.$productDetails->row()->short_url; ?>"/></a></li>

                    </ul>
                            
    					</div> -->

<!--<div class="detail_sidebar_list">
<h2 class="selstory-head detail_link_list">Follow us on Facebook</h2>
<div class="fb-like-box" data-href="https://www.facebook.com/socktail" data-width="245" data-height="240" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
</div>-->
                       
                        <div class="detail_sidebar_list">
                <?php 
                $store_name = $productDetails->row()->full_name;
                if ($store_name == ''){
	                $store_name = $productDetails->row()->user_name;
                }
                if ($store_name == '' && $productDetails->row()->user_id==0){
                	$store_name = 'Administrator';
                }
                ?>
                <h2 class="selstory-head detail_link_list">Popular Products..</h2>
				<div class="seller-details">
<!-- 				    <h3><a href="user/<?php echo $productDetails->row()->user_name;?>" class="url"><img src="images/users/<?php echo $store_img;?>" alt="<?php echo $productDetails->row()->full_name;?>" class="photo"></a>
					<div class="selname-story">
						<p><b><a href="user/<?php echo $productDetails->row()->user_name;?>"><?php echo $productDetails->row()->full_name;?></a></b>
						 : <?php echo word_limiter($productDetails->row()->about,16);?></p>
					</div>
				    </h3>
				    
				    <a href="#" class="follow-user-link <?php echo $followClass;?>" <?php if ($loginCheck==''){echo 'require_login="true"';}?> uid="<?php echo $productDetails->row()->user_id;?>"><?php echo $followText;?></a>
				    <div class="clear"></div>
 -->				    <ul>
					<?php 
					$limitProd = 0;
					if ($seller_product_details->num_rows()>0){
						foreach ($seller_product_details->result() as $seller_product_details_row){
							if ($limitProd==16)break;
							$limitProd++;
							$img = 'dummyProductImage.jpg';
							$imgArr = array_filter(explode(',', $seller_product_details_row->image));
							if (count($imgArr)>0){
								foreach ($imgArr as $imgRow){
									if ($imgRow != ''){
										$img = $imgRow;
										break;
									}
								}
							}
					?>
                    
					<li><a href="things/<?php echo $seller_product_details_row->id;?>/<?php echo url_title($seller_product_details_row->product_name,'-');?>" class="figure-img">
						<span style="background-image: url(<?php echo base_url();?>images/product/<?php echo $img;?>);"></span>
					</a></li>
					<?php 
						}
					}
					if ($limitProd<6 && $seller_affiliate_products->num_rows()>0){
						foreach ($seller_affiliate_products->result() as $seller_affiliate_products_row){
							if ($limitProd==6)break;
							$limitProd++;
							$img = 'dummyProductImage.jpg';
							$imgArr = array_filter(explode(',', $seller_affiliate_products_row->image));
							if (count($imgArr)>0){
								foreach ($imgArr as $imgRow){
									if ($imgRow != ''){
										$img = $imgRow;
										break;
									}
								}
							}
					?>
					<li><a href="user/<?php echo $productDetails->row()->user_name;?>/things/<?php echo $seller_affiliate_products_row->seller_product_id;?>/<?php echo url_title($seller_affiliate_products_row->product_name,'-');?>" class="figure-img">
						<span style="background-image: url(<?php echo base_url();?>images/product/<?php echo $img;?>);"></span>
					</a></li>
					<?php 
						}
					}
					?>
				    </ul>
				</div>
				<?php 
				?>
                
                
				<!-- / Seller Story -->

                
                
                

<!--Comment End-->


				</div>
					
				</section>
          
				<!-- / thing-section -->
				<hr>
			</aside>
			<!-- / sidebar -->

		
		<a href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>
				</div>
			<?php 
	}else {
	?>
			<div itemscope itemtype="http://schema.org/Product" class="wrapper-content right-sidebar" style="width:100%;">
			<p style="float:left;width:80%;padding:10%;text-align:center;font-size:17px;"><?php if($this->lang->line('fancy_prod_unavail') != '') { echo stripslashes($this->lang->line('fancy_prod_unavail')); } else echo "This product details not available"; ?></p>
<?php
// PHP permanent URL redirect
header("Location: http://socktail.com/shopby/all", true, 301);
exit();
?>

	<!--		<?php 
     $this->load->view('site/templates/footer_menu');
     ?> -->
		
		<a href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>
		</div>
	<?php }?>
		</div>
		<!-- / wrapper-content -->

		

	

	<!-- / container -->
			<?php 
     $this->load->view('site/templates/footer_menu');
     ?>
</div>

</div>

<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filesjquery_zoomer.js" type="text/javascript"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>selectbox.js"></script>
<script type="text/javascript" src="js/site/thing_page.js"></script>
<script type="text/javascript">
function increaseQty(){
	var mqty = $('.quantity').data('mqty');
	var oldQty = $('.quantity').val();
	if(oldQty-oldQty != 0){
		oldQty = 0;
	}
	if(oldQty<0){
		oldQty = 0;
	}
	oldQty++;
	if(oldQty>mqty){
		alert('<?php if($this->lang->line('max_stock_of_this_product_is') != '') { echo stripslashes($this->lang->line('max_stock_of_this_product_is')); } else echo "Maximum stock of this product is"; ?> '+mqty);
		oldQty = mqty;
	}
	$('.quantity').val(oldQty);
}
function decreaseQty(){
	var mqty = $('.quantity').data('mqty');
	var oldQty = $('.quantity').val();
	if(oldQty-oldQty != 0){
		oldQty = 1;
	}
	if(oldQty<0){
		oldQty = 1;
	}
	if(oldQty>1){
		oldQty--;
	}
	if(oldQty<1){
		oldQty = 1;
	}
	if(oldQty>mqty){
		alert('<?php if($this->lang->line('max_stock_of_this_product_is') != '') { echo stripslashes($this->lang->line('max_stock_of_this_product_is')); } else echo "Maximum stock of this product is"; ?> '+mqty);
		oldQty = mqty;
	}
	$('.quantity').val(oldQty);
}
function changeQty(e){
	$('.add_to_cart').disable(false);
	var mqty = $('.quantity').data('mqty');
	var oldQty = $(e).val();
	if(oldQty-oldQty != 0){
		oldQty = 1;
	}
	if(oldQty<0){
		oldQty = 1;
	}
	if(oldQty=='' || oldQty == '0'){
		$('.add_to_cart').disable();
	}
	if(oldQty>mqty){
		alert('<?php if($this->lang->line('max_stock_of_this_product_is') != '') { echo stripslashes($this->lang->line('max_stock_of_this_product_is')); } else echo "Maximum stock of this product is"; ?> '+mqty);
		oldQty = mqty;
	}
	$('.quantity').val(oldQty);
}
function changeAttrPrice(attr){
	var sale_price = $('#original_sale_price').val();
//	var old_price = $('#attr_'+attr).data('price');
	var attr_price = $('#attr_'+attr).val();
	if(attr_price == 0){
		attr_price = sale_price;
	}
//	var new_price = (parseInt(sale_price)-parseInt(old_price))+parseInt(attr_price);
//	$('#price').val(new_price);
	$('#price').val(attr_price);
//	$('#attr_'+attr).data('price',attr_price);
//	$('p.prices').find('span').text(new_price);
	$('p.prices').find('span').text(attr_price);
}
function changeAttrPricePopup(attr){
	var sale_price = $('#original_sale_price').val();
//	var old_price = $('#attr_'+attr).data('price');
	var attr_price = $('.attr_'+attr).val();
	if(attr_price == 0){
		attr_price = sale_price;
	}
//	var new_price = (parseInt(sale_price)-parseInt(old_price))+parseInt(attr_price);
//	$('#price').val(new_price);
	$('#price').val(attr_price);
//	$('#attr_'+attr).data('price',attr_price);
//	$('p.prices').find('span').text(new_price);
	$('p.prices').find('span').text(attr_price);
	$('p.price').find('span.popup_price').text(attr_price);
}
function changeAttrArr(attr){
	var attr_val = $('#attr_'+attr+' :selected').text();
	var attrStr = $('#attribute_values').val();
	var attrArr = attrStr.split("|");
	
	if(attrArr == ''){
		attrArr = new Array();
	}
	attrArr[attr] = attr_val;
//	$('#attribute_values').val(attrArr[]);
}
</script>
<style>
.feature-selected i.feature_icon{
	background-position: -45px -80px !important;
}
.own-selected i.won_icon{
	background-position: -77px -58px !important;
}
</style>
<?php
$this->load->view('site/templates/footer');
?>