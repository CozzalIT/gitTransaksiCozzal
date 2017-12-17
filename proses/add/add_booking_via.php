`<?php
  require('../proses_add.php');
  $prosesAdd = new prosesAdd();
  
  if(isset($_POST['addBooking_via'])){
	$kd_booking = $_POST['kd_booking'];
	$booking_via = $_POST['booking_via'];
	
  $add = $prosesAdd->addBooking_via($kd_booking, $booking_via);
  
  if($add == "Success"){
	header('Location:../../booking_via.php');
  }
}
?>