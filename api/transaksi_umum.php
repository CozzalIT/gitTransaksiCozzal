<?php
    require("../class/transaksi.php");
    require("../class/transaksi_umum.php");
    require("../class/unit.php");
    require("../class/owner.php");
    require("../class/kas.php");
    require("../../config/database.php");

    if(isset($_POST['info_pengeluaran']) && $_POST['key']=='11sfjb1'){

        $bulan = array(
                    '01' => "Januari", '02' => "Februari", '03' => "Maret",
                    '04' => "April", '05' => "Mei", '06' => 'Juni', '07' => "Juli",
                    '08' => "Agustus", '09' => "September", '10' => "Oktober",
                    '11' => "November", '12' => "Desember"
                );

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
            
            $formatTanggal[1] = $bulan[$formatTanggal[1]];
            
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

    elseif($_POST['input']=="TransaksiUmum" && isset($_POST['key']) && isset($_POST['jenis'])){
        if($_POST['key']=="p4f92pb0"){

            if(isset($_POST['kd_unit'])){
                $kd_apt = $_POST['kd_apt'];
                $kd_unit = $_POST['kd_unit'];
            }

            if($_POST['jenis'] == 'tu'){
                $kebutuhan = "umum";
                $keterangan_mutasi = 3;
                $status = 0;
                $jatuh_tempo = null;
            } elseif ($_POST['jenis'] == 'u'){
                $kebutuhan = "unit/".$kd_unit;
                $keterangan_mutasi = '10/'.$kd_unit;
                $status = 0;
                $jatuh_tempo = null;
            } elseif ($_POST['jenis'] == 'btu'){
                $kebutuhan = "umum";
                $keterangan_mutasi = 3;
                $status = 1;
                $jatuh_tempo = $_POST['jatuh_tempo'];
            } elseif ($_POST['jenis'] == 'bu'){
                $kebutuhan = "unit/".$kd_unit;
                $keterangan_mutasi = '10/'.$kd_unit;
                $status = 1;
                $jatuh_tempo = $_POST['jatuh_tempo'];
            }

            $kd_kas = $_POST['kd_kas'];
            $harga = $_POST['harga'];
            $jumlah = $_POST['jumlah'];
            $keterangan = $_POST['keterangan'];
            $tanggal = date('Y-m-d H:i:s');
            $mutasi_dana = $harga*$jumlah;
            $jenis = 2;

            $proses = new TransaksiUmum($db);
            $proses2 = new Kas($db);

            $edit = $proses2->editSaldo($kd_kas);
            $data = $edit->fetch(PDO::FETCH_OBJ);

            if($mutasi_dana < $data->saldo){
                $add = $proses->addTransaksiUmum($kd_kas, $kebutuhan, $harga, $jumlah, $keterangan, $tanggal, $status, $jatuh_tempo);
                if($add == "Success"){
                    if($status == 0){
                        $add_mutasi = $proses2->addMutasiKas($kd_kas, $mutasi_dana, $jenis, $tanggal, $keterangan_mutasi);
                        $saldo = $data->saldo - ($harga*$jumlah);
                        $update = $proses2->updateKas($kd_kas, $saldo, $tanggal);
                        echo json_encode(array("status" => "Berhasil"));
                    }elseif($status == 1){
                        $add_mutasi = $proses2->addMutasiKas($kd_kas, 0, $jenis, $tanggal, $keterangan_mutasi);
                        echo json_encode(array("status" => "Berhasil"));
                    }
                } elseif ($add == "Failed"){
                    echo json_encode(array("status" => "Gagal melakukan input data, silahkan coba lagi"));
                }
            } elseif ($mutasi_dana > $data->saldo){
                echo json_encode(array("status" => "Saldo Tidak Mencukupi"));
            }

        } else {
          echo "UNAUTHORIZED";
        }
    }

?>
