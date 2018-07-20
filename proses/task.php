<?php
require("../../config/database.php");
require("../class/task.php");
// session_start();
$view = $_SESSION['hak_akses'];
// date_default_timezone_set('Asia/Jakarta');
$sekarang = date('Y-m-d');

//Tambah task
if(isset($_POST['addTask'])){
  $task = $_POST['task'];
  $unit = $_POST['unit'];
  $sifat = $_POST['sifat'];
  $kd_unit = $_POST['kd_unit'];
  if($sifat=="Sekali"){
    $tgl_task = $_POST['tgl_task'];
    $tgl_task = "'".$tgl_task."'";
  } else {
    $tgl_task = "null";
  }
  if(($unit=="Semua" && $kd_unit!="") || $unit!="Semua"){
    $unit = $kd_unit;
  }
 // die($task.", ".$unit.", ".$sifat.", ".$tgl_task);
  $proses = new Task($db);
  $add = $proses->addTask($task, $unit, $sifat, $tgl_task);

  // Log System
  //$logs->addLog('ADD','tb_task','Tambah data task',json_encode([$task, $unit, $sifat, $tgl_task]),null);

//sementara di offkan
/*  if($sifat!="Sekali"){ //untuk yang sifatnya rutin

    $kd_unit_base = "0";
    //$kd_unit_base diisi dengan unit yang sedang aktif task nya
    while($data = $add->fetch(PDO::FETCH_OBJ)){$kd_unit_base .= "/".$data->kd_unit;}

    //jika tidak ada yang aktif maka tambahka dari unit yang sudah check_out
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
*/
  header('Location:../view/'.$view.'/unit/task.php');
}

elseif(isset($_POST['updateTask'])){
  $kd_task = $_POST['kd_task'];
  $task = $_POST['task'];
  $unit = $_POST['unit'];
  $sifat = $_POST['sifat'];
  $proses = new Task($db);
  $add = $proses->updateTask($kd_task ,$task, $unit, $sifat);
  // Log System
  //$logs->addLog('Update','tb_task','Update data task',json_encode([$kd_task ,$task, $unit, $sifat]),null);
  if($add == "Success"){
    header('Location:../view/'.$view.'/unit/task.php');
  }
  else echo "error";
}

elseif(isset($_GET['delete_task'])){
  $kd_task = $_GET['delete_task'];
  $proses = new Task($db);
  $add = $proses->deleteTask($kd_task);
  // Log System
  //$logs->addLog('Delete','tb_task','Delete data task',json_encode([$kd_task]),null);
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
  // Log System
  //$logs->addLog('Update','tb_unit_kotor','Mengosongkan unit',json_encode([$kd_unit, $sekarang, $jam]),null);
  header('Location:../view/'.$view.'/unit/status.php');
}

elseif(isset($_GET['set_ready'])){
  $ready = $_GET['set_ready'];
  $kd_unit = $_GET['kd_unit'];
  require("../class/cleaner.php");
  $proses = new Cleaner($db);
  $proses->updateUnit_ready($kd_unit, $ready);
  // Log System
  //$logs->addLog('Update','tb_unit','Mengubah unit menjadi status ready',json_encode([$kd_unit, $ready]),null);
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
        // Log System
        //$logs->addLog('Delete','tb_task_unit','Delete data task unit',json_encode([$kd_unit,$task[$i]]),null);
        $hit_del++;
    }
  }
  if($hit==$hit_del){
    require("../class/cleaner.php");
    $Proses2 = new Cleaner($db);
    $Proses2->updateLihat_ready($kd_unit, $sekarang);
    $Proses2->deleteUnit_kotor($kd_unit, $sekarang);
    // Log System
    //$logs->addLog('Update','tb_unit','Update data unit',json_encode([$kd_unit,$sekarang]),null);
    //$logs->addLog('Delete','tb_task_unit','Delete data task unit',json_encode([$kd_unit,$sekarang]),null);
  }
  header('Location:../view/'.$view.'/unit/status.php');
}

// ------------- JSON PART -----------------------

//edit task sekali
elseif(isset($_POST['update_sekali'])){
  $Proses = new Task($db);
  $show = $Proses->showTask_sekali($sekarang);
  while($data = $show->fetch(PDO::FETCH_OBJ)){
    $unit = $data->unit;
    if($unit=='Semua'){
      $where = "1=1";
    } elseif($unit[0]=='&'){
        $arr_kd = explode("&",$unit);
        $where = "kd_unit='$arr_kd[1]' ";
        for($i=2;$i<count($arr_kd);$i++){
          $where.= "OR kd_unit='$arr_kd[$i]' ";
        }
    } elseif($unit[0]=='!'){
        $arr_kd = explode("!",$unit);
        $where = "kd_unit!='$arr_kd[1]' ";
        for($i=2;$i<count($arr_kd);$i++){
          $where.= "AND kd_unit!='$arr_kd[$i]' ";
        }
    }
    $Proses->addTask_unit_sekali($data->kd_task,$where);
    // Log System
    //$logs->addLog('Add','tb_task_unit','Tambah data task unit',json_encode([$data->kd_task,$where]),null);

  }
  $Proses->deleteTask_sekali($sekarang);
  // Log System
  //$logs->addLog('Delete','tb_task_unit','Delete data task unit',json_encode([$sekarang]),null);
  $callback = array('status'=>"done");
  echo json_encode($callback);
}

// edit task with popup
elseif(isset($_POST['id'])){
  $kd_task = $_POST['id'];
  $Proses = new Task($db);
  $show = $Proses->editTask($kd_task);
  $data = $show->fetch(PDO::FETCH_OBJ);
  $task = $data->task;
  $unit = $data->unit;
  $sifat = $data->sifat;
  $tgl_task = $data->tgl_task;
  $callback = array('task'=>$task, 'unit'=>$unit, 'sifat'=>$sifat, 'tgl_task'=>$tgl_task);
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
//  $is_updated = $Proses->isTask_updated($kd_unit, $CO);
//  if($is_updated==false){
    $update = $Proses->updateTask_Unit($kd_unit, $CO);
    // Log System
    //$logs->addLog('Update','tb_task_unit','Update data task unit',json_encode([$kd_unit,$CO]),null);

//  }
  require("../class/catatan.php"); $i=0;
  $Proses2 = new Catatan($db);
  $show2 = $Proses2->showCatatanUnit($kd_unit);
  while($data2 = $show2->fetch(PDO::FETCH_OBJ)){
    $i++;
  }
  $callback = array('done'=>$CO,'catatan'=>$i,'r'=>$update);
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
