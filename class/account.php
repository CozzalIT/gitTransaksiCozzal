<?php
class Account{
  private $db;

  public function __construct($database){
    $this->db = $database;
  }

  //Show
  public function showAccount(){
    $sql = "SELECT tb_user.username, tb_user.hak_akses FROM tb_user";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Update
  public function updateProfile_owner($kd_owner ,$nama, $alamat, $no_tlp, $email, $jenis_kelamin, $kd_bank, $no_rek){ //separated by $kd_bank or $nama
    $sql = "update tb_owner SET ";
    if($kd_bank=='') $sql .= "nama='$nama', alamat='$alamat', no_tlp='$no_tlp', email='$email', jenis_kelamin='$jenis_kelamin' ";
    else $sql .= "kd_bank='$kd_bank', no_rek='$no_rek' ";
    $sql .= "WHERE kd_owner='$kd_owner'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

}

?>
