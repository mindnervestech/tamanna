<?php
$this->load->view('site/templates/header_new_small');
?>
			<!--breadcrumbs-->
			<div class="breadcrumbs bg_grey_light_2 fs_medium fw_light">
				<div class="container">
					<a href="index.html" class="sc_hover">Home</a> / <span class="color_light">Wishlist</span>
				</div>
			</div>
			<!--main content-->
			<div class="page_section_offset">
				<div class="container">
					<div class="row">
						<main class="col-lg-12 col-md-12 col-sm-12 m_bottom_30 m_xs_bottom_10">
							<h2 class="fw_light second_font color_dark tt_uppercase m_bottom_27">Your Wishlist</h2>
							<hr class="m_bottom_30 divider_light">
							<table class="w_full wishlist_table m_bottom_30">
								<thead class="bg_grey_light_2 d_xs_none second_font">
									<tr>
										<th><b>Product Image</b></th>
										<th><b>Product Name and Category</b></th>
										<th><b>Price</b></th>
									</tr>
								</thead>
								<tbody>
								        <?php 
											  if ($productLikeDetails->num_rows()>0){
											  foreach ($productLikeDetails->result() as $productLikeDetailsRow){
													$imgName = 'dummyProductImage.jpg';
													$imgArr = explode(',', $productLikeDetailsRow->image);
													if (count($imgArr)>0){
														foreach ($imgArr as $imgRow){
															if ($imgRow != ''){
																$imgName = $imgRow;
																break;
															}
														}
													}
										?>
											<tr>
												<td data-cell-title="Product Image">
													<a href="<?php echo 'things/'.$productLikeDetailsRow->id.'/'.url_title($productLikeDetailsRow->product_name);?>" class="vcard">
														<img src="images/product/<?php echo $imgName;?>" alt="<?php echo $productLikeDetailsRow->product_name ?>">
													</a>
												</td>
												<td data-cell-title="Product Name and Category">
													<div class="lh_small m_bottom_7">
														<a href="<?php echo 'things/'.$productLikeDetailsRow->id.'/'.url_title($productLikeDetailsRow->product_name);?>" class="sc_hover second_font d_inline_b m_bottom_5 fs_large"><?php echo $productLikeDetailsRow->product_name ?></a><br>
													</div>
												</td>
												<td data-cell-title="Price" class="second_font fs_large"><?php if($productLikeDetailsRow->price > $productLikeDetailsRow->sale_price){?><s class="color_light">Rs <?php echo $productLikeDetailsRow->price ?></s><?php }?><br><b class="scheme_color">Rs <?php echo $productLikeDetailsRow->sale_price ?></b></td>
											</tr>
										<?php 	}} ?>
								</tbody>
							</table>
						</main>
					</div>
				</div>
			</div>
		<!--footer-->
	<?php
$this->load->view('site/templates/footer');
?></div>

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