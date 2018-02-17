<?php
class Account{
  private $db;

  public function __construct($database){
    $this->db = $database;
  }

  //Show
  public function showAccount(){
    $sql = "SELECT tb_user.username, tb_user.hak_akses FROM tb_user";
    $query = $this->db->query($sql);
    return $query;
  }
}

?>
