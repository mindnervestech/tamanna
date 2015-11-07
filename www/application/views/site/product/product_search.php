<?php   $this->load->view('site/templates/header');?>

<style type="text/css">
ol.stream {
	position: relative;
}
ol.stream.use-css3 li.anim {
transition:all .25s;
-webkit-transition:all .25s;
-moz-transition:all .25s;
-ms-transition:all .25s;
	visibility:visible;
	opacity:1;
}
ol.stream.use-css3 li {
	visibility:hidden;
}
ol.stream.use-css3 li.anim.fadeout {
	opacity:0;
}
ol.stream.use-css3.fadein li {
	opacity:0;
}
ol.stream.use-css3.fadein li.anim.fadein {
	opacity:1;
}
.noproducts {
	float: left;
	width: 90%;
	padding: 5%;
	text-align: center;
	font-size: 25px;
	font-family: cursive;
}
</style>

<!--<script type="text/javascript">
		var can_show_signin_overlay = false;
		if (navigator.platform.indexOf('Win') != -1) {document.write("<style>::-webkit-scrollbar, ::-webkit-scrollbar-thumb {width:7px;height:7px;border-radius:4px;}::-webkit-scrollbar, ::-webkit-scrollbar-track-piece {background:transparent;}::-webkit-scrollbar-thumb {background:rgba(255,255,255,0.3);}:not(body)::-webkit-scrollbar-thumb {background:rgba(0,0,0,0.3);}::-webkit-scrollbar-button {display: none;}</style>");}
	</script> -->
<!--[if lt IE 9]>
<script src="js/html5shiv/dist/html5shiv.js"></script>
<![endif]-->
</head>
<body class="lang-en no-subnav wider winOS"  itemscope itemtype="http://schema.org/WebPage">
<!-- header_start -->
<!-- header_end -->
<!-- Section_start -->
<div id="container-wrapper">
  <div class="container shop" style="width:100%; padding-top:42px;max-width: 1280px;">
      <div class="outside"> </div>

<div class="main1" style="margin-top: -17px;">
      <div id="navigation-test">
        <div class="left" style="width:100%;padding-left: 0px;">
     
<ul class="gnb-wrap" style="width:100%;max-width:1280px;font-size:11px;text-align:center;text-transform: uppercase;">
                      <?php 
                      foreach ($mainCategories->result() as $row){
                      	if ($row->cat_name != '' && $row->cat_name != 'Our Picks'){
                      ?>
            <li class="gnb" style="height:40px;text-align:left;">
             <?php
          if ($row->cat_name != 'Socktail Specials'){
         ?>
              <a class="mn-gifts"  style="line-height: 40px;color:#555555;" href="shopby/<?php echo $row->seourl;?>"><?php echo $row->cat_name;?></a>
        <?php  }
          Else
         { ?>
         <div class="mn-gifts"  style="line-height: 40px;color:#555555;" ><strong><?php echo $row->cat_name;?></strong></div>
        <?php  } ?>



              <div class="menu-contain-gift1"  style="margin-top: -19px;">
                <ul style="border-top:0;">
<?php 
	                      foreach ($all_categories->result() as $row1){
	                      	if ($row1->cat_name != '' && $row->id==$row1->rootID){
	                      ?>
              <li><a  href="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>"><i class="arrow"></i><?php echo $row1->cat_name;?></a>
<?php if (in_array($row1->id, $root_id_arr)){?>
                    <div class="submenu-contain">
                      <ul>
			                      <?php 
			                      foreach ($all_categories->result() as $row2){
			                      	if ($row2->cat_name != '' && $row1->id==$row2->rootID){
			                      ?>
                        <li><a  href="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>/<?php echo $row2->seourl;?>"><?php echo $row2->cat_name;?></a>
                        </li>
                      <?php 
                      	}
                      }
                      ?>
                      </ul>
                    </div>
 	<?php 
			                      	}
			                      	?>
                  </li>
			                      	<?php 
			                      	}
			                      }
			                      	?>
                </ul>
              </div>
            </li>
 <?php 
}
}
?> 
<!--<li  class="gnb"><a  class="mn-gifts" href="gift-cards"><?php if($this->lang->line('giftcard_cards') != '') { echo stripslashes($this->lang->line('giftcard_cards')); } else echo "Gift Cards"; ?></a></li>-->
</ul>        
</div>
</div>
</div>
<h1 style="float:right;margin-top:-10px;"><?php echo $meta_title; ?> </h1>
    <div class="wrapper-content list">
    <div itemprop="breadcrumb">
     <?php echo trim_slashes($breadCumps); ?>
    </div>
