<?php
class Cleaner {
  private $db;

  public function __construct($database){
    $this->db = $database;
  }

  public function showUnit1($sekarang){
    $sql = "SELECT tb_unit.kd_unit, tb_unit.no_unit, tb_apt.nama_apt, tb_apt.alamat_apt,
    tb_unit_kotor.check_out, tb_unit_kotor.jam_check_out FROM tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_unit_kotor ON tb_unit_kotor.kd_unit = tb_unit.kd_unit
    WHERE tb_unit_kotor.check_out<='$sekarang' 
    AND tb_unit_kotor.kd_unit not in(SELECT kd_unit from tb_unit_kotor where check_in='$sekarang')";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showUnit2($sekarang){
    $sql = "SELECT tb_unit.kd_unit, tb_unit.no_unit, tb_apt.nama_apt, tb_apt.alamat_apt,
    tb_unit_kotor.jam_check_out FROM tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_unit_kotor ON tb_unit_kotor.kd_unit = tb_unit.kd_unit
    WHERE tb_unit_kotor.check_out='$sekarang' and tb_unit_kotor.kd_unit
    IN (SELECT kd_unit FROM tb_unit_kotor WHERE check_in='$sekarang')";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showUnit3($sekarang){
    $sql = "SELECT tb_unit.kd_unit, tb_unit.no_unit, tb_apt.nama_apt, tb_apt.alamat_apt,
    tb_unit_kotor.jam_check_out FROM tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_unit_kotor ON tb_unit_kotor.kd_unit = tb_unit.kd_unit
    WHERE tb_unit_kotor.check_in='$sekarang' 
    and tb_unit_kotor.kd_unit in (SELECT kd_unit from tb_unit_kotor where check_out<'$sekarang')";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showUnit_normal($sekarang){
    $sql = "SELECT tb_unit.kd_unit, tb_unit.no_unit, tb_apt.nama_apt, tb_apt.alamat_apt
    FROM tb_unit INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    and tb_unit.kd_unit not in (SELECT kd_unit from tb_unit_kotor where check_out<='$sekarang')";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showStatus_check_in($kd_unit, $sekarang) {
   $result = $this->db->prepare("SELECT kd_unit FROM tb_unit_kotor WHERE kd_unit= ? AND check_in= ?");
      $result->bindParam(1, $kd_unit);
      $result->bindParam(2, $sekarang);
      $result->execute();
      $rows = $result->fetch();
      return $rows;
  }

  public function showStatus_terisi($kd_unit, $sekarang) {
   $result = $this->db->prepare("SELECT kd_unit FROM tb_unit_kotor WHERE kd_unit=? AND check_in<? AND check_out>?");
      $result->bindParam(1, $kd_unit);
      $result->bindParam(2, $sekarang);
      $result->bindParam(3, $sekarang);
      $result->execute();
      $rows = $result->fetch();
      return $rows;
  }  

  public function updateUnit_ready($kd_unit, $ready){
    $sql = "UPDATE tb_unit SET ready='$ready' WHERE kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
  }    

  public function updateLihat($kd_unit, $sekarang){
    $sql = "UPDATE tb_unit SET tgl_lihat ='$sekarang', ready = null 
    WHERE kd_unit='$kd_unit' AND (tgl_lihat!='$sekarang' or tgl_lihat is null)";
    $sql2 = "SELECT tgl_lihat, ready FROM tb_unit WHERE kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    $query = $this->db->query($sql2);
    return $query; 
  } 

  public function deleteUnit_kotor($kd_unit, $sekarang){
    $sql = "DELETE FROM tb_unit_kotor where kd_unit='$kd_unit' and check_out<='$sekarang'";
    $query = $this->db->query($sql);
  } 

  public function kosongkan_unit($kd_unit, $sekarang, $jam_sekarang){
    $sql = "UPDATE tb_unit_kotor SET jam_check_out='$jam_sekarang' WHERE kd_unit='$kd_unit' AND check_out='$sekarang'";
    $query = $this->db->query($sql);
  }

}
?>
