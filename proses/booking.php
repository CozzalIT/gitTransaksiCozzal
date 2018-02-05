<?php
require("../config/database.php");
require("../class/booking.php");

//Tambah Booking Via
if(isset($_POST['addBooking_via'])){
	$kd_booking = $_POST['kd_booking'];
	$booking_via = $_POST['booking_via'];

  $proses = new Booking($db);
  $add = $proses->addBooking_via($kd_booking, $booking_via);

  if($add == "Success"){
	  header('Location:../view/superadmin/booking/booking_via.php');
  }
}

//Delete Booking Via
if(isset($_GET['delete_booking'])){
  $proses = new Booking($db);
  $del = $proses->deleteBooking_via($_GET['delete_booking']);
  header("location:../view/superadmin/booking/booking_via.php");
}

//Update Booking Via
if(isset($_POST['updateBooking'])){
  $kd_booking = $_POST['kd_booking'];
  $booking_via = $_POST['booking_via'];

  $proses = new Booking($db);
  $update = $proses->updateBooking($kd_booking, $booking_via);

  if($update == "Success"){
    header('Location:../view/superadmin/booking/booking_via.php');
  } else {
    echo 'error';
  }
}
?>
