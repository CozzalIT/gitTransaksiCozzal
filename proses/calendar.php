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

elseif(isset($_POST['addMaintenance']) && ($view == 'admin' || $view == 'superadmin')){
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

elseif(isset($_GET['delete_event'])){
  $proses = new Calendar($db);
  $show = $proses->editModCalendar($_GET['delete_event']);
  $data = $show->fetch(PDO::FETCH_OBJ);
  $kd_unit = $data->kd_unit;

  $del = $proses->deleteModCalendar($_GET['delete_event']);
  header("location:../view/".$view."/unit/calendar.php?calendar_unit=".$kd_unit);
}

//Update Event
elseif(isset($_POST['updateModCal'])){
	$kd_mod_calendar = $_POST['id'];
  $awal = $_POST['awal'];
  $akhir = $_POST['akhir'];
  $catatan = $_POST['catatan'];

  $proses = new Calendar($db);
  $show = $proses->editModCalendar($_POST['id']);
  $data = $show->fetch(PDO::FETCH_OBJ);
  $kd_unit = $data->kd_unit;

	$update = $proses->updateModCal($kd_mod_calendar, $awal, $akhir, $catatan);


  if($update == "Success"){
    header('Location:../view/'.$view.'/unit/calendar.php?calendar_unit='.$kd_unit);
  }else{
    echo 'error';
  }
}
?>
