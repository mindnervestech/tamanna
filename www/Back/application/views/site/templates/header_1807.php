<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?php if($this->config->item('google_verification')){ echo stripslashes($this->config->item('google_verification')); }
if ($meta_title != '' and $meta_title != $title){?>
<title><?php echo $meta_title;?></title>
<?php } elseif ($heading != ''){?>
<title><?php echo $heading;?></title>
<?php }else {?>
<title><?php echo $title;?></title>
<?php }?>
<meta name="Title" content="<?php echo $meta_title;?>" />
<meta name="keywords" content="<?php echo $meta_keyword; ?>" />
<meta name="description" content="<?php echo $meta_description; ?>" />
<meta property="og:image" content="<?php echo base_url();?>images/product/<?php echo $this->data['meta_image'];?>" />
<base href="<?php echo base_url(); ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/logo/<?php echo $fevicon;?>"/>
<?php if (is_file('google-login-mats/index.php'))
{
	require_once 'google-login-mats/index.php';
}?>
<!-- Loading Css Files -->
<?php $this->load->view('site/templates/css_files');?>

<!-- Loading Script Files -->
<?php $this->load->view('site/templates/script_files');?>

<!-- Loading Theme Settings-->
<?php $this->load->view('site/templates/theme_settings');?>
<!--<meta name="robots" content="noindex,nofollow">-->
</head>
<body>
<a href="https://plus.google.com/+Hobuzz" rel="publisher"></a>
<!-- Facebook code for comments -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1523521781201029&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- header_start -->
<header style="margin-bottom: 21px;">
  <div class="header_top">
  <?php  $pricesval = $pricefulllist->result_array(); 
  		$ColorsListVal = $mainColorLists->result_array();?>
<?php 

if (is_file('google-login-mats/index.php'))
{
	require_once 'google-login-mats/index.php';
}

?>  
<?php 
	   		$by_creating_accnt = str_replace("{SITENAME}",$siteTitle,$this->lang->line('header_create_acc'));
	   ?>
<div class="main">
      <div id="navigation-test">
        <div class="left">
          <div class="logo"><a href="<?php echo base_url();?>" alt="<?php echo $siteTitle;?>" title="<?php echo $siteTitle;?>"><img src="images/logo/<?php echo $logo;?>"/></a></div>
          <ul class="gnb-wrap">
            <li class="gnb">
              <!-- <a href="/gifts" class="mn-gifts">Gifts</a> -->
              <a class="mn-gifts" style="font-weight: bold;" href="shopby/all"><?php if($this->lang->line('header_shop') != '') { echo stripslashes($this->lang->line('header_shop')); } else echo "Shop"; ?></a>
<!--              <div class="menu-contain-gift">
                <ul>
