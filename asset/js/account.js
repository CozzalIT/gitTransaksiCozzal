$('#owner').hide();
var has_click = false;

$("#hak_akses").change(function(){
	if($("#hak_akses").val()=="owner"){
		$('#owner').show();
		$.ajax({
			type: "POST", // Method pengiriman data bisa dengan GET atau POST
			url: "../../../proses/option_unit.php", // Isi dengan url/path file php yang dituju
			data: {owner : 'cari'}, // data yang akan dikirim ke file yang dituju
			dataType: "json",
			beforeSend: function(e) {
				if(e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},
			success: function(response){ // Ketika proses pengiriman berhasil
					$("#kd_owner").html(response.pilihan_owner);
			},
			error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
				alert(thrownError); // Munculkan alert error
			}
		});		
		$('#kd_owner').attr({'required': 'required'});
	}
	else{
		$('#owner').hide();
		$('#kd_owner').removeAttr('required');
	}
});

$(".relasi").click(function(){
	if(has_click==false){
		$.ajax({
			type: "POST", // Method pengiriman data bisa dengan GET atau POST
			url: "../../../proses/option_unit.php", // Isi dengan url/path file php yang dituju
			data: {get_owner : 'cari'}, // data yang akan dikirim ke file yang dituju
			dataType: "json",
			beforeSend: function(e) {
				if(e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},
			success: function(response){ // Ketika proses pengiriman berhasil
					$("#get_owner").html(response.pilihan_owner);
			},
			error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
				alert(thrownError); // Munculkan alert error
			}
		});		
		has_click = true;
		var a = $(this).attr('id');
		$('#username2').val(a);
	}
});

$("#addRelasi").click(function(){
	if($("#get_owner").val()!='')
		$('#username2').removeAttr('disabled');
});
