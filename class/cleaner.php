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
    WHERE tb_unit_kotor.check_out<='$sekarang' AND tb_unit_kotor.status IS NULL
    AND tb_unit_kotor.kd_unit not in(SELECT kd_unit from tb_unit_kotor where check_in='$sekarang')";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showUnit2($sekarang){
    $sql = "SELECT tb_unit.kd_unit, tb_unit.no_unit, tb_apt.nama_apt, tb_apt.alamat_apt,
    tb_unit_kotor.jam_check_out FROM tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_unit_kotor ON tb_unit_kotor.kd_unit = tb_unit.kd_unit
    WHERE tb_unit_kotor.check_out='$sekarang' AND tb_unit_kotor.status IS NULL 
    AND tb_unit_kotor.kd_unit IN (SELECT kd_unit FROM tb_unit_kotor WHERE check_in='$sekarang')";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showUnit3($sekarang){
    $sql = "SELECT tb_unit.kd_unit, tb_unit.no_unit, tb_apt.nama_apt, tb_apt.alamat_apt,
    tb_unit_kotor.jam_check_out FROM tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_unit_kotor ON tb_unit_kotor.kd_unit = tb_unit.kd_unit
    WHERE tb_unit_kotor.check_in='$sekarang' AND tb_unit_kotor.status IS NULL
    and tb_unit_kotor.kd_unit in (SELECT kd_unit from tb_unit_kotor where check_out<'$sekarang')";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showUnit_cek($tgl, $jenis, $method){
    if($method=="count"){
      $sql = "SELECT COUNT(tb_unit.kd_unit) As jumlah ";
    } else {
      $sql = "SELECT tb_unit.kd_unit, tb_unit.no_unit, tb_apt.nama_apt, tb_apt.alamat_apt, tb_unit_kotor.jam_check_out, tb_penyewa.nama, tb_penyewa.no_tlp ";   
    }
    $sql .= "FROM tb_unit INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_unit_kotor ON tb_unit_kotor.kd_unit = tb_unit.kd_unit
    INNER JOIN tb_transaksi ON tb_transaksi.kd_unit = tb_unit.kd_unit AND tb_transaksi.".$jenis."='$tgl'"."
    INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_transaksi.kd_penyewa
    WHERE tb_unit_kotor.".$jenis."='$tgl' AND (tb_transaksi.status!='2' AND tb_transaksi.status!='3')";
    $query = $this->db->query($sql);
    return $query;
  } 

  public function showUnit_stay($tgl, $method){
    if($method=="count"){
      $sql = "SELECT COUNT(tb_unit.kd_unit) As jumlah ";
    } else {
      $sql = "SELECT tb_unit.kd_unit, tb_unit.no_unit, tb_apt.nama_apt, tb_apt.alamat_apt, tb_unit_kotor.jam_check_out, tb_penyewa.nama, tb_penyewa.no_tlp ";   
    }
    $sql .= "FROM tb_unit INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_unit_kotor ON tb_unit_kotor.kd_unit = tb_unit.kd_unit
    INNER JOIN tb_transaksi ON tb_transaksi.kd_unit = tb_unit.kd_unit
    AND tb_transaksi.check_in <'$tgl'"." AND tb_transaksi.check_out>'$tgl'"." 
    INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_transaksi.kd_penyewa
    WHERE tb_unit_kotor.check_in <'$tgl' AND tb_unit_kotor.check_out>'$tgl'";
    $query = $this->db->query($sql);
    return $query;
  }   

  public function showUnit_normal($sekarang){
    $sql = "SELECT tb_unit.kd_unit, tb_unit.no_unit, tb_apt.nama_apt, tb_apt.alamat_apt
    FROM tb_unit INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    and tb_unit.kd_unit not in (SELECT kd_unit FROM tb_unit_kotor where 
    check_out<='$sekarang' AND status IS NULL)";
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

  public function updateLihat_ready($kd_unit, $sekarang){
    $sql = "UPDATE tb_unit SET ready='Y', tgl_lihat='$sekarang' WHERE kd_unit='$kd_unit'";
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
    $sql = "UPDATE tb_unit_kotor SET status='D' where kd_unit='$kd_unit' and check_out<='$sekarang'";
    $query = $this->db->query($sql);
    $sql = "DELETE FROM tb_task_unit WHERE kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
  } 

  public function deleteUnit_kotor_weekly($mingguLalu){
    $sql = "DELETE FROM tb_unit_kotor WHERE status='D' AND check_out<'$mingguLalu'";
    $query = $this->db->query($sql);    
  }

  public function kosongkan_unit($kd_unit, $sekarang, $jam_sekarang){
    if($jam_sekarang=="null"){
      $jam = "null";
    } else {
      $jam = "'".$jam_sekarang."'";
    }
    $sql = "UPDATE tb_unit_kotor SET jam_check_out=$jam WHERE kd_unit='$kd_unit' AND check_out='$sekarang'";
    $query = $this->db->query($sql);
  }

}
?>
