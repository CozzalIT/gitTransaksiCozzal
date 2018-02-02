<?php
class Proses{
  public function __construct(){
    $this->db = new PDO('mysql:host=localhost;dbname=db_keuangan_cozzal','root','');
  }
}
?>
