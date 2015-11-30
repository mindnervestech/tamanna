<?php
$this->load->view('site/templates/header_new_small');
?>
<?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
<?php } ?>
			<!--main content-->
<div class="page_section_offset" style="padding: 13px 0 25px;">
	<section class="container">
		<div class="row">
          <?php echo $cartViewResults; ?>
		</div>
	</section>
</div>
		<!--footer-->
				<?php
					$this->load->view('site/templates/footer');
				?>
		</div>

		<!--back to top-->
		<button class="back_to_top animated button_type_6 grey state_2 d_block black_hover f_left vc_child tr_all"><i class="fa fa-angle-up d_inline_m"></i></button>

		<!--Shipping Address popup-->
<?php 
if(isset($countryList) && $this->uri->segment(2) == 'shipping' || isset($countryList) && $this->uri->segment(1) == 'cart'){
if($this->uri->segment(1) == 'cart'){
	$acURL = 'site/cart/insert_shipping_address';
}else{
	$acURL = 'site/user_settings/insertEdit_shipping_address';
}
?>
    
		<!--Popup-->
		<div class="init_popup" id="quick_view">
			<div class="popup init newadds-frm">
				<div class="clearfix">
						<h3 class="second_font m_bottom_20 product_title"><a href="#" class="sc_hover">Add Shipping Address</a></h3>
						<hr class="divider_light m_bottom_15">
						<aside class="col-lg-2 col-md-2 col-sm-2 p_top_4">
						</aside>
						<form class="ltxt col-lg-8 col-md-8 col-sm-8" id="shippingAddForm" method="post" action="<?php echo $acURL;?>">
						  <div class="section profile">
							<div class="error-box" style="display:none;">
								<p><?php if($this->lang->line('seller_some_requi') != '') { echo stripslashes($this->lang->line('seller_some_requi')); } else echo "Some required information is missing or incomplete. Please correct your entries and try again"; ?>.</p>
								<ul></ul>
							</div>
							<div class="row">
							<section class="col-lg-6 col-md-6 col-sm-6">
								<ul class="m_bottom_14">
													<li class="m_bottom_2">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">Full Name</label>
														<input name="full_name" class="w_full tr_all full required" type="text">
													</li>
													<li class="m_bottom_2">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">Address Type</label>
														<input name="nick_name" class="w_full tr_all full required" placeholder="<?php if($this->lang->line('header_home_work') != '') { echo stripslashes($this->lang->line('header_home_work')); } else echo "E.g. Home Address, Work Address"; ?>" type="text">
													</li>

													<li class="m_bottom_2">
														<label class="second_font m_bottom_4 d_inline_b fs_medium"><?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?></label>
																<select name="country" class="full required w_full tr_all country select-round select-shipping-addr select_title fs_medium fw_light color_light relative tr_all">
																	<?php 
																	if ($countryList->num_rows()>0){
																		foreach ($countryList->result() as $country){if($country->country_code=='IN'){
																	?>
																	<option value="<?php echo $country->country_code;?>"><?php echo $country->name;?></option>
																	<?php 
																		}}
																	}
																	?>
																</select>										
													</li>
													<li class="m_bottom_2">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">State</label>
														<input class="w_full tr_all state required" name="state" type="text">
													</li>
													<li class="m_bottom_2">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Postal Code</label>
														<input name="postal_code" class="w_full tr_all zip required" type="text">
													</li>

								</ul>
							</section>
							<section class="col-lg-6 col-md-6 col-sm-6">
								<ul class="m_bottom_14">
													<li class="m_bottom_2">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Address Line 1</label>
														<input name="address1" class="w_full tr_all full required" type="text">
													</li>
													<li class="m_bottom_2">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Address Line 2</label>
														<input name="address2" class="w_full tr_all full" type="text">
													</li>
													<li class="m_bottom_2">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">City</label>
														<input name="city" class="w_full tr_all full required" type="text"></p>
													</li>
													<li class="m_bottom_30">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Phone</label>													
														<input name="phone" class="w_full tr_all full required digits" placeholder="<?php if($this->lang->line('header_ten_only') != '') { echo stripslashes($this->lang->line('header_ten_only')); } else echo "10 digits only, no dashes"; ?>" type="text">
													</li>
													<li class="m_bottom_2">
														<input name="set_default" id="make_this_primary_addr" value="true" type="checkbox">
														<label class="check second_font m_bottom_4 d_inline_b fs_medium" for="make_this_primary_addr"><?php if($this->lang->line('header_make_primary') != '') { echo stripslashes($this->lang->line('header_make_primary')); } else echo "Make this my primary shipping address"; ?></label>
													</li>
													<input type="hidden" name="user_id" value="<?php echo $loginCheck;?>"/>													

								</ul>
							</section>
							</div>
							<section class="col-lg-12 col-md-12 col-sm-12 m_bottom_27">
												<ul>
									
													<li>
														<input type="submit" style="cursor:pointer;" class="btn-save t_align_c tt_uppercase w_full second_font d_block fs_medium button_type_2 lbrown tr_all" value="<?php echo "Save"; ?>"/>
													</li>
												</ul>
							</section>
						  </div>
						</form>	
						<aside class="col-lg-2 col-md-2 col-sm-2 p_top_4">
						</aside>
				</div>
				<button class="close_popup fw_light fs_large tr_all">x</button>
			</div>
		</div>


<?php }?> 

		<!--libs include-->
		<script src="plugins/jquery.appear.js"></script>
		<script src="plugins/jquery.easytabs.min.js"></script>
		<script src="plugins/owl-carousel/owl.carousel.min.js"></script>
		<script src="plugins/twitter/jquery.tweet.min.js"></script><script src="plugins/flickr.js"></script>
		<script src="plugins/afterresize.min.js"></script>
		<script src="plugins/jackbox/js/jackbox-packed.min.js"></script>
		<script src="js/retina.min.js"></script>
		<script src="plugins/colorpicker/colorpicker.js"></script>
		 
		<!--Page Js-->
		<script type="text/javascript" src="js/site/jquery.validate.js"></script>
		<script>
			$("#shippingAddForm").validate();
		</script>
		
		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>