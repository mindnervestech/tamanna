<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			
            
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>						
					</div>
					<div class="widget_content">
                        <div class="grid_6">
                        <div class="widget_wrap">
                            <div class="widget_top">
                                <span></span>
                                <h6>Sitemap creation successful</h6>
                            </div>
                            <div class="widget_content">
                                <div class="user_list">
	                                <div class="user_block">
		              <!--                  <?php
		                                $dir = "sitemapgenerate";
										$dh  = opendir($dir);
										while (false !== ($filename = readdir($dh))) {
										    $files[] = $filename;
										}
										sort($files);
										for($i=0; $i< (count($files)-2); $i++){ ?> -->
											<!--<p>Successful: Sitemap successfuly created and saved to <a href="sitemapgenerate/<?php echo $files[$i+2]; ?>" target="_blank"><?php echo $files[$i+2]; ?>!</a></p>-->
<!--<p>Successful: Sitemap successfuly created and saved to <a href="<?php echo $files[$i+2]; ?>" target="_blank"><?php echo $files[$i+2]; ?>!</a></p>
								<?php   }?> -->
<p>Successful: Sitemap successfuly created and saved to <a href="sitemap.xml" target="_blank">sitemap1.xml!</a></p>
		                     
                                	</div>
                                	<br />
                           <!--     	<div class="user_block">
                                		<p>Zip file is generated, you can download it by clicking <a href="sitemapgenerate_zip/sitemapZip.zip" target="_blank">Here!</a></p>
                                	</div>	
                                	<div class="user_block">
                                		<?php
                                		 foreach(glob('sitemapgenerate_Gzip/*.xml.gz') as $filename){ ?>
											<p>GZip file is generated, you can download it by clicking <a href="<?php echo $filename; ?>" target="_blank"><?php echo str_replace("sitemapgenerate_Gzip/", "" , $filename); ?>!</a></p>
										<?php   }?>
								    </div>	-->
                                </div>
                            </div>
                        </div>
                    </div>
					</div>
				</div>
			</div>
			
		
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>