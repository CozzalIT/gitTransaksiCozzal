<?php

require("proses.php");

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
?>
