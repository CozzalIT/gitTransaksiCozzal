<?php 

    require("../../class/cleaner.php");
    require("../../../config/database.php");

    function isPost($x){
        if(isset($_POST[$x])){
            return $_POST[$x];
        } else {
            die(json_encode(array("status" => "Incorrect Value")));
        }
    }

    function formated_jam_co($jam){
      if($jam!=""){
        $jam_CO = explode(":", $jam);
        return $jam_CO[0].":".$jam_CO[1];
      } else {
        return "Standar";
      }
    }

    function formalTanggal($date){
        $arr_b = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
            "Agustus", "September", "Oktober", "November", "Desember"
        ];
        $i = date('n',strtotime($date));
        $dd = explode("-", $date);
        return $dd[2]." ".$arr_b[$i-1]." ".$dd[0];
    }

    function hari($date){
        $arr_h = ["Ahad","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu"];
        $i = date('w', strtotime($date));
        return $arr_h[$i];
    }

    function getcount($tgl, $jenis, $Proses){
        if ($jenis=='stay'){
            $show = $Proses->showUnit_stay($tgl, "count");
        } elseif($jenis=='task'){
            $show = $Proses->countTask($tgl);
        } else {
            $show = $Proses->showUnit_cek($tgl, $jenis, "count");
        }  
        $data = $show->fetch(PDO::FETCH_OBJ);
        return $data->jumlah;
    }

    function new_detail($Proses, $tgl, $jenis){
        $ret = [];
        if ($jenis!='stay'){
            $show = $Proses->showUnit_cek($tgl, $jenis, "");
        } else {
            $show = $Proses->showUnit_stay($tgl, "");
        }
      
        while($data = $show->fetch(PDO::FETCH_OBJ)){
            $ret[] = [
                "nama" => $data->nama, "no_unit" => $data->no_unit,
                "nama_apt" => $data->nama_apt, "no_tlp" => $data->no_tlp,
                "alamat_apt" => $data->alamat_apt, 
                "jam_check_out" => ($jenis=="check_out" ? formated_jam_co($data->jam_check_out) : "-")
            ];
        }
        return $ret;
    }

    function getListUnit($Proses, $id, $delimiter){
        $ret = "";
        $kd_units = explode($delimiter, $id);
        foreach ($kd_units as $kd_unit) {
            if($kd_unit!=""){
                $show = $Proses->showUnitbyId($kd_unit);
                $data = $show->fetch(PDO::FETCH_OBJ);
                $ret .= ", ".$data->no_unit." - ".$data->nama_apt;
            }
        }
        return $ret;
    }

    function detailTask($tgl, $proses){
        $ret = [];
        $show = $proses->showTask_onceByDate($tgl);

        while($data = $show->fetch(PDO::FETCH_OBJ)){
            
            if($data->unit=="Semua")
                $keterangan .= "Semua Unit";
            elseif($data->unit[0] == "!"){
                $keterangan .= "Semua Unit Kecuali : ".getListUnit($proses, $data->unit, "!");
            } else {
                $keterangan .= "Beberapa Unit : ".getListUnit($proses, $data->unit, "&");
            }

            $ret[] = ["task" => $data->task, 'description' => $keterangan];
        }
        
        return $ret;  
    }    

    // ----------------------------------------

    if(isPost('info')=="Weekly" && isPost("key")=='13oKtmpl'){

        $index = isPost('index');
        $index = $index*7; $sb = "";
        $callback = [];
        $ulangi = 7;
        while($ulangi--){
            if($index>=0) $sb = "+".$index;
            else $sb = $index;
            $tgl = date('Y-m-d', strtotime($sb.' Days'));
            $Proses = new Cleaner($db);
            $jumlah_ci = getcount($tgl, "check_in", $Proses);
            $jumlah_co = getcount($tgl, "check_out", $Proses);
            $jumlah_stay = getcount($tgl, "stay", $Proses);
            $jumlah_task = getcount($tgl, "task", $Proses);
            $callback[] = [
                            'CI'=>$jumlah_ci, 'CO'=>$jumlah_co, 
                            'ST'=>$jumlah_stay, 'TS'=>$jumlah_task,
                            'Tanggal' => formalTanggal($tgl),
                            'Hari' => hari($tgl), 'date' => $tgl
                          ];
            $index++;            
        }
        echo json_encode($callback);        

    }

    elseif(isPost('info')=="detail" && isPost("key")=='jk5vs0p'){

        $tgl = isPost('tanggal');        
        $Proses = new Cleaner($db);
        $CI = new_detail($Proses, $tgl, "check_in");
        $CO = new_detail($Proses, $tgl, "check_out");
        $ST = new_detail($Proses, $tgl, "stay");
        $TS =  detailTask($tgl, $Proses);
        $callback = array('CI'=>$CI, 'CO'=>$CO, 'ST'=>$ST, 'TS' => $TS);
        echo json_encode($callback);

    }    

 ?>