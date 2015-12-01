<?php
$this->load->view('site/templates/header_new');
?>

			<!--breadcrumbs-->
			<div class="breadcrumbs bg_grey_light_2 fs_medium fw_light">
				<div class="container">
					    <div itemprop="breadcrumb">
						 <?php echo trim_slashes($breadCumps); ?>
						</div>
				</div>
			</div>
			<!--main content-->
			<div class="page_section_offset">
				<div class="container">
					<div class="row">
						<aside class="col-lg-3 col-md-3 col-sm-3 m_xs_bottom_30 p_top_4">
							<!--filter widget-->
							<section class="m_bottom_38 m_xs_bottom_30">
								<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Filter</h5>
								<hr class="divider_bg m_bottom_23">
								<form>
									<div class="relative">
										<input id="sliderPriceMin" hidden/>
										<button id="sort_By_Price_Range" hidden></button>
										<fieldset>
											<legend class="second_font m_bottom_15 w_full"><b>Price</b></legend>
											<div class="range_slider relative bg_grey_light_2 m_bottom_10"></div>
																
											<div class="clearfix m_bottom_10">
												<input type="text" class="f_left range_min half_column fw_light" readonly>
												<input type="text" class="f_right range_max half_column t_align_r fw_light" readonly>
											</div>
											<span class="close fieldset_c hidden fs_small color_light tr_all color_dark_hover fw_light">x</span>
											<hr class="divider_light m_bottom_10">
										</fieldset>
									</div>
								</form>
							</section>
							<!--categories widget-->
							<section class="m_bottom_30">
								<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Categories</h5>
								<hr class="divider_bg m_bottom_23">
								<ul class="categories_list second_font w_break">
									<?php 
                                        foreach ($mainCategories->result() as $row){
                      	                     if ($row->cat_name != '' && $row->cat_name != 'Our Picks'){
                                            ?>
									<li class="relative"><a href="#" link="shopby/<?php echo $row->seourl;?>" class="fs_large_0 d_inline_b sub-category"><?php echo $row->cat_name;?></a>

									            <?php 
	                                               foreach ($all_categories->result() as $row1){
													if ($row1->cat_name != '' && $row->id==$row1->rootID){
														$x = '<button id="'  .$row->seourl.'" class="open_sub_categories fs_medium"></button>';
														echo $x;
														break;
														}
													}
                                                ?>
									
                                                <?php 
	                                               foreach ($all_categories->result() as $row1){
	                      	                            if ($row1->cat_name != '' && $row->id==$row1->rootID){
                                                ?>									

										<ul class="d_none">
											<li class="relative"><a href="#" link="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>" class="tr_delay d_inline_b sub-category"><?php echo $row1->cat_name;?></a>
													<?php 
													   foreach ($all_categories->result() as $row2){
														if ($row2->cat_name != '' && $row1->id==$row2->rootID){
																$x = '<button id="'  .$row1->seourl.'" class="open_sub_categories fs_medium"></button>';
																echo $x;
																break;
															}
														}
													?>
													<?php 
			                                             foreach ($all_categories->result() as $row2){
			                      	                          if ($row2->cat_name != '' && $row1->id==$row2->rootID){
			                                             ?>
												<ul class="d_none fs_small categories_third_level_list">
													<li><a href="#" link="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>/<?php echo $row2->seourl;?>" class="tr_delay sc_hover bg_grey_light_2_hover sub-category"><?php echo $row2->cat_name;?></a></li>
												</ul>
													<?php  }} ?>
											</li>
										</ul>
									    <?php  }} ?>	
									</li>
                                        <?php  }} ?>									
								</ul>
							</section>	
		

							<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Material</h5>
																					
								<hr class="divider_bg m_bottom_23">
									<div class="relative">
										<fieldset>
											<ul>
											<li class="m_bottom_9">
													<input type="radio" class="color-filter" name="material" id="<?php if($this->lang->line('product_any_color') != '') { echo stripslashes($this->lang->line('product_any_color')); } else echo "Any Color"; ?>" color = "any">
													<label for="<?php if($this->lang->line('product_any_color') != '') { echo stripslashes($this->lang->line('product_any_color')); } else echo "Any Color"; ?>" class="fw_light fs_"><?php if($this->lang->line('product_any_color') != '') { echo stripslashes($this->lang->line('product_any_color')); } else echo "Any Color"; ?></label>
											</li>
											  <?php 
													  foreach ($mainColorLists->result() as $colorRow){
														if ($colorRow->list_value != ''){
								$list_value_trimmed = preg_replace("/[^a-zA-Z]+/", "", $colorRow->list_value);

													  ?>
												<li class="m_bottom_9">
													<input type="radio" class="color-filter" name="material" id="<?php echo strtolower($list_value_trimmed);?>" color="<?php echo strtolower($list_value_trimmed);?>">
													<label for="<?php echo strtolower($list_value_trimmed);?>" class="fw_light fs_" <?php if($_GET['c']==url_title($colorRow->list_value)){ echo 'selected="selected"'; } ?> value="<?php echo strtolower($list_value_trimmed);?>"><?php echo ucfirst($colorRow->list_value);?></label>	
												</li>

											  <?php 
														}
													  }
											  ?>
											
											<!--	<li class="m_bottom_9">
													<input type="checkbox" name="" id="checkbox_1">
													<label for="checkbox_1" class="fw_light fs_">Sheesham Wood</label>	
												</li>
												<li class="m_bottom_15">
													<input type="checkbox" name="" id="checkbox_3">
													<label for="checkbox_3" class="fw_light fs_">MDF</label>	
												</li> -->
											</ul>
											<span class="close fieldset_c hidden fs_small color_light tr_all color_dark_hover fw_light">x</span>
											<hr class="divider_light m_bottom_10">
										</fieldset>
									</div>
							<section class="m_bottom_40 m_xs_bottom_30">
								<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Wishlist</h5>
								<hr class="divider_bg m_bottom_25">
								<p class="fw_light color_light">You have no product in your wishlist.</p>
							</section>
						</aside>
						<main class="col-lg-9 col-md-9 col-sm-9 m_bottom_30 m_xs_bottom_10">
						<div id="content">
							<h2 class="fw_light second_font color_dark tt_uppercase m_bottom_27">Queen Beds</h2>
				<!--			<figure class="m_bottom_45 m_xs_bottom_30">
								<figcaption>
									<p class="fw_light">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet.</p>
								</figcaption>
							</figure> -->
							<div class="d_table w_full m_bottom_5">
								<div class="col-lg-6 col-md-6 col-sm-6 d_xs_block v_align_m d_table_cell f_none fs_medium color_light fw_light m_xs_bottom_5">
									<div class="d_inline_m m_right_5">Sort by:</div>
									<select class="shop-select sort-by-price selectBox">
									  <option selected="selected" value=""><?php if($this->lang->line('product_newest') != '') { echo stripslashes($this->lang->line('product_newest')); } else echo "Newest"; ?></option>
									  <option value="asc"><?php if($this->lang->line('product_low_high') != '') { echo stripslashes($this->lang->line('product_low_high')); } else echo "Price: Low to High"; ?></option>
									  <option value="desc"><?php if($this->lang->line('product_high_low') != '') { echo stripslashes($this->lang->line('product_high_low')); } else echo "Price: High to Low"; ?></option>
									</select>
									<!--<div class="styled_select relative d_inline_m m_right_2">
										<div class="select_title type_3 fs_medium fw_light color_light relative d_none tr_all">Product name</div>
										<select>
											<option value="Product name 9">Product name 9</option>
											<option value="Product name 8">Product name 8</option>
											<option value="Product name 7">Product name 7</option>
											<option value="Product name 6">Product name 6</option>
											<option value="Product name 5">Product name 5</option>
											<option value="Product name 4">Product name 4</option>
											<option value="Product name 3">Product name 3</option>
											<option value="Product name 2">Product name 2</option>
											<option value="Product name 1">Product name 1</option>
										</select>
										<ul class="options_list d_none tr_all hidden bg_grey_light_2"></ul>
									</div> 
									<button class="button_type_4 grey state_2 tr_all second_font tt_uppercase vc_child black_hover"><i class="fa fa-sort-amount-asc d_inline_m m_top_0"></i></button>-->
								</div>
									<!--searchform-->
									<div class="col-lg-6 col-md-6 col-sm-6 d_xs_block v_align_m d_table_cell f_none fs_medium color_light fw_light m_xs_bottom_5">
									<div role="search" class="relative f_right f_xs_none m_right_3 db_xs_centered button_in_input">
										<input type="text" name="" id="searchbox" tabindex="1" placeholder="Search" class="fs_medium color_light fw_light w_full tr_all">
										<button class="search-string color_dark tr_all color_lbrown_hover"><i class="fa fa-search d_inline_m"></i></button>
									</div>
									</div>
								
							<!--	<div class="col-lg-2 col-md-2 col-sm-2 d_xs_block v_align_m d_table_cell f_none t_align_r t_xs_align_l p_xs_left_0">
									<p class="fw_light fs_medium d_inline_m m_right_5 color_light">View as:</p>
									<div class="clearfix d_inline_m">
										<button data-isotope-layout="grid" data-isotope-container="#can_change_layout" class="button_type_4 f_left grey state_2 m_right_5 tr_all second_font tt_uppercase vc_child black_button_active"><i class="fa fa-th m_top_0 d_inline_m"></i></button>
										<button data-isotope-layout="list" data-isotope-container="#can_change_layout" class="button_type_4 f_left grey state_2 tr_all second_font tt_uppercase vc_child black_hover"><i class="fa fa-th-list m_top_0 d_inline_m"></i></button>
									</div>
								</div>-->
							</div>
							<hr class="divider_light m_bottom_5">
							<!--isotope-->
							<div id="can_change_layout" class="stream category_isotope_container three_columns wrapper m_bottom_10 m_xs_bottom_0" data-isotope-options='{
								"itemSelector": ".category_isotope_item",
					  			"layoutMode": "fitRows"
							}'>
							
							
							
							
        <?php if($productList->num_rows()>0){
          ?>							
          <?php  foreach ($productList->result() as $productListVal) { 
        	$img = 'dummyProductImage.jpg';
			$imgArr = explode(',', $productListVal->image);
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
					if ($likeProRow->product_id == $productListVal->seller_product_id){
						$fancyClass = 'fancyd';$fancyText = LIKED_BUTTON;break;
					}
				}
			}
		?>
          <div class="category_isotope_item">
									<figure class="product_item type_2 c_image_container relative frame_container t_sm_align_c r_image_container qv_container">
										<!--image & buttons & label-->
										<div class="relative">
											<?php
											$prodID = $productListVal->id;
											$origPrice = $productListVal->sale_price;
											$userId = $productListVal->user_id;
											$catId = $productListVal->category_id;


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
											<div class="d_block">
											<a href="things/<?php echo $productListVal->id;?>/<?php echo url_title($productListVal->product_name,'-');?>">
												<img src="images/product/<?php echo $img; ?>" alt="" class="c_image_1 tr_all">
												<img src="images/product/<?php echo $img; ?>" alt="" class="c_image_2 tr_all">
											</div>
											<?php if($discPrice != ''){?>
											<div class="product_label fs_ex_small circle color_white bg_lbrown t_align_c vc_child tt_uppercase"><i class="d_inline_m">Sale!</i></div>
											<?php } ?>
											<a data-popup="#quick_view" data-popup-transition-in="bounceInUp" data-popup-transition-out="bounceOutUp" class="tr_all color_white second_font qv_style_button quick_view tt_uppercase t_align_c d_block clickable d_xs_none"><i class="fa fa-eye d_inline_m m_right_10"></i><span class="fs_medium">Quick View</span></a>
										</div>
										<figcaption class="bg_white relative p_bottom_0">
												<div class="t_align_c">
													<a class="second_font sc_hover d_xs_block m_bottom_5" href="things/<?php echo $productListVal->id;?>/<?php echo url_title($productListVal->product_name,'-');?>"><?php echo $productListVal->product_name;?></a>
												</div>
											<button data-popup="#add_to_cart_popup" data-popup-transition-in="bounceInUp" data-popup-transition-out="bounceOutUp" class="button_type_2 m_bottom_9 d_block w_full t_align_c lbrown state_2 tr_all second_font fs_medium tt_uppercase m_top_15"><i class="fa fa-shopping-cart d_inline_m m_right_9"></i>Add To Cart</button>
											<button class="button_type_8 grey state_2 tr_delay color_dark t_align_c vc_child f_left m_right_3 tooltip_container relative d_none"><i class="fa fa-heart fs_large d_inline_m"></i><span class="tooltip top fs_small color_white hidden animated" data-show="fadeInDown" data-hide="fadeOutUp">Add to Wishlist</span></button>
											<div class="clearfix t_sm_align_c t_xs_align_l">
												<div class="row">
													<div class="col-lg-6 col-md-6 m_bottom_9">
													<a href="#" class="second_font f_sm_none d_sm_inline_b f_xs_left fs_medium sc_hover f_left">Add to Wishlist</a>												</div>
													<div class="col-lg-6 col-md-6 color_light fs_large second_font t_align_r t_sm_align_c m_bottom_9">
												<?php if($discPrice != ''){?>
												   <?php if ($productListVal->price>$productListVal->sale_price){ ?>
													  <s>Rs <?php echo number_format($productListVal->price);echo " ";?></s>
												   <?php } else {?>
													 <s>Rs <?php echo number_format($productListVal->sale_price);?></s>
												   <?php } ?>
												   <b class="scheme_color d_block">Rs <?php echo $discPrice;?></b>
												 <?php } else { ?>
												   <?php if ($productListVal->price>$productListVal->sale_price){ ?>
													  <s>Rs <?php echo number_format($productListVal->price);echo " ";?></s>
													  </br>You Pay: Rs <?php echo number_format($productListVal->sale_price);?>
												   <?php } else {?>
													  <b class="scheme_color d_block">Rs <?php echo number_format($productListVal->sale_price);?></b>
												   <?php } ?>
												<?php } ?>
													</div>
											</div>
											</div>
										</figcaption>
									</figure>
								</div>
		  
     <?php } ?>
		          <?php } ?>
							
							
							
							
							
							
							
							
							
							
							
							</div>
							        <div class="pagination" style="display:none">
										<?php echo $paginationDisplay; ?>
									</div>
							
						</main>
					</div>
				</div>
			</div>
		
		<!--footer-->
		<?php
		$this->load->view('site/templates/sub_footer_cat');
		$this->load->view('site/templates/footer');
		?>
	</div>

		<!--back to top-->
		<button class="back_to_top animated button_type_6 grey state_2 d_block black_hover f_left vc_child tr_all"><i class="fa fa-angle-up d_inline_m"></i></button>

		<!--popup-->
		<div class="init_popup" id="add_to_cart_popup">
			<div class="popup init">
				<div class="clearfix m_bottom_15">
					<a href="#" class="f_left d_block m_right_20">
						<img src="images/bestsellers_img_1.jpg" alt="">
					</a>
					<p class="second_font fs_large color_dark">1 x Eget elementum vel<br> was added to your cart</p>
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
							<p class="second_font">Color:</p>
							<ul class="hr_list m_bottom_17">
								<li class="m_right_5 m_bottom_3"><button class="color_button bg_light_red tr_all"></button></li>
								<li class="m_right_5 m_bottom_3"><button class="color_button bg_light_blue tr_all"></button></li>
								<li class="m_right_5 m_bottom_3"><button class="color_button bg_light_green tr_all"></button></li>
								<li class="m_right_5 m_bottom_3"><button class="color_button bg_grey tr_all"></button></li>
								<li class="m_right_5 m_bottom_3"><button class="color_button bg_light_yellow tr_all"></button></li>
							</ul>
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
		<script src="plugins/jquery-ui.min.js"></script>
		<script src="plugins/isotope.pkgd.min.js"></script>
		<script src="plugins/jquery.appear.js"></script>
		<script src="plugins/owl-carousel/owl.carousel.min.js"></script>
		<script src="plugins/twitter/jquery.tweet.min.js"></script><script src="plugins/flickr.js"></script>
		<script src="plugins/afterresize.min.js"></script>
		<script src="plugins/jackbox/js/jackbox-packed.min.js"></script>
		<script src="plugins/jquery.elevateZoom-3.0.8.min.js"></script>
		<script src="plugins/fancybox/jquery.fancybox.pack.js"></script>
		<script src="js/retina.min.js"></script>
		<script src="plugins/colorpicker/colorpicker.js"></script>
		
	 
		<!--Page Js-->
		<script src="js/site/Socktail-shoplist.js"></script>
		<script src="js/site/main4.js" type="text/javascript"></script>
		
		
		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>