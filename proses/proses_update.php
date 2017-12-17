<?php
class prosesUpdate{
  public function __construct(){
    $this->db = new PDO('mysql:host=localhost;dbname=db_keuangan_cozzal','root','');
  }
  
  public function updatePenyewa($kd_penyewa, $nama, $alamat, $no_tlp, $jenis_kelamin){
	$sql = "UPDATE tb_penyewa SET nama='$nama', alamat='$alamat', no_tlp='$no_tlp', jenis_kelamin='$jenis_kelamin' WHERE kd_penyewa='$kd_penyewa'";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }
  
  public function updateUnitTransaksi($kd_transaksi, $kd_apt, $kd_unit){
	$sql = "UPDATE tb_transaksi SET kd_apt='$kd_apt', kd_unit='$kd_unit' WHERE kd_transaksi='$kd_transaksi'";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }
  
  public function updateApartemen($kd_apt, $nama_apt, $alamat_apt)
  {
	$sql = "UPDATE tb_apt SET nama_apt='$nama_apt', alamat_apt='$alamat_apt' WHERE kd_apt='$kd_apt'";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }
  
  public function updateBank($kd_bank, $nama_bank)
  {
	$sql = "UPDATE tb_bank SET nama_bank='$nama_bank', kd_bank='$kd_bank' WHERE kd_bank='$kd_bank'";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }
  
  public function updateBooking($kd_booking, $booking_via)
  {
	$sql = "UPDATE tb_booking_via SET kd_booking='$kd_booking', booking_via='$booking_via' WHERE kd_booking='$kd_booking'";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }
  
} 
?>