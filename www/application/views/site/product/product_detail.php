<?php
$this->load->view('site/templates/header_new');
?>

			<!--breadcrumbs-->
			
			<div class="breadcrumbs bg_grey_light_2 fs_medium fw_light">
				<div class="container">
				<?php echo $breadCumps; ?> 
				</div>
			</div>
            
			<!--main content-->
			<div class="page_section_offset">
				<div class="container">
					<div class="row">
						<section class="col-lg-9 col-md-9 col-sm-9 m_xs_bottom_30">
							<main class="clearfix m_bottom_40 m_xs_bottom_30">
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
									}
									
									$fancyClass = 'addToFavourite';
									$fancyText = LIKE_BUTTON;
									if (count($likedProducts)>0 && $likedProducts->num_rows()>0){
										foreach ($likedProducts->result() as $likeProRow){
											if ($likeProRow->product_id == $productDetails->row()->seller_product_id){
												$fancyClass = 'addedToFavourite';$fancyText = LIKED_BUTTON;break;
											}
										}
									}
								?>	
								<div class="product_preview f_left f_xs_none wrapper m_xs_bottom_15">
									<div class="d_block relative r_image_container">
										<img id="zoom" src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="<?php echo $productDetails->row()->product_name;?>" data-zoom-image="<?php echo base_url();?>images/product/<?php echo $img;?>">
									</div>
									<!--thumbnails-->
									<div class="product_thumbnails_wrap relative m_bottom_3">
										<div class="owl-carousel" id="thumbnails" data-nav="thumbnails_product_" data-owl-carousel-options='{
											"responsive" : {
												"0" : {
													"items" : 3
												},
												"321" : {
													"items" : 4
												},
												"769" : {
													"items" : 2
												},
												"992" : {
													"items" : 3
												}
											},
											"stagePadding" : 40,
											"margin" : 10,
											"URLhashListener" : false
										}'>	
                                        
										<?php 
										$limitCount = 0;
										$imgArr = explode(',', $productDetails->row()->image);
										if (count($imgArr)>0){
											foreach ($imgArr as $imgRow){
												if ($limitCount>5)break;
												if ($imgRow != '' && $imgRow != $pimg){
													$limitCount++;
										?>
						  					<a href="<?php echo base_url().PRODUCTPATH.$imgRow;?>" data-image="<?php echo base_url().PRODUCTPATH.$imgRow;?>" data-zoom-image="<?php echo base_url();?>images/product/<?php echo $imgRow;?>" class="d_block">
												<img src="<?php echo base_url();?>images/product/<?php echo $imgRow;?>" alt="">
											</a>
                                            
						<?php 
								}
							}
						}
						?>
										
										</div>
						<?php 
						if (count($imgArr)>2){ ?>
										<button class="thumbnails_product_prev black_hover button_type_4 grey state_2 tr_all d_block vc_child"><i class="fa fa-angle-left d_inline_m"></i></button>
										<button class="thumbnails_product_next black_hover button_type_4 grey state_2 tr_all d_block vc_child"><i class="fa fa-angle-right d_inline_m"></i></button>
									
							<?php 		}
						?>
						</div>
						
							<?php if ($loginCheck != ''  && ($userDetails->row()->id == $productDetails->row()->user_id)){?>
							<ul>
								<li><a id="edit-details" class="button_type_2 d_block f_sm_none m_sm_bottom_3 t_align_c lbrown state_2 tr_all second_font fs_medium tt_uppercase f_left m_right_3 product_button" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit"><?php if($this->lang->line('product_edit_dtls') != '') { echo stripslashes($this->lang->line('product_edit_dtls')); } else echo "Edit Product"; ?></a></li>
								<li><a uid="<?php echo $productDetails->row()->user_id;?>" thing_id="<?php echo $productDetails->row()->seller_product_id;?>" ntid="7220865" class="remove_new_thing button_type_2 d_block f_sm_none m_sm_bottom_3 t_align_c lbrown state_2 tr_all second_font fs_medium tt_uppercase f_left m_right_3 product_button" href="things/<?php echo $productDetails->row()->seller_product_id;?>/delete"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?></a></li>
							</ul>
							<?php }?>  

                    
								</div>
								<div class="product_description f_left f_xs_none" id="product_description">
									<div class="wrapper">
										<h4 class="second_font m_bottom_10 f_left product_title"><a href="#" class="sc_hover"><?php echo $productDetails->row()->product_name;?></a></h4>
										
										<!--<a href="#" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="button <?php echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?>><span><i></i></span><?php echo $fancyText;?></a> -->
				
								

									</div>
									<ul class="m_bottom_14">
										<li class="m_bottom_3"><span class="project_list_title second_font d_inline_b">Dispatched in:</span> <span class="fw_light"> <?php $shipping = $productDetails->row()->shipping;
                       
                       
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
                       ?></span></li>
										<li class="m_bottom_3"><span class="project_list_title second_font d_inline_b">Shipping Cost:</span><span class="fw_light"> <?php echo $currencySymbol;?> <?php echo $productDetails->row()->shipping_cost;?></span></li>
										<li class="m_bottom_3"><span class="project_list_title second_font d_inline_b">SKU Code:</span> <span class="fw_light"> <?php echo $productDetails->row()->sku;?></span></li>
									</ul>
									<table class="w_full">
										<tbody>
											<tr>
												<td class="scheme_color">
													<p class="fw_light m_top_5 m_bottom_7 m_xs_top_0 m_xs_bottom_0">Our Price:</p>
													<b><div><span class="fs_big second_font d_block m_bottom_7 m_xs_bottom_0 fs_sm_default" style="float:left;"><?php echo $currencySymbol;?>&nbsp; </span><span id="SalePrice" class="fs_big second_font d_block m_bottom_7 m_xs_bottom_0 fs_sm_default"> <?php echo number_format($productDetails->row()->sale_price);?></span></div></b>
												</td>
                                                <?php if ($productDetails->row()->price>$productDetails->row()->sale_price){ ?>
												<td class="color_light">
													<p class="fw_light m_top_5 m_bottom_7 m_xs_top_0 m_xs_bottom_0">Old Price:</p>
													<b class="fs_big second_font d_block m_bottom_7 m_xs_bottom_0 fs_sm_default"><?php echo $currencySymbol;?><?php echo number_format($productDetails->row()->price); ?></b>
												</td>
												<td class="color_blue">
													<p class="fw_light m_top_5 m_bottom_7 m_xs_top_0 m_xs_bottom_0">You Save:</p>
													<b class="fs_big second_font d_block m_bottom_7 m_xs_bottom_0 fs_sm_default"><?php echo $currencySymbol;?><?php echo number_format($productDetails->row()->price-$productDetails->row()->sale_price); ?></b>
												</td>
                                                <?php }?>												
											</tr>
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
			    <input type="hidden" class="option number" name="product_id" id="product_id" value="<?php echo $productDetails->row()->id;?>">
                <input type="hidden" class="option number" name="cateory_id" id="cateory_id" value="<?php echo $productDetails->row()->category_id;?>">                
                <input type="hidden" class="option number" name="sell_id" id="sell_id" value="<?php echo $productDetails->row()->user_id;?>">
                <input type="hidden" class="option number" name="price" id="price" value="<?php echo $productDetails->row()->sale_price;?>">
                <input type="hidden" class="option number" name="product_shipping_cost" id="product_shipping_cost" value="<?php echo $productDetails->row()->shipping_cost;?>"> 
                <input type="hidden" class="option number" name="product_tax_cost" id="product_tax_cost" value="<?php echo $productDetails->row()->tax_cost;?>">
                <input type="hidden" class="option number" name="attribute_values" id="attribute_values" value="<?php echo $attrValsSetLoad; ?>">
										<?php if($discPrice != ''){?>
											<tr>
												<td colspan="3" class="bg_blue border_blue color_white">
													<div class="m_top_2 m_bottom_6"><span class="fw_light d_inline_m m_right_5">Use Coupon Code <div style="color: #d6a916;font-weight:bold;font-size:13px;display:inline-block;">"<?php echo $couponCode;?>"</div> to Get Additional <?php echo number_format($discVal);?>% DIscount</span></div>
												</td>
											</tr>
										<?php }?>
										</tbody>
									</table>
                  <div class="product_options bt_none">
				  						 <?php  
                   	$attrValsSetLoad = ''; //echo '<pre>'; print_r($PrdAttrVal->result_array()); 
					if($PrdAttrVal->num_rows>0){ 
						$attrValsSetLoad = $PrdAttrVal->row()->pid; 
					?>
									<div>
										<b class="second_font d_block m_bottom_10">Available Options</b>
										<div class="relative m_bottom_15">
											<select class="select-round select-shipping-addr select_title fs_medium fw_light color_light relative tr_all" id="attr_name_id" name="attr_name_id" onchange="ajaxCartAttributeChange(this.value,'<?php echo $productDetails->row()->id; ?>');">
											<option value="0"><div class="select_title type_2 fs_medium fw_light color_light relative d_none tr_all">--------------- <?php echo "Select"; ?> ---------------</div></option>
											    <?php foreach($PrdAttrVal->result_array() as $Prdattrvals ){ ?>
													<option value="<?php echo $Prdattrvals['pid']; ?>"><?php echo $Prdattrvals['attr_type'].':  '.$Prdattrvals['attr_name']; ?></option>
						                        <?php } ?>
											</select>
											<div class="alert_box error relative m_bottom_10 fw_light" id="AttrErr" style="margin-top: 10px; display:none;">
											</div>								
										</div>
									</div>
									              <?php } ?>

										<footer class="bg_grey_light_2">
											<div class="clearfix m_top_7">
												<div class="quantity clearfix t_align_c f_left f_md_none m_right_10 m_md_bottom_3">
													<button class="f_left d_block minus black_hover tr_all bg_white">-</button>
													<input type="text" id="quantity" value="1" name="" data-mqty="<?php echo $productDetails->row()->quantity;?>" min="1" readonly="" class="f_left color_light orderQuantity">
													<button class="f_left d_block black_hover tr_all bg_white">+</button>
												</div>
												<br class="d_md_block d_none">
												
												<button  class="add_to_cart button_type_2 d_block f_sm_none m_sm_bottom_3 t_align_c lbrown state_2 tr_all second_font fs_medium tt_uppercase f_left m_right_3 product_button"
												<?php if ($loginCheck==''){echo 'require_login="true"';}?> name="addtocart" value="<?php if($this->lang->line('header_add_cart') != '') { echo stripslashes($this->lang->line('header_add_cart')); } else echo "Add to Cart"; ?>" onclick="ajax_add_cart('<?php echo $PrdAttrVal->num_rows; ?>');"
												><i class="fa fa-shopping-cart d_inline_m m_right_9"></i>Add To Cart</button>
												
												<button id="like_product" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $productDetails->row()->seller_product_id;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?> style="<?php if($fancyClass == "addedToFavourite"){echo "color:darkred !important"; };?>" class="<?php echo $fancyClass?> button_type_8 grey state_2 tr_delay color_dark t_align_c vc_child f_right m_right_3 tooltip_container relative button "><i class="fa fa-heart fs_large d_inline_m"></i><span class="tooltip top fs_small color_white hidden animated" data-show="fadeInDown" data-hide="fadeOutUp">
												<?php if($fancyClass == "addedToFavourite"){echo "Remove from Wishlist"; }else echo "Add to Wishlist";?>
												</span></button>
											</div>
										</footer>
									</div>

								</div>
							</main>
							<!--tabs-->
							<div class="tabs styled_tabs m_bottom_18">
								<nav class="second_font">
									<ul class="hr_list">
										<li class="m_right_3"><a href="#tab1" class="color_light border_light_3 d_block"><?php if($this->lang->line('item_details') != '') { echo stripslashes($this->lang->line('item_details')); } else echo "Item Details"; ?></a></li>
										<li class="m_right_3"><a href="#tab2" class="color_light border_light_3 d_block"><?php if($this->lang->line('shipping_policies') != '') { echo stripslashes($this->lang->line('shipping_policies')); } else echo "Shipping & Policies"; ?></a></li>
										
										<?php 
											$furCatArr = array('7','14','26','27','29','237');
											$prodCat = $productDetails->row()->category_id;
											$prodCatArr = @explode(',',$prodCat);
											$combArr = array_merge($furCatArr, $prodCatArr);
											$combArr1 = array_unique($combArr);
											if(count($combArr) != count($combArr1)){?>  
												<li class="m_right_3"><a href="#tab3" class="color_light border_light_3 d_block">Furniture Care</a></li>											
										<?php } ?>

										<?php if($productDetails->row()->listvalue == 'Sheesham Wood' || $productDetails->row()->listvalue == 'Mango Wood' || $productDetails->row()->listvalue == 'Solid Wood'){?>
											<li class="m_right_3"><a href="#tab4" class="color_light border_light_3 d_block">Color Guide</a></li>
										<?php } ?>

									</ul>
								</nav>
								<hr class="d_xs_none">
								<div id="tab1" class="fw_light tab_content">
									<p class="m_bottom_13">
										<?php  echo $productDetails->row()->description; ?><div class="clear"></div> 
									</p>
								</div>
								<div id="tab2" class="tab_content">
									<p class="m_bottom_13">
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
									</p>
								</div>
								<?php 
									$furCatArr = array('7','14','26','27','29','237');
									$prodCat = $productDetails->row()->category_id;
									$prodCatArr = @explode(',',$prodCat);
									$combArr = array_merge($furCatArr, $prodCatArr);
									$combArr1 = array_unique($combArr);
									if(count($combArr) != count($combArr1)){?>  
								
															
									<div id="tab3" class="tab_content">
									<p class="m_bottom_13">
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
										"; ?>
									</p>
								</div>
										<?php } ?>
										
								<?php if($productDetails->row()->listvalue == 'Sheesham Wood' || $productDetails->row()->listvalue == 'Mango Wood' || $productDetails->row()->listvalue == 'Solid Wood'){?>
																		
									<div id="tab4" class="tab_content">
										<p class="m_bottom_13">
											<img src="/images/Color Guide Sheesham Wood.png" alt="Sheesham Wood Color Guide"  style="width: 590px;height: 443px;">
										</p>
									</div>
								<?php } ?>
							</div>
						</section>
						<script>
						//var baseURL = '<?php echo base_url();?>';
