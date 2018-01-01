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
	form.total.value= (Number(form.harga_sewa.value)*Number(form.jumhari.value)) + Number(form.ekstra_charge.value);
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
	var a= form.unit.value;
	a = a.split("+");
	var b = new Date(form.check_in.value).getDay();
	i = 1;
	if (b>4) {i++;}
	form.harga_sewa.value=a[i];
	form.ekstra_charge.value=0; 
	hasil(form);
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
	}
	form.check_out.value = nilaitanggal(b,1);
	biaya(form); ECH(form); 
	updateselisih(form); hasil(form); 
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
		updateselisih(form); hasil(form);
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
    form.check_out.value=h; hasil(form);
}
