<?php
class Search{
  private $db;

  public function __construct($database){
    $this->db = $database;
  }

  public function transaksi($keyword, $status){
    $sql = "SELECT
      tb_transaksi.kd_transaksi, tb_transaksi.kd_unit, tb_transaksi.check_in, tb_transaksi.check_out, tb_transaksi.dp, tb_transaksi.setlement_dp, tb_transaksi.status,
      tb_penyewa.kd_penyewa, tb_penyewa.nama,
      tb_apt.kd_apt, tb_apt.nama_apt,
      tb_unit.kd_unit, tb_unit.no_unit
        from tb_transaksi
        INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_transaksi.kd_penyewa
        INNER JOIN tb_apt ON tb_apt.kd_apt = tb_transaksi.kd_apt
        INNER JOIN tb_unit ON tb_unit.kd_unit = tb_transaksi.kd_unit WHERE 
        tb_transaksi.status = '$status'
        AND (tb_unit.no_unit LIKE '%$keyword%' 
        OR tb_penyewa.nama LIKE '%$keyword%'
        OR tb_transaksi.check_in LIKE '%$keyword%' 
        OR tb_transaksi.check_out LIKE '%$keyword%'
        OR tb_apt.nama_apt LIKE '%$keyword%')";
    $query = $this->db->query($sql);
    return $query; 
  }

}

?>
