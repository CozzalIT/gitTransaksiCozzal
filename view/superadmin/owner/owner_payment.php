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
    <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Owner Payment</a></div>
    <form method="post" action="#">
      <div class="control-group btn-add">
        <select name="kd_owner" class="span2" style="">
          <option>--Pilih Owner--</option>
          <?php
            $Proses = new Owner($db);
            $show = $Proses->showOwner();
            while($data = $show->fetch(PDO::FETCH_OBJ)){
              if ($data->kd_owner != 0){
                echo "<option name='kd_owner' value='$data->kd_owner'>$data->nama</option>";
              }
            }
          ?>
        </select>
      </div>
      <button type="submit" href="laporan_transaksi.php" class="btn btn-primary" style="margin-left:20px;">Tampilkan</button>
    </form>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab1">Unpaid</a></li>
              <li><a data-toggle="tab" href="#tab2">Paid</a></li>
            </ul>
          </div>
          <script language="JavaScript">
            function checkAll(source) {
              checkboxes = document.getElementsByName('ownerPayment[]');
              for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
              }
            }
          </script>
          <div class="widget-content tab-content nopadding">
            <div id="tab1" class="tab-pane active">
              <form action="kwitansi_owner.php" method="post">
    			      <table class="table table-bordered data-table">
                  <tr>
                    <th class='hide'> No</th>
                    <th><input type="checkbox" onClick="checkAll(this)" /> All</th>
                    <th>Jenis</th>
                    <th>Apartemen</th>
                    <th>Unit</th>
                    <th>Check In/Out</th>
            				<th>Nominal</th>
                  </tr>
                  <tbody>
                    <?php
                      if(isset($_POST['kd_owner'])){
              				  $proses_u = new Unit($db);
                        $proses_t = new Transaksi($db);
                        $proses_tu = new TransaksiUmum($db);
                        $proses_k = new Kas($db);
                        $_SESSION['kd_owner'] = $_POST['kd_owner'];
              				  $show_u = $proses_u->showUnitbyOwner($_POST['kd_owner']);
                        while($data_u = $show_u->fetch(PDO::FETCH_OBJ)){
                          $owner_we = $data_u->h_owner_we;
                          $owner_wd = $data_u->h_owner_wd;
                          $show_t = $proses_t->showTransaksiByUnit($data_u->kd_unit);
                          $i = 1;
                				  while($data_t = $show_t->fetch(PDO::FETCH_OBJ)){
                            if($data_t->status == 42){

                              if($data_t->hari_weekend == 0){
                                $nominal = $data_t->hari_weekday*$owner_wd;
                              }elseif($data_t->hari_weekday == 0){
                                $nominal = $data_t->hari_weekend*$owner_we;
                              }elseif($data_t->hari_weekday <> 0 && $data_t->hari_weekend <> 0){
                                $nominal = ($data_t->hari_weekend*$owner_we)+($data_t->hari_weekend*$owner_we);
                              }
                      				echo "
                      					<tr class='gradeC'>
                                  <td class='hide'>$i</td>
                      					  <td>
                                    <center>
                                      <input type='checkbox' name='ownerPayment[]' value='t/$data_t->kd_transaksi'>
                                    </center>
                                  </td>
                      					  <td>Transaksi : COZ-".strtoupper(dechex($data_t->kd_transaksi))."</td>
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
                          $show_k = $proses_k->showMutasiDana('10/'.$data_u->kd_unit);
                          while($data_k = $show_k->fetch(PDO::FETCH_OBJ)){
                            $show_tu = $proses_tu->showTransaksiUmumByTanggal($data_k->tanggal);
                            $data_tu = $show_tu->fetch(PDO::FETCH_OBJ);
                            echo "
                              <tr class='gradeC'>
                                <td class='hide'>$i</td>
                                <td>
                                  <center>
                                    <input type='checkbox' name='ownerPayment[]' value='mk/$data_tu->kd_transaksi_umum'>
                                  </center>
                                </td>
                                <td>T-Umum <strong>($data_tu->keterangan)</strong></td>
                                <td>$data_u->nama_apt</td>
                                <td>$data_u->no_unit</td>
                                <td><center>-</center></td>
                                <td>".number_format($data_tu->harga*$data_tu->jumlah, 0, ".", ".")." IDR</td>
                              </tr>
                            ";
                            $i++;
                          }
                        }
                      }
                    ?>
                    <tr>
                      <td colspan="6"><button type="submit" class="btn btn-success">Bayar</button> Transaksi yang di pilih.</td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
            <div id="tab2" class="tab-pane">
              <table class="table table-bordered data-table">
                <tr>
                  <th class='hide'> No</th>
                  <th><input type="checkbox" onClick="checkAll(this)" /> All</th>
                  <th>Jenis</th>
                  <th>Apartemen</th>
                  <th>Unit</th>
                  <th>Check In/Out</th>
                  <th>Tanggal</th>
                  <th>Nominal</th>
                </tr>
                <tbody>
                  <?php
                    if(isset($_POST['kd_owner'])){
                      $proses_u = new Unit($db);
                      $proses_t = new Transaksi($db);
                      $proses_tu = new TransaksiUmum($db);
                      $proses_k = new Kas($db);
                      $_SESSION['kd_owner'] = $_POST['kd_owner'];
                      $show_u = $proses_u->showUnitbyOwner($_POST['kd_owner']);
                      while($data_u = $show_u->fetch(PDO::FETCH_OBJ)){
                        $owner_we = $data_u->h_owner_we;
                        $owner_wd = $data_u->h_owner_wd;
                        $show_t = $proses_t->showTransaksiByUnit($data_u->kd_unit);
                        $i = 1;
                        while($data_t = $show_t->fetch(PDO::FETCH_OBJ)){
                          if($data_t->status == 41){

                            if($data_t->hari_weekend == 0){
                              $nominal = $data_t->hari_weekday*$owner_wd;
                            }elseif($data_t->hari_weekday == 0){
                              $nominal = $data_t->hari_weekend*$owner_we;
                            }elseif($data_t->hari_weekday <> 0 && $data_t->hari_weekend <> 0){
                              $nominal = ($data_t->hari_weekend*$owner_we)+($data_t->hari_weekend*$owner_we);
                            }
                            echo "
                              <tr class='gradeC'>
                                <td class='hide'>$i</td>
                                <td>
                                  <center>
                                    <input type='checkbox' name='ownerPayment[]' value='t/$data_t->kd_transaksi'>
                                  </center>
                                </td>
                                <td>Transaksi : COZ-".strtoupper(dechex($data_t->kd_transaksi))."</td>
                                <td>$data_t->nama_apt</td>
                                <td>$data_t->no_unit</td>
                                <td>
                                  <center>
                                    $data_t->check_in / $data_t->check_out
                                  </center>
                                </td>
                                <td>$data_t->tgl_transaksi</td>
                                <td>".number_format($nominal, 0, ".", ".")." IDR</td>
                              </tr>
                            ";
                            $i++;
                          }
                        }
                        $show_k = $proses_k->showMutasiDana('9/'.$data_u->kd_unit);
                        while($data_k = $show_k->fetch(PDO::FETCH_OBJ)){
                          $show_tu = $proses_tu->showTransaksiUmumByTanggal($data_k->tanggal);
                          $data_tu = $show_tu->fetch(PDO::FETCH_OBJ);
                          echo "
                            <tr class='gradeC'>
                              <td class='hide'>$i</td>
                              <td>
                                <center>
                                  <input type='checkbox' name='ownerPayment[]' value='mk/$data_tu->kd_transaksi_umum'>
                                </center>
                              </td>
                              <td>T-Umum <strong>($data_tu->keterangan)</strong></td>
                              <td>$data_u->nama_apt</td>
                              <td>$data_u->no_unit</td>
                              <td><center>-</center></td>
                              <td>".number_format($data_tu->harga*$data_tu->jumlah, 0, ".", ".")." IDR</td>
                            </tr>
                          ";
                          $i++;
                        }
                      }
                    }
                  ?>
                  <tr>
                    <td colspan="6"><button type="submit" class="btn btn-success">Bayar</button> Transaksi yang di pilih.</td>
                  </tr>
                </tbody>
              </table>
            </div>
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
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
</body>
<?php
  include '../template/modal.php';
?>
</html>
