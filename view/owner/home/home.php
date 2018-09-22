<?php
  require("../../../class/transaksi.php");
  require("../../../class/transaksi_umum.php");
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
        <li class="bg_lb span2"> <a href="home.php"> <i class="icon-home"></i> <span class="label label-important"></span> Dashboard </a> </li>
        <li class="bg_lg span2"> <a href="../unit/unit.php"> <i class="icon-edit"></i> Listing Unit</a> </li>
        <li class="bg_ly span3"> <a href="../booking/laporan_booking.php"> <i class="icon-th-large"></i><span class="label label-success"></span> Laporan Booking </a> </li>
        <li class="bg_lo span2"> <a href="../booking/pendapatan.php"> <i class="icon-money"></i> Pendapatan</a> </li>
        <li class="bg_ls span2"> <a href="../booking/pengeluaran.php"> <i class="icon-money"></i> Pengeluaran</a> </li>
      </ul>
    </div>
<!--End-Action boxes-->

    <div class="row-fluid">
      <?php
        $proses_u = new Unit($db);
        $proses_o = new Owner($db);
        $i = 0;
        $show = $proses_u->showUnitbyOwner($_SESSION['pemilik']);
        while($data = $show->fetch(PDO::FETCH_OBJ)){
          $unit[$i] = $data->kd_unit;
          $i++;
        }
        $jumlahUnit = count($unit);

        $j = 0;
        for ($i=0; $i<$jumlahUnit; $i++) {
          $show_o = $proses_o->showPenawaranByUnit($unit[$i]);
          while($data_o = $show_o->fetch(PDO::FETCH_OBJ)){
            if($data_o->status == 0){
              $penawaran[$i][$j] = $data_o->kd_penawaran;
              $judulPenawaran[$i][$j] = $data_o->judul;
              $pesanPenawaran[$i][$j] = $data_o->pesan;
              $kd_unit[$i][$j] = $data_o->kd_unit;
              $no_unit[$i][$j] = $data_o->no_unit;
              $wd[$i][$j] = $data_o->h_owner_wd;
              $we[$i][$j] = $data_o->h_owner_we;
              $mg[$i][$j] = $data_o->h_owner_mg;
              $bln[$i][$j] = $data_o->h_owner_bln;
              $j++;
            }
          }
        }
        $totalPenawaran = $j;
        /*
        for ($i=0; $i<$jumlahUnit; $i++) {
          if ($penawaran[$i] != null){
            $jumlahPenawaranUnit[$i] = count($penawaran[$i]);
          }else {
            $jumlahPenawaranUnit[$i] = 0;
          }
          $totalPenawaran += $jumlahPenawaranUnit[$i];
        }
        */
        $unit = 0;
        for ($i=0; $i<$totalPenawaran ; $i++) {
          echo'
            <div class="span12">
              <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                  <h5>'.$judulPenawaran[$unit][$i].' ('.$no_unit[$unit][$i].')</h5>
                </div>
                <div class="widget-content nopadding">
                  <form action="#" method="get" class="form-mod">
                    <div class="control-group">
                      <div class="controls">
                        <p>'.$pesanPenawaran[$unit][$i].'</p>
                      </div>
                    </div>
                    ';
                    if ($wd[$unit][$i] != 0){
                      echo'
                      <div class="control-group">
                        <div class="controls">
                          <label>Weekday '.number_format($wd[$unit][$i], 0, ".", ".").' IDR</label>
                        </div>
                      </div>
                      ';
                    }
                    if ($we[$unit][$i] != 0){
                      echo'
                      <div class="control-group">
                        <div class="controls">
                          <label>Weekend '.number_format($we[$unit][$i], 0, ".", ".").' IDR</label>
                        </div>
                      </div>
                      ';
                    }
                    if ($mg[$unit][$i] != 0){
                      echo'
                      <div class="control-group">
                        <div class="controls">
                          <label>Mingguan '.number_format($mg[$unit][$i], 0, ".", ".").' IDR</label>
                        </div>
                      </div>
                      ';
                    }
                    if ($bln[$unit][$i] != 0){
                      echo'
                      <div class="control-group">
                        <div class="controls">
                          <label>Bulanan '.number_format($bln[$unit][$i], 0, ".", ".").' IDR</label>
                        </div>
                      </div>
                      ';
                    }
                    echo'
                    <div class="form-actions">
                      <a class="btn btn-success" href="../../../proses/owner.php?statusPenawaran=1&kd_penawaran='.$penawaran[$unit][$i].
                        '&wd='.$wd[$unit][$i].'&we='.$we[$unit][$i].
                        '&mg='.$mg[$unit][$i].'&bln='.$bln[$unit][$i].
                        '&kd_unit='.$kd_unit[$unit][$i].'&kd_owner='.$_SESSION['pemilik'].'">Terima</a>
                      <a class="btn btn-danger" href="../../../proses/owner.php?statusPenawaran=2&kd_penawaran='.$penawaran[$unit][$i].'">Tolak</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          ';
          $unit++;
        }
      ?>


      <div class="">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>Statistik Owner</h5>
        </div>
        <div class="widget-content nopadding">
          <div class="row-fluid" style="overflow-x">
            <!-- Chart -->
          <div class="span9">
              <center>
                <div id="ctr_pendapatan" style="width: 100%;">
                  <canvas id="cv_pendapatan"></canvas>
                </div>
                <div id="ctr_pengeluaran" style="width: 100%;" class="hide">
                  <canvas id="cv_pengeluaran"></canvas>
                </div>
                <div id="ctr_booking" style="width: 100%;" class="hide">
                  <canvas id="cv_booking"></canvas>
                </div>
              </center>
          </div>
          <div class="span3">
            <center>
              <button class="bg_ls btn btn-success chart-button" type="button" onclick="viewPendapatan()">Pendapatan</button>
              <br>
              <button class="bg_lb btn btn-success chart-button" type="button" onclick="viewPengeluaran()">Pengeluaran</button>
              <br>
              <button class="bg_lo btn btn-success chart-button" type="button" onclick="viewBooking()">Data Booking</button>
              <br>
            </center>
            <ul class="site-stats" style="padding-top: 10px;padding-bottom: 10px;">
              <li class="bg_lh"><i class="icon-user"></i> <strong>2540</strong> <small>Dummy</small></li>
              <li class="bg_lh"><i class="icon-plus"></i> <strong>120</strong> <small>Dummy</small></li>
              <li class="bg_lh"><i class="icon-shopping-cart"></i> <strong>656</strong> <small>Dummy</small></li>
              <li class="bg_lh"><i class="icon-tag"></i> <strong>9540</strong> <small>Dummy</small></li>
              <li class="bg_lh"><i class="icon-repeat"></i> <strong>10</strong> <small>Dummy</small></li>
              <li class="bg_lh"><i class="icon-globe"></i> <strong>8540</strong> <small>Dummy</small></li>
            </ul>
          </div>
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
  include "../../../asset/chart/chart_owner.php"
?>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; Brought to you by <a href="http://www.booking.cozzal.com">Cozzal IT</a> </div>
</div>
<!--end-Footer-part-->

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
