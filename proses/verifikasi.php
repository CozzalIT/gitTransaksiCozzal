<?php 
  $pemilik = '';
  $Proses = new Unit($db);
  $show = $Proses->showUnitbyId($verif_unit);
  while($data = $show->fetch(PDO::FETCH_OBJ)){
  	$pemilik = $data->kd_owner;
  }
  if($_SESSION['pemilik']!=$pemilik) header('location:../../'.$_SESSION['hak_akses'].'/home/home.php');
?>