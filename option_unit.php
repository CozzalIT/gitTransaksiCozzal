<?php
require("proses/proses.php");

// Ambil data ID Provinsi yang dikirim via ajax post
$kd_apt = $_POST['apartement'];
$nil = $_POST['par'];

// Set defaultnya dengan tag option Pilih
$html = "<option value=''>-- Pilih Unit --</option>";

$Proses = new Proses();
$show = $Proses->showUnit();
while($data = $show->fetch(PDO::FETCH_OBJ)){
	if ($data->kd_apt==$kd_apt){ $val=$data->kd_unit.'+'.$data->h_sewa_wd.'+'.$data->h_sewa_we.'+'.$data->ekstra_charge;
	$html .= "<option name='kd_unit' value='$val'>$data->no_unit</option>"; // Tambahkan tag option ke variabel $html
	}
}

$callback = array('data_unit'=>$html, 'nilai'=>$nil); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota

echo json_encode($callback); // konversi varibael $callback menjadi JSON
?>
