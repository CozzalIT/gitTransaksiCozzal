<?php
require("../../config/database.php");
require("../class/transaksi.php");
require("../class/unit.php");
require("../class/owner.php");
require("../class/fcm.php");
require("../class/kas.php");
require("../class/penyewa.php");

// date_default_timezone_set('Asia/Jakarta');
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
  if(strtotime($date)>=strtotime((date('Y-m-d')))){
    return true;
  }else{
    return false;
  }
}

function startinweekend($hari, $week, $jumlah_weekday, $jumlah_weekend){
  $we =0; $wd = $hari+5;
  while($wd>5){
    $we = 8-$week; $hari = $wd-5;
    if($hari==1){
      $we=1;
    }
    $wd=$hari-$we;
    $jumlah_weekend = $jumlah_weekend+$we;
    if($wd>5) {
      $jumlah_weekday = $jumlah_weekday+5;
    } else{
      $jumlah_weekday = $jumlah_weekday+$wd;
    }
  }
  return $jumlah_weekday."/".$jumlah_weekend;
}

//Tambah Transaksi
if(isset($_POST['addTransaksi']) || isset($_POST["Transaksi_booked"])){
	$kd_penyewa = $_POST['kd_penyewa'];
	$kd_apt = $_POST['apartemen'];
	$tamu = $_POST['tamu'];
	$check_in = $_POST['check_in'];
	$check_out = $_POST['check_out'];
	$harga_sewa = $_POST['harga_sewa'];
  $harga_sewa_we = $_POST['harga_sewa_we'];
  $harga_sewa_gbg = $_POST['harga_sewa_gbg'];
  $harga_sewa_asli = $_POST['harga_sewa_asli'];
	$ekstra_charge = $_POST['ekstra_charge'];
	$kd_booking = $_POST['booking_via'];
	$kd_kas = $_POST['kas'];
	$dp = $_POST['dp'];
  $total  = $_POST['total'];
  $total_harga_owner = $_POST['total_harga_owner'];
  $sisa_pelunasan = $total - $dp;
  $hari = $_POST['jumhari'];
  $tgl_transaksi = date('y-m-d H:i:s');
  $tanggal = date('y-m-d H:i:s');
  $week = date("w",strtotime($check_in))+1;
  if(isset($_POST["Transaksi_booked"])){
    $kd_unit = $_POST['unit'];
  } else {
    $kode = explode("+",$_POST['unit']);
    $kd_unit = $kode[0];
  }
  $catatan = $_POST['catatan'];
  $deposit = $_POST['deposit'];

  $proses_u = new Unit($db);
  $show_u = $proses_u->editUnit($kd_unit);
  $data_u = $show_u->fetch(PDO::FETCH_OBJ);
  $h_owner_wd = $data_u->h_owner_wd;
  $h_owner_we = $data_u->h_owner_we;
  $kd_owner = $data_u->kd_owner;
  //$h_owner_mg = $data_u->h_owner_mg;
  //$h_owner_bln = $data_u->h_owner_bln;

  if($week>5){ //jika dimulai dari weekend
    $week_kind = explode("/",startinweekend($hari, $week, 0, 0));
    $jumlah_weekday = $week_kind[0]; $jumlah_weekend = $week_kind[1];
  }else{ //jika dimulai dri weekday
    if($week+$hari<7){
      $jumlah_weekday=$hari;$jumlah_weekend=0;
    }else{
      $wd = 6 - $week;
      $week_kind = explode("/",startinweekend($hari-$wd, 6, $wd, 0));
      $jumlah_weekday = $week_kind[0];
      $jumlah_weekend = $week_kind[1];
    }
  }

  $harga_asli = explode("/", $harga_sewa_asli);
  if($total<(($harga_asli[0]*$jumlah_weekday)+($harga_asli[1]*$jumlah_weekend))){
    $diskon = getDisCount($harga_sewa, $harga_sewa_we, $harga_sewa_asli, $jumlah_weekday, $jumlah_weekend, $total);
  }else{
    $diskon = 0;
  }

  $proses = new Transaksi($db);
  $proses2 = new Kas($db);
  $proses_o = new Owner($db);
  $proses_f = new fcm($db);

  $add_transaksi = $proses->addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $check_in, $check_out, $jumlah_weekend, $jumlah_weekday, $hari, $harga_sewa, $harga_sewa_we, $harga_sewa_gbg, $tgl_transaksi, $diskon, $ekstra_charge, $kd_kas, $tamu, $kd_booking, $dp, $total, $total_harga_owner, $sisa_pelunasan, 1, $h_owner_wd, $h_owner_we,$catatan, $deposit);

  if(isset($_POST["Transaksi_booked"])){
    $proses->deleteBooked_list($_POST["kd_booked"], $check_in, $kd_unit);
  } else {
    $proses->addUnit_kotor($kd_unit, $check_in, $check_out);
  }

  if($add_transaksi == "Success"){
    $show_o = $proses_o->editOwner($kd_owner);
    $data_o = $show_o->fetch(PDO::FETCH_OBJ);
    $username = $data_o->username;

    $show_f = $proses_f->showToken($username);
    $data_f = $show_f->fetch(PDO::FETCH_OBJ);
    $token = $data_f->token;

    //Notif
    $registration_ids = array($token);
    $pushNotif = $proses_f->send_notification($registration_ids,'Selamat! Anda mendapat reservasi baru.');
    //Notif END

    $show = $proses->showMaxTransaksi();
    $data = $show->fetch(PDO::FETCH_OBJ);
    $keterangan_mutasi = "6/".$data->kd_transaksi;

    // Log System
    //$logs->addLog('ADD','tb_transaksi','Tambah transaksi baru dengan kd_transaksi '.$data->kd_transaksi,json_encode(['kd_transaksi'=>$data->kd_transaksi,'data'=>[$kd_penyewa, $kd_apt, $kd_unit, $check_in, $check_out, $jumlah_weekend, $jumlah_weekday, $hari, $harga_sewa, $harga_sewa_we, $harga_sewa_gbg, $tgl_transaksi, $diskon, $ekstra_charge, $kd_kas, $tamu, $kd_booking, $dp, $total, $total_harga_owner, $sisa_pelunasan, 1, $h_owner_wd, $h_owner_we,$catatan, $deposit]]),null);
    if($dp <> 0){
      $add_mutasi = $proses2->addMutasiKas($kd_kas, $dp, 1, $tanggal, $keterangan_mutasi);

      // Log System
      //$logs->addLog('ADD','tb_mutasi_kas','Tambah mutasi kas',json_encode([$kd_kas, $dp, 1, $tanggal, $keterangan_mutasi]),null);
      $show1 = $proses2->editSaldo($kd_kas);
      $data1 = $show1->fetch(PDO::FETCH_OBJ);
      $saldo = $dp + $data1->saldo;
      $update_kas = $proses2->updateKas($kd_kas, $saldo, $tanggal);
    }
    // require("../class/ics_unit.php");
    // $ics = new Ics_unit($db);
    // $ics->buildIcs($kd_unit);

    //direct untuk build ics
    header('Location:../croneTask/update_sys_cal.php?id='.$kd_unit.'&ics_update='.$view.'&page=transaksi/laporan_transaksi%php');

  }else{
    echo 'Tambah Transaksi Gagal !';
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
  // Log System
  //$logs->addLog('ADD','tb_penyewa','Tambah data penyewa',json_encode([$nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung]),null);
//baru namabah trx
  $proses = new Transaksi($db);
  $show = $proses->showPenyewaTransaksi();
  $penyewa = $show->fetch(PDO::FETCH_OBJ);
  $kd_penyewa = $penyewa->kd_penyewa;
  $kd_reservasi = $_POST['kd_reservasi'];
  $kd_apt = $_POST['apartemen'];
  $kode = explode("+",$_POST['unit']);
  $kd_unit = $kode[0];
  $tamu = $_POST['tamu'];
  $check_in = $_POST['check_in'];
  $check_out = $_POST['check_out'];
  $harga_sewa = $_POST['harga_sewa'];
  $harga_sewa_asli = $_POST['harga_sewa_asli'];
  $diskon = 0;
  if($harga_sewa<$harga_sewa_asli){
     $diskon = $harga_sewa_asli-$harga_sewa;
  }
  $ekstra_charge = $_POST['ekstra_charge'];
  $kd_booking = $_POST['booking_via'];
  $kd_kas = $_POST['kas'];
  $dp = $_POST['dp'];
  $total = $_POST['total'];
  $total_harga_owner =  $_POST['total_harga_owner'];
  $sisa_pelunasan = $total - $dp;
  $hari = $_POST['jumhari'];
  $tgl_transaksi = date('y-m-d');
  if($total<$harga_sewa_asli*$hari){
     $diskon = $harga_sewa_asli*$hari-$total;
  }
  $add = $proses->addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $ekstra_charge, $kd_booking, $kd_kas, $dp, $total,$total_harga_owner, $sisa_pelunasan, $hari, $tgl_transaksi, $diskon);
  // Log System
  //$logs->addLog('ADD','tb_transaksi','Tambah data transaksi',json_encode([$kd_penyewa, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $ekstra_charge, $kd_booking, $kd_kas, $dp, $total,$total_harga_owner, $sisa_pelunasan, $hari, $tgl_transaksi, $diskon]),null);
  if($add == "Success"){
    $delete = $proses->deleteReservasi($kd_reservasi);
    // Log System
    //$logs->addLog('Delete','tb_reservasi','Hapus data reservasi',json_encode([$kd_reservasi]),null);
    $add2 = $proses->addUnit_kotor($kd_unit, $check_in, $check_out);
    header('Location:../view/'.$view.'/transaksi/laporan_transaksi.php');
  }else{
    echo 'gagal';
  }
}

