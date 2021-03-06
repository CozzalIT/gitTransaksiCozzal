<?php
  require("../../../class/transaksi.php");
  require("../../../../config/database.php");

  $thisPage = "Confirm Transaksi";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Konfirmasi Transaksi</a></div>
    <a href="transaksi.php" class="btn btn-success btn-add"><i class="icon-plus"></i> Transaksi Baru</a>
    <a href="laporan_transaksi.php" class="btn btn-primary btn-add"><i class="icon-edit"></i> Laporan Transaksi</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Confirm Transaksi</h5>
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
        				  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
        				  $Proses = new Transaksi($db);
        				  $show = $Proses->showTransaksi();
        				  $i = 1;
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    if($data->status == 42){
            					echo "
            					  <tr class='gradeC'>
            					    <td>$i</td>
            					    <td>$data->nama</td>
            					    <td>$data->nama_apt</td>
              						<td>$data->no_unit</td>
              						<td>$data->check_in</td>
              						<td>$data->check_out</td>
            						<td>
                          <center>
                            <a class='btn btn-primary' href='kwitansi.php?kwitansi=$data->kd_transaksi'>Kwitansi</a>
              						 
                          </center>
                        </td>
          					  </tr>
                    ";
                    $i++;
                    }
                  };
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
<?php
  include '../template/modal.php';
?>
</html>
