<?php
require("../../config/database.php");
class Auto{
  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
  public function showField(){
    $sql = "SELECT kd_transaksi, kd_bank FROM tb_transaksi";
    $query = $this->db->query($sql);
    return $query;
  }

  public function updateField($kd_transaksi, $kd_kas){
    $sql = "UPDATE tb_transaksi SET kd_kas ='$kd_kas' where kd_transaksi='$kd_transaksi'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Add
  public function showField1(){
    $sql = "SELECT kd_confirm_transaksi, kd_bank FROM tb_confirm_transaksi";
    $query = $this->db->query($sql);
    return $query;
  }

  public function updateField1($kd_confirm_transaksi, $kd_kas){
    $sql = "UPDATE tb_confirm_transaksi SET kd_kas ='$kd_kas' where kd_confirm_transaksi='$kd_confirm_transaksi'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }
}

$proses = new Auto($db);
$show = $proses->showField();
while($data = $show->fetch(PDO::FETCH_OBJ)){
  $update = $proses->updateField($data->kd_transaksi, $data->kd_bank);
}
$show1 = $proses->showField1();
while($data1 = $show1->fetch(PDO::FETCH_OBJ)){
  $update1 = $proses->updateField1($data1->kd_confirm_transaksi, $data1->kd_bank);
}
if($update == 'Failed'){
  echo 'update field di Transaksi Gagal<br>';
}
if($update1 == 'Failed'){
  echo 'update field di Copnfirm Transaksi Gagal<br>';
}
?>