<hr>
      <div class="sns-right"> </div>
      
      <div id="content">
   <!-- <div id="banner" class="banner-shop background-image " style="background-image:url(//mudrafurniture.in/images/category/banner/back2.jpg); background-repeat: repeat;">-->
<!-- <div id="banner" class="banner-shop background-image ">
   
    <div class="container-banner">
         <h1>Discover amazing things, share them with others</h1>
<h2>Freedom from MRP</h2>

    </div>
</div>  -->
<!--<?php echo trim_slashes($breadCumps); ?>-->
        <div class="search-frm">
          <div class="search">
          
            <?php echo $listSubCatSelBox;  ?>
            
            <select style="display: none;" class="shop-select price-range selectBox">
             <option value=""><?php if($this->lang->line('product_any_price') != '') { echo stripslashes($this->lang->line('product_any_price')); } else echo "Any Price"; ?></option>	
              <?php foreach ($pricefulllist->result() as $priceRangeRow){ ?>
                 
               <option <?php if($_GET['p']==url_title($priceRangeRow->price_range)){ echo 'selected="selected"'; } ?> value="<?php echo url_title($priceRangeRow->price_range); ?>"><?php echo $currencySymbol;?> <?php echo $priceRangeRow->price_range; ?></option>
           <?php } ?>
            </select>
            <select style="display: none;" class="shop-select color-filter selectBox">
              <option value="" selected="selected"><?php if($this->lang->line('product_any_color') != '') { echo stripslashes($this->lang->line('product_any_color')); } else echo "Any Color"; ?></option>
              <?php 
                      foreach ($mainColorLists->result() as $colorRow){
                      	if ($colorRow->list_value != ''){
$list_value_trimmed = preg_replace("/[^a-zA-Z]+/", "", $colorRow->list_value);

                      ?>
              <option <?php if($_GET['c']==url_title($colorRow->list_value)){ echo 'selected="selected"'; } ?> value="<?php echo strtolower($list_value_trimmed);?>"><?php echo ucfirst($colorRow->list_value);?></option>
              <?php 
                      	}
                      }
              ?>
            </select>
            <select style="display: none;" class="shop-select sort-by-price selectBox">
              <option selected="selected" value=""><?php if($this->lang->line('product_newest') != '') { echo stripslashes($this->lang->line('product_newest')); } else echo "Newest"; ?></option>
              <option value="asc"><?php if($this->lang->line('product_low_high') != '') { echo stripslashes($this->lang->line('product_low_high')); } else echo "Price: Low to High"; ?></option>
              <option value="desc"><?php if($this->lang->line('product_high_low') != '') { echo stripslashes($this->lang->line('product_high_low')); } else echo "Price: High to Low"; ?></option>
            </select>
           <!-- <label for="immediateShipping" class="shipping-filter button-wrapper tooltip "> <span class="quick-shipping"> <span class="icon truck"></span> </span>
            <input type="checkbox" value="true" name="is" id="immediateShipping"  />
            <i></i><b><?php if($this->lang->line('product_ship_immed') != '') { echo stripslashes($this->lang->line('product_ship_immed')); } else echo "Items that ship immediately"; ?></b> </label>-->
            <span class="label"><i class="ic-search"></i><em class="hidden"><?php if($this->lang->line('header_search') != '') { echo stripslashes($this->lang->line('header_search')); } else echo "Search"; ?></em></span> <a href="#" class="del-val"><i class="ic-del"></i><em class="hidden"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?></em></a>
            <input  class="search-string" type="text"  placeholder="<?php if($this->lang->line('product_filter_key') != '') { echo stripslashes($this->lang->line('product_filter_key')); } else echo "Filter by keyword"; ?>" />
          </div>
          <div class="sorting"> </div>
        </div>


        <?php if($productList->num_rows()>0){
          ?>
        <ol class="stream">
          <?php  foreach ($productList->result() as $productListVal) { 
        	$img = 'dummyProductImage.jpg';
			$imgArr = explode(',', $productListVal->image);
			if (count($imgArr)>0){
				foreach ($imgArr as $imgRow){
					if ($imgRow != ''){
						$img = $pimg = $imgRow;
						break;
					}
				}
			}
	       $fancyClass = 'fancy';
			$fancyText = LIKE_BUTTON;
			if (count($likedProducts)>0 && $likedProducts->num_rows()>0){
				foreach ($likedProducts->result() as $likeProRow){
					if ($likeProRow->product_id == $productListVal->seller_product_id){
						$fancyClass = 'fancyd';$fancyText = LIKED_BUTTON;break;
					}
				}
			}
		?>
          <li>
            <div class="figure-product-new mini" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08), 0 0 2px rgba(0, 0, 0, 0.06), 0 0 0 1px rgba(0, 0, 0, 0.04), 0 -1px 0 0 rgba(0, 0, 0, 0.05);  border-radius: 3px;"> <a href="things/<?php echo $productListVal->id;?>/<?php echo url_title($productListVal->product_name,'-');?>">
              <figure style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08), 0 0 2px rgba(0, 0, 0, 0.06), 0 0 0 1px rgba(0, 0, 0, 0.04), 0 -1px 0 0 rgba(0, 0, 0, 0.05);  border-top-left-radius: 3px;
