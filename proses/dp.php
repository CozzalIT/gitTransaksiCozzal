<?php
require("../config/database.php");
require("../class/dp_via.php");

//Tambah DP Via
if(isset($_POST['addDp_via'])){
  $kd_bank = $_POST['kd_bank'];
	$nama_bank= $_POST['nama_bank'];

  $proses = new dpVia($db);
  $add = $proses->addDp_via($kd_bank, $nama_bank);

  if($add == "Success"){
	  header('Location:../view/superadmin/dp/dp_via.php');
  }
}

//Delete DP Via
if(isset($_GET['delete_dp'])){
  $proses = new dpVia($db);
  $del = $proses->deleteDp_via($_GET['delete_dp']);
  header("location:../view/superadmin/dp/dp_via.php");
}

//Update Bank (DP Via)
if(isset($_POST['updateBank'])){
  $kd_bank = $_POST['kd_bank'];
  $nama_bank = $_POST['nama_bank'];

  $proses = new dpVia($db);
  $update = $proses->updateBank($kd_bank, $nama_bank);

  if($update == "Success"){
  	header('Location:../view/superadmin/dp/dp_via.php');
  } else {
  	echo 'error';
  }
}
?>
