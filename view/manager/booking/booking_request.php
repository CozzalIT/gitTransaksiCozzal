<?php
  require("../../../class/booking.php");
  require("../../../../config/database.php");

  $thisPage = "Booking Request";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Booking Resuest</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <h3>Booking Request</h3>
        <hr>
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Penyewa</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>No Telpon</th>
                  <th>Apartemen</th>
                  <th>Unit</th>
                  <th>Check In</th>
                  <th>Check Out</th>
                  <th>Tanggal Request</th>
				          <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $Proses = new Booking($db);
        				  $show = $Proses->showRequestBook();
                  $i = 1;
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
          					echo "
          					  <tr class=gradeC'>
          					    <td>$i</td>
          					    <td>$data->nama</td>
          						  <td>$data->no_tlp</td>
          						  <td>$data->nama_apt</td>
                        <td>$data->no_unit</td>
          						  <td>$data->check_in</td>
                        <td>$data->check_out</td>
                        <td>$data->tgl_reservasi</td>
                        <td>
                          <a class='btn btn-success' href='transaksi.php?kd_reservasi=$data->kd_reservasi'>Transaksi</a>
                          <a class='btn btn-danger hapus' href='../../../proses/booking.php?delete_booking_rq=$data->kd_reservasi'>Hapus</a>
                        </td>
          					  </tr>
                    ";
                    $i++;
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
