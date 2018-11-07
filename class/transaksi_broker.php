<?php
class Transaksi_broker {
  private $db;

  public function __construct($database){
    $this->db = $database;
  }

  //Proses Add
  public function addTransaksi($kd_penyewa, $kd_apt, $kd_unit, $check_in, $check_out, $hari_weekend, $hari_weekday, $hari, $harga_sewa, $harga_sewa_weekend, $harga_sewa_gbg, $tgl_transaksi, $diskon, $ekstra_charge, $kd_kas, $tamu, $kd_booking, $dp, $total_tagihan, $total_harga_owner, $sisa_pelunasan, $status, $h_owner_wd, $h_owner_we, $catatan, $deposit, $status_broker){
    $sql = "INSERT INTO tb_transaksi (kd_penyewa, kd_apt, kd_unit, check_in, check_out, hari_weekend, hari_weekday, hari, harga_sewa, harga_sewa_weekend, harga_sewa_gbg, tgl_transaksi, diskon, ekstra_charge, kd_kas, tamu, kd_booking, dp, total_tagihan, total_harga_owner, sisa_pelunasan, status, harga_owner, harga_owner_weekend, catatan, deposit, status_broker)
    VALUES ('$kd_penyewa', '$kd_apt', '$kd_unit', '$check_in', '$check_out',
      '$hari_weekend', '$hari_weekday', '$hari', '$harga_sewa', '$harga_sewa_weekend', '$harga_sewa_gbg','$tgl_transaksi', '$diskon', '$ekstra_charge', '$kd_kas', '$tamu', '$kd_booking', '$dp', '$total_tagihan', '$total_harga_owner', '$sisa_pelunasan', '$status', '$h_owner_wd', '$h_owner_we','$catatan', '$deposit', '$status_broker')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function addUnit_kotor($kd_unit, $check_in, $check_out){
    $sql = "INSERT INTO tb_unit_kotor(kd_unit, check_in, check_out) VALUES ('$kd_unit','$check_in','$check_out')";
    $query = $this->db->query($sql);
  }  

  public function showMaxTransaksi(){
    $sql = "SELECT kd_transaksi FROM tb_transaksi WHERE kd_transaksi IN (SELECT MAX(kd_transaksi) FROM tb_transaksi)";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showBroker($keyword){
    $sql = "SELECT * FROM tb_penyewa 
    WHERE isbroker = 1 AND nama like '%$keyword%' ORDER BY nama ASC";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showAllBroker(){
    $sql = "SELECT * FROM tb_penyewa WHERE isbroker = 1 ORDER BY nama ASC";
    $query = $this->db->query($sql);
    return $query;
  }

  public function showPenyewa($keyword){
    $sql = "SELECT * FROM tb_penyewa 
    WHERE isbroker = 0 AND nama like '%$keyword%' ORDER BY nama ASC";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Add
  public function addBroker($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung){
    $sql = "INSERT INTO tb_penyewa (nama, alamat, no_tlp, jenis_kelamin, email, tgl_gabung, isbroker) VALUES('$nama', '$alamat', '$no_tlp', '$jenis_kelamin', '$email', '$tgl_gabung', '1')";
    $query = $this->db->query($sql);
    $sql = "SELECT * FROM tb_penyewa WHERE kd_penyewa IN (SELECT MAX(kd_penyewa) FROM tb_penyewa)";
    $query = $this->db->query($sql);
    $data = $query->fetch(PDO::FETCH_OBJ);
    if($data->nama==$nama && $data->alamat==$alamat && $data->jenis_kelamin==$jenis_kelamin){
      return $data->kd_penyewa;
    } else {
      return "Failed";
    }
  }

  // Cek ketersediaan
  public function is_brokerSpace($kd_broker, $kd_unit, $CI, $CO){
    if(strtotime($CI)>strtotime($CO)) return false;
    $result = $this->db->prepare("SELECT kd_transaksi FROM tb_transaksi WHERE 
    check_in<='$CI' AND check_out>='$CO' AND kd_unit ='$kd_unit' and status!='2' and status!='3'
    AND kd_penyewa = '$kd_broker' AND status_broker = 'B'");
    $result->execute();
    $rows = $result->fetch();
    return $rows;  
  }  

  public function showTransaksi_cek($CI,$CO,$kd_unit){
   $result = $this->db->prepare("SELECT kd_transaksi from tb_transaksi where ((check_in<='$CI' and check_out>='$CO')
    or (check_in>='$CI' and check_in<'$CO')
    or (check_out>'$CI' and check_out<='$CO'))
    and (kd_unit ='$kd_unit') and (status!='2' and status!='3') AND status_broker!='B'");
    $result->execute();
    $rows = $result->fetch();
    return $rows;
  }  

  // ---------- NON DATABASE ---------------

  public function setPhoneNumber($no_tlp){
    $char_number = ["+","0","1","2","3","4","5","6","7","8","9"];
    $tlp = $no_tlp;
    $tlp = str_replace("-", "", $tlp);
    if(in_array($tlp[0], $char_number))
      $tlp = str_replace(" ", "", $tlp);
    if($tlp[0]=="+"){
      $kd_tlp = $tlp[0].$tlp[1].$tlp[2];
      if($kd_tlp="+62"){
        $tlp = str_replace("+62", "0", $tlp);
      }
    }
    return $tlp;
  }

}
?>