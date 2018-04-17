<?php
  require("../../../class/transaksi.php");
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
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_ls"> <a href="../booking/booked.php"> <i class="icon-home"></i> Booked bnb</a> </li>
        <li class="bg_lb"> <a href="../transaksi/transaksi.php"> <i class="icon-credit-card"></i> <span class="label label-important"></span> Transaksi</a> </li>
		    <li class="bg_lg span3"> <a href="../transaksi/laporan_transaksi.php"> <i class="icon-inbox"></i> Laporan Transaksi</a> </li>
        <li class="bg_ly"> <a href="../unit/status.php"> <i class="icon-user-md"></i><span class="label label-success"></span> Status Unit</a> </li>
        <li class="bg_lo"> <a href="../unit/timeline.php"> <i class="icon-columns"></i> Timeline</a> </li>
        <li class="bg_ly"> <a href="../transaksi/confirm_transaksi.php"> <i class="icon-columns"></i> Confirm</a> </li>
		    <li class="bg_ls"> <a href="../transaksi/cancel_transaksi.php"> <i class="icon-sitemap"></i> Cancel</a> </li>
		    <li class="bg_lr span3"> <a href="../transaksi_umum/transaksi_umum.php"> <i class="icon-money"></i> Transaksi Umum</a> </li>
        <li class="bg_lb"> <a href="../unit/task.php"> <i class="icon-tasks"></i> Task Cleaner</a> </li>
        <li class="bg_lg"> <a href="../unit/unit.php"> <i class="icon-list"></i> List Unit</a> </li>
      </ul>
    </div>
<!--End-Action boxes-->

    <div class="row-fluid">
      <div class="">
        <div class="widget-box">
          <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
            <h5>Statistik Cozzal</h5>
          </div>
          <div class="widget-content nopadding" >
            <div class="row-fluid"  style="overflow-x:auto;">
            <!-- Chart -->
              <div class="span9">
                <center>
                  <div id="ctr_transaksi" style="width: 100%;">
                    <canvas id="cv_transaksi"></canvas>
                	</div>
                  <div id="ctr_pendapatan" style="width: 100%;" class="hide">
                    <canvas id="cv_pendapatan"></canvas>
                	</div>
                  <div id="ctr_keuntungan_kotor" style="width: 100%;" class="hide">
                		<canvas id="cv_keuntungan_kotor"></canvas>
                	</div>
                </center>
              </div>
              <div class="span3">
                <center>
                  <button class="bg_ls btn btn-success chart-button" type="button" onclick="viewTransaksi()">Transaksi</button>
                  <br>
                  <button class="bg_lb btn btn-success chart-button" type="button" onclick="viewPendapatan()">Pendapatan</button>
                  <br>
                  <button class="bg_lg btn btn-success chart-button" type="button" onclick="viewKeuntunganKotor()">Keuntungan Kotor</button>
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
include "../../../asset/chart/chart_global.php"
?>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; Brought to you by <a href="http://www.booking.cozzal.com">Cozzal IT</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../../asset/js/jquery.min.js"></script>
<script src="../../../asset/js/jquery.ui.custom.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/jquery.uniform.js"></script>
<script src="../../../asset/js/select2.min.js"></script>
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
</body>
</html>
