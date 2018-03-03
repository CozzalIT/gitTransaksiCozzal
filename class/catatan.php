<?php
class Catatan{
  private $db;

  public function __construct($database){
    $this->db = $database;
  }

  public function catatanToTask($kd_unit){
    $sql = "INSERT INTO tb_catatan (kd_unit, catatan) SELECT tb_task_unit.kd_unit, tb_task.task FROM tb_task_unit 
    INNER JOIN tb_task ON tb_task_unit.kd_task = tb_task.kd_task
    WHERE tb_task_unit.kd_unit='$kd_unit'";
    $sql_delete = "DELETE FROM tb_task_unit WHERE kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    $query = $this->db->query($sql_delete);
  }

  public function showCatatanUnit($kd_unit){
    $sql = "SELECT * FROM tb_catatan WHERE kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    return $query;
  }
  
  public function addCatatan($kd_unit, $catatan){
    $sql = "INSERT INTO tb_catatan (kd_unit, catatan) VALUES('$kd_unit','$catatan')";
    $query = $this->db->query($sql);   
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function deleteCatatan($kd_catatan){
    $sql = "DELETE FROM tb_catatan WHERE kd_catatan='$kd_catatan'";
    $query = $this->db->query($sql);   
  }  

  public function showLastnote($kd_unit){
    $sql = "SELECT kd_catatan FROM tb_catatan WHERE kd_unit='$kd_unit'
    AND kd_catatan IN (SELECT MAX(kd_catatan) FROM tb_catatan)";
    $query = $this->db->query($sql);
    return $query;
  }  

}
?>
