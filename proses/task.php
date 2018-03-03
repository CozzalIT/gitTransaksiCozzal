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
  $stmp = date('U');
  $proses = new Task($db);
  $add = $proses->addTask($task, $unit, $sifat, $stmp);
  if($add == "Success"){
    header('Location:../view/'.$view.'/unit/task.php');
  }
  else echo "error";
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

elseif(isset($_POST['bersih_task'])){
  $kd_unit = $_POST["unit"];
  $task1 = $_POST["task-temp"];
  $proses = new Task($db);
  $task = explode('/', $task1);
  $hit = count($task); $hit_del = 1;
  $hapuskah = false;
  for($i=1; $i<count($task); $i++){
    if(isset($_POST[$task[$i]."-ck"])){
        $del = $proses->deleteTask_unit($kd_unit,$task[$i]);
        $hit_del++;
    }
  }
  if($hit==$hit_del){
    require("../class/cleaner.php");
    $Proses2 = new Cleaner($db);
    $delete = $Proses2->deleteUnit_kotor($kd_unit, $sekarang);
  }
  header('Location:../view/'.$view.'/unit/status.php');
}


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

elseif(isset($_POST['NewTask'])){
  $kd_unit = $_POST['NewTask'];
  $Proses = new Task($db); $stmp = '10000';
  $show = $Proses->getStmp_unit($kd_unit);
  if($show) $stmp = $show["stmp_task"]; 
  $all_task = ""; $jumlah=0;
  $update = $Proses->update_new_task($kd_unit, $stmp);
  $jumlah2=0; $html2=""; $all_task="0";
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
  $callback = array('konten2'=>$html2, 'jumlah2'=>$jumlah2, 'task'=>$all_task);
  echo json_encode($callback);  
}

elseif(isset($_POST['updateTask_unit'])){
  $kd_unit = $_POST['updateTask_unit'];
  $Proses = new Task($db);
  $show = $Proses->getCOdate($kd_unit, $sekarang);
  $data = $show->fetch(PDO::FETCH_OBJ);
  $CO = $data->check_out;
  $is_updated = $Proses->isTask_updated($kd_unit, $CO);
  if($is_updated==false){
    $update = $Proses->updateTask_Unit($kd_unit, $CO);
  }
  $callback = array('done'=>$CO);
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
  $html2 .= '<div id="search-task" class="note">Memuat task terbaru ...</div>';
  $callback = array('konten'=>$html, 'jumlah'=>$jumlah, 'konten2'=>$html2, 'jumlah2'=>$jumlah2, 'task'=>$all_task);
  echo json_encode($callback);
}

else header('Location:../view/'.$view.'/home/home.php');
?>
