	<div class="widget-box" style="margin: 16px;">
     <div class="widget-title"> <span class="icon"> <i class="icon-calendar"></i> </span>
       <h5>Sinkronisasi Kalender</h5>
     </div>
     <div class="widget-content nopadding">
       <div class="content-calendar notlast" style="border-bottom: 1px solid #C9C9C9;">
       	<label class="control-label">URL Cozzal :</label>
       	<div class="url-link"><?php echo $cal_cozzal; ?></div>
       </div>
       <div class="content-calendar">
       	<label class="control-label">URL Airbnb :</label>
       	<div class="url-link" id="url-bnb"><?php echo $cal_bnb; ?></div> 
       <?php
       echo '
		 <a class="btn btn-small" href="edit.php?edit_url='.$kd_unit.'" style="margin: 5px;" ><i class="iconM icon-edit"></i>Edit URL Airbnb</a>  
       ';
       if($cal_bnb!="Belum Tersedia"){
	        echo '
		 <a onclick="refresh()" class="btn btn-small"><i class="iconM icon-repeat"></i>Refresh</a>
	       ';      	
       }
       ?>       	    	
       </div>       
     </div>
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
		#nganu,#apartement-dropdown{
			width: 80%;
			border: 1px solid #D5D1D1;
			padding: 5px;
			background-color: #FCFCFC;
			cursor: pointer;
		}
		#nganu:hover{
			box-shadow: 2px 2px 4px #D5D1D1;
		}
		#apartement-dropdown{
			width: 60%;
			max-height: 200px;
			overflow-y: auto;
			top: 30%;
			left: 24%;
			z-index: 9999;
			position: fixed;

		}
		.content-dropdown{
		    color: black;
		    padding: 8px 6px;
		    text-decoration: none;
		    display: block;
		}
		.content-dropdown-selected{
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
		var url_bnb = $("#url-bnb").text();

		$("#sel-"+kd_unit).attr("class","content-dropdown-selected");

		function triger(){
			document.getElementById("apartement-dropdown").classList.toggle("show-dropdown");	
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

		function refresh(){
			$(".icon-repeat").attr("class","iconM icon-refresh");
			$.post("../../../ics/generate2.php", {
				cek_by_id : kd_unit, 
				kd_apt : kd_apt, 
				url_bnb : url_bnb
			},
			function (data) {
				$(".icon-refresh").attr("class","iconM icon-ok");				
				window.location = "calendar.php?calendar_unit="+kd_unit;
			});				
		} 

	</script>