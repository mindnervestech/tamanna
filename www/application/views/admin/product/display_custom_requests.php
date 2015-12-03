<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/comments/change_product_comment_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
					</div>
					<div class="widget_content">
						<table class="display" id="action_tbl_view"> 
						<thead>
						<tr>
							<!--<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>-->
							
							<th class="tip_top" title="Click to sort">
								 Phone
							</th>
<th class="tip_top" title="Click to sort">
								 Email
							</th>
							<th class="tip_top" title="Click to sort">
								 Date Added
							</th>
							<th class="tip_top" title="Click to sort">
								 Project Name
							</th>
							<th class="tip_top" title="Click to sort">
								Requirements
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($commentsList->num_rows() > 0){
							foreach ($commentsList->result() as $row){
							
						?>
						<tr>
							<!--<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>-->
							<td class="center">
								<?php echo $row->phone;?>
							</td>
							<td class="center">
								<?php echo $row->email;?>
							</td>
							<td class="center">
								<?php echo $row->created;?>
							</td>
                            <td class="center">
								<?php echo $row->project_name;?>
							</td>
							<td class="center">
								<?php echo $row->project_description;?>
							</td>
							
							<td class="center">
								<span><a class="action-icons c-suspend" href="admin/comments/view_custom_request_detail/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $attribute)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/comments/delete_custom_request/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php }?>
							</td>
						</tr>
						<?php 
								
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<!--<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>-->
							
							<th>
								 User Name
							</th>
							<th>
								 Date Added
							</th>
							
							<th>
								Product Name
							</th><th>
								Comments
							</th>
							<th>
								Status
							</th>
							<th>
								 Action
							</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
			<input type="hidden" name="SubAdminEmail" id="SubAdminEmail"/>
		</form>	
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>