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
			<div class="page_section_offset" style="padding:13px 0 25px">
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
										<input id="sliderPriceMax" hidden/>
										<button id="sort_By_Price_Range" hidden></button>
										<fieldset>
											<legend class="second_font m_bottom_15 w_full"><b>Price</b></legend>
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
																		<li class="relative"><a href="#" id="<?php echo '__'.$row1->seourl.'_';?>" link="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>" class="tr_delay d_inline_b sub-category second_sub_category"><?php echo $row1->cat_name;?></a>
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
																								<li><a href="#" id="<?php echo '_'.$row2->seourl.'_';?>" link="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>/<?php echo $row2->seourl;?>" class="tr_delay sc_hover bg_grey_light_2_hover sub-category third_sub_category"><?php echo $row2->cat_name;?></a></li>
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
					<!--		<section class="m_bottom_40 m_xs_bottom_30">
								<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Wishlist</h5>
								<hr class="divider_bg m_bottom_25">
								<p class="fw_light color_light">You have no product in your wishlist.</p>
							</section> -->
						</aside>
						<main class="col-lg-9 col-md-9 col-sm-9 m_bottom_30 m_xs_bottom_10">
						<div id="content">
				<!--			<h2 class="fw_light second_font color_dark tt_uppercase m_bottom_27">Queen Beds</h2>
							<figure class="m_bottom_45 m_xs_bottom_30">
								<figcaption>
									<p class="fw_light">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet.</p>
								</figcaption>
							</figure> -->
							<div class="d_table w_full m_bottom_5">
								<div class="col-lg-6 col-md-6 col-sm-6 d_xs_block v_align_m d_table_cell f_none fs_medium color_light fw_light m_xs_bottom_5">
									<h5 class="d_inline_m m_right_5">SORT BY:</h5>
									<select class="shop-select sort-by-price selectBox select-round select-shipping-addr select_title fs_medium fw_light color_light relative tr_all">
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
										<input type="text" name="" id="searchbox" tabindex="1" placeholder="Search" class="search-string fs_medium color_light fw_light w_full tr_all">
										<button class="search-button-click color_dark tr_all color_lbrown_hover"><i class="fa fa-search d_inline_m"></i></button>
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
												<img src="images/product/<?php echo $img; ?>" alt="<?php echo $productListVal->product_name;?>" class="c_image_1 tr_all">
												<img src="images/product/<?php echo $img; ?>" alt="<?php echo $productListVal->product_name;?>" class="c_image_2 tr_all">
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
											<div class="clearfix t_sm_align_c t_xs_align_l">
												<div class="row">
													<div class="col-lg-6 col-md-6 m_bottom_9">
