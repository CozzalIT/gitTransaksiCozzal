<?php
require("../../config/database.php");
require("../class/transaksi_broker.php");
require("../class/unit.php");
require("../class/fcm.php");
require("../class/owner.php");
require("../class/kas.php");
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

if(isset($_POST["getList"])){
	$keyword = $_POST["getList"];
	$html ="";
	$Proses = new Transaksi_broker($db);
	$show1 = $Proses->showPenyewa($keyword);
	$callback = [];
	while($data = $show1->fetch(PDO::FETCH_OBJ)){
		$callback[] = [
			'kd_penyewa' => $data->kd_penyewa, 'nama' => $data->nama, 
			'email' => $data->email, 'no_tlp' => $data->no_tlp, 'alamat' => $data->alamat
		];
	}
	echo json_encode($callback);
}

elseif(isset($_POST["getListBroker"])){
	$keyword = $_POST["getListBroker"];
	$html ="";
	$Proses = new Transaksi_broker($db);
	$show1 = $Proses->showBroker($keyword);
	$callback = [];
	while($data = $show1->fetch(PDO::FETCH_OBJ)){
		$callback[] = [
			'kd_penyewa' => $data->kd_penyewa, 'nama' => $data->nama, 
			'email' => $data->email, 'no_tlp' => $data->no_tlp, 'alamat' => $data->alamat
		];
	}
	echo json_encode($callback);
}

elseif(isset($_POST['daftar_broker'])){
	$penyewa = new Transaksi_broker($db);
	$nama = $_POST["daftar_broker"];
	$alamat = $_POST["alamat"];
	$no_tlp = $penyewa->setPhoneNumber($_POST["no_tlp"]);
	$jenis_kelamin = $_POST["jenis_kelamin"];
	$email = $_POST["email"];
	$tgl_gabung = date("Y-m-d");
	$data = $penyewa->addBroker($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung);

	if($penyewa!="Failed"){
		$callback = array('status'=>$data);
	} else {
		$callback = array('status'=>"gagal");
	}
	// Log System
	////$logs->addLog('ADD','tb_penyewa','Tambah penyewa',json_encode([$nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung]),null);
	echo json_encode($callback);
}

elseif(isset($_POST['transaksiBroker']) || isset($_POST['transaksiPenyewaBroker'])){
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
	$kode = explode("+",$_POST['unit']);
	$kd_unit = $kode[0];

	$catatan = $_POST['catatan'];
	$deposit = $_POST['deposit'];
	$status_broker = (isset($_POST['transaksiBroker']) ? 'B' : 'P');

	$proses_u = new Unit($db);
	$show_u = $proses_u->editUnit($kd_unit);
	$data_u = $show_u->fetch(PDO::FETCH_OBJ);
	$h_owner_wd = $data_u->h_owner_wd;
	$h_owner_we = $data_u->h_owner_we;
	$kd_owner = $data_u->kd_owner;

	if($week>5){ //jika dimulai dari weekend
		$week_kind = explode("/",startinweekend($hari, $week, 0, 0));
		$jumlah_weekday = $week_kind[0]; $jumlah_weekend = $week_kind[1];
	} else { //jika dimulai dri weekday
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
	} else {
		$diskon = 0;
	}

  $proses = new Transaksi_broker($db);

  $add_transaksi = $proses->addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $check_in, $check_out, $jumlah_weekend, $jumlah_weekday, $hari, $harga_sewa, $harga_sewa_we, $harga_sewa_gbg, $tgl_transaksi, $diskon, $ekstra_charge, $kd_kas, $tamu, $kd_booking, $dp, $total, $total_harga_owner, $sisa_pelunasan, 1, $h_owner_wd, $h_owner_we,$catatan, $deposit, $status_broker);

  if($add_transaksi == "Success"){
  	// Kirim notifikasi
  	if($status_broker=='B'){
		$proses_o = new Owner($db);
		$proses_f = new fcm($db);

	    $show_o = $proses_o->editOwner($kd_owner);
	    $data_o = $show_o->fetch(PDO::FETCH_OBJ);
	    $username = $data_o->username;

	    // $show_f = $proses_f->showToken($username);
	    // $data_f = $show_f->fetch(PDO::FETCH_OBJ);
	    // $token = $data_f->token;

	    // //Notif
	    // $registration_ids = array($token);
	    // $pushNotif = $proses_f->send_notification($registration_ids,'Selamat! Anda mendapat reservasi baru.');
	    //Notif END  
    	header('Location:../view/'.$view.'/transaksi/laporan_transaksi.php');

  	} else {
  		$proses2 = new Kas($db);
  		$proses->addUnit_kotor($kd_unit, $check_in, $check_out);
	    $show = $proses->showMaxTransaksi();
	    $data = $show->fetch(PDO::FETCH_OBJ);
	    $keterangan_mutasi = "6/".$data->kd_transaksi;

	    if($dp <> 0){
	      $add_mutasi = $proses2->addMutasiKas($kd_kas, $dp, 1, $tanggal, $keterangan_mutasi);

	      $show1 = $proses2->editSaldo($kd_kas);
	      $data1 = $show1->fetch(PDO::FETCH_OBJ);
	      $saldo = $dp + $data1->saldo;
	      $update_kas = $proses2->updateKas($kd_kas, $saldo, $tanggal);
	    }
    	header('Location:../croneTask/update_sys_cal.php?id='.$kd_unit.'&ics_update='.$view.'&page=transaksi/laporan_transaksi%php');
  	}

  }else{
    echo 'Tambah Transaksi Gagal !';
	}
}

