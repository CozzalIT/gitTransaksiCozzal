<?php 

    require("../../../class/transaksi.php");
    require("../../../class/ics.php");
    require("../../../class/fcm.php");
    require("../../../class/unit.php");
    require("../../../class/owner.php");
    require("../../../class/kas.php");
    require("../../../../config/database.php");

    $ICS = new ICS($db);

    function buildICS($kd_unit){
        $ICS = $GLOBALS["ICS"];
        $kd_unit = str_replace("x", "/",$_GET['id']);
        $ICS->buildIcs($kd_unit);
    }

    function getDisCount($harga_sewa, $harga_sewa_we, $harga_sewa_asli, $wd, $we, $total){
        $harga_asli = explode("/", $harga_sewa_asli);
        if(($harga_sewa+$harga_sewa_we)<($harga_asli[0]+$harga_asli[1])){ //0 = weekday, 1 = weekend
            return ($harga_asli[0]*$wd)+($harga_asli[1]*$we)-$total;
        }else {
            return ($harga_sewa*$wd)+($harga_sewa_we*$we)-$total;
        }
    }
    function startinweekend($hari, $week, $jumlah_weekday, $jumlah_weekend){
        $we =0; $wd = $hari+5;
        while($wd>5){
            $we = 8-$week; $hari = $wd-5;
            if($hari==1) $we=1;
            
            $wd=$hari-$we;
            $jumlah_weekend = $jumlah_weekend+$we;
            
            if($wd>5) {
                $jumlah_weekday = $jumlah_weekday+5;
            } else {
                $jumlah_weekday = $jumlah_weekday+$wd;
            }
        }
        return $jumlah_weekday."/".$jumlah_weekend;
    }

    function isPost($x){
    	if(isset($_POST[$x])){
    		return $_POST[$x];
    	} else {
    		die(json_encode(array("status" => "Incorrect Value")));
    	}
    }

    if(isPost("input")=="Transaksi" && isPost("key")=="7asjN21#"){
        
        $kd_penyewa = isPost('kd_penyewa');
        $kd_apt = isPost('apartemen');
        $tamu = isPost('tamu');
        $check_in = isPost('check_in');
        $check_out = isPost('check_out');
        $harga_sewa = isPost('harga_sewa_wd');
        $harga_sewa_we = isPost('harga_sewa_we');
        $harga_sewa_gbg = isPost('harga_sewa_gbg');
        $harga_sewa_asli = isPost('harga_sewa_asli');
        $ekstra_charge = isPost('ekstra_charge');
        $kd_booking = isPost('booking_via');
        $kd_kas = isPost('kas');
        $dp = isPost('dp');
        $total  = isPost('total');
        $total_harga_owner = isPost('total_harga_owner');
        $sisa_pelunasan = $total - $dp;
        $hari = isPost('jumhari');
        $catatan = isPost('catatan');
        $deposit = isPost('deposit');
        $tgl_transaksi = date('y-m-d H:i:s');
        $tanggal = date('y-m-d H:i:s');
        $week = date("w",strtotime($check_in))+1;

        $kd_unit = isPost('unit');

        $proses_u = new Unit($db);
        $show_u = $proses_u->editUnit($kd_unit);
        $data_u = $show_u->fetch(PDO::FETCH_OBJ);
        $h_owner_wd = $data_u->h_owner_wd;
        $h_owner_we = $data_u->h_owner_we;
        $kd_owner = $data_u->kd_owner;

        if($week>5){ //jika dimulai dari weekend
            $week_kind = explode("/",startinweekend($hari, $week, 0, 0));
            $jumlah_weekday = $week_kind[0]; $jumlah_weekend = $week_kind[1];
        }else{ //jika dimulai dri weekday
            if($week+$hari<7){
                $jumlah_weekday=$hari;$jumlah_weekend=0;
            }else{
                $wd = 6 - $week;
                $week_kind = explode("/",startinweekend($hari-$wd, 6, $wd, 0));
                $jumlah_weekday = $week_kind[0];
                $jumlah_weekend = $week_kind[1];
            }
        }

        $harga_asli = explode("&", $harga_sewa_asli);
        if($total<(($harga_asli[0]*$jumlah_weekday)+($harga_asli[1]*$jumlah_weekend))){
            $diskon = getDisCount($harga_sewa, $harga_sewa_we, $harga_sewa_asli, $jumlah_weekday, $jumlah_weekend, $total);
        }else{
            $diskon = 0;
        }

        $proses = new Transaksi($db);
        $proses2 = new Kas($db);
        $proses_o = new Owner($db);
        $proses_f = new fcm($db);

        $add_transaksi = $proses->addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $check_in, $check_out, $jumlah_weekend, $jumlah_weekday, $hari, $harga_sewa, $harga_sewa_we, $harga_sewa_gbg, $tgl_transaksi, $diskon, $ekstra_charge, $kd_kas, $tamu, $kd_booking, $dp, $total, $total_harga_owner, $sisa_pelunasan, 1, $h_owner_wd, $h_owner_we,$catatan, $deposit);


        if($add_transaksi == "Success"){

            $proses->addUnit_kotor($kd_unit, $check_in, $check_out);
            
            $show_o = $proses_o->editOwner($kd_owner);
            $data_o = $show_o->fetch(PDO::FETCH_OBJ);
            $username = $data_o->username;

            $show_f = $proses_f->showToken($username);
            $data_f = $show_f->fetch(PDO::FETCH_OBJ);
            $token = $data_f->token;

            //Notif
            $registration_ids = array($token);
            $pushNotif = $proses_f->send_notification($registration_ids,'Selamat! Anda mendapat reservasi baru.');
            //Notif END

            $show = $proses->showMaxTransaksi();
            $data = $show->fetch(PDO::FETCH_OBJ);
            $keterangan_mutasi = "6/".$data->kd_transaksi;

            if($dp <> 0){
                $add_mutasi = $proses2->addMutasiKas($kd_kas, $dp, 1, $tanggal, $keterangan_mutasi);
                $show1 = $proses2->editSaldo($kd_kas);
                $data1 = $show1->fetch(PDO::FETCH_OBJ);
                $saldo = $dp + $data1->saldo;
                $update_kas = $proses2->updateKas($kd_kas, $saldo, $tanggal);
            }

            buildICS($kd_unit);            

            echo json_encode(array("status" =>"Success"));

        }else{
            echo json_encode(array("status" =>"Failed"));
        }

    } 

    elseif(isPost("update")=="Transaksi" && isPost("key")=="FdH9IDNl"){

        $kd_transaksi = $_POST['kd_transaksi'];
        $kd_apt = $_POST['apartemen'];
        $kode = explode("+",$_POST['unit']);
        $kd_unit = $kode[0];
        $tamu = $_POST['tamu'];
        $check_in = $_POST['check_in'];
        $check_out = $_POST['check_out'];
        $harga_sewa = $_POST['harga_sewa'];
        $harga_sewa_we = $_POST['harga_sewa_we'];
        $harga_sewa_asli = $_POST['harga_sewa_asli'];
        $harga_sewa_gbg = $_POST['harga_sewa_gbg'];

        $ekstra_charge = $_POST['ekstra_charge'];
        $kd_booking = $_POST['booking_via'];
        $kd_kas = $_POST['kas'];
        $dp = $_POST['dp'];
        $total_tagihan = $_POST['total'];
        $total_harga_owner = $_POST['total_harga_owner'];
        $pembayaran = $_POST['pembayaran'];
        $sisa_pelunasan = $total_tagihan - $dp - $pembayaran;
        $hari = $_POST['jumhari'];
        $week = date("w",strtotime($check_in))+1;
        $tanggal = date('Y-m-d H:i:s');
        $kaseterangan = '6/'.$kd_transaksi;
        $catatan = $_POST['catatan'];
        $deposit = $_POST['deposit'];

        $proses_u = new Unit($db);
        $show_u = $proses_u->editUnit($kd_unit);
        $data_u = $show_u->fetch(PDO::FETCH_OBJ);
        $h_owner_wd = $data_u->h_owner_wd;
        $h_owner_we = $data_u->h_owner_we;
        //$h_owner_mg = $data_u->h_owner_mg;
        //$h_owner_bln = $data_u->h_owner_bln;

        if($week>5){ //jika dimulai dari weekend
            $week_kind = explode("/",startinweekend($hari, $week, 0, 0));
            $jumlah_weekday = $week_kind[0]; $jumlah_weekend = $week_kind[1];
        }else{ //jika dimulai dri weekday
            if($week+$hari<7){
                $jumlah_weekday=$hari;$jumlah_weekend=0;
            }else{
                $wd = 6 - $week;
                $week_kind = explode("/",startinweekend($hari-$wd, 6, $wd, 0));
                $jumlah_weekday = $week_kind[0];
                $jumlah_weekend = $week_kind[1];
            }
        }

        $harga_asli = explode("/", $harga_sewa_asli);
        
        if($total_tagihan<(($harga_asli[0]*$jumlah_weekday)+($harga_asli[1]*$jumlah_weekend))){
            $diskon = getDisCount($harga_sewa, $harga_sewa_we, $harga_sewa_asli, $jumlah_weekday, $jumlah_weekend, $total_tagihan);
        } else {
            $diskon = 0;
        }

        $proses = new Transaksi($db);
        $proses_kas = new Kas($db);

        $show = $proses_kas->showKdKas($keterangan);
        $data_mutasi = $show->fetch(PDO::FETCH_OBJ);
        //Mengecek ketersediaan mutasi kas
        if(!empty($data_mutasi->kd_kas)){
            $kd_kas_lama = $data_mutasi->kd_kas;
            $mutasi_dana = $data_mutasi->mutasi_dana;
        }else{
            $kd_kas_lama = $kd_kas;
            $mutasi_dana = 0;
        }

        if($kd_kas <> $kd_kas_lama){
            //Mengembalikan Saldo kas yang diganti
            $show_saldo_lama = $proses_kas->editSaldo($kd_kas_lama);
            $data_saldo_lama = $show_saldo_lama->fetch(PDO::FETCH_OBJ);
            $saldo_kas_lama = $data_saldo_lama->saldo - $mutasi_dana;

            //Merubah Saldo kas pengganti
            $show_saldo_baru = $proses_kas->editSaldo($kd_kas);
            $data_saldo_baru = $show_saldo_baru->fetch(PDO::FETCH_OBJ);
            $saldo_kas_baru = $data_saldo_baru->saldo + $dp;

            $update_kas_lama = $proses_kas->updateKas($kd_kas_lama, $saldo_kas_lama, $tanggal);
            $update_kas_baru = $proses_kas->updateKas($kd_kas, $saldo_kas_baru, $tanggal);

            $delete_mutasi = $proses_kas->deleteMutasi($keterangan);
            $add_mutasi = $proses_kas->addMutasiKas($kd_kas, $dp, 1, $tanggal, $keterangan);
        } elseif ($kd_kas == $kd_kas_lama){
            $show_saldo = $proses_kas->editSaldo($kd_kas);
            $show_mutasi_dana = $proses_kas->showMutasiKas($keterangan);

            $data_saldo = $show_saldo->fetch(PDO::FETCH_OBJ);
            $data_mutasi_dana = $show_mutasi_dana->fetch(PDO::FETCH_OBJ);

            $saldo_kas = ($data_saldo->saldo - $data_mutasi_dana->mutasi_dana) + $dp;
            $update_kas = $proses_kas->updateKas($kd_kas, $saldo_kas, $tanggal);

            if($mutasi_dana <> $dp){
                $delete_mutasi = $proses_kas->deleteMutasi($keterangan);
                $add_mutasi = $proses_kas->addMutasiKas($kd_kas, $dp, 1, $tanggal, $keterangan);
            }
        }


        // $unit adalah kode unit lama
        $unit = $proses->updateUnit_kotor($kd_transaksi ,$kd_unit, $check_in, $check_out);
         //die("unit lama = ".$kd_unit." dan unit baru = ".$unit);
        $add = $proses->updateTransaksi($kd_transaksi, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $harga_sewa_we, $harga_sewa_gbg, $diskon, $ekstra_charge, $kd_booking, $kd_kas, $dp, $total_tagihan, $total_harga_owner,$sisa_pelunasan, $hari, $jumlah_weekend, $jumlah_weekday, $h_owner_wd, $h_owner_we,$catatan,$deposit);
        // Log System
        //$logs->addLog('Update','tb_transaksi','Update data transaksi',json_encode([$kd_transaksi, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $harga_sewa_we, $harga_sewa_gbg, $diskon, $ekstra_charge, $kd_booking, $kd_kas, $dp, $total_tagihan, $total_harga_owner,$sisa_pelunasan, $hari, $jumlah_weekend, $jumlah_weekday, $h_owner_wd, $h_owner_we,$catatan,$deposit]),null);
        if($add == "Success"){
            if($kd_unit!=$unit)
                $kd_unit .= 'x'.$unit;

            buildICS($kd_unit);   

            echo json_encode(array("status" =>"Success"));
        } else {
            echo json_encode(array("status" =>"Failed"));
        }

    }

    elseif(isPost('cancel')=="Transaksi" && isPost('key')=="mKl79Pq9"){

        $kd_transaksi = isPost('kd_transaksi');
        $kd_unit = isPost('unitCancel');
        $proses = new Transaksi($db);
        $add = $proses->addCancel($kd_transaksi);

        // Log System
        //$logs->addLog('CancelTransaction','tb_transaksi','Pembatalan transaksi',json_encode([$kd_transaksi]),null);

        if($add == "Success"){   
            $delete = $proses->deleteUnit_kotor($kd_transaksi);
            buildICS($kd_unit);
            echo json_encode(array("status" =>"Success"));
        } else {
            echo json_encode(array("status" =>"Failed"));
        }    

    }

    elseif(isPost('confirm')=="Transaksi" && isPost('key')=="KmlPr667"){

        $kd_transaksi = isPost("kd_transaksi");
        $proses = new Transaksi($db);
        $show = $proses->cekPelunasan($kd_transaksi);
        $data = $show->fetch(PDO::FETCH_OBJ);

        if($data->sisa_pelunasan > 0){
            // Proses konfirm gagal karena belum lunas
            echo json_encode(array("status" =>"Rejected")); 
        } else {
            $add = $proses->addConfirm($kd_transaksi);
            // Log System
            //$logs->addLog('ADDConfirmation','tb_transaksi','Tambah data konfirmasi transaksi',json_encode([$kd_transaksi]),null);
            if($add == "Success"){
                echo json_encode(array("status" =>"Success"));
            } else {
                echo json_encode(array("status" =>"Failed"));
            }
        }

    }

    elseif(isPost('update')=="Payment" && isPost('key')=="bKmsT267"){

        $proses = new Transaksi($db);
        $proses_kas = new Kas($db);

        $show   = $proses->editTransaksi(isPost('kd_transaksi'));
        $data = $show->fetch(PDO::FETCH_OBJ);

        $kd_transaksi = isPost('kd_transaksi');
        $kd_kas = isPost('kas');
        $sisa_pelunasan_lama = isPost('sisa_pelunasan');
        $pembayaran_lama = $data->pembayaran;
        $pembayaran_masuk = isPost('pembayaran');
        $pembayaran_baru = $pembayaran_lama + $pembayaran_masuk;
        $sisa_pelunasan = $sisa_pelunasan_lama - $pembayaran_masuk;
        $tanggal = date('Y-m-d H:i:s');
        $keterangan = '7/'.$kd_transaksi;

        if($pembayaran_masuk <= 0){
            // Pembayaran tidak boleh kurang dari 0
            echo json_encode(array("status" =>"Rejected"));             
        } else {
            $add = $proses->addPembayaran($kd_transaksi, $pembayaran_baru, $sisa_pelunasan);
            // Log System
            //$logs->addLog('ADDPAYMENT','tb_transaksi','Tambah data pembayaran',json_encode([$kd_transaksi, $pembayaran_baru, $sisa_pelunasan]),null);

            if($add == "Success"){
                $show_saldo = $proses_kas->editSaldo($kd_kas);
                $edit_saldo = $show_saldo->fetch(PDO::FETCH_OBJ);
                $saldo_baru = $edit_saldo->saldo + $pembayaran_masuk;

                $update_kas = $proses_kas->updateKas($kd_kas, $saldo_baru, $tanggal);
                $add_mutasi = $proses_kas->addMutasiKas($kd_kas, $pembayaran_masuk, 1, $tanggal, $keterangan);

                echo json_encode(array("status" =>"Success"));
            } else {
                echo json_encode(array("status" =>"Failed"));
            }
        }   

    }

    elseif(isPost('setlement')=="DP" && isPost('key')=="Cl12kPz0"){

        $kd_kas = isPost('kas');
        $setlement = isPost('setlement');
        $kd_transaksi = isPost('kd_transaksi');
        $status = 3;

        $proses_t = new Transaksi($db);
        $proses_k = new Kas($db);
        $show_t = $proses_t->showDpTransaksi($kd_transaksi);
        $show_k = $proses_k->editSaldo($kd_kas);
        $data_dp = $show_t->fetch(PDO::FETCH_OBJ);
        $data_s = $show_k->fetch(PDO::FETCH_OBJ);

        if($data_s->saldo < $setlement){
            // Saldo Kas tidak memenuhi
            echo json_encode(array("status" =>"Rejected1")); 
        } elseif ($setlement > $data_dp->dp){
            // Setlement melebihi DP
            echo json_encode(array("status" =>"Rejected2"));
        } elseif ($setlement == 0){
            $update = $proses_t->setlementDp($kd_transaksi, $setlement, $status);
    
            // Log System
             //$logs->addLog('Update','tb_transaksi','update setlement_Dp',json_encode([$kd_transaksi, $setlement, $status]),null);
            echo json_encode(array("status" =>"Success"));
        } elseif ($data_dp->dp >= $setlement){
            $tanggal = date('Y-m-d H:i:s');
            $keterangan = '8/'.$kd_transaksi;
            $saldo = $data_s->saldo - $setlement;

            $update = $proses_t->setlementDp($kd_transaksi, $setlement, $status);
            
            if($update == "Success"){
                // Log System
                //$logs->addLog('Update','tb_transaksi','update setlement_Dp',json_encode([$kd_transaksi, $setlement, $status]),null);
                $update_k = $proses_k->updateKas($kd_kas, $saldo, $tanggal);
                $add_m = $proses_k->addMutasiKas($kd_kas, $setlement, 2, $tanggal, $keterangan);
                echo json_encode(array("status" =>"Success"));
            }
        }

    }

 ?>