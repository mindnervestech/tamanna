<!doctype html>
<html lang="en">
	<head>
		<?php if($this->config->item('google_verification')){ echo stripslashes($this->config->item('google_verification')); }
		if ($meta_title != '' and $meta_title != $title){?>
		<title><?php echo $meta_title;?></title>
		<?php } elseif ($heading != ''){?>
		<title><?php echo $heading;?></title>
		<?php }else {?>
		<title><?php echo $title;?></title>
		<?php }?>
		<meta name="Title" content="<?php echo $meta_title;?>" />

		<meta charset="utf-8">
		<!--add responsive layout support-->
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<!--meta info-->
		<meta name="author" content="">
		<meta name="description" content="<?php echo $meta_description; ?>" />
		<meta property="og:image" content="<?php echo base_url();?>images/product/<?php echo $this->data['meta_image'];?>" />
		<base href="<?php echo base_url(); ?>" />
		<!--include favicon-->
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/logo/<?php echo $fevicon;?>">
        <?php if (is_file('google-login-mats/index.php'))
		{
			require_once 'google-login-mats/index.php';
		}?>
		<!--fonts include -->
		<link href='css/Roboto.css' rel='stylesheet' type='text/css'>
		<!--<link href='css/Roboto_slab.css' rel='stylesheet' type='text/css'>-->
		<!--stylesheet include-->
		<link rel="stylesheet" type="text/css" media="all" href="plugins/fancybox/jquery.fancybox.css">
		<link rel="stylesheet" type="text/css" media="all" href="plugins/owl-carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" type="text/css" media="all" href="plugins/jackbox/css/jackbox.min.css">
		<link rel="stylesheet" type="text/css" media="all" href="css/animate.css">
		<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="all" href="css/style.css">
		<!--[if lte IE 10]>
			<link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
			<link rel="stylesheet" type="text/css" media="screen" href="plugins/jackbox/css/jackbox-ie9.css">
		<![endif]-->
		<!--head libs-->
		<!--[if lte IE 8]>
			<style>
				#preloader{display:none !important;}
			</style>
		<![endif]-->
		<script src="js/jquery-2.1.1.min.js"></script>
		<script src="js/modernizr.js"></script>
	</head>
	<body class="sticky_menu">
		<input id="user_location" <?php if($this->session->userdata('location') == ''){
		echo "value=1";}else{echo "value=0";} ?> hidden></input>
		<!-- External Links -->
		<a href="https://plus.google.com/+Socktail" rel="publisher"></a>
		<a href="https://plus.google.com/+Socktail?rel=author"></a>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=1523521781201029";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		 
		<!--layout-->
		<div class="wide_layout db_centered bg_white">
			<!--[if (lt IE 9) | IE 9]>
				<div class="bg_red" style="padding:5px 0 12px;">
				<div class="container" style="width:1170px;"><div class="row wrapper"><div class="clearfix color_white" style="padding:9px 0 0;float:left;width:80%;"><i class="fa fa-exclamation-triangle f_left m_right_10" style="font-size:25px;"></i><b>Attention! This page may not display correctly.</b> <b>You are using an outdated version of Internet Explorer. For a faster, safer browsing experience.</b></div><div class="t_align_r" style="float:left;width:20%;"><a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode" class="button_type_1 d_block f_right lbrown tr_all second_font fs_medium" target="_blank" style="margin-top:6px;">Update Now!</a></div></div></div></div>
			<![endif]-->
			<header role="banner" class="w_inherit">
				<!--top part-->
				<div class="header_top_part">
					<div class="container">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3 fs_small color_light fw_light t_xs_align_c">
								<ul class="hr_list second_font si_list fs_small">
									<li><i class="fa fa-phone color_dark fs_large" style="margin-top:1px;"></i> <a class="sc_hover d_inline_b" href="pages/contact-us"> 7304 22 44 88</a></li>
									<li class="w_break" data-icon=""><i class="fa fa-envelope color_dark" style="margin-top:1px;"></i> <a href="mailto:contact@socktail.com" class="sc_hover d_inline_b"> contact@socktail.com</a></li>
								</ul>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-9 t_align_r t_xs_align_c">
								<!--shop nav-->
								<nav class="d_inline_b">
									<ul class="hr_list second_font si_list fs_small">
                                        <?php if ($loginCheck != ''){ ?>
										<li><a class="sc_hover tr_delay" href="add-thing">Add Products</a></li>	
                                        <li><a class="sc_hover tr_delay" href="settings">My Account</a></li>
                                        <li><a class="sc_hover tr_delay" href="purchases">Purchase History</a></li>
										<li><a class="sc_hover tr_delay" href="<?php echo 'user/'.$userDetails->row()->user_name;?>">Wishlist</a></li>
                                        <li><a class="sc_hover tr_delay" href="logout">Logout</a></li>
                                        <?php }else  { ?>
                                        <li><a class="sc_hover tr_delay" href="login">Login</a></li>
										<li><a class="sc_hover tr_delay" href="signup">Signup</a></li>
                                        <?php } ?>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="header_middle_part t_xs_align_c">
					<div class="container">
						<div class="d_table w_full d_xs_block">
							<div class="col-lg-9 col-md-9 col-sm-9 d_table_cell d_xs_block f_none v_align_m m_xs_bottom_15">
								<!--logo-->
								<a href="<?php echo base_url();?>" class="d_inline_b" alt="<?php echo $siteTitle;?>" title="<?php echo $siteTitle;?>">
									<img src="images/logo/<?php echo $logo;?>" alt="socktail logo"">
								</a>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 d_table_cell d_xs_block f_none v_align_m m_xs_bottom_15">
									<ul class="hr_list second_font si_list fs_medium scheme_color tt_uppercase t_align_r">
                                    <li><a class="sc_hover tr_delay" href="customization-request">Customize</a></li>									
                                    <li><a class="sc_hover tr_delay" href="design-ideas/all">Buy Locally</a></li>
                                    <li><a class="sc_hover tr_delay" href="shop">Shop Online</a></li>
									</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="header_bottom_part bg_white w_inherit">
					<div class="container">
						<hr class="divider_black">
						<div class="row">
							<div class="col-lg-10 col-md-10">
								<button id="mobile_menu_button" class="vc_child d_xs_block db_xs_centered d_none m_bottom_10 m_top_15 bg_lbrown color_white tr_all"><i class="fa fa-navicon d_inline_m"></i></button>
								<!--main menu-->
								<nav role="navigation" class="d_xs_none">
	
								</nav>
							</div>
							<div class="col-lg-2 col-md-2 clearfix t_sm_align_c">
								<ul class="hr_list si_list shop_list f_right f_sm_none d_sm_inline_b t_sm_align_l">
								<?php if ($loginCheck != ''){?>
                                	<li>
										<a href="<?php echo 'user/'.$userDetails->row()->user_name;?>" class="color_lbrown_hover vc_child">
											<span class="d_inline_m">
												<button class="tooltip_container"><i class="fa fa-heart fs_large"></i>
												<sup id="likes_count"><?php echo $userDetails->row()->likes;?></sup>
												<span class="tooltip top fs_small color_white hidden animated" data-show="fadeInDown" data-hide="fadeOutUp">Check Your Wishlist</span></button>
											</span>
										</a>
									</li>
									<!--shopping cart-->
									<?php echo $MiniCartViewSet; ?><?php }?>                                
								</ul>
							</div>
						</div>
					</div>
				</div>
			</header>
		<!--Page Js-->
		<script src="js/site/capture_user_location.js"></script>