<?php 
if ($fancyBoxCount>0){
?>                
                  <li><a href="fancybox"><?php if($this->lang->line('header_fancybox') != '') { echo stripslashes($this->lang->line('header_fancybox')); } else echo "Fancy Box"; ?></a></li>
<?php 
}
if ($this->config->item('giftcard_status') == 'Enable'){
?>  
                  <li><a href="gift-cards"><?php if($this->lang->line('giftcard_cards') != '') { echo stripslashes($this->lang->line('giftcard_cards')); } else echo "Gift Cards"; ?></a></li>
<?php 
}
if($loginCheck != ''){
?>                  
                 --> <!-- <li><a href="bookmarklets"><?php if($this->lang->line('bookmarklets') != '') { echo stripslashes($this->lang->line('bookmarklets')); } else echo "Bookmarklets"; ?></a></li>--><!--
<?php }?>               
                </ul>
                <ul style="border-top:0;">
                  <li><a href="shopby/all?p=<?php echo url_title($pricesval[0]['price_range']); ?>"><i class="arrow"></i><?php if($this->lang->line('header_by_price') != '') { echo stripslashes($this->lang->line('header_by_price')); } else echo "By Price"; ?></a>
                    <div class="submenu-contain">
                      <ul> <?php foreach ($pricefulllist->result() as $priceRangeRow){ ?>
                        <li><a href="shopby/all?p=<?php echo url_title($priceRangeRow->price_range); ?>"><?php echo $currencySymbol;?> <?php echo ucfirst($priceRangeRow->price_range);  ?></a></li>
                       <?php } ?>
                      </ul>
                    </div>
                  </li>-->
               <!--   <?php if ($mainColorLists->num_rows()>0){?>
                  <li><a class="color-red" href="shopby/all?c=<?php echo $ColorsListVal[0]['list_value'];?>"><i class="arrow"></i><?php if($this->lang->line('header_by_color') != '') { echo stripslashes($this->lang->line('header_by_color')); } else echo "By Color"; ?></a>
                    <div class="submenu-contain">
                      <ul class="palette">
                      <?php 
                      foreach ($mainColorLists->result() as $colorRow){
                      	if ($colorRow->list_value != ''){
                      ?>
                        <li><a href="shopby/all?c=<?php echo strtolower($colorRow->list_value);?>"><i class="color <?php echo strtolower($colorRow->list_value);?>"></i> <?php echo ucfirst($colorRow->list_value);?></a></li>
                      <?php 
                      	}
                      }
                      ?>  
                      </ul>
                    </div>
                  </li>
                  <?php }?> --><!--
                  <?php if ($mainCategories->num_rows()>0){?>
                  <li><a href="shopby/all"><i class="arrow"></i><?php if($this->lang->line('header_by_category') != '') { echo stripslashes($this->lang->line('header_by_category')); } else echo "By Category"; ?></a>
                    <div class="submenu-contain">
                      <ul>
                      <?php 
                      foreach ($mainCategories->result() as $row){
                      	if ($row->cat_name != '' && $row->cat_name != 'Our Picks'){
                      ?>
                        <li style="position: relative;"><a href="shopby/<?php echo $row->seourl;?>"><?php echo $row->cat_name;?></a>
                        <?php if (in_array($row->id, $root_id_arr)){?>
	                    <div class="submenu-contain1" style="top:0;">
	                      <ul>
	                      <?php 
	                      foreach ($all_categories->result() as $row1){
	                      	if ($row1->cat_name != '' && $row->id==$row1->rootID){
	                      ?>
	                        <li style="position: relative;"><a href="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>"><?php echo $row1->cat_name;?></a>
	                        	 <?php if (in_array($row1->id, $root_id_arr)){?>
			                    <div class="submenu-contain2" style="top:0;">
			                      <ul>
			                      <?php 
			                      foreach ($all_categories->result() as $row2){
			                      	if ($row2->cat_name != '' && $row1->id==$row2->rootID){
			                      ?>
			                        <li style="position: relative;"><a href="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>/<?php echo $row2->seourl;?>"><?php echo $row2->cat_name;?></a>
			                        	<?php if (in_array($row2->id, $root_id_arr)){?>
					                    <div class="submenu-contain3" style="top:0;">
					                      <ul>
					                      <?php 
					                      foreach ($all_categories->result() as $row3){
					                      	if ($row3->cat_name != '' && $row2->id==$row3->rootID){
					                      ?>
					                        <li style="position: relative;"><a href="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>/<?php echo $row2->seourl;?>/<?php echo $row3->seourl;?>"><?php echo $row3->cat_name;?></a>
					                        	<?php if (in_array($row3->id, $root_id_arr)){?>
							                    <div class="submenu-contain4" style="top:0;">
							                      <ul>
							                      <?php 
							                      foreach ($all_categories->result() as $row4){
							                      	if ($row4->cat_name != '' && $row3->id==$row4->rootID){
							                      ?>
							                        <li style="position: relative;"><a href="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>/<?php echo $row2->seourl;?>/<?php echo $row3->seourl;?>/<?php echo $row4->seourl;?>"><?php echo $row4->cat_name;?></a>
							                        
							                        </li>
							                      	<?php 
							                      	}
							                      }
							                      	?>
						                          </ul>
						                        </div>  
						                        <?php }?>
					                        </li>
					                      	<?php 
					                      	}
					                      }
					                      	?>
				                          </ul>
				                        </div>  
				                        <?php }?>
			                        </li>
			                      	<?php 
			                      	}
			                      }
			                      	?>
		                          </ul>
		                        </div>  
		                        <?php }?>
	                        </li>
	                      	<?php 
	                      	}
	                      }
	                      	?>
                          </ul>
                        </div>  
                        <?php }?>
                        </li>
                      <?php 
                      	}
                      }
                      ?>
                      </ul>
                    </div> 
                  </li>
                  <?php }?>
                </ul>
              </div>-->
            </li>
            <!-- <li class="gnb"><a class="mn-stores" href="stores"><?php if($this->lang->line('stores') != '') { echo stripslashes($this->lang->line('stores')); } else echo "Stores";?></a></li>-->
            <?php if ($loginCheck != ''){?>
            <li class="gnb"><a href="add" class="mn-add"><?php if($this->lang->line('header_add') != '') { echo stripslashes($this->lang->line('header_add')); } else echo "Add"; ?></a></li>
            <?php }?>
            <?php 
            if (count($cmsPages)>0){
            	$cmsLimit = 0;
            	$parentIdArr = array();
            	foreach ($cmsPages as $cmsArrRow){
            		array_push($parentIdArr, $cmsArrRow['parent']);
            	}
            	foreach ($cmsPages as $cmsRow){
            		if ($cmsLimit==3)break;
            		if ($cmsRow['category'] == 'Main'){
            			$cmsLimit++;
            			
            ?>
         <!--   <li class="gnb"><a class="mn-help" href="pages/<?php echo $cmsRow['seourl'];?>"><?php echo $cmsRow['page_name'];?></a> -->
<li class="gnb"><a class="mn-help" href="#"><?php echo $cmsRow['page_name'];?></a>
            <?php if (in_array($cmsRow['id'], $parentIdArr)){?>
            <div class="menu-contain-help">
            <?php 
            foreach ($cmsPages as $cmsSubRow){
            	if ($cmsSubRow['category'] == 'Sub' && $cmsSubRow['parent'] == $cmsRow['id']){
            ?>
            	<ul>
                  <li><a href="pages/<?php echo $cmsSubRow['seourl'];?>"><?php echo $cmsSubRow['page_name'];?></a></li>
                </ul>
            <?php 
            	}
            }
            ?>
            </div>
            <?php }?>
            </li>
            <?php 
            		}
            	}
            }
            ?>
          <!--  <?php if ($loginCheck == ''){?>
            <li class="gnb"><a class="mn-signup popup-signup-ajax" href="#"><i class="ic-sign"></i> <?php if($this->lang->line('login_signup') != '') { echo stripslashes($this->lang->line('login_signup')); } else echo "Sign up"; ?></a></li>
            <?php }?>-->
          </ul>
        </div>
          <form action="<?php base_url();?>shopby/all" class="search">
            <fieldset>
            <input type="text" name="q" class="text" id="search-query" placeholder="<?php if($this->lang->line('header_search') != '') { echo stripslashes($this->lang->line('header_search')); } else echo "Search"; ?>" value="" autocomplete="off"/>
            <button type="submit" class="btn-submit"><?php if($this->lang->line('header_search') != '') { echo stripslashes($this->lang->line('header_search')); } else echo "Search"; ?></button>
            <div class="feed-search" style="display: none;">
				<h4><?php if($this->lang->line('header_suggestions') != '') { echo stripslashes($this->lang->line('header_suggestions')); } else echo "Suggestions"; ?></h4>
				<div class="loading" style="display: block;"><i></i>
				<img class="loader" src="images/site/loading.gif"/>
				</div>
			</div>
            </fieldset>
          </form>
        <div class="right">
