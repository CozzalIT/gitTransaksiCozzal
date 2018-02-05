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
?>
