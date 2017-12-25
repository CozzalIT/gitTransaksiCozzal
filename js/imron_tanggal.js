var selisih = 0;

function hasil(form)
{
	var CI = new Date(form.check_in.value);
	var CO = new Date(form.check_out.value);
	var s = new Date(CI).getTime();
	var z = new Date(CO).getTime();
	
	x = z-s;
	selisih = x/86400000;
	form.total.value= (Number(form.harga_sewa.value)*selisih) + Number(form.ekstra_charge.value);
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

function cobaan(form)
{
	var a = form.check_in.value;
	var b = new Date(a);
	var c = new Date();
	hari = c.getDate(); bulan = c.getMonth()+1; tahun = c.getFullYear();
	if (b<c)
	{
		alert("Tanggal check in tidak boleh kurang dari hari ini");
		form.check_in.value = tahun+"-"+bulan+"-"+hari;
	}
	biaya(form); ECH(form); hasil(form); 
}
function cobaan2(form)
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
	}
	else
	{
		form.check_out.value="";
		alert("Isi terlebih dahulu tanggal check in");
	}
	hasil(form);
}