//Tambah Pembayaran
elseif(isset($_POST['addPembayaran'])){
	$proses = new Transaksi($db);
  $proses_kas = new Kas($db);

	$show	= $proses->editTransaksi($_POST['kd_transaksi']);
	$data = $show->fetch(PDO::FETCH_OBJ);

	$kd_transaksi = $_POST['kd_transaksi'];
  $kd_kas = $_POST['kas'];
	$sisa_pelunasan_lama = $_POST['sisa_pelunasan'];
	$pembayaran_lama = $data->pembayaran;
	$pembayaran_masuk = $_POST['pembayaran'];
	$pembayaran_baru = $pembayaran_lama + $pembayaran_masuk;
	$sisa_pelunasan = $sisa_pelunasan_lama - $pembayaran_masuk;
  $tanggal = date('Y-m-d H:i:s');
  $keterangan = '7/'.$kd_transaksi;

  if($pembayaran_masuk <= 0){
    header('Location:../view/'.$view.'/transaksi/laporan_transaksi.php?pembayaran='.$kd_transaksi.'&warning=0');
  }else{
    $add = $proses->addPembayaran($kd_transaksi, $pembayaran_baru, $sisa_pelunasan);
    // Log System
    //$logs->addLog('ADDPAYMENT','tb_transaksi','Tambah data pembayaran',json_encode([$kd_transaksi, $pembayaran_baru, $sisa_pelunasan]),null);

    if($add == "Success"){
      $show_saldo = $proses_kas->editSaldo($kd_kas);
      $edit_saldo = $show_saldo->fetch(PDO::FETCH_OBJ);
      $saldo_baru = $edit_saldo->saldo + $pembayaran_masuk;

      $update_kas = $proses_kas->updateKas($kd_kas, $saldo_baru, $tanggal);
      $add_mutasi = $proses_kas->addMutasiKas($kd_kas, $pembayaran_masuk, 1, $tanggal, $keterangan);

      header('Location:../view/'.$view.'/transaksi/laporan_transaksi.php?pembayaran='.$kd_transaksi);
    } else echo 'error';
  }
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

  // Log System
  //$logs->addLog('ADD','tb_penyewa','Tambah data penyewa',json_encode([$nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung]),null);
  $proses = new Transaksi($db);
  $show = $proses->showPenyewaTransaksi();
  $data = $show->fetch(PDO::FETCH_OBJ);

  if($add == "Success"){
	  header('Location:../view/'.$view.'/transaksi/transaksi.php?transaksi='.$data->kd_penyewa);
  }
}

