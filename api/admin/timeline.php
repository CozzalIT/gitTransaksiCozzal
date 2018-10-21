<?php 

    require("../../../class/cleaner.php");
    require("../../../../config/database.php");

    function isPost($x){
        if(isset($_POST[$x])){
            return $_POST[$x];
        } else {
            die(json_encode(array("status" => "Incorrect Value")));
        }
    }

    if(isPost('info')=="Weekly" && isPost("key")=='13oKtmpl'){

        $index = isPost('index');
        

        $tgl = $_POST['show_tanggal'];
        $kotak = $_POST['kotak'];
        $Proses = new Cleaner($db);
        $jumlah_ci = getcount($tgl, "check_in", $Proses);
        $jumlah_co = getcount($tgl, "check_out", $Proses);
        $jumlah_stay = getcount($tgl, "stay", $Proses);
        $jumlah_task = getcount($tgl, "task", $Proses);
        $callback = array('CI'=>$jumlah_ci, 'CO'=>$jumlah_co, 
                        'ST'=>$jumlah_stay, 'TS'=>$jumlah_task);
        echo json_encode($callback);        

    }

 ?>