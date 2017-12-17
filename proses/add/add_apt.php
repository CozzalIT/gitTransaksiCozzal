<?php
  require('../proses_add.php');
  $prosesAdd = new prosesAdd();

  if(isset($_POST['addApartemen'])){
	$nama_apt = $_POST['nama_apt'];
	$alamat_apt = $_POST['alamat_apt'];

  $add = $prosesAdd->addApartemen($nama_apt, $alamat_apt);

  if($add == "Success"){
	header('Location:../../apartemen.php');
  }
}
?>
