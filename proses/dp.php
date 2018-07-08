<?php
require("../../config/database.php");
require("../class/dp_via.php");
// session_start();
$view = $_SESSION['hak_akses'];

//Tambah DP Via
if(isset($_POST['addDp_via'])){
  $kd_bank = $_POST['kd_bank'];
  $nama_bank= $_POST['nama_bank'];

  $proses = new dpVia($db);
  $add = $proses->addDp_via($kd_bank, $nama_bank);

    // Log System
    $logs->addLog('ADD','tb_dp_via','Tambah data DP via',json_encode([$kd_bank, $nama_bank]),null);

  if($add == "Success"){
    header('Location:../view/'.$view.'/dp/dp_via.php');
  }
}


//Update Bank (DP Via)
elseif(isset($_POST['updateBank'])){
  $kd_bank = $_POST['kd_bank'];
  $nama_bank = $_POST['nama_bank'];

  $proses = new dpVia($db);
  $update = $proses->updateBank($kd_bank, $nama_bank);

    // Log System
    $logs->addLog('Update','tb_dp_via','Update data DP via',json_encode([$kd_bank, $nama_bank]),null);

  if($update == "Success"){
    header('Location:../view/'.$view.'/dp/dp_via.php');
  } else {
    echo 'error';
  }
}

//Delete DP Via
elseif(isset($_GET['delete_dp']) && ($view=="superadmin" || $view=="manager")){
  $proses = new dpVia($db);
  $del = $proses->deleteDp_via($_GET['delete_dp']);
  // Log System
  $logs->addLog('Delete','tb_dp_via','Delete data DP via',json_encode([$_GET['delete_dp']]),null);

  header("location:../view/".$view."/dp/dp_via.php");
}

else header('Location:../view/'.$view.'/home/home.php');

?>
