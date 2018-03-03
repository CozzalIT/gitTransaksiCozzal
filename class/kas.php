<?php
class Kas {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
  public function addKas($sumber_dana, $saldo, $tanggal){
    $sql = "INSERT INTO tb_kas (sumber_dana, saldo, tanggal) VALUES('$sumber_dana', '$saldo', '$tanggal')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function addMutasiKas($kd_kas, $mutasi_dana, $jenis, $tanggal, $keterangan){
    $sql = "INSERT INTO tb_mutasi_kas (kd_kas, mutasi_dana, jenis, tanggal, keterangan) VALUES('$kd_kas', '$mutasi_dana', '$jenis', '$tanggal', '$keterangan')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //View
  public function showLastKas(){
    $sql = "SELECT kd_kas FROM tb_kas WHERE kd_kas IN (SELECT MAX(kd_kas) FROM tb_kas)";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showKas(){
    $sql = "SELECT * FROM tb_kas";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showMutasiKas(){
    $sql = "SELECT * FROM tb_mutasi_kas";
    $query = $this->db->query($sql);
    return $query;
  }
}
?>
