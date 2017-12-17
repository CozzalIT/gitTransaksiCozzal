<?php
  require('../proses_update.php');
  $prosesUpdate = new prosesUpdate();

  if(isset($_POST['updateBooking'])){
	$kd_booking = $_POST['kd_booking'];
    $booking_via = $_POST['booking_via'];
		 
	$update = $prosesUpdate->updateBooking($kd_booking, $booking_via);
	  
	if($update == "Success"){
	  header('Location:../../booking_via.php');
	} else {
	  echo 'error';
	}
  }
?>