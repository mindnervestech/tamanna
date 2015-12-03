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
							<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Your Orders</h5>
							<hr class="divider_light m_bottom_5">
							<div class="page_section_offset">
							<table class="w_full wishlist_table m_bottom_30">
								<thead class="bg_grey_light_2 d_xs_none second_font">
									<tr>
										<th><b>Order #</b></th>
										<th><b>Payment Mode</b></th>
										<th><b>Order Status</b></th>
										<th><b>Shipping Mode</b></th>
										<th><b>Tracking ID</b></th>
										<th><b>Amount</b></th>
										<th><b>Order Date</b></th>
										<th><b>Options</b></th>
									</tr>
								</thead>
								<tbody>
								 <?php foreach ($ordersList->result() as $row){?>
									<tr>
										<td data-cell-title="Product Name and Category">
											<div class="lh_small m_bottom_7">
											#<?php echo $row->dealCodeNumber;?>
											</div>
										</td>
										<td data-cell-title="Product Name and Category">
											<div class="lh_small m_bottom_7">
											<?php echo $row->status;?>
											</div>
										</td>
                        <td>
                        <select class="select-round select-shipping-addr select_title fs_medium fw_light color_light relative tr_all" onchange="javascript:changeShipStatus(this.value,'<?php echo $row->dealCodeNumber;?>','<?php echo $row->sell_id;?>')">
                        	<option <?php if ($row->shipping_status == 'Pending'){echo 'selected="selected"';}?> value="Pending"><?php if($this->lang->line('order_pending') != '') { echo stripslashes($this->lang->line('order_pending')); } else echo "Pending"; ?></option>
                        	<option <?php if ($row->shipping_status == 'Processed'){echo 'selected="selected"';}?> value="Processed"><?php if($this->lang->line('order_processed') != '') { echo stripslashes($this->lang->line('order_processed')); } else echo "Processed"; ?></option>
                                <option <?php if ($row->shipping_status == 'Shipped'){echo 'selected="selected"';}?> value="Shipped"><?php if($this->lang->line('order_shipped') != '') { echo stripslashes($this->lang->line('order_shipped')); } else echo "Shipped"; ?></option>
                        	<option <?php if ($row->shipping_status == 'Delivered'){echo 'selected="selected"';}?> value="Delivered"><?php if($this->lang->line('order_delivered') != '') { echo stripslashes($this->lang->line('order_delivered')); } else echo "Delivered"; ?></option>
                        	<option <?php if ($row->shipping_status == 'Returned'){echo 'selected="selected"';}?> value="Returned"><?php if($this->lang->line('order_returnred') != '') { echo stripslashes($this->lang->line('order_returnred')); } else echo "Returned"; ?></option>
                        	<option <?php if ($row->shipping_status == 'Re-Shipped'){echo 'selected="selected"';}?> value="Re-Shipped"><?php if($this->lang->line('order_reshipp') != '') { echo stripslashes($this->lang->line('order_reshipp')); } else echo "Re-Shipped"; ?></option>
                        	<option <?php if ($row->shipping_status == 'Cancelled'){echo 'selected="selected"';}?> value="Cancelled"><?php if($this->lang->line('order_cancelled') != '') { echo stripslashes($this->lang->line('order_cancelled')); } else echo "Cancelled"; ?></option>
                        </select>
                        <img alt="Loading" style="display: none;" class="status_loading_<?php echo $row->dealCodeNumber;?>" src="images/site/ajax-loader.gif"/>
                        </td>
										<td data-cell-title="Product Name and Category">
											<div class="lh_small m_bottom_7">
                                                                 <input style="width: 100px;height: 0;" type="text" value="<?php echo $row->courier_name;?>"/>
                                                                 <a style="color:green;" href="javascript:void(0);" onclick="update_courier_name(this,'<?php echo $row->id;?>');">Update</a>
											</div>
										</td>
										<td data-cell-title="Product Name and Category">
											<div class="lh_small m_bottom_7">
                                                                 <input style="width: 100px;height: 0;" type="text" value="<?php echo $row->tracking_id;?>"/>
                                                                 <a style="color:green;" href="javascript:void(0);" onclick="update_tracking_id(this,'<?php echo $row->id;?>');">Update</a>
											</div>
										</td>
										<td data-cell-title="Product Name and Category">
											<div class="lh_small m_bottom_7">
											<?php echo $row->total;?>
											</div>
										</td>
										<td data-cell-title="Product Name and Category">
											<div class="lh_small m_bottom_7">
											<?php echo $row->created;?>
											</div>
										</td>
										<td data-cell-title="Quantity">
											<div class="quantity clearfix t_align_c">
											<a style="color:green;" target="_blank" href="view-order/<?php echo $row->sell_id;?>/<?php echo $row->dealCodeNumber;?>"><?php if($this->lang->line('view_invoice') != '') { echo stripslashes($this->lang->line('view_invoice')); } else echo "View Invoice"; ?></a><br/>
											</div>
										</td>
									</tr>
								<?php }?>
								</tbody>
							</table>
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