<?php
require("../../config/database.php");
require("../class/owner.php");
require("../class/kas.php");
require("../class/transaksi_umum.php");
require("../class/transaksi.php");

session_start();
date_default_timezone_set('Asia/Jakarta');
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

    if($add == "Success"){
      header('Location:../view/'.$view.'/owner/owner.php');
    }
  	else echo 'error';
}

//Delete Owner
elseif(isset($_GET['delete_owner']) && ($view=="superadmin" || $view=="manager")){
  $proses = new Owner($db);
	$del = $proses->deleteOwner($_GET['delete_owner']);
	header("Location:../view/".$view."/owner/owner.php");
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

	$kd_op_t = implode("a",$_POST['transaksi']);
	$kd_op_tu = implode("b",$_POST['transaksiUmum']);
	$kd_owner_payment = $kd_op_t."x".$kd_op_tu;

	$show_k = $proses_k->editSaldo($kd_kas);
	$data_k = $show_k->fetch(PDO::FETCH_OBJ);
	$saldo_b = $data_k->saldo - $earnings;
	$update_k = $proses_k->updateKas($kd_kas, $saldo_b, $tanggal);

	if($update_k == 'Success'){
		$update_mk = $proses_k->addMutasiKas($kd_kas, $earnings, $jenis, $tanggal, $keterangan);
	}
	if(!empty($_POST['transaksi'])){
		foreach($_POST['transaksi'] as $kd_transaksi){
			$update_t = $proses_t->updateStatusTransaksi($kd_transaksi, $status);
		}
	}
	if(!empty($_POST['transaksiUmum'])){
		foreach($_POST['transaksiUmum'] as $kd_transaksi_umum){
			$show_tu = $proses_tu->editTransaksiUmum($kd_transaksi_umum);
			$data_tu = $show_tu->fetch(PDO::FETCH_OBJ);
			$show_mk = $proses_k->showMutasiByTanggal($data_tu->tanggal);
			while($data_mk = $show_mk->fetch(PDO::FETCH_OBJ)){
				$keterangan = explode('/',$data_mk->keterangan);
				$keterangan_baru = '9/'.$keterangan[1];
				$update_mk = $proses_k->updateMutasi($data_mk->kd_mutasi_kas, $keterangan_baru);
			}
		}
	}
	$add_owner_payment = $proses_o->addOwnerPayment($kd_owner_payment, $kd_owner, $tanggal, $jumlah_transaksi, $earnings);
	header("Location:../view/".$view."/owner/owner_payment.php");
}

else header('Location:../view/'.$view.'/home/home.php');
?>
