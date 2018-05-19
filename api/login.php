<?php
  require '../class/login/login.php';
  require '../../config/database.php';

if (isset($_POST['username']) && isset($_POST['password']) && $_POST['key']==5001){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = new Login($db);
    $owner = 0;
    $login = $user->loginuser($username, $password);
    if($login == true){
		$masuk = true;
		if($login['hak_akses']=='owner'){
		    $pemilik = $user->getOwner($username);
		    if($pemilik == true){
		      $owner = $pemilik['kd_owner'];
		    }
		    else {$flag= "Username tidak terelasi dengan owner"; $masuk=false;}
		}
		if($login['status']=='2'){$flag = "Akun dinon-aktifkan";}
		if($masuk){
			if($login['hak_akses']=="admin")
				$flag = "admin"; // untuk admin
			elseif($login['hak_akses']=="owner")
				$flag = "owner"; // untuk owner
			elseif($login['hak_akses']=="cleaner")
				$flag = "cleaner"; //untuk cleaner
		}
    }else{
		$flag= "Username / Password tidak cocok";
	}
	$callback = array('flag'=>$flag,'owner'=>$owner);
  	echo json_encode($callback);  
}
?>