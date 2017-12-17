<?php
  require('../proses_add.php');
  $prosesAdd = new prosesAdd();
  
  if(isset($_POST['addDp_via'])){
	$kd_bank = $_POST['kd_bank'];
	$nama_bank= $_POST['nama_bank'];
	
  $add = $prosesAdd->addDp_via($kd_bank, $nama_bank);
  
  if($add == "Success"){
	header('Location:../../dp_via.php');
  }
}
?>