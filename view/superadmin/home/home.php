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
        <li class="bg_ls"> <a href="home.php"> <i class="icon-home"></i> Dashboard</a> </li>
        <li class="bg_lg span3"> <a href="../owner/owner_payment.php"> <i class="icon-inbox"></i> Owner Payment</a> </li>
        <li class="bg_lb"> <a href="../transaksi/transaksi.php"> <i class="icon-money"></i> <span class="label label-important"></span> Transaksi </a> </li>
        <li class="bg_ly"> <a href="../unit/task.php"> <i class="icon-user-md"></i><span class="label label-success"></span> Task Cleaner </a> </li>
        <li class="bg_lo"> <a href="../kas/kas.php"> <i class="icon-credit-card"></i> Kas</a> </li>
        <li class="bg_lo span3"> <a href="../account/account_management.php"> <i class="icon-sitemap"></i> Account Management</a> </li>
        <li class="bg_ls"> <a href="../apartemen/apartemen.php"> <i class="icon-columns"></i> Apartemen</a> </li>
        <li class="bg_lr"> <a href="../transaksi_umum/transaksi_umum.php"> <i class="icon-money"></i> T. Umum</a> </li>
        <li class="bg_lg"> <a href="../unit/status.php"> <i class="icon-tasks"></i> Status Unit</a> </li>
        <li class="bg_lb"> <a href="../unit/unit.php"> <i class="icon-list"></i> List Unit</a> </li>
      </ul>
    </div>
<!--End-Action boxes-->

    <div class="row-fluid">
      <div class="">
        <div class="widget-box">
          <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
            <h5>Data Transaksi Tahun 2018</h5>
          </div>
          <div class="widget-content" >
            <div class="row-fluid">
            <!-- Chart -->
              <center>
                <div id="container" style="width: 100%;">
              		<canvas id="canvas"></canvas>
              	</div>
            	  <script>
                  var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                  var config = {
                    type: 'line',
                    data: {
                      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                      datasets: [{
                        label: 'Confirm',
                        backgroundColor: window.chartColors.purple,
                        borderColor: window.chartColors.purple,
                        data: [
                          <?php
                            $proses_t = new Transaksi($db);
                            for($i=1;$i<=12;$i++){
                          		$show_t = $proses_t->showSumMonth($i, 2018, 41);
                          		$jumlahHari=0;
                          		while($data_t = $show_t->fetch(PDO::FETCH_OBJ)){
                          			$jumlahHari = $jumlahHari + $data_t->hari;
                          		}
                              echo $jumlahHari.',';
                        	  }
                          ?>
                        ],
                        fill: false,
                      }, {
                        label: 'Booked',
                        backgroundColor: window.chartColors.blue,
                        borderColor: window.chartColors.blue,
                        data: [
                          <?php
                            $proses_t = new Transaksi($db);
                            for($i=1;$i<=12;$i++){
                          		$show_t = $proses_t->showSumMonth($i, 2018, 1);
                          		$jumlahHari=0;
                          		while($data_t = $show_t->fetch(PDO::FETCH_OBJ)){
                          			$jumlahHari = $jumlahHari + $data_t->hari;
                          		}
                              echo $jumlahHari.',';
                        	  }
                          ?>
                        ],
                        fill: false,
                      }, {
                        label: 'Cancel',
                        backgroundColor: window.chartColors.yellow,
                        borderColor: window.chartColors.yellow,
                        data: [
                          <?php
                            $proses_t = new Transaksi($db);
                            for($i=1;$i<=12;$i++){
                          		$show_t = $proses_t->showSumMonth($i, 2018, 2);
                          		$jumlahHari=0;
                          		while($data_t = $show_t->fetch(PDO::FETCH_OBJ)){
                          			$jumlahHari = $jumlahHari + $data_t->hari;
                          		}
                              echo $jumlahHari.',';
                        	  }
                          ?>
                        ],
                        fill: false,
                      }]
                    },
                    options: {
                      responsive: true,
                      elements: {
                				line: {
                					tension: 0.000001
                				}
                			},
                      title: {
                        display: true,
                        text: 'Status Transaksi'
                      },
                      tooltips: {
                        mode: 'index',
                        intersect: false,
                      },
                      hover: {
                        mode: 'nearest',
                        intersect: true
                      },
                      scales: {
                        xAxes: [{
                          display: true,
                          scaleLabel: {
                            display: true,
                            labelString: 'Bulan'
                          }
                        }],
                        yAxes: [{
                          display: true,
                          scaleLabel: {
                            display: true,
                            labelString: 'Hari'
                          }
                        }]
                      }
                    }
                  };

                  window.onload = function() {
                    var ctx = document.getElementById('canvas').getContext('2d');
                    window.myLine = new Chart(ctx, config);
                  };
              	</script>
              </center>
            <!-- //Chart -->
		        </div>
          </div>
        </div>
      </div>
      <div>
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
            <h5>Keuntungan Kotor</h5>
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
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
            <h5>Pendapatan</h5>
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
    </div>
    <hr/>
  </div>
</div>
<!--end-main-container-part-->

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

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {

          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();
          }
          // else, send page to designated URL
          else {
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>
