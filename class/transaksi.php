<?php
class Transaksi {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
  public function addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $ekstra_charge, $kd_booking, $kd_bank, $dp, $total, $sisa_pelunasan, $hari, $tgl_transaksi, $diskon){
    $sql = "INSERT INTO tb_transaksi (kd_penyewa, kd_apt, kd_unit, tamu, check_in, check_out, harga_sewa, ekstra_charge, kd_booking, kd_bank, dp, total_tagihan, sisa_pelunasan, hari, tgl_transaksi, diskon) VALUES('$kd_penyewa', '$kd_apt', '$kd_unit', '$tamu', '$check_in', '$check_out', '$harga_sewa', '$ekstra_charge', '$kd_booking', '$kd_bank', '$dp', '$total', '$sisa_pelunasan', '$hari', '$tgl_transaksi', '$diskon')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function addConfirm($kd_transaksi){
    $sql = "INSERT INTO tb_confirm_transaksi (kd_penyewa, kd_apt, kd_unit, tamu, check_in, check_out, harga_sewa, ekstra_charge, kd_booking, kd_bank, dp, total_tagihan, sisa_pelunasan, hari, tgl_transaksi, diskon)
    SELECT kd_penyewa, kd_apt, kd_unit, tamu, check_in, check_out, harga_sewa, ekstra_charge, kd_booking, kd_bank, dp, total_tagihan, sisa_pelunasan, hari, tgl_transaksi, diskon
    FROM tb_transaksi WHERE kd_transaksi='$kd_transaksi'";
    $sql_delete = "DELETE FROM tb_transaksi WHERE kd_transaksi='$kd_transaksi'";

    $query = $this->db->query($sql);
    $query1 = $this->db->query($sql_delete);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function addPembayaran($kd_transaksi, $pembayaran_baru, $sisa_pelunasan){
    $sql = "UPDATE tb_transaksi SET pembayaran ='$pembayaran_baru', sisa_pelunasan='$sisa_pelunasan' WHERE kd_transaksi='$kd_transaksi'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Show
  public function showTransaksi(){
    $sql = "SELECT
      tb_transaksi.kd_transaksi, tb_transaksi.kd_penyewa, tb_transaksi.kd_apt, tb_transaksi.kd_unit, tb_transaksi.tamu, tb_transaksi.check_in, tb_transaksi.check_out, tb_transaksi.harga_sewa, tb_transaksi.ekstra_charge, tb_transaksi.kd_booking, tb_transaksi.kd_bank, tb_transaksi.dp, tb_transaksi.total_tagihan, tb_transaksi.sisa_pelunasan, hari, tb_transaksi.tgl_transaksi, tb_transaksi.diskon,
      tb_penyewa.kd_penyewa, tb_penyewa.nama,
      tb_apt.kd_apt, tb_apt.nama_apt,
      tb_bank.kd_bank, tb_bank.nama_bank,
      tb_unit.kd_unit, tb_unit.no_unit
        from tb_transaksi
        INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_transaksi.kd_penyewa
        INNER JOIN tb_apt ON tb_apt.kd_apt = tb_transaksi.kd_apt
        INNER JOIN tb_bank ON tb_bank.kd_bank = tb_transaksi.kd_bank
        INNER JOIN tb_unit ON tb_unit.kd_unit = tb_transaksi.kd_unit";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showPenyewaTransaksi(){
    $sql = "SELECT * FROM tb_penyewa WHERE kd_penyewa IN (SELECT MAX(kd_penyewa) FROM tb_penyewa)";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showCalendar($kd_unit){
    $sql_laporan = "SELECT * from tb_transaksi where kd_unit='$kd_unit'";
    $sql_confirm = "SELECT * from tb_confirm_transaksi where kd_unit='$kd_unit'";
    $query = $this->db->query($sql_laporan);
    $query1 = $this->db->query($sql_confirm);
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

  public function showConfirmTransaksi(){
    $sql = "SELECT * from tb_confirm_transaksi
    INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_confirm_transaksi.kd_penyewa
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_confirm_transaksi.kd_apt
    INNER JOIN tb_unit ON tb_unit.kd_unit = tb_confirm_transaksi.kd_unit";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showConfirmById($kd_confirm_transaksi){
    $sql = "SELECT * from tb_confirm_transaksi
    INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_confirm_transaksi.kd_penyewa
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_confirm_transaksi.kd_apt
    INNER JOIN tb_unit ON tb_unit.kd_unit = tb_confirm_transaksi.kd_unit
    INNER JOIN tb_bank ON tb_bank.kd_bank = tb_confirm_transaksi.kd_bank
    WHERE kd_confirm_transaksi='$kd_confirm_transaksi'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Edit
  public function editApartemen($kd_apart){
    $sql = "SELECT * FROM tb_apt WHERE kd_apt='$kd_apart'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function editTransaksi($kd_transaksi){
    $sql = "SELECT
      tb_transaksi.kd_transaksi, tb_transaksi.kd_penyewa, tb_transaksi.kd_apt, tb_transaksi.kd_unit, tb_transaksi.tamu, tb_transaksi.check_in, tb_transaksi.check_out, tb_transaksi.harga_sewa, tb_transaksi.ekstra_charge, tb_transaksi.kd_booking, tb_transaksi.kd_bank, tb_transaksi.dp, tb_transaksi.total_tagihan, tb_transaksi.sisa_pelunasan, tb_transaksi.pembayaran, tb_transaksi.tgl_transaksi, tb_transaksi.diskon,
      tb_penyewa.kd_penyewa, tb_penyewa.nama, tb_penyewa.alamat, tb_penyewa.no_tlp, tb_penyewa.email, tb_penyewa.jenis_kelamin,
      tb_apt.kd_apt, tb_apt.nama_apt,
      tb_bank.kd_bank, tb_bank.nama_bank,
      tb_unit.kd_unit, tb_unit.no_unit,
      tb_booking_via.kd_booking, tb_booking_via.booking_via
        from tb_transaksi
        INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_transaksi.kd_penyewa
        INNER JOIN tb_apt ON tb_apt.kd_apt = tb_transaksi.kd_apt
        INNER JOIN tb_bank ON tb_bank.kd_bank = tb_transaksi.kd_bank
        INNER JOIN tb_booking_via ON tb_booking_via.kd_booking = tb_transaksi.kd_booking
        INNER JOIN tb_unit ON tb_unit.kd_unit = tb_transaksi.kd_unit WHERE kd_transaksi='$kd_transaksi'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Update
  public function updateTransaksi($kd_transaksi, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $diskon, $ekstra_charge, $kd_booking, $kd_bank, $dp, $total_tagihan, $sisa_pelunasan, $hari){
    $sql = "UPDATE tb_transaksi SET kd_apt ='$kd_apt', kd_unit='$kd_unit', tamu='$tamu', check_in='$check_in', check_out='$check_out',
    harga_sewa ='$harga_sewa', diskon ='$diskon', ekstra_charge='$ekstra_charge', kd_booking='$kd_booking', kd_bank='$kd_bank', dp='$dp',
    total_tagihan='$total_tagihan', sisa_pelunasan='$sisa_pelunasan', hari ='$hari' where kd_transaksi='$kd_transaksi'";
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

  //Proses Delete
  public function deleteTransaksi($kd_transaksi){
    $sql = "DELETE FROM tb_transaksi WHERE kd_transaksi='$kd_transaksi'";
    $query = $this->db->query($sql);
  }

  public function deleteConfirmTransaksi($kd_confirm_transaksi){
    $sql = "DELETE FROM tb_confirm_transaksi WHERE kd_confirm_transaksi='$kd_confirm_transaksi'";
    $query = $this->db->query($sql);
  }

  //penyewa numpang lewat
 public function addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung){
    $sql = "INSERT INTO tb_penyewa (nama, alamat, no_tlp, jenis_kelamin, email, tgl_gabung) VALUES('$nama', '$alamat', '$no_tlp', '$jenis_kelamin', '$email', '$tgl_gabung')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Show
  public function showPenyewa(){
    $sql = "SELECT * FROM tb_penyewa";
    $query = $this->db->query($sql);
    return $query;
  }
}
?>
