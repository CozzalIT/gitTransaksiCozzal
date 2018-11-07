<?php
	
	ob_start();
	if(isset($_GET['id']) || $_POST['generateSys']){
		require("../../config/database.php");
		require("../class/ics_unit.php");
		if(isset($_GET['id'])){
			$kd_unit = str_replace("x", "/",$_GET['id']);
		} else {
			$kd_unit = $_POST['generateSys'];
		}
		$unit = new Ics_unit($db);
		$unit->buildIcs($kd_unit);

	$callback = array('status'=>'done');
	echo json_encode($callback);

		if(isset($_GET['ics_update'])){
			$view = $_GET['ics_update'];
			$page = str_replace("%", ".", $_GET['page']);
			header("Location:../view/".$view.'/'.$page);
		}
	} 
?>