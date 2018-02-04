<?php
// Load file koneksi.php
require("proses/proses.php");

// Ambil data ID Provinsi yang dikirim via ajax post
$kd_unit = $_POST['unit'];

// Set defaultnya dengan tag option Pilih
$html = 0;

$Proses = new Proses();
$show = $Proses->showUnit();
while($data = $show->fetch(PDO::FETCH_OBJ)){
	$html .= $data->h_sewa_wd; // Tambahkan tag option ke variabel $html
}


$callback = array('data_harga_sewa'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota

echo json_encode($callback); // konversi varibael $callback menjadi JSON
?>
