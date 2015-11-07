<!DOCTYPE html>
<!-- Microdata markup added by Google Structured Data Markup Helper. -->
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
<!--<meta name="keywords" content="<?php echo $meta_keyword; ?>" />-->
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
<meta name="msvalidate.01" content="9808E4188251AF2F4C97BBC53BFF7189" />

</head>
<body>
<a href="https://plus.google.com/+Socktail" rel="publisher"></a>
<a href="https://plus.google.com/+Socktail?rel=author">Google</a>

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
          <div class="logo"><a href="<?php echo base_url();?>" alt="<?php echo $siteTitle;?>" title="<?php echo $siteTitle;?>"><img id="_logo6" src="images/logo/<?php echo $logo;?>" alt="socktail logo"/></a></div>
          <ul class="gnb-wrap">
            <li class="gnb">
              <!-- <a href="/gifts" class="mn-gifts">Gifts</a> -->
              <a class="mn-gifts" href="shop"><?php if($this->lang->line('header_shop') != '') { echo stripslashes($this->lang->line('header_shop')); } else echo "Shop"; ?></a>

            </li>
           <li class="gnb">
              <a class="mn-gifts" href="design-ideas"><?php echo "Ideas"; ?></a>
            </li>
          <!--  <li class="gnb">
              <a class="mn-gifts" href="professionals/all"><?php echo "Find a Pro"; ?></a>
            </li> -->
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
            		if ($cmsLimit==1)break;
            		if ($cmsRow['category'] == 'Main'){
            			$cmsLimit++;
            			
            ?>
         <!--   <li class="gnb"><a class="mn-help" href="pages/<?php echo $cmsRow['seourl'];?>"><?php echo $cmsRow['page_name'];?></a> -->
<li class="gnb"><a class="mn-help" href="#"><?php echo $cmsRow['page_name'];?></a>
            <?php if (in_array($cmsRow['id'], $parentIdArr)){?>
            <div class="menu-contain-help">
            <?php 
            foreach ($cmsPages as $cmsSubRow){
            	if ($cmsSubRow['category'] == 'Sub' && $cmsSubRow['parent'] == $cmsRow['id'] && $cmsSubRow['page_name'] != 'We are Hiring' && $cmsSubRow['page_name'] != 'Write for us' && $cmsSubRow['page_name'] != 'Privacy Policy' && $cmsSubRow['page_name'] != 'Terms of Use'){
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
		  
<?php 
if($this->config->item('google_verification_code')){ echo stripslashes($this->config->item('google_verification_code'));}
?>
