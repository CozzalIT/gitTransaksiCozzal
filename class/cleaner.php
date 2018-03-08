<?php
class Cleaner {
  private $db;

  public function __construct($database){
    $this->db = $database;
  }

  public function showUnit1($sekarang){
    $sql = "SELECT * FROM tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_unit_kotor ON tb_unit_kotor.kd_unit = tb_unit.kd_unit
    WHERE tb_unit_kotor.check_out<='$sekarang' 
    AND tb_unit_kotor.kd_unit not in(SELECT kd_unit from tb_unit_kotor where check_in='$sekarang')";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showUnit2($sekarang){
    $sql = "SELECT * FROM tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_unit_kotor ON tb_unit_kotor.kd_unit = tb_unit.kd_unit
    WHERE tb_unit_kotor.check_out='$sekarang' and tb_unit_kotor.kd_unit
    IN (SELECT kd_unit FROM tb_unit_kotor WHERE check_in='$sekarang')";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showUnit3($sekarang){
    $sql = "SELECT * FROM tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_unit_kotor ON tb_unit_kotor.kd_unit = tb_unit.kd_unit
    WHERE tb_unit_kotor.check_in='$sekarang' 
    and tb_unit_kotor.kd_unit in (SELECT kd_unit from tb_unit_kotor where check_out<'$sekarang')";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showUnit_normal($sekarang){
    $sql = "SELECT * FROM tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
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

  public function deleteUnit_kotor($kd_unit, $sekarang){
    $sql = "DELETE FROM tb_unit_kotor where kd_unit='$kd_unit' and check_out<='$sekarang'";
    $query = $this->db->query($sql);
  } 

}
?>
