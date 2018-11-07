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
    <form id="formSelectOwner" method="post" action="#">
      <div class="control-group btn-add">
        <p>Pilih owner untuk menampilkan data.</p>
        <select name="kd_owner" class="span2" style="" id="mySelect" onchange="selectOwner()">
          <?php
            if(!isset($_POST['kd_owner'])){
              echo "
                <option>--Pilih Owner--</option>
              ";
              $Proses = new Owner($db);
              $show = $Proses->showOwner();
              while($data = $show->fetch(PDO::FETCH_OBJ)){
                if ($data->kd_owner != 0){
                  echo "<option name='kd_owner' value='$data->kd_owner'>$data->nama</option>";
                }
              }
            }elseif(isset($_POST['kd_owner'])){
              $kd_owner = $_POST['kd_owner'];
              $Proses = new Owner($db);
              $show = $Proses->showOwner();
              while($data = $show->fetch(PDO::FETCH_OBJ)){
                if ($data->kd_owner != 0){
                  if ($kd_owner!=$data->kd_owner){
                    echo "<option name='kd_apt' value='$data->kd_owner'>$data->nama</option>";
                  }else{
                    echo "<option name='kd_apt' value='$data->kd_owner' selected='true'>$data->nama</option>";
                  }
                }
              }
            }
            echo "<option name='kd_apt' value='all'";
            if(isset($_POST['kd_owner'])){
              if($_POST['kd_owner'] == 'all'){
                echo 'selected="true"';
              }
            }
            echo ">Semua Owner</option>";
          ?>
        </select>
      </div>
      <script>
        function selectOwner() {
            document.getElementById("formSelectOwner").submit();
        }
      </script>
    </form>
  </div>
  <div class="container-fluid">
    <hr>
    <div <?php if(!isset($_POST['kd_owner'])){ echo 'class="row-fluid hide"';}else{ echo 'class="row-fluid"';} ?>>
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <ul class="nav nav-tabs">
              <li><a href="#unpaid" data-toggle="tab">Unpaid</a></li>
              <li><a href="#paid" data-toggle="tab">Paid</a></li>
              <li><a href="#history" data-toggle="tab">Payment History</a></li>
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
            <div id="unpaid" class="tab-pane active">
              <form action="kwitansi_owner.php" method="post">
                <table class="table table-bordered">
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
                        if($_POST['kd_owner'] == 'all'){
                          $show_u = $proses_u->showUnit();
                        }else{
                          $show_u = $proses_u->showUnitbyOwner($_POST['kd_owner']);
                        }
                        while($data_u = $show_u->fetch(PDO::FETCH_OBJ)){
                          $show_t = $proses_t->showTransaksiByUnit($data_u->kd_unit);
                          $i = 1;
                          while($data_t = $show_t->fetch(PDO::FETCH_OBJ)){
                            $owner_we = $data_t->harga_owner_weekend;
                            $owner_wd = $data_t->harga_owner;
                            if($data_t->status == 42){
                              $testdata= $data_t->total_harga_owner;
                              if($testdata>0){
                                $nominal = $data_t->total_harga_owner;
                              }else{
                                if($data_t->hari_weekend == 0){
                                  $nominal = $data_t->hari_weekday*$owner_wd;
                                  }elseif($data_t->hari_weekday == 0){
                                  $nominal = $data_t->hari_weekend*$owner_we;
                                }elseif($data_t->hari_weekday <> 0 && $data_t->hari_weekend <> 0){
                                  $nominal = ($data_t->hari_weekend*$owner_we)+($data_t->hari_weekday*$owner_wd);
                                }
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
                            if(!isset($data_tu->kd_transaksi_umum)) break;
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
                                <td>-</td>
                                <td>".number_format($data_tu->harga*$data_tu->jumlah*(-1), 0, ".", ".")." IDR</td>
                              </tr>
                            ";
                            $i++;
                          }
                        }
                      }
                    ?>
                    <tr>
                      <?php
                        if($i == 0){
                          echo '
                            <td colspan="6">No data available in table</td>
                          ';
                        }else{
                          echo '
                            <td colspan="6"><button type="submit" class="btn btn-success">Bayar</button> Transaksi yang di pilih.</td>
                          ';
                        }
                      ?>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
            <div id="paid" class="tab-pane">
              <table class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th class="hide"> No</th>
                    <th>Jenis</th>
                    <th>Apartemen</th>
                    <th>Unit</th>
                    <th>Check In/Out</th>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if(isset($_POST['kd_owner'])){
                      $proses_u = new Unit($db);
                      $proses_t = new Transaksi($db);
                      $proses_tu = new TransaksiUmum($db);
                      $proses_k = new Kas($db);
                      $_SESSION['kd_owner'] = $_POST['kd_owner'];
                      if($_POST['kd_owner'] == 'all'){
                        $show_u = $proses_u->showUnit();
                      }else{
                        $show_u = $proses_u->showUnitbyOwner($_POST['kd_owner']);
                      }
                      while($data_u = $show_u->fetch(PDO::FETCH_OBJ)){
                        $show_t = $proses_t->showTransaksiByUnit($data_u->kd_unit);
                        $i = 1;
                        while($data_t = $show_t->fetch(PDO::FETCH_OBJ)){
                          $owner_we = $data_t->harga_owner_weekend;
                          $owner_wd = $data_t->harga_owner;
                          if($data_t->status == 41){
                            if($data_t->total_harga_owner >0){
                              $nominal = $data_t->total_harga_owner;
                            }else{
                              if($data_t->hari_weekend == 0){
                              $nominal = $data_t->hari_weekday*$owner_wd;
                              }elseif($data_t->hari_weekday == 0){
                              $nominal = $data_t->hari_weekend*$owner_we;
                              }elseif($data_t->hari_weekday <> 0 && $data_t->hari_weekend <> 0){
                              $nominal = ($data_t->hari_weekend*$owner_we)+($data_t->hari_weekday*$owner_wd);
                              }
                            }
                            $dateTimeT = explode(" ",$data_t->tgl_transaksi);
                            echo "
                              <tr class='gradeC'>
                                <td class='hide'>$i</td>
                                <td>Transaksi : COZ-".strtoupper(dechex($data_t->kd_transaksi))."</td>
                                <td>$data_t->nama_apt</td>
                                <td>$data_t->no_unit</td>
                                <td>
                                  <center>
                                    $data_t->check_in / $data_t->check_out
                                  </center>
                                </td>
                                <td>$dateTimeT[0]</td>
                                <td>".number_format($nominal, 0, ".", ".")." IDR</td>
                              </tr>
                            ";
                          }
                          $i++;
                        }
                        $show_k = $proses_k->showMutasiDana('9/'.$data_u->kd_unit);
                        while($data_k = $show_k->fetch(PDO::FETCH_OBJ)){
                          $show_tu = $proses_tu->showTransaksiUmumByTanggal($data_k->tanggal);
                          $data_tu = $show_tu->fetch(PDO::FETCH_OBJ);
                          $dateTimeTu = explode(" ",$data_tu->tanggal);
                          echo "
                            <tr class='gradeC'>
                              <td class='hide'>$i</td>
                              <td>T-Umum <strong>($data_tu->keterangan)</strong></td>
                              <td>$data_u->nama_apt</td>
                              <td>$data_u->no_unit</td>
                              <td><center>-</center></td>
                              <td>$dateTimeTu[0]</td>
                              <td>".number_format($data_tu->harga*$data_tu->jumlah*(-1), 0, ".", ".")." IDR</td>
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
            <div id="history" class="tab-pane">
              <table class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th class="hide"> No</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Jumlah Transaksi</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $i=1;
                    if($_POST['kd_owner'] == 'all'){
                      $show_history = $Proses->showAllOwnerPayment($_POST['kd_owner']);
                    }else{
                      $show_history = $Proses->showOwnerPayment($_POST['kd_owner']);
                    }
                    while($data_history = $show_history->fetch(PDO::FETCH_OBJ)){
                      $status = $data_history->status;
                      switch ($status) {
                        case '4':
                          $status = 'Confirm';
                          break;
                        case '3':
                          $status = 'Reject';
                          break;
                        case '2':
                          $status = 'Waiting List';
                          break;
                        default:
                          $status = 'Paid';
                          break;
                      }
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
                      $kode = '"'.$data_history->kd_owner_payment.'"';
                      echo "
                        <tr class='gradeC'>
                          <td class='hide'>$i</td>
                          <td>$tanggalIndo</td>
                          <td>$data_history->jumlah_transaksi Transaksi</td>
                          <td>".number_format($data_history->nominal, 0, ".", ".")." IDR</td>
                          <td>$status</td>
                          <td>
                            <div class='btn-group' style='margin-left: 20px;'>
                              <button data-toggle='dropdown' class='btn btn-success dropdown-toggle'>Action <span class='caret'></span></button>
                              <ul class='dropdown-menu'>
                                <li><a id='detail' name='detail' href='detail_payment.php?detail=$data_history->kd_owner_payment'>Detail</a></li>
                                ";
                                if($status == 'Reject'){
                                  echo"
                                    <li class='divider'></li>
                                    <li><a href='../../../proses/owner.php?deletePayment=$data_history->kd_owner_payment'>Delete</a></li>
                                  ";
                                }elseif($status == 'Waiting List'){
                                  echo"
                                    <li class='divider'></li>
                                    <li><a href='#'>Confirm</a></li>
                                  ";
                                }elseif($status == 'Confirm'){
                                  echo"
                                    <li class='divider'></li>
                                    <li><a href='#popup-bayar' data-toggle='modal' onClick='btnBayar($kode)'>Bayar</a></li>
                                  ";
                                }
                                echo"
                              </ul>
                            </div>
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
</div>

<!-- Modal Popup Bayar -->
<div id="popup-bayar" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Pilih sumber dana pembayaran</h3>
  </div>
  <div class="modal-body">
  <form action="../../../proses/owner.php" method="post" class="form-horizontal">
    <div class="control-group">
      <script>
        function btnBayar(kode){
          document.getElementById('kd_owner_payment').value = kode;
        }
      </script>
      <label class="control-label">Sumber Dana :</label>
      <div class="controls">
        <input id="kd_owner_payment" name="kd_owner_payment" value="tes" class="hide" />
        <select id="kas" name="kas" required>
          <option value="">-- Kas --</option>
          <?php
            $Proses = new Kas($db);
            $show = $Proses->showKas();
            while($data = $show->fetch(PDO::FETCH_OBJ)){
              echo "<option name='kd_kas' value='$data->kd_kas'>$data->sumber_dana</option>";
            }
          ?>
        </select>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <input type="submit" name="paymentConfirmKwitansi" class="btn btn-success" value="Bayar">
        <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
      </div>
    </div>
  </form>
  </div>
</div>
<!-- //Modal Popup Bayar -->

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