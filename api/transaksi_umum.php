<?php
  require("../class/transaksi.php");
  require("../class/transaksi_umum.php");
  require("../class/unit.php");
  require("../class/owner.php");
  require("../../config/database.php");

  if(isset($_POST['info_pengeluaran']) && $_POST['key']=='11sfjb1'){
    $i = 1;
    $kd_owner = $_POST['info_pengeluaran'];
    $proses_u = new Unit($db);
    $response = array();
    $show_u = $proses_u->showUnitbyOwner($kd_owner);
    while($data_u = $show_u->fetch(PDO::FETCH_OBJ)){
      $kd_unit = $data_u->kd_unit;
      $kebutuhan = "unit/$kd_unit";
      $proses_t = new TransaksiUmum($db);
      $show_t = $proses_t->showTUByKebutuhan($kebutuhan);
      while ($data_t = $show_t->fetch(PDO::FETCH_OBJ)) {
        $tanggal = explode(" ",$data_t->tanggal);
        $formatTanggal = explode("-",$tanggal[0]);
        switch ($formatTanggal[1]) {
          case '01':
            $formatTanggal[1] = 'Januari';
            break;
          case '02':
            $formatTanggal[1] = 'Februari';
            break;
          case '03':
            $formatTanggal[1] = 'Maret';
            break;
          case '04':
            $formatTanggal[1] = 'April';
            break;
          case '05':
            $formatTanggal[1] = 'Mei';
            break;
          case '06':
            $formatTanggal[1] = 'Juni';
            break;
          case '07':
            $formatTanggal[1] = 'Juli';
            break;
          case '08':
            $formatTanggal[1] = 'Agustus';
            break;
          case '09':
            $formatTanggal[1] = 'September';
            break;
          case '10':
            $formatTanggal[1] = 'Oktober';
              break;
          case '11':
            $formatTanggal[1] = 'November';
            break;
          case '12':
            $formatTanggal[1] = 'Desember';
            break;
        }
        $tanggalIndo = $formatTanggal[2]." ".$formatTanggal[1]." ".$formatTanggal[0];
        if($data_t->kode == "9/$kd_unit" or $data_t->kode == "10/$kd_unit"){
          $response[] = array(
              "no"  => $i,
              "Keterangan" => $data_t->keterangan,
              "Apartemen" => $data_u->nama_apt,
              "Unit" => $data_u->no_unit,
              "Jumlah" => $data_t->jumlah,
              "Nominal" => number_format($data_t->harga*$data_t->jumlah, 0, ".", ".")." IDR",
              "Tanggal" => $tanggalIndo,
              "Status" => ($data_t->status == 0 ?
                ($data_t->kode == "9/$kd_unit" ? 'Paid' : 'Unpaid') :
                ($data_t->kode == "9/$kd_unit" ? 'Billing Paid' : 'Billing Unpaid')
              )
          );
          $i++;
        }
      }
    }
    echo json_encode($response);
    //-------------------------------------------

  } 
?>
