<?php
class Ics_unit {
  private $db;

  public function __construct($database){
    $this->db = $database;
  }

  public function cancelBooked($kd_unit, $check_in){
    $sql = "UPDATE tb_booked SET status='0' WHERE kd_unit='$kd_unit' AND check_in='$check_in'";
    $query = $this->db->query($sql);    
    $sql = "DELETE FROM tb_mod_calendar WHERE kd_unit='$kd_unit' AND start_date='$check_in'";
    $query = $this->db->query($sql);
    $sql = "DELETE FROM tb_unit_kotor WHERE kd_unit='$kd_unit' AND check_in='$check_in'";
    $query = $this->db->query($sql);    
  }

  public function createBooked($kd_unit, $kd_apt, $penyewa, $no_tlp, $check_in, $check_out){
    $sql = "INSERT into tb_booked VALUES (null, '$kd_unit', '$kd_apt', '$penyewa', '$no_tlp', 
    '$check_in','$check_out', '1')";
    $this->db->query($sql);
    $sql = "INSERT INTO tb_mod_calendar VALUES(null, '$kd_unit', '$check_in', '$check_out', 'Booked by Airbnb', '3')";
    $this->db->query($sql);
    $sql = "INSERT INTO tb_unit_kotor VALUES('$kd_unit', '$check_in', '$check_out', null)";
    $this->db->query($sql);
  }

  public function showRecent_trx($kd_unit, $sekarang){
    $sql = "SELECT check_in FROM tb_transaksi WHERE kd_unit='$kd_unit' 
    AND (check_in>='$sekarang' OR check_out>='$sekarang')";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showRecent_booked($kd_unit, $sekarang){
    $sql = "SELECT check_in FROM tb_booked WHERE kd_unit='$kd_unit' 
    AND (check_in>='$sekarang' OR check_out>='$sekarang') AND status!='0'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showUnit(){
    $sql = "SELECT kd_unit, url_bnb, kd_apt FROM tb_unit 
    WHERE url_bnb is not null OR url_bnb!=''";
    $query = $this->db->query($sql);
    return $query;    
  }  

  public function setURL($kd_unit, $url, $type){ //there are 2 type, url_bnb and url_cozzal
    $sql = "UPDATE tb_unit SET $type = '$url' WHERE kd_unit = '$kd_unit'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function createIcs($kd_unit){
    $this->buildIcs($kd_unit);
    $this->setURL($kd_unit, 'transaksi.cozzal.com/ics/listing/'.$kd_unit.'.ics', 'url_cozzal');
    return true;
  }  

  public function buildIcs($kd_unit){ //update
    include 'ics.php';
    $day_before = strtotime('-90 Days');
    $minimum_date = date('Y-m-d',$day_before);    
    $ics = new ICS("../ics/listing/".$kd_unit.".ics");
    $unit = explode('/',$kd_unit);
    for($i=0;$i<count($unit);$i++){
      $kd_unit = $unit[$i];
      $ics->change_file("../ics/listing/".$kd_unit.".ics");
      $ics->create_ical();
      $show = $this->showUnit_byId($kd_unit, $minimum_date);
      while($data = $show->fetch(PDO::FETCH_OBJ)){
        $this->insert_event(
          $ics, $data->nama_apt."-".$data->alamat_apt, 'Booked by cozzal', $data->check_in, 
          $data->check_out, $data->nama, 'transaksi.cozzal.com'
        );
      }  
      $show = $this->showunitMod_byId($kd_unit, $minimum_date);
      while($data = $show->fetch(PDO::FETCH_OBJ)){
        $this->insert_event(
          $ics, 'Not Avaliable', 'Blocked by cozzal', $data->start_date, 
          $data->end_date, $data->note, 'transaksi.cozzal.com'
        );
      }        
      $ics->to_string();   
    }                
  }

  private function showUnit_byId($kd_unit, $minimum_date){
    $sql = "SELECT tb_transaksi.check_in, tb_transaksi.check_out, tb_apt.nama_apt,
    tb_apt.alamat_apt, tb_penyewa.nama FROM tb_transaksi
    INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_transaksi.kd_penyewa
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_transaksi.kd_apt 
    WHERE tb_transaksi.kd_unit='$kd_unit' AND (tb_transaksi.check_out>='$minimum_date' 
    OR tb_transaksi.check_in>='$minimum_date') AND tb_transaksi.kd_booking!='3'
    AND tb_transaksi.status!=2 AND tb_transaksi.status!=3"; // 3 adalah kode booking airbnb dan 1 adalah status di transaksi 
    $query = $this->db->query($sql);
    return $query;
  }

  private function showunitMod_byId($kd_unit, $minimum_date){
    $sql = "SELECT kd_unit, start_date, end_date, note FROM tb_mod_calendar 
    WHERE kd_unit='$kd_unit' AND (start_date>='$minimum_date' OR end_date>='$minimum_date')"; // 3 adalah kode booking airbnb dan 1 adalah status di transaksi 
    $query = $this->db->query($sql);
    return $query;
  }

  private function insert_event($ics, $location, $description, $dtstart, $dtend, $summary, $url){
    $ics->add_event(array(
      'location' => $location,
      'description' => $description, 
      'dtstart' => $dtstart, 
      'dtend' => $dtend,
      'summary' => $summary,
      'url' => $url
    ));    
  }

}
?>
