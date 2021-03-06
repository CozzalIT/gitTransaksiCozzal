<?php 

    require("../../../class/transaksi.php");
    require("../../../class/search.php");
    require("../../../class/transaksi_umum.php");
    require("../../../class/unit.php");
    require("../../../class/owner.php");
    require("../../../class/kas.php");
    require("../../../class/crypto.php");
    require("../../../../config/database.php");

    function isPost($x, $check = false){
        if(isset($_POST[$x])){
            return $_POST[$x];
        } else {
            if($check) return "";
            else die(json_encode(array("status" => "Incorrect Value ".$x)));
        }
    }

    if(isPost("list", true)=="LaporanTransaksi" && isPost("key", true)=="41mmy12k"){

        $start_rec = isPost("start_rec");
        $length = isPost("length");
        $length++;
        $count = 0;
        $proses = new Transaksi($db);
        $show = $proses->showTransaksi_pag($start_rec,$length,"tb_transaksi.status=1");
        $callback = array();
        $calcul = $length-1;
        while($data = $show->fetch(PDO::FETCH_OBJ)){
            $count++;
            $calcul--;
            if($calcul < 0) break;
            $callback[] = array(
                    "kd_transaksi" => $data->kd_transaksi,
                    "kd_unit" => $data->kd_unit,
                    "no_kwitansi" => strtoupper(dechex($data->kd_transaksi)),
                    "penyewa" => $data->nama,
                    "unit" => $data->no_unit,
                    "check_in" => $data->check_in,
                    "check_out" => $data->check_out
            );
        }

        echo json_encode(array("data" => $callback, "next_page" => ($count==$length ? true:false)));

    }

    elseif(isPost("list", true)=="ConfirmTransaksi" && isPost("key", true)=="Q1CmrF2k"){

        $start_rec = isPost("start_rec");
        $length = isPost("length");
        $length++;
        $count = 0;
        $proses = new Transaksi($db);
        $show = $proses->showTransaksi_pag($start_rec,$length,"tb_transaksi.status=42");
        $callback = array();
        $calcul = $length-1;
        while($data = $show->fetch(PDO::FETCH_OBJ)){
            $count++;
            $calcul--;
            if($calcul < 0) break;
            $callback[] = array(
                    "kd_transaksi" => $data->kd_transaksi,
                    "kd_unit" => $data->kd_unit,
                    "no_kwitansi" => strtoupper(dechex($data->kd_transaksi)),
                    "penyewa" => $data->nama,
                    "unit" => $data->no_unit,
                    "check_in" => $data->check_in,
                    "check_out" => $data->check_out
            );
        }

        echo json_encode(array("data" => $callback, "next_page" => ($count==$length ? true:false)));

    }

    elseif(isPost("list", true)=="CancelTransaksi" && isPost("key", true)=="QCbmbF3L"){

        $start_rec = isPost("start_rec");
        $length = isPost("length");
        $length++;
        $count = 0;
        $proses = new Transaksi($db);
        $show = $proses->showTransaksi_pag($start_rec,$length,"tb_transaksi.status=2 OR tb_transaksi.status=3");
        $callback = array();
        $calcul = $length-1;
        while($data = $show->fetch(PDO::FETCH_OBJ)){
            $count++;
            $calcul--;
            if($calcul < 0) break;
            $callback[] = array(
                    "kd_transaksi" => $data->kd_transaksi,
                    "kd_unit" => $data->kd_unit,
                    "penyewa" => $data->nama,
                    "apartemen" => $data->nama_apt,
                    "unit" => $data->no_unit,
                    "check_in" => $data->check_in,
                    "check_out" => $data->check_out,
                    "dp" => number_format($data->dp, 0, ".", ".")." IDR",
                    "setlemet" => ($data->status==2 ? "-" : number_format($data->setlement_dp, 0, ".", ".")." IDR"),
                    "action" => ($data->status==2 ? "Setlement DP" : "Tidak Ada")
            );
        }

        echo json_encode(array("data" => $callback, "next_page" => ($count==$length ? true:false)));

    }    

    elseif(isPost("detail", true)=="LaporanTransaksi" && isPost("key", true)=="41mmy12k"){

        $kd_transaksi = isPost("kd_transaksi");
        $proses = new Transaksi($db);
        $show = $proses->editTransaksi($kd_transaksi);
        $data = $show->fetch(PDO::FETCH_OBJ);
        $crpt = new Crypto();
        $callback = array(
            "nama_penyewa" => $data->nama,
            "alamat_penyewa" => $data->alamat,
            "jenis_kelamin" => $data->jenis_kelamin,
            "no_tlp" => $data->no_tlp,
            "email" => $data->email,
            "kwitansi" => array(
                "kwitansi_id" => strtoupper(dechex($data->kd_transaksi)),
                "invoice_date" => $data->tgl_transaksi,
                "apartemen" => $data->nama_apt,
                "unit" => $data->no_unit,
                "booking_via" => $data->booking_via,
                "check_in" => $data->check_in,
                "check_out" => $data->check_out,
                "jumlah_hari" => $data->hari,
                "jumlah_tamu" => $data->tamu,
                "sewa_wd" => number_format($data->harga_sewa, 0, ".", ".")." IDR",
                "sewa_we" => number_format($data->harga_sewa_weekend, 0, ".", ".")." IDR",
                "diskon" => number_format($data->diskon, 0, ".", ".")." IDR",
                "ekstra_charge" => number_format($data->ekstra_charge, 0, ".", ".")." IDR",
                "total_tagihan" => number_format($data->total_tagihan, 0, ".", ".")." IDR",
                "dp" => number_format($data->dp, 0, ".", ".")." IDR",
                "dp_via" => $data->sumber_dana,
                "sisa_pelunasan" => number_format($data->sisa_pelunasan, 0, ".", ".")." IDR",
                "catatan" => $data->catatan,
                "code" => $crpt->encrypt($data->kd_transaksi)
            )
        );    
        echo json_encode($callback);  

    }

    elseif(isPost("info", true)=="BayarTransaksi" && isPost("key", true)=="tZwMz307"){

        $kd_transaksi = isPost("kd_transaksi");
        $proses = new Transaksi($db);
        $show = $proses->editTransaksi($kd_transaksi);
        $data1 = $show->fetch(PDO::FETCH_OBJ);
        $callback = array(
            "total_tagihan" => number_format($data1->total_tagihan, 0, ".", ".")." IDR",
            "dp" => number_format($data1->dp, 0, ".", ".")." IDR",
            "pembayaran" => number_format($data1->pembayaran, 0, ".", ".")." IDR",
            "pembayaran_dp" => number_format($data1->pembayaran + $data1->dp, 0, ".", ".")." IDR",
            "sisa_pelunasan" => ($data1->sisa_pelunasan <= 0 ? '0' : number_format($data1->sisa_pelunasan, 0, ".", ".") )." IDR",
            "kembalian" => ($data1->sisa_pelunasan <= 0 ? number_format(abs($data1->sisa_pelunasan), 0, ".", ".") : '0' )." IDR",
            "status" => ($data1->sisa_pelunasan <= 0 ? 'LUNAS' : 'BELUM LUNAS'),
            "kd_transaksi" => $kd_transaksi
        );    
        echo json_encode($callback);  

    }  

    elseif(isPost("edit", true)=="Transaksi" && isPost("key", true)=="xr10b5dE"){

        $kd_transaksi = isPost("kd_transaksi");
        $proses = new Transaksi($db);
        $show = $proses->editTransaksi($kd_transaksi);
        $data = $show->fetch(PDO::FETCH_OBJ);

        $proses2 = new Unit($db);
        $show2 = $proses2->editUnit($data->kd_unit);
        $data2 = $show2->fetch(PDO::FETCH_OBJ);

        $callback = array(
            "kd_transaksi"  => $data->kd_transaksi,
            "pembayaran" => $data->pembayaran,
            "nama_penyewa" => $data->nama,
            "check_in" => $data->check_in,
            "check_out" => $data->check_out,
            "hari" => $data->hari,
            "kd_apt" => $data->kd_apt,
            "kd_unit" => $data->kd_unit,
            "no_unit" => $data->no_unit,
            "harga_sewa" => $data->harga_sewa,
            "harga_sewa_weekend" => $data->harga_sewa_weekend,
            "jumlah_tamu" => $data->tamu,
            "harga_sewa_asli"  => $data2->h_sewa_wd."/".$data2->h_sewa_we,
            "harga_sewa_gbg" => $data->harga_sewa_gbg,
            "ekstra_charge" => $data->ekstra_charge,
            "deposit" => $data->deposit,
            "total_biaya" => $data->total_tagihan,
            "total_harga_owner" => $data->total_harga_owner,
            "kd_booking" => $data->kd_booking,
            "kd_kas" => $data->kd_kas,
            "dp" => $data->dp,
            "catatan" => $data->catatan
        );    
        echo json_encode($callback);  

    }  

    elseif(isPost("search", true)=="Transaksi" && isPost("key", true)=="jkas78hj"){

        $keyword = isPost("keyword");
        $type = isPost("type"); // laporan atau confirm

        $callback = [];
        $Proses = new Search($db);
        $show = $Proses->transaksi($keyword, ($type=="laporan" ? "1" : "42") );

        while($data = $show->fetch(PDO::FETCH_OBJ)){
            $callback[] = array(
                    "kd_transaksi" => $data->kd_transaksi,
                    "kd_unit" => $data->kd_unit,
                    "no_kwitansi" => strtoupper(dechex($data->kd_transaksi)),
                    "penyewa" => $data->nama,
                    "unit" => $data->no_unit,
                    "check_in" => $data->check_in,
                    "check_out" => $data->check_out
            );
        }

        echo json_encode($callback);

    }  

 ?>