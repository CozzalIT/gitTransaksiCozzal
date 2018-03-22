<?php
require("../../config/database.php");
require("../class/task.php");
session_start();
$view = $_SESSION['hak_akses'];
date_default_timezone_set('Asia/Jakarta');
$sekarang = date('Y-m-d');  

//Tambah task
if(isset($_POST['addTask'])){
  $task = $_POST['task'];
  $unit = $_POST['unit'];
  $sifat = $_POST['sifat'];
  $proses = new Task($db);
  $add = $proses->addTask($task, $unit, $sifat);
  if($sifat!="Sekali"){
    $kd_unit_base = "0";
    while($data = $add->fetch(PDO::FETCH_OBJ)){$kd_unit_base .= "/".$data->kd_unit;}
    if($kd_unit_base=="0"){
      $show_kotor = $proses->showUnit_kotor($sekarang);
      while($data = $show_kotor->fetch(PDO::FETCH_OBJ)){$kd_unit_base .= "/".$data->kd_unit;}
    }
    if($kd_unit_base!="0"){
      $kd_unit = explode("/", $kd_unit_base);
      for($i=1; $i<count($kd_unit); $i++) {
        $proses->updateTask_Unit2($kd_unit[$i]);
      }
    }
  }
  header('Location:../view/'.$view.'/unit/task.php');
}

elseif(isset($_POST['updateTask'])){
  $kd_task = $_POST['kd_task'];
  $task = $_POST['task'];
  $unit = $_POST['unit'];
  $sifat = $_POST['sifat'];
  $proses = new Task($db);
  $add = $proses->updateTask($kd_task ,$task, $unit, $sifat);
  if($add == "Success"){
    header('Location:../view/'.$view.'/unit/task.php');
  }
  else echo "error";
}

elseif(isset($_GET['delete_task'])){
  $kd_task = $_GET['delete_task'];
  $proses = new Task($db);
  $add = $proses->deleteTask($kd_task);
  if($add == "Success"){
    header('Location:../view/'.$view.'/unit/task.php');
  }
  else echo "error";
}

// ------- Cleaner Part -----------
//kosongkan unit ketika mau membersihkan unit
elseif(isset($_GET['kosongkan_unit'])){
  $kd_unit = $_GET['kosongkan_unit'];
  require("../class/cleaner.php");
  $jam_sekarang = strtotime(date("H:i:s"));
  $jam_sekarang -= 60;
  $jam = date("H:i",$jam_sekarang);
  $jam .= ":00";
  $proses = new Cleaner($db);
  $proses->kosongkan_unit($kd_unit, $sekarang, $jam);
  header('Location:../view/'.$view.'/unit/status.php');
}

elseif(isset($_GET['set_ready'])){
  $ready = $_GET['set_ready'];
  $kd_unit = $_GET['kd_unit'];
  require("../class/cleaner.php");
  $proses = new Cleaner($db);
  $proses->updateUnit_ready($kd_unit, $ready);
  header('Location:../view/'.$view.'/unit/status.php');
}

elseif(isset($_POST['bersih_task'])){
  $kd_unit = $_POST["unit"];
  $task1 = $_POST["task-temp"];
  $proses = new Task($db);
  $task = explode('/', $task1);
  $hit = count($task); $hit_del = 1;
  for($i=1; $i<count($task); $i++){
    if(isset($_POST[$task[$i]."-ck"])){
        $del = $proses->deleteTask_unit($kd_unit,$task[$i]);
        $hit_del++;
    }
  }
  if($hit==$hit_del){
    require("../class/cleaner.php");
    $Proses2 = new Cleaner($db);
    $Proses2->updateLihat_ready($kd_unit, $sekarang);
    $Proses2->deleteUnit_kotor($kd_unit, $sekarang);
  }
  header('Location:../view/'.$view.'/unit/status.php');
}

// ------------- JSON PART -----------------------

// edit task with popup 
elseif(isset($_POST['id'])){
  $kd_task = $_POST['id'];
  $Proses = new Task($db);
  $show = $Proses->editTask($kd_task);
  $data = $show->fetch(PDO::FETCH_OBJ);
  $task = $data->task;
  $unit = $data->unit;
  $sifat = $data->sifat;
  $callback = array('task'=>$task, 'unit'=>$unit, 'sifat'=>$sifat);
  echo json_encode($callback);  
}

//update task unit pada status kotor saat memuat data
elseif(isset($_POST['updateTask_unit'])){
  $kd_unit = $_POST['updateTask_unit'];
  $Proses = new Task($db); $CO = "0000-00-00";
  $show = $Proses->getCOdate($kd_unit, $sekarang);
  while($data = $show->fetch(PDO::FETCH_OBJ)){
    $CO = $data->check_out;
  }
  $is_updated = $Proses->isTask_updated($kd_unit, $CO);
  if($is_updated==false){
    $update = $Proses->updateTask_Unit($kd_unit, $CO);
  }
  require("../class/catatan.php"); $i=0;
  $Proses2 = new Catatan($db);
  $show2 = $Proses2->showCatatanUnit($kd_unit);
  while($data2 = $show2->fetch(PDO::FETCH_OBJ)){
    $i++;
  } 
  $callback = array('done'=>$CO,'catatan'=>$i);
  echo json_encode($callback);  
}

elseif(isset($_POST['ajx_id'])){
  require("../class/catatan.php");
  $kd_unit = $_POST['ajx_id'];
  $jumlah = 0; $html = "";
  $val = "'#del'"; $but = "'#del-note'";
  $Proses = new Catatan($db);
  $show = $Proses->showCatatanUnit($kd_unit);
  while($data = $show->fetch(PDO::FETCH_OBJ)){
  $kd = "'".$data->kd_catatan."'";
  $jumlah++;
    $html .= '<div class="note" id="'.$data->kd_catatan.'">';
    $html .= ' <a class="close" onclick="$('.$val.').text('.$kd.'); $('.$but.').click();">×</a>';
    $html .= $data->catatan.'</div>';
  }
  if($jumlah==0) $html = '<div id="empty-note" class="note">Tidak tersedia catatan pada unit ini.</div>';
 
  $Proses = new Task($db); $jumlah2=0; $html2=""; $all_task="0";
  $show = $Proses->showTask_byunit($kd_unit);
  while($data = $show->fetch(PDO::FETCH_OBJ)){
  $jumlah2++; $all_task .= "/".$data->kd_task;
    $html2 .= '<div class="controls my">';
    $html2 .= '<input type="checkbox" class="ck" name="'.$data->kd_task.'-ck">'.$data->task.'</div>';
  }
  if($jumlah2==0){
    $html2 = '<div id="empty-task" class="note">Task belum tersedia.';
    $html2.= 'Silahkan isi terlebih dahulu pada menu <a style="color:#169595;" href="task.php">Task Cleaner</a></div>';
  } 
  $callback = array('konten'=>$html, 'jumlah'=>$jumlah, 'konten2'=>$html2, 'jumlah2'=>$jumlah2, 'task'=>$all_task);
  echo json_encode($callback);
}

else header('Location:../view/'.$view.'/home/home.php');
?>
