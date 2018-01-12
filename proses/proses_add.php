<?php
  require('proses.php');
  $proses = new proses();

//Tambah Penyewa
  if(isset($_POST['addPenyewa'])){
	  $nama = $_POST['nama'];
	  $alamat = $_POST['alamat'];
	  $no_tlp = $_POST['no_tlp'];
	  $jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];
    $tgl_gabung = date('Y-m-d');

    $add = $proses->addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung);

    if($add == "Success"){
	    header('Location:../penyewa.php');
    }
  }

//Tambah Penyewa di Halaman Transaksi
  if(isset($_POST['addPenyewaTransaksi'])){
    $nama = $_POST['nama'];
	  $alamat = $_POST['alamat'];
	  $no_tlp = $_POST['no_tlp'];
	  $jenis_kelamin = $_POST['jenis_kelamin'];

    $add = $proses->addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin);
    $Proses = new Proses();
    $show = $Proses->showPenyewaTransaksi();
    $data = $show->fetch(PDO::FETCH_OBJ);

    if($add == "Success"){
	    header('Location:../transaksi.php?nama='.$nama.'&alamat='.$alamat.'&no_tlp='.$no_tlp.'&jenis_kelamin='.$jenis_kelamin.'&kd_penyewa='.$data->kd_penyewa);
    }
  }

//Tambah Apartemen
  if(isset($_POST['addApartemen'])){
	  $nama_apt = $_POST['nama_apt'];
	  $alamat_apt = $_POST['alamat_apt'];

    $add = $proses->addApartemen($nama_apt, $alamat_apt);

    if($add == "Success"){
	    header('Location:../apartemen.php');
    }
  }

//Tambah Unit
  if(isset($_POST['addUnit'])){
    $kd_apt = $_POST['apartemen'];
    $no_unit = $_POST['no_unit'];
    $h_sewa_wd = $_POST['h_sewa_wd'];
    $h_sewa_we = $_POST['h_sewa_we'];
    $h_owner_wd = $_POST['h_owner_wd'];
    $h_owner_we = $_POST['h_owner_we'];
    $ekstra_charge = $_POST['ekstra_charge'];
	$kd_owner = $_POST['kd_owner'];

    $add = $proses->addUnit($kd_apt,$kd_owner, $no_unit, $h_sewa_wd, $h_sewa_we, $h_owner_wd, $h_owner_we, $ekstra_charge);
	$add2 = $proses->updateJumlah_unit_owner($kd_owner);

    if(($add == "Success") || ($add2 == "Success")){
	header('Location:../unit.php');
	}else{ echo 'error';}
  }

//Tambah Booking Via
  if(isset($_POST['addBooking_via'])){
	  $kd_booking = $_POST['kd_booking'];
	  $booking_via = $_POST['booking_via'];

    $add = $proses->addBooking_via($kd_booking, $booking_via);

    if($add == "Success"){
	    header('Location:../booking_via.php');
    }
  }

//Tambah DP Via
  if(isset($_POST['addDp_via'])){
	  $kd_bank = $_POST['kd_bank'];
	  $nama_bank= $_POST['nama_bank'];

    $add = $proses->addDp_via($kd_bank, $nama_bank);

    if($add == "Success"){
	    header('Location:../dp_via.php');
    }
  }

//Tambah Owner
  if(isset($_POST['addOwner'])){
	  $nama= $_POST['nama'];
	  $alamat= $_POST['alamat'];
	  $no_tlp= $_POST['no_tlp'];
	  $kd_bank= $_POST['kd_bank'];
	  $no_rek= $_POST['no_rek'];
	  $tgl_gabung= date('y-m-d');
	  $email= $_POST['email'];
	  $jenis_kelamin= $_POST['jenis_kelamin'];

    $add = $proses->addOwner($nama, $alamat, $no_tlp, $kd_bank, $no_rek, $tgl_gabung, $email, $jenis_kelamin);

    if($add == "Success"){
	    header('Location:../owner.php');
    }
	else echo 'error';
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
	  $ekstra_charge 	= $_POST['ekstra_charge'];
	  $kd_booking 	= $_POST['booking_via'];
	  $kd_bank 		= $_POST['dp_via'];
	  $dp 			= $_POST['dp'];
    $total  = $_POST['total'];
    $sisa_pelunasan = $total - $dp;
    $hari = $_POST['jumhari'];
    $tgl_transaksi = date('y-m-d');

    $add = $proses->addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $ekstra_charge, $kd_booking, $kd_bank, $dp, $total, $sisa_pelunasan, $hari, $tgl_transaksi);

    if($add == "Success"){
	    header('Location:../laporan_transaksi.php');
      }else{
        echo 'gagal';
	    }
    }
?>
