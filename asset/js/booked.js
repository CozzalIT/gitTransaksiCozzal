var we_G;
var wd_G;
var ec;

function hasil()
{
	document.getElementById("total").value = ($("#harga_sewa").val()*wd_G) + ($("#harga_sewa_we").val()*we_G) + Number($("#ekstra_charge").val());
}

function ech()
{
	var a = $("#tamu").val();
	var b = document.getElementById("ekstra_charge");
	if (a!='')
	{
	if (a > 5)
	{
		a=a-5;
		b.value= a*ec;
	} else {b.value=0;}
	} else {b.value=0;}
	hasil();
}

function selisih_hari(check_in, check_out)
{
 	var CI = new Date(check_in);
	var CO = new Date(check_out);
	var s = new Date(CI).getTime();
	var z = new Date(CO).getTime();
	x = z-s;
	return x/86400000;
}

function startinweekend(hari, week, jumlah_weekday, jumlah_weekend){
  var we =0; var wd =hari+5;
  while(wd>5){
    we = 8-week; hari = wd-5; 
    if(hari==1) we=1; wd=hari-we; 
    jumlah_weekend = jumlah_weekend+we; 
    if(wd>5) jumlah_weekday = jumlah_weekday+55; else jumlah_weekday = jumlah_weekday+wd;     
  }
  we_G = jumlah_weekend; wd_G = jumlah_weekday;
}

function tampilkanharga(kd_unit, check_in, check_out){
	$.post("../../../proses/booked.php", {cek_harga : kd_unit},
	function (data) {
		var week = new Date(check_in).getDay();
		var hari = selisih_hari(check_in, check_out);
		var wd,we =0; week++;
		$("#jumhari").val(hari);
		if(week>5){ //jika dimuai dari weekend
			startinweekend(hari, week, 0, 0);
		}
		else{ //jika dimulai dri weekday
			if((week+hari)<7) {
				wd_G=hari;we_G=0;
			} else {
				wd = 6 - week;
				startinweekend(hari-wd, 6, wd, 0);
			}
		}
		response = JSON.parse(data);
		$(".loading").hide();
		if (wd_G!=0){
			$('#harga_sewa').show();
			$('#harga_sewa').val(Number(response.wd));			
		} else $("#harga_sewa-C").hide();
		if(we_G!=0){
			$('#harga_sewa_we').show();
			$('#harga_sewa_we').val(response.we);			
		} else $("#harga_sewa_we-C").hide();
		$("#harga_sewa_asli").val(response.wd+"/"+response.we);
		$('#total').show(); 
		$('#total').val((Number(response.we)*we_G)+(Number(response.wd)*wd_G));
		ec = response.ec;
	});	
}

