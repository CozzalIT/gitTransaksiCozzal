<?php
require("../../config/database.php");
require("../class/kas.php");

// session_start();
// date_default_timezone_set('Asia/Jakarta');
$view = $_SESSION['hak_akses'];

//Tambah Kas
if(isset($_POST['addKas'])){
  $sumber_dana = $_POST['sumber_dana'];
	$saldo = $_POST['saldo'];
  $tanggal = date('Y-m-d H:i:s');

  $proses = new Kas($db);
  $add = $proses->addKas($sumber_dana, $saldo, $tanggal);

  // Log System
  $logs->addLog('Add','tb_kas','Tambah data kas',json_encode([$sumber_dana, $saldo, $tanggal]),null);

  if($add == "Success"){
    $show = $proses->showLastKas();
    $data = $show->fetch(PDO::FETCH_OBJ);
    $kd_kas = $data->kd_kas;
    $mutasi_dana = $_POST['saldo'];
    $jenis = 1;
    $keterangan = 2;

    $add_mutasi = $proses->addMutasiKas($kd_kas, $mutasi_dana, $jenis, $tanggal, $keterangan);

    // Log System
    $logs->addLog('Add','tb_mutasi_kas','Tambah data mutasi kas',json_encode([$kd_kas, $mutasi_dana, $jenis, $tanggal, $keterangan]),null);

    if($add_mutasi == "Success"){
	     header('Location:../view/'.$view.'/kas/kas.php');
    }
  }
}

elseif(isset($_POST['mutasiDana'])){
  $kas_sumber = $_POST['sumber'];
  $kas_tujuan = $_POST['tujuan'];
  $jumlah_mutasi = $_POST['mutasi'];
  $tanggal = date('Y-m-d H:i:s');

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
  // Log System
  $logs->addLog('Update','tb_kas','Update data kas sumber',json_encode([$kas_sumber, $saldo_sumber, $tanggal]),null);
  $update_tujuan = $proses->updateKas($kas_tujuan, $saldo_tujuan, $tanggal);
  // Log System
  $logs->addLog('Update','tb_kas','Update data kas tujuan',json_encode([$kas_tujuan, $saldo_tujuan, $tanggal]),null);

  if($update_sumber == "Success" && $update_tujuan == "Success"){
    $add_mutasi_sumber = $proses->addMutasiKas($kas_sumber, $jumlah_mutasi, $jenis_sumber, $tanggal, $keterangan);
    // Log System
    $logs->addLog('Add','tb_mutasi_kas','Tambah data mutasi kas sumber',json_encode([$kas_sumber, $jumlah_mutasi, $jenis_sumber, $tanggal, $keterangan]),null);
    $add_mutasi_tujuan = $proses->addMutasiKas($kas_tujuan, $jumlah_mutasi, $jenis_tujuan, $tanggal, $keterangan);
    // Log System
    $logs->addLog('Add','tb_mutasi_kas','Tambah data mutasi kas tujuan',json_encode([$kas_tujuan, $jumlah_mutasi, $jenis_tujuan, $tanggal, $keterangan]),null);


    header('Location:../view/'.$view.'/kas/kas.php');
  }
}

elseif(isset($_POST['addSaldo'])){
  $kd_kas = $_POST['kas'];
  $jumlah_dana = $_POST['jumlah'];
  $tanggal = date('Y-m-d H:i:s');

  $proses = new Kas($db);
  $show = $proses->editSaldo($kd_kas);
  $data = $show->fetch(PDO::FETCH_OBJ);
  $saldo_baru = $data->saldo + $jumlah_dana;

  $update_kas = $proses->updateKas($kd_kas, $saldo_baru, $tanggal);
  // Log System
  $logs->addLog('Update','tb_kas','Update data kas',json_encode([$kd_kas, $saldo_baru, $tanggal]),null);

  if($update_kas == "Success"){
    $add_mutasi = $proses->addMutasiKas($kd_kas, $jumlah_dana, 1, $tanggal, 2);
    // Log System
    $logs->addLog('Update','tb_mutasi_kas','Update data mutasi kas',json_encode([$kd_kas, $jumlah_dana, 1, $tanggal, 2]),null);

    if($add_mutasi == "Success"){
      header('location:../view/'.$view.'/kas/kas.php');
    }else{
      echo "Proses mutasi dana gagal";
    }
  }else{
    echo "Proses penambahan saldo gagal!!";
  }
}

else header('Location:../view/'.$view.'/home/home.php');
?>
