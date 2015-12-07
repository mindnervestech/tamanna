$(function() {
	debugger;
	    if (navigator && navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {timeout:100000});
        } else {
          console.log('Geolocation is not supported');
        }
     
      function errorCallback(e) {
	            console.log('Geolocation is not supported' + e.code);

	  }
     
      function successCallback(position) {
		alert(position.coords.latitude + ',' + position.coords.longitude);
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
					debugger;
					console.log(json);
                    if (json != 1) {
                    }
                },
                error:function (){
                },
                complete : function(){
                }
            });
		}
      }
});