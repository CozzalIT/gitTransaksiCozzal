<?php
class Unit {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
  public function addUnit($kd_apt,$kd_owner, $no_unit, $h_sewa_wd, $h_sewa_we, $h_owner_wd, $h_owner_we, $ekstra_charge){
    $sql = "INSERT INTO tb_unit (kd_apt, kd_owner, no_unit, h_sewa_wd, h_sewa_we, h_owner_wd, h_owner_we, ekstra_charge) VALUES('$kd_apt', '$kd_owner', '$no_unit', '$h_sewa_wd', '$h_sewa_we', '$h_owner_wd', '$h_owner_we', '$ekstra_charge')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function addDetail_Unit($kd_unit, $lantai, $jml_kmr, $jml_bed, $jml_ac, $water_heater, $dapur, $wifi, $tv, $amenities, $merokok, $type, $img, $isi){
    $sql = "INSERT INTO tb_detail_unit (kd_unit, lantai, jml_kmr, jml_bed, jml_ac, water_heater, dapur, wifi, tv, amenities, merokok, type, img, isi)
    VALUES('$kd_unit', '$lantai', '$jml_kmr', '$jml_bed', '$jml_ac', '$water_heater', '$dapur', '$wifi', '$tv', '$amenities', '$merokok', '$type', '$img', '$isi')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function addMaintenance($kd_unit, $awal, $akhir, $catatan){
    $sql = "INSERT INTO tb_maintenance (kd_unit, start_date, end_date, note)VALUES('$kd_unit', '$awal', '$akhir', '$catatan')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Show
  public function showUnit(){
    $sql = "SELECT * FROM tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_owner ON tb_owner.kd_owner = tb_unit.kd_owner";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Show
  public function showUnitbyOwner($kd_owner){
    $sql = "SELECT * FROM tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    WHERE tb_unit.kd_owner='$kd_owner'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showDetail_Unit($kd_unit){
    $sql = "SELECT * FROM tb_detail_unit
    where kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showUnitbyId($kd_unit){
    $sql = "SELECT * FROM tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_owner ON tb_owner.kd_owner = tb_unit.kd_owner
    where tb_unit.kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showUnitByApt($kd_apt){
    $sql = "SELECT * from tb_unit where kd_apt='$kd_apt'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showHargaOwner($no_unit){
    $sql = "SELECT h_owner_wd, h_owner_we from tb_unit WHERE no_unit='$no_unit'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showRequestListing(){
    $sql = "SELECT * FROM tb_request_listing";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Edit
  public function editUnit($kd_unit){
    $sql = "SELECT * from tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
    INNER JOIN tb_owner ON tb_owner.kd_owner = tb_unit.kd_owner
    where kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Update
  public function updateUnit($kd_unit ,$kd_apt,$kd_owner, $no_unit, $h_owner_wd, $h_owner_we, $h_sewa_wd, $h_sewa_we, $ekstra_charge){
    $sql = "update tb_unit SET kd_apt='$kd_apt', kd_owner='$kd_owner', no_unit='$no_unit', h_owner_wd='$h_owner_wd', h_owner_we='$h_owner_we',
    h_sewa_wd='$h_sewa_wd', h_sewa_we='$h_sewa_we', ekstra_charge='$ekstra_charge' where kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Update informasi dasar unit
  public function updateInfo_Unit($kd_unit ,$kd_apt, $no_unit, $kd_owner){
    $sql = "update tb_unit SET kd_apt='$kd_apt', no_unit='$no_unit'";
    if($kd_owner!=''){
      $sql = $sql.", kd_owner='$kd_owner'";
    }
    $sql = $sql." where kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Update harga unit
  public function updateHarga_Unit($kd_unit , $h_owner_wd, $h_owner_we, $h_sewa_wd, $h_sewa_we, $ekstra_charge){
    $sql = "update tb_unit SET h_owner_wd='$h_owner_wd', h_owner_we='$h_owner_we'";
    if($ekstra_charge!=''){
      $sql = $sql.", h_sewa_we='$h_sewa_we', h_sewa_wd='$h_sewa_wd', ekstra_charge='$ekstra_charge'";
    }
    $sql = $sql." where kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateDetail_Unit($kd_unit, $lantai, $jml_kmr, $jml_bed, $jml_ac, $water_heater, $dapur, $wifi, $tv, $amenities, $merokok, $type){
    $sql = "update tb_detail_unit SET lantai='$lantai', jml_kmr='$jml_kmr', jml_bed='$jml_bed', jml_ac='$jml_ac', water_heater='$water_heater',
    dapur='$dapur', wifi='$wifi', tv='$tv', amenities='$amenities', merokok='$merokok', type='$type', isi='Y' where kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateGambar_unit($kd_unit, $img){
    $sql = "update tb_detail_unit SET img='$img' where kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateKurangi_jumlah_unit_owner($kd_owner){
    $sql = "update tb_owner SET jumlah_unit=jumlah_unit-1 where kd_owner='$kd_owner'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateJumlah_unit_owner($kd_owner){
    $sql = "update tb_owner SET jumlah_unit=jumlah_unit+1 where kd_owner='$kd_owner'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Delete
  public function deleteUnit($kd_unit){
    $sql = "DELETE FROM tb_unit WHERE kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function deleteDetail_Unit($kd_unit){
    $sql = "DELETE FROM tb_detail_unit WHERE kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }
}
?>
