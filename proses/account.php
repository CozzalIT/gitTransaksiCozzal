<?php
require("../config/database.php");
require("../class/account.php");
session_start();
$view = $_SESSION['hak_akses'];
if($view=='owner') $kd_owner = $_SESSION['pemilik'];

// Update profile(info basic) owner
if(isset($_POST['updateinfo']) && $view=='owner'){
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $no_tlp = $_POST['no_tlp'];
  $email  = $_POST['email'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $proses = new Account($db);
  $add = $proses->updateProfile_owner($kd_owner ,$nama, $alamat, $no_tlp, $email, $jenis_kelamin,'','');
  if($add == "Success"){
    header('Location:../view/'.$view.'/profile/profile.php');
  }
}

// update profile(other) owner
elseif(isset($_POST['updateother']) && $view=='owner'){
  $kd_bank = $_POST['kd_bank'];
  $no_rek = $_POST['no_rek'];
  $proses = new Account($db);
  $add = $proses->updateProfile_owner($kd_owner,'', '', '', '', '', $kd_bank, $no_rek);
  if($add == "Success"){
    header('Location:../view/'.$view.'/profile/profile.php');
  }
}

// update username
elseif(isset($_POST['updateuser'])){
  $username_old = $_SESSION['username'];
  $username_new = $_POST['user_new'];
  $password = $_POST['konfr_pass1'];
  $proses = new Account($db);
  $show = $proses->is_username_exists($username_new);
  if($show==false){
    require("../class/login/login.php");
    $proses2 = new Login($db);
    $show2 = $proses2->loginuser($username_old, $password);
    if($show2==true){
        if($view=='owner') {
        $delete = $proses->deleteRelasi($username_old); }
        $add = $proses->updateUsername($username_old, $username_new);
        if($add == "Success"){
          if($view=='owner') {
          $create = $proses->addRelasi($username_new, $_SESSION['pemilik']);}
          $_SESSION['username'] = $username_new;
          mkdir('succesuser'); 
        }
    } else mkdir('gagalpass1');
  } else mkdir('gagaluser');
  header('Location:../view/'.$view.'/profile/profile.php');
}

// update password
elseif(isset($_POST['updatepass'])){
  $username = $_SESSION['username'];
  $password = $_POST['new_pass'];
  $password_old = $_POST['old_pass'];
  require("../class/login/login.php");
  $proses2 = new Login($db);
  $show2 = $proses2->loginuser($username, $password_old);
  if($show2==true){
    $proses = new Account($db);
    $add = $proses->updatePassword($password, $username);
    if($add=="Success") mkdir('succespass');
  } else mkdir('gagalpass1'); 
  header('Location:../view/'.$view.'/profile/profile.php');
} 

// delete akun
elseif(isset($_GET['delete_akun']) && $view=='superadmin'){
  $username = $_GET['delete_akun'];
  $proses = new Account($db);
  $add = $proses->deleteAkun($username);
  if($add == "Success"){
    header('Location:../view/'.$view.'/account/account_management.php');
  }
}

// me non-aktifkan / aktifkan user by table
elseif((isset($_GET['non_aktif']) || isset($_GET['aktif'])) && $view=='superadmin'){
  $proses = new Account($db);
  if (isset($_GET['non_aktif'])){
    $status = '2';   
    $username = $_GET['non_aktif'];
  } else {
    if ($_GET['ha']=='owner') $status = '1'; else $status = '3';
    $username = $_GET['aktif'];
  } 
  $add = $proses->set_status_akun($username, $status);
  if($add == "Success"){
    header('Location:../view/'.$view.'/account/account_management.php');
  }
}

// menghapus relasi
elseif(isset($_GET['delete_rel']) && $view=='superadmin'){
  $username = $_GET['delete_rel'];
  $proses = new Account($db);
  $add = $proses->deleteRelasi($username);
  $add2 = $proses->set_status_akun($username, '3');
  header('Location:../view/'.$view.'/account/account_management.php');
}

// menambah relasi
elseif(isset($_POST['addRelasi']) && $view=='superadmin'){
  $username = $_POST['username2'];
  $kd_owner = $_POST['kd_owner2'];
  $status = $_POST['status'];
  $proses = new Account($db);
  $add = $proses->addRelasi($username, $kd_owner);
  $add2 = $proses->set_status_akun($username, $status);  
  header('Location:../view/'.$view.'/account/account_management.php');
}

// Tambah Akun
elseif(isset($_POST['addAccount']) && $view=='superadmin'){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $proses = new Account($db);
  $is_exists = $proses->is_username_exists($username);
  if($is_exists!=true){
      $hak_akses = $_POST['hak_akses'];
      $status_isi = $hak_akses=='owner' && $_POST['kd_owner']!='null';
      if($status_isi) $status = '1';
      else $status = '3';
      $add = $proses->addAccount($username, $password, $hak_akses, $status);
      if($add == "Success"){
        if($status_isi){
          $add2 = $proses-> addRelasi($username, $_POST['kd_owner']);
          if($add2 == "Success"){
            header('Location:../view/'.$view.'/account/account_management.php');
          }
          else die('gagal merelasikan akun');
        } else header('Location:../view/'.$view.'/account/account_management.php'); 
      } else die('gagal menambahkan akun');
  } else {
    mkdir('gagal'); header('Location:../view/'.$view.'/account/account_management.php');
  }
}

else header('Location:../view/'.$view.'/home/home.php');

?>
