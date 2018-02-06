<?php
require("../config/database.php");
require("../class/penyewa.php");
session_start();
$view = $_SESSION['hak_akses'];
//Tambah Penyewa
if(isset($_POST['addPenyewa'])){
  $nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_tlp = $_POST['no_tlp'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
  $email = $_POST['email'];
  $tgl_gabung = date('Y-m-d');

  $proses = new Penyewa($db);
  $add = $proses->addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung);

  if($add == "Success"){
	  header('Location:../view/'.$view.'/penyewa/penyewa.php');
  }
}

//Delete Penyewa
if(isset($_GET['delete_penyewa'])){
  $proses = new Penyewa($db);
  $del = $proses->deletePenyewa($_GET['delete_penyewa']);
  header("location:../view/".$view."/penyewa/penyewa.php");
}

//Update Penyewa
if(isset($_POST['updatePenyewa'])){
	$kd_penyewa = $_POST['kd_penyewa'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $no_tlp = $_POST['no_tlp'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $email = $_POST['email'];

  $proses = new Penyewa($db);
	$update = $proses->updatePenyewa($kd_penyewa, $nama, $alamat, $no_tlp, $jenis_kelamin, $email);

  if($update == "Success"){
  	header('Location:../view/'.$view.'/penyewa/penyewa.php');
  } else {
  	echo 'error';
	}
}
?>
