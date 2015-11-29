<?php
$this->load->view('site/templates/header');
?>
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
	<div id="container-wrapper" style="padding-bottom:500px; padding-top:100px;">
		<div class="container timeline <?php echo $viewhome; ?>">
			<div class="wrapper-content landing_page">
				 <div class="top-menu">
					<!-- script to hide everything dropdown when clicking outside -->
					<div class="welcome" style="margin-top: 0;margin-bottom:40px;padding-top:40px;font-size:24px;"><h3>Add Products</h3></div>
						<div class="step1" style="  margin-left: 32%;">
							<ul class="case <?php echo $force_login;?>" style="  margin-bottom: 70px;overflow:hidden">
								<li style="width: 220px;"><a href="add" class="mn-add-web"><span class="icon-upload-cloud"></span> Add from Web</a></li> 
								<li style="width: 220px;"><a href="add" class="mn-add-upload" ><span class="icon-laptop"></span>Upload from Computer</a></li>
							</ul>
						</div>
				 </div>
			</div>
		</div>
	</div>
		<?php
		$this->load->view('site/templates/sub_footer');
		$this->load->view('site/templates/footer_menu');
		?>
</section>