<?php if ($loginCheck == ''){?>
  <ul class="gnb-wrap">
	<li class="gnb"><a href="login" class="mn-signin"><?php if($this->lang->line('signup_sign_in') != '') { echo stripslashes($this->lang->line('signup_sign_in')); } else echo "Sign in"; ?></a></li>
<!--<li class="gnb"><a class="mn-signup popup-signup-ajax" href="#"> <?php if($this->lang->line('login_signup') != '') { echo stripslashes($this->lang->line('login_signup')); } else echo "Sign up"; ?></a></li>-->
    <li class="gnb"><a class="mn-signin" href="signup"><?php if($this->lang->line('login_signup') != '') { echo stripslashes($this->lang->line('login_signup')); } else echo "Sign up"; ?></a></li>
   <!-- <li id="lang_popup" class="gnb">
            <a class="mn-lang"><?php if($this->lang->line('prference_language') != '') { echo stripslashes($this->lang->line('prference_language')); } else echo "Language"; ?> <i></i></a>
            <div class="menu-contain-lang">
                <ul>	
                <?php 
                $selectedLangCode = $this->session->userdata('language_code');
                if ($selectedLangCode == ''){
                	$selectedLangCode = $defaultLg[0]['lang_code'];
                }
                if (count($activeLgs)>0){
                	foreach ($activeLgs as $activeLgsRow){
                ?>							
                    <li><a href="lang/<?php echo $activeLgsRow['lang_code'];?>" <?php if ($selectedLangCode == $activeLgsRow['lang_code']){echo 'class="selected"';}?>><?php echo $activeLgsRow['name'];?></a></li>
                <?php 
                	}
                }
                ?>    	
                </ul>        
            </div>
    </li> -->
    
</ul>    
<?php }else{ ?>
<div id="MiniCartViewDisp" style="float:left;">
<ul class="gnb-wrap">
	<li class="gnb none gnb-notification">
		<a href="notifications" class="mn-notification">
			<span class="hide"><?php if($this->lang->line('referrals_notification') != '') { echo stripslashes($this->lang->line('referrals_notification')); } else echo "Notifications"; ?></span> 
		<!--	<em class="ic-notification">
 				<i class="count">5</i>
 			</em> -->
<span class="icon-chat-empty"></span>
		</a>
		<div class="feed-notification">
			<i class="arrow"></i>
			<h4><?php if($this->lang->line('referrals_notification') != '') { echo stripslashes($this->lang->line('referrals_notification')); } else echo "Notifications"; ?></h4>
			<div class="loading"><i></i></div>
			<ul>
				<li>
					<a href="">
					<img src="" class="photo"/>
					</a>
					
					<a href="">
					<img src="" class="thing"/>
					</a>
				</li>
			</ul>
			<a href="notifications" class="moreFeed"><?php if($this->lang->line('see_all_noty') != '') { echo stripslashes($this->lang->line('see_all_noty')); } else echo "See all notifications"; ?></a>
		</div>
	</li>
</ul>
<?php echo $MiniCartViewSet; ?>
</div>
 <?php } ?>
        
          <?php if ($loginCheck != ''){
          	if ($userDetails->row()->thumbnail == ''){
          		$thumbImg = 'user-thumb1.png';
          	}else {
          		$thumbImg = $userDetails->row()->thumbnail;
          	}
          ?>
            <ul class="gnb-wrap">
            <li class="gnb">
            	<a href="<?php echo 'user/'.$userDetails->row()->user_name;?>" class="mn-you"><span class="icon-user-outline"></span><?php if($this->lang->line('header_you') != '') { echo stripslashes($this->lang->line('header_you')); } else echo "You"; ?></a>
            	<!--<style>.mn-you img.default {background-image:url(images/users/<?php echo $thumbImg;?>);} </style> -->
            	<div class="menu-contain-you">
            	<ul>
                  <li><a href="bookmarklets"><?php if($this->lang->line('bookmarklets') != '') { echo stripslashes($this->lang->line('bookmarklets')); } else echo "Get Bookmarklet"; ?></a></li>
<li><a href="invite-friends"><?php if($this->lang->line('onboarding_invite_frd') != '') { echo stripslashes($this->lang->line('onboarding_invite_frd')); } else echo "Invite Friends";?></a></li>
                </ul>
                <ul>
                  <li><a href="settings"><?php if($this->lang->line('header_settings') != '') { echo stripslashes($this->lang->line('header_settings')); } else echo "Settings"; ?></a></li>
                  <li><a href="logout"><?php if($this->lang->line('header_signout') != '') { echo stripslashes($this->lang->line('header_signout')); } else echo "Sign out"; ?></a></li>
                </ul>
              </div>
             </li>
             </ul>
		  <?php }?>

      <!--    <form action="<?php base_url();?>shopby/all" class="search">
            <fieldset>
            <input type="text" name="q" class="text" id="search-query" placeholder="<?php if($this->lang->line('header_search') != '') { echo stripslashes($this->lang->line('header_search')); } else echo "Search"; ?>" value="" autocomplete="off"/>
            <button type="submit" class="btn-submit"><?php if($this->lang->line('header_search') != '') { echo stripslashes($this->lang->line('header_search')); } else echo "What are you looking for?"; ?></button>
            <div class="feed-search" style="display: none;">
				<h4><?php if($this->lang->line('header_suggestions') != '') { echo stripslashes($this->lang->line('header_suggestions')); } else echo "Suggestions"; ?></h4>
				<div class="loading" style="display: block;"><i></i>
				<img class="loader" src="images/site/loading.gif"/>
				</div>
			</div>
            </fieldset>
          </form>-->
        </div>
      </div>
    </div>
  </div>
