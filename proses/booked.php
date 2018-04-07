<?php
require("../../config/database.php");
require("../class/booked.php");
session_start();
$view = $_SESSION['hak_akses'];	

//tampilkan harga
if(isset($_POST['cek_harga'])){
	$kd_unit = $_POST['cek_harga'];
	$booked = new Booked($db);
	$tmp = $booked->getharga($kd_unit);
	$data = $tmp->fetch(PDO::FETCH_OBJ);
	$harga_wd = $data->h_sewa_wd;
	$harga_we = $data->h_sewa_we;
	$callback = array('we'=>$harga_we, 'wd'=>$harga_wd, 'ec'=>$data->ekstra_charge);
	echo json_encode($callback);

}

elseif(isset($_POST["getList"])){
	$nama = $_POST["getList"];
	$jenis = $_POST["jenis"];
	$arr_nama = explode(" ", $nama);
	$jumlah_kata = count($arr_nama);
	$html ="";
	$Proses = new Booked($db);
	$show1 = $Proses->getListPenyewa($jumlah_kata, $arr_nama, $jenis);
	while($data = $show1->fetch(PDO::FETCH_OBJ)){
		$html .= '<div id="'.$data->kd_penyewa.'" onclick="select(this);" style="cursor:pointer;" class="note list-penyewa">';
		$html .= '<strong>'.$data->nama.'</strong><br>'.$data->alamat.'<div style="text-align:right;float:right;">'.$data->no_tlp.'</div></div>';
	}
	if($html==""){
		$html = '<div class="note"> Tidak ditemukan penyewa </div>';
	}
	$callback = array('isi'=>$html);
	echo json_encode($callback);
}

elseif(isset($_POST['daftar_penyewa'])){
	require("../class/penyewa.php");
	$nama = $_POST["daftar_penyewa"];
	$alamat = $_POST["alamat"];
	$no_tlp = $_POST["no_tlp"];
	$jenis_kelamin = $_POST["jenis_kelamin"];
	$email = $_POST["email"];
	$tgl_gabung = date("Y-m-d");
	$penyewa = new Penyewa($db);
	$penyewa->addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung); 
	$callback = array('status'=>"oke");
	echo json_encode($callback);
}

elseif(isset($_POST["getPenyewa"])){
	$nama = $_POST["getPenyewa"];
	$no_tlp = $_POST["no_tlp"];
	$Proses = new Booked($db);
	$show1 = $Proses->getKd_penyewa($nama, $no_tlp);	
	$data = $show1->fetch(PDO::FETCH_OBJ);
	$callback = array('kd_penyewa'=>$data->penyewa);
	echo json_encode($callback);	
}

elseif(isset($_GET["hapus"]) && $view=="superadmin"){
	$kd_booked = $_GET["hapus"];
	$kd_unit = $_GET["unit"];
	$check_in = $_GET["ci"];
	$Proses = new Booked($db);
	$Proses->cancelBooked($kd_booked, $kd_unit, $check_in);
	header("location:../view/".$view."/booking/booked.php");
}

else {
	header("location:../view/".$view."/home/home.php");
}

?>