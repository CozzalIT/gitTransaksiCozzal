<?php
class Owner {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
  public function addOwner($nama, $alamat, $no_tlp, $kd_bank, $no_rek, $tgl_gabung, $email, $jenis_kelamin){
    $sql = "INSERT INTO tb_owner (nama,alamat, no_tlp, kd_bank, no_rek, tgl_gabung, email, jenis_kelamin, jumlah_unit)
    VALUES('$nama', '$alamat', '$no_tlp', '$kd_bank', '$no_rek', '$tgl_gabung', '$email', '$jenis_kelamin', 0)";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Show
  public function showOwner(){
    $sql = "SELECT * from tb_owner
    INNER JOIN tb_bank ON tb_bank.kd_bank = tb_owner.kd_bank";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Edit
  public function editOwner($kd_owner){
    $sql = "SELECT * from tb_owner
    INNER JOIN tb_bank ON tb_bank.kd_bank = tb_owner.kd_bank where kd_owner='$kd_owner'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Update
  public function updateOwner($kd_owner ,$nama, $alamat, $no_tlp, $kd_bank, $no_rek, $email, $jenis_kelamin){
    $sql = "update tb_owner SET nama='$nama', alamat='$alamat', no_tlp='$no_tlp', kd_bank='$kd_bank', no_rek='$no_rek',
    email='$email', jenis_kelamin='$jenis_kelamin' WHERE kd_owner='$kd_owner'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Delete
  public function deleteOwner($kd_owner){
    $sql = "DELETE FROM tb_owner WHERE kd_owner='$kd_owner'";
    $query = $this->db->query($sql);
  }
}
?>
