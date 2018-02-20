<?php
require("../config/database.php");
require("../class/calendar.php");
session_start();
$view = $_SESSION['hak_akses'];

if(isset($_POST['blokCalendar'])){
  $kd_unit = $_POST['kd_unit'];
  $start_date = $_POST['awal'];
  $end_date = $_POST['akhir'];
  $note = $_POST['catatan'];

  if($view == 'superadmin' || $view == 'admin'){
    $jenis = 3;
  }elseif($view == 'owner'){
    $jenis = 2;
  }

  $proses = new Calendar($db);
  $add = $proses->addModCalendar($kd_unit, $start_date, $end_date, $note, $jenis);

  if($add == "Success"){
	  header('Location:../view/'.$view.'/unit/calendar.php?calendar_unit='.$kd_unit);
  }else{
    echo 'error';
  }
}

elseif(isset($_POST['addMaintenance']) && ($view = 'admin' || $view = 'superadmin')){
  $kd_unit = $_POST['kd_unit'];
  $start_date = $_POST['awal'];
  $end_date = $_POST['akhir'];
  $note = $_POST['catatan'];
  $jenis = 1;

  $proses = new Calendar($db);
  $add = $proses->addModCalendar($kd_unit, $start_date, $end_date, $note, $jenis);

  if($add == "Success"){
    header('Location:../view/'.$view.'/unit/calendar.php?calendar_unit='.$kd_unit);
  }else{
    echo 'error';
  }
}
?>
