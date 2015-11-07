<?php
$feedHead ="<channel>"; 
if ($productDetails != '' && count($productDetails)>0){
	foreach ($productDetails as $datafeed)
	{
	$id=$datafeed->id;
	$title=$datafeed->product_name; 
	$link=$datafeed->created; 
	$price=$datafeed->sale_price;
	$discprice=$datafeed->discPrice;
	$img = array_filter(explode(',', $datafeed->image));
	$imgLink = base_url().'images/product/'.$img[0];
	$prodLink = base_url().'things/'.$id.'/'.url_title($title,'-');
	$description=$datafeed->excerpt;
        $sku=$datafeed->sku;
        $material=$datafeed->listvalue;
	if ($description == ''){
		$description=$datafeed->description; 
	}
	
	 $feedHead .=  "
<item>
<Product_Name>".$title."</Product_Name>
<Description>".$description."</Description>
<Actual_Price>".$price."</Actual_Price>
<Discount_Price>".$discprice."</Discount_Price>
<URL>".$prodLink."</URL>
<Shipping_Price>0</Shipping_Price>
<availability>20</availability>
<brand>Socktail</brand>
<Category_Name>Furniture</Category_Name>
<SubCategory_Name>Furniture</SubCategory_Name>
<SubSubCategory_Name>Furniture</SubSubCategory_Name>
<Prod_Image>".$imgLink."</Prod_Image>
<Shipping_Days>14-21 business days</Shipping_Days>
<Store_Name>Socktail</Store_Name>
<EMI>No</EMI>
<COD>Yes</COD>
<Stock>20</Stock>
</item>
"; 
	} 
}
$feedHead .=  "</channel>";
header("Content-Type: application/rss+xml"); 
echo $feedHead;
?>

