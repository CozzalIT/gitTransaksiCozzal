<?php
  require('../proses_update.php');
  $prosesUpdate = new prosesUpdate();

  if(isset($_POST['updateApartemen'])){
	$kd_apt = $_POST['kd_apt'];
    $nama_apt = $_POST['nama_apt'];
	$alamat_apt = $_POST['alamat_apt'];
		 
	$update = $prosesUpdate->updateApartemen($kd_apt, $nama_apt, $alamat_apt);
	  
	if($update == "Success"){
	  header('Location:../../apartemen.php');
	} else {
	  echo 'error';
	}
  }
?>