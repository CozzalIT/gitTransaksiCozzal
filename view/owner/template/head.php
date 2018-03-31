<?php
//  function customError(){error:
//  echo '<div class="hide">Error</div>'; 
//  }
  //set error handler
//  set_error_handler("customError");
//  session_save_path('../../../session');
  session_start();
  ob_start();
  if(!isset($_SESSION['username'])) {
    header('location:../../../index.php');
  }else {
  	if($_SESSION['hak_akses']=='owner'){
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
<script src="../../../asset/js/jquery.min.js" type="text/javascript"></script>
<script src="../../../asset/js/config.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../../asset/css/theme.css" />

<!-- Slider Image -->
<link href="../../../asset/js/js-image-slider.css" rel="stylesheet" type="text/css" />
<script src="../../../asset/js/js-image-slider.js" type="text/javascript"></script>
<!-- //Slider Image -->

<!-- Full Calendar -->
<link href='../../../asset/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='../../../asset/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='../../../asset/fullcalendar/lib/moment.min.js'></script>
<script src='../../../asset/fullcalendar/lib/jquery.min.js'></script>
<script src='../../../asset/fullcalendar/fullcalendar.min.js'></script>
<!-- //Full Calendar -->
</head>
