<?php
require("../config/database.php");
require("../class/account.php");
session_start();
$view = $_SESSION['hak_akses'];
if($view=='owner') $kd_owner = $_SESSION['pemilik'];

// Update profile(info basic) owner
if(isset($_POST['updateinfo']) && $view='owner'){
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $no_tlp = $_POST['no_tlp'];
  $email  = $_POST['email'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $proses = new Account($db);
  $add = $proses->updateProfile_owner($kd_owner ,$nama, $alamat, $no_tlp, $email, $jenis_kelamin,'','');
  if($add == "Success"){
    header('Location:../view/'.$view.'/profile/profile.php');
  }
}

elseif(isset($_POST['updateother']) && $view='owner'){
  $kd_bank = $_POST['nama'];
  $no_rek = $_POST['no_rek'];
  $proses = new Account($db);
  $add = $proses->updateProfile_owner($kd_owner,'', '', '', '', '', $kd_bank, $no_rek);
  if($add == "Success"){
    header('Location:../view/'.$view.'/profile/profile.php');
  }
}

else header('Location:../view/'.$view.'/home/home.php');

?>
