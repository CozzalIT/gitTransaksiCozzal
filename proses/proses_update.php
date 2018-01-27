<?php
  require('proses.php');
  $proses = new proses();

//Update Penyewa
  if(isset($_POST['updatePenyewa'])){
	  $kd_penyewa = $_POST['kd_penyewa'];
    $nama = $_POST['nama'];
  	$alamat = $_POST['alamat'];
  	$no_tlp = $_POST['no_tlp'];
  	$jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];

	  $update = $proses->updatePenyewa($kd_penyewa, $nama, $alamat, $no_tlp, $jenis_kelamin, $email);

  	if($update == "Success"){
  	  header('Location:../penyewa.php');
  	  } else {
  	    echo 'error';
	  }
  }

//Update Apartemen
  if(isset($_POST['updateApartemen'])){
    $kd_apt = $_POST['kd_apt'];
    $nama_apt = $_POST['nama_apt'];
    $alamat_apt = $_POST['alamat_apt'];

    $update = $proses->updateApartemen($kd_apt, $nama_apt, $alamat_apt);

    if($update == "Success"){
      header('Location:../apartemen.php');
      } else {
        echo 'error';
      }
    }

//Update Bank (DP Via)
  if(isset($_POST['updateBank'])){
  	$kd_bank = $_POST['kd_bank'];
    $nama_bank = $_POST['nama_bank'];

  	$update = $proses->updateBank($kd_bank, $nama_bank);

  	if($update == "Success"){
  	  header('Location:../dp_via.php');
  	  } else {
  	    echo 'error';
  	}
  }

//Update Booking Via
  if(isset($_POST['updateBooking'])){
    $kd_booking = $_POST['kd_booking'];
    $booking_via = $_POST['booking_via'];

    $update = $proses->updateBooking($kd_booking, $booking_via);

    if($update == "Success"){
      header('Location:../booking_via.php');
    } else {
      echo 'error';
    }
  }

 //Update Penyewa
  if(isset($_POST['updatePenyewa'])){
    $kd_penyewa = $_POST['kd_penyewa'];
    $nama = $_POST['nama'];
  	$alamat = $_POST['alamat'];
  	$no_tlp = $_POST['no_tlp'];
  	$jenis_kelamin = $_POST['jenis_kelamin'];

	  $update = $proses->updatePenyewa($kd_penyewa, $nama, $alamat, $no_tlp, $jenis_kelamin);

  	if($update == "Success"){
  	  header('Location:../penyewa.php');
  	  } else {
  	    echo 'error';
	  }
  }

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

    $add = $proses->updateOwner($kd_owner ,$nama, $alamat, $no_tlp, $kd_bank, $no_rek, $email, $jenis_kelamin);

    if($add == "Success"){
	    header('Location:../owner.php');
    }
	else echo 'error';
  }

//Update Detail Unit
  if(isset($_POST['detail_unit'])){
    $kd_unit = $_POST['kd_unit'];
    $lantai = $_POST['lantai'];
    $jml_kmr = $_POST['jml_kmr'];
    $jml_bed = $_POST['jml_bed'];
    $jml_ac = $_POST['jml_ac'];
    $water_heater = $_POST['water_heater'];
    $dapur = $_POST['dapur'];
    $wifi = $_POST['wifi'];
    $tv = $_POST['tv'];
    $amenities = $_POST['amenities'];
    $merokok = $_POST['merokok'];

    $add = $proses->updateDetail_Unit($kd_unit, $lantai, $jml_kmr, $jml_bed, $jml_ac, $water_heater, $dapur, $wifi, $tv, $amenities, $merokok);

    if($add == "Success"){
      header('Location:../unit.php');
    }
  else echo 'error';
  }


//update Unit
  if(isset($_POST['updateUnit'])){
	  $kd_unit= $_POST['kd_unit'];
	  $owner= $_POST['kd_owner_lama'];
	  $kd_apt= $_POST['apartemen'];
	  $kd_owner= $_POST['owner'];
	  $no_unit= $_POST['no_unit'];
	  $h_owner_wd= $_POST['h_owner_wd'];
	  $h_owner_we= $_POST['h_owner_we'];
	  $h_sewa_wd= $_POST['h_sewa_wd'];
	  $h_sewa_we= $_POST['h_sewa_we'];
	  $ekstra_charge= $_POST['ekstra_charge'];

    $add = $proses->updateUnit($kd_unit ,$kd_apt,$kd_owner, $no_unit, $h_owner_wd, $h_owner_we, $h_sewa_wd, $h_sewa_we, $ekstra_charge);
	if($owner!=$kd_owner)
	{
		$add = $proses->updateJumlah_unit_owner($kd_owner);
		$add = $proses->updateKurangi_jumlah_unit_owner($owner);
	}
    if($add == "Success"){
	    header('Location:../unit.php');
    }
	else echo 'error';
  }

//update Transaksi
  if(isset($_POST['updateTransaksi'])){
    $kd_transaksi = $_POST['kd_transaksi'];
    $kd_apt     = $_POST['apartemen'];
    $kode = explode("+",$_POST['unit']);
    $kd_unit    = $kode[0];
    $tamu       = $_POST['tamu'];
    $check_in     = $_POST['check_in'];
    $check_out    = $_POST['check_out'];
    $harga_sewa   = $_POST['harga_sewa'];
    $harga_sewa_asli   = $_POST['harga_sewa_asli'];
    $diskon = 0;
    if($harga_sewa<$harga_sewa_asli){
       $diskon = $harga_sewa_asli-$harga_sewa;
    }
    $ekstra_charge  = $_POST['ekstra_charge'];
    $kd_booking   = $_POST['booking_via'];
    $kd_bank    = $_POST['dp_via'];
    $dp       = $_POST['dp'];
    $total_tagihan  = $_POST['total'];
    $sisa_pelunasan = $total_tagihan - $dp;
    $hari = $_POST['jumhari'];

    $add = $proses->updateTransaksi($kd_transaksi, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $diskon, $ekstra_charge, $kd_booking, $kd_bank, $dp, $total_tagihan, $sisa_pelunasan, $hari); 
    if($add == "Success"){
      header('Location:../laporan_transaksi.php');
    }
  else echo 'error';
  }  

?>
