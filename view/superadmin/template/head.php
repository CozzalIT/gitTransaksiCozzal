<?php
//  function customError(){error:
//	echo '<div class="hide">Error</div>';
//  }
  //set error handler
//  set_error_handler("customError");
//  session_save_path('../../../session');
  session_start();
  ob_start();
  if(!isset($_SESSION['username'])) {
    header('location:../../../index.php');
  }else {
  	if($_SESSION['hak_akses']=='superadmin'){
  		$username = $_SESSION['username'];
  	}else{
  		header('location:../../'.$_SESSION['hak_akses'].'/home/home.php');
  	}
  }
?>
<!DOCTYPE html>
<html lang="id">
<head>
<title>Cozzal Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../../../asset/css/bootstrap.min.css" />
<link rel="stylesheet" href="../../../asset/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../../../asset/css/uniform.css" />
<link rel="stylesheet" href="../../../asset/css/select2.css" />
<link rel="stylesheet" href="../../../asset/css/new.css" />
<link rel="stylesheet" href="../../../asset/css/matrix-style.css" />
<link rel="stylesheet" href="../../../asset/css/matrix-media.css" />
<link href="../../../asset/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../../../asset/css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../../../asset/css/theme.css" />
<script src="../../../asset/js/jquery.min.js" type="text/javascript"></script>
<script src="../../../asset/js/config.js" type="text/javascript"></script>

<!-- Slider Image -->
<link href="../../../asset/js/js-image-slider.css" rel="stylesheet" type="text/css" />
<script src="../../../asset/js/js-image-slider.js" type="text/javascript"></script>
<!-- //Slider Image -->

<!-- Chart Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js" integrity="sha256-JG6hsuMjFnQ2spWq0UiaDRJBaarzhFbUxiUTxQDA9Lk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js" integrity="sha256-J2sc79NPV/osLcIpzL3K8uJyAD7T5gaEFKlLDM18oxY=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js" integrity="sha256-CfcERD4Ov4+lKbWbYqXD6aFM9M51gN4GUEtDhkWABMo=" crossorigin="anonymous"></script>
<!-- //Chart Js -->

<!-- Full Calendar -->
<link href='../../../asset/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='../../../asset/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='../../../asset/fullcalendar/lib/moment.min.js'></script>
<script src='../../../asset/fullcalendar/lib/jquery.min.js'></script>
<script src='../../../asset/fullcalendar/fullcalendar.min.js'></script>
<!-- //Full Calendar -->
</head>
