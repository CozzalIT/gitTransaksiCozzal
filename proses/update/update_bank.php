<?php
  require('../proses_update.php');
  $prosesUpdate = new prosesUpdate();

  if(isset($_POST['updateBank'])){
	$kd_bank = $_POST['kd_bank'];
    $nama_bank = $_POST['nama_bank'];
		 
	$update = $prosesUpdate->updateBank($kd_bank, $nama_bank);
	  
	if($update == "Success"){
	  header('Location:../../dp_via.php');
	} else {
	  echo 'error';
	}
  }
?>