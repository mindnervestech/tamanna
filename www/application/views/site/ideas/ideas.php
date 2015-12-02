<?php
$this->load->view('site/templates/header_new_small');
?>
			<!--main content-->
			<div class="page_section_offset">
				<main class="container">
					<div class="d_table w_full d_xs_block m_bottom_27">
						<div class="col-lg-12 col-md-12 col-sm-12 f_none d_table_cell v_align_m d_xs_block m_xs_bottom_10 p_xs_left_0 px_right_0 t_align_c">
							<h1 class="fw_light second_font color_dark tt_uppercase">Designs, Pictures and Home Improvement Ideas</h1>
						</div>
<!--						<div class="col-lg-3 col-md-3 col-sm-3 f_none d_table_cell v_align_m t_align_r d_xs_block t_xs_align_l p_xs_left_0 px_right_0">
							<div class="styled_select relative sort d_inline_b t_align_l">
								<div class="select_title fw_light color_light relative d_none tr_all">All</div>
								<select>
									<option data-filter="*" value="All">All</option>
									<option data-filter=".bedroom" value="Bedroom">Bedroom</option>
									<option data-filter=".home_office" value="Home Office">Home Office</option>
									<option data-filter=".living_room" value="Living Room">Living Room</option>
								</select>
								<ul class="options_list d_none tr_all hidden bg_grey_light"></ul>
							</div>
						</div> -->
					</div>
					<div class="portfolio_isotope_container two_columns wrapper m_bottom_10 m_xs_bottom_0" data-isotope-options='{
						"itemSelector": ".portfolio_isotope_item",
			  			"layoutMode": "fitRows"
					}'>
					
						<?php
								$productArr = $productDetails;
								for ($i = 0; $i < count($productArr); $i = $i + 1)
								{
										if (isset($productArr[$i]->id))
										{
												$imgArr = explode(',', $productArr[$i]->image);
												$img = 'dummyProductImage.jpg';
												foreach($imgArr as $imgVal)
												{
														if ($imgVal != '')
														{
																$img = $imgVal;
																break;
														}
												}
												if (isset($productArr[$i]->web_link))
												{
														$prodLink = "user/" . $productArr[$i]->user_name . "/things/" . $productArr[$i]->seller_product_id . "/" . url_title($productArr[$i]->product_name, '-');
												}
												else
												{
														$prodLink = "things/" . $productArr[$i]->id . "/" . url_title($productArr[$i]->product_name, '-');
												}

						?>
						<!--isotope item-->
						<div class="portfolio_isotope_item living_room">
							<div class="frame_container relative r_image_container db_xs_centered">
								<a href="<?php echo $prodLink; ?>">
								<figure class="relative">
									<div class="d_block wrapper m_bottom_16 scale_image_container popup_container relative">
										<img src="images/product/<?php echo $img; ?>" alt="" class="tr_all scale_image">
									</div>
									<figcaption class="t_align_c">
										<h5 class="second_font m_bottom_5 lh_small"><a href="<?php echo $prodLink; ?>"><b><?php echo $productArr[$i]->product_name; ?></b></a></h5>
										<a href="<?php if ($productArr[$i]->user_id != '0'){echo base_url() . 'user/' . $productArr[$i]->user_name;}else{echo base_url() . 'user/administrator';} ?>"><?php echo $productArr[$i]->user_name; ?></a>
									</figcaption>
								</figure>
								</a>
							</div>
						</div>
					<?php
							}
										}
					?>						
					</div>
				</main>
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
		<script src="plugins/isotope.pkgd.min.js"></script>
		<script src="plugins/afterresize.min.js"></script>
		 

		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>