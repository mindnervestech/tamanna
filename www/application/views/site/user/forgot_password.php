<?php
$this->load->view('site/templates/header_new_small');
?>
			<!--main content-->
			<div class="page_section_offset m_bottom_50">
				<div class="container">
					<div class="row m_bottom_50">
						<aside class="col-lg-4 col-md-4 col-sm-4 p_top_4">
						</aside>
						<section class="col-lg-4 col-md-4 col-sm-4">
							<h2 class="fw_light second_font color_dark m_bottom_14 tt_uppercase t_align_c">Forgot Password?</h2>
							<div class="m_bottom_14 t_align_c">
							<span class="d_inline_m second_font fs_medium color_red d_md_block t_align_c">Enter your email address to reset it.</span>
							</div>
							<form method="post" action="site/user/forgot_password_user" class="frm clearfix"><input type='hidden' />
								<ul class="m_bottom_14">
													<li class="m_bottom_15">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">Email Address</label>
														<input type="text" id="username" class="w_full tr_all" name="email" placeholder="" autofocus="autofocus"">
														<input class="next_url" type="hidden" name="next" value="/"/>
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
														<button type="submit" class="btns-blue-embo btn-signin t_align_c tt_uppercase w_full second_font d_block fs_medium button_type_2 lbrown tr_all">Reset Password</button>
													</li>
								</ul>
							</form>
						</section>
						<aside class="col-lg-2 col-md-2 col-sm-2 p_top_2">
						</aside>
					</div>
				</div>
			</div>
			<!--footer-->
				<?php
					$this->load->view('site/templates/footer');
				?>
		</div>

		<!--libs include-->
		<script src="plugins/jquery.appear.js"></script>
		<script src="plugins/afterresize.min.js"></script>

		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>