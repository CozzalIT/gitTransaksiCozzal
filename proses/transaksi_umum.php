<?php
require("../../config/database.php");
require("../class/transaksi_umum.php");
require("../class/kas.php");
session_start();
$view = $_SESSION['hak_akses'];

//Tambah Transaksi Umum
if(isset($_POST['addTransaksiUmum'])){
	$kd_kas 	= $_POST['kd_kas'];
  if($_POST['kebutuhan'] == 'umum'){
    $kebutuhan = $_POST['kebutuhan'];
  }elseif($_POST['kebutuhan'] != 'umum'){
    $arrayKebutuhan = explode("/",$_POST['kebutuhan']);
    $kd_unit = $arrayKebutuhan[1];
  }
  $harga = $_POST['harga'];
  $jumlah = $_POST['jumlah'];
  $keterangan = $_POST['keterangan'];
  $keterangan_mutasi = 3;
  $tanggal = date('Y-m-d');
  $mutasi_dana = $harga*$jumlah;
  $jenis = 2;

  $proses = new TransaksiUmum($db);
  $proses2 = new Kas($db);
  $add = $proses->addTransaksiUmum($kd_kas, $kebutuhan, $harga, $jumlah, $keterangan, $tanggal);
  if($add == "Success"){
    $edit = $proses2->editSaldo($kd_kas);
    $add_mutasi = $proses2->addMutasiKas($kd_kas, $mutasi_dana, $jenis, $tanggal, $keterangan_mutasi);
    $data = $edit->fetch(PDO::FETCH_OBJ);
    $saldo = $data->saldo - ($harga*$jumlah);
    $update = $proses2->updateKas($kd_kas, $saldo, $tanggal);
    if($add_mutasi == "Failed"){
      echo 'Penambahan Mutasi Dana Gagal!!';
    }elseif($update == "Failed"){
      echo 'Saldo Kas Gagal di Update!!';
    }
    header('Location:../view/'.$view.'/transaksi_umum/laporan_transaksi_umum.php');
  }else{
    echo 'Gagal!!';
	}
}

else header('Location:../view/'.$view.'/home/home.php');
?>
