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
							<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Your Shipping Addresses</h5>
							<hr class="divider_light m_bottom_5">
							<div class="page_section_offset">
							<table class="w_full wishlist_table m_bottom_30">
								<thead class="bg_grey_light_2 d_xs_none second_font">
									<tr>
										<th><b>Default</b></th>
										<th><b>Address Type</b></th>
										<th><b>Address</b></th>
										<th><b>Phone</b></th>
										<th><b>Options</b></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($shippingList->result() as $row){?>
									<tr aid="<?php echo $row->id;?>" isdefault="<?php if($row->primary == 'Yes'){echo TRUE; }else {echo FALSE;}?>">
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
											<a aid="<?php echo $row->id;?>" class="edit_"><?php if($this->lang->line('shipping_edit') != '') { echo stripslashes($this->lang->line('shipping_edit')); } else echo "Edit"; ?></a> / <a class="remove_"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?></a>
											</div>
										</td>
									</tr>
								<?php }?>
								</tbody>
							</table>
							<button class="t_align_c tt_uppercase w_full second_font d_block fs_medium button_type_2 lbrown tr_all btn-shipping add_"> <?php if($this->lang->line('shipping_add_ship') != '') { echo stripslashes($this->lang->line('shipping_add_ship')); } else echo "Add Shipping Address"; ?></button>
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
<!-- Section_start -->
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>address_helper.js"></script>
<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<script>

	$("#shippingEditForm").validate();
	$("#shippingAddForm").validate();

	jQuery(function($) {
		var $select = $('.gift-recommend select.select-round');
		$select.selectBox();
		$select.each(function(){
			var $this = $(this);
			if($this.css('display') != 'none') $this.css('visibility', 'visible');
		});
	});
</script>
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