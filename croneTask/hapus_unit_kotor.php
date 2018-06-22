<?php
	require("../../config/database.php");
	require("../class/cleaner.php");

	date_default_timezone_set('Asia/Jakarta');
	$mingguLalu = date('Y-m-d', strtotime("-1 week"));
	$Proses = new Cleaner($db);
	$Proses->deleteUnit_kotor_weekly($mingguLalu);
?>