<?php
require("../../config/database.php");
require("../class/owner.php");
require("../class/unit.php");
require("../class/kas.php");
require("../class/transaksi_umum.php");
require("../class/transaksi.php");

session_start();
// date_default_timezone_set('Asia/Jakarta');
$view = $_SESSION['hak_akses'];
//Update Owner
if(isset($_POST['updateOwner'])){
	$nama= $_POST['nama'];
	$alamat= $_POST['alamat'];
	$no_tlp= $_POST['no_tlp'];
	$kd_bank= $_POST['kd_bank'];
	$no_rek= $_POST['no_rek'];
	$kd_owner= $_POST['kd_owner'];
	$email= $_POST['email'];
	$jenis_kelamin= $_POST['jenis_kelamin'];

  $proses = new Owner($db);
  $add = $proses->updateOwner($kd_owner ,$nama, $alamat, $no_tlp, $kd_bank, $no_rek, $email, $jenis_kelamin);

  // Log System
  //$logs->addLog('Update','tb_owner','Update data owner ',json_encode([$kd_owner ,$nama, $alamat, $no_tlp, $kd_bank, $no_rek, $email, $jenis_kelamin]),null);

  if($add == "Success"){
	  header('Location:../view/'.$view.'/owner/owner.php');
  } else echo 'error';
}

//Tambah Owner
elseif(isset($_POST['addOwner'])){
	$nama= $_POST['nama'];
	$alamat= $_POST['alamat'];
	$no_tlp= $_POST['no_tlp'];
	$kd_bank= $_POST['kd_bank'];
	$no_rek= $_POST['no_rek'];
	$tgl_gabung= date('y-m-d');
	$email= $_POST['email'];
	$jenis_kelamin= $_POST['jenis_kelamin'];

    $proses = new Owner($db);
    $add = $proses->addOwner($nama, $alamat, $no_tlp, $kd_bank, $no_rek, $tgl_gabung, $email, $jenis_kelamin);

	  // Log System
	  //$logs->addLog('Add','tb_owner','Tambah data owner ',json_encode([$nama, $alamat, $no_tlp, $kd_bank, $no_rek, $tgl_gabung, $email, $jenis_kelamin]),null);

    if($add == "Success"){
      header('Location:../view/'.$view.'/owner/owner.php');
    }
  	else echo 'error';
}

//Tambah Penawaran
elseif(isset($_POST['addPenawaran'])){
	$kd_owner = $_POST['owner'];
	$kd_unit = $_POST['unit'];
	$judul = $_POST['judul'];
	$pesan = $_POST['pesan'];
	$h_owner_wd = $_POST['h_owner_wd'];
	$h_owner_we = $_POST['h_owner_we'];
	$h_owner_mg = $_POST['h_owner_mg'];
	$h_owner_bln = $_POST['h_owner_bln'];
	$status = 0;

  $proses = new Owner($db);
  $add = $proses->addPennawaranOwner($kd_owner, $kd_unit, $judul, $pesan, $h_owner_wd, $h_owner_we, $h_owner_mg, $h_owner_bln, $status, $tgl_penawaran);

	// Log System
	//$logs->addLog('Add','tb_owner','Tambah data penawaran ',json_encode([$nama, $alamat, $no_tlp, $kd_bank, $no_rek, $tgl_gabung, $email, $jenis_kelamin]),null);

  if($add == "Success"){
    header('Location:../view/'.$view.'/owner/penawaran.php');
  }
	else echo 'error';
}

//Delete Owner
elseif(isset($_GET['delete_owner']) && ($view=="superadmin" || $view=="manager")){
  $proses = new Owner($db);
	$del = $proses->deleteOwner($_GET['delete_owner']);

	// Log System
	//$logs->addLog('Delete','tb_owner','Hapus data owner ',json_encode([$_GET['delete_owner']]),null);

	header("Location:../view/".$view."/owner/owner.php");
}

//Delete Penawaran
elseif(isset($_GET['deletePenawaran']) && ($view=="superadmin" || $view=="manager")){
  $proses = new Owner($db);
	$del = $proses->deletePenawaran($_GET['deletePenawaran']);
	header("Location:../view/".$view."/owner/penawaran.php");
}

