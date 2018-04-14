<?php

require("../../config/database.php");
require("../class/ics_unit.php");

function getformatingdate($date){
	$tahun = $date[0].$date[1].$date[2].$date[3];
	$bulan = $date[4].$date[5];
	$tanggal = $date[6].$date[7];
	return $tahun."-".$bulan."-".$tanggal;
}

function getrealdate($date){
	return strtotime(getformatingdate($date));
}

function getlocalics($url, $kd_unit){	
	$local_file = "../../listicscache/".$kd_unit.".ics";
	$remote_file  = $url; // url nya
	$ch = curl_init();
	$fp = fopen($local_file,"w"); // mungkin pake yg "w" aja
	$ch = curl_init($remote_file);
	curl_setopt($ch, CURLOPT_TIMEOUT, 50);
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_ENCODING, "");
	curl_exec($ch);
	curl_close($ch);
	fclose($fp);
	return "../../listicscache/".$kd_unit.".ics";
}

if(isset($_POST['cek_by_id'])){
	$kd_unit = $_POST['cek_by_id'];
	$kd_apt = $_POST['kd_apt'];
	$url_bnb = $_POST['url_bnb'];
	date_default_timezone_set('Asia/Jakarta');
	$sekarang = date('Y-m-d', strtotime('-90 Days'));
	$current_trx = array();
	$current_booked = array();

	$unit = new Ics_unit($db);
	$show2 = $unit->showRecent_trx($kd_unit, $sekarang);
	while($data2 = $show2->fetch(PDO::FETCH_OBJ)){
		$current_trx[] = $data2->check_in; 
	}

	$show2 = $unit->showRecent_booked($kd_unit, $sekarang);
	while($data2 = $show2->fetch(PDO::FETCH_OBJ)){
		$current_trx[] = $data2->check_in; 
		$current_booked[] = $data2->check_in;
	}
	
	require("../class/ics.php");
	$newEvent = array();
	//$ICS = new ICS($url_bnb);
	$ICS = new ICS(getlocalics($url_bnb, $kd_unit));
	$icsEvents = $ICS->cal_to_array();
	for($i=0; $i<count($icsEvents); $i++){
		$tmp_arr = $icsEvents[$i];
		$newEvent[] = getformatingdate($tmp_arr['DTSTART;VALUE=DATE']);
		$check_in = getrealdate($tmp_arr['DTSTART;VALUE=DATE']);
		$check_out = getrealdate($tmp_arr['DTEND;VALUE=DATE']);
		if(!in_array(getformatingdate($tmp_arr['DTSTART;VALUE=DATE']), $current_trx) 
			&& ($check_in>=strtotime($sekarang) || $check_out>=strtotime($sekarang))){
			$penyewa_id = explode(' ', $tmp_arr['SUMMARY']);
			$penyewa = str_replace(" ".$penyewa_id[count($penyewa_id)-1], "", $tmp_arr['SUMMARY']);
			if(isset($tmp_arr['PHONE'])){
				$no_tlp = $tmp_arr['PHONE'];
				$check_in = getformatingdate($tmp_arr['DTSTART;VALUE=DATE']); 
				$check_out = getformatingdate($tmp_arr['DTEND;VALUE=DATE']); 
				$unit->createBooked($kd_unit, $kd_apt, $penyewa, $no_tlp, $check_in, $check_out);
				//echo $kd_unit."><".$kd_apt."><".$penyewa."><".$no_tlp."><".$check_in."><".$check_out."<br>";
			}
		}
	}
	for($i=0; $i<count($current_booked); $i++){
		if(!in_array($current_booked[$i],$newEvent)){
			$unit->cancelBooked($kd_unit, $current_booked[$i]);
		}
	}
	$callback = array('status'=>'done');
	echo json_encode($callback);
}
?>