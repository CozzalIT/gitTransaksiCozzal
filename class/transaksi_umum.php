<?php
class TransaksiUmum {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  public function showTransaksiUmum(){
    $sql = "SELECT * FROM tb_transaksi_umum";
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

}
?>
