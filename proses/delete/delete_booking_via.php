<?php
  require("../proses_delete.php");
  $prosesDelete = new prosesDelete();
				 
  if(isset($_GET['delete'])){
	$del = $prosesDelete->deleteBooking_via($_GET['delete']);
	header("location:../../booking_via.php");
  }	
?>