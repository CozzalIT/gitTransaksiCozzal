<?php
if(isset($_GET['request'])){
	$kd_unit = $_GET['request'];
	require("../../config/database.php");
	require("../class/unit.php");
	$unit = new Unit($db);
	$show = $unit->editUnit($kd_unit);
	$data = $show->fetch(PDO::FETCH_OBJ);
	$no_unit = explode(" ", $data->no_unit);
	$nama_apt = explode(" ", $data->nama_apt);
	$namafile = implode("", $no_unit)."_".implode("", $nama_apt).".ics";
	header('Content-Type: text/calendar; charset=utf-8');
	header("Content-Disposition: attachment; filename=$namafile");
	$filesumber = "../../listics/$kd_unit.ics";
	$myfile = fopen($filesumber, "r") or die("Unable to open file!");
	$isifile = fread($myfile,filesize($filesumber));
	echo $isifile;
} else {
	header("location:../index.php");
}
?>