$(function() {
$(".submit").click(function() {
	var requirelogin = $(this).attr('require-login');
	if(requirelogin){
		var thingURL = $(this).parent().next().find('a:first').attr('href');
		window.location = baseURL+thingURL;
		return false;
	}
	var comments = $("#comments").val();
	var number = $("#reviewer_number").val();
	var email = $("#reviewer_email").val();
	
	var product_id = $("#cproduct_id").val();
	var messgaeString = "Comment:" + comments + "----------Number:" + number + "-----------Email:" + email;
    var dataString = '&comments=' + messgaeString + '&cproduct_id=' + product_id;
	
	if(comments=='' || number=='' || email=='')
     {
		$("#customMessageAlert").show();
     }
	else
	{
			$("#customMessageAlert").hide();
$.ajax({
  type: "POST",
  url: baseURL+'site/order/insert_product_comment',
  data: dataString,
  cache: false,
  dataType:'json',
  success: function(json){
		if(json.status_code == 1){
				//$('#custmConfirmation').modal('show');
				alert('<?php echo "We have got your requirements, our team will be in touch with you shortly.."; ?>');
				$("#New_Comment").append( '<li><a class="milestone" id="comment-1866615"></a><p class="c-text">'+ comments +'</p><p style="float:left;width:100%;text-align:left;font-size: 11px; color: #188A0E;"><a style="font-size: 11px; color: #f33;margin-left:10px" onclick="javascript:deleteCmt(this);" data-tid="<?php echo $productDetails->row()->seller_product_id;?>" data-cid="'+ json.comment_ID +'"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?></a></p></li>' );
				//window.location.reload();
			}
    document.getElementById('comments').value='';
	var number = $("#reviewer_number").val("");
	var email = $("#reviewer_email").val("");
	$("#flash").hide();
	
  }
 });
}
return false;
	});
});
</script> 
						<aside class="col-lg-3 col-md-3 col-sm-3">
									<div class="represent_wrap widget clearfix m_bottom_30">
										<h5 class="second_font color_dark tt_uppercase fw_light d_inline_m m_bottom_23">Customize This Product</h5>
										<form method="post">
										<input type="hidden" name="cproduct_id" id="cproduct_id" value="<?php echo $productDetails->row()->seller_product_id;?>"/>
										<input type="hidden" name="user_id" id="user_id" value="<?php echo $loginCheck ;?>"/>
											<ul>
												<li class="m_bottom_9">
													<textarea class="tr_all w_full fw_light fs_medium color_light" id="comments" name="comments" placeholder="Tell us size, finish and more.." rows="3"></textarea>
												</li>
												<li class="m_bottom_15">
													<label for="reviewer_name" class="second_font required clickable d_inline_b m_bottom_5">Your Contact Number</label><br>
													<input type="text" class="tr_all w_full fw_light fs_medium color_light" id="reviewer_number" name="">
												</li>
												<li class="m_bottom_15">
													<label for="reviewer_name" class="second_font required clickable d_inline_b m_bottom_5">Your Email ID</label><br>
													<input type="text" class="tr_all w_full fw_light fs_medium color_light" id="reviewer_email" name="">
												</li>
												<li class="clearfix">
													<button type="submit" class="button_type_2 d_block f_sm_none m_sm_bottom_3 t_align_c lbrown state_2 tr_all second_font fs_medium tt_uppercase f_left m_right_3 submit button"><span class="d_inline_b m_left_10 m_right_10">Send Customization Request</span></button>
												</li>
												<div class="alert_box error relative m_bottom_10 fw_light" id= "customMessageAlert" style="margin-top:10px;display:none">
													Please Fill All the Fields.
												</div>
											</ul>
										</form>
									</div>
									<div class="represent_wrap widget clearfix m_bottom_30">
										<section class="item_represent m_bottom_3 type_2 h_inherit t_sm_align_c bg_grey_light_2 tr_delay">
											<div class="d_inline_m m_xs_bottom_0 color_lbrown icon_wrap_1 t_align_c vc_child"><i class="fa fa-money d_inline_m"></i></div>
											<div class="description d_inline_m lh_medium">
												<p class="color_dark second_font m_bottom_2 fs_large"><b>Cash on Delivery</b></p>
												<small class="fw_light">Cash on delivery upto order of 20K<a class="sc_hover second_font fw_default" href="pages/faq"><br>Read More</a></small>
											</div>
										</section>
										<section class="item_represent m_bottom_3 type_2 h_inherit t_sm_align_c bg_grey_light_2 tr_delay">
											<div class="d_inline_m m_xs_bottom_0 color_lbrown icon_wrap_1 t_align_c vc_child"><i class="fa fa-truck d_inline_m"></i></div>
											<div class="description d_inline_m lh_medium">
												<p class="color_dark second_font m_bottom_2 fs_large"><b>Free Delivery</b></p>
												<small class="fw_light">Free door step delivery across India<a class="sc_hover second_font fw_default" href="pages/faq"><br>Read More</a></small>
											</div>
										</section>
										<section class="item_represent m_bottom_3 type_2 h_inherit t_sm_align_c bg_grey_light_2 tr_delay">
											<div class="d_inline_m m_xs_bottom_0 color_lbrown icon_wrap_1 t_align_c vc_child"><i class="fa fa-wrench d_inline_m"></i></div>
											<div class="description d_inline_m lh_medium">
												<p class="color_dark second_font m_bottom_2 fs_large"><b>Free Installation</b></p>
												<small class="fw_light">Free installation of all products <a class="sc_hover second_font fw_default" href="pages/faq"><br>Read More</a></small>
											</div>
										</section>
										<section class="item_represent m_bottom_3 type_2 h_inherit t_sm_align_c bg_grey_light_2 tr_delay">
											<div class="d_inline_m m_xs_bottom_0 color_lbrown icon_wrap_1 t_align_c vc_child"><i class="fa fa-certificate d_inline_m"></i></div>
											<div class="description d_inline_m lh_medium">
												<p class="color_dark second_font m_bottom_2 fs_large"><b>Quality Assurance</b></p>
												<small class="fw_light">Six months warranty <a class="sc_hover second_font fw_default" href="pages/faq"><br>Read More</a></small>
											</div>
										</section>
									</div>
						</aside>
					</div>
                    				<?php 
				if (count($relatedProductsArr)>0 || count($affiliaterelatedProductsArr)>0){
				?>
					<section>
						<h5 class="second_font color_dark tt_uppercase fw_light d_inline_m m_bottom_13">Related Products</h5>
						<hr class="divider_bg m_bottom_30">
						<div class="row">
                        <?php 
					$limitCount = 0;
					foreach ($relatedProductsArr as $relatedRow){
						if ($limitCount<4){
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
					?>
							<div class="col-lg-3 col-md-3 col-sm-3 m_bottom_30">
								<figure class="relative r_image_container c_image_container qv_container">
									<div class="relative m_bottom_15">
									<a href="<?php echo base_url();?>things/<?php echo $relatedRow->id;?>/<?php echo url_title($relatedRow->product_name,'-');?>" class="second_font sc_hover">
										<div>
											<img class="c_image_1 tr_all" alt="<?php echo $relatedRow->product_name;?>" src="<?php echo base_url();?>images/product/<?php echo $img;?>">
											<img class="c_image_2 tr_all" alt="<?php echo $relatedRow->product_name;?>" src="<?php echo base_url();?>images/product/<?php echo $img;?>">
										</div>
									</a>
									</div>
									<figcaption class="t_align_c">
										<ul>
											<li><a href="<?php echo base_url();?>things/<?php echo $relatedRow->id;?>/<?php echo url_title($relatedRow->product_name,'-');?>" class="second_font sc_hover"><?php echo $relatedRow->product_name;?></a></li>
										</ul>
									</figcaption>
								</figure>
							</div>
                            					<?php 
					}
				}?>
					
						</div>
					</section>
								<?php }?>
				</div>
			</div>
