<?php
class Transaksi {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
  public function addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $ekstra_charge, $kd_booking, $kd_bank, $dp, $total, $sisa_pelunasan, $hari, $tgl_transaksi, $diskon){
    $sql = "INSERT INTO tb_transaksi (kd_penyewa, kd_apt, kd_unit, tamu, check_in, check_out, harga_sewa, ekstra_charge, kd_booking, kd_bank, dp, total_tagihan, sisa_pelunasan, hari, tgl_transaksi, diskon) VALUES('$kd_penyewa', '$kd_apt', '$kd_unit', '$tamu', '$check_in', '$check_out', '$harga_sewa', '$ekstra_charge', '$kd_booking', '$kd_bank', '$dp', '$total', '$sisa_pelunasan', '$hari', '$tgl_transaksi', '$diskon')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function addConfirm($kd_transaksi){
    $sql = "INSERT INTO tb_confirm_transaksi (kd_penyewa, kd_apt, kd_unit, tamu, check_in, check_out, harga_sewa, ekstra_charge, kd_booking, kd_bank, dp, total_tagihan, sisa_pelunasan, hari, tgl_transaksi, diskon)
    SELECT kd_penyewa, kd_apt, kd_unit, tamu, check_in, check_out, harga_sewa, ekstra_charge, kd_booking, kd_bank, dp, total_tagihan, sisa_pelunasan, hari, tgl_transaksi, diskon
    FROM tb_transaksi WHERE kd_transaksi='$kd_transaksi'";
    $sql_delete = "DELETE FROM tb_transaksi WHERE kd_transaksi='$kd_transaksi'";

    $query = $this->db->query($sql);
    $query1 = $this->db->query($sql_delete);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Show
  public function showTransaksi(){
    $sql = "SELECT * from tb_transaksi
    INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_transaksi.kd_penyewa
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_transaksi.kd_apt
    INNER JOIN tb_unit ON tb_unit.kd_unit = tb_transaksi.kd_unit";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showPenyewaTransaksi(){
    $sql = "SELECT * FROM tb_penyewa WHERE kd_penyewa IN (SELECT MAX(kd_penyewa) FROM tb_penyewa)";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showTransaksiUnit($kd_unit){
    $sql = "SELECT * from tb_transaksi where kd_unit='$kd_unit'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showTransaksi_cek($CI,$CO,$kd_unit){
    $sql = "SELECT * from tb_transaksi where ((check_in<='$CI' and check_out>='$CO')
    or (check_in>='$CI' and check_in<='$CO')
    or (check_out>='$CI' and check_out<='$CO'))
    and (kd_unit ='$kd_unit')" ;
    $query = $this->db->query($sql);
    return $query;
  }

  public function showConfirmTransaksi(){
    $sql = "SELECT * from tb_confirm_transaksi
    INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_confirm_transaksi.kd_penyewa
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_confirm_transaksi.kd_apt
    INNER JOIN tb_unit ON tb_unit.kd_unit = tb_confirm_transaksi.kd_unit";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Edit
  public function editApartemen($kd_apart){
    $sql = "SELECT * FROM tb_apt WHERE kd_apt='$kd_apart'";
    $query = $this->db->query($sql);
    return $query;
  }

  public function editTransaksi($kd_transaksi){
    $sql = "SELECT * from tb_transaksi
    INNER JOIN tb_penyewa ON tb_penyewa.kd_penyewa = tb_transaksi.kd_penyewa
    INNER JOIN tb_apt ON tb_apt.kd_apt = tb_transaksi.kd_apt
    INNER JOIN tb_bank ON tb_bank.kd_bank = tb_transaksi.kd_bank
    INNER JOIN tb_booking_via ON tb_booking_via.kd_booking = tb_transaksi.kd_booking
    INNER JOIN tb_unit ON tb_unit.kd_unit = tb_transaksi.kd_unit WHERE kd_transaksi='$kd_transaksi'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Update
  public function updateTransaksi($kd_transaksi, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $diskon, $ekstra_charge, $kd_booking, $kd_bank, $dp, $total_tagihan, $sisa_pelunasan, $hari){
    $sql = "update tb_transaksi SET kd_apt ='$kd_apt', kd_unit='$kd_unit', tamu='$tamu', check_in='$check_in', check_out='$check_out',
    harga_sewa ='$harga_sewa', diskon ='$diskon', ekstra_charge='$ekstra_charge', kd_booking='$kd_booking', kd_bank='$kd_bank', dp='$dp',
    total_tagihan='$total_tagihan', sisa_pelunasan='$sisa_pelunasan', hari ='$hari' where kd_transaksi='$kd_transaksi'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function updateUnitTransaksi($kd_transaksi, $kd_apt, $kd_unit){
    $sql = "UPDATE tb_transaksi SET kd_apt='$kd_apt', kd_unit='$kd_unit' WHERE kd_transaksi='$kd_transaksi'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Delete
  public function deleteTransaksi($kd_transaksi){
    $sql = "DELETE FROM tb_transaksi WHERE kd_transaksi='$kd_transaksi'";
    $query = $this->db->query($sql);
  }

  //penyewa numpang lewat
 public function addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung){
    $sql = "INSERT INTO tb_penyewa (nama, alamat, no_tlp, jenis_kelamin, email, tgl_gabung) VALUES('$nama', '$alamat', '$no_tlp', '$jenis_kelamin', '$email', '$tgl_gabung')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Show
  public function showPenyewa(){
    $sql = "SELECT * FROM tb_penyewa";
    $query = $this->db->query($sql);
    return $query;
  }
}

//Tambah Transaksi
if(isset($_POST['addTransaksi'])){
	$kd_penyewa 	= $_POST['kd_penyewa'];
	$kd_apt 		= $_POST['apartemen'];
	$kode = explode("+",$_POST['unit']);
	$kd_unit 		= $kode[0];
	$tamu 			= $_POST['tamu'];
	$check_in 		= $_POST['check_in'];
	$check_out 		= $_POST['check_out'];
	$harga_sewa 	= $_POST['harga_sewa'];
  $harga_sewa_asli   = $_POST['harga_sewa_asli'];
  $diskon = 0;
  if($harga_sewa<$harga_sewa_asli){
     $diskon = $harga_sewa_asli-$harga_sewa;
  }
	$ekstra_charge 	= $_POST['ekstra_charge'];
	$kd_booking 	= $_POST['booking_via'];
	$kd_bank 		= $_POST['dp_via'];
	$dp 			= $_POST['dp'];
  $total  = $_POST['total'];
  $sisa_pelunasan = $total - $dp;
  $hari = $_POST['jumhari'];
  $tgl_transaksi = date('y-m-d');

  require("../../config/database.php");
  $proses = new Transaksi($db);
  $add = $proses->addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $ekstra_charge, $kd_booking, $kd_bank, $dp, $total, $sisa_pelunasan, $hari, $tgl_transaksi, $diskon);

  if($add == "Success"){
	  header('Location:../superadmin/laporan_transaksi.php');
  }else{
    echo 'gagal';
	}
}

//Tambah Confirm Transaksi
if (isset($_GET['addConfirm'])){
  $kd_transaksi = $_GET['addConfirm'];

  require("../../config/database.php");
  $proses = new Transaksi($db);
  $add = $proses->addConfirm($kd_transaksi);
  if($add == "Success"){
    header('Location:../superadmin/confirm_transaksi.php');
  }
}

//Tambah Penyewa di Halaman Transaksi
if(isset($_POST['addPenyewaTransaksi'])){
  $nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_tlp = $_POST['no_tlp'];
	$jenis_kelamin = $_POST['jenis_kelamin'];

  require("../../config/database.php");
  $proses = new Transaksi($db);
  $add = $proses->addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin);

  require("../../config/database.php");
  $Proses = new Transaksi($db);
  $show = $Proses->showPenyewaTransaksi();
  $data = $show->fetch(PDO::FETCH_OBJ);

  if($add == "Success"){
	  header('Location:../superadmin/transaksi.php?nama='.$nama.'&alamat='.$alamat.'&no_tlp='.$no_tlp.'&jenis_kelamin='.$jenis_kelamin.'&kd_penyewa='.$data->kd_penyewa);
  }
}

//Delete DP Transaksi
if(isset($_GET['delete_transaksi'])){
  require("../../config/database.php");
  $proses = new Transaksi($db);
  $del = $proses->deleteTransaksi($_GET['delete_transaksi']);
  header("location:../superadmin/laporan_transaksi.php");
}

//update Transaksi
if(isset($_POST['updateTransaksi'])){
  $kd_transaksi = $_POST['kd_transaksi'];
  $kd_apt     = $_POST['apartemen'];
  $kode = explode("+",$_POST['unit']);
  $kd_unit    = $kode[0];
  $tamu       = $_POST['tamu'];
  $check_in     = $_POST['check_in'];
  $check_out    = $_POST['check_out'];
  $harga_sewa   = $_POST['harga_sewa'];
  $harga_sewa_asli   = $_POST['harga_sewa_asli'];
  $diskon = 0;
  if($harga_sewa<$harga_sewa_asli){
    $diskon = $harga_sewa_asli-$harga_sewa;
  }
  $ekstra_charge  = $_POST['ekstra_charge'];
  $kd_booking   = $_POST['booking_via'];
  $kd_bank    = $_POST['dp_via'];
  $dp       = $_POST['dp'];
  $total_tagihan  = $_POST['total'];
  $sisa_pelunasan = $total_tagihan - $dp;
  $hari = $_POST['jumhari'];

  require("../../config/database.php");
  $proses = new Transaksi($db);
  $add = $proses->updateTransaksi($kd_transaksi, $kd_apt, $kd_unit, $tamu, $check_in, $check_out, $harga_sewa, $diskon, $ekstra_charge, $kd_booking, $kd_bank, $dp, $total_tagihan, $sisa_pelunasan, $hari);
  if($add == "Success"){
    header('Location:../superadmin/laporan_transaksi.php');
  } else echo 'error';
}
?>
