<?php
require("../../config/database.php");
require("../class/booking.php");
session_start();
$view = $_SESSION['hak_akses'];

//Tambah Booking Via
if(isset($_POST['addBooking_via'])){
  $kd_booking = $_POST['kd_booking'];
  $booking_via = $_POST['booking_via'];

  $proses = new Booking($db);
  $add = $proses->addBooking_via($kd_booking, $booking_via);

  if($add == "Success"){
    header('Location:../view/'.$view.'/booking/booking_via.php');
   }
}

//Update Booking Via
elseif(isset($_POST['updateBooking'])){
  $kd_booking = $_POST['kd_booking'];
  $booking_via = $_POST['booking_via'];

  $proses = new Booking($db);
  $update = $proses->updateBooking($kd_booking, $booking_via);

  if($update == "Success"){
    header('Location:../view/'.$view.'/booking/booking_via.php');
  } else {
    echo 'error';
  }
}

//Delete Booking Via
elseif(isset($_GET['delete_booking']) && ($view=="superadmin" || $view=="manager")){
  $proses = new Booking($db);
  $del = $proses->deleteBooking_via($_GET['delete_booking']);
  header("location:../view/".$view."/booking/booking_via.php");
}

//Delete Booking resquest
elseif(isset($_GET['delete_booking_rq']) && ($view=="superadmin" || $view=="manager")){
  $proses = new Booking($db);
  $del = $proses->deleteReservasi($_GET['delete_booking_rq']);
  header("location:../view/".$view."/booking/booking_request.php");
}

else header('Location:../view/'.$view.'/home/home.php');
?>
