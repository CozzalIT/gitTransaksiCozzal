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

	  $update = $proses->updatePenyewa($kd_penyewa, $nama, $alamat, $no_tlp, $jenis_kelamin);

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
  
  
?>
