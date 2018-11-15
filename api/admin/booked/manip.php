<?php 

    require("../../../class/booked.php");
    require("../../../../config/database.php");


    function isPost($x){
    	if(isset($_POST[$x])){
    		return $_POST[$x];
    	} else {
    		die(json_encode(array("status" => "Incorrect Value")));
    	}
    }

    if(isPost("action")=="delete" && isPost("key")=="bsdfqSkP"){

        $kd_booked = isPost('kd_booked');
        $kd_unit = isPost('kd_unit');
        $check_in = isPost('check_in');
        $Proses = new Booked($db);
        $Proses->delete_booked_root($kd_booked, $kd_unit, $check_in);
    
        echo json_encode(array("status"=>"Success"));

    } 

    elseif(isPost("action")=="ignore" && isPost("key")=="bsdfqSkP"){

        $kd_booked = isPost('kd_booked');
        $kd_unit = isPost('kd_unit');
        $check_in = isPost('check_in');
        $Proses = new Booked($db);
        $Proses->hapusBooked($kd_booked, $kd_unit, $check_in);
    
        echo json_encode(array("status"=>"Success"));

    } 

 ?>