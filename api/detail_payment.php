<?php
    require("../class/transaksi_umum.php");
    require("../class/transaksi.php");
    require("../class/owner.php");
    require("../class/kas.php");
    require("../class/unit.php");
    require("../../config/database.php");

    if(isset($_POST['detail_payment']) && $_POST['key']=="2fq31jaf1"){

        $kode = explode("x",$_POST['detail_payment']);
        $transaksi = explode("a",$kode[0]);
        $transaksi_umum = explode("b",$kode[1]);

        $proses_t = new Transaksi($db);
        $proses_u = new Unit($db);

        $response = array();

        foreach($transaksi as $kd_transaksi) {
            if($kd_transaksi <> 'dummy'){
                $show_t = $proses_t->editTransaksi($kd_transaksi);
                $data_t = $show_t->fetch(PDO::FETCH_OBJ);
                $subtest= $data_t ->total_harga_owner;
                if($subtest>0){
                    $nominal = $data_t->total_harga_owner;
                    $weekend = 0;
                    $weekday = 0;
                } else {
                    $weekend = $data_t->hari_weekend*$data_t->harga_owner_weekend;
                    $weekday = $data_t->hari_weekday*$data_t->harga_owner;
                    $nominal = $weekday+$weekend;
                }
                $response[] = array(
                                "no": $i,
                                "jenis": "Transakai : COZ-".strtoupper(dechex($kd_transaksi)),
                                "apartemen": $data_t->nama_apt,
                                "unit": $data_t->no_unit,
                                "tanggal": $data_t->check_in." / ".$data_t->check_out,
                                "nominal": number_format($nominal, 0, ".", ".")." IDR"
                            );
            }
        }



        if($transaksi_umum[0] <> null){
            foreach($transaksi_umum as $kd_transaksi_umum){
                $proses_tu = new TransaksiUmum($db);
                $proses_u = new Unit($db);

                $show_tu = $proses_tu->editTransaksiUmum($kd_transaksi_umum);
                $data_tu = $show_tu->fetch(PDO::FETCH_OBJ);

                $kd_unit = explode('/',$data_tu->kebutuhan);
                $show_u = $proses_u->editUnit($kd_unit[1]);
                $data_u = $show_u->fetch(PDO::FETCH_OBJ);

                $response[] = array(
                                "no": $i,
                                "jenis": "T-Umum (".$data_tu->keterangan.")",
                                "apartemen": $data_u->nama_apt,
                                "unit": $data_u->no_unit,
                                "tanggal": $data_tu->tanggal,
                                "nominal": number_format($data_tu->harga*$data_tu->jumlah*(-1), 0, ".", ".")." IDR"
                            );

            }
        }

        echo json_encode($response); 
    }
?>