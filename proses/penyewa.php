<?php
require("../../config/database.php");
require("../class/penyewa.php");
session_start();
$view = $_SESSION['hak_akses'];

//Tambah Penyewa
if(isset($_POST['addPenyewa'])){
  $nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_tlp = $_POST['no_tlp'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
  $email = $_POST['email'];
  $tgl_gabung = date('Y-m-d');

  $proses = new Penyewa($db);
  $add = $proses->addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung);

  if($add == "Success"){
	  header('Location:../view/'.$view.'/penyewa/penyewa.php');
  }
}


//Update Penyewa
elseif(isset($_POST['updatePenyewa'])){
	$kd_penyewa = $_POST['kd_penyewa'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $no_tlp = $_POST['no_tlp'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $email = $_POST['email'];

  $proses = new Penyewa($db);
	$update = $proses->updatePenyewa($kd_penyewa, $nama, $alamat, $no_tlp, $jenis_kelamin, $email);

  if($update == "Success"){
  	header('Location:../view/'.$view.'/penyewa/penyewa.php');
  } else {
  	echo 'error';
	}
}

//Delete Penyewa
elseif(isset($_GET['delete_penyewa']) && ($view=="superadmin" || $view=="manager")){
  $proses = new Penyewa($db);
  $del = $proses->deletePenyewa($_GET['delete_penyewa']);
  header("location:../view/".$view."/penyewa/penyewa.php");
}

elseif(isset($_POST['kd_redudansi'])){
  $string_red = $_POST['kd_redudansi'];
  $kd_penyewa = $_POST['kd_penyewa'];
  $arr_red = explode("*", $string_red);
  $proses = new Penyewa($db);
  $wait = "";
  for($i=0;$i<count($arr_red);$i++){
    if($arr_red[$i]!=$kd_penyewa){
      $proses->solveRedudansi($kd_penyewa, $arr_red[$i]);
      $wait .= "*".$arr_red[$i];
      $proses->deletePenyewa($arr_red[$i]);
    }
  }
  $callback = array('error'=>$wait);
  echo json_encode($callback);  
}

else header('Location:../view/'.$view.'/home/home.php');
?>