//Owner Payment
elseif(isset($_POST['ownerPayment'])){
	$kd_kas = $_POST['kas'];
	$earnings = $_POST['earnings'];
	$tanggal = date('Y-m-d H:i:s');
	$status = '41';
	$jenis = 2;
	$keterangan = 4;
	$kd_owner = $_SESSION['kd_owner'];
	$nominal_asli = $earnings;
	$ket = "Null";	
	if(isset($_POST['nominal_asal'])){
		$nominal_asli = $_POST['nominal_asal'];
		$ket = $_POST['description'];
	}

	if(isset($_POST['transaksi'])){
		$jumlah_t = count($_POST['transaksi']);
	}else{
		$jumlah_t = 0;
	}
	if(isset($_POST['transaksiUmum'])){
		$jumlah_tu = count($_POST['transaksiUmum']);
	}else{
		$jumlah_tu = 0;
	}
	$jumlah_transaksi = $jumlah_t + $jumlah_tu;

	$proses_k = new Kas($db);
	$proses_t = new Transaksi($db);
	$proses_tu = new TransaksiUmum($db);
	$proses_o = new Owner($db);

	if(isset($_POST['transaksi'])){
		$kd_op_t = implode("a",$_POST['transaksi']);
	}
	if(isset($_POST['transaksiUmum'])){
		$kd_op_tu = implode("b",$_POST['transaksiUmum']);
	}
	$kd_owner_payment = $kd_op_t."x".$kd_op_tu;

	$show_k = $proses_k->editSaldo($kd_kas);
	$data_k = $show_k->fetch(PDO::FETCH_OBJ);
	$saldo_b = $data_k->saldo - $earnings;
	$update_k = $proses_k->updateKas($kd_kas, $saldo_b, $tanggal);

  // Log System
  //$logs->addLog('Update','tb_kas','Update data kas dari owner ',json_encode([$kd_kas, $saldo_b, $tanggal]),null);

	if($update_k == 'Success'){
		$update_mk = $proses_k->addMutasiKas($kd_kas, $earnings, $jenis, $tanggal, $keterangan);
		// Log System
		//$logs->addLog('ADD','tb_mutasi_kas','Tambah data mutasi kas dari owner ',json_encode([$kd_kas, $earnings, $jenis, $tanggal, $keterangan]),null);
	}
	if(!empty($_POST['transaksi'])){
		foreach($_POST['transaksi'] as $kd_transaksi){
			$update_t = $proses_t->updateStatusTransaksi($kd_transaksi, $status);
			// Log System
			//$logs->addLog('Update','tb_transaksi','Update data transaksi dari owner ',json_encode([$kd_transaksi, $status]),null);
		}
	}
	if(!empty($_POST['transaksiUmum'])){
		foreach($_POST['transaksiUmum'] as $kd_transaksi_umum){
			$show_tu = $proses_tu->editTransaksiUmum($kd_transaksi_umum);
			// Log System
			//$logs->addLog('Update','tb_transaksi_umum','Update data transaksi umum dari owner ',json_encode([$kd_transaksi_umum]),null);

			$data_tu = $show_tu->fetch(PDO::FETCH_OBJ);
			$show_mk = $proses_k->showMutasiByTanggal($data_tu->tanggal);
			while($data_mk = $show_mk->fetch(PDO::FETCH_OBJ)){
				$keterangan = explode('/',$data_mk->keterangan);
				$keterangan_baru = '9/'.$keterangan[1];
				$update_mk = $proses_k->updateMutasi($data_mk->kd_mutasi_kas, $keterangan_baru);
				// Log System
				//$logs->addLog('Update','tb_mutasi_kas','Update data mutasi kas dari owner ',json_encode([$data_mk->kd_mutasi_kas, $keterangan_baru]),null);
			}
		}
	}
	$add_owner_payment = $proses_o->addOwnerPayment($kd_owner_payment, $kd_owner, $tanggal, $jumlah_transaksi, $earnings, 1, $nominal_asli, $ket);
	// Log System
	//$logs->addLog('Add','tb_owner_payment','Tambah data pembayaran dari owner ',json_encode([$kd_owner_payment, $kd_owner, $tanggal, $jumlah_transaksi, $earnings, 1]),null);
	header("Location:../view/".$view."/owner/owner_payment.php");
}

