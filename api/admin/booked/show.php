<?php 

    require("../../../class/booking.php");
    require("../../../class/booked.php");
    require("../../../class/penyewa.php");
    require("../../../class/transaksi.php");
    require("../../../../config/database.php");
    require("../../../class/search.php");


    $hari = 0;
    $week_pos = 0;
    $h_we = 0;
    $h_wd = 0;

    function isPost($x, $check = false){
        if(isset($_POST[$x])){
            return $_POST[$x];
        } else {
            if($check) return "";
            else die(json_encode(array("status" => "Incorrect Value ".$x)));
        }
    }

    function startinweekend($hari, $week, $jumlah_weekday, $jumlah_weekend){
      $we =0; $wd = $hari+5;
      while($wd>5){
        $we = 8-$week; $hari = $wd-5;
        if($hari==1){
          $we=1;
        }
        $wd=$hari-$we;
        $jumlah_weekend = $jumlah_weekend+$we;
        if($wd>5) {
          $jumlah_weekday = $jumlah_weekday+5;
        } else{
          $jumlah_weekday = $jumlah_weekday+$wd;
        }
      }
      return $jumlah_weekday."/".$jumlah_weekend;
    }

    function explain_days($CI,$CO){
        $_CI = new DateTime($CI);
        $_CO = new DateTime($CO);
        $diff = $_CI->diff($_CO);

        $GLOBALS["hari"] = $diff->days;
        $GLOBALS["week_pos"] = date("w",strtotime($CI))+1;
        
          $week = $GLOBALS["week_pos"];
          $hari = $GLOBALS["hari"];
          if($week>5){ //jika dimulai dari weekend
            $week_kind = explode("/",startinweekend($hari, $week, 0, 0));
            $GLOBALS["h_wd"] = $week_kind[0]; $GLOBALS["h_we"] = $week_kind[1];
          }else{ //jika dimulai dri weekday
            if($week+$hari<7){
              $GLOBALS["h_wd"] = $hari;
              $GLOBALS["h_we"] = 0;
            }else{
              $wd = 6 - $week;
              $week_kind = explode("/",startinweekend($hari-$wd, 6, $wd, 0));
              $GLOBALS["h_wd"] = $week_kind[0];
              $GLOBALS["h_we"] = $week_kind[1];
            }
          }


    }


    function ownerPrice($h_owner_wd, $h_owner_mg, $h_owner_bln){
        $h = $GLOBALS["hari"];
        if($h>6){
            if($h>28){
                $x = floor($h/28);
                return $h_owner_bln * $x;
            } else {
                $x = floor($h/7);
                $y = $h - (7*$x);
                return ($h_owner_mg*$x) + ($h_owner_wd*$y);
            }
        } else  {
            return 0;
        }
    }

    function deposite(){
        $h = $GLOBALS["hari"];
        if($h>28) return 2000000; else return 0;
    }

    function price_gbg($harga_sewa, $harga_sewa_we, $harga_sewa_mg, $harga_sewa_bln){
        $h = $GLOBALS["hari"];
        $h_wd = $GLOBALS["h_wd"];
        $h_we = $GLOBALS["h_we"];
        if($h>6){
            if($h>28){
                $x = floor($h/28);
                return $harga_sewa_bln * $x;
            } else {
                $x = floor($h/7);
                $y = $h - (7*$x);
                return ($harga_sewa_mg*$x) + ($harga_sewa*$y);
            }
        } else  {
            return ($harga_sewa*$h_wd)+($harga_sewa_we*$h_we);
        }        
    }

