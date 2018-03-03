$(document).ready(function(){

var in_update = false;
var idpopup = 'null';
var current_jml = 0;
$('#note-anak').hide();
$(".newnote").hide();

function notecap(jumlah){
	$("#note-cap").text('Catatan ('+jumlah+')');
	if(jumlah==0) $("#"+idpopup+"-btn-lihat").text('Lihat');
	else $("#"+idpopup+"-btn-lihat").text('Lihat ('+jumlah+')');
}

function updateelementtask(konten2, jumlah2, task){
	$('#task-anak-isi').html(konten2);
	$("#task-cap").text('Task Tersisa ('+jumlah2+')');	
	//if(jumlah2==0) $("#btn-bersihkan").hide();				
	$("#task-temp").val(task);
}

function getNewTask(unit){
    $.post('../../../proses/task.php', {NewTask : unit},
    function (data) {
      response = JSON.parse(data);
      updateelementtask(response.konten2, response.jumlah2, response.task);
    });
}

	$(".status").click(function(){
	  var a = $(this).attr('id');
	    $.post('../../../proses/option_unit.php', {status : a},
        function (data) {
          response = JSON.parse(data);
          ret = response.stat;
		  $("#"+a).text(ret);
		  if (response.catatan!=0) $("#"+a+"-btn-lihat").text('Lihat ('+response.catatan+')');
        });
	});	

	$(".kotor").click(function(){
		var a = $(this).attr('id');
	    $.post('../../../proses/task.php', {updateTask_unit : a},
        function (data) {
          response = JSON.parse(data);
          ret = response.done;
        });		
	});

	$(".status").click(); $(".kotor").click();

	$(".popup").click(function(){
		$(".newnote").hide();$("#tambah-note").show();
		var data_id = $(this).attr('id');
		data_id = data_id.split('-');
		var id = data_id[0]; $("#unit").val(id);
		if(id!=idpopup){
		  var jenis = data_id[2]; idpopup = id;
		  var url_id = "../../../proses/task.php";
		  if(jenis=='lihat'){
		  	url_id = "../../../proses/catatan.php";
		  	$("#task-induk").hide();
			$('#note-anak').show(); 
		  } else {
			$("#task-induk").show();
			$('#note-anak').hide();
		  }
		    $.post(url_id, {ajx_id : id},
		    function (data) {
		      response = JSON.parse(data);
				$("#note-anak-isi").html(response.konten); 
				current_jml = response.jumlah;notecap(current_jml);
				if(jenis!='lihat'){
					updateelementtask(response.konten2, response.jumlah2, response.task);
					getNewTask(id);
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
	      	current_jml++; notecap(current_jml);
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
		text :'Apakah anda yakin manghapus catatan ',
		icon : 'warning',
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if(willDelete){
		    $.post("../../../proses/catatan.php", {hapus_catatan : a},
		    function (data) {
		      current_jml--; notecap(current_jml);
		      if(current_jml==0){
		      	$("#note-anak-isi").html('<div class="note">Tidak adak catatan pada unit ini.</div>');	      	
		      } else $("#"+a).remove(); 
		    });			
		} 
		$("#popup-task").show();
	});
});

$("#task-bar").click(function(){
	$("#task-anak").show(); $("#note-anak").hide();
});

$("#note-bar").click(function(){
	$("#note-anak").show(); $("#task-anak").hide();
});

}); //on document ready