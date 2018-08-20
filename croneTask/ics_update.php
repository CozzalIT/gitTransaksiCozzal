<?php

	require("../../config/database.php");
	require("../class/ics_unit.php");

	$unit = new Ics_unit($db);

	function getCount(){
		$isi = fread(fopen("../../inifiles/count_ics_update.ini","r"),filesize("../../inifiles/count_ics_update.ini"));
		fclose(fopen("../../inifiles/count_ics_update.ini","r"));
		return $isi;
	}

	function setValue($value){
	  $tmp = fopen("../../inifiles/count_ics_update.ini", "w");		
	  fwrite($tmp,$value);
	  fclose($tmp);
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
		return $local_file;
	}

	function loadIcs($kd_unit, $kd_apt, $kd_url, $url, $unit, $ICS, $no_unit){

		date_default_timezone_set('Asia/Jakarta');
		$sekarang = date('Y-m-d', strtotime('-90 Days'));

		$current_trx = array();
		$current_booked = array();

		// $show2 = $unit->showRecent_trx($kd_unit, $sekarang);
		// while($data2 = $show2->fetch(PDO::FETCH_OBJ)){
		// 	$current_trx[] = $data2->check_in; 
		// }

		$show2 = $unit->showRecent_booked($kd_unit, $sekarang);
		while($data2 = $show2->fetch(PDO::FETCH_OBJ)){
			$current_trx[] = $data2->check_in; 
			if($data2->status=="1"){
				$current_booked[] = $data2->check_in;
			}
		}
		
		$newEvent = array();

		$local_file = getlocalics($url, $kd_url);

		$ICS->change_file($local_file);

		$path = "../../inifiles/logICS_sys/".$no_unit.".ini";


		$icsEvents = $ICS->cal_to_array();
		for($i=0; $i<count($icsEvents); $i++){
			$tmp_arr = $icsEvents[$i];

			$penyewa_id = explode(' ', $tmp_arr['SUMMARY']);
			$penyewa = str_replace(" ".$penyewa_id[count($penyewa_id)-1], "", $tmp_arr['SUMMARY']);

			$newEvent[] = getformatingdate($tmp_arr['DTSTART;VALUE=DATE']);
			$check_in = getrealdate($tmp_arr['DTSTART;VALUE=DATE']);
			$check_out = getrealdate($tmp_arr['DTEND;VALUE=DATE']);
			if(!in_array(getformatingdate($tmp_arr['DTSTART;VALUE=DATE']), $current_trx) 
				&& ($check_in>=strtotime($sekarang) || $check_out>=strtotime($sekarang))){			
				if(isset($tmp_arr['PHONE'])){
					$unit->LogIcs(
						$path,date("Y-m-d h:i:sa")." Berhasil ".
						$penyewa." ".$check_in." - ".$check_out.
						"Sesuai Kriteria Pengecekan"
					);	

					$no_tlp = $tmp_arr['PHONE'];
					$check_in = getformatingdate($tmp_arr['DTSTART;VALUE=DATE']); 
					$check_out = getformatingdate($tmp_arr['DTEND;VALUE=DATE']); 
					$unit->createBooked($kd_unit, $kd_apt, $penyewa, $no_tlp, $check_in, $check_out, $kd_url);
				}
			} else {
				$unit->LogIcs(
					$path,date("Y-m-d h:i:sa")." Gagal ".
					$penyewa." ".$check_in." - ".$check_out.
					"Sudah Ada di Booked List"
				);
			}
		}
		for($i=0; $i<count($current_booked); $i++){
			if(!in_array($current_booked[$i],$newEvent)){
				$unit->cancelBooked($kd_unit, $current_booked[$i]);
				$unit->LogIcs(
					$path,date("Y-m-d h:i:sa")." Pembatalan pada tanggal ".
					$current_booked[$i]
				);				
			}
		}

		$ICS = null;
	}

	// $i adalah variable yang merepresantasikan urutan group yg akan di update
	$i = getCount();

	include '../class/ics.php';
	$ICS = new ICS("");
	$show = $unit->showURLbyGroup($i);
	while ($data = $show->fetch(PDO::FETCH_OBJ)) {
		loadICS($data->kd_unit, $data->kd_apt, $data->kd_url, $data->url, $unit, $ICS, $data->no_unit);
	}

	$i++;
	if($i>3){
		$i = 1;
	}
	setValue($i);
?>