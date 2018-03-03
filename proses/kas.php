<?php
require("../../config/database.php");
require("../class/kas.php");
session_start();
$view = $_SESSION['hak_akses'];

//Tambah Kas
if(isset($_POST['addKas'])){
  $sumber_dana = $_POST['sumber_dana'];
	$saldo = $_POST['saldo'];
  $tanggal = date('Y-m-d');

  $proses = new Kas($db);
  $add = $proses->addKas($sumber_dana, $saldo, $tanggal);

  if($add == "Success"){
    $show = $proses->showLastKas();
    $data = $show->fetch(PDO::FETCH_OBJ);
    $kd_kas = $data->kd_kas;
    $mutasi_dana = $_POST['saldo'];
    $jenis = 1;
    $keterangan = 2;

    $add_mutasi = $proses->addMutasiKas($kd_kas, $mutasi_dana, $jenis, $tanggal, $keterangan);

    if($add_mutasi == "Success"){
	     header('Location:../view/'.$view.'/kas/kas.php');
    }
  }
}

else header('Location:../view/'.$view.'/home/home.php');
?>
