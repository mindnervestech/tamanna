<!DOCTYPE html>
<html>
<head>
	<title><?php echo $siteTitle;?></title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<style type="text/css">
body{
	float: left;
	outline:none;
	height: auto;
	width: 277px;
	margin:0;
font-size: 13px;
font-family: "Roboto",Helvetica,Arial,sans-seri;
overflow:hidden;
}
#bookmarklet-tagger-iframe{
	width:298px !important;
}
label{
color: #585b62;
font-weight: bold;
font-size: 13px;
margin-bottom:2px;
}
.top_head {
	float: left;
	width: 260px;
	height: 20px;
	padding: 10px;
	background-color: #373d48;
	margin-bottom: 5px;
}
.input-text,.select-round{
width: 228px;
height: 15px;
line-height: 14px;
padding: 7px;
margin: 0 0 2px;
background: #ffffff;
box-shadow: none;
border-color: #b0b5bd #c1c5cb #d2d6dc;
border-radius: 3px;
font-size: 13px;
border-width: 1px;
margin-bottom:5px;
}
.add_thing .img-pick {
	background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
	border: 1px solid #CFCFCF;
	box-shadow: 0 1px 0 #F2F2F2;
	float: left;
	height: 23px;
	text-align: center;
	vertical-align: middle;
	width: 60px;
	border-radius: 0 3px 3px 0;
	background: #fff;
	text-decoration: none;
	font-weight: bold;
	color: #000;
        font-size:13px;
        padding-top:3px;
        border-radius:3px;
}
img#add_picked-image {
	max-width: 250px;
	max-height: 250px;
border: 1px solid;
border-color: grey;
border-radius: 3px
}
.start_btn_1 {
	font-size: 15px !important;
	font-weight: normal !important;
	margin: 5px !important;
	padding: 9px 30px !important;
	width: 130px !important;
	background-color: #4c699e!important;
	border: none !important;
	cursor: pointer;
	color: #FFFFFF !important;
	text-transform: uppercase !important;
	border-radius: 5px;
	text-decoration:none;
}
.start_btn_1:hover {
	background: #0D75A5 !important;
}
.noimg {
	float: left;
	width: 100%;
	text-align: center;
	margin-top: 50px;
	font-weight: bold;
	color: black;
	font-size: 20px;
}
.clear{clear:both;}
.red {
color: red;
}

</style>

<script type="text/javascript" src="<?php echo base_url();?>js/bookmarklet/bookmarklet.js"></script>
</head>

<body>
	<div id="main">
	    <form class="no_image" style="display:none">
		    <div class="top_head" >
				<a style="float:left;" target="parent" href="<?php echo base_url();?>"><img height="19px" src="<?php echo base_url();?>images/logo/<?php echo $logo;?>"/></a>
				<a style="float:right;font-weight: bold;color: #fff;font-size: 20px;text-decoration:none;" title="Close this" href="javascript:void(0)" class="close_box">X</a>
			</div>
		    <div class="main frm" style="float: left;margin: 5px;">
			    <img src="<?php echo base_url();?>images/error_icon.png" width="73" height="92">
				<p><strong>Couldn't find any good images on this page.</strong></p>
				<p>The images might not be large enough, or they might be protected or inside a web plugin.</p>
				<p>Try again on a different page.</p>
		    </div>
		    <div class="footer">
				<a class="start_btn_1 close_box" style="float:left;text-align:center;" href="#">Cancel</a>
		    </div>
	    </form>
	    <form class="add_thing" style="display:none">
			<div class="top_head" >
				<a style="float:left;" target="parent" href="<?php echo base_url();?>"><img height="19px" src="<?php echo base_url();?>images/logo/<?php echo $logo;?>"/></a>
				<a style="float:right;font-weight: bold;color: #fff;font-size: 20px;text-decoration:none;" title="Close this" href="javascript:void(0)" class="close_box">X</a>
			</div>
			<div class="main frm" style="float: left;margin: 0px;">
				<fieldset style="border:0;">
					<img class="f-preview" id="add_picked-image">
					<div id="add-imgpick">
						<a class="img-pick" did="0" href="#">
						Prev
						</a>
						<a class="img-pick" did="1" href="#">
						Next
						</a>
						<span class="cur_" style="height: 23px;vertical-align: middle;margin-left: 5px;"><span>1</span> of <?php echo $total;?> images</span>
					</div>
					<div class="clear"></div><br/>
					<input type="hidden" value="" id="add_photo_url">
                    <input type="hidden" value="<?php echo $uid;?>" id="add_uid">
                    <input type="hidden" value="<?php echo base_url();?>" id="baseurl">
					<label>Title</label>
<span class="red">*</span>
                    <div class="clear"></div>
					<input type="text" class="input-text" id="add_name">
					<div class="clear"></div>
<label>Say something about this thing..</label>
                    <div class="clear"></div>
					<input type="text" class="input-text" id="add_excerpt">
					<div class="clear"></div>
                    <label style="display:none;">Web Link</label>
                    <div class="clear"></div>
                    <input type="text" disabled class="input-text" placeholder="http://" id="add_link" style="display:none;">
                    <div class="clear"></div>
                    <!-- <label>Price (INR)</label>
                    <div class="clear"></div>
                    <input type="text" class="input-text" id="add_price"> -->
                    <div class="clear"></div>
                    <?php if ($mainCategories->num_rows()>0){?>
                    <label>Category</label>
<span class="red">*</span>
                    <div class="clear"></div>
                    <select class="select-round selectBox categories_" id="add_category" style="width: 235px; padding:5px 10px 5px 5px; height: 30px;border: 1px solid #B4B9C7;">
                    	<option value="">Choose a category</option>
                    <?php 
					foreach ($mainCategories->result() as $row){
						if ($row->cat_name != ''){
if($row->id != 107){
					?>
                    	<option value="<?php echo $row->id;?>"><?php echo $row->cat_name;?></option>
                    <?php }
						}
					}
                    ?>                      
					</select>
                    <?php }?>                           
                   <div class="clear"></div>
				</fieldset>
				<div id="if-success" style="display:none">
					<div style="float: left;"><img src="<?php echo base_url();?>images/success.png"></div>
					<p> Product has been added to your list!</p>
					<a href="<?php echo base_url();?>" target="_blank" style="float: left;text-align:center;" class="start_btn_1">Go see it</a>
				</div>
			</div>
			<div class="btns-area footer" >
			    <button class="start_btn_1 add_new_thing">Add</button>
			    <a href="#" class="start_btn_1 cancel_add_thing">Cancel</a>
            </div>
		</form>
	</div>
    </body>
</html>
