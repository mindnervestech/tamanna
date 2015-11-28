<?php
$this->load->view('site/templates/header_new_small');
?>
<!--main content-->
<div class="page_section_offset">
	<div class="container">
		<div class="row">
			<aside class="col-lg-2 col-md-2 col-sm-2 p_top_4">
			</aside>
			<section class="col-lg-8 col-md-8 col-sm-8">
				<?php if($flash_data != '') { ?>
				<div class="errorContainer" id="<?php echo $flash_data_type;?>"> 
				  <script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
				  <p><span><?php echo $flash_data;?></span></p>
				</div>
				<?php } ?>
				<div class="wrapper-content order" >
				  <div id="content" style="padding:0px 20px 20px 20px;">
					<div class="cart-list chept2">
					  <?php if($this->uri->segment(2)=='cart' || $this->uri->segment(2)=='gift'){ ?>
					  <ol class="cart-order-depth" style="position:relative;">
						<?php 
						$payMethodCount = 1;
						?>
						<?php if ($paypal_ipn_settings['status'] == 'Enable'){?>
						<li class="depth1 current" id="dep1" style="background:none;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:paypal();" class="current">
						  <?php if($this->lang->line('checkout_paypal') != '') { echo stripslashes($this->lang->line('checkout_paypal')); } else echo "Paypal"; ?>
						  </a>
						</li>
						<?php 
						$payMethodCount++;
						}
						if ($authorize_net_settings['status'] == 'Enable'){
						?>
						<li class="depth2" id="dep2" style="background:none;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:creditcard();">
						  <?php if($this->lang->line('checkout_credit_card') != '') { echo stripslashes($this->lang->line('checkout_credit_card')); } else echo "Credit Card"; ?>
						  </a>
						</li>
						<?php 
						}else if ($paypal_credit_card_settings['status'] == 'Enable'){
						?>
						<li class="depth2" id="dep2" style="background:none;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:creditcard();">
						  <?php if($this->lang->line('checkout_credit_card') != '') { echo stripslashes($this->lang->line('checkout_credit_card')); } else echo "Credit Card"; ?>
						  </a>
						</li>
						<?php 
						}
						?>
						<!-- 	      <li class="depth3" id="dep3" style="width:150px;"><span>3</span><a onclick="javascript:othermethods();">Other Methods</a></li>
						-->
					  </ol>
						<?php } ?>
						<div class="clear"></div>
						<?php $paypalProcess = unserialize($paypal_ipn_settings['settings']); 
							if($this->uri->segment(2)=='cart'){
							$checkAmt = @explode('|',$checkoutViewResults);
								if($checkAmt[3] > 0){
						?>
						<!--NEW PAYMENT CODE-->
						<div class="cart-payment-wrap card-payment new-card-payment" id="otherPay" style="display:<?php if ($paypal_ipn_settings['status'] == 'Enable' || $authorize_net_settings['status'] == 'Enable'){echo 'none';}else {echo 'block';}?>;">
							<script type='text/javascript'>setInterval( "autosubmit()", 3000 );function autosubmit(){ 
							$("#transactionForm").submit();
							}</script>
							<form name="TransactionForm" id="transactionForm"  method="post"  action="<?php echo $ABC['url'];?><?php //echo base_url()."checkout/Suc";?>"  >
									<input name="merchantTxnId" type="hidden" value="<?php echo $ABC['merchantTxnId']; ?>" />
									<input name="orderAmount" value="<?php echo number_format($checkAmt[3],2,'.',''); ?>" type="hidden" />
									<input type="hidden" name="currency" value="<?php echo $ABC['currency'];?>" />
									<input type="hidden" name="secSignature" value="<?php echo $ABC['secSignature'];?>" />
									<input name="returnUrl" type="hidden" value="<?php echo $ABC['returnUrl'];?>" />
									<input type="hidden" name="shipping_id" id="shipping_id" value="<?php echo $checkAmt[6]; ?>" />
									<input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
									<input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $paypalProcess['mode']; ?>"  />
									<input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $paypalProcess['merchant_email']; ?>"  />                        
									<div id="complete-payment">
										<div class="hotel-booking-left" >
											<!--	<img src="http://sandbox.citruspay.com/images/logo.png"/> -->
											<div>
												<h3 class="second_font color_dark tt_uppercase fw_light m_bottom_23 t_align_c">Redirecting to our payment partner's site</h3>
												<h5 class="second_font color_dark tt_uppercase fw_light m_bottom_23 t_align_c">Please Wait for a second!!.....<h5>
												<img src="/images/ajax-loader/ajax-loader(6).gif" style="padding-top:20px;width:50%;margin-left:auto;margin-right:auto;display: block;" /></br>
											</div>
											<!--<p style="font-size:17px;margin-top:25px;">" <?php if($this->lang->line('checkout_req_merchang') != '') { echo stripslashes($this->lang->line('checkout_req_merchang')); } else echo "Will be configured on request during setup of the script . Requires merchant account creation and customization"; ?> "</p>-->
										</div>
										<div class="cart-payment">
											<dl class="cart-payment-order">
												<dt style="display:none;"><?php if($this->lang->line('checkout_order') != '') { echo stripslashes($this->lang->line('checkout_order')); } else echo "Order"; ?></dt>
													<dd>
														<ul>
															<li class="first" style="display:none;">>
																<span class="order-payment-type"><?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?></span>
																<span class="order-payment-usd1"><b><?php echo $currencySymbol;?><?php echo number_format($checkAmt[0],2,'.',''); ?></b> <?php echo $currencyType;?></span>
															</li>
															<li style="display:none;">>
																<span class="order-payment-type"><?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?></span>
																<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkAmt[1],2,'.',''); ?></b> <?php echo $currencyType;?></span>
															</li>
															<li style="display:none;">>
																<span class="order-payment-type"><?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?></span>
																<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkAmt[2],2,'.',''); ?></b> <?php echo $currencyType;?></span>
															</li>
															<?php if($checkAmt[5] > 0){ ?>
															<li style="display:none;">>
																<span class="order-payment-type"><?php if($this->lang->line('checkout_discount') != '') { echo stripslashes($this->lang->line('checkout_discount')); } else echo "Discount"; ?></span>
																<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkAmt[5],2,'.',''); ?></b> <?php echo $currencyType;?></span>
															</li>
															<?php }else{ } ?>
															<li class="total" style="display:none;">>
																<span class="order-payment-type"><b><?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?></b></span>
																<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkAmt[3],2,'.',''); ?></b> <?php echo $currencyType;?></span>
															</li>
														</ul>
													</dd>
												</dt>
											</dl>
										</div>
										<?php if ($authorize_net_settings['status'] == 'Enable'){ ?>
										<input type="hidden" name="creditvalue" id="creditvalue" value="authorize" />
										<?php }elseif($paypal_credit_card_settings['status'] == 'Enable'){ ?>
										<input type="hidden" name="creditvalue" id="creditvalue" value="paypaldodirect" />
										<?php } ?>
										<!--<input name="submit"  class="button-complete" type="submit" value="Continue Payment" style="cursor:pointer;"  />-->
										<div class="waiting" style="display:none;">><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>
										<div class="card-payment-foot" style="display:none;">><?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?> &amp; <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>.</div>
									</div> 
							</form>
						</div>
						<?php }}?>
					</div>
				</div>
  <!-- / content --> 
  
  <!-- / container --> 
			</div>
<!-- / wrapper-content -->
		</section>
						<aside class="col-lg-2 col-md-2 col-sm-2 p_top_2">
						</aside>
					</div>
				</div>
			</div>
			<!--footer-->
				<?php
					$this->load->view('site/templates/footer');
				?>
		</div>

		<!--back to top-->
		<button class="back_to_top animated button_type_6 grey state_2 d_block black_hover f_left vc_child tr_all"><i class="fa fa-angle-up d_inline_m"></i></button>

		<!--libs include-->
		<script src="plugins/jquery.appear.js"></script>
		<script src="plugins/owl-carousel/owl.carousel.min.js"></script>
		<script src="plugins/afterresize.min.js"></script>
		<script src="plugins/jackbox/js/jackbox-packed.min.js"></script>
		<script src="js/retina.min.js"></script>
		<script src="plugins/colorpicker/colorpicker.js"></script>
		 

		<!--theme initializer-->
		<script src="js/themeCore.js"></script>
		<script src="js/theme.js"></script>
	</body>
</html>