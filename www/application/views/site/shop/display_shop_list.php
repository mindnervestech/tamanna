<?php
$this->load->view('site/templates/header_new');
?>
			<section class="section_offset">
				<div class="container t_align_c">
					<div class="row">
						<h1 class="fw_light second_font color_dark tt_uppercase m_bottom_13">Browse By Categories</h1>
						<h4 class="fw_light second_font color_dark tt_uppercase m_bottom_13">Shop by Heart</h4>
							<hr class="m_bottom_14">
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
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 m_sm_bottom_30 animated hidden m_bottom_27" data-animation="fadeInDown">
								<!--banner-->
								<a href="shopby/<?php echo $mainCategoriesRow->seourl;?>">
								<figure class="relative wrapper scale_image_container r_image_container">
									<img src="<?php echo $cat_img;?>" alt="<?php echo $mainCategoriesRow->cat_name;?>"class="tr_all scale_image" style="width:400px; height:241px;">
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
				<!-- Our Promise -->
			<div class="section_offset p_bottom_0">
				<div class="container bg_grey_light_2">
					<hr class="divider_lbrown m_bottom_25 animated hidden" data-animation="fadeInDown">
					<div class="row sh_container">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 same_height animated hidden" data-animation="fadeInDown">
							<section class="item_represent relative m_bottom_25 m_xs_bottom_30 h_inherit t_sm_align_c t_align_c">
								<i class="fa fa-gift fa-3x"></i>
								<!--description-->
									<p class="fw_light m_bottom_10 m_top_15">Carefully Curated</p>
							</section>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 same_height animated hidden" data-animation="fadeInDown">
							<section class="item_represent relative m_bottom_25 m_xs_bottom_30 h_inherit t_sm_align_c t_align_c">
								<i class="fa fa-thumbs-up fa-3x"></i>
								<!--description-->
									<p class="fw_light m_bottom_10 m_top_15">Quality Products</p>
							</section>
						</div>	
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 same_height animated hidden" data-animation="fadeInDown">
							<section class="item_represent relative m_bottom_25 m_xs_bottom_30 h_inherit t_sm_align_c t_align_c">
								<!--icon-->
								<i class="fa fa-money fa-3x"></i>
								<!--description-->
									<p class="fw_light m_bottom_10 m_top_15">No Fake Discounts</p>
							</section>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 same_height animated hidden" data-animation="fadeInDown">
							<section class="item_represent relative m_bottom_25 m_xs_bottom_30 h_inherit t_sm_align_c t_align_c">
								<i class="fa fa-credit-card fa-3x"></i>
								<!--description-->
									<p class="fw_light m_bottom_10 m_top_15">Easy Payment Terms</p>
							</section>
						</div>						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 same_height animated hidden" data-animation="fadeInDown">
							<section class="item_represent relative m_bottom_25 m_xs_bottom_30 h_inherit t_sm_align_c t_align_c">
								<!--icon-->
								<i class="fa fa-truck fa-3x"></i>
								<!--description-->
									<p class="fw_light m_bottom_10 m_top_15">Free Home Delivery</p>
							</section>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 same_height animated hidden" data-animation="fadeInDown">
							<section class="item_represent relative m_bottom_25 m_xs_bottom_30 h_inherit t_sm_align_c t_align_c">
								<i class="fa fa-wrench fa-3x"></i>
								<!--description-->
									<p class="fw_light m_bottom_10 m_top_15">Free Installation</p>
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
		<script src="plugins/jquery.appear.js"></script>
		<script src="plugins/owl-carousel/owl.carousel.min.js"></script>
		<script src="plugins/afterresize.min.js"></script>
		<script src="js/retina.min.js"></script>
		 

		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>