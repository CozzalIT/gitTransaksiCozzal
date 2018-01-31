<?php

require("proses.php");

//cek ketersediaan unit pada tanggal tertentu
if(isset($_POST['id'])){
	$kd_unit = $_POST['id'];
	$CI = $_POST['tci'];
	$CO = $_POST['tco'];
	$hasil = "Tidak Ada";
	$flag = 0;
	$Proses = new Proses();
	$show = $Proses->showTransaksi_cek($CI,$CO,$kd_unit);
	while($data = $show->fetch(PDO::FETCH_OBJ)){
	$flag++;	
	}
	if($flag==0) $hasil = "Ada";
	$callback = array('ketersediaan'=>$hasil); 
	echo json_encode($callback); 
}

//cek ketersediaan informasi detail unit
if(isset($_POST['detail_unit'])){
	$kd_unit = $_POST['detail_unit'];
	$flag = 0; $namaunit = '';
	$hasil = "Ada";
	$Proses = new Proses();
	$show = $Proses->showDetail_Unit($kd_unit);
	while($data = $show->fetch(PDO::FETCH_OBJ)){
	$flag++; 	
	}
	if($flag==0) $hasil = "Tidak Ada";
	$callback = array('ketersediaan'=>$hasil); 
	echo json_encode($callback); 
}

?>
