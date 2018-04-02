<?php
class Transaksi {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
  public function addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $check_in, $check_out, $hari_weekend, $hari_weekday, $hari, $harga_sewa, $harga_sewa_weekend, $tgl_transaksi, $diskon, $ekstra_charge, $kd_kas, $tamu, $kd_booking, $dp, $total_tagihan, $total_harga_owner, $sisa_pelunasan, $status){
    $sql = "INSERT INTO tb_transaksi (kd_penyewa, kd_apt, kd_unit, check_in, check_out, hari_weekend, hari_weekday, hari, harga_sewa, harga_sewa_weekend, tgl_transaksi, diskon, ekstra_charge, kd_kas, tamu, kd_booking, dp, total_tagihan, total_harga_owner, sisa_pelunasan, status)
    VALUES ('$kd_penyewa', '$kd_apt', '$kd_unit', '$check_in', '$check_out',
      '$hari_weekend', '$hari_weekday', '$hari', '$harga_sewa', '$harga_sewa_weekend', '$tgl_transaksi', '$diskon', '$ekstra_charge', '$kd_kas', '$tamu', '$kd_booking', '$dp', '$total_tagihan', '$total_harga_owner, '$sisa_pelunasan', '$status')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function addUnit_kotor($kd_unit, $check_in, $check_out){
    $sql = "INSERT INTO tb_unit_kotor(kd_unit, check_in, check_out) VALUES ('$kd_unit','$check_in','$check_out')";
    $query = $this->db->query($sql);
  }

  public function addConfirm($kd_transaksi){
    $sql = "UPDATE tb_transaksi SET status='42' WHERE kd_transaksi='$kd_transaksi'";
    $query = $this->db->query($sql);

    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function addCancel($kd_transaksi){
    $sql = "UPDATE tb_transaksi SET status='2' WHERE kd_transaksi='$kd_transaksi'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function setlementDp($kd_transaksi, $setlement, $status){
    $sql = "UPDATE tb_transaksi SET setlement_dp='$setlement', status='$status' WHERE kd_transaksi='$kd_transaksi'";
    $query = $this->db->query($sql);
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
      tb_transaksi.kd_transaksi, tb_transaksi.kd_penyewa, tb_transaksi.kd_apt, tb_transaksi.kd_unit, tb_transaksi.tamu, tb_transaksi.check_in, tb_transaksi.check_out, tb_transaksi.harga_sewa, tb_transaksi.harga_sewa_weekend, tb_transaksi.ekstra_charge, tb_transaksi.kd_booking, tb_transaksi.kd_kas, tb_transaksi.dp, tb_transaksi.total_tagihan, tb_transaksi.total_harga_owner, tb_transaksi.sisa_pelunasan, tb_transaksi.hari, tb_transaksi.tgl_transaksi, tb_transaksi.diskon, tb_transaksi.status, tb_transaksi.setlement_dp,
      tb_penyewa.kd_penyewa, tb_penyewa.nama,
      tb_apt.kd_apt, tb_apt.nama_apt,
      tb_kas.kd_kas, tb_kas.sumber_dana,
      tb_unit.kd_unit, tb_unit.no_unit
        from tb_transaksi
        INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_transaksi.kd_penyewa
        INNER JOIN tb_apt ON tb_apt.kd_apt = tb_transaksi.kd_apt
        INNER JOIN tb_kas ON tb_kas.kd_kas = tb_transaksi.kd_kas
        INNER JOIN tb_unit ON tb_unit.kd_unit = tb_transaksi.kd_unit ORDER BY tb_transaksi.kd_transaksi DESC";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showTransaksiByUnit($kd_unit){
    $sql = "SELECT
      tb_transaksi.kd_transaksi, tb_transaksi.kd_apt, tb_transaksi.kd_unit, tb_transaksi.check_in, tb_transaksi.check_out, tb_transaksi.harga_sewa, tb_transaksi.harga_sewa_weekend, tb_transaksi.tgl_transaksi, tb_transaksi.status,
      tb_transaksi.hari_weekend, tb_transaksi.hari_weekday, tb_transaksi.total_harga_owner,
      tb_apt.kd_apt, tb_apt.nama_apt,
      tb_unit.kd_unit, tb_unit.no_unit
        from tb_transaksi
        INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_transaksi.kd_penyewa
        INNER JOIN tb_apt ON tb_apt.kd_apt = tb_transaksi.kd_apt
        INNER JOIN tb_kas ON tb_kas.kd_kas = tb_transaksi.kd_kas
        INNER JOIN tb_unit ON tb_unit.kd_unit = tb_transaksi.kd_unit
        WHERE tb_transaksi.kd_unit = '$kd_unit'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showTransaksiByUnit1($kd_unit){
    $sql = "SELECT DISTINCT(tgl_transaksi) from tb_transaksi";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showPenyewaTransaksi(){
    $sql = "SELECT * FROM tb_penyewa WHERE kd_penyewa IN (SELECT MAX(kd_penyewa) FROM tb_penyewa)";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showMaxTransaksi(){
    $sql = "SELECT kd_transaksi FROM tb_transaksi WHERE kd_transaksi IN (SELECT MAX(kd_transaksi) FROM tb_transaksi)";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showTransaksi_cek($CI,$CO,$kd_unit){
   $result = $this->db->prepare("SELECT * from tb_unit_kotor where ((check_in<='$CI' and check_out>='$CO')
    or (check_in>='$CI' and check_in<'$CO')
    or (check_out>'$CI' and check_out<='$CO'))
    and (kd_unit ='$kd_unit')");
    $result->execute();
    $rows = $result->fetch();
    return $rows;
  }

  public function is_blocked($CI,$CO,$kd_unit,$jenis){
    $result = $this->db->prepare("SELECT kd_mod_calendar from tb_mod_calendar
    where ((start_date<='$CI' and end_date>='$CO')
    or (start_date>='$CI' and start_date<'$CO')
    or (end_date>'$CI' and end_date<='$CO'))
    and (kd_unit ='$kd_unit' and jenis='$jenis')");
    $result->execute();
    $rows = $result->fetch();
    return $rows;
  }

  public function showDpTransaksi($kd_transaksi){
    $sql = "SELECT dp from tb_transaksi WHERE kd_transaksi='$kd_transaksi'";
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
      tb_transaksi.kd_transaksi, tb_transaksi.kd_penyewa, tb_transaksi.kd_apt, tb_transaksi.kd_unit, tb_transaksi.tamu, tb_transaksi.check_in, tb_transaksi.check_out, tb_transaksi.harga_sewa, tb_transaksi.harga_sewa_weekend, tb_transaksi.ekstra_charge, tb_transaksi.kd_booking, tb_transaksi.kd_kas, tb_transaksi.dp, tb_transaksi.total_tagihan, tb_transaksi.total_harga_owner, tb_transaksi.sisa_pelunasan, tb_transaksi.pembayaran, tb_transaksi.tgl_transaksi, tb_transaksi.diskon,
      tb_transaksi.hari, tb_transaksi.hari_weekday, tb_transaksi.hari_weekend,
      tb_penyewa.kd_penyewa, tb_penyewa.nama, tb_penyewa.alamat, tb_penyewa.no_tlp, tb_penyewa.email, tb_penyewa.jenis_kelamin,
      tb_apt.kd_apt, tb_apt.nama_apt,
      tb_kas.kd_kas, tb_kas.sumber_dana,
      tb_unit.kd_unit, tb_unit.no_unit,
      tb_booking_via.kd_booking, tb_booking_via.booking_via
        from tb_transaksi
        INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_transaksi.kd_penyewa
        INNER JOIN tb_apt ON tb_apt.kd_apt = tb_transaksi.kd_apt
        INNER JOIN tb_kas ON tb_kas.kd_kas = tb_transaksi.kd_kas
        INNER JOIN tb_booking_via ON tb_booking_via.kd_booking = tb_transaksi.kd_booking
        INNER JOIN tb_unit ON tb_unit.kd_unit = tb_transaksi.kd_unit WHERE kd_transaksi='$kd_transaksi'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Update
  public function updateTransaksi($kd_transaksi, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $harga_sewa_we, $diskon, $ekstra_charge, $kd_booking, $kd_kas, $dp, $total_tagihan, $total_harga_owner, $sisa_pelunasan, $hari, $jumlah_weekend, $jumlah_weekday){
    $sql = "UPDATE tb_transaksi SET kd_apt ='$kd_apt', kd_unit='$kd_unit', tamu='$tamu', check_in='$check_in', check_out='$check_out',
    harga_sewa ='$harga_sewa', harga_sewa_weekend='$harga_sewa_we', diskon ='$diskon', ekstra_charge='$ekstra_charge', kd_booking='$kd_booking', kd_kas='$kd_kas', dp='$dp',
    total_tagihan='$total_tagihan', total_harga_owner='$total_harga_owner', sisa_pelunasan='$sisa_pelunasan', hari ='$hari', hari_weekend='$jumlah_weekend', hari_weekday='$jumlah_weekday' where kd_transaksi='$kd_transaksi'";
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

  public function updateStatusTransaksi($kd_transaksi, $status){
    $sql = "UPDATE tb_transaksi SET status='$status' WHERE kd_transaksi='$kd_transaksi'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateUnit_kotor($kd_transaksi ,$kd_unit, $check_in, $check_out){
    $locsql = "SELECT kd_unit, check_in, check_out from tb_transaksi where kd_transaksi='$kd_transaksi'";
    $locq = $this->db->query($locsql);
    $trx = $locq->fetch();
    $sql = "UPDATE tb_unit_kotor SET kd_unit='$kd_unit', check_in='$check_in', check_out='$check_out'
    WHERE kd_unit='".$trx["kd_unit"]."' and check_in='".$trx["check_in"]."' and check_out='".$trx["check_out"]."'";
    $query = $this->db->query($sql);
    return $trx["kd_unit"];
  }

  //Proses Delete
  public function deleteTransaksi($kd_transaksi){
    $sql = "DELETE FROM tb_transaksi WHERE kd_transaksi='$kd_transaksi'";
    $query = $this->db->query($sql);
  }

  public function deleteUnit_kotor($kd_transaksi){
    $locsql = "SELECT kd_unit, check_in, check_out from tb_transaksi where kd_transaksi='$kd_transaksi'";
    $locq = $this->db->query($locsql);
    $trx = $locq->fetch();
    $sql = "DELETE FROM tb_unit_kotor WHERE kd_unit='".$trx["kd_unit"]."' and check_in='".$trx["check_in"]."' and check_out='".$trx["check_out"]."'";
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

//nitip delete reservasi
  public function deleteReservasi($kd_reservasi){
    $sql = "DELETE FROM tb_reservasi where kd_reservasi='$kd_reservasi'";
    $query = $this->db->query($sql);
  }

}
?>
