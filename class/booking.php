<?php
class Booking {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
  public function addBooking_via($kd_booking, $booking_via){
    $sql = "INSERT INTO tb_booking_via (kd_booking, booking_via) VALUES('$kd_booking', '$booking_via')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Show
  public function showBooking_via(){
    $sql = "SELECT * FROM tb_booking_via";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showRequestBook(){
    $sql = "SELECT * FROM tb_reservasi
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_reservasi.kd_apt
    INNER JOIN tb_unit ON tb_unit.kd_unit = tb_reservasi.kd_unit";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Edit
  public function editBooking_via($kd_booking){
    $sql = "SELECT * FROM tb_booking_via where kd_booking='$kd_booking'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Update
  public function updateBooking($kd_booking, $booking_via){
    $sql = "UPDATE tb_booking_via SET kd_booking='$kd_booking', booking_via='$booking_via' WHERE kd_booking='$kd_booking'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Delete
  public function deleteBooking_via($kd_booking){
    $sql = "DELETE FROM tb_booking_via WHERE kd_booking='$kd_booking'";
    $query = $this->db->query($sql);
  }
}
?>