<?php
$this->load->view('site/templates/footer');
?>
		</div>


		<!--back to top-->
		<button class="back_to_top animated button_type_6 grey state_2 d_block black_hover f_left vc_child tr_all"><i class="fa fa-angle-up d_inline_m"></i></button>

		<!--popup-->
		<div class="init_popup" id="add_to_cart_popup">
			<div class="popup init">
				<div class="clearfix m_bottom_15">
					<p class="second_font fs_large color_dark">1 x <?php echo $productDetails->row()->product_name;?><br> is added to your cart</p>
				</div>
				<div class="clearfix">
					<a href="#" class="button_type_2 d_block f_left t_align_c grey state_2 tr_all second_font fs_medium tt_uppercase m_top_15">Continue Shopping</a>
					<a href="pages_shopping_cart.html" class="button_type_2 d_block f_right t_align_c grey state_2 tr_all second_font fs_medium tt_uppercase m_top_15">Show Cart</a>
				</div>
				<button class="close_popup fw_light fs_large tr_all">x</button>
			</div>
		</div>

		<!--popup-->
		<div class="init_popup" id="quick_view">
			<div class="popup init">
				<div class="clearfix">
					<div class="product_preview f_left f_xs_none wrapper m_xs_bottom_15">
						<div class="d_block relative r_image_container">
							<img id="zoom" src="images/product_img_0.jpg" alt="" data-zoom-image="images/p_image1.jpg">
							<div class="product_label fs_ex_small circle color_white bg_lbrown t_align_c vc_child tt_uppercase"><i class="d_inline_m">Sale!</i></div>
						</div>
						<!--thumbnails-->
						<div class="product_thumbnails_wrap relative m_bottom_3">
							<div class="owl-carousel" id="thumbnails" data-nav="thumbnails_product_" data-owl-carousel-options='{
								"responsive" : {
									"0" : {
										"items" : 3
									},
									"321" : {
										"items" : 4
									},
									"769" : {
										"items" : 2
									},
									"992" : {
										"items" : 3
									}
								},
								"stagePadding" : 40,
								"margin" : 10,
								"URLhashListener" : false
							}'>	
								<a href="#" data-image="images/product_img_0.jpg" data-zoom-image="images/p_image1.jpg" class="d_block">
									<img src="images/product_thumb_1.jpg" alt="">
								</a>
								<a href="#" data-image="images/product_img_1.jpg" data-zoom-image="images/p_image2.jpg" class="d_block">
									<img src="images/product_thumb_2.jpg" alt="">
								</a>
								<a href="#" data-image="images/product_img_2.jpg" data-zoom-image="images/p_image3.jpg" class="d_block">
									<img src="images/product_thumb_3.jpg" alt="">
								</a>
								<a href="#" data-image="images/product_img_3.jpg" data-zoom-image="images/p_image4.jpg" class="d_block">
									<img src="images/product_thumb_4.jpg" alt="">
								</a>
								<a href="#" data-image="images/product_img_6.jpg" data-zoom-image="images/p_image7.jpg" class="d_block">
									<img src="images/product_thumb_5.jpg" alt="">
								</a>
								<a href="#" data-image="images/product_img_9.jpg" data-zoom-image="images/p_image10.jpg" class="d_block">
									<img src="images/product_thumb_6.jpg" alt="">
								</a>
								<a href="#" data-image="images/product_img_4.jpg" data-zoom-image="images/p_image5.jpg" class="d_block">
									<img src="images/product_thumb_7.jpg" alt="">
								</a>
								<a href="#" data-image="images/product_img_7.jpg" data-zoom-image="images/p_image8.jpg" class="d_block">
									<img src="images/product_thumb_8.jpg" alt="">
								</a>
								<a href="#" data-image="images/product_img_5.jpg" data-zoom-image="images/p_image6.jpg" class="d_block">
									<img src="images/product_thumb_9.jpg" alt="">
								</a>
								<a href="#" data-image="images/product_img_8.jpg" data-zoom-image="images/p_image9.jpg" class="d_block">
									<img src="images/product_thumb_10.jpg" alt="">
								</a>
							</div>
							<button class="thumbnails_product_prev black_hover button_type_4 grey state_2 tr_all d_block vc_child"><i class="fa fa-angle-left d_inline_m"></i></button>
							<button class="thumbnails_product_next black_hover button_type_4 grey state_2 tr_all d_block vc_child"><i class="fa fa-angle-right d_inline_m"></i></button>
						</div>
					</div>
					<div class="product_description f_left f_xs_none">
						<h3 class="second_font m_bottom_3 product_title"><a href="#" class="sc_hover">Sed in lacus ut enim</a></h3>
						<ul class="m_bottom_14">
										<li class="m_bottom_3"><span class="project_list_title second_font d_inline_b">Dispatched in:</span> <span class="color_dark fw_light">Chanel</span></li>
										<li class="m_bottom_3"><span class="project_list_title second_font d_inline_b">Shipping Cost:</span> <span class="scheme_color fw_light">in stock</span> <span class="fw_light">20 items(s)</span></li>
										<li class="m_bottom_3"><span class="project_list_title second_font d_inline_b">SKU Code:</span> <span class="fw_light">PS06</span></li>
						</ul>
						<hr class="divider_light m_bottom_15">
						<p class="fw_light m_bottom_14 color_grey">Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis.</p>
						<div class="product_options">
							<b class="second_font d_block m_bottom_10">Available Options</b>
							<p class="second_font m_bottom_3">Size:</p>
							<div class="styled_select size_select relative m_bottom_15">
								<div class="select_title type_2 fs_medium fw_light color_light relative d_none tr_all">Select</div>
								<select>
									<option value="0"><?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "Select"; ?></option>
									<option value="King">King</option>
									<option value="Grand">Grand</option>
								</select>
								<ul class="options_list d_none tr_all hidden bg_grey_light_2"></ul>
							</div>
							<hr class="divider_light">
							<footer class="bg_grey_light_2">
								<div class="fs_big second_font m_bottom_17"><s class="color_light">$1 302.00</s> <b class="scheme_color">$1 102.00</b></div>
								<div class="clearfix">
									<div class="quantity clearfix t_align_c f_left f_md_none m_right_10 m_md_bottom_3">
										<button class="f_left d_block minus black_hover tr_all bg_white">-</button>
										<input type="text" value="1" name="" readonly="" class="f_left color_light">
										<button class="f_left d_block black_hover tr_all bg_white">+</button>
									</div>
									<br class="d_md_block d_none">
									<button class="button_type_2 d_block f_sm_none m_sm_bottom_3 t_align_c lbrown state_2 tr_all second_font fs_medium tt_uppercase f_left m_right_3 product_button"><i class="fa fa-shopping-cart d_inline_m m_right_9"></i>Add To Cart</button>
									<br class="d_sm_block d_none">
									<button class="button_type_8 grey state_2 tr_delay color_dark t_align_c vc_child f_left m_right_3 tooltip_container relative"><i class="fa fa-heart fs_large d_inline_m"></i><span class="tooltip top fs_small color_white hidden animated" data-show="fadeInDown" data-hide="fadeOutUp">Add to Wishlist</span></button>
								</div>
							</footer>
						</div>
					</div>
				</div>
				<button class="close_popup fw_light fs_large tr_all">x</button>
			</div>
		</div>


		<!--libs include-->
		<script src="plugins/jquery.elevateZoom-3.0.8.min.js"></script>
		<script src="plugins/jquery.appear.js"></script>
		<script src="plugins/jquery.easytabs.min.js"></script>
		<script src="plugins/owl-carousel/owl.carousel.min.js"></script>
		<script src="plugins/afterresize.min.js"></script>
		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>
