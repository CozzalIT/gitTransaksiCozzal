<?php
class Api_transaksi {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
  public function show_unitTersedia($kd_apt, $CI, $CO){
    $sql = "SELECT * FROM tb_unit WHERE kd_apt ='$kd_apt' AND kd_unit not IN (
      SELECT kd_unit FROM tb_transaksi WHERE ((check_in<='$CI' and check_out>='$CO')
      or (check_in>='$CI' and check_in<'$CO')
      or (check_out>'$CI' and check_out<='$CO'))
      and (status!='2' and status!='3') 
    ) AND kd_unit not IN (
      SELECT kd_unit from tb_mod_calendar
      where ((start_date<='$CI' AND end_date>='$CO')
      OR (start_date>='$CI' AND start_date<'$CO')
      OR (end_date>'$CI' AND end_date<='$CO'))
    )";
    $query = $this->db->query($sql);
    return $query;
  }


}
?>
