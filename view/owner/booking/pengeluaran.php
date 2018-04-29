<?php
  require("../../../class/transaksi.php");
  require("../../../class/transaksi_umum.php");
  require("../../../class/unit.php");
  require("../../../class/owner.php");
  require("../../../../config/database.php");

  $thisPage = "Pengeluaran";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Pengeluaran</a></div>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-money" style="color:#da4444;"></i></span>
            <h5 style="color:#da4444;">Pengeluaran</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kebutuhan</th>
                  <th>Apartemen</th>
                  <th>Unit</th>
                  <th>Jumlah</th>
                  <th>Nominal</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  $kd_owner = $_SESSION['pemilik'];
                  $proses_u = new Unit($db);
                  $show_u = $proses_u->showUnitbyOwner($kd_owner);
                  while($data_u = $show_u->fetch(PDO::FETCH_OBJ)){
                    $kd_unit = $data_u->kd_unit;
                    $kebutuhan = "unit/$kd_unit";
                    $proses_t = new TransaksiUmum($db);
                    $show_t = $proses_t->showTUByKebutuhan($kebutuhan);
                    while ($data_t = $show_t->fetch(PDO::FETCH_OBJ)) {
                      $tanggal = explode(" ",$data_t->tanggal);
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
                          <td>$i</td>
                          <td>$data_t->keterangan</td>
                          <td>$data_u->nama_apt</td>
                          <td>$data_u->no_unit</td>
                          <td>$data_t->jumlah</td>
                          <td>".number_format($data_t->harga*$data_t->jumlah, 0, ".", ".")." IDR</td>
                          <td>$tanggalIndo</td>
                      ";
                      $i++;
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
