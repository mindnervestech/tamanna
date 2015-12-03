<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6><?php echo $heading;?></h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
					?>
	 						<ul>
                            	<li>
                                  <div class="form_grid_12">
                                    <label class="field_title" for="country_id">Email <span class="req"></span></label>
                                    <div class="form_input">
                                      <?php echo $custom_request_details->row()->email;?>
                                    </div>
                                  </div>
                                </li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="state_name">Project Name <span class="req"></span></label>
									<div class="form_input">
                                    <?php echo $custom_request_details->row()->project_name;?>
									</div>
								</div>
								</li>
                            	<li>
                                  <div class="form_grid_12">
                                    <label class="field_title" for="country_id">Phone no <span class="req"></span></label>
                                    <div class="form_input">
                                      <?php echo $custom_request_details->row()->phone_no;?>
                                    </div>
                                  </div>
                                </li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="state_name">Dimensions <span class="req"></span></label>
									<div class="form_input">
                                    <?php echo $custom_request_details->row()->size;?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="state_name">Color <span class="req"></span></label>
									<div class="form_input">
                                    <?php echo $custom_request_details->row()->color;?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="state_name">Material <span class="req"></span></label>
									<div class="form_input">
                                    <?php echo $custom_request_details->row()->material;?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="state_name">Location <span class="req"></span></label>
									<div class="form_input">
                                    <?php echo $custom_request_details->row()->city;?>
									</div>
								</div>
								</li>								
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="state_code">Request<span class="req"></span></label>
									<div class="form_input">
                                   <?php echo $custom_request_details->row()->project_description;?>
									</div>
								</div>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="state_code">Picture 1<span class="req"></span></label>
									<div class="form_input">
										<a target="_blank" href="<?php echo base_url();?>/images/custom/<?php echo $custom_request_details->row()->pic1;?>"><?php echo $custom_request_details->row()->pic1;?></a>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="state_code">Picture 2<span class="req"></span></label>
									<div class="form_input">
										<a target="_blank" href="<?php echo base_url();?>/images/custom/<?php echo $custom_request_details->row()->pic2;?>"><?php echo $custom_request_details->row()->pic2;?></a>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="state_code">Picture 3<span class="req"></span></label>
									<div class="form_input">
										<a target="_blank" href="<?php echo base_url();?>/images/custom/<?php echo $custom_request_details->row()->pic3;?>"><?php echo $custom_request_details->row()->pic3;?></a>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="state_code">Picture 4<span class="req"></span></label>
									<div class="form_input">
										<a target="_blank" href="<?php echo base_url();?>/images/custom/<?php echo $custom_request_details->row()->pic4;?>"><?php echo $custom_request_details->row()->pic4;?></a>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="state_code">Picture 5<span class="req"></span></label>
									<div class="form_input">
										<a target="_blank" href="<?php echo base_url();?>/images/custom/<?php echo $custom_request_details->row()->pic5;?>"><?php echo $custom_request_details->row()->pic5;?></a>
									</div>
								</div>
								</li>
								<li>
								<li>								
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/comments/view_custom_request" class="tipLeft" title="Go to location list"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>
							</ul>
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