<?php
class Unit {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
  public function addUnit($kd_apt,$kd_owner, $no_unit, $h_sewa_wd, $h_sewa_we, $h_owner_wd, $h_owner_we, $ekstra_charge){
    $sql = "INSERT INTO tb_unit (kd_apt, kd_owner, no_unit, h_sewa_wd, h_sewa_we, h_owner_wd, h_owner_we, ekstra_charge) VALUES('$kd_apt', '$kd_owner', '$no_unit', '$h_sewa_wd', '$h_sewa_we', '$h_owner_wd', '$h_owner_we', '$ekstra_charge')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function addDetail_Unit($kd_unit, $lantai, $jml_kmr, $jml_bed, $jml_ac, $water_heater, $dapur, $wifi, $tv, $amenities, $merokok, $type){
    $sql = "INSERT INTO tb_detail_unit (kd_unit, lantai, jml_kmr, jml_bed, jml_ac, water_heater, dapur, wifi, tv, amenities, merokok, type, img)
    VALUES('$kd_unit', '$lantai', '$jml_kmr', '$jml_bed', '$jml_ac', '$water_heater', '$dapur', '$wifi', '$tv', '$amenities', '$merokok', '$type', 'None')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Show
  public function showUnit(){
    $sql = "SELECT * FROM tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_owner ON tb_owner.kd_owner = tb_unit.kd_owner";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showDetail_Unit($kd_unit){
    $sql = "SELECT kd_unit FROM tb_detail_unit
    where kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showUnitbyId($kd_unit){
    $sql = "SELECT * FROM tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_owner ON tb_owner.kd_owner = tb_unit.kd_owner
    INNER JOIN tb_detail_unit ON tb_detail_unit.kd_unit = tb_unit.kd_unit
    where tb_unit.kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showUnitByApt($kd_apt){
    $sql = "SELECT * from tb_unit where kd_apt='$kd_apt'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Edit
  public function editUnit($kd_unit){
    $sql = "SELECT * from tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_owner ON tb_owner.kd_owner = tb_unit.kd_owner
    where kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Update
  public function updateUnit($kd_unit ,$kd_apt,$kd_owner, $no_unit, $h_owner_wd, $h_owner_we, $h_sewa_wd, $h_sewa_we, $ekstra_charge){
    $sql = "update tb_unit SET kd_apt='$kd_apt', kd_owner='$kd_owner', no_unit='$no_unit', h_owner_wd='$h_owner_wd', h_owner_we='$h_owner_we',
    h_sewa_wd='$h_sewa_wd', h_sewa_we='$h_sewa_we', ekstra_charge='$ekstra_charge' where kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateDetail_Unit($kd_unit, $lantai, $jml_kmr, $jml_bed, $jml_ac, $water_heater, $dapur, $wifi, $tv, $amenities, $merokok, $type){
    $sql = "update tb_detail_unit SET lantai='$lantai', jml_kmr='$jml_kmr', jml_bed='$jml_bed', jml_ac='$jml_ac', water_heater='$water_heater',
    dapur='$dapur', wifi='$wifi', tv='$tv', amenities='$amenities', merokok='$merokok', type='$type' where kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateGambar_unit($kd_unit, $img){
    $sql = "update tb_detail_unit SET img='$img' where kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateKurangi_jumlah_unit_owner($kd_owner){
    $sql = "update tb_owner SET jumlah_unit=jumlah_unit-1 where kd_owner='$kd_owner'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateJumlah_unit_owner($kd_owner){
    $sql = "update tb_owner SET jumlah_unit=jumlah_unit+1 where kd_owner='$kd_owner'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Delete
  public function deleteUnit($kd_unit){
    $sql = "DELETE FROM tb_unit WHERE kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
  }

  public function deleteDetail_Unit($kd_unit){
    $sql = "DELETE FROM tb_detail_unit WHERE kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }
}

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

  require("../../config/database.php");
  $proses = new Unit($db);
  $add = $proses->addUnit($kd_apt,$kd_owner, $no_unit, $h_sewa_wd, $h_sewa_we, $h_owner_wd, $h_owner_we, $ekstra_charge);
	$add2 = $proses->updateJumlah_unit_owner($kd_owner);

  if(($add == "Success") || ($add2 == "Success")){
	  header('Location:../superadmin/unit.php');
	}else{
    echo 'error';
  }
}

//Tambah Detail Unit
if(isset($_POST['detail_unit'])){
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

  require("../../config/database.php");
  $proses = new Unit($db);
  $add = $proses->addDetail_Unit($kd_unit, $lantai, $jml_kmr, $jml_bed, $jml_ac, $water_heater, $dapur, $wifi, $tv, $amenities, $merokok, $type);

  if($add == "Success"){
    header('Location:../detail_unit.php?detail_unit='.$kd_unit);
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
  require("../../config/database.php");
  $proses = new Unit($db);
  $del = $proses->deleteUnit($_GET['delete_unit']);
  if($del=='Success'){
    $del = $proses->deleteDetail_Unit($_GET['delete_unit']);
    $del = $proses->updateKurangi_jumlah_unit_owner($_GET['kurangi_ju']);
    if(file_exists('../img/unit/'.$_GET['delete_unit'])){
      delete_files('../img/unit/'.$_GET['delete_unit']);
    }
  }
  header("location:../superadmin/unit.php");
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

  require("../../config/database.php");
  $proses = new Unit($db);
  $add = $proses->updateUnit($kd_unit ,$kd_apt,$kd_owner, $no_unit, $h_owner_wd, $h_owner_we, $h_sewa_wd, $h_sewa_we, $ekstra_charge);
	if($owner!=$kd_owner){
		$add = $proses->updateJumlah_unit_owner($kd_owner);
		$add = $proses->updateKurangi_jumlah_unit_owner($owner);
	}
  if($add == "Success"){
	  header('Location:../superadmin/unit.php');
  }else echo 'error';
}

//Update Detail Unit
if(isset($_POST['detail_unit'])){
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

  require("../../config/database.php");
  $proses = new Unit($db);
  $add = $proses->updateDetail_Unit($kd_unit, $lantai, $jml_kmr, $jml_bed, $jml_ac, $water_heater, $dapur, $wifi, $tv, $amenities, $merokok, $type);

  if($add == "Success"){
    header("Location:../detail_unit.php?detail_unit=".$kd_unit);
  }else echo 'error';
}

//cek ketersediaan unit pada tanggal tertentu
if(isset($_POST['id'])){
	$kd_unit = $_POST['id'];
	$CI = $_POST['tci'];
	$CO = $_POST['tco'];
	$hasil = "Tidak Ada";
	$flag = 0;

  require("../../config/database.php");
  $proses = new Unit($db);
	$show = $Proses->showTransaksi_cek($CI,$CO,$kd_unit);
	while($data = $show->fetch(PDO::FETCH_OBJ)){
	$flag++;
	}
	if($flag==0) $hasil = "Ada";
	$callback = array('ketersediaan'=>$hasil);
	echo json_encode($callback);
}

//cek ketersediaan informasi detail unit
if(isset($_POST['detail_unit'])){
	$kd_unit = $_POST['detail_unit'];
	$flag = 0; $namaunit = '';
	$hasil = "Ada";

  require("../../config/database.php");
  $proses = new Unit($db);
	$show = $Proses->showDetail_Unit($kd_unit);
	while($data = $show->fetch(PDO::FETCH_OBJ)){
	$flag++;
	}
	if($flag==0) $hasil = "Tidak Ada";
	$callback = array('ketersediaan'=>$hasil);
	echo json_encode($callback);
}
?>
