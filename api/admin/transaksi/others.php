<?php 
    require("../../../../config/database.php");
    require("../../../class/api_transaksi.php");

    function isPost($x){
    	if(isset($_POST[$x])){
    		return $_POST[$x];
    	} else {
    		die(json_encode(array("status" => "Incorrect Value")));
    	}
    }

    if(isPost("categories")=="availableUnit" && isPost("key")=="5pR1Ngdo"){

        $kd_apt = isPost("kd_apt");
        $CI = isPost("check_in");
        $CO = isPost("check_out");
        $proses = new Api_transaksi($db);
        $show = $proses->show_unitTersedia($kd_apt, $CI, $CO);
        $callback = array();
        while($data = $show->fetch(PDO::FETCH_OBJ)){
            $callback[] = array(
                    "kd_unit" => $data->kd_unit,
                    "no_unit" => $data->no_unit,
                    "h_sewa_wd" => $data->h_sewa_wd,
                    "h_sewa_we" => $data->h_sewa_we,
                    "h_sewa_mg" => $data->h_sewa_mg,
                    "h_sewa_bln" => $data->h_sewa_bln,
                    "h_owner_wd" => $data->h_owner_wd,
                    "h_owner_we" => $data->h_owner_we,
                    "h_owner_mg" => $data->h_owner_mg,
                    "h_owner_bln" => $data->h_owner_bln,
                    "ekstra_charge" => $data->ekstra_charge                    
            );
        }

        echo json_encode($callback);

    }

 ?>