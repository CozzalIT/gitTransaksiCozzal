<?php
require("../../config/database.php");
require("../class/transaksi.php");
require("../class/penyewa.php");
session_start();
$view = $_SESSION['hak_akses'];

function getDisCount($harga_sewa, $harga_sewa_we, $harga_sewa_asli, $wd, $we, $total){
  $harga_asli = explode("/", $harga_sewa_asli);
  if(($harga_sewa+$harga_sewa_we)<($harga_asli[0]+$harga_asli[1])){ //0 = weekday, 1 = weekend
     return ($harga_asli[0]*$wd)+($harga_asli[1]*$we)-$total;
  }else {
    return ($harga_sewa*$wd)+($harga_sewa_we*$we)-$total;
  } 
}

function isNew($date){
  if(strtotime($date)>=strtotime((date('Y-m-d')))) return true;
  else return false;
}

function startinweekend($hari, $week, $jumlah_weekday, $jumlah_weekend){
  $we =0; $wd = $hari+5;
  while($wd>5){
    $we = 8-$week; $hari = $wd-5;
    if($hari==1) $we=1; $wd=$hari-$we; 
    $jumlah_weekend = $jumlah_weekend+$we; 
    if($wd>5) $jumlah_weekday = $jumlah_weekday+5; else $jumlah_weekday = $jumlah_weekday+$wd;     
  }
  return $jumlah_weekday."/".$jumlah_weekend;
}

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
  $harga_sewa_we = $_POST['harga_sewa_we'];
  $harga_sewa_asli   = $_POST['harga_sewa_asli'];
	$ekstra_charge 	= $_POST['ekstra_charge'];
	$kd_booking 	= $_POST['booking_via'];
	$kd_bank 		= $_POST['dp_via'];
	$dp 			= $_POST['dp'];
  $total  = $_POST['total'];
  $sisa_pelunasan = $total - $dp;
  $hari = $_POST['jumhari'];
  $tgl_transaksi = date('y-m-d');
  $week = date("w",strtotime($check_in))+1;
  if($week>5){ //jika dimuai dari weekend
    $week_kind = explode("/",startinweekend($hari, $week, 0, 0));
    $jumlah_weekday = $week_kind[0]; $jumlah_weekend = $week_kind[1]; 
  }
  else{ //jika dimulai dri weekday
    if($week+$hari<7) {$jumlah_weekday=$hari;$jumlah_weekend=0;}
    else {
      $wd = 6 - $week;
      $week_kind = explode("/",startinweekend($hari-$wd, 6, $wd, 0));
      $jumlah_weekday = $week_kind[0]; $jumlah_weekend = $week_kind[1]; 
    }
  }
  $harga_asli = explode("/", $harga_sewa_asli);
  if($total<(($harga_asli[0]*$jumlah_weekday)+($harga_asli[1]*$jumlah_weekend))) $diskon = getDisCount($harga_sewa, $harga_sewa_we, $harga_sewa_asli, $jumlah_weekday, $jumlah_weekend, $total);
  else $diskon = 0;
  $proses = new Transaksi($db);
  $add = $proses->addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $check_in, $check_out, $jumlah_weekend, $jumlah_weekday, $hari, $harga_sewa, $harga_sewa_we, $tgl_transaksi, $diskon, $ekstra_charge, $kd_bank, $tamu, $kd_booking, $dp, $total, $sisa_pelunasan);
  if($add == "Success"){
    if(isNew($check_in)) $add2 = $proses->addUnit_kotor($kd_unit, $check_in, $check_out);
	  header('Location:../view/'.$view.'/transaksi/laporan_transaksi.php');
  }else{
    echo 'gagal';
	}
}

//Move (Dari booking ke transaksi) Transaksi
elseif(isset($_POST['moveTransaksi'])){
//namabah penyewa dulu
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $no_tlp = $_POST['no_tlp'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $email = $_POST['email'];
  $tgl_gabung = date('Y-m-d');
  $proses2 = new Penyewa($db);
  $add2 = $proses2->addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung);
//baru namabah trx
  $proses = new Transaksi($db);
  $show = $proses->showPenyewaTransaksi();
  $penyewa = $show->fetch(PDO::FETCH_OBJ);
  $kd_penyewa = $penyewa->kd_penyewa;
  $kd_reservasi = $_POST['kd_reservasi'];
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
  $total  = $_POST['total'];
  $sisa_pelunasan = $total - $dp;
  $hari = $_POST['jumhari'];
  $tgl_transaksi = date('y-m-d');
  if($total<$harga_sewa_asli*$hari){
     $diskon = $harga_sewa_asli*$hari-$total;
  }
  $add = $proses->addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $ekstra_charge, $kd_booking, $kd_bank, $dp, $total, $sisa_pelunasan, $hari, $tgl_transaksi, $diskon);
  if($add == "Success"){
    $delete = $proses->deleteReservasi($kd_reservasi);
    $add2 = $proses->addUnit_kotor($kd_unit, $check_in, $check_out);
    header('Location:../view/'.$view.'/transaksi/laporan_transaksi.php');
  }else{
    echo 'gagal';
  }
}

