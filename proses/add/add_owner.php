<?php

  
  if(isset($_POST['add_owner'])){
	$kd_apt = $_POST['kd_bank'];
	$nama_bank= $_POST['nama_bank'];
	
  require('../proses_add.php');
  $prosesAdd = new prosesAdd();	
  $add = $prosesAdd->add_owner($kd_apt, $nama, $alamat, $no_tlp, $kd_bank, $no_rek, $tgl_gabung);
  
  if($add == "Success"){
	header('Location:../../dp_via.php');
  }
}
?>