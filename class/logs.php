<?php
// session_start();

class Logs{
  private $db;

  public function __construct($database){
    $this->db = $database;
  }

  public function addLog($action,$table,$description,$content,$condition = null){
    $user = $this->getUser();
    $created_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO tb_logs_system (actions,tables,users,descriptions,contents,conditions,created_at)
    VALUES('$action', '$table', '$user', '$description','$content','$condition','$created_at')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function getUser() {
    // return $username;
    $result = $this->db->prepare("SELECT username,hak_akses,status FROM tb_user WHERE username= ?");
    $result->bindParam(1, $_SESSION['username']);
    $result->execute();
    $rows = $result->fetch();
    $data = [];
    // foreach($rows as $r){
      $data['username'] = $rows['username'];
      $data['hak_akses'] = $rows['hak_akses'];
      $data['status'] = $rows['status'];
    // }
    return json_encode($data);
  }

  public function contoh()
  {
    return print_r($this->db);
  }


}

?>
