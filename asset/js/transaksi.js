var we_G = 0;
var wd_G = 0;

function startinweekend(hari, week, jumlah_weekday, jumlah_weekend){
  var we =0; var wd =hari+5;
  while(wd>5){
    we = 8-week; hari = wd-5; 
    if(hari==1) we=1; wd=hari-we; 
    jumlah_weekend = jumlah_weekend+we; 
    if(wd>5) jumlah_weekday = jumlah_weekday+5; else jumlah_weekday = jumlah_weekday+wd;     
  }
  we_G = jumlah_weekend; wd_G = jumlah_weekday;
}


function updateselisih(form)
{
 	var CI = new Date(form.check_in.value);
	var CO = new Date(form.check_out.value);
	var s = new Date(CI).getTime();
	var z = new Date(CO).getTime();
	x = z-s;
	x = x/86400000;
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
	form.total.value= ($("#harga_sewa").val()*wd_G) + ($("#harga_sewa_we").val()*we_G) + Number(form.ekstra_charge.value);
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
		form.ekstra_charge.value= a*Number(b[3]);
	} else {form.ekstra_charge.value=0;}
	} else {form.ekstra_charge.value=0;}
	hasil(form);
}

function biaya(form)
{
	var week = new Date(form.check_in.value).getDay(); 
	var we =0; var hari= Number(form.jumhari.value);
	var a= form.unit.value; var wd; week++;
	if(week>5){ //jika dimuai dari weekend
		startinweekend(hari, week, 0, 0);
	}
	else{ //jika dimulai dri weekday
	  if((week+hari)<7) {wd_G=hari;we_G=0;}
	  else {
	    wd = 6 - week;
	    startinweekend(hari-wd, 6, wd, 0);
	  }
	}
	a = a.split("+");
	if(we_G!=0) {$("#harga_sewa_we").val(a[2]); $("#harga_sewa_we-C").show();} 
	else {$("#harga_sewa_we").val("0"); $("#harga_sewa_we-C").hide();};
	if(wd_G!=0) {$("#harga_sewa").val(a[1]); $("#harga_sewa-C").show();} 
	else {$("#harga_sewa").val("0"); $("#harga_sewa-C").hide();};
	form.harga_sewa_asli.value = a[1]+"/"+a[2];
	form.ekstra_charge.value=0; hasil(form);
}

function keepvalid(form){
	var a = form.check_in.value;
	var b = new Date(a);
	form.check_out.value = nilaitanggal(b,1);
	updateselisih(form);
	ECH(form); biaya(form); 
}

function keepvalid2(form){
	if (form.check_in.value!="")
	{
		updateselisih(form); biaya(form);
	}
	else
	{
		form.check_out.value="";
		alert("Isi terlebih dahulu tanggal check in");
	}	
}

function validasi(form)
{
	var a = form.check_in.value;
	var b = new Date(a);
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
		var CI = new Date(form.check_in.value);
		var CO = new Date(form.check_out.value);
		if (CO<=CI) 
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
    form.check_out.value=h; biaya(form); hasil(form);
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

$(document).ready(function(){ 
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
 });
