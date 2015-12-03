<?php
$this->load->view('site/templates/header_new_small');
?>
			<!--main content-->
			<div class="page_section_offset" style="padding: 0 0 25px; margin-bottom:200px;">
				<div class="container">
					<div class="row">
						<aside class="col-lg-3 col-md-3 col-sm-3 p_top_4">
						</aside>
						<section class="col-lg-6 col-md-6 col-sm-6">
						<ul class="m_bottom_14">
							<li class="m_bottom_15">
								<h2 class="fw_light second_font color_dark m_bottom_14 tt_uppercase t_align_c m_bottom_10">Request Submitted</h2>
							</li>
							<li class="m_bottom_15 m_bottom_50">
								<h5 class="fw_light second_font color_dark m_bottom_14 tt_uppercase t_align_c m_bottom_20">Thanks for submitting customization request. We will revert back to you shorty with quotation and tentative delivery date.</h5>
							</li>
							<li class="m_bottom_15">
								<button onclick="window.location='<?php echo base_url() ?>'" class="btn-signin t_align_c tt_uppercase w_full second_font d_block fs_medium button_type_2 lbrown tr_all">Continue</button>
							</li>
						</section>
						<aside class="col-lg-3 col-md-3 col-sm-3 p_top_4">
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
		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>