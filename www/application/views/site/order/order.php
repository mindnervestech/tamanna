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

				<div id="content" style="padding:0px 20px 20px 20px;">
					<ol class="cart-order-depth">
					  <li class="depth1" style="display:none;"><span>1</span><?php if($this->lang->line('cart_shop_cart') != '') { echo stripslashes($this->lang->line('cart_shop_cart')); } else echo "Shopping Cart"; ?></li>
					  <li class="depth2" style="display:none;"><span>2</span><?php if($this->lang->line('cart_pay_mthd') != '') { echo stripslashes($this->lang->line('cart_pay_mthd')); } else echo "Payment Method"; ?></li>
					  <li class="depth3 current" style="display:none;"><span>3</span><?php if($this->lang->line('cart_ord_confirm') != '') { echo stripslashes($this->lang->line('cart_ord_confirm')); } else echo "Order Confirmation"; ?></li>
					</ol>
					<div class="cart-list chept2">
						<h2 style="display:none;"><?php if($this->lang->line('cart_ord_confirm') != '') { echo stripslashes($this->lang->line('cart_ord_confirm')); } else echo "Order Confirmation"; ?></h2>
						<?php if($Confirmation =='Success'){ ?>
						<div class="cart-payment-wrap card-payment new-card-payment">
							<h3 class="second_font color_dark tt_uppercase fw_light m_bottom_23 t_align_c"><?php if($this->lang->line('order_tran_sucss') != '') { echo stripslashes($this->lang->line('order_tran_sucss')); } else echo "Your Transaction Success"; ?></h3>
							<!--    <div class="payment_success"><img src="images/site/success_payment.png" /></div> -->
							<?php
							$this->output->set_header('refresh:5;url='.base_url().'purchases'); 
							 }elseif($Confirmation =='Failure'){ ?>        
           					<div class="cart-payment-wrap card-payment new-card-payment">
								<h3 style="color:#ec1e20;" class="second_font color_dark tt_uppercase fw_light m_bottom_23 t_align_c"><?php if($this->lang->line('order_tran_failure') != '') { echo stripslashes($this->lang->line('order_tran_failure')); } else echo "Your payment was not successful. We recommend that you try again with a different payment method."; ?></h3>
								<div class="payment_success"><h5 class="second_font color_dark tt_uppercase fw_light m_bottom_23 t_align_c">Reason: <?php echo urldecode($errors); ?></h5></div>
									<img src="/images/ajax-loader/ajax-loader(6).gif" style="padding-top:20px;width:50%;margin-left:auto;margin-right:auto;display: block;" />
									<!--  <div class="payment_success"><img src="images/site/failure_payment.png" /></div> -->
							</div>
							<?php
							 $this->output->set_header('refresh:5;url='.base_url().'cart'); 
							 } 
							 
							 if($this->uri->segment(3) == 'subscribe'){
								$this->output->set_header('refresh:5;url='.base_url().'fancyybox/manage'); 
							 }elseif($this->uri->segment(3) == 'gift'){
								$this->output->set_header('refresh:5;url='.base_url().'settings/giftcards'); 
							 }elseif($this->uri->segment(3) == 'cart'){
								$this->output->set_header('refresh:5;url='.base_url().'purchases'); 
							 }
							?>
						</div>
					</div>
				<!-- / content -->
				</div>
			
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