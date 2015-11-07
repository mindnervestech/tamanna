<?php
$this->load->view('site/templates/header');
?>

<script type="text/javascript" src="js/site/jquery.mSimpleSlidebox.js"></script>
<!-- slidebox function call -->
<script type="text/javascript">
$(document).ready(function(){
	$(".mSlidebox").mSlidebox({
		autoPlayTime:4000,
		controlsPosition:{
			buttonsPosition:"outside"
		}
	});
	$("#mSlidebox_3").mSlidebox({
		easeType:"easeInOutCirc",
		numberedThumbnails:true,
		pauseOnHover:false
	});
});
</script>

 <!-- Section_start -->
<div class="lang-en wider no-subnav thing signed-out winOS">
<div id="container-wrapper">

<div class="main1" style="max-width: 100%;margin:-1px 0;border-radius:0;margin-top: 25px;">
      <div id="navigation-test">
        <div class="left" style="padding-left: 0px;">
     
<ul class="gnb-wrap" style="width:100%;font-size:11px;text-align:center;text-transform: uppercase;">
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



              <div class="menu-contain-gift1" style="margin-top: -20px;">
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
                        <li><a href="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>/<?php echo $row2->seourl;?>"><?php echo $row2->cat_name;?></a>
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

	<div class="container shoppage" style="padding-top: 78px;width:1250px;padding-bottom: 0;">
	
		<div class="shop_text">
        <?php 
        if($bannerList->num_rows()>0){
        ?>
        	<div class="shop_slider">
            
            	<div class="mSlidebox slidebox">
                    <ul>
                    <?php 
                    foreach ($bannerList->result() as $bannerListRow){
                    	$link = $bannerListRow->link;
                    	if ($link != ''){
                    		if (substr($link,0,4) != 'http'){
								$link = 'http://'.$link;
                    		}
                    	}
                    ?>
                        <li>
                            <div><?php if ($link!=''){?><a href="<?php echo $link;?>"><?php }?><img src="<?php echo base_url();?>images/category/banner/<?php echo $bannerListRow->image;?>" alt="<?php echo $bannerListRow->name;?>" /><?php if ($link!=''){?></a><?php }?></div>
                        </li>
                    <?php 
                    }
                    ?>    
                    </ul>
                </div>
            	
            
            </div>
        <?php 
        }
        if ($mainCategories->num_rows()>0){
        ?>   
            <div class="shop_browse" style="border-bottom: 1px solid #EBECEF;">
            
            	<div style="font-size:28px;text-align:center;padding-bottom:30px"><?php echo "BROWSE BY CATEGORIES"; ?></div>
                
                <ul class="shop_browse">
                <?php 
                foreach ($mainCategories->result() as $mainCategoriesRow){
                	if($mainCategoriesRow->cat_name != 'Our Picks'&& $mainCategoriesRow->cat_name != 'SALE' && $mainCategoriesRow->cat_name != 'Xpress Ship'){
//                	$cat_img = base_url().'images/no_image.gif';
                	$cat_img = '';
                	if ($mainCategoriesRow->image != ''){
                		if (file_exists('images/category/'.$mainCategoriesRow->image)){
	                		$cat_img = base_url().'images/category/'.$mainCategoriesRow->image;
                		}	
                	}
                ?>
                    <li>
                    
                    	<a href="shopby/<?php echo $mainCategoriesRow->seourl;?>" style="float:left;width:100%;height:100%;">
                        <?php 
                        if ($cat_img != ''){
                        ?>
                        	<img src="<?php echo $cat_img;?>" alt="<?php echo $mainCategoriesRow->cat_name;?>" title="<?php echo $mainCategoriesRow->cat_name;?>" />
                        <?php 
                        }
                        ?>    
                            <b><?php echo $mainCategoriesRow->cat_name;?></b>
                        </a>    
                    
                    </li>
                <?php 
               } }
                ?>    
                
                </ul>
            
            </div>
       <?php 
        }
       ?> 




<!-- Trending Products-->
<?php 
				if ($favoriteProducts->num_rows()>0){
				?>
				<div class="might-fancy" style="float: left;">
					<div style="font-size:28px;text-align:center;padding-top:40px; padding-bottom:30px"><?php echo "BEST SELLERS"; ?></div>
					<div style="height: 1260px;" class="figure-row fancy-suggestions anim">
					<?php 
					foreach ($favoriteProducts->result() as $relatedRow){
						$img = 'dummyProductImage.jpg';
						$imgArr = array_filter(explode(',', $relatedRow->image));
						if (count($imgArr)>0){
							foreach ($imgArr as $imgRow){
								if ($imgRow != ''){
									$img = $imgRow;
									break;
								}
							}
						}
					?>
							<div class="figure-product" style="width: 275px;height:320px;">
								<a href="<?php echo base_url();?>things/<?php echo $relatedRow->id;?>/<?php echo url_title($relatedRow->product_name,'-');?>">
								<figure>
								<span class="wrapper-fig-image" style="width:275px;">
									<span class="fig-image">
										<img style="width: 275px; height: 275px;" src="<?php echo base_url();?>images/product/<?php echo $img;?>">
									</span>
								</span>
								<figcaption><?php echo $relatedRow->product_name;?></figcaption>
								</figure>
								</a>
							</div>
					<?php 
					}
					?>
							</div>
				</div>
				<?php }?>


<!-- Trending Products End -->


<?php 
				if ($recentProducts->num_rows()>0){
				?>
				<div class="might-fancy" style="border-top: 1px solid #EBECEF;float: left;">
					<div style="font-size:28px;text-align:center;margin-top:40px; padding-bottom:30px;"><?php echo "NEW ADDITIONS"; ?></div>
					<div style="height: 300px;" class="figure-row fancy-suggestions anim">
					<?php 
					foreach ($recentProducts->result() as $relatedRow){
						$img = 'dummyProductImage.jpg';
						$imgArr = array_filter(explode(',', $relatedRow->image));
						if (count($imgArr)>0){
							foreach ($imgArr as $imgRow){
								if ($imgRow != ''){
									$img = $imgRow;
									break;
								}
							}
						}
					?>
							<div class="figure-product" style="width: 275px;">
								<a href="<?php echo base_url();?>things/<?php echo $relatedRow->id;?>/<?php echo url_title($relatedRow->product_name,'-');?>">
								<figure>
								<span class="wrapper-fig-image" style="width:275px;">
									<span class="fig-image">
										<img style="width: 275px; height: 275px;" src="<?php echo base_url();?>images/product/<?php echo $img;?>">
									</span>
								</span>
								<figcaption><?php echo $relatedRow->product_name;?></figcaption>
								</figure>
								</a>
							</div>
					<?php 
					}
					?>
							</div>
				</div>
				<?php }?>


	    </div>


		<a href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>

	</div>
	
	<!-- / container -->
		<?php 
     $this->load->view('site/templates/footer_menu');
     ?>
</div>

</div>
<?php
$this->load->view('site/templates/footer');
?>