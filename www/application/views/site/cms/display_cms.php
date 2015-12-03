<?php
$this->load->view('site/templates/header_new_small');
?>
<style type="text/css" media="screen">
h1 {
margin-bottom: 50px;
}
</style>
			<!--main content-->
			<div class="page_section_offset" style="padding: 0 0 25px;">
				<div class="container">
					<div class="row">
						<section class="col-lg-12 col-md-12 col-sm-12">
            	<?php 
            	if ($pageDetails->num_rows()>0){
            		echo $pageDetails->row()->description;
            	}
            	?>
						</section>
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