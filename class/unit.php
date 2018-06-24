<?php
class Unit {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
  public function addUnit($kd_apt,$kd_owner, $no_unit, $h_sewa_wd, $h_sewa_we, $h_sewa_mg, $h_sewa_bln, $h_owner_wd, $h_owner_we, $h_owner_mg, $h_owner_bln,$ekstra_charge){
    $sql = "INSERT INTO tb_unit (kd_apt, kd_owner, no_unit, h_sewa_wd, h_sewa_we, h_sewa_mg, h_sewa_bln, h_owner_wd, h_owner_we, h_owner_mg, h_owner_bln, ekstra_charge) VALUES('$kd_apt', '$kd_owner', '$no_unit', '$h_sewa_wd', '$h_sewa_we', '$h_sewa_mg', '$h_sewa_bln','$h_owner_wd', '$h_owner_we', '$h_owner_mg', '$h_owner_bln', '$ekstra_charge')";
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

  public function showHarga_unit_mod($kd_apt){
    $sql = "SELECT tb_mod_harga.kd_unit, tb_mod_harga.start_date, tb_mod_harga.end_date, tb_mod_harga.harga_sewa FROM tb_mod_harga INNER JOIN tb_unit ON tb_unit.kd_unit = tb_mod_harga.kd_unit WHERE tb_unit.kd_apt='$kd_apt'";
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
    $sql = "SELECT h_owner_wd, h_owner_we, h_owner_mg, h_owner_bln from tb_unit WHERE no_unit='$no_unit'";
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
  public function updateUnit($kd_unit ,$kd_apt,$kd_owner, $no_unit, $h_owner_wd, $h_owner_we, $h_owner_mg, $h_owner_bln, $h_sewa_wd, $h_sewa_we, $h_sewa_mg, $h_sewa_bln, $ekstra_charge){
    $sql = "update tb_unit SET kd_apt='$kd_apt', kd_owner='$kd_owner', no_unit='$no_unit', h_owner_wd='$h_owner_wd', h_owner_we='$h_owner_we',  h_owner_mg='$h_owner_mg', h_owner_bln='$h_owner_bln', h_sewa_wd='$h_sewa_wd', h_sewa_we='$h_sewa_we', h_sewa_mg='$h_sewa_mg', h_sewa_bln='$h_sewa_bln', ekstra_charge='$ekstra_charge' where kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateHargaOwner($kd_unit, $kd_owner, $h_owner_wd, $h_owner_we, $h_owner_mg, $h_owner_bln){
    if($h_owner_wd != 0){
      (($h_owner_we != 0) || ($h_owner_mg != 0) || ($h_owner_bln != 0) ? $wd = " h_owner_wd='$h_owner_wd', " : $wd = " h_owner_wd='$h_owner_wd' ");
    }
    if($h_owner_we != 0){
      (($h_owner_mg != 0) || ($h_owner_bln != 0) ? $we = " h_owner_we='$h_owner_we', " : $we = " h_owner_we='$h_owner_we' ");
    }
    if($h_owner_mg != 0){
      ($h_owner_bln != 0 ? $mg = " h_owner_mg='$h_owner_mg', " : $mg = " h_owner_mg='$h_owner_mg' ");
    }
    if($h_owner_bln != 0){
      $bln = " h_owner_wd='$h_owner_bln' ";
    }
    $sql = "update tb_unit SET ".$wd.$we.$mg.$bln."WHERE kd_unit='$kd_unit' AND kd_owner='$kd_owner'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateHargaSewa($kd_unit, $kd_owner, $h_sewa_wd, $h_sewa_we, $h_sewa_mg, $h_sewa_bln){
    if($h_sewa_wd != 0){
      (($h_sewa_we != 0) || ($h_sewa_mg != 0) || ($h_sewa_bln != 0) ? $wd = " h_sewa_wd='$h_sewa_wd', " : $wd = " h_sewa_wd='$h_sewa_wd' ");
    }
    if($h_sewa_we != 0){
      (($h_sewa_mg != 0) || ($h_sewa_bln != 0) ? $we = " h_sewa_we='$h_sewa_we', " : $we = " h_sewa_we='$h_sewa_we' ");
    }
    if($h_sewa_mg != 0){
      ($h_sewa_bln != 0 ? $mg = " h_sewa_mg='$h_sewa_mg', " : $mg = " h_sewa_mg='$h_sewa_mg' ");
    }
    if($h_sewa_bln != 0){
      $bln = " h_sewa_wd='$h_sewa_bln' ";
    }
    $sql = "update tb_unit SET ".$wd.$we.$mg.$bln."WHERE kd_unit='$kd_unit' AND kd_owner='$kd_owner'";
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
  public function updateHarga_Unit($kd_unit , $h_owner_wd, $h_owner_we, $h_owner_mg, $h_owner_bln, $h_sewa_wd, $h_sewa_we, $h_sewa_mg, $h_sewa_bln, $ekstra_charge){
    $sql = "update tb_unit SET h_owner_wd='$h_owner_wd', h_owner_we='$h_owner_we', h_owner_mg='$h_owner_mg', h_owner_bln='$h_owner_bln'";
    if($ekstra_charge!=''){
      $sql = $sql.", h_sewa_we='$h_sewa_we', h_sewa_wd='$h_sewa_wd', h_sewa_mg='$h_sewa_mg', h_sewa_bln='$h_sewa_bln', ekstra_charge='$ekstra_charge'";
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
    $sql = "DELETE FROM tb_unit WHERE kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function getURL($kd_unit){
    $sql = "SELECT kd_unit, url_bnb FROM tb_unit WHERE kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    return $query;
  }

// class yang digunakan hanya pada evaluasi_unit_kotor :

  public function showTransaksi_byDate($minggu_lalu){
    $sql = "SELECT kd_unit, check_in, check_out FROM tb_transaksi WHERE check_out>='$minggu_lalu'
    AND status!='2' AND status!='3'";
    $query = $this->db->query($sql);
    return $query;    
  }

  public function is_UnitKotor_exists($kd_unit, $check_in, $check_out) {
    $result = $this->db->prepare("SELECT kd_unit FROM tb_unit_kotor WHERE kd_unit= ? AND check_in= ? AND check_out= ?");
    $result->bindParam(1, $kd_unit);
    $result->bindParam(2, $check_in);
    $result->bindParam(3, $check_out);
    $result->execute();
    $rows = $result->fetch();
    return $rows;
  }

  public function addUnit_kotor($kd_unit, $check_in, $check_out){
    $sql = "INSERT INTO tb_unit_kotor(kd_unit, check_in, check_out) VALUES ('$kd_unit','$check_in','$check_out')";
    $query = $this->db->query($sql);
  }

}
?>