//update Transaksi
elseif(isset($_POST['updateTransaksi'])){
  $kd_transaksi = $_POST['kd_transaksi'];
  $kd_apt = $_POST['apartemen'];
  $kode = explode("+",$_POST['unit']);
  $kd_unit = $kode[0];
  $tamu = $_POST['tamu'];
  $check_in = $_POST['check_in'];
  $check_out = $_POST['check_out'];
  $harga_sewa = $_POST['harga_sewa'];
  $harga_sewa_we = $_POST['harga_sewa_we'];
  $harga_sewa_asli = $_POST['harga_sewa_asli'];
  $harga_sewa_gbg = $_POST['harga_sewa_gbg'];

  $ekstra_charge = $_POST['ekstra_charge'];
  $kd_booking = $_POST['booking_via'];
  $kd_kas = $_POST['kas'];
  $dp = $_POST['dp'];
  $total_tagihan = $_POST['total'];
  $total_harga_owner = $_POST['total_harga_owner'];
  $pembayaran = $_POST['pembayaran'];
  $sisa_pelunasan = $total_tagihan - $dp - $pembayaran;
  $hari = $_POST['jumhari'];
  $week = date("w",strtotime($check_in))+1;
  $tanggal = date('Y-m-d H:i:s');
  $keterangan = '6/'.$kd_transaksi;
  $catatan = $_POST['catatan'];
  $deposit = $_POST['deposit'];

  $proses_u = new Unit($db);
  $show_u = $proses_u->editUnit($kd_unit);
  $data_u = $show_u->fetch(PDO::FETCH_OBJ);
  $h_owner_wd = $data_u->h_owner_wd;
  $h_owner_we = $data_u->h_owner_we;
  //$h_owner_mg = $data_u->h_owner_mg;
  //$h_owner_bln = $data_u->h_owner_bln;

  if($week>5){ //jika dimulai dari weekend
    $week_kind = explode("/",startinweekend($hari, $week, 0, 0));
    $jumlah_weekday = $week_kind[0]; $jumlah_weekend = $week_kind[1];
  }else{ //jika dimulai dri weekday
    if($week+$hari<7){
      $jumlah_weekday=$hari;$jumlah_weekend=0;
    }else{
      $wd = 6 - $week;
      $week_kind = explode("/",startinweekend($hari-$wd, 6, $wd, 0));
      $jumlah_weekday = $week_kind[0];
      $jumlah_weekend = $week_kind[1];
    }
  }

  $harga_asli = explode("/", $harga_sewa_asli);
  if($total_tagihan<(($harga_asli[0]*$jumlah_weekday)+($harga_asli[1]*$jumlah_weekend))){
    $diskon = getDisCount($harga_sewa, $harga_sewa_we, $harga_sewa_asli, $jumlah_weekday, $jumlah_weekend, $total_tagihan);
  }else{
    $diskon = 0;
  }

  $proses = new Transaksi($db);
  $proses_kas = new Kas($db);

  $show = $proses_kas->showKdKas($keterangan);
  $data_mutasi = $show->fetch(PDO::FETCH_OBJ);
  //Mengecek ketersediaan mutasi kas
  if(!empty($data_mutasi->kd_kas)){
    $kd_kas_lama = $data_mutasi->kd_kas;
    $mutasi_dana = $data_mutasi->mutasi_dana;
  }else{
    $kd_kas_lama = $kd_kas;
    $mutasi_dana = 0;
  }

  if($kd_kas <> $kd_kas_lama){
    //Mengembalikan Saldo kas yang diganti
    $show_saldo_lama = $proses_kas->editSaldo($kd_kas_lama);
    $data_saldo_lama = $show_saldo_lama->fetch(PDO::FETCH_OBJ);
    $saldo_kas_lama = $data_saldo_lama->saldo - $mutasi_dana;

    //Merubah Saldo kas pengganti
    $show_saldo_baru = $proses_kas->editSaldo($kd_kas);
    $data_saldo_baru = $show_saldo_baru->fetch(PDO::FETCH_OBJ);
    $saldo_kas_baru = $data_saldo_baru->saldo + $dp;

    $update_kas_lama = $proses_kas->updateKas($kd_kas_lama, $saldo_kas_lama, $tanggal);
    $update_kas_baru = $proses_kas->updateKas($kd_kas, $saldo_kas_baru, $tanggal);

    $delete_mutasi = $proses_kas->deleteMutasi($keterangan);
    $add_mutasi = $proses_kas->addMutasiKas($kd_kas, $dp, 1, $tanggal, $keterangan);
  }elseif($kd_kas == $kd_kas_lama){
    $show_saldo = $proses_kas->editSaldo($kd_kas);
    $show_mutasi_dana = $proses_kas->showMutasiKas($keterangan);

    $data_saldo = $show_saldo->fetch(PDO::FETCH_OBJ);
    $data_mutasi_dana = $show_mutasi_dana->fetch(PDO::FETCH_OBJ);

    $saldo_kas = ($data_saldo->saldo - $data_mutasi_dana->mutasi_dana) + $dp;
    $update_kas = $proses_kas->updateKas($kd_kas, $saldo_kas, $tanggal);

    if($mutasi_dana <> $dp){
      $delete_mutasi = $proses_kas->deleteMutasi($keterangan);
      $add_mutasi = $proses_kas->addMutasiKas($kd_kas, $dp, 1, $tanggal, $keterangan);
    }
  }


  // $unit adalah kode unit lama
  $unit = $proses->updateUnit_kotor($kd_transaksi ,$kd_unit, $check_in, $check_out);
  //die("unit lama = ".$kd_unit." dan unit baru = ".$unit);
  $add = $proses->updateTransaksi($kd_transaksi, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $harga_sewa_we, $harga_sewa_gbg, $diskon, $ekstra_charge, $kd_booking, $kd_kas, $dp, $total_tagihan, $total_harga_owner,$sisa_pelunasan, $hari, $jumlah_weekend, $jumlah_weekday, $h_owner_wd, $h_owner_we,$catatan,$deposit);
  // Log System
  //$logs->addLog('Update','tb_transaksi','Update data transaksi',json_encode([$kd_transaksi, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $harga_sewa_we, $harga_sewa_gbg, $diskon, $ekstra_charge, $kd_booking, $kd_kas, $dp, $total_tagihan, $total_harga_owner,$sisa_pelunasan, $hari, $jumlah_weekend, $jumlah_weekday, $h_owner_wd, $h_owner_we,$catatan,$deposit]),null);
  if($add == "Success"){
  //require("../class/ics_unit.php");
  //$ics = new Ics_unit($db);
  if($kd_unit!=$unit)
    $kd_unit .= 'x'.$unit;
    //direct untuk build ics
    header('Location:../croneTask/update_sys_cal.php?id='.$kd_unit.'&ics_update='.$view.'&page=transaksi/laporan_transaksi%php');
  }else{
    echo 'error';
  };
}

