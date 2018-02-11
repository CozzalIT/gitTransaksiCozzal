<?php
require("../config/database.php");
require("../class/apartemen.php");
session_start();
$view = $_SESSION['hak_akses'];

//Update Apartemen
if(isset($_POST['updateApartemen'])){
  $kd_apt = $_POST['kd_apt'];
  $nama_apt = $_POST['nama_apt'];
  $alamat_apt = $_POST['alamat_apt'];

  $proses = new Apartemen($db);
  $update = $proses->updateApartemen($kd_apt, $nama_apt, $alamat_apt);

  if($update == "Success"){
    header('Location:../view/'.$view.'/apartemen/apartemen.php');
  }else{
    echo 'error';
  }
}

//Tambah Apartemen
elseif(isset($_POST['addApartemen'])){
  $nama_apt = $_POST['nama_apt'];
  $alamat_apt = $_POST['alamat_apt'];

  $proses = new Apartemen($db);
  $add = $proses->addApartemen($nama_apt, $alamat_apt);

  if($add == "Success"){
    header('Location:../view/'.$view.'/apartemen/apartemen.php');
      }
    }

//Delete Apartemen
elseif(isset($_GET['delete_apt'])&&($view=="superadmin" || $view=="manager")){
  $proses = new Apartemen($db);
  $del = $proses->deleteApartemen($_GET['delete_apt']);
  header("location:../view/".$view."/apartemen/apartemen.php");
}

else header('Location:../view/'.$view.'/home/home.php');
?>
