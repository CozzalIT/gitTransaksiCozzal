<?php
  require '../class/unit.php';
  require '../class/owner.php';
  require '../class/transaksi.php';
  require '../../config/database.php';

  if(isset($_POST["owner_id"])){
    $Proses = new Unit($db);
    $show = $Proses->showUnitbyOwner($_POST["owner_id"]);
    $j = 0;
    $response = array();
    while($data = $show->fetch(PDO::FETCH_OBJ)){
      $kd_unit[$j] = $data->kd_unit;
      $proses = new Owner($db);
      $show1 = $proses->showBooking($kd_unit[$j]);
      while($data1 = $show1->fetch(PDO::FETCH_OBJ)){
        $check_in = $data1->check_in;
        $check_out = $data1->check_out;
        if($data1->total_harga_owner>0){
          $pendapatan = $data1->total_harga_owner;
        }else{
          $pendapatan = ($data1->hari_weekend * $data1->harga_owner_weekend) + ($data1->hari_weekday * $data1->harga_owner);
        }
        if($data1->status == '1'){
          $response[] = array("nama" => $data1->nama,
                        "apartemen" => $data1->nama_apt,
                        "no_unit" => $data1->no_unit,
                        "check_in" => $check_in,
                        "check_out" => $check_out,
                        "pendapatan" => $pendapatan
                       );
        }
      }
    }
    echo json_encode($response); 
  }
?>