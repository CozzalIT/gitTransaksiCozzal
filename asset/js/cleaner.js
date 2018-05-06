$(document).ready(function(){

var in_update = false;
var idpopup = 'null';
var jenisglob;
var current_jml = 0;
$('#note-anak').hide();
$(".newnote").hide();

function onpopup(){
	$("#task-cap").text("Memuat Task ...");
	$("#note-cap").text("Memuat Catatan ...");
	$("#head-cap").text("Memuat Infromasi ...");
}

function getButtonText(jenis){
	if (jenis=='none') return 'Tidak Ada';
	else if (jenis=='belum') return 'Belum Ada';
	else if (jenis=='prepare') return 'Persiapkan';
	else if (jenis=='bersih') return 'Bersihkan';
	else if (jenis=='lihat') return 'Lihat Unit';
	else if (jenis=='ubah') return 'Ubah Status';
}

function notecap(jumlah, jenis){
	$("#note-cap").text('Catatan ('+jumlah+')');
	if(jumlah==0) $("#"+idpopup+"-none").text('Tidak Ada');
	else $("#"+idpopup+"-"+jenis).text(getButtonText(jenis)+' ('+jumlah+')');
}

function updateelementtask(konten2, jumlah2, task){
	$('#task-anak-isi').html(konten2);
	$("#task-cap").text('Task Tersisa ('+jumlah2+')');					
	$("#task-temp").val(task);
}

function r_status_bersih(id){
	id = id.split("-");
	var a = id[0];
    $.post('../../../proses/option_unit.php', {status : a},
    function (data) {
      response = JSON.parse(data); jenis = 'none';
      ret = response.stat; $("#"+a+"-muatstat").text(ret);
	  if(ret=="Check In") {
	  	if(response.lihat=="Null"){
//		  		if($(this).text()=="Memuat..."){
		  		$("#"+a+"-none").attr("class", "btn btn-primary popup"); //set warna button biru
		  		$("#"+a+"-none").text("Lihat Unit"); $("#"+a+"-none").attr("id", a+"-lihat"); //set button jadi lihat
		  		$("#"+a+"-nourut").text("3"); jenis = 'lihat';
//		  		}
	  	} else {
	  		if(response.lihat == "N"){
		  		$("#"+a+"-none").attr("class", "btn btn-danger popup"); $("#"+a+"-muatstat").text('Belum Siap');
		  		$("#"+a+"-none").text("Ubah Status"); $("#"+a+"-none").attr("id", a+"-ubah");	
		  		$("#"+a+"-nourut").text("2"); jenis = 'ubah';  			
	  		} else if(response.lihat =="Y"){
	  			$("#"+a+"-muatstat").text('Siap Pakai');
	  		}
	  	}
	  }
	  if (response.catatan!=0){
	  	var buttontext = getButtonText(jenis);
	  	$("#"+a+"-"+jenis).text(buttontext+' ('+response.catatan+')');	
	  }	  
    });
}	
		
function r_status_kotor(id){
	id = id.split("-");
	var a = id[0]; var jenis = id[2];
	$.post('../../../proses/task.php', {updateTask_unit : a},
	function (data) {
	  response = JSON.parse(data);
	  if (response.catatan!=0){
	  	var buttontext = getButtonText(jenis);
	  	$("#"+a+"-"+jenis).text(buttontext+' ('+response.catatan+')');	
	  }	 
	  alert(data);
	});			
}

function status_bersih(){
	var x = document.getElementsByClassName("status");
	for(i=0;i<x.length;i++){
		r_status_bersih(x[i].id);
	}
}

function status_kotor(){
	var x = document.getElementsByClassName("kotor");
	for(i=0;i<x.length;i++){
		r_status_kotor(x[i].id);
	}
}

function update_task_sekali(){
	$.post('../../../proses/task.php', {update_sekali : "start"},
	function (data) {
		status_bersih(); status_kotor(); 
		$("#sortmanual").click();$("#sortmanual").click();

	});		
}

//proses ini di jalankan pertama kali saat halaman muncul
update_task_sekali();	 

//dibawah ini adalah event handler
	$("#has_look").click(function(){
		if (this.checked) {
			$("#stat-option").show();
			$("#update-stat").show();
		} else {
			$("#stat-option").hide();
			$("#update-stat").hide();			
		}
	});

	$(".popup").click(function(){
		$(".newnote").hide();$("#tambah-note").show();
		var data_id = $(this).attr('id');
		data_id = data_id.split('-');
		var id = data_id[0]; $("#unit").val(id);
		if(id!=idpopup){
		  var jenis = data_id[1]; idpopup = id; 
		  var url_id = "../../../proses/task.php";
		  jenisglob = jenis; onpopup();
		  if (jenis=='none' || jenis=='ubah' || jenis=='lihat') 
		  	url_id = "../../../proses/catatan.php"; 
		  if(jenis=='none'){ //kalo action = Tidak ada
			  	$("#task-induk").hide(); 
			  	$("#stat-induk").hide(); 
			  	$('#note-anak').show(); 
		  } else if(jenis=='belum' || jenis=='prepare' || jenis=='bersih') {
				$("#stat-induk").hide();$("#task-induk").show(); 
				$("#task-anak").show();$('#note-anak').hide();
				if(jenis!='bersih'){
					$("#btn-bersihkan").hide(); $("#stat-induk").show(); $(".statpadd").hide();
					$("#update-stat").hide(); $("#kosong-stat").show(); $("#stat-anak").hide();
				} else{
					$("#btn-bersihkan").show(); $("#stat-induk").hide();
				} 
		  } else if(jenis=='ubah' || jenis=='lihat'){
		  		$("#task-induk").hide();
		  		$("#stat-induk").show(); //$("#stat-anak").show();
		  		$('#note-anak').hide();
		  		$(".statpadd").show(); $("#kosong-stat").hide();
		  		if(jenis=='lihat'){
		  			$("#check-stat").show();
		  			$("#stat-option").hide();
		  			document.getElementById('has_look').checked = false;
		  			document.getElementById('Y-stat').checked = true;
		  			$("#update-stat").hide();
		  		} else {
		  			$("#stat-option").show(); $("#check-stat").hide();
		  			document.getElementById('N-stat').checked = true; 
		  			$("#update-stat").show();
		  		} 
		  }
		    $.post(url_id, {ajx_id : id},
		    function (data) {
		    $("#head-cap").text($("#"+id+"-nounit").text()+" "+$("#"+id+"-nameapt").text());
		      response = JSON.parse(data);
				$("#note-anak-isi").html(response.konten); 
				current_jml = response.jumlah;notecap(current_jml, jenisglob);
				if(jenis!='lihat'){
					updateelementtask(response.konten2, response.jumlah2, response.task);
				}
		    });
		}
	});

$("#tambah-note").click(function(){
	if(in_update==false){
		$(".newnote").show(); $("#note-baru").val(''); $("#tambah-note").hide();
	}
});

$("#note-simpan").click(function(){
	if($("#note-baru").val()!=""){
		var isi = '<div id="temp" class="note"><a class="close">...</a>';
		isi = isi+$("#note-baru").val()+'</div>';
		if(current_jml==0) $("#note-anak-isi").html(isi); 
		else $("#note-anak-isi").append(isi);  
		if($("#empty-note")) $("#empty-note").remove(); 
		$("#note-batal").click(); in_update=true;
	    $.post("../../../proses/catatan.php", {addNote : idpopup, Note: $("#note-baru").val()},
	    function (data) {
	      response = JSON.parse(data);
	      var a = response.res;
	      if(a!='Gagal'){
	      	a_new = "'"+a+"'"; val = "'#del'"; but = "'#del-note'";
	      	$("#temp").html('<a class="close" onclick="$('+val+').text('+a_new+'); $('+but+').click();">×</a>'+$("#note-baru").val());
	      	$("#temp").attr('id',response.res);
	      	current_jml++; notecap(current_jml, jenisglob);
	      } else {alert('Gagal Menambahkan Note'); $("#temp").remove();}
	      in_update = false;
	    });
	}
});

$("#del-note").click(function(){
	var a = $("#del").text();
	$("#popup-task").hide();
		swal({
		title:'KONFIRMASI',
		text :'Apakah anda yakin manghapus catatan ?',
		icon : 'warning',
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if(willDelete){
		    $.post("../../../proses/catatan.php", {hapus_catatan : a},
		    function (data) {
		      current_jml--; notecap(current_jml, jenisglob);
		      if(current_jml==0){
		      	$("#note-anak-isi").html('<div class="note">Tidak adak catatan pada unit ini.</div>');	      	
		      } else $("#"+a).remove(); 
		    });			
		} 
		$("#popup-task").show();
	});
});

$("#task-bar").click(function(){
	$("#task-anak").show(); $("#note-anak").hide(); $("#stat-anak").hide();
});

$("#note-bar").click(function(){
	$("#note-anak").show(); $("#task-anak").hide(); $("#stat-anak").hide();
});

$("#stat-bar").click(function(){
	$("#stat-anak").show(); $("#task-anak").hide(); $("#note-anak").hide();
});

$("#kosong-stat").click(function(){
	$("#popup-task").hide();
	swal({
		title:'KONFIRMASI',
		text :'Apakah anda yakin ingin mengkosongkan unit ?',
		icon : 'warning',
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if(willDelete){
			window.location = "../../../proses/task.php?kosongkan_unit="+idpopup;
		} else $("#popup-task").show();
	});
});

$("#update-stat").click(function(){
	var ready = 'Y';
	if (document.getElementById('N-stat').checked) ready = 'N';
	window.location = "../../../proses/task.php?set_ready="+ready+"&kd_unit="+idpopup;
});

$(".fg-button").click(function(){
	$(".status").click();
});

}); //on document ready