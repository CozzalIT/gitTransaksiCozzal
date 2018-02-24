$(document).ready(function(){

	$(".status").click(function(){
	  var a = $(this).attr('id');
	  	$.ajax({
		type: "POST", 
		url: "../../../proses/option_unit.php", 
		data: {status : a}, 
		dataType: "json",
		beforeSend: function(e) { 
			if(e && e.overrideMimeType) {
				e.overrideMimeType("application/json;charset=UTF-8");
			}
		},
		success: function(response){ 
				ret = response.stat;
				$("#"+a).text(ret);
		},
		error: function (xhr, ajaxOptions, thrownError) { 
			alert(thrownError); 
		}
		});
	});	

	$(".status").click();
}); 