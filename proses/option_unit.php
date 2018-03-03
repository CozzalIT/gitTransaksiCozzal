<?php
require("../../config/database.php");

if(isset($_POST['apartement'])){
require("../class/unit.php");
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
	require("../class/transaksi.php");
	$kd_unit = $_POST['id1'];
	$CI = $_POST['tci1'];
	$CO = $_POST['tco1'];
	$hasil = "Ada"; //tidak ada, maintenance, admin_block, owner_block
	$Proses = new Transaksi($db);
	$show = $Proses->showTransaksi_cek($CI,$CO,$kd_unit);
	if($show) $hasil="Unit yang dipilih telah terisi"; 
	else{
		$show = $Proses->is_blocked($CI,$CO,$kd_unit,'1');
		if($show) $hasil = "Unit yang dipilih sedang dalam maintenance";
		else{
			$show = $Proses->is_blocked($CI,$CO,$kd_unit,'2');
			if($show) $hasil = "Unit yang dipilih telah diblok oleh owner";
			else{
				$show = $Proses->is_blocked($CI,$CO,$kd_unit,'3');
				if($show) $hasil = "Unit yang dipilih telah diblok oleh admin";
			}
		}
	}
	$callback = array('ketersediaan'=>$hasil);
	echo json_encode($callback);
}

elseif(isset($_POST['owner']) || isset($_POST['get_owner'])){
	require("../class/account.php");
	$html = "<option value=''>-- Pilih Owner --</option>";
	$Proses = new Account($db);
	$show = $Proses->showOwner_byAccount();
	while($data = $show->fetch(PDO::FETCH_OBJ)){
		if($data->kd_owner!=0)
		$html .= "<option value='$data->kd_owner'>$data->nama</option>"; // Tambahkan tag option ke variabel $html
	}
	if (isset($_POST['owner'])) $html .= "<option value='null'>Relasikan Nanti</option>";
	$callback = array('pilihan_owner'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
	echo json_encode($callback); // konversi varibael $callback menjadi JSON
}

elseif(isset($_POST['status'])){
	require("../class/cleaner.php");
	$kd_unit = $_POST['status'];
    date_default_timezone_set('Asia/Jakarta');
    $sekarang = date('Y-m-d');
	$Proses = new Cleaner($db);
	$status = "Kosong";
	$show1 = $Proses->showStatus_check_in($kd_unit, $sekarang);
	if($show1==true){
		$status = "Check In";
	}
	else{
		$show2 = $Proses->showStatus_terisi($kd_unit, $sekarang);
		if($show2==true) $status = "Terisi";
	}
	require("../class/catatan.php");
	$proses2 = new Catatan($db); $catatan = 0;
	$migrate = $proses2->catatanToTask($kd_unit);
	$delete = $Proses->deleteUnit_kotor($kd_unit, $sekarang);
	$show = $proses2->showCatatanUnit($kd_unit);
	while($data = $show->fetch(PDO::FETCH_OBJ))
		$catatan++; 
	$callback = array('stat'=>$status, 'catatan'=>$catatan);
	echo json_encode($callback);
}
?>
