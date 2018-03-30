<?php
  include "../template/head.php";
  $thisPage = "Dashboard";
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

<!--Chart-box
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>Site Analytics</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <center>
              <h1>Dashboard Under Constuction!</h1>
            </center>
		      </div>
        </div>
      </div>
    </div>
End-Chart-box-->
    <hr/>
  </div>
</div>
<!--end-main-container-part-->

<?php
  include "../template/footer.php";
?>

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
