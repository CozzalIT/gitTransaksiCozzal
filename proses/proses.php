<?php
class Proses{
  public function __construct(){
    $this->db = new PDO('mysql:host=localhost;dbname=db_keuangan_cozzal','root','');
  }

  public function editPenyewa($kd_penyewa){
	$sql = "SELECT * FROM tb_penyewa WHERE kd_penyewa='$kd_penyewa'";
	$query = $this->db->query($sql);
	return $query;
  }
  
  public function editTransaksi($kd_transaksi){
	$sql = "SELECT * from tb_transaksi 
	  INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_transaksi.kd_penyewa 
	  INNER JOIN tb_apt ON tb_apt.kd_apt = tb_transaksi.kd_apt
	  INNER JOIN tb_bank ON tb_bank.kd_bank = tb_transaksi.kd_bank
	  INNER JOIN tb_booking_via ON tb_booking_via.kd_booking = tb_transaksi.kd_booking
	  INNER JOIN tb_unit ON tb_unit.kd_unit = tb_transaksi.kd_unit WHERE kd_transaksi='$kd_transaksi'";
	$query = $this->db->query($sql);
	return $query;
  }

  public function showPenyewa(){
	$sql = "SELECT * FROM tb_penyewa";
	$query = $this->db->query($sql);
	return $query;
  }

  public function showApartemen(){
	$sql = "SELECT * FROM tb_apt";
	$query = $this->db->query($sql);
	return $query;
  }
  
  public function editApartemen($kd_apart){
	$sql = "SELECT * FROM tb_apt WHERE kd_apt='$kd_apart'";
	$query = $this->db->query($sql);
	return $query;
  }

  public function showUnit(){
	$sql = "SELECT * FROM tb_unit INNER JOIN tb_apt USING (kd_apt)";
	$query = $this->db->query($sql);
	return $query;
  }
  
  public function showTransaksi(){
	$sql = "SELECT * from tb_transaksi 
	  INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_transaksi.kd_penyewa 
	  INNER JOIN tb_apt ON tb_apt.kd_apt = tb_transaksi.kd_apt
	  INNER JOIN tb_unit ON tb_unit.kd_unit = tb_transaksi.kd_unit";
	$query = $this->db->query($sql);
	return $query;
  }
  
  public function showBooking_via(){
	$sql = "SELECT * FROM tb_booking_via";
	$query = $this->db->query($sql);
	return $query;
  }
  
  public function editBooking_via($kd_booking){
	$sql = "SELECT * FROM tb_booking_via where kd_booking='$kd_booking'";
	$query = $this->db->query($sql);
	return $query;
  }  
  
  public function showDp_via(){
	$sql = "SELECT * FROM tb_bank";
	$query = $this->db->query($sql);
	return $query;
  }
  
   public function editDp_via($kd_bank){
	$sql = "SELECT * FROM tb_bank where kd_bank='$kd_bank'";
	$query = $this->db->query($sql);
	return $query;
  }
  
   public function showowner(){
	$sql = "SELECT * from tb_owner 
	  INNER JOIN tb_apt ON tb_apt.kd_apt = tb_owner.kd_apt 
	  INNER JOIN tb_bank ON tb_bank.kd_bank = tb_owner.kd_bank";
	$query = $this->db->query($sql);
	return $query;
  }
  
}
?>
