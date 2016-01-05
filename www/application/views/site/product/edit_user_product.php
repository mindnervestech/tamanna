<?php
$this->load->view('site/templates/header');
?>
<style type="text/css" media="screen">


#edit-details {
    color: #FF3333;
    font-size: 11px;
}
.option-area select.option {
    border: 1px solid #D1D3D9;
    border-radius: 3px 3px 3px 3px;
    box-shadow: 1px 1px 1px #EEEEEE;
    height: 22px;
    margin: 5px 0 12px;
}
a.selectBox.option {
    margin: 5px 0 10px;
    padding: 3px 0;
}
a.selectBox.option .selectBox-label {
    font: inherit !important;
    padding-left: 10px;

}
.add-2 form label.error{
	color:red;
}

</style>



 <!-- Section_start -->
<div id="container-wrapper">
	<div class="container " style="width: 880px; padding-top:5px;">
		<?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>
		<div id="content">
			<section class="add-2">
				<h1><?php if($this->lang->line('product_edit_dtls') != '') { echo stripslashes($this->lang->line('product_edit_dtls')); } else echo "Edit details"; ?></h1>
<?php 
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
?>
				<form id="userProdEdit" action="site/product/edit_user_product_process" method="post" enctype="multipart/form-data" onsubmit="return validateProduct();">
					<fieldset class="pic_preview">
						<img alt="" style="max-height:200px;max-width:200px" src="images/product/<?php echo $img;?>">
						<input type="hidden" name="productID" value="<?php echo $productDetails->row()->seller_product_id;?>"/>
						<p><?php if($this->lang->line('product_diff_photo') != '') { echo stripslashes($this->lang->line('product_diff_photo')); } else echo "Use a different photo?"; ?></p>
						<br class="hidden">
						<input type="file" name="uploadphoto" id="uploadphoto">
						<input type="submit" name="submit" uid="<?php echo $loginCheck;?>" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="upload" value="<?php if($this->lang->line('header_upload') != '') { echo stripslashes($this->lang->line('header_upload')); } else echo "Upload"; ?>">
					</fieldset>
					<!-- / pic_preview -->

					<fieldset class="add-form">
						<ul>
						<!--	<li>
								<label for="fancy-title"><?php if($this->lang->line('product_added_by') != '') { echo stripslashes($this->lang->line('product_added_by')); } else echo "Added by"; ?> <a href="user/<?php echo $userDetails->row()->user_name;?>"><?php echo $userDetails->row()->full_name;?></a></label>
								
							</li>-->
							<li>
								<label for="fancy-title"><?php if($this->lang->line('header_title') != '') { echo stripslashes($this->lang->line('header_title')); } else echo "Title"; ?> <!--<em><?php if($this->lang->line('product_what_photo') != '') { echo stripslashes($this->lang->line('product_what_photo')); } else echo "What's the thing in the photo?"; ?></em>--></label>
								<br class="hidden">
								<input type="text" value="<?php echo $productDetails->row()->product_name;?>" class="text required" name="product_name" id="fancy-title">
							</li>
							<li>
								<label for="fancy-web-link"><?php if($this->lang->line('header_weblink') != '') { echo stripslashes($this->lang->line('header_weblink')); } else echo "Web link"; ?><!-- <em><?php if($this->lang->line('product_where_find') != '') { echo stripslashes($this->lang->line('product_where_find')); } else echo "Where can you buy it or find out more?"; ?></em>--></label>

								<br class="hidden">
								<input type="text" value="<?php echo $productDetails->row()->web_link;?>" class="text" name="web_link" id="fancy-web-link">
							</li>
							<li>
								<label for="fancy-comment"><?php echo "Product Description and Specifications"; ?></label>
								<br class="hidden">
								<textarea class="global-input required mceEditor" maxlength="5000" rows="10" cols="30" name="excerpt" id="fancy-comment"><?php echo $productDetails->row()->excerpt;?></textarea> 

