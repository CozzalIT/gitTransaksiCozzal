<?php
class dpVia {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
  public function addDp_via($kd_bank, $nama_bank){
    $sql = "INSERT INTO tb_bank (kd_bank,nama_bank) VALUES('$kd_bank', '$nama_bank')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Show
  public function showDp_via(){
    $sql = "SELECT * FROM tb_bank";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Edit
  public function editDp_via($kd_bank){
    $sql = "SELECT * FROM tb_bank where kd_bank='$kd_bank'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Update
  public function updateBank($kd_bank, $nama_bank){
    $sql = "UPDATE tb_bank SET nama_bank='$nama_bank', kd_bank='$kd_bank' WHERE kd_bank='$kd_bank'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Delete
  public function deleteDp_via($kd_bank){
    $sql = "DELETE FROM tb_bank WHERE kd_bank='$kd_bank'";
    $query = $this->db->query($sql);
  }
}

//Tambah DP Via
if(isset($_POST['addDp_via'])){
  $kd_bank = $_POST['kd_bank'];
	$nama_bank= $_POST['nama_bank'];

  require("../../config/database.php");
  $proses = new dpVia($db);
  $add = $proses->addDp_via($kd_bank, $nama_bank);

  if($add == "Success"){
	  header('Location:../superadmin/dp_via.php');
  }
}

//Delete DP Via
if(isset($_GET['delete_dp'])){
  require("../../config/database.php");
  $proses = new dpVia($db);
  $del = $proses->deleteDp_via($_GET['delete_dp']);
  header("location:../superadmin/dp_via.php");
}

//Update Bank (DP Via)
if(isset($_POST['updateBank'])){
  $kd_bank = $_POST['kd_bank'];
  $nama_bank = $_POST['nama_bank'];

  require("../../config/database.php");
  $proses = new dpVia($db);
  $update = $proses->updateBank($kd_bank, $nama_bank);

  if($update == "Success"){
  	header('Location:../superadmin/dp_via.php');
  } else {
  	echo 'error';
  }
}
?>