//Delete Transaksi
elseif(isset($_GET['delete_transaksi']) && ($view=="superadmin" || $view=="manager")){
  $proses = new Transaksi($db);
  $del = $proses->deleteTransaksi($_GET['delete_transaksi']);
  // Log System
  //$logs->addLog('Delete','tb_transaksi','Hapus data transaksi',json_encode([$_GET['delete_transaksi']]),null);
  header("location:../view/".$view."/transaksi/cancel_transaksi.php");
}

//Delete Confirm Transaksi
elseif(isset($_GET['delete_confirm_transaksi']) && ($view=="superadmin" || $view=="manager")){
  $proses = new Transaksi($db);
  $del = $proses->deleteConfirmTransaksi($_GET['delete_confirm_transaksi']);
  // Log System
  //$logs->addLog('DeleteConfirmation','tb_transaksi','Hapus data konfirmasi transaksi',json_encode([$_GET['delete_confirm_transaksi']]),null);
  header("location:../view/".$view."/transaksi/cancel_transaksi.php");
}

//Tambah Confirm Transaksi
elseif (isset($_GET['addConfirm']) && $view!="owner" && $view!="cleaner"){
  $kd_transaksi = $_GET['addConfirm'];
  $proses = new Transaksi($db);
  $show = $proses->cekPelunasan($kd_transaksi);
  $data = $show->fetch(PDO::FETCH_OBJ);

  if($data->sisa_pelunasan > 0){
    header('Location:../view/'.$view.'/transaksi/laporan_transaksi.php?belum_lunas');
  }else{
    $add = $proses->addConfirm($kd_transaksi);
    // Log System
    //$logs->addLog('ADDConfirmation','tb_transaksi','Tambah data konfirmasi transaksi',json_encode([$kd_transaksi]),null);
    if($add == "Success"){
      header('Location:../view/'.$view.'/transaksi/confirm_transaksi.php');
    }
  }
}

