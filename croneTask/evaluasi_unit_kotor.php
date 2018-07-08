<?php
	require("../../config/database.php");
	require("../class/unit.php");

	date_default_timezone_set('Asia/Jakarta');
	$mingguLalu = date('Y-m-d', strtotime("-1 week"));
	$Proses = new Unit($db);
	$show = $Proses->showTransaksi_byDate($mingguLalu);
	echo $mingguLalu."<br>";
	while($data = $show->fetch(PDO::FETCH_OBJ)){
		$exists = $Proses->is_UnitKotor_exists($data->kd_unit, $data->check_in, $data->check_out);
		if(!$exists){
			// $Proses->addUnit_kotor($data->kd_unit, $data->check_in, $data->check_out);
			echo $data->kd_unit."<<".$data->check_in."<<".$data->check_out."<br>"
		} else {
			echo $data->kd_unit.">>".$data->check_in.">>".$data->check_out."<br>"
		}
	}

?>