//Tambah Pembayaran
elseif(isset($_POST['addPembayaran'])){
	$Proses = new Transaksi($db);
	$show	= $Proses->editTransaksi($_POST['kd_transaksi']);
	$data = $show->fetch(PDO::FETCH_OBJ);

	$kd_transaksi = $_POST['kd_transaksi'];
	$sisa_pelunasan_lama = $_POST['sisa_pelunasan'];
	$pembayaran_lama = $data->pembayaran;
	$pembayaran_masuk = $_POST['pembayaran'];
	$pembayaran_baru = $pembayaran_lama + $pembayaran_masuk;
	$sisa_pelunasan = $sisa_pelunasan_lama - $pembayaran_masuk;

  $add = $Proses->addPembayaran($kd_transaksi, $pembayaran_baru, $sisa_pelunasan);
  if($add == "Success"){
    header('Location:../view/'.$view.'/transaksi/laporan_transaksi.php?pembayaran='.$kd_transaksi);
  } else echo 'error';
}

//Tambah Penyewa di Halaman Transaksi
elseif(isset($_POST['addPenyewaTransaksi'])){
  $nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_tlp = $_POST['no_tlp'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$email = $_POST['email'];
	$tgl_gabung = date('y-m-d');

  $proses = new Penyewa($db);
  $add = $proses->addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung);

  $Proses = new Transaksi($db);
  $show = $Proses->showPenyewaTransaksi();
  $data = $show->fetch(PDO::FETCH_OBJ);

  if($add == "Success"){
	  header('Location:../view/'.$view.'/transaksi/transaksi.php?nama='.$nama.'&alamat='.$alamat.'&no_tlp='.$no_tlp.'&jenis_kelamin='.$jenis_kelamin.'&kd_penyewa='.$data->kd_penyewa);
  }
}

//update Transaksi
elseif(isset($_POST['updateTransaksi'])){
  $kd_transaksi = $_POST['kd_transaksi'];
  $kd_apt     = $_POST['apartemen'];
  $kode = explode("+",$_POST['unit']);
  $kd_unit    = $kode[0];
  $tamu       = $_POST['tamu'];
  $check_in     = $_POST['check_in'];
  $check_out    = $_POST['check_out'];
  $harga_sewa   = $_POST['harga_sewa'];
  $harga_sewa_we   = $_POST['harga_sewa_we'];
  $harga_sewa_asli   = $_POST['harga_sewa_asli'];
  $ekstra_charge  = $_POST['ekstra_charge'];
  $kd_booking   = $_POST['booking_via'];
  $kd_bank    = $_POST['dp_via'];
  $dp       = $_POST['dp'];
  $total_tagihan  = $_POST['total'];
  $sisa_pelunasan = $total_tagihan - $dp;
  $hari = $_POST['jumhari'];
  $week = date("w",strtotime($check_in))+1;
  if($week>5){ //jika dimuai dari weekend
    $week_kind = explode("/",startinweekend($hari, $week, 0, 0));
    $jumlah_weekday = $week_kind[0]; $jumlah_weekend = $week_kind[1]; 
  }
  else{ //jika dimulai dri weekday
    if($week+$hari<7) {$jumlah_weekday=$hari;$jumlah_weekend=0;}
    else {
      $wd = 6 - $week;
      $week_kind = explode("/",startinweekend($hari-$wd, 6, $wd, 0));
      $jumlah_weekday = $week_kind[0]; $jumlah_weekend = $week_kind[1]; 
    }
  }
  $harga_asli = explode("/", $harga_sewa_asli);
  if($total_tagihan<(($harga_asli[0]*$jumlah_weekday)+($harga_asli[1]*$jumlah_weekend))) $diskon = getDisCount($harga_sewa, $harga_sewa_we, $harga_sewa_asli, $jumlah_weekday, $jumlah_weekend, $total_tagihan);
  else $diskon = 0;
  $proses = new Transaksi($db);
  $update = $proses->updateUnit_kotor($kd_transaksi ,$kd_unit, $check_in, $check_out);
  $add = $proses->updateTransaksi($kd_transaksi, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $diskon, $ekstra_charge, $kd_booking, $kd_bank, $dp, $total_tagihan, $sisa_pelunasan, $hari, $jumlah_weekend, $jumlah_weekday);
  if($add == "Success"){
    header('Location:../view/'.$view.'/transaksi/laporan_transaksi.php');
  } else echo 'error';
}

//Delete Transaksi
elseif(isset($_GET['delete_transaksi']) && ($view=="superadmin" || $view=="manager")){
  $proses = new Transaksi($db);
  $delete = $proses->deleteUnit_kotor($_GET['delete_transaksi']);
  $del = $proses->deleteTransaksi($_GET['delete_transaksi']);
  header("location:../view/".$view."/transaksi/laporan_transaksi.php");
}

//Delete Confirm Transaksi
elseif(isset($_GET['delete_confirm_transaksi']) && ($view=="superadmin" || $view=="manager")){
  $proses = new Transaksi($db);
  $del = $proses->deleteConfirmTransaksi($_GET['delete_confirm_transaksi']);
  header("location:../view/superadmin/transaksi/confirm_transaksi.php");
}

//Tambah Confirm Transaksi
elseif (isset($_GET['addConfirm']) && $view!="owner" && $view!="cleaner"){
  $kd_transaksi = $_GET['addConfirm'];
  $proses = new Transaksi($db);
  $add = $proses->addConfirm($kd_transaksi);
  if($add == "Success"){
    header('Location:../view/'.$view.'/transaksi/confirm_transaksi.php');
  }
}

else header('Location:../view/'.$view.'/home/home.php');
?>
