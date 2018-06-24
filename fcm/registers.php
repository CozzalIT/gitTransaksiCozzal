<?php
    require("../class/fcm.php");
    $proses = new fcm($db);

    if(isset($_POST["Token"]) && isset($_POST["username"])){
        $token = $_POST["Token"];
        $username = $_POST["username"];

        //Cek token
        $show = $proses->cekToken($username);
        $data = $show->fetch(PDO::FETCH_OBJ);

        //Register token ke database
        if($data->token == $token){
            $update = $proses->regisToken($token);
        }
    }
?>
