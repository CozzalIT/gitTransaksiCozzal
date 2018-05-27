<?php
ob_start();
session_start();
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

if(isset($_SESSION["username"])){
		$view = $_SESSION["hak_akses"];
		if($view="superadmin"){
			echo "In Progress";
			require("../../config/database.php");
			require("../class/transaksi.php");
			$Proses = new Transaksi($db);
			$show = $Proses->showTransaksi_gen();
			while($data = $show->fetch(PDO::FETCH_OBJ)){
				$total  = $data->total_tagihan;
				$hari = $data->hari; 
				$check_in = $data->check_in;
				$kd_transaksi = $data->kd_transaksi;
				$harga_sewa_asli = $data->h_sewa_wd."/".$data->h_sewa_we;
				$week = date("w",strtotime($check_in))+1;
				if($week>5){ //jika dimuai dari weekend
				  $week_kind = explode("/",startinweekend($hari, $week, 0, 0));
				  $jumlah_weekday = $week_kind[0]; $jumlah_weekend = $week_kind[1]; 
				}
				else{ //jika dimulai dri weekday
				  if($week+$hari<7) {$jumlah_weekday=$hari;$jumlah_weekend=0;}
				  else {
				    $wd = 6 - $week;
				    $week_kind = explode("/",startinweekend($hari-$wd, 6, $wd, 0));
				    $jumlah_weekday = $week_kind[0]; $jumlah_weekend = $week_kind[1]; 
				  }
				}
				$harga_asli = explode("/", $harga_sewa_asli);
				if($total<(($harga_asli[0]*$jumlah_weekday)+($harga_asli[1]*$jumlah_weekend))){
				  $diskon = getDisCount($harga_sewa, $harga_sewa_we, $harga_sewa_asli, $jumlah_weekday, $jumlah_weekend, $total);
				} else {
				  $diskon = 0;
				}			
				// ----------------- Update data we wd ------------------
				$harga_sewa = $harga_asli[0];
				$harga_sewa_we = $harga_asli[1];
				$Proses->updateTransaksi_gen($kd_transaksi,$harga_sewa,$harga_sewa_we, $diskon, $jumlah_weekend, $jumlah_weekday);
			}

			$show = $Proses->showConfrim_gen();
			while($data = $show->fetch(PDO::FETCH_OBJ)){
				$total  = $data->total_tagihan;
				$hari = $data->hari; 
				$check_in = $data->check_in;
				$kd_confirm_transaksi = $data->kd_confirm_transaksi;
				$harga_sewa_asli = $data->h_sewa_wd."/".$data->h_sewa_we;
				$week = date("w",strtotime($check_in))+1;
				if($week>5){ //jika dimuai dari weekend
				  $week_kind = explode("/",startinweekend($hari, $week, 0, 0));
				  $jumlah_weekday = $week_kind[0]; $jumlah_weekend = $week_kind[1]; 
				}
				else{ //jika dimulai dri weekday
				  if($week+$hari<7) {$jumlah_weekday=$hari;$jumlah_weekend=0;}
				  else {
				    $wd = 6 - $week;
				    $week_kind = explode("/",startinweekend($hari-$wd, 6, $wd, 0));
				    $jumlah_weekday = $week_kind[0]; $jumlah_weekend = $week_kind[1]; 
				  }
				}
				$harga_asli = explode("/", $harga_sewa_asli);
				if($total<(($harga_asli[0]*$jumlah_weekday)+($harga_asli[1]*$jumlah_weekend))){
				  $diskon = getDisCount($harga_sewa, $harga_sewa_we, $harga_sewa_asli, $jumlah_weekday, $jumlah_weekend, $total);
				} else {
				  $diskon = 0;
				}			
				// ----------------- Update data we wd ------------------
				$Proses->updateConfrim_gen($kd_confirm_transaksi,$harga_asli[0],$harga_asli[1], $diskon, $jumlah_weekend, $jumlah_weekday);
			}
			header('Location:../view/'.$view.'/home/home.php');
		}
} else header('location:../index.php');
?>