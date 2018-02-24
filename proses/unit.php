<?php
require("../config/database.php");
require("../class/unit.php");
session_start();
$view = $_SESSION['hak_akses'];

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
    header('Location:../view/'.$view.'/unit/detail_unit.php?detail_unit='.$kd_unit);
  }
  else echo "error";
}

//Delete Gambar Unit
elseif(isset($_GET['delete_gambar'])){
  $proses = new Unit($db);
  $show = $proses->showDetail_Unit($_GET["kd_unit"]);
  while($data = $show->fetch(PDO::FETCH_OBJ)){
    $img_lama = $data->img;
  }
  $verif_unit = $_GET['delete_gambar'];
  include "verifikasi.php";
  $arrayofimage = explode('+', $img_lama);
  $jmlh_gambar = count($arrayofimage);
  $img=''; $x=0;
  if($jmlh_gambar>1){
    for($i=0;$i<count($arrayofimage);$i++){
      if($arrayofimage[$i]!=$_GET['delete_gambar']){
          if($x==0){
            $img = $arrayofimage[$i];
            $x++;
          }
          else{
            $img = $img.'+'.$arrayofimage[$i];
          }
      }
    }
  }else{
    $img = 'None';
  }

  $del = $proses->updateGambar_unit($_GET['kd_unit'], $img);
  if($del == "Success"){
    unlink('../asset/img/unit/'.$_GET['kd_unit'].'/'.$_GET['delete_gambar']);
    if($jmlh_gambar==1) rmdir('../asset/img/unit/'.$_GET['kd_unit']);
    header("location:../view/".$view."/unit/detail_unit.php?detail_unit=".$_GET["kd_unit"]);
  }
}

//update informasi dasar unit
elseif(isset($_POST['updateInfoUnit']) || isset($_POST['updateInfoUnitbyOwner'])){
  $kd_owner = ''; $owner = '';
  if(isset($_POST['updateInfoUnit'])){
    $kd_owner = $_POST['owner'];
    $owner= $_POST['kd_owner_lama'];
  }
  $kd_unit= $_POST['kd_unit'];
  $no_unit = $_POST['no_unit'];
  $kd_apt= $_POST['apartemen'];
  $proses = new Unit($db);
  $add = $proses->updateInfo_Unit($kd_unit ,$kd_apt, $no_unit, $kd_owner);
  if($owner!=$kd_owner){
    $add = $proses->updateJumlah_unit_owner($kd_owner);
    $add = $proses->updateKurangi_jumlah_unit_owner($owner);
  }
  if($add == "Success"){
    header('Location:../view/'.$view.'/unit/detail_unit.php?detail_unit='.$kd_unit);
  }else echo 'error';
}

//update harga unit
elseif(isset($_POST['updateHargaUnit']) || isset($_POST['updateHargaUnitbyOwner'])){
  $kd_unit= $_POST['kd_unit'];
  $h_owner_wd= $_POST['h_owner_wd'];
  $h_owner_we= $_POST['h_owner_we'];
  $h_sewa_wd = ''; $h_sewa_we=''; $ekstra_charge='';
  if(isset($_POST['updateHargaUnit'])){
      $h_sewa_wd= $_POST['h_sewa_wd'];
    $h_sewa_we= $_POST['h_sewa_we'];
  }
  $ekstra_charge= $_POST['ekstra_charge'];
  $proses = new Unit($db);
  $add = $proses->updateHarga_Unit($kd_unit , $h_owner_wd, $h_owner_we, $h_sewa_wd, $h_owner_we, $ekstra_charge);
  if($add == "Success"){
    header('Location:../view/'.$view.'/unit/detail_unit.php?detail_unit='.$kd_unit);
  }else echo 'error';
}

//Update Detail Unit
elseif(isset($_POST['update_detail_unit'])){
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
    header("Location:../view/".$view."/unit/detail_unit.php?detail_unit=".$kd_unit);
  }else echo 'error';
}

//upload gambar
elseif (isset($_POST['upload_gambar'])){
  $proses = new Unit($db);
  $img_baru = ''; $img = '';
  $kd_unit = $_POST['kd_unit'];
  $jumlah = count($_FILES['gambar']['name']);
  $tanggal = date('dmyHis');
  if ($jumlah > 0) {
    for ($i=0; $i < $jumlah; $i++) {
      if(!file_exists('../asset/img/unit/'.$kd_unit)) mkdir('../asset/img/unit/'.$kd_unit);
      $file_name = $_FILES['gambar']['name'][$i];
      $tmp_name = $_FILES['gambar']['tmp_name'][$i];
      $tmp2 = explode('.', $file_name);
      $file_name_new = $tanggal.$i.'.'.$tmp2[1];
      move_uploaded_file($tmp_name, "../asset/img/unit/".$kd_unit.'/'.$file_name_new);
      if($img_baru==''){
        $img_baru = $file_name_new;
      } else {
        $img_baru = $img_baru.'+'.$file_name_new;
      }
    }
    if(($_POST['img']=='None') ||($_POST['img']=='Nothing')){
      $img = $img_baru;
    }
    else{
      $img = $_POST['img'].'+'.$img_baru;
    }
    if(($_POST['img']=='Nothing')){
      $add = $proses->addDetail_Unit($kd_unit, 0, 0, 0, 0, 'X', 'X' , 'X', 'X', 'X', 'X', 'X', $img, 'N');
      if(!$add == "Success"){
        die('gagal upload gambar');
      }
    }
    $add = $proses->updateGambar_unit($kd_unit, $img);
    if($add == "Success"){
      header("Location:../view/".$view."/unit/detail_unit.php?detail_unit=".$kd_unit);
    }
    else echo 'gagal upload gmbar';
  }
}

//Delete Unit
elseif(isset($_GET['delete_unit']) || isset($_GET['kurangi_ju']) && ($view=="superadmin" || $view=="manager")){
  $proses = new Unit($db);
  $del2 = $proses->deleteDetail_Unit($_GET['delete_unit']);
  $del = $proses->deleteUnit($_GET['delete_unit']);
  if($del=='Success'){
    $del = $proses->updateKurangi_jumlah_unit_owner($_GET['kurangi_ju']);
    delete_files("../asset/img/unit/".$_GET['delete_unit']);
    header("location:../view/".$view."/unit/unit.php");
  }
}

//Delete Unit kotor
elseif(isset($_GET['unit_kotor']) && $view=="cleaner" ){
  require("../class/cleaner.php");
  $proses = new Cleaner($db);
  $kd_unit = $_GET['unit_kotor'];
  $sekarang = $sekarang = date('Y-m-d'); 
  $del = $proses->deleteUnit_kotor($kd_unit, $sekarang);
  header("location:../view/".$view."/unit/unit.php");
}

//Tambah Unit
elseif(isset($_POST['addUnit']) && $view!="owner"){
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

  if(($add == "Success") || ($add2 == "Success")){
    $add2 = $proses->updateJumlah_unit_owner($kd_owner);
    header('Location:../view/'.$view.'/unit/unit.php');
  }else{
    echo 'error';
  }
}

//Tambah Maintenance
elseif(isset($_POST['addMaintenance'])){
  $kd_unit = $_POST['kd_unit'];
  $awal = $_POST['awal'];
  $akhir = $_POST['akhir'];
  $catatan = $_POST['catatan'];

  $proses = new Unit($db);
  $add = $proses->addMaintenance($kd_unit, $awal, $akhir, $catatan);

  if(($add == "Success")){
    header('Location:../view/'.$view.'/unit/unit.php');
  }else{
    echo 'error';
  }
}

else header('Location:../view/'.$view.'/home/home.php');
?>
