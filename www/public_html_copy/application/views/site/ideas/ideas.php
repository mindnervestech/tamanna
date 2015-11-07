<?php
$this->load->view('site/templates/header');
?>
<style>
.noproducts {
	float: left;
	width: 90%;
	padding: 5%;
	text-align: center;
	font-size: 25px;
	font-family: cursive;
}
/*.offer {
color: #fff;
padding: 20px 0 20px;
text-shadow: 0 2px 1px rgba(0, 0, 0, .5);
width: 440px;
line-height: 1.1;
border-bottom: 0px;
text-align: left;
float: right;
margin-right: 5%;
}*/

</style>
<script type="text/javascript" src="js/site/landing_category.js"></script>
<script type="text/javascript">

function everythingView(val){

	if($('#everythinglist'+val).css('display')=='block'){
		$('#everythinglist'+val).hide('');	
	}else{
		$('#everythinglist'+val).show('');
	}
	
}
</script>


<link
	rel="stylesheet" type="text/css" media="all"
	href="css/site/<?php
echo SITE_COMMON_DEFINE ?>timeline.css" />
<!-- Section_ends -->
<section>
<div id="container-wrapper">




<?php
$controlview = $layoutList->result_array();

if ($controlview[0]['home_control'] == 'classic')
{
		$viewhome = 'classic';
}
else
if ($controlview[0]['home_control'] == 'grid')
{
		$viewhome = 'normal';
}
else
if ($controlview[0]['home_control'] == 'compact')
{
		$viewhome = 'vertical';
}

$force_login = '';

if ($loginCheck == '')
{
		$force_login = 'force_login';
}

?>
<div class="container timeline <?php
echo $viewhome; ?>">
 <div class="wrapper-content landing_page">
  <?php
