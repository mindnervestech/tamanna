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



    <div class="wrapper-content list" style="margin-top: 20px;">
<div class="left-bar" style="width:280px;background:white;float:left;height:1000px;border-radius:3px">
<div class="left-bar-head" style="font-size: 15px;margin-top: 0;padding: 16px 0px 5px 10px;font-weight: bold;color: #666;">
Filter by Type
</div>
<div class="left-bar-body" style="font-size: 14px;margin-top: 0;padding: 10px 15px 15px 20px;">
<a href="professionals/all"style="display:block;line-height:25px">All Professionals</a>
<?php  
foreach ($categoriesMain->result() as $categoriesMainVal) {
?>
<a href="professionals/<?php echo $categoriesMainVal->seourl;?>"style="display:block;line-height:25px"><?php echo $categoriesMainVal->cat_name; ?></a>
<?php  
}
?>
</div>
</div>

<div class="right-bar" style="width: 940px;background:white;float:right;overflow:hidden;border-radius:3px">



<h1 style="float:left;padding: 20px 0 20px 20px;font-size:28px;border-bottom:0;color: #666;">Home Improvement and Design Pros</h1>
      <div class="sns-right"> </div>

 <!--  <div itemprop="breadcrumb" style="float:right">
     <?php echo trim_slashes($breadCumps); ?> 
    </div> -->




      <div id="content">
        <div class="search-frm">
          <div class="search">
          
         <!--   <?php echo $listSubCatSelBox;  ?> -->
            
            <!--<select style="display: none;" class="shop-select color-filter selectBox">
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
            </select> -->

          <!--  <select style="display: none;" class="shop-select sort-by-price selectBox">
              <option selected="selected" value=""><?php if($this->lang->line('product_newest') != '') { echo stripslashes($this->lang->line('product_newest')); } else echo "Newest"; ?></option>
              <option value="asc"><?php if($this->lang->line('product_low_high') != '') { echo stripslashes($this->lang->line('product_low_high')); } else echo "Price: Low to High"; ?></option>
              <option value="desc"><?php if($this->lang->line('product_high_low') != '') { echo stripslashes($this->lang->line('product_high_low')); } else echo "Price: High to Low"; ?></option>
            </select> -->
            <span class="label" style="border-left:0;left: 60%;"><i class="ic-search"></i><em class="hidden"><?php if($this->lang->line('header_search') != '') { echo stripslashes($this->lang->line('header_search')); } else echo "Search"; ?></em></span> <a href="#" class="del-val"><i class="ic-del"></i><em class="hidden"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?></em></a>
            <input  class="search-string" type="text"  style="right: 35px;" placeholder="<?php if($this->lang->line('product_filter_key') != '') { echo stripslashes($this->lang->line('product_filter_key')); } else echo "Filter by keyword"; ?>" />
          </div>
          <div class="sorting"> </div>
        </div>


        <?php if($userproductList->num_rows()>0){
          ?>
        <ol class="stream" style="width:900px;border-top: 1px solid #e6e6e6;  padding-left:0;">

          <?php  foreach ($userproductList->result() as $userproductListVal) { 
        	$img = 'dummyProductImage.jpg';
			$imgArr = explode(',', $userproductListVal->image);
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
					if ($likeProRow->product_id == $userproductListVal->seller_product_id){
						$fancyClass = 'fancyd';$fancyText = LIKED_BUTTON;break;
					}
				}
			}
		?>





          <li style="width:900px;overflow:hidden;border-bottom: 1px solid #e6e6e6;  height: 300px;">
            <div class="figure-product-new mini" style="border-radius: 3px;  width: 890px;height: 300px;display: table;">
<a href="user/<?php echo $userproductListVal->user_name;?>" style="display: table-cell;height:300px;width:300px;vertical-align: middle;  border-right: 1px solid #e6e6e6;"> 
              <figure style="width:300px;height: 300px;"><img src="images/product/<?php echo $img; ?>"> </figure>
</a>	
        

<div class="vcardprof" style="display:table-cell;padding: 20px;width:500px">

<div class="prof-header" style="overflow: hidden;padding: 5px 100px 0px 10px;position: relative;">
<img class="prof-thumb" src="images/users/<?php echo $userproductListVal->thumbnail; ?>"style="float: left;border-radius: 50%;overflow: hidden;border: 1px solid #e6e6e6;width:50px;height:50px">
<a href="user/<?php echo $userproductListVal->user_name;?>" style="display:block;margin-left: 60px;font-size: 22px;line-height: 30px;width: 280px;"> 
<?php echo $userproductListVal->brand_name;?>
</a>
<span class="prof-header-content" style="font-size: 14px;padding-left:10px"><?php echo $userproductListVal->s_city;?>, <?php echo $userproductListVal->s_state;?></span>
<!--<img src="http://socktail.com/uploaded/phone_2.png" style="width:25px;height:25px;position: absolute;right:70px;top: 3px;border-radius: 50px;border: 1px solid #e6e6e6;">-->
<span class="prof-header-content" style="position: absolute;right: 0;top: 3px;  font-size: 14px;"><?php echo $userproductListVal->email;?></span>
<span class="prof-header-content" style="position: absolute;right: 0;top: 23px;  font-size: 14px;"><?php echo $userproductListVal->s_phone_no;?></span>
</div>
<div class="prof-details" style="display:block;font-size: 14px;line-height: 1.4;padding: 20px 10px 0;">
<div class="prof-about" style="display:inline-block;  height: 150px;  overflow: hidden;"><?php echo $userproductListVal->brand_description;?>....<a class="prof-link" href="user/<?php echo $userproductListVal->user_name;?>" style="color:#3d8901;">Read More <span class="icon-more"></span></a></div>
</div>
</div>
		
           
<!--<span class="icon-heart-filled" style="float: right;padding-right: 10px;color: firebrick;"><?php echo $userproductListVal->likes; ?></span> -->


            <!--  <a href="#" class="button <?php echo $fancyClass;?>" tid="<?php echo $userproductListVal->seller_product_id;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?> item_img_url="images/product/<?php echo $img;?>"><span><i></i></span><?php echo $fancyText;?></a>--> </div>
          </li>
         <?php } ?>
        


        </ol>
        
     <!--   <div class="pagination" style="display:none">
                    <?php echo $paginationDisplay; ?>
        </div> -->
        <?php }else {?>
     <!--   <ol class="stream">
        <li style="width: 100%;"><p class="noproducts"><?php if($this->lang->line('product_no_more') != '') { echo stripslashes($this->lang->line('product_no_more')); } else echo "No more products available"; ?></p></li>
        </ol> -->
        <?php }?>
      </div>

      <a style="display: none;" href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a> </div>
</div>
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