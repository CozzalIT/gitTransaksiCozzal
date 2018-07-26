<?php
    require("../class/owner.php");
    require("../../config/database.php");

    if(isset($_POST['confirm']) && $_POST['key']=="sf7qjka"){
		$kd_owner_payment =  $_POST['confirm'];
		$status = 4;
		$proses_o = new Owner($db);
		$update_o = $proses_o->modStatusOwnerPayment($kd_owner_payment, $status);
		echo json_encode(array("status":"oke")); 
    } elseif (isset($_POST['reject']) && $_POST['key']=="sF7qjka"){
		$kd_owner_payment =  $_POST['reject'];
		$status = 3;
		$proses_o = new Owner($db);
		$update_o = $proses_o->modStatusOwnerPayment($kd_owner_payment, $status);
		echo json_encode(array("status":"oke")); 
    }
?>