<?php
  require('../proses_add.php');
  $prosesAdd = new prosesAdd();
  
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
 
  $add = $prosesAdd->addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $ekstra_charge, $kd_booking, $kd_bank, $dp);
  
  if($add == "Success"){
	header('Location:../../laporan_transaksi.php');
  }else{ 
    echo 'gagal';
	}
  }
?>