</header>
<!-- header_end -->
<!-- Loading Popup Templates -->
<?php $this->load->view('site/templates/popup_templates');?>
<!--ShareBar.net BEGINS-->
<style>#ShareBar{top:100px;width:54px;padding-right:10px;left: 0 !important;overflow:hidden;position: fixed;z-index: 22;text-align:center;line-height:normal;_position: absolute;font-size:11px;font-family:Arial;}#ShareBar a,#ShareBar a:hover,#ShareBar a:visited{text-decoration:none;font-size:11px;}#e{float:right;margin-top:10px;position:relative;}#e:hover{margin-right:-7px;}</style>

<div id="ShareBar"><div id="e"><iframe style="height:63px; border:none; overflow:hidden; width:50px;" src="http://www.facebook.com/plugins/like.php?app_id=1523521781201029&amp;href=https://www.facebook.com/hobuzz/&amp;send=false&amp;layout=box_count&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;locale=en_US" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>

<div id="e"><script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script><g:plusone size="tall" href="http://hobuzz.com/"></g:plusone></div><script>if(typeof(window.innerHeight)=='number')document.getElementById('ShareBar').style.top=((window.innerHeight-180)/2.7)+'px';</script></div>
<!--ShareBar.net ENDS-->

<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
		  
<?php 
if($this->config->item('google_verification_code')){ echo stripslashes($this->config->item('google_verification_code'));}
?>