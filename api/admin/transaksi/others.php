<?php 
    require("../../../../config/database.php");
    require("../../../class/api_transaksi.php");

    $hari = 0;
    $week_pos = 0;
    $h_we = 0;
    $h_wd = 0;

    function isPost($x){
    	if(isset($_POST[$x])){
    		return $_POST[$x];
    	} else {
    		die(json_encode(array("status" => "Incorrect Value")));
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

    if(isPost("categories")=="availableUnit" && isPost("key")=="5pR1Ngdo"){

        $kd_apt = isPost("kd_apt");
        $CI = isPost("check_in");
        $CO = isPost("check_out");

        explain_days($CI,$CO);

        $proses = new Api_transaksi($db);
        $show = $proses->show_unitTersedia($kd_apt, $CI, $CO);
        $callback = array();
        while($data = $show->fetch(PDO::FETCH_OBJ)){
            $callback[] = array(
                    "kd_unit" => $data->kd_unit,
                    "no_unit" => $data->no_unit,
                    "harga_sewa" => ($hari<7 ? $data->h_sewa_wd*$h_wd : 0),
                    "harga_sewa_we" => ($hari<7 ? $data->h_sewa_we*$h_we : 0),
                    "harga_sewa_gbg" => price_gbg($data->h_sewa_wd, $data->h_sewa_we, $data->h_sewa_mg, $data->h_sewa_bln),
                    "harga_sewa_asli"=> $data->h_sewa_wd."&".$data->h_sewa_we,
                    "h_owner_gbg" => ownerPrice($data->h_owner_wd,$data->h_owner_mg,$data->h_owner_bln),
                    "deposite" => deposite(),
                    "ekstra_charge" => $data->ekstra_charge                    
            );
        }

        echo json_encode($callback);

    }

 ?>