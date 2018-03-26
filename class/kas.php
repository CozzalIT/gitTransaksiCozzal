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

  public function showMutasiByTanggal($tanggal){
    $sql = "SELECT * FROM tb_mutasi_kas WHERE tanggal='$tanggal'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showMutasiKas(){
    $sql = "SELECT
      tb_mutasi_kas.kd_mutasi_kas, tb_mutasi_kas.kd_kas, tb_mutasi_kas.mutasi_dana, tb_mutasi_kas.jenis, tb_mutasi_kas.tanggal, tb_mutasi_kas.keterangan,
      tb_kas.kd_kas, tb_kas.sumber_dana
      FROM tb_mutasi_kas
      INNER JOIN tb_kas ON tb_mutasi_kas.kd_kas = tb_kas.kd_kas ORDER BY tb_mutasi_kas.tanggal DESC";
    $query = $this->db->query($sql);
    return $query;
  }

  //Edit
  public function editSaldo($kd_kas){
    $sql = "SELECT saldo FROM tb_kas WHERE kd_kas='$kd_kas'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showKeterangan($kd_mutasi_kas){
    $sql = "SELECT keterangan FROM tb_mutasi_kas WHERE kd_mutasi_kas='$kd_mutasi_kas'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showMutasiDana($keterangan){
    $sql = "SELECT mutasi_dana, kd_mutasi_kas, tanggal FROM tb_mutasi_kas WHERE keterangan='$keterangan'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showNoUnit($kd_unit){
    $sql = "SELECT no_unit FROM tb_unit WHERE kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showKdKas($keterangan){
    $sql = "SELECT kd_kas, mutasi_dana FROM tb_mutasi_kas WHERE keterangan='$keterangan'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Update
  public function updateKas($kd_kas, $saldo, $tanggal){
    $sql = "UPDATE tb_kas SET saldo='$saldo', tanggal='$tanggal' WHERE kd_kas='$kd_kas'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateKeteranganMutasi($kd_mutasi_kas, $keterangan_baru){
    $sql = "UPDATE tb_mutasi_kas SET keterangan='$keterangan_baru' WHERE kd_mutasi_kas='$kd_mutasi_kas'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateMutasi($kd_mutasi_kas, $keterangan_baru, $tanggal){
    $sql = "UPDATE tb_mutasi_kas SET keterangan='$keterangan_baru', tanggal='$tanggal' WHERE kd_mutasi_kas='$kd_mutasi_kas'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Delete
  public function deleteMutasi($keterangan){
    $sql = "DELETE FROM tb_mutasi_kas WHERE keterangan='$keterangan'";
    $query = $this->db->query($sql);
  }

}
?>