//Kirim Kwitansi ke owner
elseif(isset($_POST['kirimKwitansi'])){
	$kd_kas = $_POST['kas'];
	$earnings = $_POST['earnings'];

	$nominal_asli = $earnings;
	$ket = "Null";	
	if(isset($_POST['nominal_asal'])){
		$nominal_asli = $_POST['nominal_asal'];
		$ket = $_POST['description'];
	}

	$tanggal = date('Y-m-d H:i:s');
	$status = '41';
	$jenis = 2;
	$kd_owner = $_SESSION['kd_owner'];

	if(isset($_POST['transaksi'])){
		$jumlah_t = count($_POST['transaksi']);
	}else{
		$jumlah_t = 0;
	}
	if(isset($_POST['transaksiUmum'])){
		$jumlah_tu = count($_POST['transaksiUmum']);
	}else{
		$jumlah_tu = 0;
	}

	$jumlah_transaksi = $jumlah_t + $jumlah_tu;
	$proses_o = new Owner($db);

	if(isset($_POST['transaksi'])){
		$kd_op_t = implode("a",$_POST['transaksi']);
	}
	if(isset($_POST['transaksiUmum'])){
		$kd_op_tu = implode("b",$_POST['transaksiUmum']);
	}

	$kd_owner_payment = $kd_op_t."x".$kd_op_tu;
	$add_owner_payment = $proses_o->addOwnerPayment($kd_owner_payment, $kd_owner, $tanggal, $jumlah_transaksi, $earnings, 2, $nominal_asli, $ket);
	// Log System
	//$logs->addLog('Add','tb_owner_payment','Kirim kwitansi pembayaran ke owner ',json_encode([$kd_owner_payment, $kd_owner, $tanggal, $jumlah_transaksi, $earnings, 2]),null);
	header("Location:../view/".$view."/owner/owner_payment.php");
}

//Reject Kwitansi Owner Payment
elseif(isset($_POST['rejectKwitansi'])){
	$kd_owner_payment =  $_POST['kd_owner_payment'];
	$status = 3;
	$proses_o = new Owner($db);
	$update_o = $proses_o->modStatusOwnerPayment($kd_owner_payment, $status);
	// Log System
	//$logs->addLog('Update','tb_owner_payment','Reject kwitansi pembayaran ke owner ',json_encode([$kd_owner_payment, $status]),null);
	if($update_o == "Success"){
		header("Location:../view/".$view."/kwitansi/list_kwitansi.php");
	}
}

//Confirm Kwitansi Owner Payment
elseif(isset($_POST['confirmKwitansi'])){
	$kd_owner_payment =  $_POST['kd_owner_payment'];
	$status = 4;
	$proses_o = new Owner($db);
	$update_o = $proses_o->modStatusOwnerPayment($kd_owner_payment, $status);
	// Log System
	//$logs->addLog('Update','tb_owner_payment','Confirmation kwitansi pembayaran ke owner ',json_encode([$kd_owner_payment, $status]),null);
	if($update_o == "Success"){
		header("Location:../view/".$view."/kwitansi/list_kwitansi.php");
	}
}

