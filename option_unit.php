<?php
// Load file koneksi.php
include "config.php";

// Ambil data ID Provinsi yang dikirim via ajax post
$kd_apt = $_POST['apartemen'];

// Buat query untuk menampilkan data kota dengan provinsi tertentu (sesuai yang dipilih user pada form)
$sql = $pdo->prepare("SELECT * FROM tb_unit WHERE kd_apt='".$kd_apt."' ORDER BY no_unit");
$sql->execute(); // Eksekusi querynya

// Buat variabel untuk menampung tag-tag option nya
// Set defaultnya dengan tag option Pilih
$html = "<option value=''>-- Pilih Unit --</option>";

while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
	$html .= "<option name='kd_unit' value='".$data['kd_unit']."'>".$data['no_unit']."</option>"; // Tambahkan tag option ke variabel $html
}

$callback = array('data_unit'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota

echo json_encode($callback); // konversi varibael $callback menjadi JSON
?>
