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

// update profile(other) owner
elseif(isset($_POST['updateother']) && $view='owner'){
  $kd_bank = $_POST['nama'];
  $no_rek = $_POST['no_rek'];
  $proses = new Account($db);
  $add = $proses->updateProfile_owner($kd_owner,'', '', '', '', '', $kd_bank, $no_rek);
  if($add == "Success"){
    header('Location:../view/'.$view.'/profile/profile.php');
  }
}

// Tambah Akun
elseif(isset($_POST['addAccount']) && $view='superadmin/'){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $hak_akses = $_POST['hak_akses'];
  $proses = new Account($db);
  $add = $proses->addAccount($username, $password, $hak_akses);
  if($add == "Success"){
    if($hak_akses=='owner'){
      $add2 = $proses-> addRelasi($username, $_POST['kd_owner']);
      if($add2 == "Success"){
        header('Location:../view/'.$view.'account/account_management.php');
      }
      else die('gagal merelasikan akun');
    } else header('Location:../view/'.$view.'account/account_management.php'); 
  } else die('gagal menambahkan akun');
}

else header('Location:../view/'.$view.'/home/home.php');

?>