<!--													<a href="#" class="second_font f_sm_none d_sm_inline_b f_xs_left fs_medium sc_hover f_left">Add to Wishlist</a>				-->								
														<button item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $productListVal->seller_product_id;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?> style="<?php if($fancyClass == "addedToFavourite"){echo "color:darkred !important"; };?>; border-style:none" class=" <?php echo $fancyClass?> d_sm_inline_b button_type_8 grey state_2 tr_delay color_dark t_align_c vc_child f_left m_right_3 tooltip_container relative button like_search_product"><i class="fa fa-heart fs_large d_inline_m"></i><span class="tooltip tooltipAddtoWishList top fs_small color_white hidden animated" data-show="fadeInDown" data-hide="fadeOutUp"><?php if($fancyClass == "addedToFavourite"){echo "Remove from Wishlist"; }else echo "Add to Wishlist";?></span></button>
													</div>
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
		  
     <?php 
} ?>
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
		<div class="init_popup" id="quick_view">
			<div class="popup init">
				<div class="clearfix">
					<div class="product_preview f_left f_xs_none wrapper m_xs_bottom_15">
						<div class="d_block relative r_image_container">
							<img id="zoom" src="images/product/<?php echo $img; ?>" alt="<?php echo $productListVal->product_name;?>" data-zoom-image="images/product/<?php echo $img; ?>">
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
										<?php 
										$limitCount = 0;
										$imgArr = explode(',', $productListVal->image);
										if (count($imgArr)>0){
											foreach ($imgArr as $imgRow){
												if ($limitCount>5)break;
												if ($imgRow != '' && $imgRow != $pimg){
													$limitCount++;
										?>
											<a href="<?php echo base_url().PRODUCTPATH.$imgRow;?>" data-image="<?php echo base_url().PRODUCTPATH.$imgRow;?>" data-zoom-image="<?php echo base_url().PRODUCTPATH.$imgRow;?>" class="d_block">
												<img src="<?php echo base_url().PRODUCTPATH.$imgRow;?>" alt="">
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
							<?php 				}
							?>
						</div>
					</div>
					<div class="product_description f_left f_xs_none">
						<h3 class="second_font m_bottom_3 product_title"><a href="things/<?php echo $productListVal->id;?>/<?php echo url_title($productListVal->product_name,'-');?>" class="sc_hover"><?php echo $productListVal->product_name;?></a></h3>
						<ul class="m_bottom_14">
										<li class="m_bottom_3"><span class="project_list_title second_font d_inline_b">Dispatched in:</span> <span class="color_dark fw_light"><?php $shipping = $productListVal->shipping;?>
										 <?php	
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
										<li class="m_bottom_3"><span class="project_list_title second_font d_inline_b">Shipping Cost:</span><span class="fw_light"> <?php echo $currencySymbol;?> <?php echo $productListVal->shipping_cost;?></span></li>
										<li class="m_bottom_3"><span class="project_list_title second_font d_inline_b">SKU Code:</span> <span class="fw_light"> <?php echo $productListVal->sku;?></span></li>
						</ul>
						<table class="w_full">
											<tbody>
												<tr>
													<td class="scheme_color">
														<p class="fw_light m_top_5 m_bottom_7 m_xs_top_0 m_xs_bottom_0">Our Price:</p>
														<b><div><span class="fs_big second_font d_block m_bottom_7 m_xs_bottom_0 fs_sm_default" style="float:left;"><?php echo $currencySymbol;?>&nbsp; </span><span id="SalePrice" class="fs_big second_font d_block m_bottom_7 m_xs_bottom_0 fs_sm_default"> <?php echo number_format($productListVal->sale_price);?></span></div></b>
													</td>
													<?php if ($productListVal->price>$productListVal->sale_price){ ?>
													<td class="color_light">
														<p class="fw_light m_top_5 m_bottom_7 m_xs_top_0 m_xs_bottom_0">Old Price:</p>
														<b class="fs_big second_font d_block m_bottom_7 m_xs_bottom_0 fs_sm_default"><?php echo $currencySymbol;?><?php echo number_format($productListVal->price); ?></b>
													</td>
													<td class="color_blue">
														<p class="fw_light m_top_5 m_bottom_7 m_xs_top_0 m_xs_bottom_0">You Save:</p>
														<b class="fs_big second_font d_block m_bottom_7 m_xs_bottom_0 fs_sm_default"><?php echo $currencySymbol;?><?php echo number_format($productListVal->price-$productListVal->sale_price); ?></b>
													</td>
													<?php }?>												
												</tr>
												<!-- vinit code start -->
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
												<!-- vinit code end -->
												<input type="hidden" class="option number" name="product_id" id="product_id" value="<?php echo $productListVal->id;?>">
												<input type="hidden" class="option number" name="cateory_id" id="cateory_id" value="<?php echo $productListVal->category_id;?>">                
												<input type="hidden" class="option number" name="sell_id" id="sell_id" value="<?php echo $productListVal->user_id;?>">
												<input type="hidden" class="option number" name="price" id="price" value="<?php echo $productListVal->sale_price;?>">
												<input type="hidden" class="option number" name="product_shipping_cost" id="product_shipping_cost" value="<?php echo $productListVal->shipping_cost;?>"> 
												<input type="hidden" class="option number" name="product_tax_cost" id="product_tax_cost" value="<?php echo $productListVal->tax_cost;?>">
												<input type="hidden" class="option number" name="attribute_values" id="attribute_values" value="<?php echo $attrValsSetLoad; ?>">
											<?php if($discPrice != ''){?>
												<tr>
													<td colspan="3" class="bg_blue border_blue color_white">
														<div class="m_top_2 m_bottom_6"><span class="fw_light d_inline_m m_right_5">Use Coupon Code <div style="color: #ec1e20;font-size:13px;display:inline-block;">"<?php echo $couponCode;?>"</div> to Get Additional <?php echo number_format($discVal);?>% DIscount</span></div>
													</td>
												</tr>
											<?php }?>
											</tbody>
						</table>
                
						<hr class="divider_light m_bottom_15">
						<p class="fw_light m_bottom_14 color_grey"><?php echo $productListVal->description;?></p>
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
		<script src="plugins/afterresize.min.js"></script>
		<script src="plugins/jquery.elevateZoom-3.0.8.min.js"></script>
		
	 
		<!--Page Js-->
		<script src="js/site/Socktail-shoplist.js"></script>
		<script src="js/site/main4.js" type="text/javascript"></script>
		
		
		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>