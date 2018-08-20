<?php 
// file_put_contents('./log_'.date("j.n.Y").'.log', $log, FILE_APPEND);

function fn($value)
{
	return $value;
}

$filee = fn(
			date("Y-m-d h:i:sa").
			"Berhasil".
			"Penyewa Mana".
			"Tanggal Checkin - Tanggal Checkout"
		);
echo file_put_contents("ini.ini",$filee."\n",FILE_APPEND);
?>