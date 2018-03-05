<?php
require("../../config/database.php");
require("../class/transaksi_umum.php");
require("../class/kas.php");
session_start();
$view = $_SESSION['hak_akses'];

//Tambah Transaksi Umum
if(isset($_POST['addTransaksiUmum'])){
	if(isset($_POST['apartemen'])){
		$kd_apt = $_POST['apartemen'];
		if(isset($_POST['unit'])){
			$kd_unit = $_POST['unit'];
			$kd_unit_real = explode("+",$kd_unit);
		}
	}

  if(isset($_POST['kebutuhan'])){
    $kebutuhan = $_POST['kebutuhan'];
  }else{
		$kebutuhan = "unit/".$kd_unit_real[0];
  }

	$kd_kas = $_POST['kd_kas'];
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
  }elseif($add == "Failed"){
    echo 'Proses Gagal!!';
	}
}

else header('Location:../view/'.$view.'/home/home.php');
?>
