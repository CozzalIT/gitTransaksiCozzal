<?php
class Account{
  private $db;

  public function __construct($database){
    $this->db = $database;
  }

//menambah akun baru
  public function addAccount($username, $password, $hak_akses, $status){
      $sql = "INSERT INTO tb_user VALUES('$username', '$password', '$hak_akses', '$status')";
      $query = $this->db->query($sql);
      if(!$query){
        return "Failed";
      }else{
        return "Success";
      }
  }

  public function addUnitPartner($username, $kd_unit){
      $sql = "INSERT INTO tb_unit_partner VALUES('$username', '$kd_unit')";
      $query = $this->db->query($sql);
      if(!$query){
        return "Failed";
      }else{
        return "Success";
      }
  }

 //menghapus username
  public function deleteAkun($username){
      $sql = "DELETE FROM tb_user where username = '$username'";
      $query = $this->db->query($sql);
      if(!$query){
        return "Failed";
      }else{
        return "Success";
      }
  }

//ganti username
  public function updateUsername($username_old, $username_new){
    $sql = "UPDATE tb_user SET username='$username_new' where username='$username_old'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

//ganti password
  public function updatePassword($password, $username){
    $sql = "UPDATE tb_user SET password='$password' where username='$username'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

//meng set status user
  public function set_status_akun($username, $status){
    $sql = "UPDATE tb_user SET status='$status' where username='$username'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

//menambah relasi baru
  public function addRelasi($username, $kd_owner){
      $sql = "UPDATE tb_owner SET username='$username' where kd_owner='$kd_owner'";
      $query = $this->db->query($sql);
      if(!$query){
        return "Failed";
      }else{
        return "Success";
      }
  }

//menghapus relasi antara user dan owner
  public function deleteRelasi($username){
      $sql = "UPDATE tb_owner SET username = null where username = '$username'";
      $query = $this->db->query($sql);
      if(!$query){
        return "Failed";
      }else{
        return "Success";
      }
  }

//menampilkan semua owner yang belum terelasi
  public function showOwner_byAccount(){
    $sql = "SELECT kd_owner,nama from tb_owner where username is null";
    $query = $this->db->query($sql);
    return $query;
  }

  // menampilkaan semua akun dengan status non aktif
  public function showAccount_status2(){
    $sql = "SELECT username, hak_akses, status FROM tb_user WHERE status='2' and hak_akses!='owner'";
    $query = $this->db->query($sql);
    return $query;
  }

  // menampilkan semua akun dengan status tidak terelasi
  public function showAccount_status3(){
    $sql = "SELECT username, hak_akses, status FROM tb_user WHERE status='3'";
    $query = $this->db->query($sql);
    return $query;
  }

  // menampilkan unit partner
  public function showUnitPartner($username){
    $sql = "SELECT tb_unit_partner.*, tb_unit.kd_unit, tb_unit.no_unit, tb_unit.kd_apt, tb_apt.kd_apt, tb_apt.nama_apt
      FROM tb_unit_partner
        INNER JOIN tb_unit ON tb_unit.kd_unit = tb_unit_partner.kd_unit
        INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
      WHERE username='$username'";
    $query = $this->db->query($sql);
    return $query;
  }

  // menampilkan semua akun yang terelasi dengan owner baik aktif maupun non aktif
  public function showAccount_owner(){
    $sql = "SELECT tb_user.username, tb_user.hak_akses, tb_user.status, tb_owner.nama FROM tb_user
    INNER JOIN tb_owner ON tb_owner.username = tb_user.username";
    $query = $this->db->query($sql);
    return $query;
  }

  public function is_username_exists($username) {
    $result = $this->db->prepare("SELECT username FROM tb_user WHERE username= ?");
    $result->bindParam(1, $username);
    $result->execute();
    $rows = $result->fetch();
    return $rows;
  }

  //Update profil owner
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
