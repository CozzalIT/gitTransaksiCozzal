<?php 

    require("../../../class/penyewa.php");
    require("../../../class/transaksi.php");
    require("../../../../config/database.php");


    function isPost($x){
    	if(isset($_POST[$x])){
    		return $_POST[$x];
    	} else {
    		die(json_encode(array("status" => "Incorrect Value")));
    	}
    }

    if(isPost("input")=="PenyewaByTransaksi" && isPost("key")=="7asLzP20"){

        $nama = isPost('nama');
        $alamat = isPost('alamat');
        $no_tlp = isPost('no_tlp');
        $jenis_kelamin = isPost('jenis_kelamin');
        $email = isPost('email');
        $tgl_gabung = date('y-m-d');

        $proses = new Penyewa($db);
        $add = $proses->addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung);

        // Log System
        //$logs->addLog('ADD','tb_penyewa','Tambah data penyewa',json_encode([$nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung]),null);
        $proses = new Transaksi($db);
        $show = $proses->showPenyewaTransaksi();
        $data = $show->fetch(PDO::FETCH_OBJ);

        if($add == "Success"){
            echo json_encode(array("status"=>"Success", "id_penyewa"=>$data->kd_penyewa));
        } else {
            echo json_encode(array("status"=>"Failed"));
        }
    } 

 ?>