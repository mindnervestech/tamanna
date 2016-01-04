<?php
$this->load->view('site/templates/header_new_small');
?>
			<!--main content-->
			<div class="page_section_offset" style="padding: 3px 0 75px;">
				<div class="container">
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
							<h2 class="fw_light second_font color_dark m_bottom_27 tt_uppercase">Tell Us About Your Company</h2>
							<hr class="divider_bg m_bottom_10">
						</section>
						<aside class="col-lg-2 col-md-2 col-sm-2 p_top_4">
						</aside>
					</div>
					<div class="row">
						<aside class="col-lg-2 col-md-2 col-sm-2 p_top_4">
						</aside>
						<form class="col-lg-8 col-md-8 col-sm-8" action="site/user/seller_signup" method="post" id="seller_signup" onsubmit="return validateSellerSignup();">
							<div class="error-box" style="display:none;">
								<p><?php if($this->lang->line('seller_some_requi') != '') { echo stripslashes($this->lang->line('seller_some_requi')); } else echo "Some required information is missing or incomplete. Please correct your entries and try again"; ?>.</p>
								<ul></ul>
							</div>
							<section class="col-lg-6 col-md-6 col-sm-6">
								<ul class="m_bottom_14">
													<li class="m_bottom_15">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">Brand Name *</label>
														<input  type="text" name="brand_name" id="brand_name"  class="w_full tr_all">
													</li>
													<li class="clearfix m_bottom_5">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">About Your Brand *</label>
														<div class="f_left field_container" style="width:100%">
															<textarea class="w_full tr_all" rows="6" type="text" name="brand_description" id="brand_description"></textarea>
														</div>
													</li>
													<li class="m_bottom_15">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">Website Link</label>
														<input type="text" name="web_url" id="web_url" style="margin-bottom: 10px;" class="w_full tr_all">
													</li>
													<li class="m_bottom_20">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Address *</label>
														<input type="text" name="s_address" id="s_address" class="w_full tr_all">
													</li>
													<li class="m_bottom_15">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">City *</label>
														<input type="text" name="s_city" id="s_city" class="w_full tr_all" style="display:none">
														<input type="text" name="location" id="location" class="w_full tr_all" style="display:none">
														<br>
														<select id="s_city_dropdown" class="selectBox select-round select-shipping-addr select_title fs_medium fw_light color_light relative tr_all">

														<option value=""><?php echo "Select Location"; ?></option>									 
													   <?php foreach ($locations->result() as $location){ ?>
								 
														<option  value="<?php echo $location->id; ?>"><?php echo $location->cityname; ?></option>
													   <?php } ?>
													</select>
													</li>
													<li class="m_bottom_15">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">State *</label>
														<input type="text" name="s_state" id="s_state" class="w_full tr_all">
													</li>
													<li class="m_bottom_15">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">Postel Code *</label>
														<input type="text" name="s_postal_code" id="s_postal_code" class="w_full tr_all">
													</li>
								</ul>
							</section>
							<section class="col-lg-6 col-md-6 col-sm-6">
								<ul class="m_bottom_14">

													<li class="m_bottom_20">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Country *</label>
														<?php 
																if(isset($countryList) && $countryList->num_rows()>0){
																?>
																<select name="s_country" class="select-white select-country" id="s_country">
																<?php 
																	foreach ($countryList->result() as $country){
																?>
																<option value="<?php echo $country->country_code;?>"><?php echo $country->name;?></option>
																<?php 
																	}
																?>						
																</select>
																<?php 
																}else {
																?>
																<input type="text" name="s_country" id="s_country" class="w_full tr_all"/>
														<?php }?>
													</li>
													<li class="m_bottom_20">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Phone Number *</label>
														<input type="text" name="s_phone_no" id="s_phone_no"  class="w_full tr_all">
													</li>
													<li class="m_bottom_20">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">TIN No</label>
														<input type="text" name="s_tin_no" id="s_tin_no" class="w_full tr_all">
													</li>
													<li class="m_bottom_20">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">VAT No</label>
														<input type="text" name="s_vat_no" id="s_vat_no" class="w_full tr_all">
													</li>
													<li class="m_bottom_20">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">CST No</label>
														<input type="text" name="s_cst_no" id="s_cst_no" class="w_full tr_all">
													</li>
													<li class="m_bottom_20">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Bank Account Holder's Name</label>
														<input type="text" name="bank_name" id="bank_name" class="w_full tr_all">
													</li>
													<li class="m_bottom_20">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Account Number</label>
														<input type="text" name="bank_no" id="bank_no" class="w_full tr_all">
													</li>
													<li class="m_bottom_20">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">IFSC Code</label>
														<input type="text" name="bank_code" id="bank_code" class="w_full tr_all">
													</li>
								</ul>
							</section>
							<section class="col-lg-12 col-md-12 col-sm-12">
								<ul>
													<li>
														<button id="sign-up" re-url="/sales/create?ntid=7220865&amp;ntoid=15301425" class="btn-green t_align_c tt_uppercase w_full second_font d_block fs_medium button_type_2 lbrown tr_all">Complete Registration</button>
													</li>
								</ul>
							</section>
						</form>	
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

		<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<script>
$("#seller_signup").validate({
	});

function validateSellerSignup(){
	var brand = $('#brand_name').val();
	var description = $('#brand_description').val();
	var addr = $('#s_address').val();
	var city = $('#s_city').val();
	var state = $('#s_state').val();
	var pincode = $('#s_postal_code').val();
	var country = $('#s_country').val();
	var phone = $('#s_phone_no').val();
	//var bank_name = $('#bank_name').val();
	//var bank_no = $('#bank_no').val();
	//var bank_code = $('#bank_code').val();
	
	if(brand == ''){
		alert('Brand name required');
		$('#brand_name').focus();
		return false;
	}else if(description == ''){
		alert('Brand Description required');
		$('#brand_description').focus();
		return false;
	}else if(addr == ''){
		alert('Adrress required');
		$('#s_address').focus();
		return false;
	}else if($("#s_city_dropdown").val() == ''){
		alert('City name required');
		$('#s_city_dropdown').focus();
		return false;
	}else if(state == ''){
		alert('State name required');
		$('#s_state').focus();
		return false;
	}else if(pincode == ''){
		alert('Postal code required');
		$('#s_postal_code').focus();
		return false;
	}else if(country == ''){
		alert('Country name required');
		$('#s_country').focus();
		return false;
	}else if(phone == ''){
		alert('Phone number required');
		$('#s_phone_no').focus();
		return false;
	}/*else if(bank_name == ''){
		alert('Name in bank required');
		$('#bank_name').focus();
		return false;
	}else if(bank_no == ''){
		alert('Account number required');
		$('#bank_no').focus();
		return false;
	}else if(bank_code == ''){
		alert('Bank code required');
		$('#bank_code').focus();
		return false;
	}*/
	if($("#s_city_dropdown").val() != ''){
		$('#s_city').val($("#s_city_dropdown").val());
		$('#location').val($("#s_city_dropdown").val());
		
	}
}

</script>
		<!--libs include-->
		<script src="plugins/jquery.appear.js"></script>
		<script src="plugins/afterresize.min.js"></script>
	 

		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>