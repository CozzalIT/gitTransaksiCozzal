<?php
require("../../config/database.php");

//cek ketersediaan unit pada tanggal tertentu
if(isset($_POST['ajx_id'])){
	require("../class/catatan.php");
	$kd_unit = $_POST['ajx_id'];
	$jumlah = 0; $html = "";
	$val = "'#del'"; $but = "'#del-note'";
	$Proses = new Catatan($db);
	$show = $Proses->showCatatanUnit($kd_unit);
	while($data = $show->fetch(PDO::FETCH_OBJ)){
	$kd = "'".$data->kd_catatan."'";
	$jumlah++;
		$html .= '<div class="note" id="'.$data->kd_catatan.'">';
		$html .= ' <a class="close" onclick="$('.$val.').text('.$kd.'); $('.$but.').click();">×</a>';
		$html .= $data->catatan.'</div>';
	}

	if($jumlah==0) $html = '<div id="empty-note" class="note">Tidak tersedia catatan pada unit ini.</div>';
	$callback = array('konten'=>$html, 'jumlah'=>$jumlah);
	echo json_encode($callback);
}

elseif(isset($_POST['addNote'])){
	require("../class/catatan.php");
	$kd_unit = $_POST['addNote'];
	$catatan = $_POST['Note'];
	$Proses = new Catatan($db);
	$add = $Proses->addCatatan($kd_unit, $catatan);
	if($add=="Success"){
		$showLast = $Proses->showLastnote($kd_unit);
		$data = $showLast->fetch(PDO::FETCH_OBJ);
		$kd_catatan = $data->kd_catatan;
	} else $kd_catatan='Gagal';
	$callback = array('res'=>$kd_catatan);
	echo json_encode($callback);
}

elseif(isset($_POST['hapus_catatan'])){
	require("../class/catatan.php");
	$kd_catatan = $_POST['hapus_catatan'];
	$Proses = new Catatan($db);
	$del = $Proses->deleteCatatan($kd_catatan);
	$callback = array('res'=>$kd_catatan);
	echo json_encode($callback);
}

?>
