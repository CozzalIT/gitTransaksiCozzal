<?php
class Owner {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
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

  public function addOwnerPayment($kd_owner_payment, $kd_owner, $tgl_pembayaran, $jumlah_transaksi, $nominal){
    $sql = "INSERT INTO tb_owner_payment (kd_owner_payment, kd_owner, tgl_pembayaran, jumlah_transaksi, nominal)
    VALUES('$kd_owner_payment', '$kd_owner', '$tgl_pembayaran', '$jumlah_transaksi', '$nominal')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Show
  public function showOwner(){
    $sql = "SELECT * from tb_owner
    INNER JOIN tb_bank ON tb_bank.kd_bank = tb_owner.kd_bank";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showOwnerPayment($kd_owner){
    $sql = "SELECT * from tb_owner_payment WHERE kd_owner='$kd_owner' ORDER BY tgl_pembayaran DESC";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showBooking($kd_unit){
    $sql = "SELECT
      tb_transaksi.kd_transaksi, tb_transaksi.kd_penyewa, tb_transaksi.kd_apt, tb_transaksi.kd_unit, tb_transaksi.tamu, tb_transaksi.check_in, tb_transaksi.check_out, tb_transaksi.hari, tb_transaksi.tgl_transaksi, tb_transaksi.hari_weekday, tb_transaksi.hari_weekend, tb_transaksi.status,
      tb_penyewa.kd_penyewa, tb_penyewa.nama,
      tb_apt.kd_apt, tb_apt.nama_apt,
      tb_unit.kd_unit, tb_unit.no_unit, tb_unit.h_owner_wd, tb_unit.h_owner_we
        from tb_transaksi
        INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_transaksi.kd_penyewa
        INNER JOIN tb_apt ON tb_apt.kd_apt = tb_transaksi.kd_apt
        INNER JOIN tb_unit ON tb_unit.kd_unit = tb_transaksi.kd_unit WHERE tb_transaksi.kd_unit='$kd_unit' ORDER BY tb_transaksi.status ASC";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showProfit($kd_unit){
    $sql = "SELECT
      tb_confirm_transaksi.kd_confirm_transaksi, tb_confirm_transaksi.kd_apt, tb_confirm_transaksi.kd_unit, tb_confirm_transaksi.check_in, tb_confirm_transaksi.check_out,
      tb_apt.kd_apt, tb_apt.nama_apt,
      tb_unit.kd_unit, tb_unit.no_unit, tb_unit.h_owner_wd, tb_unit.h_owner_we
        from tb_confirm_transaksi
        INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_confirm_transaksi.kd_penyewa
        INNER JOIN tb_apt ON tb_apt.kd_apt = tb_confirm_transaksi.kd_apt
        INNER JOIN tb_bank ON tb_bank.kd_bank = tb_confirm_transaksi.kd_bank
        INNER JOIN tb_unit ON tb_unit.kd_unit = tb_confirm_transaksi.kd_unit WHERE tb_confirm_transaksi.kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Edit
  public function editOwner($kd_owner){
    $sql = "SELECT * from tb_owner
    INNER JOIN tb_bank ON tb_bank.kd_bank = tb_owner.kd_bank where kd_owner='$kd_owner'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Update
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

  //Proses Delete
  public function deleteOwner($kd_owner){
    $sql = "DELETE FROM tb_owner WHERE kd_owner='$kd_owner'";
    $query = $this->db->query($sql);
  }
}
?>
