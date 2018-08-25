<?php 

    require("../../../class/transaksi.php");
    require("../../../class/transaksi_umum.php");
    require("../../../class/unit.php");
    require("../../../class/owner.php");
    require("../../../class/kas.php");
    require("../../../../config/database.php");

    function isPost($x){
    	if(isset($_POST[$x])){
    		return $_POST[$x];
    	} else {
    		die(json_encode(array("status" => "Incorrect Value")));
    	}
    }

    if(isPost("info")=="laporan_transaksi_umum" && isPost("key")=="41ggy12k"){

    	$Proses = new TransaksiUmum($db);
    	$start_rec = isPost("start_rec");
    	$length = isPost("length");
        $show = $Proses->showTransaksiUmum_pag($start_rec,$length);
        $response = array();
        $count = 0;
        while($data = $show->fetch(PDO::FETCH_OBJ)){
            if($data->kebutuhan == "umum"){
                $kebutuhan = $data->kebutuhan;
            }else{
                $arrayKebutuhan = explode("/",$data->kebutuhan);
                $kebutuhan = $arrayKebutuhan[0];

                $proses_unit = new Unit($db);
                $show_unit = $proses_unit->editUnit($arrayKebutuhan[1]);
                $data_unit = $show_unit->fetch(PDO::FETCH_OBJ);
            }

            $count++;
            $response[] = array(
            	"sumber_dana" => $data->sumber_dana,
            	"kebutuhan" => ($kebutuhan == 'umum' ? 'Umum' : 'Unit '.$data_unit->no_unit),
            	"harga" => number_format($data->harga, 0, ".", ".")." IDR",
            	"jumlah" => $data->jumlah,
            	"total" => number_format($data->harga*$data->jumlah, 0, ".", ".")." IDR",
            	"keterangan" => $data->keterangan
            );
        }

        echo json_encode(array("data" => $response, "next_page" => ($count==$length ? true:false)));
    }

    elseif(isPost("info")=="laporan_billing" && isPost("key")=="6vgby12k"){

    	$Proses = new TransaksiUmum($db);
    	$start_rec = isPost("start_rec");
    	$length = isPost("length");
        $show = $Proses->showBillingTU_pag($start_rec,$length);
        $response = array();
        $count = 0;
        while($data = $show->fetch(PDO::FETCH_OBJ)){
            $kode = $data->kd_transaksi_umum;
            if($data->kebutuhan == "umum"){
            	$kebutuhan = $data->kebutuhan;
          	}else{
            	$arrayKebutuhan = explode("/",$data->kebutuhan);
            	$kebutuhan = $arrayKebutuhan[0];

            	$proses_unit = new Unit($db);
            	$show_unit = $proses_unit->editUnit($arrayKebutuhan[1]);
            	$data_unit = $show_unit->fetch(PDO::FETCH_OBJ);
          	}

            $count++;
            $response[] = array(
            	"kebutuhan" => ($kebutuhan == 'umum' ? 'Umum' : 'Unit '.$data_unit->no_unit),
            	"harga" => number_format($data->harga, 0, ".", ".")." IDR",
            	"jumlah" => $data->jumlah,
            	"total" => number_format($data->harga*$data->jumlah, 0, ".", ".")." IDR",
            	"keterangan" => $data->keterangan,
            	"jatuh_tempo" => $data->jatuh_tempo
            );
        }

        echo json_encode(array("data" => $response, "next_page" => ($count==$length ? true:false)));
    }

 ?>