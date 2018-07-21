	<div class="widget-box" style="margin: 16px;">
     <div class="widget-title"> <span class="icon"> <i class="icon-calendar"></i> </span>
       <h5>Kalender Sistem</h5>
     </div>
     <div class="widget-content nopadding">
       <div class="content-calendar notlast" style="border-bottom: 1px solid #C9C9C9;">
       	<label class="control-label">URL Cozzal :</label>
       	<div class="url-link"><?php echo $cal_cozzal; ?></div>
       	<?php
       		if($cal_cozzal[0]!="<"){
       			echo '
		     	<a class="btn btn-small" onclick="tambahURL()" href="#popup-URL" data-toggle="modal" style="margin: 5px;" ><i class="iconM icon-plus"></i>Tambah URL</a>        			
		       	<a class="btn btn-small" onclick="refreshSys()" style="margin: 5px;" ><i  id="sys_icon" class="iconM icon-refresh"></i>Refresh URL cozzal</a> 
		       	<a class="btn btn-small" onclick="refreshAll()" style="margin: 5px;" ><i id="sys_icon2" class="iconM icon-repeat"></i>Refresh semua URL</a> 
       			';
       		}
       	?>
       </div>      
     </div>
    </div>

	<div class="widget-box" style="margin: 16px;">
     <div class="widget-title"> <span class="icon"> <i class="icon-link"></i> </span>
       <h5>URL Lainnya</h5>
     </div>

     <?php
     	$count = 0;
	    $cal = $ics_unit->showURL($kd_unit, "1"); // tampilkan URL non sistem
	    while($data = $cal->fetch(PDO::FETCH_OBJ)){
	      echo '
		     <div class="widget-content nopadding">
		       <div class="content-calendar notlast" style="border-bottom: 1px solid #C9C9C9;">
		       	<label class="control-label">URL '.$data->title.' :</label>
		       	<div class="url-link">'.$data->url.'</div>
		       	<a class="btn btn-small" href="#popup-URL" data-toggle="modal" onclick="editURL('.$data->kd_url.')" style="margin: 5px;" ><i class="iconM icon-edit"></i>Edit URL</a> 
		       	<a class="btn btn-small" onclick="refreshURL('.$data->kd_url.')" style="margin: 5px;" ><i id="'.$data->kd_url.'" class="iconM icon-refresh"></i>Refresh URL</a> 
		       	<a class="btn btn-small" onclick="hapusURL('.$data->kd_url.')" style="margin: 5px;" ><i class="iconM icon-remove"></i>Hapus URL</a> 
		       </div>       
		     </div>
	      ';
	      $count++;
	    }

	    if($count==0){
	    	echo '
		     <div class="widget-content nopadding">
		     	<div class="content-calendar notlast" style="border-bottom: 1px solid #C9C9C9;">
					Tidak ada URL kalender lainnya yang terdaftar.  
				</div>    
		     </div>
	    	';
	    }
     ?>
    </div>

	<style type="text/css">
		.content-calendar{
			padding: 10px;
		}
		.url-link{
			padding: 5px; 
			background-color: #EFEFEF;
			color: black;
			overflow-x: auto;
			max-width: 100%;
			border: 1px solid grey;
			border-radius: 4px;
		}
		.iconM{
			margin-right: 5px;
		}
		#drop-sel,#apartement-dropdown{
			width: 80%;
			border: 1px solid #D5D1D1;
			padding: 5px;
			background-color: #FCFCFC;
			cursor: pointer;
		}
		#drop-sel:hover{
			box-shadow: 2px 2px 4px #D5D1D1;
		}
		#apartement-dropdown{
			width: 60%;
			max-height: 200px;
			overflow-y: auto;
			z-index: 9999;
			position: absolute;

		}
		.content-dropdown{
		    color: black;
		    padding: 8px 6px;
		    text-decoration: none;
		    display: block;
		}
		.selected-drop{
		    background-color: black;
		    color: white;
		    padding: 8px 6px;
		    text-decoration: none;
		    display: block;
		}		
		.content-dropdown:hover{
			background-color: #D5D1D1;
			box-shadow: 2px 2px 4px #D5D1D1;
			text-decoration: none;
			color : black;
		}	
		#keyword{
			margin: 8px 6px;
			width: 90%;	
		}	
		.hide-dropdown{
			display: none;
		}
		.show-dropdown{
			display: block;
		}
	</style>
	<script type="text/javascript">
		
		var kd_unit = <?php echo $kd_unit.";"; ?>
		var kd_apt = <?php echo $kd_apt.";"; ?>
		var kd_url = 0;

		var url_bnb = $("#url-bnb").text();

		$("#sel-"+kd_unit).attr("class","content-dropdown selected-drop");
		$("#sel-"+kd_unit).attr("href","#");

		function triger(){
			document.getElementById("apartement-dropdown").classList.toggle("show-dropdown");	
		}

		function tambahURL(){
			kd_url = 0;
			$("#nama_url").val("");
			$("#url").val("");
			$("#group_update").val("");		
		}

		function editURL(x){ // x adalah representasi dari kd_url
			kd_url = x;
			$("#url-cap").text("Memuat ...");
			$("#nama_url").val("");
			$("#url").val("");
			$("#group_update").val("");
			$("#group_update").removeAttr("required");	
			$.post("../../../proses/calendar.php", {showKd_url : x},
			function (data) {
				var response = JSON.parse(data);
				$("#nama_url").val(response.title);
				$("#url").val(response.url);
			});	
		}

		function filter() {
	  		var input, filter, ul, li, a, i;
	  		input = document.getElementById("keyword");
	  		filter = input.value.toUpperCase();
	  		a = $(".content-dropdown");
	  		for (i = 0; i < a.length; i++) {
		    	if (a[i].innerHTML.toUpperCase().indexOf(filter)>=0) {
		      	a[i].style.display = "";
			    } else {
			       a[i].style.display = "none";
			    }
		    }
		}

		function refreshURL(id_url){
			$("#"+id_url).attr("class","iconM icon-repeat");
			$.post("../../../proses/ics.php", {
				generateSome : kd_unit, 
				kd_apt : kd_apt,
				kd_url : id_url
			},
			function (data) {
				//alert(data);
				$("#"+id_url).attr("class","iconM icon-ok");				
				window.location = "calendar.php?calendar_unit="+kd_unit;
			});				
		} 

		function refreshSys(){
			$("#sys_icon").attr("class","iconM icon-repeat");
			$.post("../../../croneTask/update_sys_cal.php", {
				generateSys : kd_unit, 
			},
			function (data) {
				//alert(data);
				$("#sys_icon").attr("class","iconM icon-ok");				
				window.location = "calendar.php?calendar_unit="+kd_unit;
			});				
		} 

		function refreshAll(){
			$("#sys_icon2").attr("class","iconM icon-refresh");
			$.post("../../../proses/ics.php", {
				generateAll : kd_unit, 
				kd_apt : kd_apt,
			},
			function (data) {
				$.post("../../../croneTask/update_sys_cal.php", {
					generateSys : kd_unit, 
				},
				function (data) {
					//alert(data);
					$("#sys_icon2").attr("class","iconM icon-ok");				
					window.location = "calendar.php?calendar_unit="+kd_unit;
				});	
			});				
		} 		

		function hapusURL(x){
			window.location = "../../../proses/calendar.php?deleteURL="+x+"&kd_unit="+kd_unit;
		}

		// menambahkan beberapa value pada form saat submit form CRUD URL
		function insertURLid(){
			$("#url_Form").append('<input style="display:none" name="kd_unit" type="text" value="'+kd_unit+'"/>');
			if(kd_url!=0){
				$("#url_Form").append('<input style="display:none" name="kd_url" type="text" value="'+kd_url+'"/>');
				$("#submitURL").attr("name","updateURL");
			}
		}
	</script>