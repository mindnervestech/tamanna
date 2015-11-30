<div id="sidebar">
			<dl class="set_menu">
				<dt><?php if($this->lang->line('referrals_account') != '') { echo stripslashes($this->lang->line('referrals_account')); } else echo "ACCOUNT"; ?></dt>
				<dd><a href="settings" <?php if ($this->uri->segment(1)=='settings' && $this->uri->segment(2)==''){?>class="current"<?php }?>><i class="icon-user-outline"></i> <?php if($this->lang->line('referrals_profile') != '') { echo stripslashes($this->lang->line('referrals_profile')); } else echo "Profile"; ?></a></dd>
	            <dd><a href="settings/preferences" <?php if ($this->uri->segment(2)=='preferences'){?>class="current"<?php }?>><i class="icon-clipboard"></i> <?php if($this->lang->line('referrals_preference') != '') { echo stripslashes($this->lang->line('referrals_preference')); } else echo "Preferences"; ?></a></dd>
				<dd><a href="settings/password" <?php if ($this->uri->segment(2)=='password'){?>class="current"<?php }?>><i class="icon-key-outline"></i> <?php if($this->lang->line('signup_password') != '') { echo stripslashes($this->lang->line('signup_password')); } else echo "Password"; ?></a></dd>
				<dd><a href="settings/notifications" <?php if ($this->uri->segment(2)=='notifications'){?>class="current"<?php }?>><i class="icon-flash-outline"></i> <?php if($this->lang->line('referrals_notification') != '') { echo stripslashes($this->lang->line('referrals_notification')); } else echo "Notifications"; ?></a></dd>
			</dl>
			<dl class="set_menu">
				<dt><?php if($this->lang->line('referrals_shop') != '') { echo stripslashes($this->lang->line('referrals_shop')); } else echo "SHOP"; ?></dt>
	            <dd><a href="purchases" <?php if ($this->uri->segment(1)=='purchases'){?>class="current"<?php }?>><i class="icon-briefcase-1"></i> <?php if($this->lang->line('referrals_purchase') != '') { echo stripslashes($this->lang->line('referrals_purchase')); } else echo "Purchases"; ?></a></dd>
	            <?php if ($userDetails->row()->group == 'Seller'){?>
	            <dd><a href="orders" <?php if ($this->uri->segment(1)=='orders'){?>class="current"<?php }?>><i class="icon-box"></i> <?php if($this->lang->line('referrals_orders') != '') { echo stripslashes($this->lang->line('referrals_orders')); } else echo "Orders"; ?></a></dd>
	            <?php }?>
	            <?php if ($userDetails->row()->group == 'Seller'){?>
 	            <dd><a href="credits" <?php if ($this->uri->segment(1)=='credits'){?>class="current"<?php }?>><i class="icon-credit-card"></i> <?php if($this->lang->line('earnings') != '') { echo stripslashes($this->lang->line('earnings')); } else echo "Earnings"; ?></a></dd>
 	            <?php }?>
	          <!--  <dd><a href="fancyybox/manage" <?php if ($this->uri->segment(1)=='fancyybox'){?>class="current"<?php }?>><i class="ic-sub"></i> <?php if($this->lang->line('referrals_subscribe') != '') { echo stripslashes($this->lang->line('referrals_subscribe')); } else echo "Subscriptions"; ?></a></dd>-->
	            <dd><a href="settings/shipping" <?php if ($this->uri->segment(2)=='shipping'){?>class="current"<?php }?>><i class="icon-plane-outline"></i> <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping Address"; ?></a></dd>
	        </dl>
			<dl class="set_menu">
				<dt><?php if($this->lang->line('referrals_sharing') != '') { echo stripslashes($this->lang->line('referrals_sharing')); } else echo "SHARING"; ?></dt>
<?php 
if ($this->config->item('giftcard_status') == 'Enable'){
?> 
				<dd><a href="settings/giftcards" <?php if ($this->uri->segment(2)=='giftcards'){?>class="current"<?php }?>><i class="icon-gift"></i> <?php if($this->lang->line('referrals_giftcard') != '') { echo stripslashes($this->lang->line('referrals_giftcard')); } else echo "Gift Card"; ?></a></dd>
				<?php }
				if ($userDetails->row()->group == 'Seller'){?>
	            <dd><a href="<?php echo base_url();?>site/feed/store/<?php echo $userDetails->row()->user_name;?>" target="_blank"><i class="icon-rss-outline"></i> <?php if($this->lang->line('referrals_feedurl') != '') { echo stripslashes($this->lang->line('referrals_feedurl')); } else echo "Store Feed URL"; ?></a></dd>
	            <?php }?>
	        </dl>
		</div>
<?php if ($userDetails->row()->group == 'Seller'){?>
<div id="sidebar" style="margin-top: 10px;">
  <dl class="set_menu">
    <dt>Seller's Tool-kit</dt>
        <dd><a href="/pages/fee-structure" target="_blank"><i class="icon-info"></i> Fee Structure</a></dd>
        <dd><a href="/pages/how-to-set-up-store-on-socktail" target="_blank"><i class="icon-shop"></i> Setup your store</a></dd>
        <dd><a href="/pages/how-to-upload-products"  target="_blank"><i class="icon-upload-outline"></i> Upload Products</a></dd>
        <dd><a href="/pages/how-to-promote-your-store" target="_blank"><i class="icon-flash-outline"></i> Promote your store</a></dd>
  </dl>
</div>
<?php }?>