elseif (isset($_GET['backTransaksi']) && $view!="owner" && $view!="cleaner"){
  $kd_transaksi = $_GET['backTransaksi'];
  $proses = new Transaksi($db);
  $add = $proses->backTransaksi($kd_confirm_transaksi);
  // Log System
  // //$logs->addLog('Update','tb_transaksi','Update data konfirmasi transaksi',json_encode([$kd_transaksi]),null);
  if($add == "Success"){
    header('Location:../view/'.$view.'/transaksi/confirm_transaksi.php');
  }
}

//Tambah Cancel Transaksi
elseif (isset($_GET['addCancel']) && $view!="owner" && $view!="cleaner"){
  $kd_transaksi = $_GET['addCancel'];
  $kd_unit = $_GET['unitCancel'];
  $proses = new Transaksi($db);
  $add = $proses->addCancel($kd_transaksi);
  // Log System
  //$logs->addLog('CancelTransaction','tb_transaksi','Pembatalan transaksi',json_encode([$kd_transaksi]),null);
  if($add == "Success"){    $delete = $proses->deleteUnit_kotor($kd_transaksi);
    //require("../class/ics_unit.php");
    //$ics = new Ics_unit($db);
    //$ics->buildIcs($kd_unit);
  header('Location:../croneTask/update_sys_cal.php?id='.$kd_unit.'&ics_update='.$view.'&page=transaksi/cancel_transaksi%php');
  }
}

