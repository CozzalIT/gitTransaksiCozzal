<?php
require("../../config/database.php");
require("../class/calendar.php");
require("../class/unit.php");
require("../class/ics_unit.php");
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
  $ics = new Ics_unit($db);
  $ics->buildIcs($kd_unit);

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

  $ics = new Ics_unit($db);
  $ics->buildIcs($kd_unit);

  if($add == "Success"){
    header('Location:../view/'.$view.'/unit/calendar.php?calendar_unit='.$kd_unit);
  }else{
    echo 'error';
  }
}

elseif(isset($_POST['addModHarga'])){
  $proses_c = new Calendar($db);
  $proses_u = new Unit($db);
  $jenis = $_POST['jenis'];
  $kd_unit = $_POST['kd_unit'];
  $note = $_POST['note'];
  $start_date = $_POST['awal'];
  $end_date = $_POST['akhir'];

  if($jenis == 'hargaWeekend'){
    $show_u = $proses_u->editUnit($kd_unit);
    $data_u = $show_u->fetch(PDO::FETCH_OBJ);
    $harga_sewa = $data_u->h_sewa_we;
    $harga_owner = $data_u->h_owner_we;
    $add = $proses_c->addModHarga($kd_unit, $start_date, $end_date, $harga_sewa, $harga_owner, $note);
  }elseif($jenis == 'hargaBaru'){
    $harga_sewa = $_POST['harga_sewa'];
    $harga_owner = $_POST['harga_owner'];
    $add = $proses_c->addModHarga($kd_unit, $start_date, $end_date, $harga_sewa, $harga_owner, $note);
  }

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

  $ics = new Ics_unit($db);
  $ics->buildIcs($kd_unit);
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

  $ics = new Ics_unit($db);
  $ics->buildIcs($kd_unit);


  if($update == "Success"){
    header('Location:../view/'.$view.'/unit/calendar.php?calendar_unit='.$kd_unit);
  }else{
    echo 'error';
  }
}
?>
