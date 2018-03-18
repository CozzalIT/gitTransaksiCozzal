<?php
  require("../../../class/cleaner.php");
  require("../../../class/apartemen.php");
  require("../../../../config/database.php");

  $thisPage = "Status";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="status.php" title="Back to Status" class="tip-bottom">Status Unit</a><a href="#" class="current">Timeline Unit</a></div>
  </div>
  <div class="container-fluid">
    <div id="bingkai">
      <div id="head-bingkai">
        <button type="button" style="float:left;padding-top:3px;" id="left-button" class="fc-prev-button fc-button fc-state-default fc-corner-left"><span class="fc-icon fc-icon-left-single-arrow"></span></button>
        <h5><div style="float:left;" id="cap-timeline"><center id="cap-text">Timeline unit perminggu (1)</center></div></h5>
        <button style="padding-top:3px;" id="rigth-button" type="button" class="fc-next-button fc-button fc-state-default fc-corner-right"><span class="fc-icon fc-icon-right-single-arrow"></span></button>
      </div>
      <?php
      $hari = array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
      $i = 7; $pointer = date('w');
      while ($i--) {
      echo '
      <div id="kotak-'.$i.'" class="kotak';if($i==6) echo' today'; echo'">
        <center>
        <div class="hari">'.$hari[$pointer].'</div>
        <div id="box-white-'.$i.'" class="white">
          <div style="font-size:12px;padding-top:3px;" class="tanggal"><strong id="tanggal-'.$i.'">...</strong></div>
        </div>
        <div id="bulan-'.$i.'" class="bulan">...</div>
        </center>
      </div>
      '; $pointer++;
        if($pointer>6) $pointer=0;
      }
      ?>
      <center><h6 id="selected-day" style="float:left;margin-top: 8px;margin-bottom:5px;">Hari ini</h2></center>

      <div class="widget-box" id="CI-head" style="overflow-x:auto;margin-top:5px;">
        <div class="widget-title"> <span class="icon"><i class="icon-key"></i></span>
          <h5 style="color:#5c5656;">Check In</h5>
        </div>
        <div class="widget-content" id="CI-detail" style="padding:0px;">
<!--Dynamic Element-->
        </div>
      </div>

      <div class="widget-box" id="CO-head" style="overflow-x:auto;margin-top:5px;">
        <div class="widget-title"> <span class="icon"><i class="icon-signout"></i></span>
          <h5 style="color:#5c5656;">Check Out</h5>
        </div>
        <div class="widget-content" id="CO-detail" style="padding:0px;">
<!--Dynamic Element-->
        </div>
      </div>   

      <div class="widget-box" id="ST-head" style="overflow-x:auto;margin-top:5px;">
        <div class="widget-title"> <span class="icon"><i class="icon-ok-sign"></i></span>
          <h5 style="color:#5c5656;">Stay</h5>
        </div>
        <div class="widget-content" id="ST-detail" style="padding:0px;">
<!--Dynamic Element-->
        </div>
      </div> 

      <div class="widget-box" id="KT-head" style="overflow-x:auto;margin-top:5px;">
        <div class="widget-title"> <span class="icon"><i class="icon-inbox"></i></span>
          <h5 style="color:#5c5656;">Keterangan</h5>
        </div>
        <div class="widget-content" id="CO-detail" style="padding:0px;">
          <div class="keterangan-timeline" style="padding:10px;">
            Tidak ada catatan aktifitas.
          </div>
        </div>
      </div>             

    </div>
  </div>
</div>
<!--end-main-container-part-->

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; Brought to you by <a href="http://www.booking.cozzal.com">Cozzal IT</a> </div>
</div>
<!--End-Footer-part-->
<link rel="stylesheet" href="../../../asset/css/timeline.css" />
<script src="../../../asset/js/timeline.js"></script>
<script src="../../../asset/js/sweetalert.min.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/jquery.gritter.min.js"></script>
<script src="../../../asset/js/jquery.peity.min.js"></script>
<script src="../../../asset/js/matrix.interface.js"></script>
<script src="../../../asset/js/matrix.popover.js"></script>
<script src="../../../asset/js/jquery.ui.custom.js"></script>
<!--<script src="js/jquery.uniform.js"></script> -->
<script src="../../../asset/js/select2.min.js"></script>
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
</body>
<?php
  include '../template/modal.php';
?>
</html>
