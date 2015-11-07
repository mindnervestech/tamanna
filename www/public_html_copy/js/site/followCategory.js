/*here are the code to follow and unfollow the category*/

$(document).ready(function () {
    $(".followCat").click(function () {
    	var Cat_Id =$(this).attr('value');
		//alert(Cat_Id);
		//document.getElementById('followCat'+Cat_Id).innerHTML="unfollow";

		$.ajax({
			type : 'get',
			url  : baseURL+'site/landing/followCategory?c='+Cat_Id,
			dataType : 'json',
			success  : function(json){
				var Ftext = json.text;
				var F_ID = json.id;
				document.getElementById('followCat'+F_ID).innerHTML = Ftext;
			}
		});
        /*var type = $(this).data("id");
        $('#content').load("content.php?" + type);*/
    });
});