// -------------------------------------------------------------------------


    if(isPost("info", true)=="ListBooked" && isPost("key", true)=="2xBDoQcy"){

        $Proses = new Booking($db);
        $callback = [];
        $show = $Proses->showBooked_byURL();
        while($data = $show->fetch(PDO::FETCH_OBJ)){
            if($data->status=='1'){
                if($data->title!="") $title = $data->title;
                else $title = 'Unlisted';
                $callback[] = array(
                    "nama_penyewa" => $data->penyewa,
                    "no_tlp" => $data->no_tlp,
                    "nama_apt" => $data->nama_apt,
                    "no_unit" => $data->no_unit,
                    "check_in" => $data->check_in,
                    "check_out" => $data->check_out,
                    "kd_booked" => $data->kd_booked,
                    "kd_unit" => $data->kd_unit,
                    "title" => $title
                );                
            }
        }        
        echo json_encode($callback);

    }

    elseif(isPost("info", true)=="search" && isPost("key", true)=="2xBDoQcx"){

        $keyword = isPost("keyword");
        $Proses = new Search($db);
        $callback = [];
        $show = $Proses->booked($keyword);
        while($data = $show->fetch(PDO::FETCH_OBJ)){
            if($data->status=='1'){
                if($data->title!="") $title = $data->title;
                else $title = 'Unlisted';
                $callback[] = array(
                    "nama_penyewa" => $data->penyewa,
                    "no_tlp" => $data->no_tlp,
                    "nama_apt" => $data->nama_apt,
                    "no_unit" => $data->no_unit,
                    "check_in" => $data->check_in,
                    "check_out" => $data->check_out,
                    "kd_booked" => $data->kd_booked,
                    "kd_unit" => $data->kd_unit,
                    "title" => $title
                );                
            }
        }        
        echo json_encode($callback);

    }

    elseif(isPost("info", true)=="detailBookedPenyewa" && isPost("key", true)=="j12O2nKl1"){

        $Proses = new Booked($db);
        $kd_booked = isPost('kd_booked');
        $show = $Proses->showDetail_booked($kd_booked);
        $edit = $show->fetch(PDO::FETCH_OBJ);

        $Proses2 = new Transaksi($db);
        $is_exist = $Proses2->showTransaksi_cek($edit->check_in,$edit->check_out,$edit->kd_unit);   
        if($is_exist){
            die(json_encode(["status"=>'rejected', "description" => "Transaksi tersebut telah terisi", "data" => [], "suggest" => []]));
        } else {
            $is_blocked = $Proses2->is_blocked_all($edit->check_in,$edit->check_out,$edit->kd_unit);
            if($is_blocked){
                die(json_encode(["status"=>'rejected', "description" => "Transaksi tersebut telah terblokir", "data" => [], "suggest" => []]));        
            }
        }  

        $proses = new Penyewa($db);
        $show = $proses->showPenyewa_cek($proses->setPhoneNumber($edit->penyewa),$edit->no_tlp,"");
        $indicated = [];
        while($data = $show->fetch(PDO::FETCH_OBJ)){
            $indicated[] = [
                "id" => $data->kd_penyewa, "nama" => $data->nama, "alamat"=>$data->alamat, 
                "no_tlp" => $data->no_tlp, "jenis_kelamin" => $data->jenis_kelamin, "email" => $data->email
            ];
        }

        $callback = ["nama" => $edit->penyewa, "no_tlp" => $edit->no_tlp, "email" => "guest@airbnb.com"];

        echo json_encode(array("status"=>'accepted', "description" => "Transaksi dapat dilanjutkan", "data" => [$callback], "suggest"=>$indicated);

    }

    elseif(isPost("info", true)=="detailBooked" && isPost("key", true)=="1xBxoQdm"){

        $Proses = new Booked($db);
        $kd_booked = isPost('kd_booked');
        $show = $Proses->showDetail_booked($kd_booked);
        $edit = $show->fetch(PDO::FETCH_OBJ);

        $kd_unit = $edit->kd_unit;
        $tmp = $Proses->getharga($kd_unit);
        $data = $tmp->fetch(PDO::FETCH_OBJ);

        explain_days($edit->check_in,$edit->check_out);

        $harga_sewa = ($hari<7 ? $data->h_sewa_wd*$h_wd : 0);
        $harga_sewa_we = ($hari<7 ? $data->h_sewa_we*$h_we : 0);
        $harga_sewa_gbg = price_gbg($data->h_sewa_wd, $data->h_sewa_we, $data->h_sewa_mg, $data->h_sewa_bln);
        $harga_sewa_asli = $data->h_sewa_wd."&".$data->h_sewa_we;
        $h_owner_gbg = ownerPrice($data->h_owner_wd,$data->h_owner_mg,$data->h_owner_bln);

        echo json_encode([
            "check_in" => $edit->check_in, "check_out" => $edit->check_out, "kd_unit" => $edit->kd_unit,
            "kd_apt" => $edit->kd_apt, "no_unit" =>$edit->no_unit, "nama_apt" => $edit->nama_apt,
            "ekstra_charge" => $data->ekstra_charge*1, "harga_sewa" => $harga_sewa, "harga_sewa_we" => $harga_sewa_we,
            "harga_sewa_gbg" => $harga_sewa_gbg, "harga_sewa_asli" => $harga_sewa_asli, "harga_owner_gbg" => $h_owner_gbg,
            "deposite" => deposite(), "kd_booked" => $kd_booked 
        ]);     

    }


 ?>