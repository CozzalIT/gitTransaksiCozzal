<?php
ob_start();
session_start();
if(isset($_SESSION["username"])){
		$view = $_SESSION["hak_akses"];
		if($view="superadmin"){
			echo "In Progress";
			require("../../config/database.php");
			require("../class/penyewa.php");
			$penyewa = new Penyewa($db);
			echo "<br>Request data penyewa ...";
			$show = $penyewa->showPenyewa();
			$i= 1;
			while($data = $show->fetch(PDO::FETCH_OBJ)){
				$penyewa->updatePhoneNumber($data->kd_penyewa, $penyewa->setPhoneNumber($data->no_tlp));
				echo "<br>".$data->no_tlp." > ".$penyewa->setPhoneNumber($data->no_tlp);
			}
			echo "<br>Data Penyewa berhasil di update :)";
			header('Location:../view/'.$view.'/home/home.php');
		}
} else header('location:../index.php');

// require("../../config/database.php");
// require("../class/penyewa.php");
// $penyewa = new Penyewa($db);
// echo $penyewa->setPhoneNumber("+62 3232 123123 2332");
?>