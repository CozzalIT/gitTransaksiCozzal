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

elseif(isset($_POST['mutasiDana'])){
  $kas_sumber = $_POST['sumber'];
  $kas_tujuan = $_POST['tujuan'];
  $jumlah_mutasi = $_POST['mutasi'];
  $tanggal = date('Y-m-d');

  $proses = new Kas($db);
  $show = $proses->editSaldo($kas_sumber);
  $show1 = $proses->editSaldo($kas_tujuan);
  $data = $show->fetch(PDO::FETCH_OBJ);
  $data1 = $show1->fetch(PDO::FETCH_OBJ);
  $saldo_sumber = $data->saldo - $jumlah_mutasi;
  $saldo_tujuan = $data1->saldo + $jumlah_mutasi;
  $jenis_sumber = 2;
  $jenis_tujuan = 1;
  $keterangan = 1;

  $update_sumber = $proses->updateKas($kas_sumber, $saldo_sumber, $tanggal);
  $update_tujuan = $proses->updateKas($kas_tujuan, $saldo_tujuan, $tanggal);

  if($update_sumber == "Success" && $update_tujuan == "Success"){
    $add_mutasi_sumber = $proses->addMutasiKas($kas_sumber, $jumlah_mutasi, $jenis_sumber, $tanggal, $keterangan);
    $add_mutasi_tujuan = $proses->addMutasiKas($kas_tujuan, $jumlah_mutasi, $jenis_tujuan, $tanggal, $keterangan);
    header('Location:../view/'.$view.'/kas/kas.php');
  }
}

else header('Location:../view/'.$view.'/home/home.php');
?>
