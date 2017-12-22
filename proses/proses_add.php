<?php
  require('proses.php');
  $proses = new proses();

//Tambah Penyewa
  if(isset($_POST['addPenyewa'])){
	  $nama = $_POST['nama'];
	  $alamat = $_POST['alamat'];
	  $no_tlp = $_POST['no_tlp'];
	  $jenis_kelamin = $_POST['jenis_kelamin'];

    $add = $proses->addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin);

    if($add == "Success"){
	    header('Location:../penyewa.php');
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
  if(isset($_POST['add_owner'])){
	  $kd_apt = $_POST['kd_bank'];
	  $nama_bank= $_POST['nama_bank'];

    $add = $proses->add_owner($kd_apt, $nama, $alamat, $no_tlp, $kd_bank, $no_rek, $tgl_gabung);

    if($add == "Success"){
	    header('Location:../dp_via.php');
    }
  }

//Tambah Transaksi
  if(isset($_POST['addTransaksi'])){
	  $kd_penyewa 	= $_POST['kd_penyewa'];
	  $kd_apt 		= $_POST['apartemen'];
	  $kd_unit 		= $_POST['unit'];
	  $tamu 			= $_POST['tamu'];
	  $check_in 		= $_POST['check_in'];
	  $check_out 		= $_POST['check_out'];
	  $harga_sewa 	= $_POST['harga_sewa'];
	  $ekstra_charge 	= $_POST['ekstra_charge'];
	  $kd_booking 	= $_POST['booking_via'];
	  $kd_bank 		= $_POST['dp_via'];
	  $dp 			= $_POST['dp'];

    $add = $proses->addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $ekstra_charge, $kd_booking, $kd_bank, $dp);

    if($add == "Success"){
	    header('Location:../laporan_transaksi.php');
      }else{
        echo 'gagal';
	    }
    }
?>
