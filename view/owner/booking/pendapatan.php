<?php
  require("../../../class/transaksi.php");
  require("../../../class/unit.php");
  require("../../../class/owner.php");
  require("../../../../config/database.php");

  $thisPage = "Pendapatan";

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
          <div class="widget-title"> <span class="icon"><i class="icon-money" style="color:#359b20;"></i></span>
            <h5 style="color:#359b20;">Pendapatan</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th class="hide"> No</th>
                  <th>Tanggal Pembayaran</th>
                  <th>Jumlah Transaksi</th>
                  <th>Nominal</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i=1;
                  $proses = new Owner($db);
                  $show_history = $proses->showOwnerPayment($_SESSION['pemilik']);
                  while($data_history = $show_history->fetch(PDO::FETCH_OBJ)){
                    $tanggal = explode(" ",$data_history->tgl_pembayaran);
                    $formatTanggal = explode("-",$tanggal[0]);
                    switch ($formatTanggal[1]) {
                      case '01':
                        $formatTanggal[1] = 'Januari';
                        break;
                      case '02':
                        $formatTanggal[1] = 'Februari';
                        break;
                      case '03':
                        $formatTanggal[1] = 'Maret';
                        break;
                      case '04':
                        $formatTanggal[1] = 'April';
                        break;
                      case '05':
                        $formatTanggal[1] = 'Mei';
                        break;
                      case '06':
                        $formatTanggal[1] = 'Juni';
                        break;
                      case '07':
                        $formatTanggal[1] = 'Juli';
                        break;
                      case '08':
                        $formatTanggal[1] = 'Agustus';
                        break;
                      case '09':
                        $formatTanggal[1] = 'September';
                        break;
                      case '10':
                        $formatTanggal[1] = 'Oktober';
                          break;
                      case '11':
                        $formatTanggal[1] = 'November';
                        break;
                      case '12':
                        $formatTanggal[1] = 'Desember';
                        break;
                    }
                    $tanggalIndo = $formatTanggal[2]." ".$formatTanggal[1]." ".$formatTanggal[0];
                    echo "
                      <tr class='gradeC'>
                        <td class='hide'>$i</td>
                        <td>$tanggalIndo</td>
                        <td>$data_history->jumlah_transaksi Transaksi</td>
                        <td>".number_format($data_history->nominal, 0, ".", ".")." IDR</td>
                        <td>
                          <center>
                            <a class='btn btn-success' id='detail' name='detail' href='detail_payment.php?detail=$data_history->kd_owner_payment'>Detail</a>
                          </center>
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
