<?php
$this->load->view('site/templates/header_new_small');
?>
<style type="text/css" media="screen">
h1 {
margin-bottom: 50px;
}
</style>
			<!--main content-->
			<div class="page_section_offset m_bottom_50" style="padding: 0 0 25px;">
				<div class="container">
					<div class="row">
						<aside class="col-lg-4 col-md-4 col-sm-4 p_top_4">
						</aside>
						<section class="col-lg-4 col-md-4 col-sm-4">
							<div id="container-wrapper">
									<div id="content">
										<?php if($flash_data != '') { ?>
											<div class="errorContainer" id="<?php echo $flash_data_type;?>">
												<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
												<p><span><?php echo $flash_data;?></span></p>
											</div>
										<?php } ?>
										<section class="merchant">
											<h2 class="fw_light second_font color_dark m_bottom_27 tt_uppercase t_align_c"><?php echo "Customization Request"; ?></h2>
											<h5 class="fw_light second_font color_dark m_bottom_27 tt_uppercase t_align_c"><?php echo "Tell Us Your Customization Requirements "; ?></h5>
											<form action="site/user/custom_request_submit" method="post" id="custom_request" onsubmit="return validateForm();">
												<div class="error-box" style="display:none;">
													<p><?php if($this->lang->line('seller_some_requi') != '') { echo stripslashes($this->lang->line('seller_some_requi')); } else echo "Some required information is missing or incomplete. Please correct your entries and try again"; ?>.</p>
													<ul></ul>
												</div>
												<ul class="m_bottom_14">
													<li class="m_bottom_15">
														<label for="" class="label second_font m_bottom_4 d_inline_b fs_medium"><?php echo "Project Name"; ?><sup style="color: red;">*</sup></label>
														<input type="text" name="project_name" id="project_name" class="w_full tr_all" />
													</li>
													<li class="m_bottom_15">
														<label for="" class="label second_font m_bottom_4 d_inline_b fs_medium"><?php echo "Specify the Size"; ?></label>
														<input type="text" name="size" id="size" style="margin-bottom: 10px;" class="w_full tr_all"/>
													</li>
													<li class="m_bottom_15">
														<label for="" class="label second_font m_bottom_4 d_inline_b fs_medium"><?php echo "Specify the Color"; ?></label>
														<input type="text" name="color" id="color" class="w_full tr_all"/>
													</li>
													<li class="m_bottom_15">
														<label for="" class="label second_font m_bottom_4 d_inline_b fs_medium"><?php echo "Specify the Material"; ?></label>
														<input type="text" name="material" id="material" class="w_full tr_all"/>
													</li>
													<li class="m_bottom_15">
														<label for="" class="label second_font m_bottom_4 d_inline_b fs_medium"><?php echo "Specify Requirements"; ?><sup style="color: red;">*</sup></label>
														<div id="bio" class="setting_bio f_left field_container" name="setting-bio" max-length="180" style="width:100%">
															<textarea class="w_full tr_all" rows="6" type="text" name="project_description" id="project_description"></textarea>
														</div>
												<!--		<input type="text" name="project_description" id="project_description" style="height:100px;" class="w_full tr_all"/> -->
													</li>
													<li class="m_bottom_15">
														<label for="" class="label second_font m_bottom_4 d_inline_b fs_medium"><?php echo "City"; ?></label>
														<input type="text" name="city" id="city" class="w_full tr_all"/>
													</li>
													<li class="m_bottom_15">
														<label for="" class="label second_font m_bottom_4 d_inline_b fs_medium"><?php echo "Your Phone Number"; ?><sup style="color: red;">*</sup></label>
														<input type="text" name="phone_no" id="phone_no"  class="w_full tr_all"/>
													</li>
													<li class="m_bottom_15">
														<label for="" class="label second_font m_bottom_4 d_inline_b fs_medium"><?php echo "Your Email ID"; ?><sup style="color: red;">*</sup></label>
														<input type="text" name="email" id="email"  class="w_full tr_all"/>
													</li>
												</ul>
												<div class="btn-area">
													<button class="btn-green t_align_c tt_uppercase w_full second_font d_block fs_medium button_type_2 lbrown tr_all" id="sign-up" re-url="/sales/create?ntid=7220865&amp;ntoid=15301425" ><?php echo "Submit Request"; ?></button>
												</div>
											</form>
										</section>
										<hr />
									</div>
							</div>
						</section>
						<aside class="col-lg-4 col-md-4 col-sm-4 p_top_4">
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
		<script src="plugins/afterresize.min.js"></script>
		<!--Page Script-->
			<script type="text/javascript" src="js/site/jquery.validate.js"></script>
			<script>
			$("#custom_request").validate({
				});

			function validateForm(){
				var project_name = $('#project_name').val();
				var project_description = $('#project_description').val();
				var phone_no = $('#phone_no').val();
				$email = $('#email').val();
				if(project_name == ''){
					alert('Project name required');
					$('#project_name').focus();
					return false;
				}else if(project_description == ''){
					alert('Specify Requirements');
					$('#project_description').focus();
					return false;
				}else if(phone_no == ''){
					alert('Phone number required so that we can contact you to discuss requirements in detail');
					$('#phone_no').focus();
					return false;
				}else if($email == ''){
					alert('Email ID is required so that we can send you estimated cost and delivery timelines');
					$('#email').focus();
					return false;
				}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					alert('Invalid email format');
					$('#email').focus();
					return false;
					}
			}

			</script>
<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>