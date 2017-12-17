<?php
  require("../proses_delete.php");
  $prosesDelete = new prosesDelete();
				 
  if(isset($_GET['delete'])){
	$del = $prosesDelete->deleteDp_via($_GET['delete']);
	header("location:../../dp_via.php");
  }	
?>