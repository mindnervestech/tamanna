						<aside class="col-lg-3 col-md-3 col-sm-3 m_xs_bottom_30 p_top_4">
							<!--categories widget-->
							<section class="m_bottom_30">
								<h5 class="color_dark tt_uppercase second_font fw_light m_bottom_13">Account</h5>
								<hr class="divider_bg m_bottom_23">
								<ul class="categories_list second_font w_break">
									<li class="relative"><a href="settings" class="fs_large_0 d_inline_b">Profile Settings</a>
									</li>
									<li class="relative"><a href="user/<?php echo $userDetails->row()->user_name;?>" class="<?php if ($this->uri->segment(2)=='password'){?>current<?php }?> fs_large_0 d_inline_b">My Wishlist</a>
									</li>
									<li class="relative"><a href="settings/password" class="<?php if ($this->uri->segment(2)=='password'){?>current<?php }?> fs_large_0 d_inline_b">Password</a>
									</li>
									<li class="relative"><a href="purchases"  class="<?php if ($this->uri->segment(1)=='purchases'){?>current<?php }?> fs_large_0 d_inline_b">Purchases</a>
									</li>
									<li class="relative"><a href="settings/shipping"  class="<?php if ($this->uri->segment(2)=='shipping'){?>current<?php }?> fs_large_0 d_inline_b">Shipping Address</a>
									</li>
									<?php if ($userDetails->row()->group == 'Seller'){?>
										<li class="relative"><a href="orders"  class="<?php if ($this->uri->segment(1)=='orders'){?>current<?php }?> fs_large_0 d_inline_b">Orders</a>
										</li>
										<li class="relative"><a href="add-thing"  class="<?php if ($this->uri->segment(1)=='orders'){?>current<?php }?> fs_large_0 d_inline_b">Add Products</a>
										</li>
										<li class="relative"><a href="user/<?php echo $userDetails->row()->user_name;?>/added"  class="<?php if ($this->uri->segment(2)=='shipping'){?>current<?php }?> fs_large_0 d_inline_b">View Your Profile</a>
										</li>
									<?php }?>
								</ul>
							</section>
						</aside>