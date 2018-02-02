<?php
class Apartemen {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
  public function addApartemen($nama_apt, $alamat_apt){
    $sql = "INSERT INTO tb_apt (nama_apt, alamat_apt) VALUES('$nama_apt', '$alamat_apt')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Show
  public function showApartemen(){
    $sql = "SELECT * FROM tb_apt";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Edit
  public function editApartemen($kd_apart){
    $sql = "SELECT * FROM tb_apt WHERE kd_apt='$kd_apart'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Update
  public function updateApartemen($kd_apt, $nama_apt, $alamat_apt){
    $sql = "UPDATE tb_apt SET nama_apt='$nama_apt', alamat_apt='$alamat_apt' WHERE kd_apt='$kd_apt'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Delete
  public function deleteApartemen($kd_apt){
    $sql = "DELETE FROM tb_apt WHERE kd_apt='$kd_apt'";
    $query = $this->db->query($sql);
  }
}

//Tambah Apartemen
if(isset($_POST['addApartemen'])){
	$nama_apt = $_POST['nama_apt'];
	$alamat_apt = $_POST['alamat_apt'];

  require("../../config/database.php");
  $proses = new Apartemen($db);
  $add = $proses->addApartemen($nama_apt, $alamat_apt);

  if($add == "Success"){
	  header('Location:../superadmin/apartemen.php');
  }
}

//Delete Apartemen
if(isset($_GET['delete_apt'])){
  require("../../config/database.php");
  $proses = new Apartemen($db);
  $del = $proses->deleteApartemen($_GET['delete_apt']);
  header("location:../superadmin/apartemen.php");
}

//Update Apartemen
if(isset($_POST['updateApartemen'])){
  $kd_apt = $_POST['kd_apt'];
  $nama_apt = $_POST['nama_apt'];
  $alamat_apt = $_POST['alamat_apt'];

  require("../../config/database.php");
  $proses = new Apartemen($db);
  $update = $proses->updateApartemen($kd_apt, $nama_apt, $alamat_apt);

  if($update == "Success"){
    header('Location:../superadmin/apartemen.php');
  }else{
      echo 'error';
  }
}
?>
