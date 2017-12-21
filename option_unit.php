<?php
// Load file koneksi.php
 require("proses/proses.php");

// Ambil data ID Provinsi yang dikirim via ajax post
$kd_apt = $_POST['apartemen'];

// Buat variabel untuk menampung tag-tag option nya
// Set defaultnya dengan tag option Pilih
$html = "<option value=''>-- Pilih Unit --</option>";

$Proses = new Proses();
$show = $Proses->showUnit();
while($data = $show->fetch(PDO::FETCH_OBJ)){
	$html .= "<option name='kd_unit' value='$data->kd_unit'>$data->no_unit</option>"; // Tambahkan tag option ke variabel $html
}

$callback = array('data_unit'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota

echo json_encode($callback); // konversi varibael $callback menjadi JSON
?>
