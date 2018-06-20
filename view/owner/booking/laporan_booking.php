<?php
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
    <a href="pendapatan.php" class="btn btn-success btn-add"><i class="icon-check"></i> Total Pendapatan</a>
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
                  <th>Pendapatan</th>
                  <th id='sort'>Action</th>
                </tr>
              </thead>
              <tbody>
      			    <?php
                  $Proses = new Unit($db);
                  $show = $Proses->showUnitbyOwner($_SESSION['pemilik']);
                  $i = 1;
                  $j = 0;
                  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    $kd_unit[$j] = $data->kd_unit;
                    $proses = new Owner($db);
                    $show1 = $proses->showBooking($kd_unit[$j]);
            				while($data1 = $show1->fetch(PDO::FETCH_OBJ)){
                      $check_in = $data1->check_in;
                      $check_out = $data1->check_out;
                      if($data1->total_harga_owner>0){
          						  $pendapatan = $data1->total_harga_owner;
          					  }else{
          						  $pendapatan = ($data1->hari_weekend * $data1->harga_owner_weekend) + ($data1->hari_weekday * $data1->harga_owner);
          					  }
                      if($data1->status == '42' or $data1->status == '41'){
                        echo "
                    			<tr class='gradeC'>
                    				<td>$i</td>
                    				<td>$data1->nama</td>
                    				<td>$data1->nama_apt</td>
                      		  <td>$data1->no_unit</td>
                      			<td>$check_in</td>
                      			<td>$check_out</td>
                            <td>".number_format($pendapatan, 0, ".",".")." IDR</td>
                            ".($data1->status == '41' ? '<td style="color:green;"><strong>Paid</strong></td>' : '<td style="color:red;"><strong>Unpaid</strong></td>')."
                    			</tr>
                        ";
                    		$i++;
                      }
                    }
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
                  <th>Pendapatan</th>
                </tr>
              </thead>
              <tbody>
                <<?php
                  $Proses = new Unit($db);
                  $show = $Proses->showUnitbyOwner($_SESSION['pemilik']);
                  $i = 1;
                  $j = 0;
                  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    $kd_unit[$j] = $data->kd_unit;
                    $proses = new Owner($db);
                    $show1 = $proses->showBooking($kd_unit[$j]);
            				while($data1 = $show1->fetch(PDO::FETCH_OBJ)){
                      $check_in = $data1->check_in;
                      $check_out = $data1->check_out;
                      if($data1->total_harga_owner>0){
          						  $pendapatan = $data1->total_harga_owner;
          					  }else{
          						  $pendapatan = ($data1->hari_weekend * $data1->harga_owner_weekend) + ($data1->hari_weekday * $data1->harga_owner);
          					  }
                      if($data1->status == '1'){
                        echo "
                          <tr class='gradeC'>
                            <td>$i</td>
                            <td>$data1->nama</td>
                            <td>$data1->nama_apt</td>
                            <td>$data1->no_unit</td>
                            <td>$data1->check_in</td>
                            <td>$data1->check_out</td>
                            <td>".number_format($pendapatan, 0, ".",".")." IDR</td>
                          </tr>
                        ";
                        $i++;
                      }
                    }
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
<script>
  function sortAction(){
    var sort = document.getElementById('sort');
    sort.click();
  }
  window.onload = sortAction;
</script>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; Brought to you by <a href="http://www.booking.cozzal.com">Cozzal IT</a> </div>
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
