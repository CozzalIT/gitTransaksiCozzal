<?php 

    require("../../../class/penyewa.php");
    require("../../../../config/database.php");

    function isPost($x){
    	if(isset($_POST[$x])){
    		return $_POST[$x];
    	} else {
    		die(json_encode(array("status" => "Incorrect Value")));
    	}
    }

    if(isPost("info")=="ListPenyewa" && isPost("key")=="2xBDZ97y"){

        $proses = new Penyewa($db);
        $show = $proses->showPenyewa();
        $callback = array();
        while($data = $show->fetch(PDO::FETCH_OBJ)){
            $callback[] = array(
                    "kd_penyewa" => $data->kd_penyewa,
                    "nama" => $data->nama,
                    "alamat" => $data->alamat,,
                    "no_tlp" => $data->no_tlp,
                    "jenis_kelamin" => $jenis_kelamin,
                    "email" => $data->email,
                    "tgl_gabung" => $data->tgl_gabung
            );
        }
        echo json_encode($callback);
    }

    elseif(isPost("info")=="Cek_Ketersediaan_Penyewa" && isPost("key")=="adPZ19zz"){

        $proses = new Penyewa($db);
        $show = $proses->showPenyewa_cek($_POST["cek_penyewa"],$_POST["no_tlp"],$_POST["alamat"]);
        $callback = array();
        while($data = $show->fetch(PDO::FETCH_OBJ)){
            $callback[] = array('kd_penyewa'=>$data->kd_penyewa,
                        'nama'=>$data->nama,
                        'jenis_kelamin'=>$data->jenis_kelamin,
                        'alamat'=>$data->alamat,
                        'email'=>$data->email,
                        'no_tlp'=>$data->no_tlp);
            }

        echo json_encode(array(
            "status" => (count($callback)==0 ? "Empty":"Exists"),
            "sugested_tenants" => $callback
        ));
    }

 ?>