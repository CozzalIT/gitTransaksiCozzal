//Menampilkan data Unit berdasarkan apartemen
$(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
	// Kita sembunyikan dulu untuk loadingnya
	$("#loading").hide();

	$("#apartemen").change(function(){ // Ketika user mengganti atau memilih data apartemen
		$("#unit").hide(); // Sembunyikan dulu combobox unit nya
		$("#loading").show(); // Tampilkan loadingnya

		$.ajax({
			type: "POST", // Method pengiriman data bisa dengan GET atau POST
			url: "option_unit.php", // Isi dengan url/path file php yang dituju
			data: {apartement : $("#apartemen").val(), par:20}, // data yang akan dikirim ke file yang dituju
			dataType: "json",
			beforeSend: function(e) {
				if(e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},
			success: function(response){ // Ketika proses pengiriman berhasil
				setTimeout(function(){
					$("#loading").hide(); // Sembunyikan loadingnya

					// set isi dari combobox unit
					// lalu munculkan kembali combobox unitnya
					$("#unit").html(response.data_unit).show();

				}, 1250);
			},
			error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
				alert(thrownError); // Munculkan alert error
			}
		});
    });
});
