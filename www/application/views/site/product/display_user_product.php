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
			<div class="page_section_offset" style="padding: 13px 0 25px;">
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

							<hr class="m_bottom_14 m_top_20">
							<ul class="m_bottom_14">
<!--														<p class="fw_light m_top_5 m_bottom_7 m_xs_top_0 m_xs_bottom_0">Our Price:</p>
														<b><div><span class="fs_big second_font d_block m_bottom_7 m_xs_bottom_0 fs_sm_default" style="float:left;"><?php echo $currencySymbol;?>&nbsp; </span><span id="SalePrice" class="fs_big second_font d_block m_bottom_7 m_xs_bottom_0 fs_sm_default"> <?php echo number_format($productListVal->sale_price);?></span></div></b>-->
							
									<li class="m_bottom_3"><span style="width: 150px;" class="project_list_title second_font d_inline_b">Approx Price: </span><span class="fs_big second_font m_bottom_25 m_xs_bottom_10 fs_sm_default scheme_color"> <?php echo $currencySymbol;?><?php echo $productDetails->row()->sale_price;?></span></li>
									<li class="m_bottom_3"><span style="width: 150px;"  class="project_list_title second_font d_inline_b">Seller:</span> <span class="color_dark fw_light"><a href="user/<?php echo $productUserDetails->row()->user_name;?>/added"><?php echo $productDetails->row()->full_name;?></a></span></li>
									<li class="m_bottom_3"><span style="width: 150px;"  class="project_list_title second_font d_inline_b">City:</span> <span class="color_dark fw_light"> <?php echo $cityname->row()->cityname;?></span></li>
									<li class="m_bottom_3"><span style="width: 150px;"  class="project_list_title second_font d_inline_b">Contact Number:</span> <span class="color_dark fw_light"><?php echo $productUserDetails->row()->s_phone_no;?></span></li>
									<li class="m_bottom_3"><span style="width: 150px;"  class="project_list_title second_font d_inline_b">Address:</span> <span class="color_dark fw_light"><?php echo $productUserDetails->row()->s_address;?></span></li>
							</ul>
							<hr class="m_bottom_14">
							<p  class="fs_big">Check All Creations of <?php echo $productDetails->row()->full_name;?> <a class="scheme_color" href="user/<?php echo $productUserDetails->row()->user_name;?>/added"><u>here</u></a></p>
						</aside>
					</div>
					<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">More Creations of this seller</h5>
					<hr class="divider_bg m_bottom_25">
					<!--carousel-->
					<div class="row m_bottom_25" style="padding-bottom:150px;">
					
					<ul>
					<?php
					if ($limitProd<6 && $seller_affiliate_products->num_rows()>0){
						foreach ($seller_affiliate_products->result() as $seller_affiliate_products_row){
							if ($limitProd==4)break;
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
										<img src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="<?php echo $productDetails->row()->product_name;?>" class="tr_all scale_image">
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
					</div>
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
		<script src="plugins/afterresize.min.js"></script>
		<script type="text/javascript" src="js/site/thing_page.js"></script> 

		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>