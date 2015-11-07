<?php
$this->load->view('site/templates/header');
?>
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
     
<ul class="gnb-wrap" style="width:100%;max-width:1100px;font-size:13px;text-align:center;">
                      <?php 
                      foreach ($mainCategories->result() as $row){
                      	if ($row->cat_name != '' && $row->cat_name != 'Our Picks'){
                      ?>
            <li class="gnb" style="height:40px;text-align:left;">
              <a class="mn-gifts"  style="line-height: 40px;color:#555555;" href="shopby/<?php echo $row->seourl;?>"><?php echo $row->cat_name;?></a>



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
	<div class="container " style="padding: 98px 0 20px;">
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
		<!--<?php echo $breadCumps; ?> -->
				<div class="wrapper-content right-sidebar" style="background:none; box-shadow:none;">
			<div id="content" style="padding:0px; background:none;width: 680px;">
            
            <div class="detail_leftbar">
            
				<div class="figure-row first">
					<div class="figure-product figure-640 big">
						
						<figure>
							<span class="wrapper-fig-image">

								<span class="fig-image" style="background:#FFFFFF;"><img src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="<?php echo $productDetails->row()->product_name;?>"></span>
							</span>
<br>
<span class="icon-heart-filled" style="float: left;padding-right: 10px;color: firebrick;"><?php echo $productDetails->row()->likes; ?> Likes</span>
<!--<div style="float: right;" class="fb-like" data-href="<?php echo base_url();?>user/<?php echo $productUserDetails->row()->user_name;?>/things/<?php echo $productDetails->row()->seller_product_id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>"  data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>-->
<!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_default_style"style="float: right;">
<a class="a2a_dd" href="http://www.addtoany.com/share_save">Share</a>
<span class="a2a_divider"></span>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_google_plus"></a>
<a class="a2a_button_pinterest"></a>
<a class="a2a_button_whatsapp"></a>
<a class="a2a_button_google_gmail"></a>
</div>
<script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
                           
                            <h1 style="text-align:left;margin-top: 25px;"><?php echo $productDetails->row()->product_name;?></h1>

						    
                        </figure>
						
						
						<br class="hidden">
						
						<p style="text-align:left;">
						<?php if($this->lang->line('user_by') != '') { echo stripslashes($this->lang->line('user_by')); } else echo "by"; ?> <a class="username" href="user/<?php echo $productUserDetails->row()->user_name;?>"><?php echo $productUserDetails->row()->full_name;?></a>


<ul class="detail_thing_info1">
<li><a href="#" onclick="" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" class="list" id="show-add-to-list"><i class="icon-clipboard"></i>Add to Favorite list</a></li>
</ul>                        
   	                <!--                      <ul class="detail_thing_info1">
       <li><a href="user/<?php echo $productUserDetails->row()->user_name;?>/things/<?php echo $productDetails->row()->seller_product_id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>" id="show-someone" class="show" uid="<?php echo $loginCheck;?>" tid="<?php echo $productDetails->row()->id;?>" tname="<?php echo $productDetails->row()->product_name;?>" tuser="<?php if ($productDetails->row()->user_id != '0'){echo $productDetails->row()->full_name;}else {echo 'administrator';}?>" data-timage="<?php //echo base_url();?>images/product/<?php echo $img;?>" price="<?php echo $productDetails->row()->sale_price;?>" reacts="<?php echo $productDetails->row()->likes;?>" username="<?php if ($loginCheck != ''){if (count($userDetails)>0){echo $userDetails->row()->user_name;}}?>" action="buy" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="icon-forward-outline"></i><?php if($this->lang->line('header_share') != '') { echo stripslashes($this->lang->line('header_share')); } else echo "Share"; ?></a></li>









						<li><a href="#" onclick="" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" class="list" id="show-add-to-list"><i class="icon-clipboard"></i>Add to list</a></li>
						<li><a href="#" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="<?php if (count($userDetails)>0){if ($productDetails->row()->seller_product_id == $userDetails->row()->feature_product){ echo 'feature-selected';}else {echo 'feature';}}else {echo 'feature';}?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="icon-star"></i><?php if($this->lang->line('product_feature') != '') { echo stripslashes($this->lang->line('product_feature')); } else echo "Feature on my profile"; ?> </a></li>

						<?php if ($loginCheck != ''  && ($userDetails->row()->user_name == $productUserDetails->row()->user_name)){?>
						
                             <li><a id="edit-details" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit"><?php if($this->lang->line('product_edit_dtls') != '') { echo stripslashes($this->lang->line('product_edit_dtls')); } else echo "Edit details"; ?><i class="icon-pen"></i></a></li>
                                
                                
                                <li><a style="font-size: 11px; color: #f33;" uid="<?php echo $productUserDetails->row()->id;?>" thing_id="<?php echo $productDetails->row()->seller_product_id;?>" ntid="7220865" class="remove_new_thing" href="things/<?php echo $productDetails->row()->seller_product_id;?>/delete"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?><i class="icon-trash"></i></a></li>

          
						<?php }?>   
                        
                        </ul>             -->            
                        
						</p>
						

						<br class="hidden">
						
						<a href="#" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="button <?php echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?>><span><i></i></span><?php echo $fancyText;?></a>
						

					</div>
					<!-- / figure-product figure-640 -->
				</div>
				<!-- / figure-row -->

			<div class="TabbedPanelsContentGroup">
                          <div class="TabbedPanelsContent  TabbedPanelsContentVisible" style="display: block;font-size:14px;line-height: 24px;">
                          <?php  if ($productDetails->row()->excerpt!=''){echo $productDetails->row()->excerpt;}else {echo $productDetails->row()->description;} ?>

<div class="clear"></div> 
					<?php if ($productDetails->row()->web_link != ''){
			$web_link = $productDetails->row()->web_link;
			if (substr($web_link, 0,4) != 'http'){
				$web_link = 'http://'.$web_link;	
			}
			?>

<?php if ($productDetails->row()->sale_price<1) { ?> <a style="margin-top: 10px;color:blue;float: right;"target="_blank" rel="nofollow" href="<?php echo $web_link;?>">Check more details..</a> <?php } ?>
<?php } ?>
                          </div>
                        </div>

<div class="fb-comments" style="margin-top: 25px;margin-bottom: 15px;box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08), 0 0 2px rgba(0, 0, 0, 0.06), 0 0 0 1px rgba(0, 0, 0, 0.04), 0 -1px 0 0 rgba(0, 0, 0, 0.05) !important;
border-radius: 3px !important;" data-href="<?php echo base_url();?>user/<?php echo $productUserDetails->row()->user_name;?>/things/<?php echo $productDetails->row()->seller_product_id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>" data-width="630" data-numposts="5" data-colorscheme="light"></div>
				<?php 
				if ($relatedProductsArr->num_rows()>0 || count($affiliaterelatedProductsArr)>0){
				?>

</div>
                <div class="detail_leftbar1">
				<div class="might-fancy">
					<h3 class="selstory-head detail_link_list"><?php if($this->lang->line('giftcard_you_might') != '') { echo stripslashes($this->lang->line('giftcard_you_might')); } else echo "You might also"; ?> Like...</h3>
					<?php if($relatedProductsArr->num_rows()>0){?>
					<div style="height: 259px;padding-left: 19px;" class="figure-row fancy-suggestions anim might_box">
					<?php 
					$limitCount = 0;
					foreach ($relatedProductsArr->result() as $relatedRow){
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
							<div class="figure-product figure-200 might_box_list">
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
								<!--<span class="username"><a href="<?php if ($relatedRow->user_id != '0'){echo 'user/'.$relatedRow->user_name;}else {echo 'user/administrator';}?>"><?php if ($relatedRow->user_id != '0'){echo $relatedRow->full_name;}else {echo 'administrator';}?></a> <em>+ <?php echo $relatedRow->likes;?></em></span>-->
								<br class="hidden">
							<!--	<a href="#" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $relatedRow->seller_product_id;?>" class="button <?php echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?>><span><i></i></span><?php echo $fancyText;?></a>-->
							</div>
					<?php 
					}}
					?>
							</div>
					<?php }?>	
					
					<?php if($affiliaterelatedProductsArr->num_rows()>0){?>
					<div style="height: 259px;padding-left: 19px;" class="figure-row fancy-suggestions anim">
					<?php 
					$limitCount = 0;
					foreach ($affiliaterelatedProductsArr->result() as $relatedRow){
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
								<a href="<?php echo base_url();?>user/<?php echo $relatedRow->user_name;?>/things/<?php echo $relatedRow->seller_product_id; ?>/<?php echo url_title($relatedRow->product_name,'-');?>">
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
							<!--	<span class="username"><a href="<?php if ($relatedRow->user_id != '0'){echo 'user/'.$relatedRow->user_name;}else {echo 'user/administrator';}?>"><?php if ($relatedRow->user_id != '0'){echo $relatedRow->full_name;}else {echo 'administrator';}?></a> <em>+ <?php echo $relatedRow->likes;?></em></span> -->
								<br class="hidden">
							<!--	<a href="#" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $relatedRow->seller_product_id;?>" class="button <?php echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?>><span><i></i></span><?php echo $fancyText;?></a>-->
							</div>
					<?php 
					}}
					?>
							</div>
					<?php }?>


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
            
		</div>	<!-- / content -->

         

			<aside id="sidebar" style="padding:0px; width: 255px;">
          
				<section class="thing-section gift-section">
				<?php 
				if ($productDetails->row()->sale_price>0){
				?>                
               		<div class="detail_sidebar">
                
                	<p class="prices">
						<strong class="price"><?php echo $currencySymbol;?><span id="SalePrice"><?php echo $productDetails->row()->sale_price;?></span></strong> <?php echo $currencyType;?><br>
						
					</p>
					<?php if ($productDetails->row()->web_link != ''){
			$web_link = $productDetails->row()->web_link;
			if (substr($web_link, 0,4) != 'http'){
				$web_link = 'http://'.$web_link;	
			}
			?>
<li><a target="_blank" rel="nofollow" href="<?php echo $web_link;?>"><input type="button" class="greencart add_to_cart" value="Buy at Seller's Site" /> </a></li>
<?php } ?>
  
                    </div>
			                    <?php }
                    ?>








						<?php 
						if ($productDetails->row()->user_id == $loginCheck){
						?>

                    <div class="detail_sidebar_list">
                        
							<h3 class="detail_link_list"><?php if($this->lang->line('actions') != '') { echo stripslashes($this->lang->line('actions')); } else echo "Actions"; ?></h3>
                    
					<ul class="thing-info">
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
		$ownClass = '';
		if ($loginCheck != ''){
			$ownArr = explode(',', $userDetails->row()->own_products);
			if (in_array($productDetails->row()->seller_product_id, $ownArr)){
				$ownClass = 'own-selected';
			}
		}
		if ($productDetails->row()->web_link != ''){
			$web_link = $productDetails->row()->web_link;
			if (substr($web_link, 0,4) != 'http'){
				$web_link = 'http://'.$web_link;	
			}
}?>


                            <li><a id="edit-details" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit"><i class="icon-pen"></i><?php if($this->lang->line('product_edit_dtls') != '') { echo stripslashes($this->lang->line('product_edit_dtls')); } else echo "Edit details"; ?></a></li>
                                
                                
                                <li><a uid="<?php echo $productUserDetails->row()->id;?>" thing_id="<?php echo $productDetails->row()->seller_product_id;?>" ntid="7220865" class="remove_new_thing" href="things/<?php echo $productDetails->row()->seller_product_id;?>/delete"><i class="icon-trash"></i><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?></a></li>

						<li><a ntoid="15301425" ntid="<?php echo $productDetails->row()->seller_product_id;?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" class="sell" href="#"><i class="icon-basket-1"></i><?php if($this->lang->line('product_want_sell') != '') { echo stripslashes($this->lang->line('product_want_sell')); } else echo "I want to sell it"; ?></a></li>
<!--<li><a href="#" class="own <?php echo $ownClass;?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" tid="<?php echo $productDetails->row()->seller_product_id;?>"><i class="icon-briefcase-1"></i><?php if($this->lang->line('product_i_ownit') != '') { echo stripslashes($this->lang->line('product_i_ownit')); } else echo "I own it"; ?></a></li> -->

	<li><a href="#" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="<?php if (count($userDetails)>0){if ($productDetails->row()->seller_product_id == $userDetails->row()->feature_product){ echo 'feature-selected';}else {echo 'feature';}}else {echo 'feature';}?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="icon-star"></i><?php if($this->lang->line('product_feature') != '') { echo stripslashes($this->lang->line('product_feature')); } else echo "Feature on my profile"; ?> </a></li>
                        <li ><a class="color" onclick="javascript:$(this).find('input').select()" id="short_url_link"><i class="icon-link-outline"></i><input type="text" readonly value="<?php echo base_url().'t/'.$productDetails->row()->short_url; ?>"/></a></li>

					<!--	<li><a href="user/<?php echo $productUserDetails->row()->user_name;?>/things/<?php echo $productDetails->row()->seller_product_id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>" id="show-someone" class="show" uid="<?php echo $loginCheck;?>" tid="<?php echo $productDetails->row()->id;?>" tname="<?php echo $productDetails->row()->product_name;?>" tuser="<?php if ($productDetails->row()->user_id != '0'){echo $productDetails->row()->full_name;}else {echo 'administrator';}?>" data-timage="<?php //echo base_url();?>images/product/<?php echo $img;?>" price="<?php echo $productDetails->row()->sale_price;?>" reacts="<?php echo $productDetails->row()->likes;?>" username="<?php if ($loginCheck != ''){if (count($userDetails)>0){echo $userDetails->row()->user_name;}}?>" action="buy" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="icon-forward-outline"></i><?php if($this->lang->line('header_share') != '') { echo stripslashes($this->lang->line('header_share')); } else echo "Share"; ?></a></li> -->


					<!--	<li><a href="#" onclick="" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" class="list" id="show-add-to-list"><i class="icon-clipboard"></i>Add to list</a></li> -->
					

                    </ul>
                    
                    </div>
						<?php 
						}
						?>


<div class="detail_sidebar_list">
<h2 class="selstory-head detail_link_list">Follow us on Facebook</h2>
<!--<div class="seller-details">
<div class="fb-facepile" style="padding:10px 20px 20px 20px;" data-app-id="383102725159240" data-href="https://www.facebook.com/socktail" data-action="socktaildotcom:use" data-width="230" data-height="20" data-max-rows="1" data-colorscheme="light" data-size="medium" data-show-count="true">
</div>
<button style="margin: 10px 10px 10px 30px;" class="btn-invite social" value="Sign up with Facebook" onclick="window.location.href='facebook/user.php'">
<span class="icon-facebook-2"></span> <b>Follow us on Facebook</b>
</button>
<p style="font-size:10px; text-align:center;"> we won't post on your wall without your permission</p> 
</div>-->
<div class="fb-like-box" data-href="https://www.facebook.com/socktail" data-width="250" data-height="240" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
</div>




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
                <h2 class="selstory-head detail_link_list"><?php if($this->lang->line('more_from') != '') { echo stripslashes($this->lang->line('more_from')); } else echo "More from";?>  <a href="<?php if ($productDetails->row()->user_id != '0'){echo base_url().'user/'.$productDetails->row()->user_name;}else {echo base_url().'user/administrator';}?>" class="username"><?php if ($productDetails->row()->user_id != '0'){echo $productDetails->row()->full_name;}else {echo 'administrator';}?></a></h2>
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
					if ($seller_affiliate_products->num_rows()>0){
						foreach ($seller_affiliate_products->result() as $seller_product_details_row){
							if ($limitProd==6)break;
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
                    
					<li><a href="user/<?php echo $productDetails->row()->user_name;?>/things/<?php echo $seller_product_details_row->seller_product_id;?>/<?php echo url_title($seller_product_details_row->product_name,'-');?>" class="figure-img">
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

		</div>
		<!-- / wrapper-content -->


		<a href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>

	</div>
	<?php 
	}else {
	?>
	<p><?php if($this->lang->line('fancy_prod_unavail') != '') { echo stripslashes($this->lang->line('fancy_prod_unavail')); } else echo "This product details not available"; ?></p>
<?php
// PHP permanent URL redirect
header("Location: http://socktail.com/shopby/all", true, 301);
exit();
?>
	<?php }?>


	<!-- / container -->

</div>
		<?php 
     $this->load->view('site/templates/footer_menu');
     ?>
</div>

<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filesjquery_zoomer.js" type="text/javascript"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>selectbox.js"></script>
<script type="text/javascript" src="js/site/thing_page.js"></script>
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