if (count($productDetails) > 0)
{
?>
 <div class="top-menu">
<!-- script to hide everything dropdown when clicking outside -->
<div class="welcome" style="margin-top: 0;margin-bottom: 0;padding-top:10px;font-size:24px;"><h3>Designs, Pictures and Home Improvement Ideas</h3></div>
<div class="welcome" style="margin-top: 0;margin-bottom: 10px;"><h4>Share with us..</h4></div>
<!--<form>
<input TYPE="button" class="btn-invite" VALUE="Get Bookmarklet"
     onclick="window.location.href='bookmarklets'"> 
</form>
<form>
<input TYPE="button" class="btn-invite" VALUE="Invite Friends"
     onclick="window.location.href='invite-friends'"> 
</form>-->
<div class="step1" style="  margin-left: 32%;">
		
		<ul class="case <?php echo $force_login;?>" style="  margin-bottom: 10px;overflow:hidden">
 			<li style="width: 220px;"><a href="add" class="mn-add-web"><span class="icon-upload-cloud"></span> Add from Web</a></li> 
			<li style="width: 220px;"><a href="add" class="mn-add-upload" ><span class="icon-laptop"></span>Upload from Computer</a></li>
		</ul>
 	</div>
 </div>


			<?php
		$productArr = $productDetails;
?>
			<div id="content" style="padding-top:45px;">
		<?php
		if ($loginCheck != '')
		{
?>
<!--<div class="wall-box">
    <div class="menu-outer">
<div class="step1">
		<p class="heading">Add to <?php echo $siteTitle;?></p>
		
		<ul class="case">
 			<li><a href="add" class="mn-add-web" ><span class="icon-upload-cloud"></span> from Web</a></li> 
			<li><a href="add" class="mn-add-upload" ><span class="icon-laptop"></span>from Computer</a></li>
		</ul>
 	</div>
</div>

<div class="recom-users">
<p class="heading">
Recommended Users to Follow</p>
		<ul class="recom-users-list" style="height: 210px;overflow: hidden;">
<?php 
	if($LatestsellerUser->num_rows() > 0){
		foreach ($LatestsellerUser->result() as $sellerUser) { 
			$followClass = 'follow';
	        $followText = 'Follow';
	        $followingListArr = explode(',', $userDetails->row()->following);
	        if (in_array($sellerUser->id, $followingListArr)){
	        	$followClass = 'following';
	        	$followText = 'Following';
	        } ?>
		<li class="recom-users-item">
            <a href="user/<?php echo $sellerUser->user_name;?>">
				<img src="images/users/<?php if($sellerUser->thumbnail != ''){ echo $sellerUser->thumbnail;}else{ echo 'user-thumb1.png';} ?>" class="avartar">
			</a>
			<p class="username">
				<span class="title"><a href="user/<?php echo $sellerUser->user_name;?>"><?php echo $sellerUser->user_name;?></a></span>
			<a uid="<?php echo $sellerUser->id;?>" class="btn-invite follow-link <?php echo $followClass;?>" href="javascript:void(0)"><?php echo $followText;?></a> 

			</p>
		</li>
<?php	}
	} ?>
			
		<?php //echo $userList;?>
<?php 
	if($LatestUser->num_rows() > 0){
		foreach ($LatestUser->result() as $UUser) { 
			$followClass = 'follow';
	        $followText = 'Follow';
	        $followingListArr = explode(',', $userDetails->row()->following);
	        if (in_array($UUser->id, $followingListArr)){
	        	$followClass = 'following';
	        	$followText = 'Following';
	        } ?>
		<li class="recom-users-item">
            <a href="user/<?php echo $UUser->user_name;?>">
				<img src="images/users/<?php if($UUser->thumbnail != ''){ echo $UUser->thumbnail;}else{ echo 'user-thumb1.png';} ?>" class="avartar">
			</a>
			<p class="username">
				<span class="title"><a href="user/<?php echo $UUser->user_name;?>"><?php echo $UUser->user_name;?></a></span>
			<a uid="<?php echo $UUser->id;?>" class="btn-invite follow-link <?php echo $followClass;?>" href="javascript:void(0)"><?php echo $followText;?></a> 

			</p>
		</li>
<?php	}
	} ?>
		</ul>
	</div>
<div class="people">
<p class="heading">
People</p>
<div class="fb-facepile" style="padding:10px 20px 20px 20px;" data-app-id="383102725159240" data-href="https://www.facebook.com/socktail" data-action="socktaildotcom:use" data-width="230" data-height="20" data-max-rows="1" data-colorscheme="light" data-size="medium" data-show-count="true"></div>
</div></br>

</div>

-->
<?php
		} ?>
				<ol class="stream">
				<?php
		for ($i = 0; $i < count($productArr); $i = $i + 1)
		{
				if (isset($productArr[$i]->id))
				{
						$imgArr = explode(',', $productArr[$i]->image);
						$img = 'dummyProductImage.jpg';
						foreach($imgArr as $imgVal)
						{
								if ($imgVal != '')
								{
										$img = $imgVal;
										break;
								}
						}

						$fancyClass = 'fancy';
						$fancyText = LIKE_BUTTON;
						if (count($likedProducts) > 0 && $likedProducts->num_rows() > 0)
						{
								foreach($likedProducts->result() as $likeProRow)
								{
										if ($likeProRow->product_id == $productArr[$i]->seller_product_id)
										{
												$fancyClass = 'fancyd';
												$fancyText = LIKED_BUTTON;
												break;
										}
								}
						}

						if (isset($productArr[$i]->web_link))
						{
								$prodLink = "user/" . $productArr[$i]->user_name . "/things/" . $productArr[$i]->seller_product_id . "/" . url_title($productArr[$i]->product_name, '-');
						}
						else
						{
								$prodLink = "things/" . $productArr[$i]->id . "/" . url_title($productArr[$i]->product_name, '-');
						}

?>


					<li class="big clear"
						tid="<?php
						echo $productArr[$i]->seller_product_id; ?>"
						tuserid="<?php
						echo $productArr[$i]->user_id; ?>">
						<div class="figure-item" style="width:600px;height: 585px;">
							<!-- span class="pre"></span -->
							<!--<a
								href="<?php
						if ($productArr[$i]->user_id != '0')
						{
								echo base_url() . 'user/' . $productArr[$i]->user_name;
						}
						else
						{
								echo base_url() . 'user/administrator';
						} ?>"
								class="vcard <?php
						echo $force_login; ?>"> <?php
						if ($productArr[$i]->thumbnail == '')
						{ ?>
								<img src="images/users/user-thumb1.png"> <?php
						}
						else
						{ ?> <img
								src="images/users/<?php
								echo $productArr[$i]->thumbnail; ?>"> <?php
						} ?>
							</a>--> <a href="<?php
						echo $prodLink; ?>"
								class="figure-img <?php
						echo $force_login; ?>" style="border-bottom:0"> <span
								class="figure grid" style="background-size: cover;width:600px;height: 500px;"
								data-ori-url="images/product/<?php
						echo $img; ?>"
								data-310-url="images/product/<?php
						echo $img; ?>"><em
									class="back"></em> </span> <!--<span class="figure classic"> <em
									class="back"></em> <img src="images/product/<?php
						echo $img; ?>"
									data-width="640" data-height="640"> </span> <span
								class="figure vertical"> <em class="back"></em> <img
									src="images/product/<?php
						echo $img; ?>" data-width="310"
									data-height="310"> </span>-->
<span class="figcaption" style="max-width:100%;font-size:15px;  padding: 10px 0 0 10px;height:20px"><?php
						echo $productArr[$i]->product_name; ?>

<span class="username"><a  style="font-size: 15px;  padding: 0 0 0 10px;" class="<?php
						echo $force_login; ?>"
										href="<?php
						if ($productArr[$i]->user_id != '0')
						{
								echo base_url() . 'user/' . $productArr[$i]->user_name;
						}
						else
						{
								echo base_url() . 'user/administrator';
						} ?>"><?php
						if ($productArr[$i]->user_id != '0')
						{
								echo $productArr[$i]->full_name;
						}
						else
						{
								echo 'administrator';
						} ?>
									</a></span>

							</span> 
<!--<div style="float: right;margin-top: 10px;margin-right: 5px;" class="fb-like" data-href="<?php echo base_url();?>user/<?php echo $productArr[$i]->user_name;?>/things/<?php echo$productArr[$i]->seller_product_id;?>/<?php echo url_title($productArr[$i]->product_name,'-');?>"  data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>-->

<!--<span class="icon-heart-filled" style="float: right;margin-top: 10px;padding-right: 10px;color: firebrick;"><?php echo $productArr[$i]->likes; ?></span>-->
</a> 
<div class="pinMeta" style="display:none"><span class="username"><a class="<?php
						echo $force_login; ?>"
										href="<?php
						if ($productArr[$i]->user_id != '0')
						{
								echo base_url() . 'user/' . $productArr[$i]->user_name;
						}
						else
						{
								echo base_url() . 'user/administrator';
						} ?>"><?php
						if ($productArr[$i]->thumbnail == '')
						{ ?>
								<img style="height: 30px;
width: 30px;" src="images/users/user-thumb1.png"> <?php
						}
						else
						{ ?> <img style="height: 30px;
width: 30px;" src="images/users/<?php
								echo $productArr[$i]->thumbnail; ?>"> <?php
						} ?><?php
						if ($productArr[$i]->user_id != '0')
						{
								echo $productArr[$i]->full_name;
						}
						else
						{
								echo 'administrator';
						} ?>
									</a></span>
<div class="excerpt"><?php echo $productArr[$i]->excerpt; ?></div></div>
<!-- <em class="figure-detail">--> <!--<?php
						if (!isset($productArr[$i]->web_link))
						{ ?>
								<span class="price"><?php
								echo $currencySymbol; ?> <?php
								echo $productArr[$i]->sale_price; ?>
									<small><?php
								echo $currencyType; ?> </small> </span> <?php
						} ?> -->

<!--<span class="username"><em style="padding-left: 0;">
<a class="<?php
						echo $force_login; ?>"
										href="<?php
						if ($productArr[$i]->user_id != '0')
						{
								echo base_url() . 'user/' . $productArr[$i]->user_name;
						}
						else
						{
								echo base_url() . 'user/administrator';
						} ?>"><?php
						if ($productArr[$i]->thumbnail == '')
						{ ?>
								<img style="height: 30px;
width: 30px;" src="images/users/user-thumb1.png"> <?php
						}
						else
						{ ?> <img style="height: 30px;
width: 30px;" src="images/users/<?php
								echo $productArr[$i]->thumbnail; ?>"> <?php
						} ?><?php
						if ($productArr[$i]->user_id != '0')
						{
								echo $productArr[$i]->full_name;
						}
						else
						{
								echo 'administrator';
						} ?>
									</a> + <?php
						echo $productArr[$i]->likes; ?> <span class="icon-heart-1"></span></em> </span> </em> -->
							<ul class="function">
							<!--	<li class="list"><a href="#">Add to List</a></li>
								<li class="cmt"><a href="#">Comment</a></li>
								<li class="share">
									<button type="button" <?php
						if ($loginCheck == '')
						{ ?>
										require_login="true" <?php
						} ?>
										data-timage="<?php //echo base_url();
						 ?>images/product/<?php
						echo $img; ?>"
										class="btn-share"
										tname="<?php
						echo $productArr[$i]->product_name; ?>"
										username="<?php
						if ($productArr[$i]->user_id != '0')
						{
								echo $productArr[$i]->full_name;
						}
						else
						{
								echo 'administrator';
						} ?>">
										<i class="icon-forward-outline"></i>
									</button>
								</li>-->
								<!--<li class="view-cmt"><a href="#">5 comments</a></li>-->
							</ul>

							<a href="#" item_img_url="images/product/<?php
						echo $img; ?>"
								tid="<?php
						echo $productArr[$i]->seller_product_id; ?>"
								class="button <?php
						echo $fancyClass; ?>"
								<?php
						if ($loginCheck == '')
						{ ?> require_login="true" <?php
						} ?>><span><i></i>
							</span> <?php
						echo $fancyText; ?> </a>
						</div>

					</li>
					<?php
				}
		}
?>
				</ol> <!-- it was ol -->
				<div id="infscr-loading" style="display: none;">
					<!--img alt='Loading...' src="/_ui/images/site/common/ajax-loader.gif"-->
					<span class="loading">Loading...</span>
				</div>
			<!--	<div class="pagination" style="display: none">
				<?php
				echo $paginationDisplay;
                ?>
				</div> -->
			</div>

			<?php
}
else
{
?>
			<div id="content">
				<p class="noproducts">
				<?php
		if ($this->lang->line('product_not_avail') != '')
		{
				echo stripslashes($this->lang->line('product_not_avail'));
		}
		else echo "No products available"; ?>
				</p>
				<?php
} ?>
				<!-- / content -->

				<style>
