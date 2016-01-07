$(function() {
	//debugger;
	//console.log($("#user_location").val())
	if($("#user_location").val() == "1"){
	    if (navigator && navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position){
				
			
		//alert(position.coords.latitude + ',' + position.coords.longitude);
		var url  = baseURL + 'site/user/add_user_locationtosession';
		if(position.coords.latitude!='' && position.coords.longitude!=""){
			var data = {
				lng : position.coords.longitude,
				lat : position.coords.latitude
			};
			$.ajax({
                type : 'post',
                url  : url,
                data : data,
                dataType : 'json',
                success : function(json){
					//debugger;
					//console.log(json);
                    if (json != 1) {
                    }
                },
                error:function (){
                },
                complete : function(){
                }
            });
		}
			
		}, function(e){
		}, {timeout:100000});
        } else {
          //console.log('Geolocation is not supported');
        }
	}  
});
	
	function login_account(){
		next = $(location).attr('href');
		next = next.replace(baseURL,'');
		location.href = baseURL+'login'+(next?'?next='+encodeURIComponent(next):'');
		return false;
	}