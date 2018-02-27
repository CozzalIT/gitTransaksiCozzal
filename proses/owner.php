<?php
require("../../config/database.php");
require("../class/owner.php");
session_start();
$view = $_SESSION['hak_akses'];

//Update Owner
if(isset($_POST['updateOwner'])){
	$nama= $_POST['nama'];
	$alamat= $_POST['alamat'];
	$no_tlp= $_POST['no_tlp'];
	$kd_bank= $_POST['kd_bank'];
	$no_rek= $_POST['no_rek'];
	$kd_owner= $_POST['kd_owner'];
	$email= $_POST['email'];
	$jenis_kelamin= $_POST['jenis_kelamin'];

  $proses = new Owner($db);
  $add = $proses->updateOwner($kd_owner ,$nama, $alamat, $no_tlp, $kd_bank, $no_rek, $email, $jenis_kelamin);

  if($add == "Success"){
	  header('Location:../view/'.$view.'/owner/owner.php');
  } else echo 'error';
}

//Tambah Owner
elseif(isset($_POST['addOwner'])){
	$nama= $_POST['nama'];
	$alamat= $_POST['alamat'];
	$no_tlp= $_POST['no_tlp'];
	$kd_bank= $_POST['kd_bank'];
	$no_rek= $_POST['no_rek'];
	$tgl_gabung= date('y-m-d');
	$email= $_POST['email'];
	$jenis_kelamin= $_POST['jenis_kelamin'];

    $proses = new Owner($db);
    $add = $proses->addOwner($nama, $alamat, $no_tlp, $kd_bank, $no_rek, $tgl_gabung, $email, $jenis_kelamin);

    if($add == "Success"){
      header('Location:../view/'.$view.'/owner/owner.php');
    }
  	else echo 'error';
}

//Delete Owner
elseif(isset($_GET['delete_owner']) && ($view=="superadmin" || $view=="manager")){
  $proses = new Owner($db);
	$del = $proses->deleteOwner($_GET['delete_owner']);
	header("Location:../view/".$view."/owner/owner.php");
}

else header('Location:../view/'.$view.'/home/home.php');
?>
