var id_active = 'info';
var has_change = false;
$('#form_other').hide(); $('#form_user').hide(); $('#form_pass').hide();
$('#1_info').hide(); $('#2_other').hide();

if($('.error_alert').attr('id')=='gagalpass1' || $('.error_alert').attr('id')=='gagaluser' || $('.error_alert').attr('id')=='succesuser' ) $('#user').click();
else if($('.error_alert').attr('id')=='gagalpass2' || $('.error_alert').attr('id')=='succespass') $('#pass').click();

function validasi1(){
	if($(".form1").attr('disabled')){
		$(".form1").removeAttr('disabled');
		$('#1_info').show(); has_change = true;
		$('#infobtn').text('Simpan');
		document.getElementById('infobtn').className = 'btn btn-success';
		return false;
	} else {
		if($('#nama').val()=="" || $('#alamat').val()=="" 
		   || $('#no_tlp').val()=="" || $('#email').val()==""){
			alert('Lengkapi terlebih dahulu')
			return false;
		}
	}
}

function validasi2(){
	if($(".form2").attr('disabled')){
		$(".form2").removeAttr('disabled');
		$('#2_other').show(); has_change = true;
		$('#otherbtn').text('Simpan');
		document.getElementById('otherbtn').className = 'btn btn-success';
		return false;
	} else {
		if($('#no_rek').val()==""){
			alert('Lengkapi terlebih dahulu')
			return false;
		}
	}
}

function validasi3(){
	var a = $('#user_new').val();
	if(a.length<3){
		alert('Gunakan minimal 3 huruf untuk username');
		return false;
	}
}

function validasi4(){
	var a = $('#new_pass').val();
	var b = $('#konfr_pass2').val();
	if(a != b){
		alert('Password baru tidak cocok');
		return false;
	} else {
		if(a.length<5){
			alert('Gunakan minimal 5 huruf untuk password');
			return false;
		}
	}
}

function batal(id){
 $('#'+id).hide();
 var a = id.split('_');
 $('.form'+a[0]).attr({'disabled': 'disabled'});
 $('#'+a[1]+'btn').text('Ubah data'); 
 document.getElementById(a[1]+'btn').className = 'btn btn-info';
 has_change=false;
}

function changenav(id){
	if(has_change)
		alert('Silahan selesaikan perubahan yang anda buat, atau tekan Batal');
	else{
		if (id!=id_active){
			document.getElementById(id_active).className = 'non';
			document.getElementById(id).className = 'active';
			$('#form_'+id_active).hide(); $('#form_'+id).show();
			id_active = id;
		}
	}
}

$(".remote").keypress(function(){
	has_change = true;
});
