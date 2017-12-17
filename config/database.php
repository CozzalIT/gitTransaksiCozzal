<?php 
 
class database{
 
	var $host = "localhost";
	var $uname = "root";
	var $pass = "";
	var $db = "malasngoding";
 
	function __construct(){
		mysql_connect($this->host, $this->uname, $this->pass);
		mysql_select_db($this->db);
	}
 
	function __construct(){
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
    }
	
	function tampil_data(){
		$data = mysql_query("select * from user");
		while($d = mysql_fetch_array($data)){
		$hasil[] = $d;
	}
		return $hasil;
	}
} 
 
?>