<?php
  session_start();
  require 'class/login/login.php';
  require '../config/database.php';

  if (isset ($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = new Login($db);
    $login = $user->loginuser($username, $password);
    if($login == true){
      $masuk = true;
      if($login['hak_akses']=='owner'){
          $pemilik = $user->getOwner($username);
          if($pemilik == true){
            $_SESSION['pemilik'] = $pemilik['kd_owner'];
          }
          else {$error= "Username tidak terelasi dengan owner"; $masuk=false;}
      }
      if($login['status']=='2'){$error = "Akun sedang dinon-aktifkan sementara"; $masuk=false;}
      if($masuk){
          $_SESSION['username'] = $login['username'];
          $_SESSION['hak_akses'] = $login['hak_akses'];
          header('Location: view/'.$login['hak_akses'].'/home/home.php');
      }
    }else{
			$error= "Username / Password Salah!";
		}
	}
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <title>Cozzal Admin</title><meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="asset/css/bootstrap.min.css" />
		<link rel="stylesheet" href="asset/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="asset/css/matrix-login.css" />
    <link href="asset/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" type="image/x-icon" href="http://transaksi.cozzal.com/asset/images/fav.png">
  </head>
  <body>
    <div id="loginbox">
      <form id="loginform" class="form-vertical" action="" method="post">
			  <div class="control-group normal_text"> <h3><img src="asset/img/logo.png" alt="Logo" /></h3></div>
          <div class="control-group">
            <?php
              if(isset($error)){
                echo '
                <div class="alert alert-danger" role="alert">
                  <strong>'.$error.'</strong>
                </div>
                ';
              }
            ?>
            <div class="controls">
              <div class="main_input_box">
                <span class="add-on bg_lg"><i class="icon-user"> </i></span>
							  <input name="username" type="text" placeholder="Username" />
              </div>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <div class="main_input_box">
                <span class="add-on bg_ly"><i class="icon-lock"></i></span>
							  <input name="password" type="password" placeholder="Password" />
              </div>
            </div>
          </div>
          <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
            <span class="pull-right"><button type="submit" class="btn btn-success" name="login"/> Login</button></span>
          </div>
        </form>
        <form id="recoverform" action="#" class="form-vertical">
				  <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
          <div class="controls">
            <div class="main_input_box">
              <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
            </div>
          </div>
          <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
            <span class="pull-right"><a class="btn btn-info"/>Recover</a></span>
          </div>
        </form>
      </div>
      <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/matrix.login.js"></script>
  </body>
</html>
