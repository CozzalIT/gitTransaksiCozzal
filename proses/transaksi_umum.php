<?php
require("../../config/database.php");
require("../class/transaksi_umum.php");
require("../class/kas.php");

// session_start();
// date_default_timezone_set('Asia/Jakarta');
$view = $_SESSION['hak_akses'];

//Transaksi Umum & Unit (Gabunggan)
if(isset($_POST['addTU'])){
	if(isset($_POST['apartemen'])){
		$kd_apt = $_POST['apartemen'];
		if(isset($_POST['unit'])){
			$kd_unit = $_POST['unit'];
			$kd_unit_real = explode("+",$kd_unit);
		}
	}

  if($_POST['kebutuhan'] == 'tu'){
		$kebutuhan = "umum";
		$keterangan_mutasi = 3;
		$status = 0;
		$jatuh_tempo = null;
  }elseif($_POST['kebutuhan'] == 'u'){
		$kebutuhan = "unit/".$kd_unit_real[0];
		$keterangan_mutasi = '10/'.$kd_unit_real[0];
		$status = 0;
		$jatuh_tempo = null;
  }elseif($_POST['kebutuhan'] == 'btu'){
		$kebutuhan = "umum";
		$keterangan_mutasi = 3;
		$status = 1;
		$jatuh_tempo = $_POST['jatuh_tempo'];
  }elseif($_POST['kebutuhan'] == 'bu'){
		$kebutuhan = "unit/".$kd_unit_real[0];
		$keterangan_mutasi = '10/'.$kd_unit_real[0];
		$status = 1;
		$jatuh_tempo = $_POST['jatuh_tempo'];
  }

	$kd_kas = $_POST['kd_kas'];
  $harga = $_POST['harga'];
  $jumlah = $_POST['jumlah'];
  $keterangan = $_POST['keterangan'];
  $tanggal = date('Y-m-d H:i:s');
  $mutasi_dana = $harga*$jumlah;
  $jenis = 2;

  $proses = new TransaksiUmum($db);
  $proses2 = new Kas($db);

	$edit = $proses2->editSaldo($kd_kas);
	$data = $edit->fetch(PDO::FETCH_OBJ);

	if($mutasi_dana < $data->saldo){
		$add = $proses->addTransaksiUmum($kd_kas, $kebutuhan, $harga, $jumlah, $keterangan, $tanggal, $status, $jatuh_tempo);
		// Log System
    	//$logs->addLog('Add','tb_transaksi_umum','Tambah data transaksi umum',json_encode([$kd_kas, $kebutuhan, $harga, $jumlah, $keterangan, $tanggal, $status, $jatuh_tempo]),null);

		if($add == "Success"){
			if($status == 0){
			    $add_mutasi = $proses2->addMutasiKas($kd_kas, $mutasi_dana, $jenis, $tanggal, $keterangan_mutasi);
					// Log System
					//$logs->addLog('Add','tb_mutasi_kas','Tambah data mutasi kas',json_encode([$kd_kas, $mutasi_dana, $jenis, $tanggal, $keterangan_mutasi]),null);
					$saldo = $data->saldo - ($harga*$jumlah);
			    $update = $proses2->updateKas($kd_kas, $saldo, $tanggal);
					// Log System
					//$logs->addLog('Add','tb_kas','Tambah data mutasi kas',json_encode([$kd_kas, $saldo, $tanggal]),null);
				header('Location:../view/'.$view.'/transaksi_umum/laporan_transaksi_umum.php');
			}elseif($status == 1){
				$add_mutasi = $proses2->addMutasiKas($kd_kas, 0, $jenis, $tanggal, $keterangan_mutasi);
				// Log System
					//$logs->addLog('Add','tb_mutasi_kas','Tambah data mutasi kas',json_encode([$kd_kas, 0, $jenis, $tanggal, $keterangan_mutasi]),null);
					header('Location:../view/'.$view.'/transaksi_umum/billing_transaksi_umum.php');
			}
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

//Payment Billing
elseif(isset($_POST['paymentBilling'])){
	$kd_transaksi_umum = $_POST['kd_transaksi_umum'];
	$kd_kas_baru = $_POST['kas'];

	$proses = new TransaksiUmum($db);
	$show_tu = $proses->editTransaksiUmum($kd_transaksi_umum);
	$edit_tu = $show_tu->fetch(PDO::FETCH_OBJ);

	$kebutuhan = $edit_tu->kebutuhan;
	$harga_umum = $edit_tu->harga;
	$jumlah_umum = $edit_tu->jumlah;
	$keterangan = $edit_tu->keterangan;
	$tanggal = date('Y-m-d H:i:s');
	$status = 0;
	$mutasi_dana = $harga_umum*$jumlah_umum;
	$jenis = 2;
	if($kebutuhan == 'umum'){
		$keterangan_mutasi = 3;
	}else{
		$kd_unit = explode("/",$kebutuhan);
		$keterangan_mutasi = "10/".$kd_unit[1];
	}

	$update = $proses->paymentBilling($kd_transaksi_umum, $kd_kas_baru, $kebutuhan, $harga_umum, $jumlah_umum, $keterangan, $tanggal, $status);
	// Log System
	//$logs->addLog('Update','tb_transaksi_umum','Update data transaksi umum',json_encode([$kd_transaksi_umum, $kd_kas_baru, $kebutuhan, $harga_umum, $jumlah_umum, $keterangan, $tanggal, $status]),null);
  	if($update == "Success"){
		$proses2 = new Kas($db);
		$edit = $proses2->editSaldo($kd_kas_baru);
		$data = $edit->fetch(PDO::FETCH_OBJ);

		if($mutasi_dana < $data->saldo){
		  $add_mutasi = $proses2->addMutasiKas($kd_kas_baru, $mutasi_dana, $jenis, $tanggal, $keterangan_mutasi);
			// Log System
		  //$logs->addLog('Add','tb_mutasi_kas','Tambah data mutasi kas',json_encode([$kd_kas_baru, $mutasi_dana, $jenis, $tanggal, $keterangan_mutasi]),null);
		  $saldo = $data->saldo - $mutasi_dana;
		  $update = $proses2->updateKas($kd_kas_baru, $saldo, $tanggal);
	    if($add_mutasi == "Failed"){
	      echo 'Penambahan Mutasi Dana Gagal!!';
	    }elseif($update == "Failed"){
	      echo 'Saldo Kas Gagal di Update!!';
	    }
			header('Location:../view/'.$view.'/transaksi_umum/billing_transaksi_umum.php');
		}elseif($mutasi_dana > $data->saldo){
			if($kebutuhan == 'umum'){
				header('Location:../view/'.$view.'/transaksi_umum/billing_transaksi_umum.php?umum');
			}else{
				header('Location:../view/'.$view.'/transaksi_umum/billing_transaksi_umum.php?unit');
			}
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

		// Log System
		$update_kas_lama = $Proses_k->updateKas($kd_kas_lama, $saldo_kas_lama, $tanggal);
		//$logs->addLog('Update','tb_kas','Update data kas lama',json_encode([$kd_kas_lama, $saldo_kas_lama, $tanggal]),null);
		$update_kas_baru = $Proses_k->updateKas($kas_selected, $saldo_kas_baru, $tanggal);
		//$logs->addLog('Update','tb_kas','Update data kas baru',json_encode([$kas_selected, $saldo_kas_baru, $tanggal]),null);

		$update_mutasi = $Proses_k->updateMutasiByDate($total_umum_baru, $kas_selected, $tanggal_transaksi);
		//$logs->addLog('Update','tb_mutasi_kas','Update data mutasi kas berdasarkan tanggal',json_encode([$total_umum_baru, $kas_selected, $tanggal_transaksi]),null);

	}elseif ($kd_kas_lama == $kas_selected) {
		$show_saldo_lama = $Proses_k->editSaldo($kd_kas_lama);
		$data_saldo_lama = $show_saldo_lama->fetch(PDO::FETCH_OBJ);
		$saldo_kas_lama = $data_saldo_lama->saldo + $total_umum_lama - $total_umum_baru;

		$update_kas_lama = $Proses_k->updateKas($kd_kas_lama, $saldo_kas_lama, $tanggal);
		//$logs->addLog('Update','tb_kas','Update data kas lama',json_encode([$kd_kas_lama, $saldo_kas_lama, $tanggal]),null);

		$update_mutasi = $Proses_k->updateMutasiByDate($total_umum_baru, $kd_kas_lama, $tanggal_transaksi);
		//$logs->addLog('Update','tb_mutasi_kas','Update data mutasi kas berdasarkan tanggal',json_encode([$total_umum_baru, $kd_kas_lama, $tanggal_transaksi]),null);

	}

	$add = $Proses->updateTransaksiUmum($kd_transaksi_umum, $kas_selected, $kebutuhan, $harga_umum, $jumlah_umum, $keterangan, $tanggal);
	// Log System
	//$logs->addLog('Update','tb_transaksi_umum','Update data transaksi umum',json_encode([$kd_transaksi_umum, $kas_selected, $kebutuhan, $harga_umum, $jumlah_umum, $keterangan, $tanggal]),null);
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
	//$logs->addLog('Update','tb_kas','Update data kas',json_encode([$data_transaksi->kd_kas, $saldo_kas, $tanggal]),null);
	$Proses_k->deleteMutasiByDate($data_transaksi->tanggal);
	//$logs->addLog('Delete','tb_mutasi_kas','Delete data mutasi kas berdasarkan tanggal',json_encode([$data_transaksi->tanggal]),null);
	$del = $proses->deleteTransaksiUmum($_GET['delete_transaksi_umum']);
	//$logs->addLog('Delete','tb_transaksi_umum','Delete data transaksi umum',json_encode([$_GET['delete_transaksi_umum']]),null);
	if($data_transaksi->status == 0){
		header("location:../view/".$view."/transaksi_umum/laporan_transaksi_umum.php");
	}else{
		header("location:../view/".$view."/transaksi_umum/billing_transaksi_umum.php");
	}
}

else header('Location:../view/'.$view.'/home/home.php');
?>
