<?php
require("../../config/database.php");
require("../class/booking.php");
// session_start();
$view = $_SESSION['hak_akses'];

//Tambah Booking Via
if(isset($_POST['addBooking_via'])){
  $kd_booking = $_POST['kd_booking'];
  $booking_via = $_POST['booking_via'];

  $proses = new Booking($db);
  $add = $proses->addBooking_via($kd_booking, $booking_via);

  // Log System
  //$logs->addLog('ADD','tb_booking_via','Add booking',json_encode([$kd_booking, $booking_via]),null);

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

  // Log System
  //$logs->addLog('Update','tb_booking_via','Update booking',json_encode([$kd_booking, $booking_via]),null);

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

  // Log System
  //$logs->addLog('Delete','tb_booking_view','Delete booking',json_encode([$_GET['delete_booking']]),null);

  header("location:../view/".$view."/booking/booking_via.php");
}

//Delete Booking resquest
elseif(isset($_GET['delete_booking_rq']) && ($view=="superadmin" || $view=="manager")){
  $proses = new Booking($db);
  $del = $proses->deleteReservasi($_GET['delete_booking_rq']);
  // Log System
  //$logs->addLog('Delete','tb_reservasi','Delete reservasi',json_encode([$_GET['delete_booking_rq']]),null);

  header("location:../view/".$view."/booking/booking_request.php");
}

else header('Location:../view/'.$view.'/home/home.php');
?>
