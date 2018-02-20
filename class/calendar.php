<?php
  class Calendar {
    private $db;

    public function __construct($database){
      $this->db = $database;
    }

    //Show
    public function showNoUnit($kd_unit){
      $sql = "SELECT tb_unit.no_unit, tb_unit.kd_apt, tb_apt.kd_apt, tb_apt.nama_apt FROM tb_unit
      INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
      WHERE kd_unit='$kd_unit'";
      $query = $this->db->query($sql);
      return $query;
    }

    public function showCalendarBooked($kd_unit){
      $sql = "SELECT check_in, check_out from tb_transaksi where kd_unit='$kd_unit'";
      //$sql_confirm = "SELECT * from tb_confirm_transaksi where kd_unit='$kd_unit'";
      $query = $this->db->query($sql);
      //$query1 = $this->db->query($sql_confirm);
      return $query;
    }

    public function showCalendarConfirm($kd_unit){
      $sql = "SELECT check_in, check_out from tb_confirm_transaksi where kd_unit='$kd_unit'";
      $query = $this->db->query($sql);
      return $query;
    }

    public function showModCalendar($kd_unit){
      $sql = "SELECT * FROM tb_mod_calendar where kd_unit='$kd_unit'";
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

  }
?>
