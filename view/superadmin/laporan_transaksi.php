<?php
  session_start();
  require("../../class/transaksi.php");
  require("../../config/database.php");

  if(!isset($_SESSION['username'])) {
    header('location:../../index.php');
  }else {
    $username = $_SESSION['username'];
  }

  $thisPage = "Transaksi";

  include "template/head.php";
?>
<body>
<?php
  include "template/header.php";
  include "template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <a href="transaksi.php" class="btn btn-success btn-add"><i class="icon-plus"></i> Transaksi Baru</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Laporan Transaksi</h5>
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
                  <th>Detail</th>
        				  <th>Action</th>
                </tr>
              </thead>
              <tbody>
      			    <?php
        				  $Proses = new Transaksi($db);
        				  $show = $Proses->showTransaksi();
        				  $i = 1;
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
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
                            <a class='btn btn-success' id='detail' name='detail' href='laporan_transaksi.php?detail=$data->kd_transaksi'>Detail</a>
                            <a class='btn btn-info' href='proses/proses_add.php?addConfirm=$data->kd_transaksi'>Confirm</a>
                          </center>
                        </td>
            						<td>
                          <center>
              						  <a class='btn btn-primary' href='edit.php?edit_transaksi=$data->kd_transaksi'>Edit</a>
              						  <a class='btn btn-danger' href='proses/proses_delete.php?delete_transaksi=$data->kd_transaksi'>Hapus</a>
                          </center>
                        </td>
          					  </tr>
                    ";
          				$i++;
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
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../asset/js/jquery.min.js"></script>
<script src="../../asset/js/jquery.ui.custom.js"></script>
<script src="../../asset/js/bootstrap.min.js"></script>
<script src="../../asset/js/jquery.uniform.js"></script>
<script src="../../asset/js/select2.min.js"></script>
<script src="../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../asset/js/matrix.js"></script>
<script src="../../asset/js/matrix.tables.js"></script>
</body>
<?php
  include 'template/modal.php';
?>
</html>
