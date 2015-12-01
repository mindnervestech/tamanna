<?php
$this->load->view('site/templates/header_new_small');
?>
			<!--main content-->
			<div class="page_section_offset" style="padding: 0 0 25px;">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 m_bottom_30 m_xs_bottom_10">
							<div class="iframe_map_container m_bottom_38 m_xs_bottom_30">
								<img src="images/contactus.jpg" width=100% height="480" alt="Contact Socktail" title="Contact Socktail">		</div>
							<div class="row">
								<main class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
									<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Have Queries?</h5>
									<hr class="divider_bg m_bottom_25">
									<ul class="second_font m_bottom_25" >
										<li>Read the most frequently asked questions here</li>
									</ul>
									<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Still can not find an answer?</h5>
									<hr class="divider_bg m_bottom_25">
									<ul class="second_font m_bottom_25">
										<li>Feel free to contact us with service questions, business proposals or media inquiries. We are open all days: 0900-2100 hrs</li>
									</ul>
									<ul class="second_font vr_list_type_2 m_bottom_33 m_xs_bottom_30">
										<li><i class="fa fa-phone color_dark fs_large"></i>7304 22 44 88</li>
										<li class="w_break" data-icon=""><i class="fa fa-envelope color_dark"></i><a href="mailto:#" class="sc_hover d_inline_b">contact@socktail.com</a></li>
									</ul>
									<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Corporate Office</h5>
									<hr class="divider_bg m_bottom_25">
									<p class="second_font m_bottom_15">#2, Marine Tower, St Patrick’s Town, Hadapsar, Pune - 411013</p>

								</main>
								<section class="col-lg-6 col-md-6 col-sm-6">
									<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Contact Form</h5>
									<hr class="divider_bg m_bottom_25">
									<p class="second_font m_bottom_14">Send an email. All fields with an <span class="color_red">*</span> are required.</p>
									<form id="contactform" class="b_default_layout">
										<ul>
											<li class="row">
												<div class="col-lg-6 col-md-6 col-sm-6 m_bottom_15">
													<label class="second_font required d_inline_b m_bottom_5 clickable" for="cf_name">First Name</label><br>
													<input type="text" name="cf_name" id="cf_name" class="tr_all w_full fw_light">
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 m_bottom_15">
													<label class="second_font required d_inline_b m_bottom_5 clickable" for="cf_email">Email Address</label><br>
													<input type="email" name="cf_email" id="cf_email" class="tr_all w_full fw_light">
												</div>
											</li>
											<li class="m_bottom_15">
												<label class="second_font d_inline_b m_bottom_5 clickable" for="cf_telephone">Telephone</label><br>
												<input type="text" name="cf_telephone" id="cf_telephone" class="tr_all w_full fw_light">
											</li>
											<li class="m_bottom_5">
												<label class="second_font d_inline_b m_bottom_5 clickable" for="cf_message">Message</label><br>
												<textarea id="cf_message" name="cf_message" rows="6" class="tr_all w_full fw_light"></textarea>
											</li>
											<li>
												<button class="button_type_2 black state_2 tr_all second_font fs_medium tt_uppercase d_inline_b"><span class="m_left_10 m_right_10 d_inline_b">Submit</span></button>
											</li>
										</ul>
									</form>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>
		<!--footer-->
	<?php
$this->load->view('site/templates/footer');
?></div>

		<!--libs include-->
		<script src="plugins/jquery.appear.js"></script>
		<script src="plugins/afterresize.min.js"></script>

		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>