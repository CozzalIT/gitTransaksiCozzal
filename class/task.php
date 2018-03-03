<?php
class Task {
  private $db;

  public function __construct($database){
    $this->db = $database;
  }

  public function showTask_semua(){
    $sql = "SELECT * FROM tb_task where unit='Semua'";
    $query = $this->db->query($sql);
    return $query;
  }
  
  public function showTask_unit(){
    $sql = "SELECT tb_task.kd_task, tb_task.task, tb_task.sifat, tb_unit.no_unit, tb_apt.nama_apt FROM tb_task 
    INNER JOIN tb_unit ON tb_unit.kd_unit=tb_task.unit
    INNER JOIN tb_apt ON tb_apt.kd_apt=tb_unit.kd_apt
    WHERE tb_task.unit!='Semua'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function addTask($task, $unit, $sifat, $stmp){
    $sql = "INSERT INTO tb_task(task,unit,sifat,stmp) VALUES('$task', '$unit', '$sifat', '$stmp')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }  

  public function updateTask($kd_task ,$task, $unit, $sifat){
    $sql = "UPDATE tb_task SET task='$task', unit ='$unit', sifat='$sifat' WHERE kd_task='$kd_task'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function deleteTask($kd_task){
    $sql = "DELETE FROM tb_task where kd_task='$kd_task'";
    $sql2= "DELETE FROM tb_task_unit WHERE kd_task='$kd_unit'";
    $query = $this->db->query($sql2);
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }  

  public function deleteTask_unit($kd_unit, $kd_task){
    $sql = "DELETE FROM tb_task_unit where kd_unit='$kd_unit' AND kd_task='$kd_task'";
    $query = $this->db->query($sql);
  }     

  public function editTask($kd_task){
    $sql = "SELECT * from tb_task WHERE kd_task='$kd_task'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showTask_byunit($kd_unit){
    $sql = "SELECT * from tb_task_unit INNER JOIN tb_task ON tb_task_unit.kd_task=tb_task.kd_task
    WHERE kd_unit = '$kd_unit'";
    $query = $this->db->query($sql);
    return $query;
  } 

  public function getCOdate($kd_unit, $sekarang){
    $sql = "SELECT check_out FROM tb_unit_kotor WHERE check_out 
    IN (SELECT MAX(check_out) FROM tb_unit_kotor Where kd_unit='$kd_unit' AND check_out<='$sekarang')";
    $query = $this->db->query($sql);
    return $query;
  }    

  public function getStmp_unit($kd_unit) {
   $result = $this->db->prepare("SELECT stmp_task FROM tb_unit WHERE kd_unit= ? AND stmp_task is not null");
      $result->bindParam(1, $kd_unit);
      $result->execute();
      $rows = $result->fetch();
      return $rows;
  }  

  public function update_new_task($kd_unit, $stmp){
    $sql = "INSERT INTO tb_task_unit (kd_unit, kd_task)
    SELECT '$kd_unit' As kd, kd_task FROM tb_task WHERE stmp > $stmp AND (unit='$kd_unit' or unit='Semua')";
    $query = $this->db->query($sql);
  }    
 
  public function isTask_updated($kd_unit, $CO) {
   $result = $this->db->prepare("SELECT kd_unit FROM tb_unit WHERE kd_unit= ? AND tgl_task=?");
      $result->bindParam(1, $kd_unit);
      $result->bindParam(2, $CO);
      $result->execute();
      $rows = $result->fetch();
      return $rows;
  }  

  public function updateTask_Unit($kd_unit, $CO) {
    $sql1 = "INSERT INTO tb_task_unit(kd_unit, kd_task) 
    SELECT '$kd_unit' As kd, kd_task FROM tb_task WHERE unit='$kd_unit' or unit='Semua'";
    $sql2 = "UPDATE tb_unit SET tgl_task='$CO' where kd_unit='$kd_unit'";
    $delete = "DELETE FROM tb_task where sifat='Sekali'";
    $query = $this->db->query($sql1);
    $query = $this->db->query($sql2);
    $query = $this->db->query($delete);
  }    

}
?>
