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
form label.error{
	color:red;
}
.button{
	width: 95px;
	overflow: visible;
	margin: 0;
	padding: 8px 8px 10px 7px;
	border: 0;
	border-radius: 4px;
	font-weight: bold;
	font-size: 15px;
	line-height: 22px;
	text-align: center;
	color: #fff;
	background: #588cc7;
}
.button:hover{
	background: #3e73b7;
}

.styleSelect select { background: transparent;  width: 120px;  padding: 5px;  font-size: 14px;  line-height: 1;  border: 0;  border-radius: 0;  height: 34px;  -webkit-appearance: none;  color: #777777;}
.styleSelect {    background: url("images/site/jquery.selectBox-arrow.gif") no-repeat scroll  center right 10px  #f9f9f9;    border: 1px solid #CCCCCC;    border-radius: 0px;    height: 26px;    overflow: hidden;    width: 95px;}
</style>
<div class="lang-en wider no-subnav thing signed-out winOS">


 <!-- Section_start -->
  <div id="container-wrapper">
	<div class="container ">
	<?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>
		<div class="wrapper-content">					
            <div class="profile-list">            
                
                <div class="page-header padding_all15 margin_all0">
                            <h2> <?php if($this->lang->line('product_edit') != '') { echo stripslashes($this->lang->line('product_edit')); } else echo "Edit Product"; ?></h2>
             	
 <h2 style="text-align:left;" class="border_bottom padding_bottom15">	</h2>		 
            </div>
                <div class="box-content">
                    <form accept-charset="utf-8" method="post" action="site/product/sell_it/1" onsubmit="return validate_desc();" id="sellerProdEdit1">
                    <section class="left-section min_height" style="height: 924px;">	
                        <div class="person-lists bs-docs-example">
                            <ul class="tabs1" id="myTab">
                                    <li class="active"><a data-toggle="tab" <?php if ($editmode != '0'){?>href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit"<?php }?>><?php if($this->lang->line('product_details') != '') { echo stripslashes($this->lang->line('product_details')); } else echo "Details"; ?></a></li>
                                    <li class=""><a data-toggle="tab" <?php if ($editmode == '0'){?>onclick="return saveDetails('categories')"<?php }else {?> href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/categories"<?php }?>><?php if($this->lang->line('product_categories') != '') { echo stripslashes($this->lang->line('product_categories')); } else echo "Categories"; ?></a></li>
                                    <li><a data-toggle="tab" <?php if ($editmode == '0'){?>onclick="return saveDetails('list')"<?php }else {?> href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/list"<?php }?>><?php if($this->lang->line('display_lists') != '') { echo stripslashes($this->lang->line('display_lists')); } else echo "List"; ?></a></li>
                                    <li><a data-toggle="tab" <?php if ($editmode == '0'){?>onclick="return saveDetails('images')"<?php }else {?> href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/images"<?php }?>><?php if($this->lang->line('product_images') != '') { echo stripslashes($this->lang->line('product_images')); } else echo "Images"; ?></a></li>
                                    <li><a data-toggle="tab" <?php if ($editmode == '0'){?>onclick="return saveDetails('attribute')"<?php }else {?> href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/attribute"<?php }?>><?php if($this->lang->line('header_attr') != '') { echo stripslashes($this->lang->line('header_attr')); } else echo "Attribute"; ?></a></li>
                                    <li><a data-toggle="tab" <?php if ($editmode == '0'){?>onclick="return saveDetails('seo')"<?php }else {?> href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/seo"<?php }?>><?php if($this->lang->line('product_seo') != '') { echo stripslashes($this->lang->line('product_seo')); } else echo "SEO"; ?></a></li>
                                </ul>
                                <script>
                                function saveDetails(mode){
                                    $('#nextMode').val(mode);
									$('#editDetailsSub').trigger('click');
                                }
                                </script>
                                <input type="hidden" name="nextMode" id="nextMode" value=""/>
                            <div class="tab-content border_right width_100 pull-left" id="myTabContent"> 
                                <div id="product_info" class="tab-pane active">
                                    <div class="form_fields">
                                        <label><?php if($this->lang->line('header_name') != '') { echo stripslashes($this->lang->line('header_name')); } else echo "Name"; ?><span style="color:red;"> *</span></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="text" class="global-input required" placeholder="<?php if($this->lang->line('header_name') != '') { echo stripslashes($this->lang->line('header_name')); } else echo "Name"; ?>" value="<?php echo $productDetails->row()->product_name;?>" name="product_name">                                        </div>
                                    </div>
                                    <div class="form_fields">
                                            <label><?php if($this->lang->line('header_description') != '') { echo stripslashes($this->lang->line('header_description')); } else echo "Description"; ?><span style="color:red;"> *</span></label>
                                            <div style="height:128px;position: relative;" class="form_fieldsgroup validation-input desc_con">
                                            <textarea class="global-input required mceEditor" placeholder="<?php if($this->lang->line('header_description') != '') { echo stripslashes($this->lang->line('header_description')); } else echo "Description"; ?>" id="description" rows="10" cols="40" name="description"><?php if ($productDetails->row()->description == ''){echo $productDetails->row()->excerpt;}else {echo $productDetails->row()->description;}?></textarea>                                            
                                            <label for="description" generated="true" style="display: none;" class="desc_error">This field is required</label>
                                        	</div>
                                        </div>
                                        
                                        <div class="form_fields">
                                            <label><?php if($this->lang->line('shipping_policies') != '') { echo stripslashes($this->lang->line('shipping_policies')); } else echo "Shipping & policies"; ?><span style="color:red;"> </span></label>
                                            <div style="height:128px;" class="form_fieldsgroup validation-input">
                                            <textarea class="global-input" disabled placeholder="<?php if ($productDetails->row()->shipping_policies == ''){echo "Following are Socktail's shipping policies.

In case you have any questions or need any clarifications do not hesitate to call our Customer Support Team

In case of wooden furniture, please note that wood has inherent qualities such as marginal differences in stain and varnish, unique grain patterns etc. These are visible on a finished product and result in two otherwise identical items looking different. These are natural features of wood that provide character to each piece of wooden furniture and are accepted as per Industry standards. Small knots are also sometimes visible on the surface which is filled in by the furniture craftsmen during manufacture.

Placing an order: Please check dimensions of the entrance/door to your home/office/shop/building/premise before buying, so as to ensure that there is no problem in getting the product inside. In such a situation we will not be able to accept return or cancellation. There are some items that you will need to assemble on your own or you will need to arrange your own carpenter for assembly. Wherever Socktail provides, the carpenter visits will be scheduled subsequent to the delivery of the item.

On Delivery: For all items that are expected to stand, ensure that the item is steady and straight. Unevenness up to 5 mm happens due to difference in surfaces and floor levels and is an accepted industry standard. Bushes will have to be attached to balance the item. In case of dust or a lack of shine, rubbing the surface with a cloth will help. This is an accepted method for cleaning the surface of a furniture item and making it shine.

Damages: Socktail shipping arrangements to your doorstep have been designed to ensure a zero-damage, hassle-free experience, please contact us immediately, in case:

- Your item has any scratches or breakage that unfortunately might have occurred in the course of transit warranting your item to be fixed
- Any instruction manual, screws, nuts etc that might have been missed, should be informed to Customer Support immediately, so that they can arrange for the same to be delivered to you
- Your item arrives in damaged condition. All claims for damage must be made within 3 days of receipt of the item. Your request for a repair, refund or a replacement will be processed as soon as we receive the photographs of the damage to ascertain extent. We request you to retain all packing materials unless instructed otherwise by our team. You have an option of getting a full refund or replacement of the product that was received in damaged condition. Refunds or replacement for furniture returns will be processed when the item(s) has been picked up by us. Hence, please allow up to 2 to 3 weeks for reverse and then subsequent refund to process. A replacement will take the same amount of time as the order for shipping.

Cancellations: We accept cancellation of furniture orders up to 24 hours of placing the same.Pieces of furniture are made specifically for your order.";}else {echo $productDetails->row()->shipping_policies;}?>" id="shipping_policies" rows="10" cols="40" name="shipping_policies"><?php if ($productDetails->row()->shipping_policies != ''){echo $productDetails->row()->shipping_policies;}?></textarea>                                            </div>
                                        </div>
                                        
										
                                    <div class="form_fields">
                                            <label><?php if($this->lang->line('product_excerpt') != '') { echo stripslashes($this->lang->line('product_excerpt')); } else echo "Excerpt"; ?></label>
                                            <div class="form_fieldsgroup">
                                            <textarea class="global-input mceEditor" placeholder="<?php if($this->lang->line('product_excerpt') != '') { echo stripslashes($this->lang->line('product_excerpt')); } else echo "Excerpt"; ?>" rows="5" cols="40" name="excerpt"><?php echo $productDetails->row()->excerpt;?></textarea>                                            </div>
                                        </div>
                                    
                                    <div class="form_fields">
                                        <label><?php if($this->lang->line('product_quantity') != '') { echo stripslashes($this->lang->line('product_quantity')); } else echo "Quantity"; ?><span style="color:red;"> *</span></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="text" class="global-input required number" placeholder="<?php if($this->lang->line('product_quantity') != '') { echo stripslashes($this->lang->line('product_quantity')); } else echo "Quantity"; ?>" value="<?php if ($editmode == '1'){echo $productDetails->row()->quantity;}?>" name="quantity">                                        </div>
                                    </div>
                                     
                                    <!-- <div class="form_fields">
                                        <label><?php if($this->lang->line('product_ship_imd') != '') { echo stripslashes($this->lang->line('product_ship_imd')); } else echo "Shipping Immediately"; ?></label>
                                        <div class="form_fieldsgroup validation-input">
                                        	<input type="radio" name="ship_immediate" <?php if ($editmode == '1'){if($productDetails->row()->ship_immediate == 'true'){echo 'checked="checked"';}}?> value="true"/><?php if($this->lang->line('prference_yes') != '') { echo stripslashes($this->lang->line('prference_yes')); } else echo "Yes"; ?>&nbsp;&nbsp;&nbsp;
                                        	<input type="radio" name="ship_immediate" <?php if ($editmode == '1'){if($productDetails->row()->ship_immediate == 'false'){echo 'checked="checked"';}}else{echo 'checked="checked"';}?> value="false"/><?php if($this->lang->line('prference_no') != '') { echo stripslashes($this->lang->line('prference_no')); } else echo "No"; ?>&nbsp;&nbsp;&nbsp;
                                        </div>
                                    </div> -->

                                     <div class="form_fields">
                                        <label><?php if($this->lang->line('shipping_in') != '') { echo stripslashes($this->lang->line('shipping_in')); } else echo "Shipping in"; ?></label>
                                        <div class="form_fieldsgroup">
 
                                           <?php $shipping = $productDetails->row()->shipping; ?>
                                           <div class="styleSelect">
                                        	 <select class="shop-select sub-category selectBox" name="shipping">
                                                    <option value="<?php $value = '1'; echo $value;?>"<?php if ($value == $shipping) { echo 'selected="selected"';}?>><?php if($this->lang->line('shipping_in_option_first') != '') { echo stripslashes($this->lang->line('shipping_in_option_first')); } else echo "1-3 days"; ?></option>
                                                    <option value="<?php $value = '2'; echo $value;?>"<?php if ($value == $shipping) { echo 'selected="selected"';}?>><?php if($this->lang->line('shipping_in_option_second') != '') { echo stripslashes($this->lang->line('shipping_in_option_second')); } else echo "4-7 days"; ?></option>
                                                    <option value="<?php $value = '3'; echo $value;?>"<?php if ($value == $shipping) { echo 'selected="selected"';}?>><?php if($this->lang->line('shipping_in_option_third') != '') { echo stripslashes($this->lang->line('shipping_in_option_third')); } else echo "2-3 weeks"; ?></option>
                                                    <option value="<?php $value = '4'; echo $value;?>"<?php if ($value == $shipping) { echo 'selected="selected"';}?>><?php if($this->lang->line('shipping_in_option_fourth') != '') { echo stripslashes($this->lang->line('shipping_in_option_fourth')); } else echo "3-4 weeks"; ?></option>
                                                    <option value="<?php $value = '5'; echo $value;?>"<?php if ($value == $shipping) { echo 'selected="selected"';}?>><?php if($this->lang->line('shipping_in_option_fifth') != '') { echo stripslashes($this->lang->line('shipping_in_option_fifth')); } else echo "4-6 weeks"; ?></option>
                                                    <option value="<?php $value = '6'; echo $value;?>"<?php if ($value == $shipping) { echo 'selected="selected"';}?>><?php if($this->lang->line('shipping_in_option_sixth') != '') { echo stripslashes($this->lang->line('shipping_in_option_sixth')); } else echo "6-8 weeks"; ?></option>
                                                </select>
                                                </div>
                                        </div>
                                    </div>
<div class="form_fields">
                                        <label><?php if($this->lang->line('product_ship_cost') != '') { echo stripslashes($this->lang->line('product_ship_cost')); } else echo "Shipping Cost"; ?></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="text" class="global-input " placeholder="<?php if($this->lang->line('product_ship_cost') != '') { echo stripslashes($this->lang->line('product_ship_cost')); } else echo "Shipping Cost"; ?>" value="<?php if ($editmode == '1'){echo $productDetails->row()->shipping_cost;}?>" name="shipping_cost">                                        </div>
                                    </div>
                                     
                                    <div class="form_fields">
                                        <label><?php if($this->lang->line('product_sku') != '') { echo stripslashes($this->lang->line('product_sku')); } else echo "SKU"; ?></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="text" class="global-input " placeholder="<?php if($this->lang->line('product_sku') != '') { echo stripslashes($this->lang->line('product_sku')); } else echo "SKU"; ?>" value="<?php if ($editmode == '1'){echo $productDetails->row()->sku;}?>" name="sku">                                        </div>
                                    </div>
                                    
                                    <div class="form_fields">
                                        <label><?php if($this->lang->line('product_weight') != '') { echo stripslashes($this->lang->line('product_weight')); } else echo "Weight"; ?></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="text" class="global-input " placeholder="<?php if($this->lang->line('product_weight') != '') { echo stripslashes($this->lang->line('product_weight')); } else echo "Weight"; ?>" value="<?php if ($editmode == '1'){echo $productDetails->row()->weight;}?>" name="weight">                                        </div>
                                    </div>
                                    
                                    <div class="form_fields">
                                        <label><?php if($this->lang->line('giftcard_price') != '') { echo stripslashes($this->lang->line('giftcard_price')); } else echo "Price"; ?><span style="color:red;"> *</span></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="text" class="global-input required number minStrict" placeholder="<?php if($this->lang->line('giftcard_price') != '') { echo stripslashes($this->lang->line('giftcard_price')); } else echo "Price"; ?>" value="<?php if ($editmode == '1'){echo $productDetails->row()->price;}?>" name="price" id="price">                                        </div>
                                    </div>
                                    
                                    <div class="form_fields">
                                        <label><?php if($this->lang->line('product_sale_price') != '') { echo stripslashes($this->lang->line('product_sale_price')); } else echo "Sale Price"; ?><span style="color:red;"> *</span></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="text" class="global-input required number minStrict smallerThan" data-min="price" placeholder="<?php if($this->lang->line('product_sale_price') != '') { echo stripslashes($this->lang->line('product_sale_price')); } else echo "Sale Price"; ?>" value="<?php if ($editmode == '1'){echo $productDetails->row()->sale_price;}?>" name="sale_price" id="sale_price">                                        </div>
                                    </div>
                                    <input type="hidden" name="PID" value="<?php echo $productDetails->row()->seller_product_id;?>"/>
                                    <div class="form_fields">
                                            <label></label>
                                            <div class="form_fieldsgroup">
                                            <input type="submit" id="editDetailsSub" value="<?php if($this->lang->line('header_save') != '') { echo stripslashes($this->lang->line('header_save')); } else echo "Save"; ?>" class="button"/>
                                                                                  </div>
                                        </div>
                                    
                                                                        
                                </div>
                                
                                
                            </div>
                        </div>
                    </section>
                        
                    </form>
                </div>
            </div>
        		
    
</div>
		
		<!-- / wrapper-content -->


		
		<a id="scroll-to-top" href="#header" style="display: none;"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>

	</div>
	<!-- / container -->
		<?php 
     $this->load->view('site/templates/footer_menu');
     ?>
</div>
</div>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filesjquery_zoomer.js" type="text/javascript"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>selectbox.js"></script>
<script type="text/javascript" src="js/site/thing_page.js"></script>
<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<script>
$.validator.addMethod("smallerThan", function (value, element, param) {
    var $element = $(element)
        , $min;

    if (typeof(param) === "string") {
        $min = $(param);
    } else {
        $min = $("#" + $element.data("min"));
    }

    if (this.settings.onfocusout) {
        $min.off(".validate-smallerThan").on("blur.validate-smallerThan", function () {
            $element.valid();
        });
    }
    return parseFloat(value) <= parseFloat($min.val());
}, "Sale price must be smaller than price");
$.validator.addClassRules({
	smallerThan: {
    	smallerThan: true
    }
});
$.validator.addMethod('minStrict', function (value, el, param) {
    return value > param;
},"Price must be greater than zero");
$.validator.addClassRules({
	minStrict: {
		minStrict: true,
		minStrict: 0
    }
});
$("#sellerProdEdit1").validate();
function validate_desc(){
	if(tinyMCE.get('description').getContent() == ''){
		$('.desc_con .desc_error').show().focus();
		return false;
	}else{
		$('.desc_con .desc_error').hide();
		return true;
	}
}	
</script>
<style>
.desc_con .desc_error{
	position: absolute;
	right: 0px;
	text-align: right;
	color:red;
	top:0px;
}
</style>
<?php
$this->load->view('site/templates/footer');
?>