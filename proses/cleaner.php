<?php
require("../../config/database.php");
require("../class/cleaner.php");
// session_start();
$view = $_SESSION['hak_akses'];


function set_value_config($parameter, $value){
  $arr_val = array();
  $isi = fread(fopen("../../inifiles/config.ini","r"),filesize("../../inifiles/config.ini"));
  $myfile = fopen("../../inifiles/config.ini","r");
  while (!feof($myfile)) {
    $string = fgets($myfile);
    $arr = explode('=', $string);
    $arr_val[$arr[0]]=$arr[1];
  }
  $isi2 = str_replace($parameter."=".$arr_val[$parameter], $parameter."=".$value."\n", $isi);
  $tmp = fopen("../../inifiles/config.ini", "w") or die("Unable to open file!");
  fwrite($tmp,$isi2);
  fclose($tmp);
}

function formated_jam_co($jam){
  if($jam!=""){
    $jam_CO = explode(":", $jam);
    return $jam_CO[0].":".$jam_CO[1];
  } else {
    return "Standar";
  }
}

function getcount($tgl, $jenis, $Proses){
  if ($jenis=='stay'){
    $show = $Proses->showUnit_stay($tgl, "count");
  } elseif($jenis=='task'){
    $show = $Proses->countTask($tgl);
  } else {
    $show = $Proses->showUnit_cek($tgl, $jenis, "count");
  }  
  $data = $show->fetch(PDO::FETCH_OBJ);
  return $data->jumlah;
}

function new_detail($Proses, $tgl, $jenis, $index){
  $ret = "";
  if ($jenis!='stay'){
    $show = $Proses->showUnit_cek($tgl, $jenis, "");
  } else {
    $show = $Proses->showUnit_stay($tgl, "");
  }
  while($data = $show->fetch(PDO::FETCH_OBJ)){
    $ret .= '<div class="detail-timeline" style="padding:10px;">';
    $ret .= '<strong>'.$data->no_unit.' ( '.$data->nama.' - '.$data->no_tlp.' )</strong><br>'.$data->nama_apt.' - '.$data->alamat_apt;
    if($jenis=="check_out"){
      $JCO = formated_jam_co($data->jam_check_out);
      if($index!=0){
        $ret .= '<br> Jam check out : <a href="#popup-jam" onclick="show_J('."'".$JCO.'/'.$data->kd_unit."'".')" data-toggle="modal" style="cursor:pointer;">'.$JCO.'</a>';
      } else {
        $ret .= '<br> Jam check out : <a style="cursor: not-allowed;">'.$JCO.'</a>';
      }
    }
    $ret .= '</div>';
  }
 return $ret;
}

function getListUnit($Proses, $id, $delimiter){
  $ret = "";
  $kd_units = explode($delimiter, $id);
  foreach ($kd_units as $kd_unit) {
    if($kd_unit!=""){
      $show = $Proses->showUnitbyId($kd_unit);
      $data = $show->fetch(PDO::FETCH_OBJ);
      $ret .= ", ".$data->no_unit." - ".$data->nama_apt;
    }
  }
  return $ret;
}

function detailTask($tgl, $index, $proses){
  $ret = "";

  $show = $proses->showTask_onceByDate($tgl);

  while($data = $show->fetch(PDO::FETCH_OBJ)){
    $ret .= '<div class="detail-timeline" style="padding:10px;">';
    $ret .= '<strong>'.$data->task.'</strong><br>';

    if($data->unit=="Semua")
      $ret .= "Semua Unit";
    elseif($data->unit[0] == "!"){
      $ret .= "Semua Unit Kecuali : ".getListUnit($proses, $data->unit, "!");
    } else {
      $ret .= "Beberapa Unit : ".getListUnit($proses, $data->unit, "&");
    }
    $ret .= '</div>';
  }
 return $ret;  
}

if(isset($_POST['show_tanggal'])){
  $tgl = $_POST['show_tanggal'];
  $kotak = $_POST['kotak'];
  $Proses = new Cleaner($db);
  $jumlah_ci = getcount($tgl, "check_in", $Proses);
  $jumlah_co = getcount($tgl, "check_out", $Proses);
  $jumlah_stay = getcount($tgl, "stay", $Proses);
  $jumlah_task = getcount($tgl, "task", $Proses);
  $callback = array('CI'=>$jumlah_ci, 'CO'=>$jumlah_co, 
                    'ST'=>$jumlah_stay, 'TS'=>$jumlah_task);
  echo json_encode($callback);
}

elseif(isset($_POST['detail_timeline'])){
  $tgl = $_POST['detail_timeline'];
  $index = $_POST['index'];
  $Proses = new Cleaner($db);
  $CI = ""; $CO = ""; $ST = ""; $TS = "";
  $CI .= new_detail($Proses, $tgl, "check_in", $index);
  $CO .= new_detail($Proses, $tgl, "check_out", $index);
  $ST .= new_detail($Proses, $tgl, "stay", $index);
  $TS .=  detailTask($tgl, $index, $Proses);
  $callback = array('CI'=>$CI, 'CO'=>$CO, 'ST'=>$ST, 'TS' => $TS);
  echo json_encode($callback);
}

elseif(isset($_POST['setTime'])){
  $jam_check_out = $_POST['jam_check_out'];
  $injury_bersih = $_POST['injury_bersih'];
  $injury = explode(':', $injury_bersih);
  $injury_mod = ($injury[0]*3600)+($injury[1]*60);
  set_value_config("jam_check_out", $jam_check_out.":00");
  set_value_config("extra_time_bersihkan", $injury_mod);
  header('Location:../view/'.$view.'/unit/status.php');
}

elseif(isset($_POST['setCO'])){
  $data = $_POST['check_out'];
  $jam = $_POST['jam_check_out'];
  $jenis = $_POST['jenis_jam'];
  if($jenis=="standar"){
    $jam_sekarang = "null";
  } else {
    $jam_sekarang = $jam;
  }
  $arr_data = explode('/', $data);
  $Proses = new Cleaner($db);
  $Proses->kosongkan_unit($arr_data[1], $arr_data[0], $jam_sekarang); //set jam check out
  header('Location:../view/'.$view.'/unit/timeline.php');
}

else header('Location:../view/'.$view.'/home/home.php');

?>
