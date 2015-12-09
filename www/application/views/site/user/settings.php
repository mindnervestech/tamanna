<?php
$this->load->view('site/templates/header_new_small');
?>			<!--main content-->
			<div class="page_section_offset" style="padding: 13px 0 25px;">
				<div class="container">
					<div class="row">
						<?php 
						$this->load->view('site/user/settings_sidebar');
						?>
						<main class="col-lg-9 col-md-9 col-sm-9 m_bottom_30 m_xs_bottom_10">
							<?php 
								if ($userDetails->row()->is_verified == 'No'){
								?>
								<div class="confirm-email m_bottom_30">
									
									<p class="alert_box warning m_bottom_10 relative fw_light"><?php if($this->lang->line('settings_check_mail') != '') { echo stripslashes($this->lang->line('settings_check_mail')); } else echo "Check your email"; ?> <b>(<?php echo $userDetails->row()->email;?>)</b> <?php if($this->lang->line('settings_toconfirm') != '') { echo stripslashes($this->lang->line('settings_toconfirm')); } else echo "to confirm."; ?></p>
									<a class="button_type_1 grey state_2 tr_all second_font fs_medium" id="resend_confirmation" href="javascript:void(0)" onclick="javascript:resendConfirmation('<?php echo $userDetails->row()->email;?>')"><?php if($this->lang->line('settings_resendconfm') != '') { echo stripslashes($this->lang->line('settings_resendconfm')); } else echo "Resend confirmation"; ?></a>
									
								</div>
								<?php 
								}
							?>
					<div class="row">
						<aside class="col-lg-2 col-md-2 col-sm-2 p_top_4">
						</aside>
						<section class="col-lg-8 col-md-8 col-sm-8">
								<?php if($flash_data != '') { ?>
									<div class="errorContainer" id="<?php echo $flash_data_type;?>">
										<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
										<p><span><?php echo $flash_data;?></span></p>
									</div>
								<?php } ?>
							<h2 class="fw_light second_font color_dark m_bottom_27 tt_uppercase">Edit Profile Settings</h2>
							<hr class="divider_bg m_bottom_10">
						</section>
						<aside class="col-lg-2 col-md-2 col-sm-2 p_top_4">
						</aside>
					</div>
					<div class="row">
						<aside class="col-lg-2 col-md-2 col-sm-2 p_top_4">
						</aside>
						<form class="col-lg-8 col-md-8 col-sm-8 myform" id="profile_settings_form" method="post" action="site/user_settings/changePhoto" enctype="multipart/form-data" onSubmit="return profileUpdate();">
						  <div class="section profile">
							<div class="error-box" style="display:none;">
								<p><?php if($this->lang->line('seller_some_requi') != '') { echo stripslashes($this->lang->line('seller_some_requi')); } else echo "Some required information is missing or incomplete. Please correct your entries and try again"; ?>.</p>
								<ul></ul>
							</div>
							<section class="col-lg-12 col-md-12 col-sm-12">
								<ul class="m_bottom_14">
													<li class="m_bottom_15">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">Full Name</label>
														<input  id="name" class="setting_fullname w_full tr_all" name="setting-fullname" value="<?php echo $userDetails->row()->full_name;?>" type="text">
													</li>
													
													<li class="m_bottom_20">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Email</label>
														<input id="email" class="setting_email w_full tr_all" name="setting-email" data-email="<?php echo $userDetails->row()->email;?>" value="<?php echo $userDetails->row()->email;?>" type="text">
													</li>
					<?php if ($userDetails->row()->group == 'User'){?>								
						<!-- Doc1 -->
							<div class="section photo">
								<section class="col-lg-12 col-md-12 col-sm-12 m_bottom_27">
								  <div class="row">
								  <fieldset class="frm">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<p class="stit"><?php echo "Doc 1"; ?></p>
										<?php 
										$doc1Img = 'user-thumb1.png';
										if ($userDetails->row()->doc1 != ''){
											$doc1Img = $userDetails->row()->doc1;
										}
										?>
									<div class="photo-preview"><img src="images/site/blank.gif" style="width:100%;height:100%;background-image:url(<?php echo base_url();?>images/users/<?php echo $doc1Img;?>);background-size:cover" alt="<?php echo $userDetails->row()->full_name;?>"></div>

									</div>
									<div class="col-lg-6 col-md-6 col-sm-6">
										
											<div class="doc1-photo-func">		
												<?php if ($userDetails->row()->thumbnail == ''){?>		
												<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.doc1-photo-func').hide();$('.doc1-upload-file').show();return false;" value="<?php echo "Upload"; ?>"/>
												<?php }else {?>
												<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.doc1-photo-func').hide();$('.doc1-upload-file').show();return false;" value="<?php if($this->lang->line('change_photo') != '') { echo stripslashes($this->lang->line('change_photo')); } else echo "Change"; ?>"/>

												<?php }?>
											</div>
											<div class="doc1-upload-file" style="display:none">
												<input id="uploadavatar-doc1" class="uploadavatar-doc1" name="docone-file" type="file">
												<span class="uploading" style="display:none"><?php if($this->lang->line('settings_uploading') != '') { echo stripslashes($this->lang->line('settings_uploading')); } else echo "Uploading..."; ?></span>
												<span class="description"><?php if($this->lang->line('settings_allowedimag') != '') { echo stripslashes($this->lang->line('settings_allowedimag')); } else echo "Allowed file types JPG, GIF or PNG.<br>Maximum width and height is 600px"; ?></span>
												<input type="button" style="cursor: pointer;" class="btn-upload" id="save_profile_image" onclick="return updateUserDoc1();" value="<?php echo "Upload"; ?>"/>
												<input type="button" style="cursor: pointer;" class="btn-cancel" onClick="$('.doc1-photo-func').show();$('.doc1-upload-file').hide();return false;" value="<?php if($this->lang->line('header_cancel') != '') { echo stripslashes($this->lang->line('header_cancel')); } else echo "Cancel"; ?>"/>
											</div>
										
									</div>
								  </div>
								</section>
								</fieldset>
							</div>
						<!-- Doc1 finish -->
						
						<!-- Doc2 -->
						<div class="section photo">
								<section class="col-lg-12 col-md-12 col-sm-12 m_bottom_27">
								  <div class="row">
								  <fieldset class="frm">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<p class="stit"><?php echo "Doc 2"; ?></p>
										<?php 
										$doc2Img = 'user-thumb1.png';
										if ($userDetails->row()->doc2 != ''){
											$doc2Img = $userDetails->row()->doc2;
										}
										?>
									<div class="photo-preview"><img src="images/site/blank.gif" style="width:100%;height:100%;background-image:url(<?php echo base_url();?>images/users/<?php echo $doc2Img?>);background-size:cover" alt="<?php echo $userDetails->row()->full_name;?>"></div>

									</div>
									<div class="col-lg-6 col-md-6 col-sm-6">
										
											<div class="doc2-photo-func">		
												<?php if ($userDetails->row()->thumbnail == ''){?>		
												<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.doc2-photo-func').hide();$('.doc2-upload-file').show();return false;" value="<?php echo "Upload"; ?>"/>
												<?php }else {?>
												<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.doc2-photo-func').hide();$('.doc2-upload-file').show();return false;" value="<?php if($this->lang->line('change_photo') != '') { echo stripslashes($this->lang->line('change_photo')); } else echo "Change"; ?>"/>
												
												<?php }?>
											</div>
											<div class="doc2-upload-file" style="display:none">
												<input id="uploadavatar-doc2" class="uploadavatar-doc2" name="docsecond-file" type="file">
												<span class="uploading" style="display:none"><?php if($this->lang->line('settings_uploading') != '') { echo stripslashes($this->lang->line('settings_uploading')); } else echo "Uploading..."; ?></span>
												<span class="description"><?php if($this->lang->line('settings_allowedimag') != '') { echo stripslashes($this->lang->line('settings_allowedimag')); } else echo "Allowed file types JPG, GIF or PNG.<br>Maximum width and height is 600px"; ?></span>
												<input type="button" style="cursor: pointer;" class="btn-upload" id="save_profile_image" onclick="return updateUserDoc2();" value="<?php echo "Upload"; ?>"/>
												<input type="button" style="cursor: pointer;" class="btn-cancel" onClick="$('.doc2-photo-func').show();$('.doc2-upload-file').hide();return false;" value="<?php if($this->lang->line('header_cancel') != '') { echo stripslashes($this->lang->line('header_cancel')); } else echo "Cancel"; ?>"/>
											</div>
										
									</div>
								  </div>
								</section>
								</fieldset>
							</div>
						<!-- Doc2 finish -->							

						<!-- Doc3 -->
						<div class="section photo">
								<section class="col-lg-12 col-md-12 col-sm-12 m_bottom_27">
								  <div class="row">
								  <fieldset class="frm">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<p class="stit"><?php echo "Doc 3"; ?></p>
										<?php 
										$doc2Img = 'user-thumb1.png';
										if ($userDetails->row()->doc3 != ''){
											$doc3Img = $userDetails->row()->doc3;
										}
										?>
									<div class="photo-preview"><img src="images/site/blank.gif" style="width:100%;height:100%;background-image:url(<?php echo base_url();?>images/users/<?php echo $doc3Img?>);background-size:cover" alt="<?php echo $userDetails->row()->full_name;?>"></div>

									</div>
									<div class="col-lg-6 col-md-6 col-sm-6">
										
											<div class="doc3-photo-func">		
												<?php if ($userDetails->row()->thumbnail == ''){?>		
												<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.doc3-photo-func').hide();$('.doc3-upload-file').show();return false;" value="<?php echo "Upload"; ?>"/>
												<?php }else {?>
												<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.doc3-photo-func').hide();$('.doc3-upload-file').show();return false;" value="<?php if($this->lang->line('change_photo') != '') { echo stripslashes($this->lang->line('change_photo')); } else echo "Change"; ?>"/>
												
												<?php }?>
											</div>
											<div class="doc3-upload-file" style="display:none">
												<input id="uploadavatar-doc3" class="uploadavatar-doc3" name="docthird-file" type="file">
												<span class="uploading" style="display:none"><?php if($this->lang->line('settings_uploading') != '') { echo stripslashes($this->lang->line('settings_uploading')); } else echo "Uploading..."; ?></span>
												<span class="description"><?php if($this->lang->line('settings_allowedimag') != '') { echo stripslashes($this->lang->line('settings_allowedimag')); } else echo "Allowed file types JPG, GIF or PNG.<br>Maximum width and height is 600px"; ?></span>
												<input type="button" style="cursor: pointer;" class="btn-upload" id="save_profile_image" onclick="return updateUserDoc3();" value="<?php echo "Upload"; ?>"/>
												<input type="button" style="cursor: pointer;" class="btn-cancel" onClick="$('.doc3-photo-func').show();$('.doc3-upload-file').hide();return false;" value="<?php if($this->lang->line('header_cancel') != '') { echo stripslashes($this->lang->line('header_cancel')); } else echo "Cancel"; ?>"/>
											</div>
										
									</div>
								  </div>
								</section>
								</fieldset>
							</div>
						<?php } ?>
										<?php if ($userDetails->row()->group == 'Seller'){?>			
													<li class="m_bottom_15">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">Website Link</label>
														<input id="site" class="setting_website w_full tr_all" name="setting-website" value="<?php echo $userDetails->row()->web_url;?>" type="text">
													</li>
													<li class="m_bottom_15">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">Location</label>
														<!--<input id="loc" class="setting_location w_full tr_all" name="setting-location" value="<?php echo $userDetails->row()->location;?>"" class="text" placeholder="<?php if($this->lang->line('settings_eg_new') != '') { echo stripslashes($this->lang->line('settings_eg_new')); } else echo "e.g. Mumbai"; ?>" type="text"> -->
														
													<br>				
													 <select class="setting_location  selectBox select-round select-shipping-addr select_title fs_medium fw_light color_light relative tr_all">

														<option value=""><?php echo "Select Location"; ?></option>									 
													   <?php foreach ($locations->result() as $location){ ?>
								 
														<option <?php if($userDetails->row()->location==$location->id){ echo 'selected="selected"'; } ?> value="<?php echo $location->id; ?>"><?php echo $location->cityname; ?></option>
													   <?php } ?>
													</select>
														
													</li>
													<li class="clearfix m_bottom_5">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">About</label>
														<div id="bio" class="setting_bio f_left field_container" name="setting-bio" max-length="180" style="width:100%">
															<textarea class="w_full tr_all" rows="6" type="text" name="brand_description" id="brand_description"><?php echo $userDetails->row()->brand_description;?></textarea>
														</div>
													</li>
										<?php } ?>

								</ul>
							</section>
							<div class="section photo">
								<section class="col-lg-12 col-md-12 col-sm-12 m_bottom_27">
								  <div class="row">
								  <fieldset class="frm">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<p class="stit"><?php echo "Logo"; ?></p>
										<?php 
										$userImg = 'user-thumb1.png';
										if ($userDetails->row()->thumbnail != ''){
											$userImg = $userDetails->row()->thumbnail;
										}
										?>
									<div class="photo-preview"><img src="images/site/blank.gif" style="width:100%;height:100%;background-image:url(<?php echo base_url();?>images/users/<?php echo $userImg;?>);background-size:cover" alt="<?php echo $userDetails->row()->full_name;?>"></div>

									</div>
									<div class="col-lg-6 col-md-6 col-sm-6">
										
											<div class="photo-func">		
												<?php if ($userDetails->row()->thumbnail == ''){?>		
												<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.photo-func').hide();$('.upload-file').show();return false;" value="<?php if($this->lang->line('header_up_photo') != '') { echo stripslashes($this->lang->line('header_up_photo')); } else echo "Upload Photo"; ?>"/>
												<?php }else {?>
												<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.photo-func').hide();$('.upload-file').show();return false;" value="<?php if($this->lang->line('change_photo') != '') { echo stripslashes($this->lang->line('change_photo')); } else echo "Change Photo"; ?>"/>
												<input type="button" style="cursor: pointer;" class="btn-delete" id="delete_profile_image" onClick="return deleteUserPhoto();" value="<?php if($this->lang->line('header_delete_photo') != '') { echo stripslashes($this->lang->line('header_delete_photo')); } else echo "Delete Photo"; ?>"/>
												<?php }?>
											</div>
											<div class="upload-file" style="display:none">
												<input id="uploadavatar" class="uploadavatar" name="upload-file" type="file">
												<span class="uploading" style="display:none"><?php if($this->lang->line('settings_uploading') != '') { echo stripslashes($this->lang->line('settings_uploading')); } else echo "Uploading..."; ?></span>
												<span class="description"><?php if($this->lang->line('settings_allowedimag') != '') { echo stripslashes($this->lang->line('settings_allowedimag')); } else echo "Allowed file types JPG, GIF or PNG.<br>Maximum width and height is 600px"; ?></span>
												<input type="button" style="cursor: pointer;" class="btn-upload" id="save_profile_image" onclick="return updateUserPhoto();" value="<?php if($this->lang->line('header_up_photo') != '') { echo stripslashes($this->lang->line('header_up_photo')); } else echo "Upload Photo"; ?>"/>
												<input type="button" style="cursor: pointer;" class="btn-cancel" onClick="$('.photo-func').show();$('.upload-file').hide();return false;" value="<?php if($this->lang->line('header_cancel') != '') { echo stripslashes($this->lang->line('header_cancel')); } else echo "Cancel"; ?>"/>
											</div>
											<small class="comment"><?php if($this->lang->line('settings_profile_identy') != '') { echo stripslashes($this->lang->line('settings_profile_identy')); } else echo "Your profile photo is your identity on"; ?> <?php echo $siteTitle;?>, <?php if($this->lang->line('settings_pickone') != '') { echo stripslashes($this->lang->line('settings_pickone')); } else echo "so pick a good one that expresses who you are."; ?></small>
										
									</div>
								  </div>
								</section>
								</fieldset>
							</div>
							<section class="col-lg-12 col-md-12 col-sm-12 m_bottom_27">
												<ul>
													<li>
														<input type="submit" name="profile" style="cursor:pointer;" class="btn-save t_align_c tt_uppercase w_full second_font d_block fs_medium button_type_2 lbrown tr_all" id="save_account" value="<?php if($this->lang->line('settings_save_profile') != '') { echo stripslashes($this->lang->line('settings_save_profile')); } else echo "Save Profile"; ?>"/>
											<!--		<input type="button" style="cursor:pointer;" onClick="return deactivateUser();" class="btn-deactivate" id="close_account" value="<?php if($this->lang->line('settings_deact_acc') != '') { echo stripslashes($this->lang->line('settings_deact_acc')); } else echo "Deactivate my account"; ?>"/> -->
												
													</li>
												</ul>
							</section>
						  </div>
						</form>	
						<aside class="col-lg-2 col-md-2 col-sm-2 p_top_4">
						</aside>
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