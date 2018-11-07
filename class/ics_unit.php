<?php
class Ics_unit {
  private $db;

  public function __construct($database){
    $this->db = $database;
  }

  //Membuat Log
  public function LogIcs($file,$conten){
    echo "bisa";
    if(!file_exists($file)){
      $myfile = fopen($file, "w");
      fwrite($myfile, "Head Logging File \n");
      fclose($myfile);
    }
    file_put_contents($file,$conten."\n",FILE_APPEND);
  }

  //cancle booking pada list booked (blok dari ics lain)
  public function cancelBooked($kd_unit, $check_in){
    $sql = "DELETE FROM tb_booked WHERE kd_unit='$kd_unit' AND check_in='$check_in'";
    $query = $this->db->query($sql);    
    $sql = "DELETE FROM tb_mod_calendar WHERE kd_unit='$kd_unit' AND start_date='$check_in'";
    $query = $this->db->query($sql);
    $sql = "DELETE FROM tb_unit_kotor WHERE kd_unit='$kd_unit' AND check_in='$check_in'";
    $query = $this->db->query($sql);    
  }

  //membuat bookingan dari list ics (ics luar)
  public function createBooked($kd_unit, $kd_apt, $penyewa, $no_tlp, $check_in, $check_out, $kd_url){
    $sql = "INSERT into tb_booked VALUES (null, '$kd_unit', '$kd_apt', '$penyewa', '$no_tlp', 
    '$check_in','$check_out', '1', '$kd_url')";
    $this->db->query($sql);
    $sql = "INSERT INTO tb_mod_calendar(kd_unit, start_date, end_date, note, jenis)
    SELECT '$kd_unit' AS unit, '$check_in' AS CI, '$check_out' AS CO, CONCAT('Booked By ',title) 
    AS note, '5' AS JN FROM tb_url_unit WHERE kd_url = '$kd_url'";
    $this->db->query($sql);
    $sql = "INSERT INTO tb_unit_kotor VALUES('$kd_unit', '$check_in', '$check_out', null, null)";
    $this->db->query($sql);
  }

  //menampilkan transaksi (check_in) yang terjadi dalam 3 bulan terakhir ($sekarang = $sekarang - 90 hari)
  public function showRecent_trx($kd_unit, $sekarang){
    $sql = "SELECT check_in FROM tb_transaksi WHERE kd_unit='$kd_unit' 
    AND (check_in>='$sekarang' OR check_out>='$sekarang') AND status!='2' 
    AND status!='3'";
    $query = $this->db->query($sql);
    return $query;
  }

  //menampilkan seluruh booked list (check_in) pada 3 bulan terakhir
  public function showRecent_booked($kd_unit, $sekarang){
    $sql = "SELECT check_in, status FROM tb_booked WHERE kd_unit='$kd_unit' 
    AND (check_in>='$sekarang' OR check_out>='$sekarang')";
    $query = $this->db->query($sql);
    return $query;
  }

  // mendapatkan list unit unutk load ics (Sistem lama)
  public function showUnit(){
    $sql = "SELECT kd_unit, url_bnb, kd_apt FROM tb_unit 
    WHERE url_bnb is not null OR url_bnb!=''";
    $query = $this->db->query($sql);
    return $query;    
  }  

  // menampilkan list unit untuk refresh link (sementara airbnb)
  public function showUnit2(){
    $sql = "SELECT tb_unit.kd_unit, tb_unit.kd_apt, 
    tb_unit.no_unit, tb_apt.nama_apt FROM tb_unit
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt";
    $query = $this->db->query($sql);
    return $query;    
  } 

  public function showURL($kd_unit, $jenis){
    $sql = "SELECT kd_url, title, url FROM tb_url_unit 
    WHERE kd_unit = '$kd_unit' AND jenis='$jenis'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showURLbyGroup($group_update){
    $sql = "SELECT tb_url_unit.kd_url, tb_url_unit.title, tb_url_unit.url, 
    tb_unit.kd_apt, tb_unit.kd_unit, tb_unit.no_unit 
    FROM tb_url_unit INNER JOIN tb_unit ON tb_unit.kd_unit=tb_url_unit.kd_unit 
    WHERE tb_url_unit.group_update = '$group_update'";
    $query = $this->db->query($sql);
    return $query;
  }

  // mendapatkan url dari kd_url
  public function urlByKd_url($kd_url){
    $sql = "SELECT url FROM tb_url_unit WHERE kd_url='$kd_url'";
    $query = $this->db->query($sql);
    return $query;     
  }

  // membuat url baru ( baik url cozzal ataupun yang lainnya )
  public function buildURL($kd_unit, $title, $jenis, $url, $group_update){
    $sql = "INSERT INTO tb_url_unit VALUES(null, '$kd_unit', '$title','$jenis', '$url', '$group_update')";
    $query = $this->db->query($sql);
    if(!$query){
      return false;
    }else{
      return true;
    }    
  }

  // update perubahan URL pada URL non sistem
  public function updateURL($kd_url, $title, $jenis, $url, $group_update){
    $sql = "UPDATE tb_url_unit SET title='$title', jenis='$jenis', url='$url', group_update='$group_update' WHERE
    kd_url='$kd_url'";
    $query = $this->db->query($sql);
    if(!$query){
      return false;
    }else{
      return true;
    }  
  }

  // membuat atau mengupdate ics untuk url cozzal
  public function createIcs($kd_unit){
    //$this->buildIcs($kd_unit);
    //$this->setURL($kd_unit, 'transaksi.cozzal.com/ics/shared_ics.php?request='.$kd_unit, 'url_cozzal');
    return $this->buildURL($kd_unit, "Cozzal Sys", "0", 'transaksi.cozzal.com/ics/shared_ics.php?request='.$kd_unit, "0");
  }  

  // memberi pengeluaran list dalam bentuk ics stream yang berisi data transaksi dan booking
  public function buildIcs($kd_unit){
    include 'ics.php';
    $day_before = strtotime('-90 Days');
    $minimum_date = date('Y-m-d',$day_before);    
    $unit = explode("/", $kd_unit);
    $ics = new ICS("");

    for($i=0;$i<count($unit);$i++){
      $ics->change_file("../../listics/".$unit[$i].".ics");
      $ics->create_ical();
      $show = $this->showUnit_byId($unit[$i], $minimum_date);
      while($data = $show->fetch(PDO::FETCH_OBJ)){
        $this->insert_event(
          $ics, $data->nama_apt."-".$data->alamat_apt, 'Booked by cozzal', $data->check_in, 
          $data->check_out, $data->nama, 'transaksi.cozzal.com'
        );
      }  
      $show = $this->showunitMod_byId($unit[$i], $minimum_date);
      while($data = $show->fetch(PDO::FETCH_OBJ)){
        $this->insert_event(
          $ics, 'Not Avaliable', 'Blocked by cozzal', $data->start_date, 
          $data->end_date, $data->note, 'transaksi.cozzal.com'
        );
      }        
      $ics->to_string(); 
    }
  }

  public function deleteTrash_booked($batas_waktu){
    $sql = "DELETE FROM tb_booked WHERE check_out<'$batas_waktu' AND status!='1'";
    $query = $this->db->query($sql);  
  }

  // ------- Private Function --------------

  // menampilkan transaksi berdasarkan minimum date (untuk buildIcs)
  private function showUnit_byId($kd_unit, $minimum_date){
    $sql = "SELECT tb_transaksi.check_in, tb_transaksi.check_out, tb_apt.nama_apt,
    tb_apt.alamat_apt, tb_penyewa.nama FROM tb_transaksi
    INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_transaksi.kd_penyewa
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_transaksi.kd_apt 
    WHERE tb_transaksi.kd_unit='$kd_unit' AND (tb_transaksi.check_out>='$minimum_date' 
    OR tb_transaksi.check_in>='$minimum_date') AND tb_transaksi.status!=2 AND tb_transaksi.status!=3 AND tb_transaksi.status_broker != 'B'"; // 3 adalah kode booking airbnb dan 1 adalah status di transaksi 
    $query = $this->db->query($sql);
    return $query;
  }

  // menampilkan bloking tanggal berdasarkan minimum date (untuk buildIcs)
  private function showunitMod_byId($kd_unit, $minimum_date){
    $sql = "SELECT kd_unit, start_date, end_date, note FROM tb_mod_calendar 
    WHERE kd_unit='$kd_unit' AND (start_date>='$minimum_date' OR end_date>='$minimum_date')
    AND jenis!='5'"; // 3 adalah kode booking airbnb dan 1 adalah status di transaksi 
    $query = $this->db->query($sql);
    return $query;
  }

  // menambahkan event trx atau booked atau mod, ke dalam list stream ics (pada buildIcs)
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
