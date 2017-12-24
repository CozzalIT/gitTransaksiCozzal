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

  public function addOwner($nama, $alamat, $no_tlp, $kd_bank, $no_rek, $tgl_gabung, $email, $jenis_kelamin){
	$sql = "INSERT INTO tb_owner (nama,alamat, no_tlp, kd_bank, no_rek, tgl_gabung, email, jenis_kelamin)
	VALUES('$nama', '$alamat', '$no_tlp', '$kd_bank', '$no_rek', '$tgl_gabung', '$email', '$jenis_kelamin')";
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
  
  public function editOwner($kd_owner){
	$sql = "SELECT * from tb_owner 
	INNER JOIN tb_bank ON tb_bank.kd_bank = tb_owner.kd_bank where kd_owner='$kd_owner'";
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

  public function showOwner(){
  $sql = "SELECT * from tb_owner
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

//Proses Update (Awal)
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

  public function updateApartemen($kd_apt, $nama_apt, $alamat_apt){
    $sql = "UPDATE tb_apt SET nama_apt='$nama_apt', alamat_apt='$alamat_apt' WHERE kd_apt='$kd_apt'";
    $query = $this->db->query($sql);
  if(!$query){
    return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateBank($kd_bank, $nama_bank){
    $sql = "UPDATE tb_bank SET nama_bank='$nama_bank', kd_bank='$kd_bank' WHERE kd_bank='$kd_bank'";
    $query = $this->db->query($sql);
  if(!$query){
    return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateBooking($kd_booking, $booking_via){
    $sql = "UPDATE tb_booking_via SET kd_booking='$kd_booking', booking_via='$booking_via' WHERE kd_booking='$kd_booking'";
    $query = $this->db->query($sql);
  if(!$query){
    return "Failed";
    }else{
      return "Success";
    }
  }
  
//  public function updateOwner($kd_owner ,$nama, $alamat, $no_tlp, $kd_bank, $no_rek, $tgl_gabung, $email, $jenis_kelamin)
  
//Proses Update (Akhir)

//Proses Delete (Awal)
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
  
  public function deleteOwner($kd_owner){
	$sql = "DELETE FROM tb_owner WHERE kd_owner='$kd_owner'";
	$query = $this->db->query($sql);
  }

//Proses Delete (Akhir)
}
?>
