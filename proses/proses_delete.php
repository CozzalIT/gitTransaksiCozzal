<?php
class prosesDelete{
  public function __construct(){
    $this->db = new PDO('mysql:host=localhost;dbname=db_keuangan_cozzal','root','');
  }

  public function deletePenyewa($kd_penyewa){
	$sql = "DELETE FROM tb_penyewa WHERE kd_penyewa='$kd_penyewa'";
	$query = $this->db->query($sql);
  }

  public function deleteApartemen($kd_apt){
	$sql = "DELETE FROM tb_apt WHERE kd_apt='$kd_apt'";
	$query = $this->db->query($sql);
  }

  public function deleteUnit($kd_unit){
	$sql = "DELETE FROM tb_unit WHERE kd_unit='$kd_unit'";
	$query = $this->db->query($sql);
  }
  
  public function deleteBooking_via($kd_booking){
	$sql = "DELETE FROM tb_booking_via WHERE kd_booking='$kd_booking'";
	$query = $this->db->query($sql);
  }
  
  public function deleteDp_via($kd_bank){
	$sql = "DELETE FROM tb_bank WHERE kd_bank='$kd_bank'";
	$query = $this->db->query($sql);
  }
}
?>
