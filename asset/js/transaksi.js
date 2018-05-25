var we_G = 0;
var wd_G = 0;
var special_price = 0; 
var bool_detail;

function startinweekend(hari, week, jumlah_weekday, jumlah_weekend){
  var we =0; var wd =hari+5;
  while(wd>5){
    we = 8-week; hari = wd-5;
    if(hari==1) we=1; wd=hari-we;
    jumlah_weekend = jumlah_weekend+we;
    if(wd>5) jumlah_weekday = jumlah_weekday+5; else jumlah_weekday = jumlah_weekday+wd;
  }
  return jumlah_weekday+"&&"+jumlah_weekend;
}

function getdetailweek(start_time, hari){
	var wd;
	var week = new Date(start_time).getDay();
	week++;

	if(week>5){ //jika dimuai dari weekend
		return startinweekend(hari, week, 0, 0);
	}
	else{ //jika dimulai dri weekday
	  if((week+hari)<7) {return hari+"&&0";}
	  else {
	    wd = 6 - week;
	    return startinweekend(hari-wd, 6, wd, 0);
	  }
	}
}

function selisih_tanggal(start_time, end_time){
 	var d1 = new Date(start_time);
	var d2 = new Date(end_time);
	var s = new Date(d1).getTime();
	var z = new Date(d2).getTime();
	x = z-s;
	return x/86400000;
}

function std(x){
	return new Date(x);
}

//------------------------------------------------------------------------

function updateselisih(form)
{
	x = selisih_tanggal(form.check_in.value, form.check_out.value);
	if(x>=0) form.jumhari.value=x;
	else form.jumhari.value=0;
}


function nilaitanggal(t, b)
{
	t.setDate(t.getDate()+b);
	t.setHours(7); t.setMinutes(0); t.setSeconds(0); t.setMilliseconds(0);
	bln = t.getMonth()+1; thn = t.getFullYear(); hr = t.getDate();
	b2 = Number(bln); h2 = Number(hr);
	if(b2<10) bln = '0'+ bln; if(h2<10) hr = '0'+ hr;
	return thn+'-'+bln+'-'+hr;
}

function hasil(form)
{

	form.total.value=Number(form.harga_sewa_gbg.value)+ Number(form.ekstra_charge.value);

	form.total_bayar.value = Number(form.total.value)+Number(form.deposit.value);

}

function ECH(form)
{
	var a = form.tamu.value;
	if (a!='')
	{
	if (a > 5)
	{
		a=a-5;
		var b = form.unit.value;
		b = b.split("+");
		form.ekstra_charge.value= a*Number(b[7]);
	} else {form.ekstra_charge.value=0;}
	} else {form.ekstra_charge.value=0;}
	hasil(form);
}

function proses_mod_harga(form, a){
    var d1 = std(form.check_in.value);
    var d2 = std(form.check_out.value);
    special_price = 0;
    for(i=0;i<harga_mod.length;i++){
    	x = harga_mod[i].kd_unit == a;
    	y = (std(harga_mod[i].start_date)<d1) && (std(harga_mod[i].end_date)<d1);
    	z = (std(harga_mod[i].start_date)>d2) && (std(harga_mod[i].end_date)>d2);
    	if(!(y || z) && x){
    		sdt = harga_mod[i].start_date; edt = harga_mod[i].end_date;
    		if(std(sdt)<d1) sdt = form.check_in.value;
    		if(std(edt)>d2) edt = form.check_out.value;
    		selisih = selisih_tanggal(sdt,edt);
    		if(sdt!=form.check_in.value) selisih++;
    		weeks = getdetailweek(sdt, selisih).split("&&");
    		wd_G -= Number(weeks[0]); we_G -= Number(weeks[1]);
    		special_price += Number(selisih) * Number(harga_mod[i].harga_sewa);
    	}
    }
}

function harga_mingguan(a, hari){
	var x1 = Math.floor(hari/7);
	var y1 = hari - (7*x1);

	$("#harga_sewa_gbg").val((a[3]*x1)+(y1*a[1])); $("#total_sewa_gbg-C").show();
	$("#total_harga_owner").val((a[5]*x1)+(y1*a[8]));$("#total_harga_owner-C").show();
	$("#deposit").val("0");$("#deposit-C").hide();
	$("#harga_sewa_we").val("0"); $("#harga_sewa_we-C").hide();
	$("#harga_sewa").val("0"); $("#harga_sewa-C").hide();
}