//cek ketersediaan unit pada tanggal tertentu
elseif(isset($_POST['id1'])){
	$kd_unit = $_POST['id1'];
	$CI = $_POST['tci1'];
	$CO = $_POST['tco1'];
	$kd_broker = $_POST['broker'];
	$hasil = "Ada"; //tidak ada, maintenance, admin_block, owner_block
	$Proses = new Transaksi_broker($db);
	if($Proses->is_brokerSpace($kd_broker, $kd_unit, $CI, $CO)){
		if($Proses->showTransaksi_cek($CI,$CO,$kd_unit)) $hasil="Unit yang dipilih telah terisi";
	} else $hasil = "Tanggal atau Unit tersebut tidak tersedia untuk broker yang dipilih";
	$callback = array('ketersediaan'=>$hasil);
	echo json_encode($callback);
}

//Tambah Pembayaran
elseif(isset($_POST['addPembayaran'])){
	require("../class/transaksi.php");
	$proses = new Transaksi($db);

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
  	} else {
    	$add = $proses->addPembayaran($kd_transaksi, $pembayaran_baru, $sisa_pelunasan);
		header('Location:../view/'.$view.'/transaksi/laporan_transaksi.php?pembayaran='.$kd_transaksi);
  }
}


//Setlement Dp
elseif (isset($_POST['setlementDp']) && $view!="owner" && $view!="cleaner"){
	require("../class/transaksi.php");
  $kd_kas = $_POST['kas'];
  $setlement = $_POST['setlement'];
  $kd_transaksi = $_SESSION['kd_transaksi'];
  $status = 3;

  $proses_t = new Transaksi($db);
  $update = $proses_t->setlementDp($kd_transaksi, $setlement, $status);
  header('Location:../view/'.$view.'/transaksi/cancel_transaksi.php');
}

//update Transaksi
elseif(isset($_POST['updateTransaksi'])){
	require("../class/transaksi.php");	
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

  $add = $proses->updateTransaksi($kd_transaksi, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $harga_sewa_we, $harga_sewa_gbg, $diskon, $ekstra_charge, $kd_booking, $kd_kas, $dp, $total_tagihan, $total_harga_owner,$sisa_pelunasan, $hari, $jumlah_weekend, $jumlah_weekday, $h_owner_wd, $h_owner_we,$catatan,$deposit);

  if($add == "Success"){
    header('Location:../view/'.$view.'/transaksi/laporan_transaksi.php');
  } else {
    echo 'error';
  };
}

else {
	header("location:../view/".$view."/home/home.php");
}

?>
