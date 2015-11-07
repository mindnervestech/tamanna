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
										<button class="thumbnails_product_prev black_hover button_type_4 grey state_2 tr_all d_block vc_child"><i class="fa fa-angle-left d_inline_m"></i></button>
										<button class="thumbnails_product_next black_hover button_type_4 grey state_2 tr_all d_block vc_child"><i class="fa fa-angle-right d_inline_m"></i></button>
									</div>
								</div>
								<div class="product_description f_left f_xs_none">
									<div class="wrapper">
										<h3 class="second_font m_bottom_3 f_left product_title"><a href="#" class="sc_hover"><?php echo $productDetails->row()->product_name;?></a></h3>
										<button class="button_type_8 grey state_2 tr_delay color_dark t_align_c vc_child f_right m_right_3 tooltip_container relative"><i class="fa fa-heart fs_large d_inline_m"></i><span class="tooltip top fs_small color_white hidden animated" data-show="fadeInDown" data-hide="fadeOutUp">Add to Wishlist</span></button>
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
													<p class="fw_light m_top_5 m_bottom_7 m_xs_top_0 m_xs_bottom_0">Special Price:</p>
													<b class="fs_big second_font d_block m_bottom_7 m_xs_bottom_0 fs_sm_default"><?php echo $currencySymbol;?><?php echo number_format($productDetails->row()->sale_price);?></b>
												</td>
                                                <?php if ($productDetails->row()->price>$productDetails->row()->sale_price){ ?>
												<td class="color_light">
													<p class="fw_light m_top_5 m_bottom_7 m_xs_top_0 m_xs_bottom_0">Old Price:</p>
													<b class="fs_big second_font d_block m_bottom_7 m_xs_bottom_0 fs_sm_default"><?php echo $currencySymbol;?><?php echo number_format($productDetails->row()->price); ?></b>
												</td>
                                                <?php }?>
												<td class="color_blue">
													<p class="fw_light m_top_5 m_bottom_7 m_xs_top_0 m_xs_bottom_0">You Save:</p>
													<b class="fs_big second_font d_block m_bottom_7 m_xs_bottom_0 fs_sm_default"><?php echo $currencySymbol;?><?php echo number_format($productDetails->row()->price-$productDetails->row()->sale_price); ?></b>
												</td>
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
											<tr>
												<td colspan="3" class="bg_blue border_blue color_white">
													<div class="m_top_2 m_bottom_6"><span class="fw_light d_inline_m m_right_5">Use Coupon Code <div style="color: #ec1e20;font-size:13px;display:inline-block;">"<?php echo $couponCode;?>"</div> to Get Additional <?php echo number_format($discVal);?>% DIscount</span></div>
												</td>
											</tr>
										</tbody>
									</table>
                  <div class="product_options bt_none">
										<b class="second_font d_block m_bottom_10">Available Options</b>
										<div class="styled_select size_select relative m_bottom_15">
											<div class="select_title type_2 fs_medium fw_light color_light relative d_none tr_all">Queen</div>
											<select>
												<option value="Queen">Queen</option>
												<option value="King">King</option>
												<option value="Grand">Grand</option>
											</select>
											<ul class="options_list d_none tr_all hidden bg_grey_light_2"></ul>
										</div>
										<hr class="divider_light">
										<footer class="bg_grey_light_2">
											<div class="clearfix m_top_7">
												<div class="quantity clearfix t_align_c f_left f_md_none m_right_10 m_md_bottom_3">
													<button class="f_left d_block minus black_hover tr_all bg_white">-</button>
													<input type="text" value="1" name="" readonly="" class="f_left color_light">
													<button class="f_left d_block black_hover tr_all bg_white">+</button>
												</div>
												<br class="d_md_block d_none">
												<button data-popup="#add_to_cart_popup" data-popup-transition-in="bounceInUp" data-popup-transition-out="bounceOutUp" class="button_type_2 d_block f_sm_none m_sm_bottom_3 t_align_c lbrown state_2 tr_all second_font fs_medium tt_uppercase f_left m_right_3 product_button"><i class="fa fa-shopping-cart d_inline_m m_right_9"></i>Add To Cart</button>
											</div>
										</footer>
									</div>
								</div>
							</main>
							<!--tabs-->
							<div class="tabs styled_tabs m_bottom_18">
								<nav class="second_font">
									<ul class="hr_list">
										<li class="m_right_3"><a href="#tab1" class="color_light border_light_3 d_block">Description</a></li>
<?php if($productDetails->row()->listvalue == 'Sheesham Wood' || $productDetails->row()->listvalue == 'Mango Wood' || $productDetails->row()->listvalue == 'Solid Wood'){?>
										<li class="m_right_3"><a href="#tab2" class="color_light border_light_3 d_block">Color Guide</a></li>
                                        <?php } ?>
										<li class="m_right_3"><a href="#tab3" class="color_light border_light_3 d_block">Shipping Policies</a></li>
                                        <?php 
$furCatArr = array('7','14','26','27','29','237');
$prodCat = $productDetails->row()->category_id;
$prodCatArr = @explode(',',$prodCat);

