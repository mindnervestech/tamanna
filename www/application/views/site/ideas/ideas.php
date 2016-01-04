<?php
$this->load->view('site/templates/header_new_small');
?>
				<div class="container bg_grey_light_2">
						  <h2 class="fw_light second_font color_dark m_bottom_40 tt_uppercase t_align_c p_top_25"><?php echo "Discover Great Products near you"; ?></h2>
							<div class="row sh_container p_bottom_20">
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-0 same_height animated visible fadeInDown" data-animation="fadeInDown">
								</div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 same_height animated visible fadeInDown" data-animation="fadeInDown">
									<section class="item_represent relative m_bottom_25 m_xs_bottom_30 h_inherit t_sm_align_c t_align_c">
										<!--icon-->
										<i class="fa fa-map-marker fa-2x"></i>
										<!--description-->
											<p class="fw_light m_bottom_10 m_top_15">Explore products availble on local stores</p>
									</section>
								</div>
								<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 same_height animated visible fadeInDown" data-animation="fadeInDown">
									<section class="item_represent relative m_bottom_25 m_xs_bottom_30 h_inherit t_sm_align_c t_align_c">
										<!--icon-->
										<i class="fa fa-long-arrow-right fa-3x"></i>
									</section>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 same_height animated visible fadeInDown" data-animation="fadeInDown">
									<section class="item_represent relative m_bottom_25 m_xs_bottom_30 h_inherit t_sm_align_c t_align_c">
										<i class="fa fa-camera-retro fa-2x"></i>
										<!--description-->
											<p class="fw_light m_bottom_10 m_top_15">Check price and product pictures</p>
									</section>
								</div>
								<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 same_height animated visible fadeInDown" data-animation="fadeInDown">
									<section class="item_represent relative m_bottom_25 m_xs_bottom_30 h_inherit t_sm_align_c t_align_c">
										<!--icon-->
										<i class="fa fa-long-arrow-right fa-3x"></i>
									</section>
								</div>								
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 same_height animated visible fadeInDown" data-animation="fadeInDown">
									<section class="item_represent relative m_bottom_25 m_xs_bottom_30 h_inherit t_sm_align_c t_align_c">
										<!--icon-->
										<i class="fa fa-mobile fa-3x"></i>
										<!--description-->
											<p class="fw_light m_bottom_10 m_top_15">Talk to sellers directly</p>
									</section>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-0 same_height animated visible fadeInDown" data-animation="fadeInDown">
								</div>
							</div>
				</div>
				
			<!--breadcrumbs
			<div class="breadcrumbs bg_grey_light_2 fs_medium fw_light">
				<div class="container">
					    <div itemprop="breadcrumb">
						 <?php echo trim_slashes($breadCumps); ?>
						</div>
				</div>
			</div> -->
			<!--main content-->
			<div class="page_section_offset" style="padding:13px 0 25px">
				<div class="container">
					<div class="row">
						<aside class="col-lg-3 col-md-3 col-sm-3 m_xs_bottom_30 p_top_4">
							<!--filter widget-->
							<section class="m_bottom_38 m_xs_bottom_30">
								<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Filter by price</h5>
								<hr class="divider_bg m_bottom_23">
								<form>
									<div class="relative">
										<input id="sliderPriceMin" hidden/>
										<input id="sliderPriceMax" hidden/>
										<button id="sort_By_Price_Range" hidden></button>
										<fieldset>
											<div class="range_slider relative bg_grey_light_2 m_bottom_10"></div>
											<div class="clearfix m_bottom_10">
												<input type="text" class="f_left range_min half_column fw_light" readonly>
												<input type="text" class="f_right range_max half_column t_align_r fw_light" readonly>
											</div>
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
												<li class="relative"><a href="#" link="design-ideas/<?php echo $row->seourl;?>" class="fs_large_0 d_inline_b sub-category"><?php echo $row->cat_name;?></a>
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
																		<li class="relative"><a href="#" id="<?php echo '__'.$row1->seourl.'_';?>" link="design-ideas/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>" class="tr_delay d_inline_b sub-category second_sub_category"><?php echo $row1->cat_name;?></a>
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
																								<li><a href="#" id="<?php echo '_'.$row2->seourl.'_';?>" link="design-ideas/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>/<?php echo $row2->seourl;?>" class="tr_delay sc_hover bg_grey_light_2_hover sub-category third_sub_category"><?php echo $row2->cat_name;?></a></li>
																							</ul>
																				<?php  	  }
																					 } 
																				?>
																		</li>
																	</ul>
														<?php  														}
														   } 
														?>	
												</li>
                                     <?php  }
										} ?>									
								</ul>
							</section>	

						</aside>
						<main class="col-lg-9 col-md-9 col-sm-9 m_bottom_30 m_xs_bottom_10">
						<div id="content">
							<div class="d_table w_full m_bottom_5">
								<div class="col-lg-4 col-md-4 col-sm-4 d_xs_block v_align_m d_table_cell f_none fs_medium color_light fw_light m_xs_bottom_5">
									<h5 class="d_inline_m m_right_5">SORT BY:</h5>
									<select class="shop-select sort-by-price selectBox select-round select-shipping-addr select_title fs_medium fw_light color_light relative tr_all">
									  <option <?php if($this->session->userdata('location') == 'nolocation'){ echo 'selected="selected"'; } ?> value=""><?php if($this->lang->line('product_newest') != '') { echo stripslashes($this->lang->line('product_newest')); } else echo "Newest"; ?></option>
									  <option value="asc"><?php if($this->lang->line('product_low_high') != '') { echo stripslashes($this->lang->line('product_low_high')); } else echo "Price: Low to High"; ?></option>
									  <option value="desc"><?php if($this->lang->line('product_high_low') != '') { echo stripslashes($this->lang->line('product_high_low')); } else echo "Price: High to Low"; ?></option>
									 <!-- <option <?php if($this->session->userdata('location') != 'nolocation'){ echo 'selected="selected"'; } ?> value="location"><?php echo "Location"; ?></option> -->
									</select>
								</div>
								<div id="exploreLocation" style="" class="col-lg-4 col-md-4 col-sm-4 d_xs_block v_align_m d_table_cell f_none fs_medium color_light fw_light m_xs_bottom_5">
									<h5 class="d_inline_m m_right_5">Filter BY:</h5>
										<select class="sort-by-location selectBox select-round select-shipping-addr select_title fs_medium fw_light color_light relative tr_all">
											<option value=""><?php echo "Select Location"; ?></option>
											<?php foreach ($locations->result() as $location){ ?>
												<option  value="<?php echo $location->id; ?>"><?php echo $location->cityname; ?></option>
											<?php } ?>
										</select>
								</div>

								<!--searchform-->
									<div class="col-lg-4 col-md-4 col-sm-4 d_xs_block v_align_m d_table_cell f_none fs_medium color_light fw_light m_xs_bottom_5">
									<div role="search" class="relative f_right f_xs_none m_right_3 db_xs_centered button_in_input">
										<input type="text" name="" id="searchbox" tabindex="1" placeholder="Search" class="search-string fs_medium color_light fw_light w_full tr_all">
										<button class="search-button-click color_dark tr_all color_lbrown_hover"><i class="fa fa-search d_inline_m"></i></button>
									</div>
									</div>
							</div>
							<hr class="divider_light m_bottom_5">
							<!--isotope Products-->
							<div id="can_change_layout" class="stream category_isotope_container three_columns wrapper m_bottom_10 m_xs_bottom_0">
								<div class="row m_top_20">
									<?php if($userproductList->num_rows()>0){
									  ?>							
									  <?php  foreach ($userproductList->result() as $productListVal) { 
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
									   $fancyClass = 'addToFavourite';
										$fancyText = LIKE_BUTTON;
										if (count($likedProducts)>0 && $likedProducts->num_rows()>0){
											foreach ($likedProducts->result() as $likeProRow){
												if ($likeProRow->product_id == $productListVal->seller_product_id){
													$fancyClass = 'addedToFavourite';$fancyText = LIKED_BUTTON;break;
												}
											}
										}
									?>
										<div class="col-lg-4 col-md-4 col-sm-4 d_xs_block v_align_m fs_medium color_light fw_light m_xs_bottom_5 m_top_15 category_isotope_item">
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
														<a href="user/<?php echo $productListVal->user_name;?>/things/<?php echo $productListVal->seller_product_id;?>/<?php echo url_title($productListVal->product_name,'-');?>">
															<img src="images/product/<?php echo $img; ?>" alt="<?php echo $productListVal->product_name;?>" class="c_image_1 tr_all">
														<!--<img src="images/product/<?php echo $img; ?>" alt="<?php echo $productListVal->product_name;?>" class="c_image_2 tr_all"> -->
														</a>
													</div>
													<?php if($discPrice != ''){?>
													<div class="product_label fs_ex_small circle color_white bg_lbrown t_align_c vc_child tt_uppercase"><i class="d_inline_m">Sale!</i></div>
													<?php } ?>
												</div>
												<figcaption class="bg_white relative p_bottom_0">
													<div class="t_align_c"  style="height:40px;">
															<a class="second_font sc_hover d_xs_block m_bottom_5" href="user/<?php echo $productListVal->user_name;?>/things/<?php echo $productListVal->seller_product_id;?>/<?php echo url_title($productListVal->product_name,'-');?>"><?php echo $productListVal->product_name;?></a>
													</div>
											<!--		<a class="button_type_2 m_bottom_9 d_block w_full t_align_c lbrown state_2 tr_all second_font fs_medium tt_uppercase m_top_15" href="user/<?php echo $productListVal->user_name;?>/things/<?php echo $productListVal->seller_product_id;?>/<?php echo url_title($productListVal->product_name,'-');?>">Check Details</a> -->
													<div class="clearfix t_align_c t_sm_align_c t_xs_align_l">
													   <span class="d_block">by <?php echo $productListVal->full_name;?> - <?php echo $productListVal->s_city;?></span>
													</div>
													<hr class="divider m_bottom_5 m_top_5">
													<div class="clearfix t_sm_align_c t_xs_align_l">
														<div class="row">
																<div class="col-lg-3 col-md-3 m_bottom_9">
																	<button item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $productListVal->seller_product_id;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?> style="<?php if($fancyClass == "addedToFavourite"){echo "color:darkred !important"; };?>; border-style:none" class=" <?php echo $fancyClass?> d_sm_inline_b button_type_8 grey state_2 tr_delay color_dark t_align_c vc_child f_left m_right_3 tooltip_container relative button like_search_product"><i class="fa fa-heart fs_large d_inline_m"></i><span class="tooltip tooltipAddtoWishList top fs_small color_white hidden animated" data-show="fadeInDown" data-hide="fadeOutUp"><?php if($fancyClass == "addedToFavourite"){echo "Remove from Wishlist"; }else echo "Add to Wishlist";?></span></button>
																</div>
																<div class="col-lg-9 col-md-9 color_light fs_large second_font t_align_r t_sm_align_c m_bottom_9 f_right">
																	<?php if($discPrice != ''){?>
																	   <?php if ($productListVal->price>$productListVal->sale_price){ ?>
																		  <s><?php echo $currencySymbol;?><?php echo number_format($productListVal->price);echo " ";?></s>
																	   <?php } else {?>
																		 <s><?php echo $currencySymbol;?><?php echo number_format($productListVal->sale_price);?></s>
																	   <?php } ?>
																	   <b class="scheme_color d_block"><?php echo $currencySymbol;?><?php echo $discPrice;?></b>
																	 <?php } else { ?>
																	   <?php if ($productListVal->price>$productListVal->sale_price){ ?>
																					  <s><?php echo $currencySymbol;?><?php echo number_format($productListVal->price);?></s>
																					  <b class="scheme_color d_inline_bblock "><?php echo $currencySymbol;?><?php echo number_format($productListVal->sale_price);?></b>
																	   <?php } else {?>
																		  <b class="scheme_color d_block"><?php echo $currencySymbol;?><?php echo number_format($productListVal->sale_price);?></b>
																	   <?php } ?>
																	<?php } ?>
																</div>
														</div>
													</div>
												</figcaption>
											</figure>
										</div>
		  
									<?php 
									} ?>
									 <?php } ?>
								</div>
							</div>
							<div class="pagination" style="display:none">
								<?php echo $paginationDisplay; ?>
							</div>
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
		<!--libs include-->
		<script src="plugins/jquery-ui.min.js"></script>
		<script src="plugins/jquery.appear.js"></script>
		<script src="plugins/afterresize.min.js"></script>
		<!--Page Js-->
		<script src="js/site/Socktail-shoplist.js"></script>
		<script src="js/site/main4.js" type="text/javascript"></script>
		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>