//Pebayaran kwitansi yang confirm
elseif(isset($_POST['paymentConfirmKwitansi'])){
	$kd_owner_payment = $_POST['kd_owner_payment'];
	$kd_kas = $_POST['kas'];
	$tanggal = date('Y-m-d H:i:s');
	$keterangan = 4;
	$jenis = 2;
	$status_transaksi = 41;
	$status_op = 1;

	//Memecah kd_owner_payment menjadi kd_transaksi dan kd_transaksi_umum
	$kode = explode("x",$kd_owner_payment);
	if($kode[0] <> ''){
		$transaksi = explode("a",$kode[0]);
	}
	if($kode[1] <> ''){
		$transaksi_umum = explode("b",$kode[1]);
	}
	//End

	$proses_k = new Kas($db);
	$proses_t = new Transaksi($db);
	$proses_tu = new TransaksiUmum($db);
	$proses_o = new Owner($db);

	$show_op = $proses_o->editOwnerPayment($kd_owner_payment);
	// // Log System
	// //$logs->addLog('Update','tb_owner_payment','Update payment owner ',json_encode([$kd_owner_payment]),null);
	$edit_op = $show_op->fetch(PDO::FETCH_OBJ);
	$earnings = $edit_op->nominal;

	$show_k = $proses_k->editSaldo($kd_kas);
	$data_k = $show_k->fetch(PDO::FETCH_OBJ);
	$saldo_b = $data_k->saldo - $earnings;
	$update_k = $proses_k->updateKas($kd_kas, $saldo_b, $tanggal);
	// Log System
	//$logs->addLog('Update','tb_kas','Update data kas ',json_encode([$kd_kas, $saldo_b, $tanggal]),null);

	if($update_k == 'Success'){
		$update_mk = $proses_k->addMutasiKas($kd_kas, $earnings, $jenis, $tanggal, $keterangan);
		// Log System
		//$logs->addLog('ADD','tb_mutasi_kas','Tambah data mutasi kas ',json_encode([$kd_kas, $earnings, $jenis, $tanggal, $keterangan]),null);
	}
	if(!empty($transaksi)){
		foreach($transaksi as $kd_transaksi){
			$update_t = $proses_t->updateStatusTransaksi($kd_transaksi, $status_transaksi);
			// Log System
			//$logs->addLog('Update','tb_transaksi','Update data status transaksi ',json_encode([$kd_transaksi, $status_transaksi]),null);
		}
	}
	if(!empty($transaksi_umum)){
		foreach($transaksi_umum as $kd_transaksi_umum){
			$show_tu = $proses_tu->editTransaksiUmum($kd_transaksi_umum);
			// Log System
			//$logs->addLog('Update','tb_transaksi_umum','Update data transaksi umum dari owner ',json_encode([$kd_transaksi_umum]),null);
			$data_tu = $show_tu->fetch(PDO::FETCH_OBJ);
			$show_mk = $proses_k->showMutasiByTanggal($data_tu->tanggal);
			while($data_mk = $show_mk->fetch(PDO::FETCH_OBJ)){
				$keterangan = explode('/',$data_mk->keterangan);
				$keterangan_baru = '9/'.$keterangan[1];
				$update_mk = $proses_k->updateMutasi($data_mk->kd_mutasi_kas, $keterangan_baru);
				// Log System
				//$logs->addLog('Update','tb_mutasi_kas','Update data mutasi kas dari owner ',json_encode([$data_mk->kd_mutasi_kas, $keterangan_baru]),null);
			}
		}
	}
	$mod_owner_payment = $proses_o->modStatusOwnerPayment($kd_owner_payment, $status_op);
	// Log System
	//$logs->addLog('Update','tb_owner_payment','Update kwitansi pembayaran ke owner ',json_encode([$kd_owner_payment, $status_op]),null);
	header("Location:../view/".$view."/owner/owner_payment.php");
}

elseif(isset($_GET['deletePayment'])){
	$proses = new Owner($db);
	$del = $proses->deleteOwnerPayment($_GET['deletePayment']);
	// Log System
	//$logs->addLog('Delete','tb_owner_payment','Delete pembayaran ke owner ',json_encode([$_GET['deletePayment']]),null);
	header("Location:../view/".$view."/owner/owner_payment.php");
}

//Penawaran
elseif (isset($_GET['kd_penawaran'])){
	$kd_penawaran = $_GET['kd_penawaran'];
	$status = $_GET['statusPenawaran'];
	$kd_owner = $_GET['kd_owner'];
	$kd_unit = $_GET['kd_unit'];
	$h_owner_wd = $_GET['wd'];
	$h_owner_we = $_GET['we'];
	$h_owner_mg = $_GET['mg'];
	$h_owner_bln = $_GET['bln'];

	$proses_o = new Owner($db);
	$update_o = $proses_o->updateStatusPenawaran($kd_penawaran, $status);
	if ($status == 1) {
		$proses_u = new Unit($db);
		$update_u = $proses_u->updateHargaOwner($kd_unit, $kd_owner, $h_owner_wd, $h_owner_we, $h_owner_mg, $h_owner_bln);
	}
	if(($update_u == "Success") && ($update_o == "Success")){
		header("Location:../view/".$view."/home/home.php");
	}
}

else header('Location:../view/'.$view.'/home/home.php');
?>
