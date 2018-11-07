<?php
  require("../../../class/transaksi.php");
  require("../../../class/kas.php");
  require("../../../../config/database.php");

  $thisPage = "Cancel Transaksi";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Cancel Transaksi</a></div>
    <a href="transaksi.php" class="btn btn-success btn-add"><i class="icon-plus"></i> Transaksi Baru</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Cancel Transaksi</h5>
          </div>
          <div class="widget-content nopadding">
            <?php
              if(isset($_GET['error'])){
                if($_GET['error'] == 'dpKurang'){
                  echo'
                  <div class="alert alert-danger" role="alert">
                    <strong>WARNING!!</strong> Setlement lebih besar dari DP.
                  </div>
                  ';
                }elseif($_GET['error'] == 'saldoKurang'){
                  echo'
                  <div class="alert alert-danger" role="alert">
                    <strong>WARNING!!</strong> Saldo pada kas tidak mencukupi, silahkan pilih kas lain.
                  </div>
                  ';
                }
              }
            ?>
			      <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Penyewa</th>
                  <th>Apartemen</th>
                  <th>Unit</th>
                  <th>Check In</th>
        				  <th>Check Out</th>
                  <th>DP</th>
                  <th>Setlement</th>
        				  <th>Action</th>
                </tr>
              </thead>
              <tbody>
      			    <?php
        				  $Proses = new Transaksi($db);
        				  $show = $Proses->showTransaksi();
        				  $i = 1;
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    if($data->status == 2){
            					echo "
            					  <tr class='gradeC'>
            					    <td>$i</td>
            					    <td>$data->nama</td>
            					    <td>$data->nama_apt</td>
                          <td>$data->check_in</td>
              						<td>$data->no_unit</td>
                          <td>$data->check_out</td>
                          <td>".number_format($data->dp, 0, ".", ".")." IDR</td>
              						<td>-</td>
              						<td>
                            <center>
                              <a class='btn btn-success' href='cancel_transaksi.php?setlement=$data->kd_transaksi'>Setlement DP</a>
                            </center>
                          </td>
            					  </tr>
                      ";
                      $i++;
                    }
                    if($data->status == 3){
            					echo "
            					  <tr class='gradeC'>
            					    <td>$i</td>
            					    <td>$data->nama</td>
            					    <td>$data->nama_apt</td>
                          <td>$data->check_in</td>
              						<td>$data->no_unit</td>
              						<td>$data->check_out</td>
                          <td>".number_format($data->dp, 0, ".", ".")." IDR</td>
                          <td>".number_format($data->setlement_dp, 0, ".", ".")." IDR</td>
              						<td>
                            <center>
                              <a class='btn btn-info' href='../home/home.php'>Tidak Ada</a>
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

<?php
//Setlement DP
  if(isset($_GET['setlement'])){
    $show = $Proses->editTransaksi($_GET['setlement']);
    $detail = $show->fetch(PDO::FETCH_OBJ);
    $action = ($detail->status_broker=="B" ? '../../../proses/transaksi_broker.php' : '../../../proses/transaksi.php');

    echo '
      <div id="popup-detail" class="modal">
        <div class="modal-header">
          <button id="close" data-dismiss="modal" class="close" type="button">×</button>
          <script type="text/javascript">
            $(document).ready(function(){
            $("#close").click(function(){
              $(".modal").addClass("hide");
            });
            });
          </script>
          <h3>Setlement DP</h3>
        </div>
        <div class="modal-body">
          <div class="widget-content">
            <div class="row-fluid">
              <div class="span8">
                <form action="'.$action.'" method="POST">
                  <table class="">
                    <tbody>
                      <tr>
                        <td colspan="3">
                          <h4>Penyewa : '.$detail->nama.'</h4>
                        </td>
                      </tr>
                      <tr>
                        <td>Jumlah</td>
                        <td style="padding-left:25px;">
                          <input type="number" name="setlement" required />

                        </td>
                      </tr>
                      <tr>
                        <td>Kas</td>
                        <td style="padding-left:25px;">
                          <select id="kas" name="kas" required>
              					    <option value="">-- Kas --</option>
                					  ';
                              $_SESSION['kd_transaksi'] = $_GET['setlement'];
                              $Proses = new Kas($db);
                    				  $show = $Proses->showKas();
                    				  while($data = $show->fetch(PDO::FETCH_OBJ)){
                  						  echo "<option name='kd_kas' value='$data->kd_kas'>$data->sumber_dana</option>";
                  						}
                					  echo'
              					  </select>
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td style="padding-left:25px;"><input type="submit" class="btn btn-success" value="Submit" name="setlementDp" /></td>
                      </tr>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    ';
  }
?>

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
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
</body>
</html>
