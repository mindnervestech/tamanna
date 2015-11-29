<?php
$this->load->view('site/templates/header_new');
?>
			<!--breadcrumbs-->
			<div class="breadcrumbs bg_grey_light_2 fs_medium fw_light">
				<div class="container">
					<?php echo $breadCumps; ?> 
				</div>
			</div>
			<!--main content-->
			
				<?php 
	if ($productDetails->num_rows()==1){
		$img = 'dummyProductImage.jpg';
		$imgArr = explode(',', $productDetails->row()->image);
		if (count($imgArr)>0){
			foreach ($imgArr as $imgRow){
				if ($imgRow != ''){
					$img = $pimg = $imgRow;
					break;
				}
			}
		}
	}
	?>	
			<div class="page_section_offset">
				<div class="container">
					<div class="row">
						<div class="col-lg-9 col-md-9 col-sm-9 m_xs_bottom_10 m_bottom_25">
							<h3 class="second_font color_dark m_bottom_2"><?php echo $productDetails->row()->product_name;?></h3>
						</div>
					</div>
					<div class="row relative">
						<div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30 m_bottom_48">
							<img src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="<?php echo $productDetails->row()->product_name;?>" class="m_bottom_30">
							<?php if ($loginCheck != ''  && ($userDetails->row()->id == $productDetails->row()->user_id)){?>
							<ul id="sidebar">
								<li><a class="sell button_type_2 d_block f_sm_none m_sm_bottom_3 t_align_c lbrown state_2 tr_all second_font fs_medium tt_uppercase f_left m_right_3 product_button" ntoid="15301425" ntid="<?php echo $productDetails->row()->seller_product_id;?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" href="#"><?php echo "I want to sell it"; ?></a></li>
								<li><a class="button_type_2 d_block f_sm_none m_sm_bottom_3 t_align_c lbrown state_2 tr_all second_font fs_medium tt_uppercase f_left m_right_3 product_button" id="edit-details" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit"><?php echo "Edit"; ?></a></li>
								<li><a class="remove_new_thing button_type_2 d_block f_sm_none m_sm_bottom_3 t_align_c lbrown state_2 tr_all second_font fs_medium tt_uppercase f_left m_right_3 product_button" uid="<?php echo $productUserDetails->row()->id;?>" thing_id="<?php echo $productDetails->row()->seller_product_id;?>" ntid="7220865" href="things/<?php echo $productDetails->row()->seller_product_id;?>/delete"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?></a></li>
							</ul>
							<?php }?>  

						</div>
						<aside class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30 m_bottom_48 scrolled">
							<div style="max-height: 300px;overflow: overlay;">
								<p class="fw_light m_bottom_14">
							    <?php  if ($productDetails->row()->excerpt!=''){echo $productDetails->row()->excerpt;}else {echo $productDetails->row()->description;} ?>
							</p>
							</div>

							<hr class="m_bottom_14">
							<ul class="m_bottom_14">
									<li class="m_bottom_3"><span class="project_list_title second_font d_inline_b">Seller:</span> <span class="color_dark fw_light"><a href="user/<?php echo $productUserDetails->row()->user_name;?>"><?php echo $productDetails->row()->full_name;?></a></span></li>
									<li class="m_bottom_3"><span class="project_list_title second_font d_inline_b">City:</span> <span class="color_dark fw_light"><?php echo $productUserDetails->row()->s_city;?></span></li>
									<li class="m_bottom_3"><span class="project_list_title second_font d_inline_b">Contact Number:</span> <span class="color_dark fw_light"><?php echo $productUserDetails->row()->phone_no;?></span></li>
							</ul>
							<hr class="m_bottom_14">
							<p  class="fs_big second_font scheme_color">Check All Creations of <?php echo $productDetails->row()->full_name;?> <a href="user/<?php echo $productUserDetails->row()->user_name;?>">here</a></p>
						</aside>
					</div>
					<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">More Creations of this seller</h5>
					<hr class="divider_bg m_bottom_25">
					<!--carousel-->
					<div class="row">
					
					<ul>
					<?php 
					$limitProd = 0;
					if ($seller_affiliate_products->num_rows()>0){
						foreach ($seller_affiliate_products->result() as $seller_product_details_row){
							if ($limitProd==6)break;
							$limitProd++;
							$img = 'dummyProductImage.jpg';
							$imgArr = array_filter(explode(',', $seller_product_details_row->image));
							if (count($imgArr)>0){
								foreach ($imgArr as $imgRow){
									if ($imgRow != ''){
										$img = $imgRow;
										break;
									}
								}
							}
					if ($seller_product_details_row->seller_product_id != $productDetails->row()->id){
					?>
                    
					<li><a href="user/<?php echo $productDetails->row()->user_name;?>/things/<?php echo $seller_product_details_row->seller_product_id;?>/<?php echo url_title($seller_product_details_row->product_name,'-');?>" class="figure-img">
						<span style="background-image: url(<?php echo base_url();?>images/product/<?php echo $img;?>);"></span>
					</a></li>
					<?php 
					}}
					}
					if ($limitProd<6 && $seller_affiliate_products->num_rows()>0){
						foreach ($seller_affiliate_products->result() as $seller_affiliate_products_row){
							if ($limitProd==6)break;
							$limitProd++;
							$img = 'dummyProductImage.jpg';
							$imgArr = array_filter(explode(',', $seller_affiliate_products_row->image));
							if (count($imgArr)>0){
								foreach ($imgArr as $imgRow){
									if ($imgRow != ''){
										$img = $imgRow;
										break;
									}
								}
							}
					?>
					
					<div class="col-lg-3 col-md-3 col-sm-3 m_bottom_12 m_xs_bottom_30">
							<article class="frame_container scale_image_container relative r_image_container">
								<figure class="relative">
									<div class="d_block wrapper m_bottom_16 scale_image_container popup_container relative">
										<img src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="" class="tr_all scale_image">
										<ul class="open_buttons_container relative hr_list">
											<li class="m_right_5 tr_all"><a href="<?php echo base_url();?>images/product/<?php echo $img;?>" class="button_type_6 vc_child d_block t_align_c border_white tr_delay jackbox" data-group="related_projects" data-title="<?php echo $productDetails->row()->product_name;?>"><i class="fa fa-plus d_inline_m"></i></a></li>
											<li class="m_right_5 tr_all"><a href="user/<?php echo $productDetails->row()->user_name;?>/things/<?php echo $seller_affiliate_products_row->seller_product_id;?>/<?php echo url_title($seller_affiliate_products_row->product_name,'-');?>" class="button_type_6 vc_child d_block t_align_c border_white tr_delay"><i class="fa fa-link d_inline_m"></i></a></li>
										</ul>
									</div>
									<figcaption>
										<h5 class="second_font m_bottom_5 lh_small"><a href="user/<?php echo $productDetails->row()->user_name;?>/things/<?php echo $seller_affiliate_products_row->seller_product_id;?>/<?php echo url_title($seller_affiliate_products_row->product_name,'-');?>" class="sc_hover"><b><?php echo $productDetails->row()->product_name;?></b></a></h5>
									</figcaption>
								</figure>
							</article>
					
					<?php 
						}
					}
					?>
				    </ul>
						
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
		<script src="plugins/jackbox/js/jackbox-packed.min.js"></script>
		<script src="plugins/owl-carousel/owl.carousel.min.js"></script>
		<script src="plugins/twitter/jquery.tweet.min.js"></script><script src="plugins/flickr.js"></script>
		<script src="plugins/afterresize.min.js"></script>
		<script src="js/retina.min.js"></script>
		<script src="plugins/colorpicker/colorpicker.js"></script>
		<script type="text/javascript" src="js/site/thing_page.js"></script>

		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>