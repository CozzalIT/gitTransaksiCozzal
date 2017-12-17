<?php
  require('../proses_update.php');
  $prosesUpdate = new prosesUpdate();

  if(isset($_POST['updateUnitTransaksi'])){
	$kd_transaksi = '1';
	$kd_apt = $_POST['kd_apt'];
	$kd_unit = $_POST['kd_unit'];
		 
	$update = $prosesUpdate->updateUnitTransaksi($kd_transaksi, $kd_apt, $kd_unit);
	  
	if($update == "Success"){
	  header('Location:../../transaksi.php');
	} else {
	  echo 'error';
	}
  }
?>