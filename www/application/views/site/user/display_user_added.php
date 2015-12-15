<?php
$this->load->view('site/templates/header_new_small');
?>
        <?php 
        $userImg = 'user-thumb1.png';
        if ($userProfileDetails->row()->thumbnail != ''){
	        $userImg = $userProfileDetails->row()->thumbnail;
        } 
		?>
			<!--main content-->
			<div class="page_section_offset">
				<div class="container">
					<div class="row">
						<section class="col-lg-12 col-md-12 col-sm-12 m_bottom_50">
							<h2 class="fw_light second_font color_dark m_bottom_27 tt_uppercase"><?php echo $userProfileDetails->row()->full_name;?></h2>
							<div class="clearfix m_bottom_50">
								<div class="t_xs_align_c f_left m_right_20 m_xs_bottom_15 f_xs_none"><img src="<?php echo base_url();?>images/users/<?php echo $userImg;?>" alt="<?php echo $userProfileDetails->row()->full_name;?>"></div>
								<p class="fw_light m_bottom_14 p_top_4"><?php if ($userProfileDetails->row()->about != '') {echo $userProfileDetails->row()->about;} else {echo $userProfileDetails->row()->brand_description;}?></p>
							</div>
							<hr class="divider_light m_bottom_15">
							<h2 class="fw_light second_font color_dark tt_uppercase m_bottom_27">My Products</h2>
							<?php if ($addedProductDetails->num_rows()>0 || $notSellProducts->num_rows()>0){?>
							<!--isotope-->
							<div id="can_change_layout" class="category_isotope_container three_columns wrapper m_bottom_10 m_xs_bottom_0" data-isotope-options='{
								"itemSelector": ".category_isotope_item",
					  			"layoutMode": "fitRows"
							}'>
							<?php
							foreach ($addedProductDetails->result() as $productLikeDetailsRow){
							$imgName = 'dummyProductImage.jpg';
							$imgArr = explode(',', $productLikeDetailsRow->image);
							if (count($imgArr)>0){
								foreach ($imgArr as $imgRow){
									if ($imgRow != ''){
										$imgName = $imgRow;
										break;
									}
								}
							}
							?>

								<!--isotope item-->
								<div class="category_isotope_item">
									<figure class="product_item type_2 c_image_container relative frame_container t_sm_align_c r_image_container qv_container">
										<!--image & buttons & label-->
										<div class="relative">
										<a class="second_font sc_hover d_xs_block" href="<?php echo 'things/'.$productLikeDetailsRow->id.'/'.url_title($productLikeDetailsRow->product_name);?>">
											<div class="d_block">
												<img src="images/product/<?php echo $imgName;?>" alt="" class="c_image_1 tr_all">
												<img src="images/product/<?php echo $imgName;?>" alt="" class="c_image_2 tr_all">
											</div>
										</a>
										</div>
										<figcaption class="bg_white relative p_bottom_0">
											<div class="row">
												<div class="col-lg-7 col-md-7 m_bottom_9">
													<a class="second_font sc_hover d_xs_block" href="<?php echo 'things/'.$productLikeDetailsRow->id.'/'.url_title($productLikeDetailsRow->product_name);?>"><?php echo $productLikeDetailsRow->product_name;?></a>
													<hr class="d_none divider_light m_bottom_15">
												</div>
												<div class="col-lg-5 col-md-5 color_light fs_large second_font t_align_r t_sm_align_c m_bottom_9">
													<b class="scheme_color d_block">Rs <?php echo $productLikeDetailsRow->sale_price;?></b>
												</div>
											</div>
										</figcaption>
									</figure>
								</div>
							<?php }?>
							  <?php 
							  foreach ($notSellProducts->result() as $productLikeDetailsRow){
									$imgName = 'dummyProductImage.jpg';
									$imgArr = explode(',', $productLikeDetailsRow->image);
									if (count($imgArr)>0){
										foreach ($imgArr as $imgRow){
											if ($imgRow != ''){
												$imgName = $imgRow;
												break;
											}
										}
									}
							  ?>						
								<!--isotope item-->
								<div class="category_isotope_item">
									<figure class="product_item type_2 c_image_container relative frame_container t_sm_align_c r_image_container qv_container">
										<!--image & buttons & label-->
										<div class="relative">
										<a class="second_font sc_hover d_xs_block" href="<?php echo 'user/'.$userProfileDetails->row()->user_name.'/things/'.$productLikeDetailsRow->seller_product_id.'/'.url_title($productLikeDetailsRow->product_name);?>">
											<div class="d_block">
												<img src="images/product/<?php echo $imgName;?>" alt="" class="c_image_1 tr_all">
												<img src="images/product/<?php echo $imgName;?>" alt="" class="c_image_2 tr_all">
											</div>
										</a>
										</div>
										<figcaption class="bg_white relative p_bottom_0">
											<div class="row">
												<div class="col-lg-7 col-md-7 m_bottom_9">
													<a class="second_font sc_hover d_xs_block" href="<?php echo 'user/'.$userProfileDetails->row()->user_name.'/things/'.$productLikeDetailsRow->seller_product_id.'/'.url_title($productLikeDetailsRow->product_name);?>"><?php echo $productLikeDetailsRow->product_name;?></a>
													<hr class="d_none divider_light m_bottom_15">
												</div>
												<div class="col-lg-5 col-md-5 color_light fs_large second_font t_align_r t_sm_align_c m_bottom_9">
													<b class="scheme_color d_block">Rs <?php echo $userProfileDetails->sale_price;?></b>
												</div>
											</div>
										</figcaption>
									</figure>
								</div>
														
							</div>
							<?php }}?>
						</section>
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

<!-- Section_start -->
<script type="text/javascript" src="js/site/profile_things.js"></script>
<script>
        $.infiniteshow({
            itemSelector:'#content ol.stream > li',
            streamSelector:'#content ol.stream',
            dataKey:'home-new',
            post_callback: function($items){ $('ol.stream').trigger('itemloaded') },
            prefetch:true,
            
            newtimeline:true
        })
        if($.browser.msie) $.infiniteshow.option('prepare',1000);
</script>
		
		<!--libs include-->
		<script src="plugins/jquery.appear.js"></script>
		<script src="plugins/isotope.pkgd.min.js"></script>
		<script src="plugins/afterresize.min.js"></script>
		<script src="js/retina.min.js"></script>

		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>