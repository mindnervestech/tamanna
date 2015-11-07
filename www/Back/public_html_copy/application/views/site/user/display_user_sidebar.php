<aside id="sidebar">
        <div class="wrapper user-cover">
        <?php 
        $userImg = 'user-thumb1.png';
        if ($userProfileDetails->row()->thumbnail != ''){
	        $userImg = $userProfileDetails->row()->thumbnail;
        } 
        $followClass = 'follow';
        if ($loginCheck != ''){
	        $followingListArr = explode(',', $userDetails->row()->following);
	        if (in_array($userProfileDetails->row()->id, $followingListArr)){
	        	$followClass = 'following';
	        }
        } 
        ?>
          <div class="profile"> 
          <span class="avatar">
          <span id="user-photo-container">
          <img src="images/users/<?php echo $userImg;?>" />
          <?php if ($loginCheck != '' && $userDetails->row()->id == $userProfileDetails->row()->id){?>
           	<a title="<?php if($this->lang->line('display_edit_img') != '') { echo stripslashes($this->lang->line('display_edit_img')); } else echo "Edit Profile Image"; ?>" style="display: none;" class="btn-edit tooltip" onclick="$.dialog('change-photo').open();return false;" href="#">
          	<i class="icon-pen"></i>

          	<span><?php if($this->lang->line('display_edit_img') != '') { echo stripslashes($this->lang->line('display_edit_img')); } else echo "Edit Profile Image"; ?><b></b></span>
          	</a>
          <?php }?>	
          </span>
          </span>
          <?php 
          $web_url = $userProfileDetails->row()->web_url;
          if (substr($web_url, 0,4)!='http') $web_url = 'http://'.$web_url;
          ?>
            <p class="username"><?php echo $userProfileDetails->row()->full_name;?></p>
         <!--   <p class="location"><?php echo $userProfileDetails->row()->location;?>&nbsp;.&nbsp;<a href="<?php echo $web_url;?>" target="_blank"><?php echo $userProfileDetails->row()->web_url;?></a></p> -->
            <p class="bio"><?php if ($userProfileDetails->row()->about != '') {echo $userProfileDetails->row()->about;} else {echo $userProfileDetails->row()->brand_description;}?></p>
          </div>
          <ul class="sns-list">
          <?php 
          $fb_link = $userProfileDetails->row()->facebook;
          if (substr($fb_link, 0,4)!='http') $fb_link='http://'.$fb_link;
          $tw_link = $userProfileDetails->row()->twitter;
          if (substr($tw_link, 0,4)!='http') $tw_link='http://'.$tw_link;
          $go_link = $userProfileDetails->row()->google;
          if (substr($go_link, 0,4)!='http') $go_link='http://'.$go_link;
          ?>
