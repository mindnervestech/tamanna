<?php
$this->load->view('site/templates/header',$this->data);
?>
<style type="text/css" media="screen">
#edit-details {
    color: #FF3333;
    font-size: 11px;
}
.option-area select.option {
    border: 1px solid #D1D3D9;
    border-radius: 3px 3px 3px 3px;
    box-shadow: 1px 1px 1px #EEEEEE;
    height: 22px;
    margin: 5px 0 12px;
}
a.selectBox.option {
    margin: 5px 0 10px;
    padding: 3px 0;
}
a.selectBox.option .selectBox-label {
    font: inherit !important;
    padding-left: 10px;
}
</style>
<div id="container-wrapper">
	<div class="container ">
		<div id="content">
			<?php if($flash_data != '') { ?>
				<div class="errorContainer" id="<?php echo $flash_data_type;?>">
					<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
					<p><span><?php echo $flash_data;?></span></p>
				</div>
			<?php } ?>
			<section class="merchant">
				<form action="site/user/custom_request_submit" method="post" id="seller_signup" onsubmit="return validateSellerSignup();">
					<div class="error-box" style="display:none;">
						<p><?php if($this->lang->line('seller_some_requi') != '') { echo stripslashes($this->lang->line('seller_some_requi')); } else echo "Some required information is missing or incomplete. Please correct your entries and try again"; ?>.</p>
						<ul></ul>
					</div>
				<dl>
					<dt><?php echo "Customization Request"; ?></dt>
                    <dd>
						
                    </dd>
                    <dd>
						<label for="" class="label"><?php echo "Project Name"; ?><sup style="color: red;">*</sup></label>
                                               <input type="text" name="project_name" id="project_name" />
                    </dd>
					<dd><label for="" class="label"><?php echo "Specify the Size"; ?></label>
						<input type="text" name="size" id="size" style="margin-bottom: 10px;"/>
                    </dd>
					<dd><label for="" class="label"><?php echo "Specify the Color"; ?></label>
						<input type="text" name="color" id="color"/>
                    </dd>
					<dd><label for="" class="label"><?php echo "Specify the Material"; ?></label>
						<input type="text" name="material" id="material"/>
                    </dd>
					<dd><label for="" class="label"><?php echo "Specify Requirements"; ?><sup style="color: red;">*</sup></label>
						<input type="text" name="project_description" id="project_description" style="height:100px;"/>
					</dd>
                    <dd><label for="" class="label"><?php echo "City"; ?></label>
						<input type="text" name="city" id="city"/>
                    </dd>
                	<dd><label for="" class="label"><?php echo "Your Phone Number"; ?><sup style="color: red;">*</sup></label>
						<input type="text" name="phone_no" id="phone_no" />
					</dd>
					<dd><label for="" class="label"><?php echo "Your Email ID"; ?><sup style="color: red;">*</sup></label>
						<input type="text" name="email" id="email" />
					</dd>
                </dl>
				<div class="btn-area">
					<button class="btn-green" id="sign-up" re-url="/sales/create?ntid=7220865&amp;ntoid=15301425" ><?php echo "Submit Request"; ?></button>
				</div>
				</form>
			</section>
			<hr />
		</div>
		<a href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>
	</div>
	<!-- / container -->
	<?php 
     $this->load->view('site/templates/footer_menu');
     ?>
</div>
<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<script>
$("#seller_signup").validate({
	});

function validateSellerSignup(){
	var project_name = $('#project_name').val();
	var project_description = $('#project_description').val();
	var phone_no = $('#phone_no').val();
	$email = $('#email').val();
	if(project_name == ''){
		alert('Project name required');
		$('#project_name').focus();
		return false;
	}else if(project_description == ''){
		alert('Specify Requirements');
		$('#project_description').focus();
		return false;
	}else if(phone_no == ''){
		alert('Phone number required so that we can contact you to discuss requirements in detail');
		$('#phone_no').focus();
		return false;
/*	}else if($email == ''){
		alert('Email ID is required so that we can send you estimated cost and delivery timelines');
		$('#email').focus();
		return false;
	}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		alert('Invalid email format');
		$('#email').focus();
		return false; */
        }
}

</script>
<?php
$this->load->view('site/templates/footer');
?>