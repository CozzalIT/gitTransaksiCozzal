<?php
  require("../../../class/transaksi.php");
  require("../../../class/transaksi_umum.php");
  require("../../../class/unit.php");
  require("../../../class/owner.php");
  require("../../../class/other.php");
  require("../../../../config/database.php");

  $thisPage = "Dashboard";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb span5"> <a href="home.php"> <i class="icon-home"></i> <span class="label label-important"></span> Dashboard </a> </li>
        <li class="bg_lg span6"> <a href="../unit/unit.php"> <i class="icon-edit"></i> Listing Unit</a> </li>
        <li class="bg_ly span5"> <a href="../booking/laporan_booking.php"> <i class="icon-th-large"></i><span class="label label-success"></span> Laporan Booking </a> </li>
        <li class="bg_lo span6"> <a href="../booking/pendapatan.php"> <i class="icon-money"></i> Pendapatan</a> </li>
      </ul>
    </div>
<!--End-Action boxes-->

    <div class="row-fluid">
      <div class="">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>Statistik Owner</h5>
        </div>
        <div class="widget-content nopadding">
          <div class="row-fluid" style="overflow-x">
            <!-- Chart -->
          <div class="span9">
              <center>
                <div id="ctr_pendapatan" style="width: 100%;">
                  <canvas id="cv_pendapatan"></canvas>
                </div>
                <div id="ctr_pengeluaran" style="width: 100%;" class="hide">
                  <canvas id="cv_pengeluaran"></canvas>
                </div>
                <div id="ctr_booking" style="width: 100%;" class="hide">
                  <canvas id="cv_booking"></canvas>
                </div>
              </center>
          </div>
          <div class="span3">
            <center>
              <button class="bg_ls btn btn-success chart-button" type="button" onclick="viewPendapatan()">Pendapatan</button>
              <br>
              <button class="bg_lb btn btn-success chart-button" type="button" onclick="viewPengeluaran()">Pengeluaran</button>
              <br>
              <button class="bg_lo btn btn-success chart-button" type="button" onclick="viewBooking()">Data Booking</button>
              <br>
            </center>
            <ul class="site-stats" style="padding-top: 10px;padding-bottom: 10px;">
              <li class="bg_lh"><i class="icon-user"></i> <strong>2540</strong> <small>Dummy</small></li>
              <li class="bg_lh"><i class="icon-plus"></i> <strong>120</strong> <small>Dummy</small></li>
              <li class="bg_lh"><i class="icon-shopping-cart"></i> <strong>656</strong> <small>Dummy</small></li>
              <li class="bg_lh"><i class="icon-tag"></i> <strong>9540</strong> <small>Dummy</small></li>
              <li class="bg_lh"><i class="icon-repeat"></i> <strong>10</strong> <small>Dummy</small></li>
              <li class="bg_lh"><i class="icon-globe"></i> <strong>8540</strong> <small>Dummy</small></li>
            </ul>
          </div>
            <!-- //Chart -->
		      </div>
        </div>
      </div>
    </div>
    </div>
    <hr/>
  </div>
</div>
<!--end-main-container-part-->

<?php
  include "../../../asset/chart/chart_owner.php"
?>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; Brought to you by <a href="http://www.booking.cozzal.com">Cozzal IT</a> </div>
</div>
<!--end-Footer-part-->

<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/unit.js"></script>
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
</html>
