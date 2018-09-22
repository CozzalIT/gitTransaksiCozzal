<?php
class Task {
  private $db;

  public function __construct($database){
    $this->db = $database;
  }

  public function showTask_sekali($sekarang){
    $sql = "SELECT * FROM tb_task WHERE sifat='Sekali' AND tgl_task<='$sekarang'
    AND tgl_task is not null";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showTask_semua(){
    $sql = "SELECT * FROM tb_task";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showUnit_kotor($sekarang){
    $sql = "SELECT DISTINCT kd_unit FROM tb_unit_kotor WHERE check_out<='$sekarang'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function addTask($task, $unit, $sifat, $tgl_task){
    $sql = "INSERT INTO tb_task VALUES(null,'$task', '$unit', '$sifat', $tgl_task)";
    $sql2 = "SELECT DISTINCT kd_unit FROM tb_task_unit";
    $query = $this->db->query($sql);
    $query2 = $this->db->query($sql2);
    return $query2;
  }  

  public function addTask_unit_sekali($kd_task,$where){
    $sql = "INSERT INTO tb_task_unit (kd_unit,kd_task)
    SELECT kd_unit, $kd_task AS kd_task FROM tb_unit WHERE $where";
    $this->db->query($sql);
  }

  public function updateTask($kd_task ,$task, $unit, $sifat, $tgl_task){
    $sql = "UPDATE tb_task SET task='$task', unit ='$unit', sifat='$sifat', tgl_task=$tgl_task WHERE kd_task='$kd_task'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function deleteTask($kd_task){
    $sql = "DELETE FROM tb_task where kd_task='$kd_task'";
    $sql2= "DELETE FROM tb_task_unit WHERE kd_task='$kd_task'";
    $query = $this->db->query($sql2);
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }  

  public function deleteTask_unit($kd_unit, $kd_task){
    $sql = "UPDATE tb_task_unit SET status='D' where kd_unit='$kd_unit' AND kd_task='$kd_task'";
    $query = $this->db->query($sql);
  }     

  public function deleteTask_sekali($sekarang){
    $sql = "UPDATE tb_task SET tgl_task=null WHERE sifat='Sekali' AND tgl_task<='$sekarang'";
    $this->db->query($sql);
     $sql = "DELETE FROM tb_task_unit WHERE status='D' and kd_task IN (SELECT kd_task FROM tb_task where sifat='Sekali')";
    $this->db->query($sql);   
    $sql = "DELETE FROM tb_task WHERE tgl_task is null and kd_task not in (SELECT kd_task FROM tb_task_unit) AND sifat='Sekali'";
    $this->db->query($sql);
  }

  public function editTask($kd_task){
    $sql = "SELECT * from tb_task WHERE kd_task='$kd_task'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showTask_byunit($kd_unit){
    $sql = "SELECT * from tb_task_unit INNER JOIN tb_task ON tb_task_unit.kd_task=tb_task.kd_task
    WHERE tb_task_unit.kd_unit = '$kd_unit' AND tb_task_unit.status is null";
    $query = $this->db->query($sql);
    return $query;
  } 

  public function getCOdate($kd_unit, $sekarang){
    $sql = "SELECT check_out FROM tb_unit_kotor WHERE check_out 
    IN (SELECT MAX(check_out) FROM tb_unit_kotor Where kd_unit='$kd_unit' AND check_out<='$sekarang')";
    $query = $this->db->query($sql);
    return $query;
  }       
 
  public function isTask_updated($kd_unit, $CO) {
   $result = $this->db->prepare("SELECT kd_unit FROM tb_unit WHERE kd_unit = ? AND tgl_task >= ?");
      $result->bindParam(1, $kd_unit);
      $result->bindParam(2, $CO);
      $result->execute();
      $rows = $result->fetch();
      return $rows;
  }  

  public function updateTask_Unit($kd_unit, $CO) { 
    $WHERE = $this->whereKondition($kd_unit);
    $sql1 = "INSERT INTO tb_task_unit(kd_unit, kd_task) 
    SELECT '$kd_unit' As kd, kd_task FROM tb_task $WHERE";
    $sql2 = "UPDATE tb_unit SET tgl_task='$CO' where kd_unit='$kd_unit'";
    $query = $this->db->query($sql1);
    //$query = $this->db->query($sql2);
    return $sql1;
  }    

  public function updateTask_Unit2($kd_unit){//menambahkan task yg baru di buat ke task_unit
    $sql1 = "INSERT INTO tb_task_unit(kd_unit, kd_task) 
    SELECT '$kd_unit' As kd, MAX(kd_task) FROM tb_task $this->whereKondition($kd_unit)";
    $query = $this->db->query($sql1);
  }  

  private function whereKondition($kd_unit){
    $sql = "WHERE ((unit LIKE '%&$kd_unit%') OR ";
    $sql .= "(unit='Semua') OR ";
    $sql .= "(unit like '!%' AND unit not like '%!$kd_unit%')) AND sifat='Rutin' AND ";
    $sql .= "kd_task not in (SELECT kd_task FROM tb_task_unit WHERE kd_unit='$kd_unit')";
    return $sql;
  }

}
?>