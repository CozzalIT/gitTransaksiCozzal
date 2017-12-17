<?php
  require('../proses_update.php');
  $prosesUpdate = new prosesUpdate();

  if(isset($_POST['updatePenyewa'])){
	$kd_penyewa = $_POST['kd_penyewa'];
    $nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_tlp = $_POST['no_tlp'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
		 
	$update = $prosesUpdate->updatePenyewa($kd_penyewa, $nama, $alamat, $no_tlp, $jenis_kelamin);
	  
	if($update == "Success"){
	  header('Location:../../penyewa.php');
	} else {
	  echo 'error';
	}
  }
?>