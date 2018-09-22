<?php 

    require("../../../class/transaksi.php");
    require("../../../class/transaksi_umum.php");
    require("../../../class/unit.php");
    require("../../../class/owner.php");
    require("../../../class/kas.php");
    require("../../../../config/database.php");

    function isPost($x){
    	if(isset($_POST[$x])){
    		return $_POST[$x];
    	} else {
    		die(json_encode(array("status" => "Incorrect Value")));
    	}
    }

    if(isPost("input")=="TransaksiUmum" && isPost("key")=="p4f92pb0"){

        if(isset($_POST['kd_unit'])){
            $kd_apt = $_POST['kd_apt'];
            $kd_unit = $_POST['kd_unit'];
        }

        if(isPost('jenis') == 'tu'){
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

        $kd_kas = isPost('kd_kas');
        $harga = isPost('harga');
        $jumlah = isPost('jumlah');
        $keterangan = isPost('keterangan');
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
                    echo json_encode(array("status" => "Success", "direct" => "TransaksiUmum"));
                }elseif($status == 1){
                    $add_mutasi = $proses2->addMutasiKas($kd_kas, 0, $jenis, $tanggal, $keterangan_mutasi);
                    echo json_encode(array("status" => "Success", "direct" => "BillingTransaksi"));
                }
            } elseif ($add == "Failed"){
                echo json_encode(array("status" => "Gagal melakukan input data, silahkan coba lagi"));
            }
        } elseif ($mutasi_dana > $data->saldo){
            echo json_encode(array("status" => "Saldo Tidak Mencukupi"));
        }

    } 

    elseif(isPost("update")=="TransaksiUmum" && isPost("key")=="jrq9014l"){

        $kd_transaksi_umum = isPost('kd_transaksi_umum');
        $kd_kas_lama = isPost('kd_kas');

        $kas_selected = isPost('kas');
        if(isPost('kebutuhan') == "0"){
            $kebutuhan = "umum";
        } else {
            $kd_unit = isPost('unit');
            $kebutuhan = "unit/$kd_unit";
        }
        $harga_umum = isPost('harga');
        $jumlah_umum = isPost('jumlah');
        $total_umum_lama = isPost('total_umum_lama');
        $total_umum_baru = isPost('total_umum_baru');
        $keterangan = isPost('keterangan');
        $tanggal_transaksi = isPost('tanggal_transaksi');
        $tanggal = date("Y-m-d H:i:s");

        $Proses = new TransaksiUmum($db);
        $Proses_k = new Kas($db);

        $show = $Proses_k->showKas();
        $data_kas = $show->fetch(PDO::FETCH_OBJ);
        if($kd_kas_lama <> $kas_selected){
            $show_saldo_lama = $Proses_k->editSaldo($kd_kas_lama);
            $data_saldo_lama = $show_saldo_lama->fetch(PDO::FETCH_OBJ);
            $saldo_kas_lama = $data_saldo_lama->saldo + $total_umum_baru;

            $show_saldo_baru = $Proses_k->editSaldo($kas_selected);
            $data_saldo_baru = $show_saldo_baru->fetch(PDO::FETCH_OBJ);
            $saldo_kas_baru = $data_saldo_baru->saldo - $total_umum_baru;

            // Log System
            $update_kas_lama = $Proses_k->updateKas($kd_kas_lama, $saldo_kas_lama, $tanggal);

            $update_kas_baru = $Proses_k->updateKas($kas_selected, $saldo_kas_baru, $tanggal);

            $update_mutasi = $Proses_k->updateMutasiByDate($total_umum_baru, $kas_selected, $tanggal_transaksi);

        }elseif ($kd_kas_lama == $kas_selected) {
            $show_saldo_lama = $Proses_k->editSaldo($kd_kas_lama);
            $data_saldo_lama = $show_saldo_lama->fetch(PDO::FETCH_OBJ);
            $saldo_kas_lama = $data_saldo_lama->saldo + $total_umum_lama - $total_umum_baru;

            $update_kas_lama = $Proses_k->updateKas($kd_kas_lama, $saldo_kas_lama, $tanggal);

            $update_mutasi = $Proses_k->updateMutasiByDate($total_umum_baru, $kd_kas_lama, $tanggal_transaksi);
        }

        $add = $Proses->updateTransaksiUmum($kd_transaksi_umum, $kas_selected, $kebutuhan, $harga_umum, $jumlah_umum, $keterangan, $tanggal);
        
        echo json_encode(array("status" => "Update Berhasil"));
    }

    elseif(isPost('delete')=="TransaksiUmum" && isPost('key')=="asd79kq8"){

        $proses = new TransaksiUmum($db);
        $Proses_k = new Kas($db);
        $tanggal = date("Y-m-d H:i:s");

        $id = isPost("id");
        $show_transaksi = $proses->editTransaksiUmum($id);
        $data_transaksi = $show_transaksi->fetch(PDO::FETCH_OBJ);

        $show_saldo = $Proses_k->editSaldo($data_transaksi->kd_kas);
        $data_saldo = $show_saldo->fetch(PDO::FETCH_OBJ);

        $total = $data_transaksi->jumlah*$data_transaksi->harga;
        $saldo_kas = $data_saldo->saldo + $total;

        $update_saldo = $Proses_k->updateKas($data_transaksi->kd_kas, $saldo_kas, $tanggal);

        $Proses_k->deleteMutasiByDate($data_transaksi->tanggal);

        $del = $proses->deleteTransaksiUmum($id);

        if($data_transaksi->status == 0){
            echo json_encode(array("status" => "Success", "direct" => "TransaksiUmum"));
        }else{
            echo json_encode(array("status" => "Success", "direct" => "BillingTransaksi"));
        }        

    }

    elseif(isPost('Payment')=="BillingTransaksi" && isPost('key')=="98ashoq3"){

        $kd_transaksi_umum = isPost("id");
        $kd_kas_baru = isPost("kas");

        $proses = new TransaksiUmum($db);
        $show_tu = $proses->editTransaksiUmum($kd_transaksi_umum);
        $edit_tu = $show_tu->fetch(PDO::FETCH_OBJ);

        $kebutuhan = $edit_tu->kebutuhan;
        $harga_umum = $edit_tu->harga;
        $jumlah_umum = $edit_tu->jumlah;
        $keterangan = $edit_tu->keterangan;
        $tanggal = date('Y-m-d H:i:s');
        $status = 0;
        $mutasi_dana = $harga_umum*$jumlah_umum;
        $jenis = 2;
        if($kebutuhan == 'umum'){
            $keterangan_mutasi = 3;
        }else{
            $kd_unit = explode("/",$kebutuhan);
            $keterangan_mutasi = "10/".$kd_unit[1];
        }

        $update = $proses->paymentBilling($kd_transaksi_umum, $kd_kas_baru, $kebutuhan, $harga_umum, $jumlah_umum, $keterangan, $tanggal, $status);

        if($update == "Success"){
            $proses2 = new Kas($db);
            $edit = $proses2->editSaldo($kd_kas_baru);
            $data = $edit->fetch(PDO::FETCH_OBJ);

            if($mutasi_dana < $data->saldo){

                $add_mutasi = $proses2->addMutasiKas($kd_kas_baru, $mutasi_dana, $jenis, $tanggal, $keterangan_mutasi);

                $saldo = $data->saldo - $mutasi_dana;
                $update = $proses2->updateKas($kd_kas_baru, $saldo, $tanggal);

                if($add_mutasi == "Failed"){
                    echo json_encode(array("status" => "Failed", "flag" => "Penambahan Mutasi gagal"));
                }elseif($update == "Failed"){
                    echo json_encode(array("status" => "Failed", "flag" => "Saldo Kas gagal di update"));
                }

                // ????
                echo json_encode(array("status" => "Warning"));

            }elseif($mutasi_dana > $data->saldo){
                echo json_encode(array("status" => "Success"));
            }
        }

    }

 ?>