</style>
			</div>
			<a href="#header" id="scroll-to-top"><span><?php

if ($this->lang->line('signup_jump_top') != '')
{
		echo stripslashes($this->lang->line('signup_jump_top'));
}
else echo "Jump to top"; ?>
			</span> </a>
		</div>
		<!-- / container -->
	</div>
				<?php
$this->load->view('site/templates/sub_footer');
$this->load->view('site/templates/footer_menu');
?>
</div>
</section>

<!-- Section_start -->
<script>
jQuery(function($){
	$('a.more').mouseover(function(){$('.sns-minor').show();return false;});
	$('a.more').click(function(){
		$('.sns-minor').toggleClass('toggle');
	});
	$('.sns-minor .trick').click(function(){
		$('.sns-minor').removeClass('toggle');
		return false;
	});
	$('.sns-major').mouseover(function(){$('.sns-minor').hide();return false;});
	$('.sns-minor').mouseover(function(){if ($(this).hasClass('toggle')==false) $(this).hide();});
});
</script>
<script>
(function(){
	var $btns = $('.viewer li'), $stream = $('ol.stream'), $container=$('.container'), $wrapper = $('.wrapper-content'), first_id = 'stream-first-item_', latest_id = 'stream-latest-item_';
	$stream.data('feed-url', '/user-stream-updates?new-timeline&feed=featured');

	
	// show images as each image is loaded

	$stream.on('itemloaded', function(){
		var $latest = $stream.find('>#'+latest_id).removeAttr('id'),
	 	    $first = $stream.find('>#'+first_id).removeAttr('id'),
		    $target=$(), viewMode;

		// merge sameuser thing 

		var userid = $latest.attr('tuserid');
		var $currents = $latest.prevUntil('li[tuserid!='+userid+"]");
		var $nexts = $latest.nextUntil('li[tuserid!='+userid+"]");
		var $group = $($currents).add($latest).add($nexts);
		$nexts.filter(".clear").removeClass("clear").find("a.vcard").detach();
		if($group.length>2){
/*			$group.removeClass("big mid").addClass("sm").each(function(i){
			if(i%3==0) $(this).addClass("clear");
			});
			*/
			if($group.length%3==2){

//				$group.last().removeClass("sm").addClass("mid").prev().removeClass("sm").addClass("mid");

			}else if($group.length%3==1){

//				$group.last().removeClass("sm").addClass("big");

			}
		}else if($group.length==2){

//				$group.removeClass("big").addClass("mid");

		}
		
		var forceRefresh = false;

		if(!$first.length || !$latest.length) {
			$target = $stream.children('li');
		} else {
			var newThings = $first.prevAll('li');			
			if(newThings.length) forceRefresh = true;
			$target = newThings.add($latest.nextAll('li'));
		}

		$stream.find('>li:first-child').attr('id', first_id);
		$stream.find('>li:last-child').attr('id', latest_id);

	    viewMode = $container.hasClass('vertical') ? 'vertical' : ($container.hasClass('normal') ? 'grid':'classic');

		if(viewMode=='grid'){
			$target.each(function(i,v,a){
				var $li = $(this), src_g;
				var $grid_img = $li.find(".figure.grid");
				
				if($grid_img.height()>400){
					$grid_img.css("background-image", "url("+$grid_img.attr("data-ori-url")+")");					
				}else{
					$grid_img.css("background-image", "url("+$grid_img.attr("data-310-url")+")");
				}
			});
		}

		if(viewMode == 'vertical'){
			$('#infscr-loading').show();
			setTimeout(function(){
				arrange(forceRefresh);
				$('#infscr-loading').hide();
			},10);
		}

	});
	$stream.trigger('itemloaded');
	
	$btns.each(function(){
		var $tip = $(this).find('span');
		$tip.css('margin-left', -$tip.width()/2 - 8 + 'px');
	});
	
	$btns.click(function(event){
		event.preventDefault();
		if($wrapper.hasClass('anim')) return;
		
		var $btn = $(this);


		// hightlight this button only

		$btns.find('a.current').removeClass('current');
		$btn.find('a').addClass('current');
		
		if(/\b(normal|vertical|classic)\b/.test($btn.attr('class'))){
			setView(RegExp.$1);
		}
	});

	$wrapper.on('redraw', function(event){
		var curMode = '';
		if(/\b(normal|vertical|classic)\b/.test($container.attr('class'))) curMode = RegExp.$1;
		if(curMode) setView(curMode, true);
	});

	function setView(mode, force){
		if(!force && $container.hasClass(mode)) return;
		var $items = $stream.find('>li');

		if($items.length>100){
			$items.filter(":eq(100)").nextAll().detach();			
		}

		if(!window.Modernizr || !Modernizr.csstransitions ){
			$stream.addClass('loading');
			$wrapper.trigger('before-fadeout');
			$stream.removeClass('loading');
			$wrapper.trigger('before-fadein');
			switchTo(mode);	

			if(mode=='normal'){
				$items.each(function(i,v,a){
					var $li = $(this);
					var $grid_img = $li.find(".figure.grid");
					
					if($li.height()>400){
						$grid_img.css("background-image", "url("+$grid_img.attr("data-ori-url")+")");					
					}else{
						$grid_img.css("background-image", "url("+$grid_img.attr("data-310-url")+")");
					}
				});
			}
			
			$stream.find('>li').css('opacity',1);
			$wrapper.trigger('after-fadein');
			return;
		} 

		$wrapper.trigger('before-fadeout').addClass('anim');
		$stream.addClass('loading');
		var item,
		    $visibles, visibles = [], prevVisibles, thefirst, 
		    offsetTop = $stream.offset().top,
		    hh = $('#header-new').height(),
		    sc = $(window).scrollTop(),
		    wh = $(window).innerHeight(),
			f_right, f_bottom, v_right, v_bottom,
			i, c, v, d, animated = 0;


		// get visible elements

		for(i=0,c=$items.length; i < c; i++){
			item = $items[i];
			if (offsetTop + item.offsetTop + item.offsetHeight < sc + hh) {

				// item.style.visibility = 'hidden';

			} else if (offsetTop + item.offsetTop > sc + wh) {

				// item.style.visibility = 'hidden';

				break;
			} else {
				visibles[visibles.length] = item;
			}
		}
		prevVisibles = visibles;


		// get the first animated element

		for(i=0,c=Math.min(visibles.length,10),thefirst=null; i < c; i++){
			v = visibles[i];
			
			if( !thefirst || (thefirst.offsetLeft > v.offsetLeft) || (thefirst.offsetLeft == v.offsetLeft && thefirst.offsetTop > v.offsetTop) ) {
				thefirst = v;
			}
		}

		if(visibles.length==0) fadeIn();

		// fade out elements using delay based on the distance between each element and the first element.

		for(i=0,c=visibles.length; i < c; i++){
			v = visibles[i];

			d = Math.sqrt(Math.pow((v.offsetLeft - thefirst.offsetLeft),2) + Math.pow(Math.max(v.offsetTop-thefirst.offsetTop,0),2));
			delayOpacity(v, 0, d/5);

			if(i == c -1){
				setTimeout(fadeIn,300+d/5);
			}
		}

		function fadeIn(){
			$wrapper.trigger('before-fadein');

			if($wrapper.hasClass("wait")){
				setTimeout(fadeIn, 50);
				return;
			}

			var i, c, v, thefirst, COL_COUNT, visibles = [], item;
			
			if($items.length !== $stream.get(0).childNodes.length || $items.get(0).parentNode !== $stream.get(0)) $items = $stream.find('>li');
			$stream.height($stream.parent().height());
			
			switchTo(mode);

			if(mode=='normal'){
				$items.each(function(i,v,a){
					var $li = $(this);
					var $grid_img = $li.find(".figure.grid");
					
					if($li.height()>400){
						$grid_img.css("background-image", "url("+$grid_img.attr("data-ori-url")+")");					
					}else{
						$grid_img.css("background-image", "url("+$grid_img.attr("data-310-url")+")");
					}
				});
			}

			$stream.removeClass('loading');
			$wrapper.removeClass('anim');


			// get visible elements

			for(i=0,c=$items.length; i < c; i++){
				item = $items[i];
				if (offsetTop + item.offsetTop + item.offsetHeight < sc + hh) {

					// item.style.visibility = 'hidden';

				} else if (offsetTop + item.offsetTop > sc + wh) {

					// item.style.visibility = 'hidden';

					break;
				} else {
					visibles[visibles.length] = item;
					item.style.opacity = 0;
				}
			}
			
			$wrapper.addClass('anim');

			$(visibles).css({opacity:0,visibility:''});
			COL_COUNT = Math.floor($stream.width()/$(visibles[0]).width());


			// get the first animated element

			for(i=0,c=Math.min(visibles.length,COL_COUNT),thefirst=null; i < c; i++){
				v = visibles[i];
				
				if( !thefirst || (thefirst.offsetLeft > v.offsetLeft) || (thefirst.offsetLeft == v.offsetLeft && thefirst.offsetTop > v.offsetTop) ) {
					thefirst = v;
				}
			}


			// fade in elements using delay based on the distance between each element and the first element.

			if(visibles.length==0) done();
			for(i=0,c=visibles.length; i < c; i++){
				v = visibles[i];

				d = Math.sqrt(Math.pow((v.offsetLeft - thefirst.offsetLeft),2) + Math.pow(Math.max(v.offsetTop-thefirst.offsetTop,0),2));
				delayOpacity(v, 1, d/5);

				if(i == c -1) setTimeout(done, 300+d/5);
			}
		};

		function done(){
			$wrapper.removeClass('anim');
			/*if(prevVisibles && prevVisibles.length) {
				for(var i=0,c=visibles.length; i < c; i++){
					if(visibles[i].style.opacity == '0') visibles[i].style.opacity = 1;
				}
			}*/
			$stream.find('>li').css('opacity',1);
			$wrapper.trigger('after-fadein');
		};
		
		function delayOpacity(element, opacity, interval){
			setTimeout(function(){ element.style.opacity = opacity }, Math.floor(interval));
		};

		
		function switchTo(mode){
			var currentMode = $container.hasClass('vertical')?'vertical':($container.hasClass('classic')?'classic':'normal')
			$container.removeClass('vertical normal classic').addClass(mode);
			if(mode == 'vertical') {
				arrange(true);
				$.infiniteshow.option('prepare',2000);
			} else {
				$stream.css('height','');
				$.infiniteshow.option('prepare',4000);
			}
			if($.browser.msie) $.infiniteshow.option('prepare',1000);
			$.cookie.set('timeline-view',mode,9999);
		};

	};
	var bottoms = [0,0,0,0];
	function arrange(force_refresh){
		var i, c, x, w, h, nh, min, $target, $marker, $first, $img, COL_COUNT, ITEM_WIDTH;

		var ts = new Date().getTime();
		
		$marker = $stream.find('li.page_marker_');
		force_refresh = true;
		if(force_refresh || !$marker.length) {
			force_refresh = true;
			bottoms = [0,0,0,0];
			$target = $stream.children('li');
		} else {
			$target = $marker.nextAll('li');
		}
		if(!$target.length) return;

		$first = $target.eq(0);
		$target.eq(-1).addClass('page_marker_');
		$marker.removeClass('page_marker_');

			
		// ITEM_WIDTH  = parseInt($first.width());
		// COL_COUNT   = Math.floor($stream.width()/ITEM_WIDTH);

		ITEM_WIDTH = 230;
		COL_COUNT = 4;
		
		for(i=0,c=$target.length; i < c; i++){
			min = Math.min.apply(Math, bottoms);			

			for(x=0; x < COL_COUNT; x++) if(bottoms[x] == min) break;


			// $li = $target.eq(i);

			$li = $($target[i]);
			$img = $li.find('.figure.vertical > img');
			if(!(nh = $img.attr('data-calcHeight'))){
				w = +$img.attr('data-width');
				h = +$img.attr('data-height');

				if(w && h) {

					// nh = $img.width()/w * h;

					nh = 210/w * h;
					nh = Math.max(nh,150);
					$img.attr('height', nh).data('calcHeight', nh);
				}else{
					nh = $img.height();
				}
			}

			$li.css({top:bottoms[x], left:x*ITEM_WIDTH});
			bottoms[x] = bottoms[x] + nh + 20;
		}
		
		$stream.height(Math.max.apply(Math, bottoms));	
		
	};
	$wrapper.on('arrange', function(){ arrange(true); });

	$notibar = $('.new-content');
	$notibar.off('click').on('click', function(){
		setTimeout(function(){
		    $.jStorage.deleteKey("fancy.prefetch.stream");
		    $.jStorage.deleteKey("first-featured");
		    $.jStorage.deleteKey("first-all");
		    $.jStorage.deleteKey("first-following");
			$stream.trigger('itemloaded');	

			if( $container.hasClass("normal") ){					
				$stream.find("li").each(function(i,v,a){
					var $li = $(this), src_g;
					var $grid_img = $li.find(".figure.grid");

					if($grid_img.height()>400){
						$grid_img.css("background-image", "url("+$grid_img.attr("data-ori-url")+")");
					}else{
						$grid_img.css("background-image", "url("+$grid_img.attr("data-310-url")+")");
					}
				});
			}		
		},100);
	});


	// feed selection

	var $feedtabs = $('.sorting a[data-feed]');	
	var init_ts = $stream.attr("ts");
	var ttl  = 5 * 60 * 1000;

	$feedtabs.click(function(e){
		var tab = $(e.target).data("feed")||"featured";
		switchTab(tab);
		e.preventDefault();
	});
	function switchTab(tab){
		$.jStorage.deleteKey("fancy.prefetch.stream");
		$feedtabs.removeClass("current");
		var $currentTab = $feedtabs.filter("a[data-feed="+tab+"]").addClass("current");
		$url = $('a.btn-more').hide();
		$win = $(window);

		var result = null;
		$wrapper.addClass("wait");	

		// hide notibar if it showing

		$notibar.hide();
		$stream.attr('ts','').data('feed-url', '/user-stream-updates?new-timeline&feed='+tab);
		var loc = tab;
		var keys = {
			timestamp : 'fancy.home-new.timestamp.'+loc,
			stream  : 'fancy.home-new.stream.'+loc,
			latest  : 'fancy.home-new.latest.'+loc,
			nextURL : 'fancy.home-new.nexturl.'+loc
		};

		if(!(result=$.jStorage.get('first-'+tab))){			
			$.ajax({
				url : '/?new-timeline&feed='+tab,
				dataType : 'html',
				success : function(data, st, xhr) {
					result = data;
					$.jStorage.set('first-'+tab, result, {TTL:5*60*1000});
				},
				error : function(xhr, st, err) {
					url = '';
				},
				complete : function(){
				}
			});
		}

		var swapContent = function(){
			if(!result){
				setTimeout(swapContent,50);
				return;
			}

			if($wrapper.hasClass("swapping")) return;
			$wrapper.addClass("swapping");
			$stream.find(">li").detach();

			$container.removeClass('pattern2 pattern3');			
			if( $container.hasClass("normal") ){
				var patterns = ['','pattern2','pattern3'];
				var pattern = patterns[Math.floor(Math.random()*3)]
				if(pattern){
					$container.addClass(pattern);
				}				
				$stream.find("li").each(function(i,v,a){
					var $li = $(this), src_g;
					var $grid_img = $li.find(".figure.grid");

					if($grid_img.height()>400){
						$grid_img.css("background-image", "url("+$grid_img.attr("data-ori-url")+")");
					}else{
						$grid_img.css("background-image", "url("+$grid_img.attr("data-310-url")+")");
					}
				});
			}

			var $sandbox = $('<div>'),
		    $contentBox = $('#content ol.stream'),
			$next, $rows;

			$sandbox[0].innerHTML = result.replace(/^[\s\S]+<body.+?>|<((?:no)?script|header|nav)[\s\S]+?<\/\1>|<\/body>[\s\S]+$/ig, '');
			$next = $sandbox.find('a.btn-more');
			$rows = $sandbox.find('#content ol.stream > li');
			
			$contentBox.append($rows);
			if(window.Modernizr && Modernizr.csstransitions )	$rows.css('opacity',0);

			$stream.trigger('itemloaded');

			if (tab!="suggestions" && $next.length) {
				url = $next.attr('href');
				$url.attr({
					'href' : $next.attr('href'),
					'ts'   : $next.attr('ts')
				});
				$stream.attr("ts",$currentTab.data("ts")||init_ts);
				$(window).trigger("prefetch.infiniteshow");
			} else {
				url = ''
				$url.attr({
					'href' : '',
					'ts'   : ''
				});
			}
			
			slideshow_request_url = '/home_slideshow.json?new-timeline&feed='+tab;
			Fancy.slideshow.reset();

			$wrapper.removeClass("wait");
			$wrapper.removeClass("swapping");
		}

		var done = function(){
			setTimeout(function(){$('#content ol.stream > li').css('opacity',1)},500);
		}

		$stream.trigger("changeloc");
		$wrapper.off('before-fadein').on('before-fadein', swapContent);
		$wrapper.off('after-fadein').on('after-fadein', done);				
		$wrapper.trigger("redraw");
		$.cookie.set('timeline-feed',tab,9999);
	}

	$stream.on('changeloc',function(){
		$stream.attr("loc", ($feedtabs.filter(".current").attr("data-feed")||"featured") );
	})

	if("vertical"=="classic"){
		$wrapper.trigger("arrange");		
	}
	$(window).trigger("prefetch.infiniteshow");

	$stream.delegate('.figure-item',"mouseover",function(){
		if ($(this).parents('.timeline').hasClass('classic')==true) {
			$(this).find('.figure.classic .back')
				.width($(this).find('.figure.classic img').width())
				.height($(this).find('.figure.classic img').height())
				.css('margin-left',-($(this).find('.figure.classic img').width()/2)+'px')
				.css('margin-top',-($(this).find('.figure.classic img').height()/2)+'px')
				.css('left','50%')
				.css('top','50%')
			.end();
			$(this).find('.price').css('margin-top',($(this).find('.figure.classic').height()-$(this).find('.figure.classic img').height())/2+'px').css('margin-left',($(this).find('.figure.classic').width()-$(this).find('.figure.classic img').width())/2+'px');
			$(this).find('.share').css('margin-top',($(this).find('.figure.classic').height()-$(this).find('.figure.classic img').height())/2+'px').css('margin-right',($(this).find('.figure.classic').width()-$(this).find('.figure.classic img').width())/2+'px');
		}else{
			$(this).find('.figure.classic .back').removeAttr('style').end()
			.find('.price').removeAttr('style').end()
			.find('.figure.classic .share').removeAttr('style');
		}
	});
})();
</script>

<script>
/*        $.infiniteshow({
            itemSelector:'#content ol.stream > li',
            streamSelector:'#content ol.stream',
            dataKey:'home-new',
            post_callback: function($items){ $('ol.stream').trigger('itemloaded') },
            prefetch:true,
            
            newtimeline:true
        })
        if($.browser.msie) $.infiniteshow.option('prepare',1000);*/
    </script>