border-top-right-radius: 3px;"><img src="images/product/<?php echo $img; ?>"> </figure>
              <figcaption><?php echo $productListVal->product_name;?></figcaption>
			<!-- vinit code start -->
			<?php
                    $prodID = $productListVal->id;
                    $origPrice = $productListVal->sale_price;
                    $userId = $productListVal->user_id;
                    $catId = $productListVal->category_id;

/*                    $prodCouponQuery  = 'select * from '.COUPONCARDS.' where `card_status` = "not used" AND `product_id` like "%'.$prodID.'%"
                     AND `status` = "Active" AND dateto >= CURDATE()';
                     
                    $CoupRes = $this->product_model->ExecuteQuery($prodCouponQuery);
                    $couponCode = '';
                    $discVal = 0.00;
                    if($CoupRes->num_rows() > 0){
                        foreach($CoupRes->result() as $coupRow){
                                $currDisc = $coupRow->price_value;
                                if($currDisc > $discVal){
                                    $discVal = $currDisc;
                                    $couponCode = $coupRow->code;
                                }
                                
                            }
                        }
                        $discPrice = '';
                        if($couponCode != '' && $discVal != 0.00){
                            $origPrice = $productListVal->sale_price;
                            $discount = ($discVal * 0.01) * $origPrice;
                            $discPrice = number_format($origPrice-$discount);
                        }
*/
                        $couponCode = '';
                        $discVal = 0.00;
                        $discPrice = '';
                        $discDesc = '';
                        $resultArr = $this->product_model->getDiscountedDetails($prodID,$origPrice,$userId,$catId);
                        $couponCode = $resultArr['coupon_code'];
                        $discPrice = $resultArr['disc_price'];
                        $discVal = $resultArr['disc_percent'];
                        $discDesc = $resultArr['disc_desc'];    
                        
                    
                    ?>
			<!-- vinit code end -->
              </a> <span class="username">
