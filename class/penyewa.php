<?php
class Penyewa {
  private $db;

  public function __construct($database){
      $this->db = $database;
  }

  //Proses Add
  public function addPenyewa($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung){
    $sql = "INSERT INTO tb_penyewa (nama, alamat, no_tlp, jenis_kelamin, email, tgl_gabung) VALUES('$nama', '$alamat', '$no_tlp', '$jenis_kelamin', '$email', '$tgl_gabung')";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  //Proses Add
  public function addPenyewa2($nama, $alamat, $no_tlp, $jenis_kelamin, $email, $tgl_gabung){
    $sql = "INSERT INTO tb_penyewa (nama, alamat, no_tlp, jenis_kelamin, email, tgl_gabung) VALUES('$nama', '$alamat', '$no_tlp', '$jenis_kelamin', '$email', '$tgl_gabung')";
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

  //Proses Show
  public function showPenyewa(){
    $sql = "SELECT * FROM tb_penyewa ORDER BY nama ASC";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Edit
  public function editPenyewa($kd_penyewa){
    $sql = "SELECT * FROM tb_penyewa WHERE kd_penyewa='$kd_penyewa'";
    $query = $this->db->query($sql);
    return $query;
  }

  //Proses Update
  public function updatePenyewa($kd_penyewa, $nama, $alamat, $no_tlp, $jenis_kelamin, $email){
    $sql = "UPDATE tb_penyewa SET nama='$nama', alamat='$alamat', no_tlp='$no_tlp', jenis_kelamin='$jenis_kelamin', email='$email' WHERE kd_penyewa='$kd_penyewa'";
    $query = $this->db->query($sql);
    if(!$query){
      return "Failed";
    }else{
      return "Success";
    }
  }

  public function updatePhoneNumber($kd_penyewa, $no_tlp){
    $sql = "UPDATE tb_penyewa SET no_tlp='$no_tlp' WHERE kd_penyewa='$kd_penyewa'";
    $query = $this->db->query($sql);   
  }

  public function solveRedudansi($kd_penyewa_baru, $kd_penyewa_lama){
    $sql = "UPDATE tb_transaksi SET kd_penyewa='$kd_penyewa_baru' 
    WHERE kd_penyewa='$kd_penyewa_lama'";
    $this->db->query($sql);
    $sql = "UPDATE tb_recommended SET kd_penyewa='$kd_penyewa_baru' 
    WHERE kd_penyewa='$kd_penyewa_lama'";
    $this->db->query($sql);
  }

  //Proses Delete
  public function deletePenyewa($kd_penyewa){
    $sql = "DELETE FROM tb_penyewa WHERE kd_penyewa='$kd_penyewa'";
    $query = $this->db->query($sql);
  }

  public function showPenyewa_cek($nama, $no_tlp, $alamat){
  	$sql = "SELECT * FROM tb_penyewa WHERE (UCASE(nama) like UCASE('$nama')";
    if($alamat!="") $sql .= " AND UCASE(alamat) like UCASE('$alamat')";
    $sql .= ") OR no_tlp = '$no_tlp'";
  	$query = $this->db->query($sql);
  	return $query;  	
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
