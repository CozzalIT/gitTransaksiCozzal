<?php
	require("../../config/database.php");
	require("../class/cleaner.php");
	require("../class/ics_unit.php");

	date_default_timezone_set('Asia/Jakarta');

	// menghapus unit kotor yang sudah lewat dari 1 minggu kebelakang
	$mingguLalu = date('Y-m-d', strtotime("-1 week"));
	$Proses = new Cleaner($db);
	$Proses->deleteUnit_kotor_weekly($mingguLalu);

	// menghapus daftar booked yang check out nya sudah lewat 3 bulan kebelakang'
	$bulan3 = date('Y-m-d', strtotime('-90 Days'));
	$Proses = new Ics_unit($db);
	$Proses->deleteTrash_booked($bulan3);

?>