<?php
require("../../config/database.php");

if(isset($_POST['apartement'])){
require("../../class/unit.php");
// Ambil data ID Provinsi yang dikirim via ajax post
$kd_apt = $_POST['apartement'];
$nil = $_POST['par'];

// Set defaultnya dengan tag option Pilih
$html = "<option value=''>-- Pilih Unit --</option>";

$Proses = new Unit($db);
$show = $Proses->showUnit();
while($data = $show->fetch(PDO::FETCH_OBJ)){
	if ($data->kd_apt==$kd_apt){ $val=$data->kd_unit.'+'.$data->h_sewa_wd.'+'.$data->h_sewa_we.'+'.$data->ekstra_charge;
	$html .= "<option name='kd_unit' value='$val'>$data->no_unit</option>"; // Tambahkan tag option ke variabel $html
	}
}

$callback = array('data_unit'=>$html, 'nilai'=>$nil); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota

echo json_encode($callback); // konversi varibael $callback menjadi JSON
}

//cek ketersediaan unit pada tanggal tertentu
elseif(isset($_POST['id1'])){
	require("../../class/transaksi.php");
	$kd_unit = $_POST['id1'];
	$CI = $_POST['tci1'];
	$CO = $_POST['tco1'];
	$hasil = "Tidak Ada";
	$flag = 0;
	$Proses = new Transaksi($db);
	$show = $Proses->showTransaksi_cek($CI,$CO,$kd_unit);
	while($data = $show->fetch(PDO::FETCH_OBJ)){
	$flag++;	
	}
	if($flag==0) $hasil = "Ada";
	$callback = array('ketersediaan'=>$hasil); 
	echo json_encode($callback); 
}

//cek ketersediaan informasi detail unit
elseif(isset($_POST['detail'])){
	require("../../class/unit.php");
	$kd_unit = $_POST['detail'];
	$flag = 0; 
	$namaunit = '';
	$hasil = "Ada";
	$Proses = new Unit($db);
	$show = $Proses->showDetail_Unit($kd_unit);
	while($data = $show->fetch(PDO::FETCH_OBJ)){
	$flag++; 	
	}
	if($flag==0) $hasil = "Tidak Ada";
	$callback = array('ketersediaan'=>$hasil); 
	echo json_encode($callback); 
}

else{
	$hasil = '';
		$callback = array('ketersediaan'=>$hasil); 
	echo json_encode($callback); 
}

?>
