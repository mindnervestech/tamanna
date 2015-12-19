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
						<aside class="col-lg-2 col-md-2 col-sm-2 p_top_4">
						</aside>
						<section class="col-lg-8 col-md-8 col-sm-8">
							<div id="container-wrapper">
									<div id="content">
										<h2 class="fw_light second_font color_dark m_bottom_27 tt_uppercase t_align_c"><?php echo "Customization Request"; ?></h2>
										<h5 class="fw_light second_font color_dark m_bottom_27 tt_uppercase t_align_c"><?php echo "Tell Us Your Customization Requirements "; ?></h5>
										<hr class="divider_light m_bottom_5">
										
										<?php if($flash_data != '') { ?>
											<div class="errorContainer" id="<?php echo $flash_data_type;?>">
												<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
												<p><span><?php echo $flash_data;?></span></p>
											</div>
										<?php } ?>
									 
										<section class="merchant">
											<form action="site/user/custom_request_submit" method="post" id="custom_request" onsubmit="return validateForm();" enctype="multipart/form-data">
												<div class="error-box" style="display:none;">
													<p><?php if($this->lang->line('seller_some_requi') != '') { echo stripslashes($this->lang->line('seller_some_requi')); } else echo "Some required information is missing or incomplete. Please correct your entries and try again"; ?>.</p>
													<ul></ul>
												</div>
												<div class="row">
												<section class="col-lg-6 col-md-6 col-sm-6">
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
												 </section>
												 <section class="col-lg-6 col-md-6 col-sm-6">
													<ul class="m_bottom_14">
													
													<!-- custom Image 1 -->
													<li class="m_bottom_15">
														<label for="" class="label second_font m_bottom_4 d_inline_b fs_medium"><?php echo "Upload Reference Pictures/sketches"; ?></label>
														<div class="section photo">
															<section class="col-lg-12 col-md-12 col-sm-12 m_bottom_27">
																<div class="row">
																  <fieldset class="frm">
																	<div class="col-lg-6 col-md-6 col-sm-6">
																		<?php 
																		$doc2Img = '';
																		?>
																	<div class="photo-preview"><img id="customImage1" src="images/site/blank.gif" style="width:80px;height:80px;background-image:url(<?php echo base_url();?>images/users/custom/<?php echo $doc2Img?>);background-size:cover" alt=""></div>

																	</div>
																	<div class="col-lg-6 col-md-6 col-sm-6">
																			<div class="photo-func1">		
																				<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.photo-func1').hide();$('.doc1-upload-file').show();return false;" value="<?php if($this->lang->line('custom_photo_upload') != '') { echo stripslashes($this->lang->line('custom_photo_upload')); } else echo "Upload Photo/Sketch"; ?>"/>
																			</div>
																		
																			<div class="doc1-upload-file"  style="display:none">
																				<input id="customImage_1" img_upload="imageuploaddisplay2" img_id="customImage1" class="customImageUpload" name="customImage_one" type="file">
																				<span class="uploading" style="display:none"><?php if($this->lang->line('settings_uploading') != '') { echo stripslashes($this->lang->line('settings_uploading')); } else echo "Uploading..."; ?></span>
																				<span class="description"><?php echo "Allowed file types JPG, GIF or PNG.<br>"; ?></span>
																			</div>
																		
																	</div>
																  </div>
																</section>
																</fieldset>
															</div>
														</li>
													<!-- custom Image 1 end -->
													<!-- custom Image 2 -->
													<li class="m_bottom_15 imageuploaddisplay" id="imageuploaddisplay2">						
														<div class="section photo">
															<section class="col-lg-12 col-md-12 col-sm-12 m_bottom_27">
																<div class="row">
																  <fieldset class="frm">
																	<div class="col-lg-6 col-md-6 col-sm-6">
																		<?php 
																		$doc2Img = '';
																		?>
																	<div class="photo-preview"><img id="customImage2" src="images/site/blank.gif" style="width:80px;height:80px;background-image:url(<?php echo base_url();?>images/users/custom/<?php echo $doc2Img?>);background-size:cover" alt=""></div>

																	</div>
																	<div class="col-lg-6 col-md-6 col-sm-6">
																			<div class="photo-func2">		
																				<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.photo-func2').hide();$('.doc2-upload-file').show();return false;" value="<?php if($this->lang->line('custom_another_photo_upload') != '') { echo stripslashes($this->lang->line('custom_another_photo_upload')); } else echo "Upload Another Photo/Sketch"; ?>"/>
																			</div>																		
																			<div class="doc2-upload-file"  style="display:none">
																				<input id="customImage_2" img_upload="imageuploaddisplay3" img_id="customImage2" class="customImageUpload" name="customImage_two" type="file">
																				<span class="uploading" style="display:none"><?php if($this->lang->line('settings_uploading') != '') { echo stripslashes($this->lang->line('settings_uploading')); } else echo "Uploading..."; ?></span>
																				<span class="description"><?php echo "Allowed file types JPG, GIF or PNG.<br>"; ?></span>
																			</div>
																		
																	</div>
																  </div>
																</section>
																</fieldset>
															</div>
														</li>
													<!-- custom Image 2 end -->
													<!-- custom Image 3 -->
													<li class="m_bottom_15 imageuploaddisplay" id="imageuploaddisplay3">						
														<div class="section photo">
															<section class="col-lg-12 col-md-12 col-sm-12 m_bottom_27">
																<div class="row">
																  <fieldset class="frm">
																	<div class="col-lg-6 col-md-6 col-sm-6">
																		<?php 
																		$doc2Img = '';
																		?>
																	<div class="photo-preview"><img id="customImage3" src="images/site/blank.gif" style="width:80px;height:80px;background-image:url(<?php echo base_url();?>images/users/custom/<?php echo $doc2Img?>);background-size:cover" alt=""></div>

																	</div>
																	<div class="col-lg-6 col-md-6 col-sm-6">
																			<div class="photo-func3">		
																				<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.photo-func3').hide();$('.doc3-upload-file').show();return false;" value="<?php if($this->lang->line('custom_another_photo_upload') != '') { echo stripslashes($this->lang->line('custom_another_photo_upload')); } else echo "Upload Another Photo/Sketch"; ?>"/>
																			</div>																		
																			<div class="doc3-upload-file"  style="display:none">
																				<input id="customImage_3" img_upload="imageuploaddisplay4" img_id="customImage3" class="customImageUpload" name="customImage_three" type="file">
																				<span class="uploading" style="display:none"><?php if($this->lang->line('settings_uploading') != '') { echo stripslashes($this->lang->line('settings_uploading')); } else echo "Uploading..."; ?></span>
																				<span class="description"><?php echo "Allowed file types JPG, GIF or PNG.<br>"; ?></span>
																			</div>
																		
																	</div>
																  </div>
																</section>
																</fieldset>
														</div>
													</li>														
													<!-- custom Image 3 end -->
													<!-- custom Image 4 -->
													<li class="m_bottom_15 imageuploaddisplay" id="imageuploaddisplay4">						
														<div class="section photo">
															<section class="col-lg-12 col-md-12 col-sm-12 m_bottom_27">
																<div class="row">
																  <fieldset class="frm">
																	<div class="col-lg-6 col-md-6 col-sm-6">
																		<?php 
																		$doc2Img = '';
																		?>
																	<div class="photo-preview"><img id="customImage4" src="images/site/blank.gif" style="width:80px;height:80px;background-image:url(<?php echo base_url();?>images/users/custom/<?php echo $doc2Img?>);background-size:cover" alt=""></div>

																	</div>
																	<div class="col-lg-6 col-md-6 col-sm-6">
																			<div class="photo-func4">		
																				<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.photo-func4').hide();$('.doc4-upload-file').show();return false;" value="<?php if($this->lang->line('custom_another_photo_upload') != '') { echo stripslashes($this->lang->line('custom_another_photo_upload')); } else echo "Upload Another Photo/Sketch"; ?>"/>
																			</div>																		
																			<div class="doc4-upload-file"  style="display:none">
																				<input id="customImage_4" img_upload="imageuploaddisplay5" img_id="customImage4" class="customImageUpload" name="customImage_four" type="file">
																				<span class="uploading" style="display:none"><?php if($this->lang->line('settings_uploading') != '') { echo stripslashes($this->lang->line('settings_uploading')); } else echo "Uploading..."; ?></span>
																				<span class="description"><?php echo "Allowed file types JPG, GIF or PNG.<br>"; ?></span>
																			</div>
																		
																	</div>
																  </div>
																</section>
																</fieldset>
															</div>
														</li>
													<!-- custom Image 4 end -->
													<!-- custom Image 5 -->
													<li class="m_bottom_15 imageuploaddisplay" id="imageuploaddisplay5">						
														<div class="section photo">
															<section class="col-lg-12 col-md-12 col-sm-12 m_bottom_27">
																<div class="row">
																  <fieldset class="frm">
																	<div class="col-lg-6 col-md-6 col-sm-6">
																		<?php 
																		$doc2Img = '';
																		?>
																	<div class="photo-preview"><img id="customImage5" src="images/site/blank.gif" style="width:80px;height:80px;background-image:url(<?php echo base_url();?>images/users/custom/<?php echo $doc2Img?>);background-size:cover" alt=""></div>

																	</div>
																	<div class="col-lg-6 col-md-6 col-sm-6">
																				<div class="photo-fun5">		
																				<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.photo-fun5').hide();$('.doc5-upload-file').show();return false;" value="<?php if($this->lang->line('custom_another_photo_upload') != '') { echo stripslashes($this->lang->line('custom_another_photo_upload')); } else echo "Upload Another Photo/Sketch"; ?>"/>
																			</div>																	
																			<div class="doc5-upload-file"  style="display:none">
																				<input id="customImage_5" img_id="customImage5" class="customImageUpload" name="customImage_five" type="file">
																				<span class="uploading" style="display:none"><?php if($this->lang->line('settings_uploading') != '') { echo stripslashes($this->lang->line('settings_uploading')); } else echo "Uploading..."; ?></span>
																				<span class="description"><?php echo "Allowed file types JPG, GIF or PNG.<br>"; ?></span>
																			</div>
																		
																	</div>
																  </div>
																</section>
																</fieldset>
															</div>
														</li>
													
													</ul>													
												 </section>
												 <section class="col-lg-12 col-md-12 col-sm-12">
													<div class="btn-area">
														<button class="btn-green t_align_c tt_uppercase w_full second_font d_block fs_medium button_type_2 lbrown tr_all" id="sign-up" re-url="/sales/create?ntid=7220865&amp;ntoid=15301425" ><?php echo "Submit Request"; ?></button>
													</div>												 
												 </section>

											 </div>
											</form>
										</section>
										<hr />

									</div>
							</div>
						</section>
						<aside class="col-lg-2 col-md-2 col-sm-2 p_top_4">
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

			$(".customImageUpload").change(function(event){
			 var selectedFile = event.target.files[0];
			  var reader = new FileReader();

			  var imgtag = document.getElementById($(this).attr("img_id"));
			  var img_upload = $(this).attr("img_upload");
			  $("#"+img_upload).removeClass("imageuploaddisplay");
			  imgtag.title = selectedFile.name;

			  reader.onload = function(event) {
				imgtag.src = event.target.result;
			  };

			  reader.readAsDataURL(selectedFile);
			})
			</script>
<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>
<style>
.imageuploaddisplay{
display:none;
}
</style>