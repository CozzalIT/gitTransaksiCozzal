<?php
  require '../class/owner.php';
  require '../../config/database.php';

  if(isset($_POST["kd_owner"]) && isset($_POST["payment"])){
    $Proses = new Owner($db);
    $show = $Proses->showOwnerPayment($_POST["kd_owner"]);
    $response = array();
    $paid = array();
    $wait = array();
    $confirm = array();

    while($data = $show->fetch(PDO::FETCH_OBJ)){
      if ($data->status=="1"){
        $paid[] = array("kd_payment" => $data->kd_owner_payment,
                        "tanggal" => $data->tgl_pembayaran,
                        "jumlah_transaksi" => $data->jumlah_transaksi,
                        "nominal" => number_format($data->nominal, 0, ".", ".")." IDR",
                        "status" => "PAID"
                       );
      } elseif ($data->status=="2"){
        $wait[] = array("kd_payment" => $data->kd_owner_payment,
                        "tanggal" => $data->tgl_pembayaran,
                        "jumlah_transaksi" => $data->jumlah_transaksi,
                        "nominal" => number_format($data->nominal, 0, ".", ".")." IDR",
                        "status" => "WAIT"
                       );
      } elseif ($data->status=="4"){
        $confirm[] = array("kd_payment" => $data->kd_owner_payment,
                        "tanggal" => $data->tgl_pembayaran,
                        "jumlah_transaksi" => $data->jumlah_transaksi,
                        "nominal" => number_format($data->nominal, 0, ".", ".")." IDR",
                        "status" => "ON PROGRESS"
                       );
      }
    }

    if ($_POST["payment"]=="confirm"){
      for($i=0;$i<count($wait);$i++){
        $response[] = $wait[$i];
      }
    } elseif ($_POST["payment"]=="history") {
      for($i=0;$i<count($confirm);$i++){
        $response[] = $confirm[$i];
      }
      for($i=0;$i<count($paid);$i++){
        $response[] = $paid[$i];
      }
    }
    
    echo json_encode($response); 
  }
?>