<?php  if ($userProfileDetails->row()->facebook !=''){ ?>
            <li><a href="<?php echo $fb_link;?>" target="_blank"><span class="icon-facebook-rect"></span> Facebook</a></li>
<?php } ?>
<?php  if ($userProfileDetails->row()->twitter!=''){ ?>
            <li><a href="<?php echo $tw_link;?>" target="_blank"><span class="icon-twitter-squared"></span> Twitter</a></li>
<?php } ?>
<?php  if ($userProfileDetails->row()->google!=''){ ?>
            <li><a href="<?php echo $go_link;?>" target="_blank"><span class="icon-googleplus-rect"></span> Google Plus</a></li>
<?php } ?>
          </ul>
          <ul class="followers">
            <li><a href="user/<?php echo $userProfileDetails->row()->user_name;?>/followers" ><b><?php echo $userProfileDetails->row()->followers_count;?></b> <small><?php if($this->lang->line('display_followers') != '') { echo stripslashes($this->lang->line('display_followers')); } else echo "Followers"; ?></small></a></li>
            <li><a href="user/<?php echo $userProfileDetails->row()->user_name;?>/following" ><b><?php echo $userProfileDetails->row()->following_count;?></b> <small><?php if($this->lang->line('display_following') != '') { echo stripslashes($this->lang->line('display_following')); } else echo "Following"; ?></small></a></li>
          </ul>
          <div class="user-control">
          <?php if ($loginCheck == $userProfileDetails->row()->id){?>
            <div class="relation"> <a href="settings" class="edit-profile btn"><span class="icon-edit"></span><?php if($this->lang->line('display_edit_prof') != '') { echo stripslashes($this->lang->line('display_edit_prof')); } else echo "Edit Profile"; ?></a> </div>
          <?php }else {?>
            <div class="relation"> <a href="#" uid="<?php echo $userProfileDetails->row()->id;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?> class="follow-user-link follow-link <?php echo $followClass;?>"><i class="icon"></i><?php if($this->lang->line('onboarding_follow') != '') { echo stripslashes($this->lang->line('onboarding_follow')); } else echo "Follow"; ?></a> </div>
          <?php }?>
            <div class="setting">
              <div class="trick" onClick="$(this).parents('.setting').removeClass('opened');"></div>
              <a href="#" class="btns-gray-embo btn-setting" onClick="$(this).parents('.setting').toggleClass('opened');return false;"><i class="icon-forward-outline"></i></a>
              <div class="menu-content">
                <ul>
                   <li><a href="<?php echo base_url();?>site/feed/user/<?php echo $userProfileDetails->row()->user_name;?>" target="_blank"><?php if($this->lang->line('display_rss_feed') != '') { echo stripslashes($this->lang->line('display_rss_feed')); } else echo "RSS Feed"; ?></a></li>
                   <li><a href="<?php echo base_url();?>user/<?php echo $userProfileDetails->row()->user_name;?>" username="<?php echo $userProfileDetails->row()->user_name;?>" txt="Check out <?php echo $userProfileDetails->row()->full_name;?>'s profile!" <?php if ($loginCheck == ''){?>require_login="true"<?php }?> class="btn-user-share"><?php if($this->lang->line('display_share_prof') != '') { echo stripslashes($this->lang->line('display_share_prof')); } else echo "Share Profile"; ?></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <?php 
        if ($recentActivityDetails->num_rows()>0){
        ?>
        <div class="wrapper activity">
          <h3 class="stit"><?php if($this->lang->line('display_recent_act') != '') { echo stripslashes($this->lang->line('display_recent_act')); } else echo "Recent Activity"; ?></h3>
          <ul class="activity-list">
          <?php 
          foreach ($recentActivityDetails->result() as $recentActivityDetailsRow){
          	$activityTime = strtotime($recentActivityDetailsRow->activity_time);
 //         	$actTime = humanTiming($activityTime) . " ago" ;
 			$actTime = timespan($activityTime).' ago';
          	if ($recentActivityDetailsRow->activity_name == 'fancy'){
          		$icon = 'icon-heart-2';
          		$actTxt = LIKED_BUTTON;
          		if ($recentActivityDetailsRow->product_name != ''){
	          		$link = 'things/'.$recentActivityDetailsRow->productID.'/'.url_title($recentActivityDetailsRow->product_name);
	          		$linkTxt = $recentActivityDetailsRow->product_name;
          		}else {
	          		$link = 'user/'.$userProfileDetails->row()->user_name.'/things/'.$recentActivityDetailsRow->activity_id.'/'.url_title($recentActivityDetailsRow->user_product_name);
	          		$linkTxt = $recentActivityDetailsRow->user_product_name;
          		}
          	}else if ($recentActivityDetailsRow->activity_name == 'unfancy'){
          		$icon = 'ion-heart-2';
          		$actTxt = UNLIKE_BUTTON;
          		if ($recentActivityDetailsRow->product_name != ''){
	          		$link = 'things/'.$recentActivityDetailsRow->productID.'/'.url_title($recentActivityDetailsRow->product_name);
	          		$linkTxt = $recentActivityDetailsRow->product_name;
          		}else {
	          		$link = 'user/'.$userProfileDetails->row()->user_name.'/things/'.$recentActivityDetailsRow->activity_id.'/'.url_title($recentActivityDetailsRow->user_product_name);
	          		$linkTxt = $recentActivityDetailsRow->user_product_name;
          		}
          	}else if ($recentActivityDetailsRow->activity_name == 'follow'){
          		$icon = 'icon-plus-outline';
          		$actTxt = 'Followed';
          		if ($recentActivityDetailsRow->user_name == ''){
    	      		$link = 'user/administrator';
	          		$linkTxt = 'administrator';
          		}else {
    	      		$link = 'user/'.$recentActivityDetailsRow->user_name;
	          		$linkTxt = $recentActivityDetailsRow->full_name;
          		}
          	}else if ($recentActivityDetailsRow->activity_name == 'unfollow'){
          		$icon = 'icon-plus-outline';
          		$actTxt = 'Unfollowed';
          		if ($recentActivityDetailsRow->user_name == ''){
    	      		$link = 'user/administrator';
	          		$linkTxt = 'administrator';
          		}else {
    	      		$link = 'user/'.$recentActivityDetailsRow->user_name;
	          		$linkTxt = $recentActivityDetailsRow->full_name;
          		}
          	}
          ?>
            <li><span class="<?php echo $icon;?>"></span> <?php echo $actTxt;?> <a href="<?php echo $link;?>"><?php echo $linkTxt;?></a>.<small class="time"><?php echo $actTime;?></small></li>
          <?php 
          }
          ?>
          </ul>
        </div>
        <?php }?>
      </aside>