<!--<b class="price"><?php echo $currencySymbol;?></b>
<b class="price" style="text-decoration: line-through;font-weight: normal;"><?php if ($productListVal->price>$productListVal->sale_price){echo $productListVal->price;echo " ";}?></b>
<b class="price"><?php echo $productListVal->sale_price;?></b> -->
<!--Saurabh Code Logic
if coupon code{
 if sale price < retail price{
 show striked out retail price}
 else{
 show striked out sale price}
show discount coupon}
else{
 if sale price < retail price{
 show striked out retail price
 show sale price}
 else{
 show sale price}
}
-->


<?php if($discPrice != ''){?>
   <?php if ($productListVal->price>$productListVal->sale_price){ ?>
      <div style="display:inline-block;">Retail Price: <?php echo $currencySymbol;?></div>
      <div style="text-decoration: line-through;font-weight: normal;display:inline-block;"><?php echo number_format($productListVal->price);echo " ";?></div>
   <?php } else {?>
      <div style="display:inline-block;">Retail Price: <?php echo $currencySymbol;?></div>
      <div style="text-decoration: line-through;font-weight: normal;display:inline-block;"><?php echo number_format($productListVal->sale_price);?></div>
   <?php } ?>
   </br>Today's Price: <b class="price"><?php echo $currencySymbol;?><?php echo $discPrice;?></b> ( Discount Coupon Inside )
  <!-- <div style="font-size:11px;font-style:italic;">(Use Coupon Code <div style="color:red;display:inline-block;font-style:italic;">"<?php echo $couponCode;?>"</div>)</div> -->
<?php } else { ?>
   <?php if ($productListVal->price>$productListVal->sale_price){ ?>
      <div style="display:inline-block;">Retail Price: <?php echo $currencySymbol;?></div>
      <div style="text-decoration: line-through;font-weight: normal;display:inline-block;"><?php echo number_format($productListVal->price);echo " ";?></div>
      </br>You Pay: <b class="price"><?php echo $currencySymbol;?><?php echo number_format($productListVal->sale_price);?></b>
   <?php } else {?>
      <b class="price"><?php echo $currencySymbol;?><?php echo number_format($productListVal->sale_price);?></b>
   <?php } ?>
<?php } ?>


</span>
<!--<span class="icon-heart-filled" style="float: right;padding-right: 10px;color: firebrick;"><?php echo $productListVal->likes; ?></span> -->


            <!--  <a href="#" class="button <?php echo $fancyClass;?>" tid="<?php echo $productListVal->seller_product_id;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?> item_img_url="images/product/<?php echo $img;?>"><span><i></i></span><?php echo $fancyText;?></a>--> </div>
          </li>
         <?php } ?>
        


        </ol>
        
        <div class="pagination" style="display:none">
                    <?php echo $paginationDisplay; ?>
        </div>
        <?php }else {?>
     <!--   <ol class="stream">
        <li style="width: 100%;"><p class="noproducts"><?php if($this->lang->line('product_no_more') != '') { echo stripslashes($this->lang->line('product_no_more')); } else echo "No more products available"; ?></p></li>
        </ol> -->
        <?php }?>
      </div>

      <a style="display: none;" href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a> </div>
    <!-- / container -->
  </div>
     <?php 
$this->load->view('site/templates/sub_footer_cat');
     $this->load->view('site/templates/footer_menu');
     ?>
  <!-- / container -->
</div>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>shoplist.js" type="text/javascript"></script>
<script>
	jQuery(function($) {
		var $select = $('.gift-recommend select.select-round');
		$select.selectBox();
		$select.each(function(){
			var $this = $(this);
			if($this.css('display') != 'none') $this.css('visibility', 'visible');
		});
	});
</script>
<script>
    //emulate behavior of html5 textarea maxlength attribute.
    jQuery(function($) {
        $(document).ready(function() {
            var check_maxlength = function(e) {
                var max = parseInt($(this).attr('maxlength'));
                var len = $(this).val().length;
                if (len > max) {
                    $(this).val($(this).val().substr(0, max));
                }
                if (len >= max) {
                    return false;
                }
            }
            $('textarea[maxlength]').keypress(check_maxlength).change(check_maxlength);
            
            
        });
    });
</script>
<?php
$this->load->view('site/templates/footer');
?>