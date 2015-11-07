<?php
$feedHead =  "<?xml version='1.0' encoding='UTF-8'?> 
<rss version='2.0' xmlns:g=\"http://base.google.com/ns/1.0\">
<channel>
<title> Furniture and Home Decor Products </title>
<link>".$sitelink." </link>
<description> Furniture and Home Decor Products </description>"; 
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
    /*The below three categories are reverse in order as they are coming from data base in reverse order/ you can manage it in controller*/
    $Maincategory = $datafeed->SubSubcategory;
    $Subcategory = $datafeed->Subcategory;
    $SubSubcategory = $datafeed->Maincategory;
    /*For debuging */
    /*$SubSubSubcategory = $datafeed->SubSubSubcategory;
    $catArr = $datafeed->catArr;*/
    $catArrStr = implode(',', $catArr);
	if ($description == ''){
		$description=$datafeed->description; 
	}
	
	 $feedHead .=  "
<item>
<title>".htmlspecialchars($title)."</title>
<link>".$prodLink."</link>
<g:id>".$id."</g:id>
<g:condition>new</g:condition>
<g:description>".htmlspecialchars($title)."</g:description>
<g:price>".$price."</g:price>
<g:sale_price>".$discprice."</g:sale_price>
<g:availability>in stock</g:availability>	
<g:image_link>".$imgLink."</g:image_link>
<g:google_product_category>Furniture</g:google_product_category>
<g:product_type>".htmlspecialchars($Maincategory)." &gt; ".htmlspecialchars($Subcategory)." &gt; ".htmlspecialchars($SubSubcategory)."</g:product_type>
</item>
	"; 
	} 
}
$feedHead .=  "
</channel>
</rss>";
header("Content-Type: application/rss+xml"); 
echo $feedHead;
?>