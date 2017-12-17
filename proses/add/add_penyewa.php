<?php
  require('../proses_add.php');
  $prosesAdd = new prosesAdd();
  
  if(isset($_POST['addPenyewa'])){
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_tlp = $_POST['no_tlp'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
 
  $add = $prosesAdd->addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin);
  
  if($add == "Success"){
	header('Location:../../penyewa.php');
  }
}
?>