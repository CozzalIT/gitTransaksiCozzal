<?php
class Booked {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  public function hapusBooked($kd_booked, $kd_unit, $check_in){
    $sql = "UPDATE tb_booked SET status='0' WHERE kd_booked='$kd_booked'";
    $query = $this->db->query($sql);    
    $sql = "DELETE FROM tb_mod_calendar WHERE kd_unit='$kd_unit' AND start_date='$check_in'";
    $query = $this->db->query($sql);
    $sql = "DELETE FROM tb_unit_kotor WHERE kd_unit='$kd_unit' AND check_in='$check_in'";
    $query = $this->db->query($sql);    
  }

  public function delete_booked_root($kd_booked, $kd_unit, $check_in){
    $sql = "DELETE FROM tb_booked WHERE kd_booked='$kd_booked'";
    $query = $this->db->query($sql);    
    $sql = "DELETE FROM tb_mod_calendar WHERE kd_unit='$kd_unit' AND start_date='$check_in'";
    $query = $this->db->query($sql);
    $sql = "DELETE FROM tb_unit_kotor WHERE kd_unit='$kd_unit' AND check_in='$check_in'";
    $query = $this->db->query($sql);    
  }

  //show detail booked
  public function showDetail_booked($kd_booked){
    $sql = "SELECT tb_booked.kd_unit, tb_booked.kd_apt, tb_booked.penyewa, tb_booked.check_in, tb_booked.check_out, tb_booked.status, 
    tb_booked.no_tlp, tb_unit.no_unit, tb_apt.nama_apt 
    FROM tb_booked INNER JOIN tb_unit ON tb_unit.kd_unit = tb_booked.kd_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_booked.kd_apt WHERE tb_booked.kd_booked = '$kd_booked'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function getharga($kd_unit){
    $sql = "SELECT h_sewa_we, h_sewa_wd, ekstra_charge FROM tb_unit WHERE kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function getListPenyewa($keyword){ 
    $sql = "SELECT kd_penyewa, nama, alamat, no_tlp FROM tb_penyewa 
    WHERE nama like '%$keyword%' ORDER BY nama ASC";
    $query = $this->db->query($sql);
    return $query;
  }

  public function getKd_penyewa(){
    $sql = "SELECT MAX(kd_penyewa) AS penyewa FROM tb_penyewa";
    $query = $this->db->query($sql);
    return $query;    
  }

}
?>
