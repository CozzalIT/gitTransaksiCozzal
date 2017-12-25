<?php
  require('proses.php');
  $proses = new proses();

//Delete Penyewa
  if(isset($_GET['delete_penyewa'])){
    $del = $proses->deletePenyewa($_GET['delete_penyewa']);
    header("location:../penyewa.php");
  }

//Delete Apartemen
  if(isset($_GET['delete_apt'])){
    $del = $proses->deleteApartemen($_GET['delete_apt']);
    header("location:../apartemen.php");
  }

//Delete Unit
  if(isset($_GET['delete_unit']) || isset($_GET['kurangi_ju'])){
    $del = $proses->deleteUnit($_GET['delete_unit']);
	$del = $proses->updateKurangi_jumlah_unit_owner($_GET['kurangi_ju']);
    header("location:../unit.php");
  }

//Delete Booking Via
  if(isset($_GET['delete_booking'])){
    $del = $proses->deleteBooking_via($_GET['delete_booking']);
    header("location:../booking_via.php");
  }

//Delete Owner
  if(isset($_GET['delete_owner'])){
	$del = $proses->deleteOwner($_GET['delete_owner']);
	header("location:../owner.php");
  }

//Delete DP Via
  if(isset($_GET['delete_dp'])){
    $del = $proses->deleteDp_via($_GET['delete_dp']);
    header("location:../dp_via.php");
  }
?>
