<?php
class Proses{
  public function __construct(){
    $this->db = new PDO('mysql:host=localhost;dbname=db_keuangan_cozzal','root','');
  }

//Proses Add (Awal)
  public function addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung){
	$sql = "INSERT INTO tb_penyewa (nama, alamat, no_tlp, jenis_kelamin, email, tgl_gabung) VALUES('$nama', '$alamat', '$no_tlp', '$jenis_kelamin', '$email', '$tgl_gabung')";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }

  public function addDetail_Unit($kd_unit, $lantai, $jml_kmr, $jml_bed, $jml_ac, $water_heater, $dapur, $wifi, $tv, $amenities, $merokok){
  $sql = "INSERT INTO tb_detail_unit (kd_unit, lantai, jml_kmr, jml_bed, jml_ac, water_heater, dapur, wifi, tv, amenities, merokok) 
  VALUES('$kd_unit', '$lantai', '$jml_kmr', '$jml_bed', '$jml_ac', '$water_heater', '$dapur', '$wifi', '$tv', '$amenities', '$merokok')";
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

  public function addUnit($kd_apt,$kd_owner, $no_unit, $h_sewa_wd, $h_sewa_we, $h_owner_wd, $h_owner_we, $ekstra_charge){
  $sql = "INSERT INTO tb_unit (kd_apt, kd_owner, no_unit, h_sewa_wd, h_sewa_we, h_owner_wd, h_owner_we, ekstra_charge) VALUES('$kd_apt', '$kd_owner', '$no_unit', '$h_sewa_wd', '$h_sewa_we', '$h_owner_wd', '$h_owner_we', '$ekstra_charge')";
  $query = $this->db->query($sql);
  if(!$query){
    return "Failed";
  }else{
    return "Success";
  }
  }

  public function addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $ekstra_charge, $kd_booking, $kd_bank, $dp, $total, $sisa_pelunasan, $hari, $tgl_transaksi, $diskon){
	$sql = "INSERT INTO tb_transaksi (kd_penyewa, kd_apt, kd_unit, tamu, check_in, check_out, harga_sewa, ekstra_charge, kd_booking, kd_bank, dp, total_tagihan, sisa_pelunasan, hari, tgl_transaksi, diskon) VALUES('$kd_penyewa', '$kd_apt', '$kd_unit', '$tamu', '$check_in', '$check_out', '$harga_sewa', '$ekstra_charge', '$kd_booking', '$kd_bank', '$dp', '$total', '$sisa_pelunasan', '$hari', '$tgl_transaksi', '$diskon')";
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
	$sql = "INSERT INTO tb_owner (nama,alamat, no_tlp, kd_bank, no_rek, tgl_gabung, email, jenis_kelamin, jumlah_unit)
	VALUES('$nama', '$alamat', '$no_tlp', '$kd_bank', '$no_rek', '$tgl_gabung', '$email', '$jenis_kelamin', 0)";
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

  public function editUnit($kd_unit){
	$sql = "SELECT * from tb_unit
	INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
	INNER JOIN tb_owner ON tb_owner.kd_owner = tb_unit.kd_owner
	where kd_unit='$kd_unit'";
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

  public function showUnitbyId($kd_unit){
  $sql = "SELECT * from tb_unit where kd_unit='$kd_unit'";
  $query = $this->db->query($sql);
  return $query; 
  }

  public function showDetailUnit($kd_unit){
  $sql = "SELECT * FROM tb_detail_unit where kd_unit='$kd_unit'";
  $query = $this->db->query($sql);
  return $query;
  }

  public function showPenyewaTransaksi(){
	$sql = "SELECT * FROM tb_penyewa WHERE kd_penyewa IN (SELECT MAX(kd_penyewa) FROM tb_penyewa)";
	$query = $this->db->query($sql);
	return $query;
  }

  public function showTransaksiUnit($kd_unit){
    $sql = "SELECT * from tb_transaksi where kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showTransaksi_cek($CI,$CO,$kd_unit){
  $sql = "SELECT * from tb_transaksi where ((check_in<='$CI' and check_out>='$CO')
  or (check_in>='$CI' and check_in<='$CO')
  or (check_out>='$CI' and check_out<='$CO'))
  and (kd_unit ='$kd_unit')" ;
  $query = $this->db->query($sql);
  return $query;
  }

  public function showApartemen(){
	$sql = "SELECT * FROM tb_apt";
	$query = $this->db->query($sql);
	return $query;
  }

  public function showUnit(){
	$sql = "SELECT * FROM tb_unit
	INNER JOIN tb_apt ON tb_apt.kd_apt = tb_unit.kd_apt
	INNER JOIN tb_owner ON tb_owner.kd_owner = tb_unit.kd_owner";
	$query = $this->db->query($sql);
	return $query;
  }

  public function showUnitByApt($kd_apt){
    $sql = "SELECT * from tb_unit where kd_apt='$kd_apt'";
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

  public function showRequestBook(){
    $sql = "SELECT * FROM tb_reservasi
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_reservasi.kd_apt
    INNER JOIN tb_unit ON tb_unit.kd_unit = tb_reservasi.kd_unit";
    $query = $this->db->query($sql);
    return $query;
  }
//Proses Show (Akhir)

//Proses Update (Awal)
  public function updatePenyewa($kd_penyewa, $nama, $alamat, $no_tlp, $jenis_kelamin, $email){
    $sql = "UPDATE tb_penyewa SET nama='$nama', alamat='$alamat', no_tlp='$no_tlp', jenis_kelamin='$jenis_kelamin', email='$email' WHERE kd_penyewa='$kd_penyewa'";
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

  public function updateOwner($kd_owner ,$nama, $alamat, $no_tlp, $kd_bank, $no_rek, $email, $jenis_kelamin){
	$sql = "update tb_owner SET nama='$nama', alamat='$alamat', no_tlp='$no_tlp', kd_bank='$kd_bank', no_rek='$no_rek',
	email='$email', jenis_kelamin='$jenis_kelamin' WHERE kd_owner='$kd_owner'";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }

  public function updateUnit($kd_unit ,$kd_apt,$kd_owner, $no_unit, $h_owner_wd, $h_owner_we, $h_sewa_wd, $h_sewa_we, $ekstra_charge){
 	$sql = "update tb_unit SET kd_apt='$kd_apt', kd_owner='$kd_owner', no_unit='$no_unit', h_owner_wd='$h_owner_wd', h_owner_we='$h_owner_we',
	h_sewa_wd='$h_sewa_wd', h_sewa_we='$h_sewa_we', ekstra_charge='$ekstra_charge' where kd_unit='$kd_unit'";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }

  public function updateDetail_Unit($kd_unit, $lantai, $jml_kmr, $jml_bed, $jml_ac, $water_heater, $dapur, $wifi, $tv, $amenities, $merokok){
  $sql = "update tb_detail_unit SET lantai='$lantai', jml_kmr='$jml_kmr', jml_bed='$jml_bed', jml_ac='$jml_ac', water_heater='$water_heater',
  dapur='$dapur', wifi='$wifi', tv='$tv', amenities='$amenities', merokok='$merokok' where kd_unit='$kd_unit'";
  $query = $this->db->query($sql);
  if(!$query){
    return "Failed";
  }else{
    return "Success";
  }
  }

  public function updateJumlah_unit_owner($kd_owner){
	$sql = "update tb_owner SET jumlah_unit=jumlah_unit+1 where kd_owner='$kd_owner'";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }

  public function updateKurangi_jumlah_unit_owner($kd_owner){
	$sql = "update tb_owner SET jumlah_unit=jumlah_unit-1 where kd_owner='$kd_owner'";
	$query = $this->db->query($sql);
	if(!$query){
	  return "Failed";
	}else{
	  return "Success";
	}
  }

  public function updateTransaksi($kd_transaksi, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $diskon, $ekstra_charge, $kd_booking, $kd_bank, $dp, $total_tagihan, $sisa_pelunasan, $hari){
  $sql = "update tb_transaksi SET kd_apt ='$kd_apt', kd_unit='$kd_unit', tamu='$tamu', check_in='$check_in', check_out='$check_out',
  harga_sewa ='$harga_sewa', diskon ='$diskon', ekstra_charge='$ekstra_charge', kd_booking='$kd_booking', kd_bank='$kd_bank', dp='$dp', 
  total_tagihan='$total_tagihan', sisa_pelunasan='$sisa_pelunasan', hari ='$hari' where kd_transaksi='$kd_transaksi'";
  $query = $this->db->query($sql);
  if(!$query){
    return "Failed";
  }else{
    return "Success";
  } 
  }

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

  public function deleteTransaksi($kd_transaksi){
	$sql = "DELETE FROM tb_transaksi WHERE kd_transaksi='$kd_transaksi'";
	$query = $this->db->query($sql);
  }

//Proses Delete (Akhir)
}
?>
