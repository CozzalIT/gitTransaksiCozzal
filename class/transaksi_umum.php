<?php
class TransaksiUmum {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  public function showTransaksiUmum(){
    $sql = "SELECT * FROM tb_transaksi_umum
    INNER JOIN tb_kas ON tb_kas.kd_kas = tb_transaksi_umum.kd_kas ORDER BY tb_transaksi_umum.kd_transaksi_umum DESC";
    $query = $this->db->query($sql);
    return $query;
  }

  public function editTransaksiUmum($kd_transaksi_umum){
    $sql = "SELECT * FROM tb_transaksi_umum WHERE kd_transaksi_umum='$kd_transaksi_umum'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showTransaksiUmumByTanggal($tanggal){
    $sql = "SELECT * FROM tb_transaksi_umum WHERE tanggal='$tanggal'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Add
  public function addTransaksiUmum($kd_kas, $kebutuhan, $harga, $jumlah, $keterangan, $tanggal, $status){
    $sql = "INSERT INTO tb_transaksi_umum (kd_kas, kebutuhan, harga, jumlah, keterangan, tanggal, status) VALUES('$kd_kas', '$kebutuhan', '$harga', '$jumlah', '$keterangan', '$tanggal', '$status')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function showMaxTU(){
    $sql = "SELECT kd_transaksi_umum FROM tb_transaksi_umum WHERE kd_transaksi_umum IN (SELECT MAX(kd_transaksi_umum) FROM tb_transaksi_umum)";
    $query = $this->db->query($sql);
    return $query;
  }

  //update transaksi umum
  public function updateTransaksiUmum($kd_transaksi_umum, $kd_kas, $kebutuhan, $harga_umum, $jumlah_umum, $keterangan, $tanggal){
    $sql = "UPDATE tb_transaksi_umum SET kd_kas ='$kd_kas', kebutuhan='$kebutuhan', harga='$harga_umum', jumlah='$jumlah_umum', keterangan='$keterangan' where kd_transaksi_umum='$kd_transaksi_umum'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //payment billing
  public function paymentBilling($kd_transaksi_umum, $kd_kas, $kebutuhan, $harga_umum, $jumlah_umum, $keterangan, $tanggal, $status){
    $sql = "UPDATE tb_transaksi_umum SET kd_kas ='$kd_kas', kebutuhan='$kebutuhan', harga='$harga_umum', jumlah='$jumlah_umum', keterangan='$keterangan', status='$status' where kd_transaksi_umum='$kd_transaksi_umum'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Delete
  public function deleteTransaksiUmum($kd_transaksi_umum){
    $sql = "DELETE FROM tb_transaksi_umum WHERE kd_transaksi_umum='$kd_transaksi_umum'";
    $query = $this->db->query($sql);
  }

  //show berdasarkan kebutuhan dan MY
  public function showTUByKebutMY($kebutuhan, $noBulan, $tahun){
    $sql = "SELECT harga, jumlah FROM tb_transaksi_umum WHERE kebutuhan='$kebutuhan' AND MONTH(tanggal)='$noBulan' AND YEAR(tanggal)='$tahun'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showTUByKebutuhan($kebutuhan){
    $sql = "SELECT
            tb_transaksi_umum.kebutuhan, tb_transaksi_umum.harga, tb_transaksi_umum.jumlah, tb_transaksi_umum.keterangan, tb_transaksi_umum.tanggal,
            tb_mutasi_kas.keterangan AS kode FROM tb_transaksi_umum INNER JOIN tb_mutasi_kas ON tb_mutasi_kas.tanggal = tb_transaksi_umum.tanggal WHERE tb_transaksi_umum.kebutuhan = '$kebutuhan'";
    $query = $this->db->query($sql);
    return $query;
  }

}
?>
