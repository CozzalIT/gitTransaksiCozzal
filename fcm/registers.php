<?php
    require("../class/fcm.php");
    $proses = new fcm($db);

    if(isset($_POST["Token"]) && isset($_POST["username"])){
        $token = $_POST["Token"];
        $username = $_POST["username"];

        //Cek token
        $show = $proses->cekToken($username);
        $data = $show->fetch(PDO::FETCH_OBJ);
        $allToken = $data->token;

        if (strpos($allToken/*Str*/, $token/*subStr*/) == false) {
          $token = $allToken.',"'.$token.'"';
          $update = $proses->regisToken($token);
        }else{
          $update = $proses->regisToken($token);
        }

        //Register token ke database
        /*
        if($data->token == $token){
            $update = $proses->regisToken($token);
        }
        */
    }
?>
