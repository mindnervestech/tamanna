<?php
$feedHead =  "<?xml version='1.0' encoding='UTF-8'?> 
<rss version='2.0'>
<channel>
<title>".$heading." </title>
<link>".$sitelink." </link>
<description>".$sitedescription." </description>
<language>en-us</language>
<Products>"; 
if ($productDetails != '' && count($productDetails)>0){
	foreach ($productDetails as $datafeed)
	{
	$id=$datafeed->id;
	$title=$datafeed->product_name; 
	$link=$datafeed->created; 
	$price=$datafeed->sale_price; 
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
<Product>
<id>".$id."</id>
<title>".$title."</title>
<ProductDesc>".$description."</ProductDesc>
<ProductImage>".$imgLink."</ProductImage>
<Price>".$price."</Price>
<link>".$prodLink."</link>
<availability>TRUE</availability>
<brand>Socktail</brand>
<manufacturer>Socktail</manufacturer>
<modelnumber>".$sku."</modelnumber>
<material>".$material."</material>
<category>".$Maincategory."</category>
<subcategory>".$Subcategory."</subcategory>
<subsubcategory>".$SubSubcategory."</subsubcategory>
</Product>
	"; 
	} 
}
$feedHead .=  "
</Products>
</channel>
</rss>";
header("Content-Type: application/rss+xml"); 
echo $feedHead;
?>

