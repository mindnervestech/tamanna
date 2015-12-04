<?php
$this->load->view('site/templates/header_new_small');
?>		
		<!--main content-->
			<div class="page_section_offset" style="padding: 13px 0 25px;">
				<div class="container">
					<div class="row">
						<?php 
						$this->load->view('site/user/settings_sidebar');
						?>
						<main class="col-lg-9 col-md-9 col-sm-9 m_bottom_30 m_xs_bottom_10">
						<div id="content">
							<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Your Shipping Addresses</h5>
							<hr class="divider_light m_bottom_5">
							<div class="page_section_offset chart-wrap section shipping">
							<table class="w_full wishlist_table m_bottom_30 chart">
								<thead class="bg_grey_light_2 d_xs_none second_font">
									<tr>
										<th><b>Default</b></th>
										<th><b>Address Type</b></th>
										<th><b>Name</b></th>
										<th><b>Address</b></th>
										<th><b>Phone</b></th>
										<th><b>Options</b></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($shippingList->result() as $row){?>
									<tr id="<?php echo $row->id;?>" aid="<?php echo $row->id;?>" isdefault="<?php if($row->primary == 'Yes'){echo TRUE; }else {echo FALSE;}?>">
										<td data-cell-title="Product Name and Category">
											<div class="lh_small m_bottom_7">
											<?php if($row->primary == 'Yes'){?>Yes<?php }?>
											</div>
										</td>
										<td data-cell-title="Product Name and Category">
											<div class="lh_small m_bottom_7">
											<?php echo $row->nick_name;?>
											</div>
										</td>
										<td data-cell-title="Product Name and Category">
											<div class="lh_small m_bottom_7">
											<?php echo $row->full_name;?>
											</div>
										</td>
										<td data-cell-title="Product Name and Category">
											<div class="lh_small m_bottom_7">
											<?php echo $row->address1.', '.$row->address2.'<br/>'.$row->city.'<br/>'.$row->state.'<br/>'.$row->country.'-'.$row->postal_code;?>
											</div>
										</td>
										<td data-cell-title="Product Name and Category">
											<div class="lh_small m_bottom_7">
											<?php echo $row->phone;?>
											</div>
										</td>
										<td data-cell-title="Product Name and Category">
											<div class="lh_small m_bottom_7">
											<div>
												<a data-popup="#quick_view" data-popup-transition-in="bounceInUp" data-popup-transition-out="bounceOutUp" href="javascript:void(0);" class="button_type_1 black state_2 tr_all second_font fs_medium" onclick="shipping_address_cart(<?php echo $row->id;?>);">Modify</a> 
											</div>
											<div style="margin-top: 10px;">							
												<a href="javascript:void(0);" class="button_type_1 black state_2 tr_all second_font fs_medium" onclick="delete_shipping_address_cart(<?php echo $row->id;?>, <?php if($row->primary == 'Yes'){echo TRUE; }else {echo 0;}?>);">
												<?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?>
												</a>
											</div>
											
											<!-- <a class="remove_"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?></a> -->
											</div>
										</td>
									</tr>
								<?php }?>
								</tbody>
							</table>
							<a data-popup="#add_address" data-popup-transition-in="bounceInUp" data-popup-transition-out="bounceOutUp" href="javascript:void(0);" class="t_align_c tt_uppercase w_full second_font d_block fs_medium button_type_2 lbrown tr_all add_addr add_" onclick="shipping_address_cart();">Add New Shipping Address</a>
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

		<!--Shipping Address popups-->
<?php 
if(isset($countryList) && $this->uri->segment(2) == 'shipping' || isset($countryList) && $this->uri->segment(1) == 'cart'){
if($this->uri->segment(1) == 'cart'){
	$acURL = 'site/cart/insert_shipping_address';
}else{
	$acURL = 'site/user_settings/insertEdit_shipping_address';
}
?>
    
		<!--Add Shipping Address Popup-->
		<div class="init_popup" id="add_address">
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
		
		<!--Edit Shipping Address Popup-->
		<div class="init_popup" id="quick_view">
			<div class="popup init editadds-frm">
				<div class="clearfix">
						<h3 class="second_font m_bottom_20 product_title"><a href="#" class="sc_hover">Modify Shipping Address</a></h3>
						<hr class="divider_light m_bottom_15">
						<aside class="col-lg-2 col-md-2 col-sm-2 p_top_4">
						</aside>
						<form class="ltxt col-lg-8 col-md-8 col-sm-8" id="shippingEditForm" method="post" action="site/user_settings/insertEdit_shipping_address">
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
														<input name="full_name" class="w_full tr_all full required full_name" type="text">
													</li>
													<li class="m_bottom_2">
														<label for="username" class="second_font m_bottom_4 d_inline_b fs_medium">Address Type</label>
														<input name="nick_name" class="w_full tr_all full required nick_name" placeholder="<?php if($this->lang->line('header_home_work') != '') { echo stripslashes($this->lang->line('header_home_work')); } else echo "E.g. Home Address, Work Address"; ?>" type="text">
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
														<input class="w_full tr_all state required state" name="state" type="text">
													</li>
													<li class="m_bottom_2">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Postal Code</label>
														<input name="postal_code" class="w_full tr_all zip required postal_code" type="text">
													</li>

								</ul>
							</section>
							<section class="col-lg-6 col-md-6 col-sm-6">
								<ul class="m_bottom_14">
													<li class="m_bottom_2">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Address Line 1</label>
														<input name="address1" class="w_full tr_all full required address1" type="text">
													</li>
													<li class="m_bottom_2">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Address Line 2</label>
														<input name="address2" class="w_full tr_all full address2" type="text">
													</li>
													<li class="m_bottom_2">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">City</label>
														<input name="city" class="w_full tr_all full required city" type="text"></p>
													</li>
													<li class="m_bottom_30">
														<label for="password" class="second_font m_bottom_4 d_inline_b fs_medium">Phone</label>													
														<input name="phone" class="w_full tr_all full required digits phone" placeholder="<?php if($this->lang->line('header_ten_only') != '') { echo stripslashes($this->lang->line('header_ten_only')); } else echo "10 digits only, no dashes"; ?>" type="text">
													</li>
													<li class="m_bottom_2">
														<input name="set_default" id="make_primary_modify" value="true" type="checkbox"> 
														 <label class="check second_font m_bottom_4 d_inline_b fs_medium" for="make_primary_modify"><?php if($this->lang->line('header_make_primary') != '') { echo stripslashes($this->lang->line('header_make_primary')); } else echo "Make this my primary shipping address"; ?></label>
														 														 
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
		 
		<!--Page Js-->
		<script type="text/javascript" src="js/site/jquery.validate.js"></script>
		<!--<script type="text/javascript" src="js/site/socktail-address_helper.js"></script>-->
		<script>

			$("#shippingEditForm").validate();
			$("#shippingAddForm").validate();
		</script>
		
		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>