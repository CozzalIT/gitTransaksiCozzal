<?php
$host       = "localhost";
$username   = "root";
$password   = "";
$dbname     = "db_keuangan_cozzal";

try{
    $conn    = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}catch (PDOException $e){
    echo "ERROR CONNECTIONF : " . $e->getMessage();
}
?>