function harga_bulanan(a, hari){
	var x1 = Math.floor(hari/28);
	$("#deposit").val("2000000");$("#deposit-C").show();
	//proses_mod_harga(form, a[0]); // proses moddig harga
	$("#harga_sewa_gbg").val(a[4]*x1);$("#total_sewa_gbg-C").hide();
	$("#total_harga_owner").val(a[6]*x1);$("#total_harga_owner-C").show();
	$("#total_bayar").val($("#total").val()+$("#deposit").val());$("#total_bayar-C").show();
	$("#tamu").val("5");$("#tamu-C").hide();
	$("#ekstra_charge").val("0");$("#ekstra_charge-C").hide();
	$("#harga_sewa_we").val("0"); $("#harga_sewa_we-C").hide();
	$("#harga_sewa").val("0"); $("#harga_sewa-C").hide();
}

function biaya(form)
{
	var we =0;
	var hari= Number(form.jumhari.value);
	var weeks = getdetailweek(form.check_in.value, hari).split("&&");
	wd_G = weeks[0]; we_G = weeks[1];
	var a= form.unit.value;  a = a.split("+");
	if(hari>6) {
		if (hari>28){ // 27 atau 28 ?
			harga_bulanan(a, hari);
		} else{
			harga_mingguan(a, hari);
		}


		//$("#deposit").val("0");$("#deposit-C").hide();
	} else {
    $("#total_harga_owner").val("0");$("#total_harga_owner-C").hide();
    $("#deposit").val("0");$("#deposit-C").hide();
    $("#harga_sewa_gbg-C").hide();
    $("#total_bayar-C").hide();
    if(we_G!=0) {$("#harga_sewa_we").val(a[2]); $("#harga_sewa_we-C").show();}
		else {$("#harga_sewa_we").val("0"); $("#harga_sewa_we-C").hide();};

		if(wd_G!=0) {$("#harga_sewa").val(a[1]); $("#harga_sewa-C").show();}
		else {$("#harga_sewa").val("0"); $("#harga_sewa-C").hide();};
		form.harga_sewa_gbg.value = Number(form.harga_sewa.value)*Number(wd_G) + Number(form.harga_sewa_we.value)*Number(we_G);
	}

	//proses_mod_harga(form, a[0]); // proses moddig harga
	form.harga_sewa_asli.value = a[1]+"/"+a[2];
	form.ekstra_charge.value=0;
	hasil(form);
}

function keepvalid(form)
{
	var CI = std(form.check_in.value);
	//var we =0;
	//var weeks = getdetailweek(form.check_in.value, hari).split("&&");
	//wd_G = weeks[0]; we_G = weeks[1];
	form.check_out.value = nilaitanggal(CI,1);
	ECH(form);
	updateselisih(form);
	biaya(form);
}

function ubahHarga(form){
	var hari= Number(form.jumhari.value);
	var a= form.unit.value;  a = a.split("+");

	if(hari<7) {
		//proses_mod_harga(form, a[0]); // proses moddig harga
		$("#total_harga_owner").val("0");$("#total_harga_owner-C").hide();
		$("#tamu").val("5");$("#tamu-C").show();
		$("#ekstra_charge").val("0");$("#ekstra_charge-C").show();
		$("#deposit").val("0");$("#deposit-C").hide();
		$("#harga_sewa_gbg-C").show();$("#total_bayar-C").hide();
		biaya(form);
	} else{
		if (hari<29){
			harga_mingguan(a, hari);
		}else{
			harga_bulanan(a, hari);
		}
		hasil(form);
	}
}

function keepvalid2(form){
	if (form.check_in.value!=""){
		updateselisih(form);
		ubahHarga(form);
	} else {
		form.check_out.value="";
		alert("Isi terlebih dahulu tanggal check in");
	}
}

function validasi(form)
{
	var b = new Date(form.check_in.value);
	var c = new Date();
	c.setHours(7); c.setMinutes(0); c.setSeconds(0); c.setMilliseconds(0);
	var d = new Date(form.check_out.value);
	if (b<c)
	{
		alert("Tanggal check in tidak boleh kurang dari hari ini");
		form.check_in.value = nilaitanggal(c,0);
		form.check_out.value = nilaitanggal(c,1);
	} else
	form.check_out.value = nilaitanggal(b,1);
	updateselisih(form);
	ECH(form); biaya(form);
}