//Setlement Dp
elseif (isset($_POST['setlementDp']) && $view!="owner" && $view!="cleaner"){
  $kd_kas = $_POST['kas'];
  $setlement = $_POST['setlement'];
  $kd_transaksi = $_SESSION['kd_transaksi'];
  $status = 3;

  $proses_t = new Transaksi($db);
  $proses_k = new Kas($db);
  $show_t = $proses_t->showDpTransaksi($kd_transaksi);
  $show_k = $proses_k->editSaldo($kd_kas);
  $data_dp = $show_t->fetch(PDO::FETCH_OBJ);
  $data_s = $show_k->fetch(PDO::FETCH_OBJ);

  if($data_s->saldo < $setlement){
    header('Location:../view/'.$view.'/transaksi/cancel_transaksi.php?error=saldoKurang');
  }elseif($setlement > $data_dp->dp){
    header('Location:../view/'.$view.'/transaksi/cancel_transaksi.php?error=dpKurang');
  }elseif($setlement == 0){
    $update = $proses_t->setlementDp($kd_transaksi, $setlement, $status);
    // Log System
    //$logs->addLog('Update','tb_transaksi','update setlement_Dp',json_encode([$kd_transaksi, $setlement, $status]),null);
    header('Location:../view/'.$view.'/transaksi/cancel_transaksi.php');
  }elseif($data_dp->dp >= $setlement){
    $tanggal = date('Y-m-d H:i:s');
    $keterangan = '8/'.$kd_transaksi;
    $saldo = $data_s->saldo - $setlement;

    $update = $proses_t->setlementDp($kd_transaksi, $setlement, $status);
    if($update == "Success"){
      // Log System
      //$logs->addLog('Update','tb_transaksi','update setlement_Dp',json_encode([$kd_transaksi, $setlement, $status]),null);
      $update_k = $proses_k->updateKas($kd_kas, $saldo, $tanggal);
      $add_m = $proses_k->addMutasiKas($kd_kas, $setlement, 2, $tanggal, $keterangan);
      header('Location:../view/'.$view.'/transaksi/cancel_transaksi.php');
    }
  }
}

else header('Location:../view/'.$view.'/home/home.php');
?>
