<?php
  session_start();
  require("../../../class/transaksi.php");
  require("../../../class/unit.php");
  require("../../../class/owner.php");
  require("../../../../config/database.php");

  $thisPage = "Booking";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Laporan Booking</a></div>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5 style="color:#359b20;">Confirmed</h5>
          </div>
          <div class="widget-content nopadding">
			      <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Penyewa</th>
                  <th>Apartemen</th>
                  <th>Unit</th>
                  <th>Check In</th>
        				  <th>Check Out</th>
                </tr>
              </thead>
              <tbody>
      			    <?php
                  $Proses = new Unit($db);
                  $show = $Proses->showUnitbyOwner($_SESSION['pemilik']);
                  $i = 1;
                  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    $kd_unit = $data->kd_unit;
                    $proses = new Owner($db);
                    //View booking berdasarkan unit milik owner
                    $sql = "SELECT COUNT(kd_unit) AS num FROM tb_transaksi WHERE kd_unit = :kd_unit";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(':kd_unit', $kd_unit);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row['num'] > 0){
                      $show1 = $proses->showConfirm($kd_unit);
            				  while($data1 = $show1->fetch(PDO::FETCH_OBJ)){
                					echo "
                					  <tr class='gradeC'>
                					    <td>$i</td>
                					    <td>$data1->nama</td>
                					    <td>$data1->nama_apt</td>
                  						<td>$data1->no_unit</td>
                  						<td>$data1->check_in</td>
                  						<td>$data1->check_out</td>
                					  </tr>
                          ";
                				$i++;
                      }
                    }
                    //==========
                  }
      				  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5 style="color:blue;">Booked</h5>
          </div>
          <div class="widget-content nopadding">
			      <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Penyewa</th>
                  <th>Apartemen</th>
                  <th>Unit</th>
                  <th>Check In</th>
        				  <th>Check Out</th>
                </tr>
              </thead>
              <tbody>
      			    <?php
                  $Proses = new Unit($db);
                  $show = $Proses->showUnitbyOwner($_SESSION['pemilik']);
                  $i = 1;
                  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    $kd_unit = $data->kd_unit;
                    $proses = new Owner($db);
                    //View booking berdasarkan unit milik owner
                    $sql = "SELECT COUNT(kd_unit) AS num FROM tb_transaksi WHERE kd_unit = :kd_unit";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(':kd_unit', $kd_unit);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row['num'] > 0){
                      $show1 = $proses->showBooking($kd_unit);
            				  while($data1 = $show1->fetch(PDO::FETCH_OBJ)){
                					echo "
                					  <tr class='gradeC'>
                					    <td>$i</td>
                					    <td>$data1->nama</td>
                					    <td>$data1->nama_apt</td>
                  						<td>$data1->no_unit</td>
                  						<td>$data1->check_in</td>
                  						<td>$data1->check_out</td>
                					  </tr>
                          ";
                				$i++;
                      }
                    }
                    //==========
                  }
      				  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../../asset/js/sweetalert.min.js"></script>
<script src="../../../asset/js/hapus.js"></script>
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
