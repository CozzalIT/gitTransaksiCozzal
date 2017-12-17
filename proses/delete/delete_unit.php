<?php
  require("../proses_delete.php");
  $prosesDelete = new prosesDelete();

  if(isset($_GET['delete'])){
	$del = $prosesDelete->deleteUnit($_GET['delete']);
	header("location:../../unit.php");
  }
?>