function validasi2(form)
{
	if (form.check_in.value!="")
	{
		if (std(form.check_out.value)<=std(form.check_in.value))
		{
			alert("Pilih tanggal setelah tanggal check in");
			form.check_out.value="";
		}
		updateselisih(form); biaya(form);
	}
	else
	{
		form.check_out.value="";
		alert("Isi terlebih dahulu tanggal check in");
	}
}

function tambah(form)
{
	var d = new Date(form.check_in.value);
	var h = nilaitanggal(d,Number(form.jumhari.value));
	form.check_out.value=h;
	ubahHarga(form);
}

function valid1(form)
{
	var e = document.getElementById('btn1');
	var f = document.getElementById('col1');
	var flg;
	if (form.check_in.value!="" && form.check_out.value!="")
		flg = '#collapseUnit'; else flg = '#';
	e.setAttribute('href',flg);
	f.setAttribute('href',flg);
	return false;
}

function setDetailVisible(n){
	bool_detail = n;
	if(n){
		$("#icon-detail").attr("class","icon-chevron-up");
		$("#detail_red").show();
	} else {
		$("#icon-detail").attr("class","icon-chevron-down");
		$("#detail_red").hide();
	}
}

function showDetail(){
	if(bool_detail)
		setDetailVisible(false);
	else 
		setDetailVisible(true);
}

function cancelSubmit(){
	if($("#button-sub").text()=="Tambahkan"){
		$(".close").click();
	} else {
		$("#detail").hide();
		$("#gif-cek-penyewa").hide();
		$("#stat-cek-penyewa").hide();
    	$("#button-sub").attr("class","btn btn-success");
    	$("#button-sub").text("Tambahkan");		
	}
}

function submite(n){
	window.location = "transaksi.php?transaksi="+n;
}

function cekPenyewa(){
	if($("#button-sub").text()=="Tambahkan"){
		$("#gif-cek-penyewa").show();
		$("#stat-cek-penyewa").text("Menganalisis Data Penyewa ...");
		$("#stat-cek-penyewa").show(); $("#detail").hide();
		document.getElementById("stat-cek-penyewa").style.color = "black";
	    $.post("../../../proses/penyewa.php", {
	    	cek_penyewa : $("#nama").val(),
	    	alamat : $("#alamat").val(),
	    	no_tlp : $("#no_tlp").val(),
	    },
	    function (data) {
	    	var res = JSON.parse(data);
	    	$("#gif-cek-penyewa").hide();
	    	$(".note").remove();
	    	if(res.length==0){
	    		$("#submit-btn").click();
	    		$("#stat-cek-penyewa").hide(); 
	    	} else {
	    		$("#stat-cek-penyewa").text("Ditemukan data yang sama");
	    		document.getElementById("stat-cek-penyewa").style.color = "red";
	    		$("#button-sub").attr("class","btn btn-warning");
	    		$("#button-sub").text("Lanjutkan Saja");
	    		for(var i=0;i<res.length;i++){
	    			var tmp_str = "<div class='note'><a onclick='submite("+res[i].kd_penyewa+");'";
	    			tmp_str += " class='selected'>Gunakan Ini</a>"+res[i].nama+" - "+res[i].jenis_kelamin;
	    			tmp_str += "<br>"+res[i].alamat+" - "+res[i].no_tlp+"<br>"+res[i].email+"</div>";
	    			$("#detail_red").append(tmp_str);
	    		}
	    		$("#detail").show();
	    		setDetailVisible(false);
	    	}
	    });		 		
	} else {
		$("#submit-btn").click();
	}
}

$(document).ready(function(){ 
	$("#gif-cek-penyewa").hide();
	$("#stat-cek-penyewa").hide();
	$("#detail").hide();
	$("#btn2").click(function(){
	if ($("#unit").val()!="" && $("#total").val()!=0){
	idd = $("#unit").val().split("+");
		$.ajax({
			type: "POST",
			url: "../../../proses/option_unit.php",
			data: {id1 : idd[0], tci1:$("#check_in").val(), tco1:$("#check_out").val()},
			dataType: "json",
			beforeSend: function(e) {
				if(e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},
			success: function(response){
					ret = response.ketersediaan;
					if (ret=="Ada"){
						$("#col2").attr("href","#collapseGFive");$("#col2").click();
						$("#col2").attr("href","#");
					}
					else alert(ret);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(thrownError);
			}
		});
	}
	});

	$(".ipt").keyup(function(event){
		if(event.keyCode === 13){
			cekPenyewa();
		}
	});
 });
