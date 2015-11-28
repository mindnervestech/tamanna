<?php
$this->load->view('site/templates/header_new_small');
?>			<!--main content-->
			<div class="page_section_offset" style="padding: 13px 0 25px;">
				<div class="container">
					<div class="row">
						<aside class="col-lg-3 col-md-3 col-sm-3 m_xs_bottom_30 p_top_4">
							<!--categories widget-->
							<section class="m_bottom_30">
								<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Account</h5>
								<hr class="divider_bg m_bottom_23">
								<ul class="categories_list second_font w_break">
								<!--	<li class="relative"><a href="#" class="fs_large_0 d_inline_b">Profile</a>
									</li> -->
									<li class="relative"><a href="settings/password" class="<?php if ($this->uri->segment(2)=='password'){?>current<?php }?> fs_large_0 d_inline_b">Password</a>
									</li>
									<li class="relative"><a href="purchases"  class="<?php if ($this->uri->segment(1)=='purchases'){?>current<?php }?> fs_large_0 d_inline_b">Purchases</a>
									</li>
									<li class="relative"><a href="settings/shipping"  class="<?php if ($this->uri->segment(2)=='shipping'){?>current<?php }?> fs_large_0 d_inline_b">Shipping Address</a>
									</li>
									<?php if ($userDetails->row()->group == 'Seller'){?>
										<li class="relative"><a href="orders"  class="<?php if ($this->uri->segment(1)=='orders'){?>current<?php }?> fs_large_0 d_inline_b">Orders</a>
										</li>
									<?php }?>
								</ul>
							</section>
						</aside>
						<main class="col-lg-9 col-md-9 col-sm-9 m_bottom_30 m_xs_bottom_10">
							<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Change Password</h5>
							<hr class="divider_light m_bottom_5">
							<div class="page_section_offset">
									<div class="row">
										<aside class="col-lg-3 col-md-3 col-sm-3 p_top_4">
										</aside>
										<div class="col-lg-6 col-md-6 col-sm-6 m_bottom_30 m_xs_bottom_10">
										<form onsubmit="return change_user_password();" method="post" action="<?php echo base_url().'site/user_settings/change_user_password'?>">
											<ul class="m_bottom_14">
																<li class="m_bottom_20">
																	<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">New Password</label>
																	<input  type="password" name="pass" id="pass" class="w_full tr_all">
																	<input class="next_url" type="hidden" name="next" value="<?php echo $next;?>"/>
																</li>
																<li class="m_bottom_20">
																	<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Confirm Password</label>
																	<input  type="password" name="confirmpass" id="confirmpass"  class="w_full tr_all">
																	<input class="next_url" type="hidden" name="next" value="<?php echo $next;?>"/>
																	<?php if (validation_errors() != ''){?>
																		<div id="validationErr">
																			<script>setTimeout("hideErrDiv('validationErr')", 3000);</script>
																			<span class="d_inline_m second_font fs_medium color_red d_md_block"><?php echo validation_errors();?></span>
																		</div>
																		<?php }?>
																		<?php if($flash_data != '') { ?>
																		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
																			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
																			<span class="d_inline_m second_font fs_medium color_red d_md_block"><?php echo $flash_data;?></span>
																		</div>
																	<?php } ?>
																</li>
																<li>
																	<button class="btn-save t_align_c tt_uppercase w_full second_font d_block fs_medium button_type_2 lbrown tr_all"  id="save_password"><?php if($this->lang->line('change_password') != '') { echo stripslashes($this->lang->line('change_password')); } else echo "Change Password"; ?></button>
																</li>
											</ul>
										</form>
										</div>
										<aside class="col-lg-3 col-md-3 col-sm-3 p_top_4">
										</aside>
									</div>
							</div>
						</main>
					</div>
				</div>
			</div>
		<!--footer-->
				<?php
					$this->load->view('site/templates/footer');
				?>
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
		 

		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>