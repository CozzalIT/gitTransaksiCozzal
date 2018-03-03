<?php
require("../../../../config/database.php");
class Mod {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Update
  public function updateMod($kd_confirm_transaksi,  $jumlah_weekend, $jumlah_weekday){
    $sql = "UPDATE tb_confirm_transaksi SET hari_weekend='$jumlah_weekend', hari_weekday='$jumlah_weekday' where kd_confirm_transaksi='$kd_confirm_transaksi'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }
}

require("../../../../config/database.php");
session_start();

if(isset($_GET['mod'])){

  $kd_confirm_transaksi = $_GET['mod'];
  $check_in = $_GET['check_in'];
  $check_out = $_GET['check_out'];
  $hari = $_GET['hari'];

  //==== Memasukkan tiap tanggal mulai dari CheckIn sampai CheckOut kedalam Array ====
	$i = 1;
	$tmp = '0000-00-00';
	$range_hari[0] = $check_in;
	$mod_check_out = date('Y-m-d', strtotime('-1 days', strtotime($check_out)));

	if($check_in != $mod_check_out){
		$check_out = $mod_check_out;
		while($tmp != $check_out){
			$range_hari[$i] = date('Y-m-d', strtotime('+'.$i.' days', strtotime($check_in)));
			$tmp = $range_hari[$i];
			$i++;
		}
	}
	$jumlah_hari = count($range_hari);

	//==== Menghitung jumlah Weekend dan Weekday dari CheckIn sampai CheckOut ====
	function isWeekend($date) {
    return (date('N', strtotime($date)) >= 5 && date('N', strtotime($date)) >= 4 && date('N', strtotime($date)) != 6);
	}
	$y = 0;
	$weekend[99] = 'null';
	while($y != ($jumlah_hari)){
	  if(isWeekend($range_hari[$y])){
	    $weekend[$y] = $range_hari[$y];
	  }
	  $y++;
	}
	$jumlah_weekend = count($weekend) - 1;
	$jumlah_weekday = $hari - $jumlah_weekend;

  echo $check_in.'<br>'.$check_out.'<br>'.$jumlah_weekend.'<br>'.$jumlah_weekday;

  $proses = new Mod($db);
  $add = $proses->updateMod($kd_confirm_transaksi,  $jumlah_weekend, $jumlah_weekday);
  if($add == "Success"){
	  echo 'sukses';
  }else{
    echo 'gagal';
	}
}
?>
