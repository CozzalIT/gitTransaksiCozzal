<?php
  class Calendar {
    private $db;

    public function __construct($database){
      $this->db = $database;
    }

    //Show
    public function showNoUnit(){
      $sql = "SELECT tb_unit.kd_unit, tb_unit.no_unit, tb_unit.kd_apt, tb_unit.url_bnb,
      tb_unit.url_cozzal, tb_apt.kd_apt, tb_apt.nama_apt FROM tb_unit
      INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt ORDER BY tb_apt.nama_apt ASC";
      $query = $this->db->query($sql);
      return $query;
    }

    public function showCalendar($kd_unit){
      $sql = "SELECT check_in, check_out, status from tb_transaksi where kd_unit='$kd_unit'";
      //$sql_confirm = "SELECT * from tb_confirm_transaksi where kd_unit='$kd_unit'";
      $query = $this->db->query($sql);
      //$query1 = $this->db->query($sql_confirm);
      return $query;
    }

    public function showModCalendar($kd_unit){
      $sql = "SELECT * FROM tb_mod_calendar where kd_unit='$kd_unit'";
      $query = $this->db->query($sql);
      return $query;
    }

    public function showModHarga($kd_unit){
      $sql = "SELECT * FROM tb_mod_harga where kd_unit='$kd_unit'";
      $query = $this->db->query($sql);
      return $query;
    }

    //Add
    public function addModCalendar($kd_unit, $start_date, $end_date, $note, $jenis){
      $sql = "INSERT INTO tb_mod_calendar (kd_unit, start_date, end_date, note, jenis) VALUES('$kd_unit', '$start_date', '$end_date', '$note', '$jenis')";
      $query = $this->db->query($sql);
      if(!$query){
        return "Failed";
      }else{
        return "Success";
      }
    }

    public function addModHarga($kd_unit, $start_date, $end_date, $harga_sewa, $harga_owner, $note){
      $sql = "INSERT INTO tb_mod_harga (kd_unit, start_date, end_date, harga_sewa, harga_owner, note) VALUES('$kd_unit', '$start_date', '$end_date', '$harga_sewa', '$harga_owner', '$note')";
      $query = $this->db->query($sql);
      if(!$query){
        return "Failed";
      }else{
        return "Success";
      }
    }

    //Edit
    public function editModCalendar($kd_mod_calendar){
      $sql = "SELECT * FROM tb_mod_calendar where kd_mod_calendar='$kd_mod_calendar'";
      $query = $this->db->query($sql);
      return $query;
    }

    public function editModHarga($kd_mod_harga){
      $sql = "SELECT * FROM tb_mod_harga where kd_mod_harga='$kd_mod_harga'";
      $query = $this->db->query($sql);
      return $query;
    }

    //Delete
    public function deleteModCalendar($kd_mod_calendar){
      $sql = "DELETE FROM tb_mod_calendar WHERE kd_mod_calendar='$kd_mod_calendar'";
      $query = $this->db->query($sql);
      return $query;
    }

    public function deleteModHarga($kd_mod_harga){
      $sql = "DELETE FROM tb_mod_harga WHERE kd_mod_harga='$kd_mod_harga'";
      $query = $this->db->query($sql);
      return $query;
    }

    //Proses Update
    public function updateModCal($kd_mod_calendar, $awal, $akhir, $catatan){
      $sql = "UPDATE tb_mod_calendar SET start_date='$awal', end_date='$akhir', note='$catatan' WHERE kd_mod_calendar='$kd_mod_calendar'";
      $query = $this->db->query($sql);
      if(!$query){
        return "Failed";
      }else{
        return "Success";
      }
    }

    public function updateModHarga($kd_mod_harga, $awal, $akhir, $sewa, $owner, $catatan){
      $sql = "UPDATE tb_mod_harga SET start_date='$awal', end_date='$akhir', harga_sewa='$sewa', harga_owner='$owner', note='$catatan' WHERE kd_mod_harga='$kd_mod_harga'";
      $query = $this->db->query($sql);
      if(!$query){
        return "Failed";
      }else{
        return "Success";
      }
    }

  }
?>
