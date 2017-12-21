<?php
class Proses{
  public function __construct(){
    $this->db = new PDO('mysql:host=localhost;dbname=db_keuangan_cozzal','root','');
  }

//Proses Add (Awal)
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
//Proses Add (Akhir)

//Proses Edit (Awal)
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

  public function editApartemen($kd_apart){
  $sql = "SELECT * FROM tb_apt WHERE kd_apt='$kd_apart'";
  $query = $this->db->query($sql);
  return $query;
  }

  public function editBooking_via($kd_booking){
  $sql = "SELECT * FROM tb_booking_via where kd_booking='$kd_booking'";
  $query = $this->db->query($sql);
  return $query;
  }

  public function editDp_via($kd_bank){
  $sql = "SELECT * FROM tb_bank where kd_bank='$kd_bank'";
  $query = $this->db->query($sql);
  return $query;
  }
//Proses Edit (Akhir)

//Proses Show (Awal)
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

  public function showowner(){
  $sql = "SELECT * from tb_owner
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_owner.kd_apt
    INNER JOIN tb_bank ON tb_bank.kd_bank = tb_owner.kd_bank";
  $query = $this->db->query($sql);
  return $query;
  }

  public function showDp_via(){
  $sql = "SELECT * FROM tb_bank";
  $query = $this->db->query($sql);
  return $query;
  }
//Proses Show (Akhir)
}
?>
