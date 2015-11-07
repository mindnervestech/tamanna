<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/product/change_product_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Categorize','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to Categorize records"><span class="icon add_co"></span><span class="btn_link">Categorize as ourpicks</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Decategorize','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to Decategorize records"><span class="icon delete_co"></span><span class="btn_link">Decategorize as ourpicks</span></a>
							</div>
						<?php if ($allPrev == '1' || in_array('2', $product)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Publish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to publish records"><span class="icon accept_co"></span><span class="btn_link">Publish</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('UnPublish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to unpublish records"><span class="icon delete_co"></span><span class="btn_link">UnPublish</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $product)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="selling_product_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 Product Name
							</th>
							<th class="tip_top" title="Click to sort">
								 SKU
							</th>
							<th class="tip_top" title="Click to sort">
								 Image
							</th>
							<th>
								Price
							</th>
							<th class="tip_top" title="Click to sort">
								Added By
							</th>
							<th class="tip_top" title="Click to sort">
								Likes
							</th>
							<th class="tip_top" title="Click to sort">
								Remain
							</th>
                            <th class="tip_top" title="Click to sort">
								Purchased
							</th>
							<th class="tip_top" title="Click to sort">
								Status
							</th>
							<th class="tip_top" title="Click to sort">
								Created On
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($productList->num_rows() > 0){
							foreach ($productList->result() as $row){
								$img = 'dummyProductImage.jpg';
								$imgArr = explode(',', $row->image);
								if (count($imgArr)>0){
									foreach ($imgArr as $imgRow){
										if ($imgRow != ''){
											$img = $imgRow;
											break;
										}
									}
								}
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<?php echo $row->product_name;?>
							</td>
<td class="center">
								<?php echo $row->sku;?>
							</td>
							<td class="center">
						 		<div class="widget_thumb" style="margin-left: 25%;">
								 <img width="40px" height="40px" src="<?php echo base_url();?>images/product/<?php echo $img;?>" />
								</div>
							</td>
							<td class="center">
								<?php echo $row->sale_price;?>
							</td>
							<td class="center">
								<?php 
								if ($row->user_name != ''){
									echo '<b>'.$row->full_name.'</b> ('.$row->user_name.')';
								}else {
									echo 'Admin';
								}
								?>
							</td>
							<td class="center">
								 <?php echo $row->likes;?>
							</td>
							<td class="center">
								 <?php echo $row->quantity;?>
							</td>
                           <td class="center">
								 <?php echo $row->purchasedCount;?>
							</td>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $product)){
								$mode = ($row->status == 'Publish')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/product/change_product_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to publish" class="tip_top" href="javascript:confirm_status('admin/product/change_product_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							<td class="center">
								<?php echo $row->created;?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $product)){?>
								<span><a class="action-icons c-edit" href="admin/product/edit_product_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/product/view_product/<?php echo $row->id;?>" title="View">View</a></span>
							<?php 
							$category = $row->category_id;
							$ourpick_category = '107';
							$is_ourpick = strpos($category,$ourpick_category);

							if($is_ourpick === false) { ?>
							<span><a class="action-icons c-add" href="admin/product/categorize_ourpicks/<?php echo $row->id;?>" title="Categorize as Our Picks">Categorize as Our Picks</a></span>	
							<?php }else{?>
							<span><a class="action-icons c-close" href="admin/product/decategorize_ourpicks/<?php echo $row->id;?>" title="Decategorize as Our Picks">Decategorize as Our Picks</a></span>
							<?php }?>	
							<?php if ($allPrev == '1' || in_array('3', $product)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/product/delete_product/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
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
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th>
								 Product Name
							</th>
							<th>
								 SKU
							</th>
							<th>
								 Image
							</th>
							<th>
								Price
							</th>
							<th>
								Added By
							</th>
							<th>
								Likes
							</th>
							<th>
								Remain
							</th>
							<th>
								Purchased
							</th>
							<th>
								Status
							</th>
							<th>
								Created On
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
<style>
#selling_product_tbl tr td{
	border-right:#ccc 1px solid;
}
</style>	
<script>
$('#selling_product_tbl').dataTable({   
	"aoColumnDefs": [
	                 { "bSortable": false, "aTargets": [ 0,2,10 ] }
	                 ],
	                 "aaSorting": [[9, 'desc']],
	                 "sPaginationType": "full_numbers",
	                 "iDisplayLength": 100,
	                 "oLanguage": {
	                	 "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
	                 },
	                 "sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
	                	 
});
</script>	
<?php 
$this->load->view('admin/templates/footer.php');
?>