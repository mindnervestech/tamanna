<?php
$this->load->view('site/templates/header_new_small');
?>
			<!--main content-->
			<div class="page_section_offset" style="padding: 3px 0 75px;">
				<div class="container">
					<div class="row">
						<aside class="col-lg-4 col-md-4 col-sm-4 p_top_4">
						</aside>
						<section class="col-lg-4 col-md-4 col-sm-4">
							<h2 class="fw_light second_font color_dark m_bottom_27 tt_uppercase t_align_c">Register</h2>
							<form onSubmit="return register_user();" method="post">
								<ul class="m_bottom_14">
													<li class="m_bottom_15">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">Full Name</label>
														<input type="text" autofocus="autofocus" id="fullname" class="fullname w_full tr_all" name="full_name" placeholder="">
													</li>
													<li class="m_bottom_15">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">Username</label>
														<input  type="text" id="username" class="username w_full tr_all" name="user_name" placeholder="" onKeyUp="$(this).parents('.email-frm ').find('.url b').text($(this).val())" value="">
													</li>
													<li class="m_bottom_15">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">Email Address</label>
														<input  type="text" id="email" class="email w_full tr_all" name="email" value="">
													</li>
													<?php $pwdLength = 10;
														$userNewPwd = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $pwdLength);
													?>
													<li class="m_bottom_20">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Password</label>
														<input type="password" id="user_password" class="password w_full tr_all" name="password" placeholder="<?php if($this->lang->line('signup_min_chars') != '') { echo stripslashes($this->lang->line('signup_min_chars')); } else echo "Minimum 6 characters"; ?>" value="" />
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
														 <?php 
														$yoursitepage = str_replace("{SITENAME}",$siteTitle,$this->lang->line('signup_sitepage'));
														$siteaccswrld = str_replace("{SITENAME}",$siteTitle,$this->lang->line('signup_access_wrld'));
														 ?>
													</li>
														<input name="referrer" type="hidden" class="referrer" value="" />
														<input name="invitation_key" type="hidden" class="invitation_key" value="" />
														<input type='hidden' name='csrfmiddlewaretoken' value='UFLfIU881eyZJbm7Bq0kUFZ9sVaWGh54' />
														<input type='hidden' name='api_id' id="api_id"  value='<?php echo $social_login_session_array['social_login_unique_id'];?>' />
														<input type='hidden' name='thumbnail' id='thumbnail' value='<?php echo $social_login_session_array['social_image_name'];?>' />
														<input type='hidden' name='loginUserType' id='loginUserType' value='<?php if($social_login_session_array['loginUserType'] != '') echo $social_login_session_array['loginUserType']; else echo "normal";?>' />

													<li class="m_bottom_20">
														<p>
															<input type="checkbox" name="brandSt" class="brandSt" id="brandSt">
															<label for="brandSt"  onClick="$(this).parents('p').find('input').toggleClass('checked');" class="brand" class="second_font fs_medium">I want to register as a seller</label>
														</p>
													</li>
													<li>
														<button class="btns-blue-embo sign t_align_c tt_uppercase w_full second_font d_block fs_medium button_type_2 lbrown tr_all">Create Account</button>
													</li>
								</ul>
								<div class="m_bottom_14 t_align_c">
														<span class="d_inline_m second_font fs_medium color_red d_md_block">By creating an account, I accept Socktail's Terms of Service, 
Seller's Policies and Privacy Policy.</span>
								</div>
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

		<!--back to top-->
		<button class="back_to_top animated button_type_6 grey state_2 d_block black_hover f_left vc_child tr_all"><i class="fa fa-angle-up d_inline_m"></i></button>

		<!--libs include-->
		<script src="plugins/jquery.appear.js"></script>
		<script src="plugins/owl-carousel/owl.carousel.min.js"></script>
		<script src="plugins/twitter/jquery.tweet.min.js"></script><script src="plugins/flickr.js"></script>
		<script src="plugins/afterresize.min.js"></script>
		<script src="plugins/jackbox/js/jackbox-packed.min.js"></script>
		<script src="js/retina.min.js"></script>
		<script src="plugins/colorpicker/colorpicker.js"></script>
		 

		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>