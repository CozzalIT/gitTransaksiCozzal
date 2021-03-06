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
	$keyword = $_POST["getList"];
	$html ="";
	$Proses = new Booked($db);
	$show1 = $Proses->getListPenyewa($keyword);
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
	$penyewa = new Penyewa($db);
	$nama = $_POST["daftar_penyewa"];
	$alamat = $_POST["alamat"];
	$no_tlp = $penyewa->setPhoneNumber($_POST["no_tlp"]);
	$jenis_kelamin = $_POST["jenis_kelamin"];
	$email = $_POST["email"];
	$tgl_gabung = date("Y-m-d");
	$data = $penyewa->addPenyewa2($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung);

	if($penyewa!="Failed"){
		$callback = array('status'=>$data);
	} else {
		$callback = array('status'=>"gagal");
	}
	// Log System
	////$logs->addLog('ADD','tb_penyewa','Tambah penyewa',json_encode([$nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung]),null);
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

elseif(isset($_POST['get_ListUnit'])){
	require("../class/ics_unit.php");
	$Proses = new Ics_unit($db);
	$show = $Proses->showUnit2();
	$unit = array();
	while ($data = $show->fetch(PDO::FETCH_OBJ)) {
		$unit[] = $data->kd_unit." * ".$data->kd_apt." * ".$data->no_unit." * ".$data->nama_apt;
	}
	$callback = array('prop'=>implode(" ^ ",$unit));
	echo json_encode($callback);
}

elseif(isset($_GET["hapus"]) && $view!="owner" && $view!="cleaner"){
	$kd_booked = $_GET["hapus"];
	$kd_unit = $_GET["unit"];
	$check_in = $_GET["ci"];
	$Proses = new Booked($db);
	$Proses->hapusBooked($kd_booked, $kd_unit, $check_in);
	header("location:../view/".$view."/booking/booked.php");
}

elseif(isset($_GET["deleteRoot"]) && $view!="owner" && $view!="cleaner"){
	$kd_booked = $_GET["deleteRoot"];
	$kd_unit = $_GET["unit"];
	$check_in = $_GET["ci"];
	$Proses = new Booked($db);
	$Proses->delete_booked_root($kd_booked, $kd_unit, $check_in);
	header("location:../view/".$view."/booking/booked.php");
}

else {
	header("location:../view/".$view."/home/home.php");
}

?>
