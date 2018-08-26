var today = new Date();
var first_loaded = true;
var week_pos = 1;
var onloading = false;
var arr_bulan = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Okt","Nov","Des"];
var selected_index; //(26) format : m/n dimana m adalah kotak ke berapa dan n adalah timeline ke berapa

function resetViewTanggal(){
	$("#tanggal-0").text("...");
	$("#tanggal-1").text("...");
	$("#tanggal-2").text("...");
	$("#tanggal-3").text("...");
	$("#tanggal-4").text("...");
	$("#tanggal-5").text("...");
	$("#tanggal-6").text("...");
	$(".bulan").text("...");
}

function set_detail_timeline(n){
	$("#selected-day").text('Memuat...');
	$(".detail-timeline").remove();
	$("#CI-head").hide(); $("#CO-head").hide();
	$("#ST-head").hide(); $("#KT-head").hide();
	$("#TS-head").hide(); 
    $.post("../../../proses/cleaner.php", {detail_timeline : n, index : week_pos},
    function (data) {
    	response = JSON.parse(data);
    	if(response.CI!=""){
    		$("#CI-head").show();
    		$("#CI-detail").append(response.CI);
    	}
    	if(response.CO!=""){
    		$("#CO-head").show();
    		$("#CO-detail").append(response.CO);
    	}
    	if(response.ST!=""){
    		$("#ST-head").show();
    		$("#ST-detail").append(response.ST);
    	}
     	if(response.TS!=""){
    		$("#TS-head").show();
    		$("#TS-detail").append(response.TS);
    	}   	
    	if(response.CI=="" && response.CO=="" && response.ST=="" && response.TS==""){
    		$("#KT-head").show();
    	}
		n = n.split("-"); 
		if(n[1].length==1) n[1] = '0'+n[1];
		if(n[0].length==1) n[0] = '0'+n[0];
		$("#selected-day").text(n[2]+"/"+n[1]+"/"+n[0]);
    });		   
}


function get_selected_date(id){
	var a = id[6]; var bulan=0;
	var tgl = $("#tanggal-"+a).text();
	var BT = $("#bulan-"+a).text();
	BT = BT.split(" ");
	for(i=0; i<arr_bulan.length; i++){
		if(BT[0]==arr_bulan[i]) bulan=i+1;
	}
	return BT[1]+"-"+bulan+"-"+tgl;
}

function set_selected_index(index, pos){
	var a = index.split("/");
	if(a[0]==pos){
		$("#kotak-"+a[1]).addClass("selected");
	}
}

function new_week(pos){
	$("#cap-text").text("Timeline Unit perminggu ("+pos+")");
	$(".statuses").remove();
	$(".selected").removeClass("selected");
	if(pos!=1) $("#kotak-6").removeClass("today");
	else $("#kotak-6").addClass("today");
	onloading = true;
}

function alerti(ex, st){
	var i =6-ex; 
	tanggal = new Date();
	tanggal.setDate(today.getDate()+(ex+st)); 
	bulan = tanggal.getMonth()+1; if(bulan<10) bulan = "0"+bulan;
	hari = tanggal.getDate(); if(hari<10) hari = "0"+hari;
	tanggal_mod = tanggal.getFullYear()+"-"+bulan+"-"+hari;
    $.post("../../../proses/cleaner.php", {show_tanggal : tanggal_mod, kotak : i},
    function (data) {
   		response = JSON.parse(data);
   		$("#tanggal-"+i).text(tanggal.getDate());
   		$("#bulan-"+i).text(arr_bulan[tanggal.getMonth()]+" "+tanggal.getFullYear());
   		if (response.CI!=0) $("#box-white-"+i).append('<div class="statuses stat-ci">Check In ('+response.CI+')</div>'); 
   		if (response.CO!=0) $("#box-white-"+i).append('<div class="statuses stat-co">Check Out ('+response.CO+')</div>');
   		if (response.ST!=0) $("#box-white-"+i).append('<div class="statuses stat-stay">Stay ('+response.ST+')</div>');
   		if (response.TS!=0) $("#box-white-"+i).append('<div class="statuses stat-task">Task Once ('+response.TS+')</div>');
   		if (response.ST==0 && response.CO==0 && response.CI==0 && response.TS==0) 
   			$("#box-white-"+i).append('<div class="statuses stat-kosong">Kosong</div>');
   		if(ex<6){
   			alerti(ex=ex+1,st);
   		} else {
   			onloading = false; 
   			if(first_loaded){
   				bulan = today.getMonth()+1;
   				set_detail_timeline(today.getFullYear()+'-'+bulan+'-'+today.getDate());
   				first_loaded = false;
   			}
   		}
    });		
}

function show_J(y){
	var d = $("#selected-day").text();
	var data = y; 
	x = data.split("/"); a = d.split("/");
	if(x[0]=="Standar"){
		$("#jenis_jam").val("standar");
		$("#jam_co").hide(); $("#jam_check_out").val("");
	} else {
		$("#jenis_jam").val("custom")
		$("#jam_co").show(); $("#jam_check_out").val(x[0]);
	}
	$("#check_out").val(a[2]+"-"+a[1]+"-"+a[0]+"/"+x[1]);
}

//on document has loaded succssesfully
$(document).ready(function(){ 
	$("#selected-day").text("Update Timeline ...");
    $.post("../../../croneTask/evaluasi_unit_kotor.php", {update_timeline :""},
    function (data) {
    	$("#selected-day").text("Hari ini");
    	alerti(0,0);
    });	
	
	//geser timeline ke kanan
	$("#rigth-button").click(function(){
		if(week_pos<4 && !onloading){
			resetViewTanggal();
			week_pos++; new_week(week_pos);
			alerti(0,7*(week_pos-1));
			set_selected_index(selected_index, week_pos);
		}
	});

	//geser timeline ke kiri
	$("#left-button").click(function(){
		if(week_pos!=0 && !onloading){
			resetViewTanggal();
			week_pos--; new_week(week_pos);
			alerti(0,7*(week_pos-1));
			set_selected_index(selected_index, week_pos);
		}
	});

	// onclick tanggal
	$(".kotak").click(function(){
		var e = $("#cap-text").text();
		var m = $(this).attr("id");
		var d = get_selected_date(m);
		set_detail_timeline(d);
		$(".selected").removeClass("selected");
		$(this).addClass("selected");
		selected_index = e[25]+"/"+m[6];
	});

	$("#jenis_jam").change(function(){
		if($(this).val()=="standar"){
			$("#jam_co").hide();	
			$('#jam_check_out').removeAttr('required');
		} 
		else {
			$("#jam_co").show();
			$('#jam_check_out').attr({'required': 'required'});
		} 
	});

}); //document ready scope