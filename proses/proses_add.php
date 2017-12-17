<?php
class prosesAdd{
  public function __construct(){
    $this->db = new PDO('mysql:host=localhost;dbname=db_keuangan_cozzal','root','');
  }

  public function addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin){
	$sql = "INSERT INTO tb_penyewa (nama, alamat, no_tlp, jenis_kelamin) VALUES('$nama', '$alamat', '$no_tlp', '$jenis_kelamin')";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }

  public function addApartemen($nama_apt, $alamat_apt){
	$sql = "INSERT INTO tb_apt (nama_apt, alamat_apt) VALUES('$nama_apt', '$alamat_apt')";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }
  
  public function addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $ekstra_charge, $kd_booking, $kd_bank, $dp){
	$sql = "INSERT INTO tb_transaksi (kd_penyewa, kd_apt, kd_unit, tamu, check_in, check_out, harga_sewa, ekstra_charge, kd_booking, kd_bank, dp) VALUES('$kd_penyewa', '$kd_apt', '$kd_unit', '$tamu', '$check_in', '$check_out', '$harga_sewa', '$ekstra_charge', '$kd_booking', '$kd_bank', '$dp')";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }
  
  public function addBooking_via($kd_booking, $booking_via){
	$sql = "INSERT INTO tb_booking_via (kd_booking, booking_via) VALUES('$kd_booking', '$booking_via')";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }
  
  public function addDp_via($kd_bank, $nama_bank){
	$sql = "INSERT INTO tb_bank (kd_bank,nama_bank) VALUES('$kd_bank', '$nama_bank')";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }
  
  public function add_owner($kd_apt, $nama, $alamat, $no_tlp, $kd_bank, $no_rek, $tgl_gabung){
	$sql = "INSERT INTO tb_owner (kd_apt,nama,alamat,no_tlp, kd_bank, no_rek, tgl_gabung) 
	VALUES('$kd_apt', '$nama', '$alamat', '$no_tlp', '$kd_bank', '$no_rek', '$tgl_gabung')";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }
  
}
?>
