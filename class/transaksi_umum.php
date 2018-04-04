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
  public function addTransaksiUmum($kd_kas, $kebutuhan, $harga, $jumlah, $keterangan, $tanggal){
    $sql = "INSERT INTO tb_transaksi_umum (kd_kas, kebutuhan, harga, jumlah, keterangan, tanggal) VALUES('$kd_kas', '$kebutuhan', '$harga', '$jumlah', '$keterangan', '$tanggal')";
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

}
?>