$combArr = array_merge($furCatArr, $prodCatArr);
$combArr1 = array_unique($combArr);

if(count($combArr) != count($combArr1)){?>  
										<li class="m_right_3"><a href="#tab4" class="color_light border_light_3 d_block">Furniture Care</a></li>
                                        <?php } ?>
									</ul>
								</nav>
								<hr class="d_xs_none">
								<div id="tab1" class="fw_light tab_content">
									<p class="m_bottom_13">Description Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna.Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum.</p>
								</div>
								<div id="tab2" class="tab_content">
									<p class="m_bottom_13">Shipping Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna.Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum.</p>
								</div>
								<div id="tab3" class="tab_content">
									<p class="m_bottom_13">furniture care Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna.Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum.</p>
								</div>
								<div id="tab4" class="tab_content">
									<p class="m_bottom_13">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna.Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum.</p>
								</div>
							</div>
						</section>
						<?php if($productDetails->row()->listvalue == 'Sheesham Wood' || $productDetails->row()->listvalue == 'Mango Wood' || $productDetails->row()->listvalue == 'Solid Wood'){?>
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
						<aside class="col-lg-3 col-md-3 col-sm-3">
									<h5 class="second_font color_dark tt_uppercase fw_light d_inline_m m_bottom_23">Customize This Product</h5>
									<form method="post">
									<input type="hidden" name="cproduct_id" id="cproduct_id" value="<?php echo $productDetails->row()->seller_product_id;?>"/>
									<input type="hidden" name="user_id" id="user_id" value="<?php echo $loginCheck ;?>"/>
										<ul>
											<li class="m_bottom_9">
												<label for="review" class="second_font required clickable d_inline_b m_bottom_5">Customization Requirements</label><br>
												<textarea class="tr_all w_full fw_light fs_medium color_light" id="comments" name="comments" placeholder="Tell us size, finish and more.." rows="5"></textarea>
											</li>
											<li class="m_bottom_15">
												<label for="reviewer_name" class="second_font clickable d_inline_b m_bottom_5">Your Contact Number</label><br>
												<input type="text" class="tr_all w_full fw_light fs_medium color_light" id="reviewer_name" name="">
											</li>
											<li class="m_bottom_15">
												<label for="reviewer_name" class="second_font clickable d_inline_b m_bottom_5">Your Email ID</label><br>
												<input type="text" class="tr_all w_full fw_light fs_medium color_light" id="reviewer_name" name="">
											</li>
											<li class="clearfix">
												<button type="submit" class="button_type_2 d_block t_align_c black state_2 tr_all second_font fs_medium tt_uppercase f_left submit button"><span class="d_inline_b m_left_10 m_right_10">Send Custom Request</span></button>
											</li>
											                <?php if($loginCheck==''){ ?>
                	<p><?php if($this->lang->line('product_please') != '') { echo stripslashes($this->lang->line('product_please')); } else echo "Please"; ?> <a href="login?next=things/<?php echo $productDetails->row()->id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>"><?php if($this->lang->line('product_login') != '') { echo stripslashes($this->lang->line('product_login')); } else echo "login"; ?></a> <?php if($this->lang->line('credit_or') != '') { echo stripslashes($this->lang->line('credit_or')); } else echo "or"; ?> <a href="signup?next=things/<?php echo $productDetails->row()->id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>"><?php if($this->lang->line('product_signup') != '') { echo stripslashes($this->lang->line('product_signup')); } else echo "signup"; ?></a> <?php echo "to send custom request"; ?></p>
                <?php }?>
										</ul>
									</form>
						</aside>
						<?php } ?>
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
										<div>
											<img class="c_image_1 tr_all" alt="<?php echo $relatedRow->product_name;?>" src="<?php echo base_url();?>images/product/<?php echo $img;?>">
											<img class="c_image_2 tr_all" alt="<?php echo $relatedRow->product_name;?>" src="<?php echo base_url();?>images/product/<?php echo $img;?>">
										</div>
										<a data-popup="#quick_view" data-popup-transition-in="bounceInUp" data-popup-transition-out="bounceOutUp" class="tr_all color_white second_font qv_style_button quick_view tt_uppercase t_align_c d_block clickable d_xs_none"><i class="fa fa-eye d_inline_m m_right_10"></i><span class="fs_medium">Quick View</span></a>
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
								<div class="select_title type_2 fs_medium fw_light color_light relative d_none tr_all">Queen</div>
								<select>
									<option value="Queen">Queen</option>
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
		<script src="plugins/fancybox/jquery.fancybox.pack.js"></script>
		<script src="plugins/jquery.elevateZoom-3.0.8.min.js"></script>
		<script src="plugins/countdown/jquery.plugin.min.js"></script>
		<script src="plugins/jquery.appear.js"></script>
		<script src="plugins/jquery.easytabs.min.js"></script>
		<script src="plugins/owl-carousel/owl.carousel.min.js"></script>
		<script src="plugins/afterresize.min.js"></script>
		<script src="plugins/jackbox/js/jackbox-packed.min.js"></script>
		 

		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>