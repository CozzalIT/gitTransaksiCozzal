<?php
  require("../proses_delete.php");
  $prosesDelete = new prosesDelete();

  if(isset($_GET['delete'])){
	$del = $prosesDelete->deleteApartemen($_GET['delete']);
	header("location:../../apartemen.php");
  }
?>
