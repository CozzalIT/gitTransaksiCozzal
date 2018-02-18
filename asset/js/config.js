//Menampilkan data Unit berdasarkan apartemen
$(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
	// Kita sembunyikan dulu untuk loadingnya
	$("#loading").hide();

	$("#apartemen").change(function(){ // Ketika user mengganti atau memilih data apartemen
		$.ajax({
			type: "POST", // Method pengiriman data bisa dengan GET atau POST
			url: "../../../proses/option_unit.php", // Isi dengan url/path file php yang dituju
			data: {apartement : $("#apartemen").val(), par:20}, // data yang akan dikirim ke file yang dituju
			dataType: "json",
			beforeSend: function(e) {
				if(e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},
			success: function(response){ // Ketika proses pengiriman berhasil
					$("#unit").html(response.data_unit);
			},
			error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
				alert(thrownError); // Munculkan alert error
			}
		});
    });
});
