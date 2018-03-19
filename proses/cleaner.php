<?php
require("../../config/database.php");
require("../class/cleaner.php");

function getcount($tgl, $jenis, $Proses, $myfile){
  $jumlah = 0; 
    if ($jenis!='stay'){
      $show = $Proses->showUnit_cek($tgl, $jenis);
    } else {
      $show = $Proses->showUnit_stay($tgl);
    }
	  while($data = $show->fetch(PDO::FETCH_OBJ)){
	  	$jumlah++; 
      $isi = $jenis."=".$data->kd_unit."&".$data->no_unit."&".$data->nama."&".$data->no_tlp."&".$data->nama_apt."&".$data->alamat_apt;
      if($jenis=="check_out") {
        if($data->jam_check_out!="") 
          $isi .= "&".$data->jam_check_out;
        else 
          $isi .= "&Standar";
      }  
      fwrite($myfile, "$isi\n");
	  }
  return $jumlah;
}

function new_detail($isi, $jenis){
  $arr_isi = explode("&", $isi);
  $ret = '<div class="detail-timeline" style="padding:10px;">';
  $ret .= '<strong>'.$arr_isi[1].' ( '.$arr_isi[2].' - '.$arr_isi[3].' )</strong><br>'.$arr_isi[4].' - '.$arr_isi[5];
  if($jenis=="check_out"){
    $ret .= '<br> Jam check out : <a id="'.$arr_isi[0].'" style="cursor:pointer;">'.$arr_isi[6].'</a>';
  }
  $ret .= '</div>'; return $ret;
}

if(isset($_POST['show_tanggal'])){
  $tgl = $_POST['show_tanggal'];
  $kotak = $_POST['kotak'];
  $Proses = new Cleaner($db); 
  $myfile = fopen("detail_timeline/".$kotak.".ini", "w") or die("Unable to open file!"); 
  $jumlah_ci = getcount($tgl, "check_in", $Proses, $myfile); 
  $jumlah_co = getcount($tgl, "check_out", $Proses, $myfile);
  $jumlah_stay = getcount($tgl, "stay", $Proses, $myfile);
  if($jumlah_ci==0 && $jumlah_co==0 && $jumlah_stay==0){
    fwrite($myfile, "Kosong");
  }
  fclose($myfile);
  $callback = array('CI'=>$jumlah_ci, 'CO'=>$jumlah_co, 'ST'=>$jumlah_stay);
  echo json_encode($callback);
}

elseif(isset($_POST['detail_timeline'])){
  $kotak = $_POST['detail_timeline']; $CI = ""; $CO = ""; $ST = "";
  $myfile = fopen("detail_timeline/".$kotak.".ini", "r") or die("Unable to open file!"); 
  while(!feof($myfile)){
    $isi = fgets($myfile);
    $isimod = explode("=", $isi);
    if($isimod[0]=="check_in") $CI .= new_detail($isi, "check_in"); 
    elseif($isimod[0]=="check_out") $CO .= new_detail($isi, "check_out");
    elseif($isimod[0]=="stay") $ST .= new_detail($isi, "stay");
  }
  fclose($myfile);
  $callback = array('CI'=>$CI, 'CO'=>$CO, 'ST'=>$ST);
  echo json_encode($callback);
}

else header('Location:../view/'.$view.'/home/home.php');

?>