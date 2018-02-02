<?php
class Penyewa {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
  public function addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung){
    $sql = "INSERT INTO tb_penyewa (nama, alamat, no_tlp, jenis_kelamin, email, tgl_gabung) VALUES('$nama', '$alamat', '$no_tlp', '$jenis_kelamin', '$email', '$tgl_gabung')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Show
  public function showPenyewa(){
    $sql = "SELECT * FROM tb_penyewa";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Edit
  public function editPenyewa($kd_penyewa){
    $sql = "SELECT * FROM tb_penyewa WHERE kd_penyewa='$kd_penyewa'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Update
  public function updatePenyewa($kd_penyewa, $nama, $alamat, $no_tlp, $jenis_kelamin, $email){
    $sql = "UPDATE tb_penyewa SET nama='$nama', alamat='$alamat', no_tlp='$no_tlp', jenis_kelamin='$jenis_kelamin', email='$email' WHERE kd_penyewa='$kd_penyewa'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Delete
  public function deletePenyewa($kd_penyewa){
    $sql = "DELETE FROM tb_penyewa WHERE kd_penyewa='$kd_penyewa'";
    $query = $this->db->query($sql);
  }
}

//Tambah Penyewa
if(isset($_POST['addPenyewa'])){
  $nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_tlp = $_POST['no_tlp'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
  $email = $_POST['email'];
  $tgl_gabung = date('Y-m-d');

  require("../../config/database.php");
  $proses = new Penyewa($db);
  $add = $proses->addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung);

  if($add == "Success"){
	  header('Location:../superadmin/penyewa.php');
  }
}

//Delete Penyewa
if(isset($_GET['delete_penyewa'])){
  require("../../config/database.php");
  $proses = new Penyewa($db);
  $del = $proses->deletePenyewa($_GET['delete_penyewa']);
  header("location:../superadmin/penyewa.php");
}

//Update Penyewa
if(isset($_POST['updatePenyewa'])){
	$kd_penyewa = $_POST['kd_penyewa'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $no_tlp = $_POST['no_tlp'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $email = $_POST['email'];

  require("../../config/database.php");
  $proses = new Penyewa($db);
	$update = $proses->updatePenyewa($kd_penyewa, $nama, $alamat, $no_tlp, $jenis_kelamin, $email);

  if($update == "Success"){
  	header('Location:../superadmin/penyewa.php');
  } else {
  	echo 'error';
	}
}
?>
