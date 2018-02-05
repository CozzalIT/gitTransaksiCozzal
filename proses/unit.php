<?php
require("../config/database.php");
require("../class/unit.php");

//Tambah Unit
if(isset($_POST['addUnit'])){
  $kd_apt = $_POST['apartemen'];
  $no_unit = $_POST['no_unit'];
  $h_sewa_wd = $_POST['h_sewa_wd'];
  $h_sewa_we = $_POST['h_sewa_we'];
  $h_owner_wd = $_POST['h_owner_wd'];
  $h_owner_we = $_POST['h_owner_we'];
  $ekstra_charge = $_POST['ekstra_charge'];
	$kd_owner = $_POST['kd_owner'];

  $proses = new Unit($db);
  $add = $proses->addUnit($kd_apt,$kd_owner, $no_unit, $h_sewa_wd, $h_sewa_we, $h_owner_wd, $h_owner_we, $ekstra_charge);
	$add2 = $proses->updateJumlah_unit_owner($kd_owner);

  if(($add == "Success") || ($add2 == "Success")){
	  header('Location:../view/superadmin/unit/unit.php');
	}else{
    echo 'error';
  }
}

//Tambah Detail Unit
if(isset($_POST['add_detail_unit'])){
  $kd_unit = $_POST['kd_unit'];
  $lantai = $_POST['lantai'];
  $jml_kmr = $_POST['jml_kmr'];
  $jml_bed = $_POST['jml_bed'];
  $jml_ac = $_POST['jml_ac'];
  $water_heater = $_POST['water_heater'];
  $dapur = $_POST['dapur'];
  $wifi = $_POST['wifi'];
  $tv = $_POST['tv'];
  $amenities = $_POST['amenities'];
  $merokok = $_POST['merokok'];
  $type = $_POST['type'];
  $proses = new Unit($db);
  $add = $proses->addDetail_Unit($kd_unit, $lantai, $jml_kmr, $jml_bed, $jml_ac, $water_heater, $dapur, $wifi, $tv, $amenities, $merokok, $type, 'None', 'Y');

  if($add == "Success"){
    header('Location:../view/superadmin/unit/detail_unit.php?detail_unit='.$kd_unit);
  }
  else echo "error";
}

//fungsi untuk delete dir dan file nya
function delete_files($target) {
  if(is_dir($target)){
    $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

    foreach( $files as $file ){
      delete_files( $file );
    }
    if(file_exists($target))
      rmdir( $target );
    }elseif(is_file($target)) {
      unlink( $target );
    }
}

//Delete Unit
if(isset($_GET['delete_unit']) || isset($_GET['kurangi_ju'])){
  $proses = new Unit($db);
  $del = $proses->deleteUnit($_GET['delete_unit']);
  if($del=='Success'){
    $del = $proses->deleteDetail_Unit($_GET['delete_unit']);
    $del = $proses->updateKurangi_jumlah_unit_owner($_GET['kurangi_ju']);
    if(file_exists('../img/unit/'.$_GET['delete_unit'])){
      delete_files('../img/unit/'.$_GET['delete_unit']);
    }
  }
  header("location:../view/superadmin/unit/unit.php");
}

//update Unit
if(isset($_POST['updateUnit'])){
	$kd_unit= $_POST['kd_unit'];
	$owner= $_POST['kd_owner_lama'];
	$kd_apt= $_POST['apartemen'];
	$kd_owner= $_POST['owner'];
	$no_unit= $_POST['no_unit'];
	$h_owner_wd= $_POST['h_owner_wd'];
	$h_owner_we= $_POST['h_owner_we'];
	$h_sewa_wd= $_POST['h_sewa_wd'];
	$h_sewa_we= $_POST['h_sewa_we'];
	$ekstra_charge= $_POST['ekstra_charge'];

  $proses = new Unit($db);
  $add = $proses->updateUnit($kd_unit ,$kd_apt,$kd_owner, $no_unit, $h_owner_wd, $h_owner_we, $h_sewa_wd, $h_sewa_we, $ekstra_charge);
	if($owner!=$kd_owner){
		$add = $proses->updateJumlah_unit_owner($kd_owner);
		$add = $proses->updateKurangi_jumlah_unit_owner($owner);
	}
  if($add == "Success"){
	  header('Location:../view/superadmin/unit/unit.php');
  }else echo 'error';
}

//Update Detail Unit
if(isset($_POST['update_detail_unit'])){
  $kd_unit = $_POST['kd_unit'];
  $lantai = $_POST['lantai'];
  $jml_kmr = $_POST['jml_kmr'];
  $jml_bed = $_POST['jml_bed'];
  $jml_ac = $_POST['jml_ac'];
  $water_heater = $_POST['water_heater'];
  $dapur = $_POST['dapur'];
  $wifi = $_POST['wifi'];
  $tv = $_POST['tv'];
  $amenities = $_POST['amenities'];
  $merokok = $_POST['merokok'];
  $type = $_POST['type'];

  $proses = new Unit($db);
  $add = $proses->updateDetail_Unit($kd_unit, $lantai, $jml_kmr, $jml_bed, $jml_ac, $water_heater, $dapur, $wifi, $tv, $amenities, $merokok, $type);

  if($add == "Success"){
    header("Location:../view/superadmin/unit/detail_unit.php?detail_unit=".$kd_unit);
  }else echo 'error';
}
?>
