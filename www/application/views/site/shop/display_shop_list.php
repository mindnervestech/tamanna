<?php
$this->load->view('site/templates/header_new');
?>
			<section class="section_offset">
				<div class="container t_align_c">
					<div class="row">
						<h1 class="fw_light second_font color_dark tt_uppercase m_bottom_27">Browse By Categories</h1>
					</div>
				</div>
			</section>
<!--main content-->
			<section class="section_offset">
				<div class="container">
					<div class="row">
						<?php 					
						foreach ($mainCategories->result() as $mainCategoriesRow){
							if($mainCategoriesRow->cat_name != 'Our Picks'&& $mainCategoriesRow->cat_name != 'SALE' && $mainCategoriesRow->cat_name != 'Xpress Ship'){
							$cat_img = '';
							if ($mainCategoriesRow->image != ''){
								if (file_exists('images/category/'.$mainCategoriesRow->image)){
									$cat_img = base_url().'images/category/'.$mainCategoriesRow->image;
								}	
							}
						?>
							<div class="col-lg-4 col-md-4 col-sm-6 m_sm_bottom_30 animated hidden m_bottom_27" data-animation="fadeInDown">
								<!--banner-->
								<a href="shopby/<?php echo $mainCategoriesRow->seourl;?>">
								<figure class="relative wrapper scale_image_container r_image_container">
									<img src="<?php echo $cat_img;?>" alt="<?php echo $mainCategoriesRow->cat_name;?>"class="tr_all scale_image">
									<!--caption-->
									<figcaption class="caption_type_1 pos_2 tr_all t_align_c">
										<div class="d_inline_b color_white fw_light caption_title tt_uppercase bg_lbrown_translucent w_full">
											<h3 class="color_white second_font fw_light m_bottom_5 w_break"><?php echo $mainCategoriesRow->cat_name;?></h3>
										</div>
									</figcaption>
								</figure>
								</a>
							</div>
			           <?php 
			             	}
			           }
			           ?>						
					</div>
				</div>
			</section>
			<div class="section_offset p_bottom_0">
				<div class="container">
					<hr class="divider_lbrown m_bottom_25 animated hidden" data-animation="fadeInDown">
					<div class="row sh_container">
						<div class="col-lg-4 col-md-4 col-sm-4 same_height animated hidden" data-animation="fadeInDown">
							<section class="item_represent relative m_bottom_25 m_xs_bottom_30 h_inherit t_sm_align_c">
								<!--icon-->
								<div class="d_inline_m m_sm_bottom_15 m_sm_right_0 bg_lbrown color_white m_right_17 icon_wrap_1 t_align_c vc_child"><i class="fa fa-lock d_inline_m"></i></div>
								<!--description-->
								<div class="d_inline_m description w_sm_full">
									<h3 class="second_font color_dark m_bottom_10">Safe &amp; Secure</h3>
									<p class="fw_light m_bottom_10">Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue.</p>
									<a href="#" class="sc_hover second_font">Click Here to Read More</a>
								</div>
							</section>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 same_height animated hidden" data-animation="fadeInDown" data-animation-delay="150">
							<section class="item_represent with_divider relative m_bottom_25 m_xs_bottom_30 h_inherit t_sm_align_c">
								<!--icon-->
								<div class="d_inline_m m_sm_bottom_15 m_sm_right_0 bg_lbrown color_white m_right_17 icon_wrap_1 t_align_c vc_child"><i class="fa fa-truck d_inline_m"></i></div>
								<!--description-->
								<div class="d_inline_m description">
									<h3 class="second_font color_dark m_bottom_10">Free Delivery</h3>
									<p class="fw_light m_bottom_10">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maurisfermentum dictum.</p>
									<a href="#" class="sc_hover second_font">Click Here to Read More</a>
								</div>
							</section>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 same_height animated hidden" data-animation="fadeInDown" data-animation-delay="300">
							<section class="item_represent with_divider relative m_bottom_25 m_xs_bottom_30 h_inherit t_sm_align_c">
								<!--icon-->
								<div class="d_inline_m m_sm_bottom_15 m_sm_right_0 bg_lbrown color_white m_right_17 icon_wrap_1 t_align_c vc_child"><i class="fa fa-certificate d_inline_m"></i></div>
								<!--description-->
								<div class="d_inline_m description">
									<h3 class="second_font color_dark m_bottom_10">Money Back Guarantee</h3>
									<p class="fw_light m_bottom_10">Etiam cursus leo vel metus. Nulla facilisi aenean nac eros. Vestibulum ante ipsum.</p>
									<a href="#" class="sc_hover second_font">Click Here to Read More</a>
								</div>
							</section>
						</div>
					</div>
					<hr class="divider_lbrown m_bottom_0 animated hidden" data-animation="fadeInDown">
				</div>
			</div>
			<!--new products-->
			<div class="section_offset p_bottom_0 m_bottom_27">
				<div class="container">
					<div class="d_table m_bottom_5 w_full animated hidden" data-animation="fadeInDown">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 v_align_m d_table_cell f_none">
							<h5 class="second_font color_dark tt_uppercase fw_light d_inline_m m_bottom_4">Newly Added</h5>	
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 t_align_r d_table_cell f_none">
							<!--carousel navigation-->
							<div class="clearfix d_inline_b">
								<button class="new_prev black_hover button_type_4 grey state_2 tr_all d_block f_left vc_child m_right_5"><i class="fa fa-angle-left d_inline_m"></i></button>
								<button class="new_next black_hover button_type_4 grey state_2 tr_all d_block f_left vc_child"><i class="fa fa-angle-right d_inline_m"></i></button>
							</div>
						</div>
					</div>
					<hr class="divider_bg m_bottom_15 animated hidden" data-animation="fadeInDown" data-animation-delay="100">
					<div class="row">
						<div class="owl-carousel" data-nav="new_" data-owl-carousel-options='{
									"stagePadding" : 15,
									"margin" : 30,
									"responsive" : {
											"0" : {
												"items" : 1
											},
											"320" : {
												"items" : 2
											},
											"550" : {
												"items" : 3
											},
											"992" : {
												"items" : 4
											}
										}
									}'>
							<?php 
							foreach ($recentProducts->result() as $relatedRow){
								$img = 'dummyProductImage.jpg';
								$imgArr = array_filter(explode(',', $relatedRow->image));
								if (count($imgArr)>0){
									foreach ($imgArr as $imgRow){
										if ($imgRow != ''){
											$img = $imgRow;
											break;
										}
									}
								}
							?>
							<!--owl item-->
							<div class="animated hidden" data-animation="fadeInDown" data-animation-delay="200">
								<!--product-->
								<figure class="relative r_image_container c_image_container qv_container">
									<a href="<?php echo base_url();?>things/<?php echo $relatedRow->id;?>/<?php echo url_title($relatedRow->product_name,'-');?>">
									<div class="d_block m_bottom_15 relative">
										<img src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="<?php echo $relatedRow->product_name;?>" class="c_image_1 tr_all">
										<img src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="<?php echo $relatedRow->product_name;?>" class="c_image_2 tr_all">
									</div>
									</a>
									<figcaption class="t_align_c">
										<ul>
											<li><a href="<?php echo base_url();?>things/<?php echo $relatedRow->id;?>/<?php echo url_title($relatedRow->product_name,'-');?>" class="second_font sc_hover"><?php echo $relatedRow->product_name;?></a></li>
										</ul>
									</figcaption>
								</figure>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<!--bestsellers-->
			<div class="section_offset p_bottom_0 p_top_0">
				<div class="container">
					<div class="d_table m_bottom_5 w_full animated hidden" data-animation="fadeInDown">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 v_align_m d_table_cell f_none">
							<h5 class="second_font color_dark tt_uppercase fw_light d_inline_m m_bottom_4">Bestsellers</h5>	
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 t_align_r d_table_cell f_none">
							<!--carousel navigation-->
							<div class="clearfix d_inline_b">
								<button class="bestsellers_prev black_hover button_type_4 grey state_2 tr_all d_block f_left vc_child m_right_5"><i class="fa fa-angle-left d_inline_m"></i></button>
								<button class="bestsellers_next black_hover button_type_4 grey state_2 tr_all d_block f_left vc_child"><i class="fa fa-angle-right d_inline_m"></i></button>
							</div>
						</div>
					</div>
					<hr class="divider_bg m_bottom_15 animated hidden" data-animation="fadeInDown" data-animation-delay="100">
					<div class="row">
						<div class="owl-carousel" data-nav="bestsellers_" data-owl-carousel-options='{
									"stagePadding" : 15,
									"margin" : 30,
									"responsive" : {
											"0" : {
												"items" : 1
											},
											"320" : {
												"items" : 2
											},
											"550" : {
												"items" : 3
											},
											"992" : {
												"items" : 4
											}
										}
									}'>
							<!--owl item-->
							<?php 
							foreach ($favoriteProducts->result() as $relatedRow){
								$img = 'dummyProductImage.jpg';
								$imgArr = array_filter(explode(',', $relatedRow->image));
								if (count($imgArr)>0){
									foreach ($imgArr as $imgRow){
										if ($imgRow != ''){
											$img = $imgRow;
											break;
										}
									}
								}
							?>
							<div class="animated hidden" data-animation="fadeInDown" data-animation-delay="200">
								<!--product-->
								<figure class="relative r_image_container c_image_container qv_container">
									<a href="<?php echo base_url();?>things/<?php echo $relatedRow->id;?>/<?php echo url_title($relatedRow->product_name,'-');?>">
									<div class="d_block m_bottom_15 relative">
										<img src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="<?php echo $relatedRow->product_name;?>" class="c_image_1 tr_all">
										<img src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="<?php echo $relatedRow->product_name;?>" class="c_image_2 tr_all">
										<a data-popup="#quick_view" data-popup-transition-in="bounceInUp" data-popup-transition-out="bounceOutUp" class="tr_all color_white second_font qv_style_button quick_view tt_uppercase t_align_c d_block clickable d_xs_none"><i class="fa fa-eye d_inline_m m_right_10"></i><span class="fs_medium">Quick View</span></a>
									</div>
									</a>
									<figcaption class="t_align_c">
										<ul>
											<li><a href="<?php echo base_url();?>things/<?php echo $relatedRow->id;?>/<?php echo url_title($relatedRow->product_name,'-');?>" class="second_font sc_hover"><?php echo $relatedRow->product_name;?></a></li>
											<li class="m_bottom_16"><b class="fs_large second_font scheme_color">Rs <?php echo $relatedRow->sale_price;?></b></li>
										</ul>
									</figcaption>
								</figure>
							</div>
							<?php 
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<!--footer-->
<?php
$this->load->view('site/templates/footer');
?>
		</div>

		<!--back to top-->
		<button class="back_to_top animated button_type_6 grey state_2 d_block black_hover f_left vc_child tr_all"><i class="fa fa-angle-up d_inline_m"></i></button>

		<!--libs include-->
		<script src="plugins/royalslider/jquery.royalslider.min.js"></script>
		<script src="plugins/countdown/jquery.plugin.min.js"></script>
		<script src="plugins/countdown/jquery.countdown.min.js"></script>
		<script src="plugins/royalslider/jquery.easing-1.3.js"></script>
		<script src="plugins/jquery.appear.js"></script>
		<script src="plugins/owl-carousel/owl.carousel.min.js"></script>
		<script src="plugins/afterresize.min.js"></script>
		<script src="plugins/jackbox/js/jackbox-packed.min.js"></script>
		<script src="plugins/jquery.elevateZoom-3.0.8.min.js"></script>
		<script src="plugins/fancybox/jquery.fancybox.pack.js"></script>
		<script src="js/retina.min.js"></script>
		<script src="plugins/colorpicker/colorpicker.js"></script>
		 

		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>