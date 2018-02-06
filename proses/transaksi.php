<?php
require("../config/database.php");
require("../class/transaksi.php");
session_start();
$view = $_SESSION['hak_akses'];
//Tambah Transaksi
if(isset($_POST['addTransaksi'])){
	$kd_penyewa 	= $_POST['kd_penyewa'];
	$kd_apt 		= $_POST['apartemen'];
	$kode = explode("+",$_POST['unit']);
	$kd_unit 		= $kode[0];
	$tamu 			= $_POST['tamu'];
	$check_in 		= $_POST['check_in'];
	$check_out 		= $_POST['check_out'];
	$harga_sewa 	= $_POST['harga_sewa'];
  $harga_sewa_asli   = $_POST['harga_sewa_asli'];
  $diskon = 0;
  if($harga_sewa<$harga_sewa_asli){
     $diskon = $harga_sewa_asli-$harga_sewa;
  }
	$ekstra_charge 	= $_POST['ekstra_charge'];
	$kd_booking 	= $_POST['booking_via'];
	$kd_bank 		= $_POST['dp_via'];
	$dp 			= $_POST['dp'];
  $total  = $_POST['total'];
  $sisa_pelunasan = $total - $dp;
  $hari = $_POST['jumhari'];
  $tgl_transaksi = date('y-m-d');

  $proses = new Transaksi($db);
  $add = $proses->addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $ekstra_charge, $kd_booking, $kd_bank, $dp, $total, $sisa_pelunasan, $hari, $tgl_transaksi, $diskon);

  if($add == "Success"){
	  header('Location:../view/'.$view.'/transaksi/laporan_transaksi.php');
  }else{
    echo 'gagal';
	}
}

//Tambah Confirm Transaksi
if (isset($_GET['addConfirm'])){
  $kd_transaksi = $_GET['addConfirm'];

  $proses = new Transaksi($db);
  $add = $proses->addConfirm($kd_transaksi);
  if($add == "Success"){
    header('Location:../view/'.$view.'/transaksi/confirm_transaksi.php');
  }
}

//Tambah Penyewa di Halaman Transaksi
if(isset($_POST['addPenyewaTransaksi'])){
  $nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_tlp = $_POST['no_tlp'];
	$jenis_kelamin = $_POST['jenis_kelamin'];

  $proses = new Transaksi($db);
  $add = $proses->addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin);

  $Proses = new Transaksi($db);
  $show = $Proses->showPenyewaTransaksi();
  $data = $show->fetch(PDO::FETCH_OBJ);

  if($add == "Success"){
	  header('Location:../view/'.$view.'/transaksi/transaksi.php?nama='.$nama.'&alamat='.$alamat.'&no_tlp='.$no_tlp.'&jenis_kelamin='.$jenis_kelamin.'&kd_penyewa='.$data->kd_penyewa);
  }
}

//Delete DP Transaksi
if(isset($_GET['delete_transaksi'])){
  $proses = new Transaksi($db);
  $del = $proses->deleteTransaksi($_GET['delete_transaksi']);
  header("location:../view/".$view."/transaksi/laporan_transaksi.php");
}

//update Transaksi
if(isset($_POST['updateTransaksi'])){
  $kd_transaksi = $_POST['kd_transaksi'];
  $kd_apt     = $_POST['apartemen'];
  $kode = explode("+",$_POST['unit']);
  $kd_unit    = $kode[0];
  $tamu       = $_POST['tamu'];
  $check_in     = $_POST['check_in'];
  $check_out    = $_POST['check_out'];
  $harga_sewa   = $_POST['harga_sewa'];
  $harga_sewa_asli   = $_POST['harga_sewa_asli'];
  $diskon = 0;
  if($harga_sewa<$harga_sewa_asli){
    $diskon = $harga_sewa_asli-$harga_sewa;
  }
  $ekstra_charge  = $_POST['ekstra_charge'];
  $kd_booking   = $_POST['booking_via'];
  $kd_bank    = $_POST['dp_via'];
  $dp       = $_POST['dp'];
  $total_tagihan  = $_POST['total'];
  $sisa_pelunasan = $total_tagihan - $dp;
  $hari = $_POST['jumhari'];

  $proses = new Transaksi($db);
  $add = $proses->updateTransaksi($kd_transaksi, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $diskon, $ekstra_charge, $kd_booking, $kd_bank, $dp, $total_tagihan, $sisa_pelunasan, $hari);
  if($add == "Success"){
    header('Location:../view/'.$view.'/transaksi/laporan_transaksi.php');
  } else echo 'error';
}
?>
