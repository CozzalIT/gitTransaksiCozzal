<?php
  require("../../../class/transaksi.php");
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
      <div class="span6">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>Pendapatan dan Pengeluaran</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <!-- Chart -->
            <center>
              <div id="container" style="width: 100%; overflow-x: auto;">
            		<canvas id="canvas"></canvas>
            	</div>
            	<script>
            		var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            		var color = Chart.helpers.color;
            		var barChartData = {
            			labels: ['January', 'February', 'March', 'April'],
                  datasets: [
                    <?php
                      $kd_owner = $_SESSION['pemilik'];
                      $proses_u = new Unit($db);
                      $other = new Other();
                      $show_u = $proses_u->showUnitbyOwner($kd_owner);
                      $bulan = date('m');
                      for($i=0;$i<=3;$i++) {
                        //$listBulan
                      }
                      $i = 1;
                      while($data_u = $show_u->fetch(PDO::FETCH_OBJ)){
                        $color = $other->selectColor($i);
                        echo "
                        {
                            label: '$data_u->no_unit', //optional
                            backgroundColor: color(window.chartColors.$color).alpha(0.5).rgbString(),
                            borderColor: window.chartColors.$color,
                            data: [6500, 5900, 8000, 8100] // y-axis
                        },
                        ";
                        $i++;
                      }
                    ?>
                ]
            		};

            		window.onload = function() {
            			var ctx = document.getElementById('canvas').getContext('2d');
            			window.myBar = new Chart(ctx, {
            				type: 'bar',
            				data: barChartData,
            				options: {
            					responsive: true,
            					legend: {
            						position: 'top',
            					},
            					title: {
            						display: true,
            						text: 'Nomor Unit'
            					}
            				}
            			});
            		};
            	</script>
            </center>
            <!-- //Chart -->
		      </div>
        </div>
      </div>
    </div>
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>Data Booking</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <!-- Chart -->
            <center>
              <div id="container" style="width: 100%; overflow-x: auto;">
            		<canvas id="canvas"></canvas>
            	</div>
            </center>
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
