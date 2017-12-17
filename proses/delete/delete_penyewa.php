<?php
  require("../proses_delete.php");
  $prosesDelete = new prosesDelete();
				 
  if(isset($_GET['delete'])){
	$del = $prosesDelete->deletePenyewa($_GET['delete']);
	header("location:../../penyewa.php");
  }	
?>