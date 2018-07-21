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

  if($view == 'partner'){
    $jenis = 4;
  }elseif($view == 'superadmin' || $view == 'admin'){
    $jenis = 3;
  }elseif($view == 'owner'){
    $jenis = 2;
  }

  $proses = new Calendar($db);
  $add = $proses->addModCalendar($kd_unit, $start_date, $end_date, $note, $jenis);
  $ics = new Ics_unit($db);
  $ics->buildIcs($kd_unit);

  // Log System
  //$logs->addLog('ADD','tb_mod_calendar','Tambah mod calender',json_encode([$kd_unit, $start_date, $end_date, $note, $jenis]),null);

  if($add == "Success"){
    if ($jenis == 4) {
      header('Location:../view/'.$view.'/kalender/kalender.php');
    }else{
      header('Location:../view/'.$view.'/unit/calendar.php?calendar_unit='.$kd_unit);
    }
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

  // Log System
  //$logs->addLog('ADD','tb_mod_calendar','Tambah mod calender',json_encode([$kd_unit, $start_date, $end_date, $note, $jenis]),null);

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

  // Log System
  //$logs->addLog('ADD','tb_mod_harga','Tambah mod harga',json_encode([$kd_unit, $start_date, $end_date, $harga_sewa, $harga_owner, $note]),null);

  if($add == "Success"){
    header('Location:../view/'.$view.'/unit/calendar.php?calendar_unit='.$kd_unit);
  }else{
    echo 'error';
  }
}

elseif(isset($_GET['delete_event'])){
#  echo $_GET['status_mod'];
#  die;
  $proses = new Calendar($db);

  if($_GET['status_mod'] == 'true'){
    $show = $proses->editModHarga($_GET['delete_event']);
    $del = $proses->deleteModHarga($_GET['delete_event']);
  }elseif($_GET['status_mod'] == 'false'){
    $show = $proses->editModCalendar($_GET['delete_event']);
    $del = $proses->deleteModCalendar($_GET['delete_event']);
    $ics = new Ics_unit($db);
    $ics->buildIcs($kd_unit);
  }

  // Log System
  //$logs->addLog('Delete','tb_mod_calender','Hapus mod calender',json_encode([$_GET['delete_event']]),null);


  $data = $show->fetch(PDO::FETCH_OBJ);
  $kd_unit = $data->kd_unit;
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

  // Log System
  //$logs->addLog('Update','tb_mod_calender','Update mod calendar',json_encode([$kd_mod_calendar, $awal, $akhir, $catatan]),null);

  $ics = new Ics_unit($db);
  $ics->buildIcs($kd_unit);


  if($update == "Success"){
    header('Location:../view/'.$view.'/unit/calendar.php?calendar_unit='.$kd_unit);
  }else{
    echo 'error';
  }
}

elseif(isset($_POST['updateModHarga'])){
	$kd_mod_harga = $_POST['id'];
  $awal = $_POST['awal'];
  $akhir = $_POST['akhir'];
  $catatan = $_POST['catatan'];
  $sewa = $_POST['sewa'];
  $owner = $_POST['owner'];

  $proses = new Calendar($db);
  $show = $proses->editModHarga($_POST['id']);
  $data = $show->fetch(PDO::FETCH_OBJ);
  $kd_unit = $data->kd_unit;

	$update = $proses->updateModHarga($kd_mod_harga, $awal, $akhir, $sewa, $owner, $catatan);

  // Log System
  //$logs->addLog('Update','tb_mod_harga','Update mod harga',json_encode([$kd_mod_harga, $awal, $akhir, $sewa, $owner, $catatan]),null);

  if($update == "Success"){
    header('Location:../view/'.$view.'/unit/calendar.php?calendar_unit='.$kd_unit);
  }else{
    echo 'error';
  }
}

// proses add URL baru ( selain URL sistem/cozzal )
elseif(isset($_POST['addURL'])){
  $kd_unit = $_POST['kd_unit'];
  $title = $_POST['nama_url'];
  $jenis = "1"; // 1 menandakan bahwa url tersebut adalah url non sistem
  $url = $_POST['url'];
  $group_update = $_POST['group_update'];
  $proses = new Ics_unit($db);
  $proses->buildURL($kd_unit, $title, $jenis, $url, $group_update);
  header('Location:../view/'.$view.'/unit/calendar.php?calendar_unit='.$kd_unit);
}

elseif(isset($_POST['updateURL'])){
  $kd_url = $_POST['kd_url'];
  $kd_unit = $_POST['kd_unit'];
  $title = $_POST['nama_url'];
  $jenis = "1"; // 1 menandakan bahwa url tersebut adalah url non sistem
  $url = $_POST['url'];
  $group_update = $_POST['group_update'];
  $proses = new Ics_unit($db);
  $proses->updateURL($kd_url, $title, $jenis, $url, $group_update);
  header('Location:../view/'.$view.'/unit/calendar.php?calendar_unit='.$kd_unit);
}

elseif(isset($_GET['deleteURL'])){
  $kd_url = $_GET['deleteURL'];
  $kd_unit = $_GET['kd_unit'];
  $proses = new Calendar($db);
  $proses->deleteURL($kd_url);
  header('Location:../view/'.$view.'/unit/calendar.php?calendar_unit='.$kd_unit);
}

elseif(isset($_POST['showKd_url'])){
  $kd_url = $_POST['showKd_url'];
  $proses = new Calendar($db);
  $show = $proses->editURL($kd_url);
  $data = $show->fetch(PDO::FETCH_OBJ);
  echo json_encode($data);
}

else{
  header('Location:../view/'.$view.'/home/home.php');
}
?>
