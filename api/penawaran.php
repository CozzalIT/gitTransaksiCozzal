<?php
  require("../class/unit.php");
  require("../class/owner.php");
  require("../../config/database.php");

  if(isset($_POST['info_penawaran']) && $_POST['key']=='123hjv1'){
    // $_POST['info_penawaran'] berisi kode owner
    $proses_u = new Unit($db);
    $proses_o = new Owner($db);
    $i = 0;
    $owner = $_POST['info_penawaran'];
    $show = $proses_u->showUnitbyOwner($owner);
    while($data = $show->fetch(PDO::FETCH_OBJ)){
      $unit[$i] = $data->kd_unit;
      $i++;
    }
    $jumlahUnit = count($unit);
    $response = array();

    for ($i=0; $i<$jumlahUnit; $i++) {
      $show_o = $proses_o->showPenawaranByUnit($unit[$i]);
      while($data_o = $show_o->fetch(PDO::FETCH_OBJ)){
        if($data_o->status == 0){
          $response[] = array(
            "kd_unit" => $data_o->kd_unit,
            "no_unit" => $data_o->no_unit,
            "kd_penawaran" => $data_o->kd_penawaran,
            "judul_penawaran" => $data_o->judul,
            "pesan_penawaran" => $data_o->pesan,
            "harga_wd" => $data_o->h_owner_wd,
            "harga_we" => $data_o->h_owner_we,
            "harga_mg" => $data_o->h_owner_mg,
            "harga_bln" => $data_o->h_owner_bln
          );
        }
      }
    }
    echo json_encode($response);
    //--------------------------------------------
  } elseif(isset($_POST['terima_penawaran']) && $_POST['key']=='934kkn5') {
    // $_POST['terima_penawaran'] berisi kode penawaran owner
    $kd_penawaran = $_POST['terima_penawaran'];
    $status = 1;
    $kd_owner = $_POST['kd_owner'];
    $kd_unit = $_POST['kd_unit'];
    $h_owner_wd = $_POST['wd'];
    $h_owner_we = $_POST['we'];
    $h_owner_mg = $_POST['mg'];
    $h_owner_bln = $_POST['bln'];
    $proses_o = new Owner($db);
    $update_o = $proses_o->updateStatusPenawaran($kd_penawaran, $status);
    $proses_u = new Unit($db);
    $update_u = $proses_u->updateHargaOwner($kd_unit, $kd_owner, $h_owner_wd, $h_owner_we, $h_owner_mg, $h_owner_bln);
    echo json_encode(array("status"=>"oke"));
    //--------------------------------------------
  } elseif (isset($_POST['tolak_penawaran']) && $_POST['key']=='ggrt871') {
    // $_POST['tolak_penawaran'] berisi kode penawaran owner
    $kd_penawaran = $_POST['tolak_penawaran'];
    $status = 2;
    $proses_o = new Owner($db);
    $update_o = $proses_o->updateStatusPenawaran($kd_penawaran, $status);
    echo json_encode(array("status"=>"oke"));
  }
?>
