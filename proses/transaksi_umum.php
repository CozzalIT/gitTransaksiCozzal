<?php
require("../../config/database.php");
require("../class/transaksi_umum.php");
require("../class/kas.php");

session_start();
date_default_timezone_set('Asia/Jakarta');
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
  $tanggal = date('Y-m-d H:i:s');
  $mutasi_dana = $harga*$jumlah;
  $jenis = 2;

  $proses = new TransaksiUmum($db);
  $proses2 = new Kas($db);

	$edit = $proses2->editSaldo($kd_kas);
	$data = $edit->fetch(PDO::FETCH_OBJ);
	if($mutasi_dana < $data->saldo){
		$add = $proses->addTransaksiUmum($kd_kas, $kebutuhan, $harga, $jumlah, $keterangan, $tanggal);
	  if($add == "Success"){
	    $add_mutasi = $proses2->addMutasiKas($kd_kas, $mutasi_dana, $jenis, $tanggal, $keterangan_mutasi);
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
	}elseif($mutasi_dana > $data->saldo){
		if($kebutuhan == 'umum'){
			header('Location:../view/'.$view.'/transaksi_umum/transaksi_umum.php?umum');
		}else{
			header('Location:../view/'.$view.'/transaksi_umum/transaksi_umum.php?unit');
		}
	}
}

//Tambah Transaksi Unit
elseif(isset($_POST['addTransaksiUnit'])){
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
  $tanggal = date('Y-m-d H:i:s');
	$keterangan_mutasi = '10/'.$kd_unit_real[0];
  $mutasi_dana = $harga*$jumlah;
  $jenis = 2;

  $proses = new TransaksiUmum($db);
  $proses2 = new Kas($db);

	$edit = $proses2->editSaldo($kd_kas);
	$data = $edit->fetch(PDO::FETCH_OBJ);
	if($mutasi_dana < $data->saldo){
		$add = $proses->addTransaksiUmum($kd_kas, $kebutuhan, $harga, $jumlah, $keterangan, $tanggal);
	  if($add == "Success"){
	    $add_mutasi = $proses2->addMutasiKas($kd_kas, $mutasi_dana, $jenis, $tanggal, $keterangan_mutasi);
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

	}elseif($mutasi_dana > $data->saldo){
		if($kebutuhan == 'umum'){
			header('Location:../view/'.$view.'/transaksi_umum/transaksi_umum.php?umum');
		}else{
			header('Location:../view/'.$view.'/transaksi_umum/transaksi_umum.php?unit');
		}
	}
}

//update transaksi umum
elseif(isset($_POST['updateTransaksiUmum'])){
	$kd_transaksi_umum = $_POST['kd_transaksi_umum'];
	$kd_kas_lama = $_POST['kd_kas'];
	$kas_selected = $_POST['kas'];
	if($_POST['kebutuhan'] == "0"){
		$kebutuhan = "umum";
	} else {
		$kd_unit = $_POST['unit'];
		$kebutuhan = "unit/$kd_unit";
	}
	$harga_umum = $_POST['harga'];
	$jumlah_umum = $_POST['jumlah'];
	$total_umum_lama = $_POST['total_umum_lama'];
	$total_umum_baru = $_POST['total_umum_baru'];
	$keterangan = $_POST['keterangan'];
	$tanggal_transaksi = $_POST['tanggal_transaksi'];
	$tanggal = date("Y-m-d H:i:s");

	$Proses = new TransaksiUmum($db);
	$Proses_k = new Kas($db);

	$show = $Proses_k->showKas();
	$data_kas = $show->fetch(PDO::FETCH_OBJ);
	if($kd_kas_lama <> $kas_selected){
		$show_saldo_lama = $Proses_k->editSaldo($kd_kas_lama);
		$data_saldo_lama = $show_saldo_lama->fetch(PDO::FETCH_OBJ);
		$saldo_kas_lama = $data_saldo_lama->saldo + $total_umum_baru;

		$show_saldo_baru = $Proses_k->editSaldo($kas_selected);
		$data_saldo_baru = $show_saldo_baru->fetch(PDO::FETCH_OBJ);
		$saldo_kas_baru = $data_saldo_baru->saldo - $total_umum_baru;

		$update_kas_lama = $Proses_k->updateKas($kd_kas_lama, $saldo_kas_lama, $tanggal);
		$update_kas_baru = $Proses_k->updateKas($kas_selected, $saldo_kas_baru, $tanggal);

		$update_mutasi = $Proses_k->updateMutasiByDate($total_umum_baru, $kas_selected, $tanggal_transaksi);

	}elseif ($kd_kas_lama == $kas_selected) {
		$show_saldo_lama = $Proses_k->editSaldo($kd_kas_lama);
		$data_saldo_lama = $show_saldo_lama->fetch(PDO::FETCH_OBJ);
		$saldo_kas_lama = $data_saldo_lama->saldo + $total_umum_lama - $total_umum_baru;

		$update_kas_lama = $Proses_k->updateKas($kd_kas_lama, $saldo_kas_lama, $tanggal);

		$update_mutasi = $Proses_k->updateMutasiByDate($total_umum_baru, $kd_kas_lama, $tanggal_transaksi);

	}

	$add = $Proses->updateTransaksiUmum($kd_transaksi_umum, $kas_selected, $kebutuhan, $harga_umum, $jumlah_umum, $keterangan, $tanggal);
	header('Location:../view/'.$view.'/transaksi_umum/laporan_transaksi_umum.php');
}

//Delete Transaksi
elseif(isset($_GET['delete_transaksi_umum']) && ($view=="superadmin" || $view=="manager")){
  $proses = new TransaksiUmum($db);
	$Proses_k = new Kas($db);
	$tanggal = date("Y-m-d H:i:s");

	$show_transaksi = $proses->editTransaksiUmum($_GET['delete_transaksi_umum']);
	$data_transaksi = $show_transaksi->fetch(PDO::FETCH_OBJ);

	$show_saldo = $Proses_k->editSaldo($data_transaksi->kd_kas);
	$data_saldo = $show_saldo->fetch(PDO::FETCH_OBJ);

	$total = $data_transaksi->jumlah*$data_transaksi->harga;
	$saldo_kas = $data_saldo->saldo + $total;

	$update_saldo = $Proses_k->updateKas($data_transaksi->kd_kas, $saldo_kas, $tanggal);
	$Proses_k->deleteMutasiByDate($data_transaksi->tanggal);
	$del = $proses->deleteTransaksiUmum($_GET['delete_transaksi_umum']);
  header("location:../view/".$view."/transaksi_umum/laporan_transaksi_umum.php");
}

else header('Location:../view/'.$view.'/home/home.php');
?>
