<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Seller</h6>
						<div id="widget_tab">
			              <ul>
			                <li><a href="#tab1" class="active_tab">Brand Details</a></li>
			                <li><a href="#tab2">Bank Details</a></li>
			              </ul>
			            </div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'edituser_form');
						echo form_open('admin/seller/insertEditSeller',$attributes) 
					?>
	 						<div id="tab1">
	 						<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Seller Name</label>
									<div class="form_input">
										<input type="text" name="full_name" value="<?php echo $seller_details->row()->full_name;?>" class="tipTop large" title="Enter the seller name" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="brand_name">Brand Name</label>
									<div class="form_input">
										<input type="text" name="brand_name" value="<?php echo $seller_details->row()->brand_name;?>" class="tipTop large" title="Enter the brand name" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="brand_description">Description</label>
									<div class="form_input">
										<input type="text" name="brand_description" value="<?php echo $seller_details->row()->brand_description;?>" class="tipTop large" title="Enter the brand description" />
									</div>

								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="about">About</label>
									<div class="form_input">
										<input type="text" name="About" value="<?php echo $seller_details->row()->about;?>" class="tipTop large" title="Tell Buyers about your brand" />
									</div>
</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="about">Address</label>
									<div class="form_input">
										<input type="text" name="About" value="<?php echo $seller_details->row()->s_address;?>" class="tipTop large" title="Address" />
									</div>
</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="about">City</label>
									<div class="form_input">
										<input type="text" name="About" value="<?php echo $seller_details->row()->s_city;?>" class="tipTop large" title="City" />
									</div>
</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="about">State</label>
									<div class="form_input">
										<input type="text" name="About" value="<?php echo $seller_details->row()->s_state;?>" class="tipTop large" title="State" />
									</div>
</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="about">Postal Code</label>
									<div class="form_input">
										<input type="text" name="About" value="<?php echo $seller_details->row()->s_postal_code;?>" class="tipTop large" title="Postal Code" />
									</div>
</div>
								</li>

								<li>
								<div class="form_grid_12">
									<label class="field_title" for="web_url">Website</label>
									<div class="form_input">
										<input type="text" name="web_url" value="<?php echo $seller_details->row()->web_url;?>" class="tipTop large" title="Enter the website url" />
									</div>
								</div>
								</li>



<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="thumbnail">Logo</label>
                    <div class="form_input">
                      <input name="thumbnail" id="thumbnail" type="file" tabindex="5" class="large tipTop" title="Please select the logo image"/>
                    </div>
                    <div class="form_input"><img src="<?php echo base_url();?>images/users/<?php echo $seller_details->row()->thumbnail;?>" width="100px"/></div>
                  </div>
                </li>


								<li>
								<div class="form_grid_12">
									<label class="field_title" for="commision">Commision (%)</label>
									<div class="form_input">
										<input type="text" name="commision" value="<?php echo $seller_details->row()->commision;?>" class="tipTop large" title="Enter the commision percentage" />
									</div>
								</div>
								</li>
<li>
								<div class="form_grid_12">
									<label class="field_title" for="s_tin_no">TIN No.</label>
									<div class="form_input">
										<input type="text" name="s_tin_no" value="<?php echo $seller_details->row()->s_tin_no;?>" class="tipTop large" title="Enter the TIN Number" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="s_vat_no">VAT No.</label>
									<div class="form_input">
										<input type="text" name="s_vat_no" value="<?php echo $seller_details->row()->s_vat_no;?>" class="tipTop large" title="Enter the VAT Number" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="s_cst_no">CST No.</label>
									<div class="form_input">
										<input type="text" name="s_cst_no" value="<?php echo $seller_details->row()->s_cst_no;?>" class="tipTop large" title="Enter the CST Number" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
						</div>
						<div id="tab2">
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="bank_name">Full Name</label>
									<div class="form_input">
										<input type="text" name="bank_name" value="<?php echo $seller_details->row()->bank_name;?>" class="tipTop large" title="Enter the name in bank account" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="bank_no">Account Number</label>
									<div class="form_input">
										<input type="text" name="bank_no" value="<?php echo $seller_details->row()->bank_no;?>" class="tipTop large" title="Enter the bank account number" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="bank_code">Bank Code</label>
									<div class="form_input">
										<input type="text" name="bank_code" value="<?php echo $seller_details->row()->bank_code;?>" class="tipTop large" title="Enter the bank code" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="paypal_email">Paypal Email</label>
									<div class="form_input">
										<input type="text" name="paypal_email" value="<?php echo $seller_details->row()->paypal_email;?>" class="tipTop large" title="Enter the paypal email" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
						</div>
						<input type="hidden" name="seller_id" value="<?php echo $seller_details->row()->id;?>"/>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>