<?php

	require("../../config/database.php");
	require("../class/ics_unit.php");

	$unit = new Ics_unit($db);

	function saveToTmp($kd_unit, $kd_apt, $penyewa, $no_tlp, $check_in, $check_out, $kd_url){
	    $sql = "INSERT into tb_booked VALUES (null, '$kd_unit', '$kd_apt', '$penyewa', '$no_tlp', 
	    '$check_in','$check_out', '2', '$kd_url')";	   
	    $GLOBALS['db']->query($sql);  
	}

	function getformatingdate($date){
		$tahun = $date[0].$date[1].$date[2].$date[3];
		$bulan = $date[4].$date[5];
		$tanggal = $date[6].$date[7];
		return $tahun."-".$bulan."-".$tanggal;
	}

	function getrealdate($date){
		return strtotime(getformatingdate($date));
	}

	function getlocalics($url, $kd_url){	
		$local_file = "../../listics/cache/".$kd_url.".ics";
		return $local_file;
	}

	function loadIcs($kd_unit, $kd_apt, $kd_url, $url, $unit, $ICS){

		date_default_timezone_set('Asia/Jakarta');
		$sekarang = date('Y-m-d', strtotime('-90 Days'));

		$current_booked = array();

		$show2 = $unit->showRecent_booked($kd_unit, $sekarang);
		while($data2 = $show2->fetch(PDO::FETCH_OBJ)){
			$current_booked[] = $data2->check_in;
		}
		
		$newEvent = array();

		$local_file = getlocalics($url, $kd_url);

		$ICS->change_file($local_file);

		$icsEvents = $ICS->cal_to_array();
		for($i=0; $i<count($icsEvents); $i++){
			$tmp_arr = $icsEvents[$i];
			$newEvent[] = getformatingdate($tmp_arr['DTSTART;VALUE=DATE']);
			$check_in = getrealdate($tmp_arr['DTSTART;VALUE=DATE']);
			$check_out = getrealdate($tmp_arr['DTEND;VALUE=DATE']);
			if(!in_array(getformatingdate($tmp_arr['DTSTART;VALUE=DATE']), $current_booked) 
				&& ($check_in>=strtotime($sekarang) || $check_out>=strtotime($sekarang))){
				$penyewa_id = explode(' ', $tmp_arr['SUMMARY']);
				$penyewa = str_replace(" ".$penyewa_id[count($penyewa_id)-1], "", $tmp_arr['SUMMARY']);
				if(isset($tmp_arr['PHONE'])){
					$no_tlp = $tmp_arr['PHONE'];
					$check_in = getformatingdate($tmp_arr['DTSTART;VALUE=DATE']); 
					$check_out = getformatingdate($tmp_arr['DTEND;VALUE=DATE']); 
					
					saveToTmp($kd_unit, $kd_apt, $penyewa, $no_tlp, $check_in, $check_out, $kd_url);
				}
			}
		}
	}

	include '../class/ics.php';
	$ICS = new ICS("");
	$show = $unit->showURLbyGroup(1);
	while ($data = $show->fetch(PDO::FETCH_OBJ)) {
		loadICS($data->kd_unit, $data->kd_apt, $data->kd_url, $data->url, $unit, $ICS);
	}

	$show = $unit->showURLbyGroup(2);
	while ($data = $show->fetch(PDO::FETCH_OBJ)) {
		loadICS($data->kd_unit, $data->kd_apt, $data->kd_url, $data->url, $unit, $ICS);
	}

	$show = $unit->showURLbyGroup(3);
	while ($data = $show->fetch(PDO::FETCH_OBJ)) {
		loadICS($data->kd_unit, $data->kd_apt, $data->kd_url, $data->url, $unit, $ICS);
	}	

?>