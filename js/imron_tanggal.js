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
}
