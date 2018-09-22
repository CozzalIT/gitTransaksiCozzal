<?php
  require("../../../class/transaksi_umum.php");
  require("../../../class/transaksi.php");
  require("../../../class/owner.php");
  require("../../../class/kas.php");
  require("../../../class/unit.php");
  require("../../../../config/database.php");

  $thisPage = "Owner Payment";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Detail Payment</a></div>
   <a href="list_kwitansi.php" class="btn btn-primary btn-add"> Waiting List Kwitansi</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Detail Payment</h5>
          </div>
          <div class="widget-content nopadding">
			      <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis</th>
                  <th>Apartemen</th>
                  <th>Unit</th>
                  <th>Check In / Check Out</th>
        				  <th>Nominal</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(isset($_GET['detail'])){
                    $kode = explode("x",$_GET['detail']);
                    $transaksi = explode("a",$kode[0]);
                    $transaksi_umum = explode("b",$kode[1]);
                  }
				          $proses_t = new Transaksi($db);
                  $proses_u = new Unit($db);
                  $i=1;
                  $total_in=0;
                  $subtotal_in=0;
                  foreach($transaksi as $kd_transaksi) {
                    if($kd_transaksi <> 'dummy'){
                      $show_t = $proses_t->editTransaksi($kd_transaksi);
                      $data_t = $show_t->fetch(PDO::FETCH_OBJ);
                      $subtest= $data_t ->total_harga_owner;
        							if($subtest>0){
        								$nominal = $data_t->total_harga_owner;
        								$weekend = 0;
        								$weekday = 0;
        							}else{
        								$weekend = $data_t->hari_weekend*$data_t->harga_owner_weekend;
        								$weekday = $data_t->hari_weekday*$data_t->harga_owner;
        								$nominal = $weekday+$weekend;
        							}
                      echo "
                        <tr class='gradeC'>
                          <td>$i</td>
                          <td>Transakai : COZ-".strtoupper(dechex($kd_transaksi))."</td>
                          <td>$data_t->nama_apt</td>
                          <td>$data_t->no_unit</td>
                          <td>
                            <center>
                              $data_t->check_in / $data_t->check_out
                            </center>
                          </td>
                          <td>".number_format($nominal, 0, ".", ".")." IDR</td>
                        </tr>
                      ";
                      $i++;
                    }
                  }
                  if($transaksi_umum[0] <> null){
                    foreach($transaksi_umum as $kd_transaksi_umum){
                      $proses_tu = new TransaksiUmum($db);
                      $proses_u = new Unit($db);

                      $show_tu = $proses_tu->editTransaksiUmum($kd_transaksi_umum);
                      $data_tu = $show_tu->fetch(PDO::FETCH_OBJ);

                      $kd_unit = explode('/',$data_tu->kebutuhan);
                      $show_u = $proses_u->editUnit($kd_unit[1]);
                      $data_u = $show_u->fetch(PDO::FETCH_OBJ);
                      echo "
                        <tr class='gradeC'>
                          <td>$i</td>
                          <td>T-Umum <strong>($data_tu->keterangan)</strong></td>
                          <td>$data_u->nama_apt</td>
                          <td>$data_u->no_unit</td>
                          <td>
                            <center>-</center>
                          </td>
                          <td>".number_format($data_tu->harga*$data_tu->jumlah*(-1), 0, ".", ".")." IDR</td>
                        </tr>
                      ";
                      $i++;
                    }
                  }
                ?>
                <td colspan="6">
                  <form id="formRespon" action="../../../proses/owner.php" method="post">
                    <?php
                      if(isset($_GET['detail'])){
                        $kd_owner_payment = $_GET['detail'];
                        echo "
                          <input name='kd_owner_payment' value='$kd_owner_payment' class='hide' />
                        ";
                      }
                    ?>
                    <button class="btn btn-danger pull-right" name="rejectKwitansi" style="margin-left: 15px;" onclick="kirimRespon()">Reject</button>
                    <button class="btn btn-success pull-right" name="confirmKwitansi" onclick="kirimRespon()">Confirm</button>
                  </form>
                  <script>
                    function kirimRespon(){
                      document.getElementById('formRespon').submit();
                    }
                  </script>
                </td>
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
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
</body>
</html>