<!--<textarea class="global-input mceEditor"  maxlength="2000" name="excerpt id="fancy-comment" rows="10" cols="30"><?php echo $productDetails->row()->excerpt;?></textarea>-->




							</li>
							<li>
								<label for="fancy-category"><?php if($this->lang->line('header_category') != '') { echo stripslashes($this->lang->line('header_category')); } else echo "Category"; ?><!-- <em><?php if($this->lang->line('product_how_should') != '') { echo stripslashes($this->lang->line('product_how_should')); } else echo "How should it be filed?"; ?></em>--></label>
								<br class="hidden">
								<input style="display:none" name="category_id" id="category_id"/>
								<select onchange="getSubCategories(value,'subCategory_edit','sub-category_edit');" class="required" id="fancy-category_1" style="font-size:13px;">
									<option selected="" value=""><?php if($this->lang->line('product_put_cate') != '') { echo stripslashes($this->lang->line('product_put_cate')); } else echo "Put in category"; ?>...</option>
									<?php 
									$prodCatArr = explode(',', $productDetails->row()->category_id);
									if (count($prodCatArr)>0){
										foreach ($prodCatArr as $prodCatRow){
											if ($prodCatRow!= '107'){
												$catVal= $prodCatRow;
												break;
											}
										}
									}
									foreach ($mainCategories->result() as $catRow){
										if($catRow->id != '107'){?>
									<option <?php if ($catRow->id == $catVal){echo 'selected="selected"';}?> value="<?php echo $catRow->id;?>"><?php echo $catRow->cat_name;?></option>
									<?php } }?>
									
									
								</select>
								<input style="display:none" id="category_list" value="<?php echo $productDetails->row()->category_id; ?>"/>
							</li>
							
							<li>
								<div class="subCategory_edit" style="display:none">
									<label><?php echo "Sub Category"; ?><span style="color:red"> *</span></label>
									<select onchange="getSubCategories(value,'sub-subCategory_edit','sub-sub-category_edit');" class="required" id="sub-category_edit">
									</select>
								</div>
							</li>
							<li>
								<div class="sub-subCategory_edit" style="display:none">
									<label><?php echo "Sub Sub Category"; ?><span style="color:red"> *</span></label>
									<select class="required" id="sub-sub-category_edit">
																		
									</select>
								</div>
							</li>
							
						<li><label><?php if($this->lang->line('header_price') != '') { echo stripslashes($this->lang->line('header_price')); } else echo "Price"; ?> <em><?echo "Add price if this is a product"; ?></em></label>

								
								<input type="text" name="sale_price" id="sale_price" value="<?php echo $productDetails->row()->sale_price;?>" class="text required">
								
</li>
						</ul>
						<input type="submit" name="submit" uid="<?php echo $loginCheck;?>" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="button done" value="<?php if($this->lang->line('header_save') != '') { echo stripslashes($this->lang->line('header_save')); } else echo "Save"; ?>" />
					</fieldset>
					<!-- / pic_preview -->
				</form>

			</section>
			<!-- / add-2 -->
			<hr>

				
		</div>
		<!-- / wrapper-content -->

		

		
		<a id="scroll-to-top" href="#header" style="display: none;"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>

	</div>
	<!-- / container -->
</div>
	<?php 
     $this->load->view('site/templates/footer_menu');
     ?>

<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filesjquery_zoomer.js" type="text/javascript"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>selectbox.js"></script>
<script type="text/javascript" src="js/site/thing_page.js"></script>
<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<script>
	$("#userProdEdit").validate();
	function validateProduct(){
		var cat = "";
		var id1 = $("#fancy-category_1").val();
		var id2 = $("#sub-category_edit").val();
		var id3 = $("#sub-sub-category_edit").val();
		if(id1!="" && id1 != null){
			cat += id1;
		}
		if(id2!="" && id2 != null){
			cat += "," + id2;
		}
		if(id3!="" && id3 != null){
			cat += "," + id3;
		}
		$("#category_id").val(cat);
		return;
	}
	$(document).ready(function(){
		var catrgory = ($("#category_list").val()).split(",");
		if(catrgory.length){
			if(catrgory[0]){
				getSubCategories(catrgory[0],'subCategory_edit','sub-category_edit',catrgory[1]);
			}
			if(catrgory[1]){
				getSubCategories(catrgory[1],'sub-subCategory_edit','sub-sub-category_edit',catrgory[2]);
			}


		}
	});
</script>
<?php
$this->load->view('site/templates/footer');
?>