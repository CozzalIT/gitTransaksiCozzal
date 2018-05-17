<?php
  require("../../../class/transaksi_umum.php");
  require("../../../class/unit.php");
  require("../../../class/kas.php");
  require("../../../../config/database.php");

  $thisPage = "Billing Transaksi Umum";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Billing Transaksi Umum</a></div>
    <a href="transaksi_umum.php" class="btn btn-success btn-add"><i class="icon-plus"></i> Transaksi Umum Baru</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Billing Transaksi Umum</h5>
          </div>
          <div class="widget-content nopadding">
			      <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kebutuhan</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
        				  <th>Total</th>
                  <th>Keterangan</th>
        				  <th>Action</th>
                </tr>
              </thead>
              <tbody>
      			    <?php
        				  $Proses = new TransaksiUmum($db);
        				  $show = $Proses->showTransaksiUmum();
        				  $i = 1;
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    if($data->status == 1){
                      $kode = $data->kd_transaksi_umum;
                      if($data->kebutuhan == "umum"){
                        $kebutuhan = $data->kebutuhan;
                      }else{
                        $arrayKebutuhan = explode("/",$data->kebutuhan);
                        $kebutuhan = $arrayKebutuhan[0];

                        $proses_unit = new Unit($db);
                        $show_unit = $proses_unit->editUnit($arrayKebutuhan[1]);
                        $data_unit = $show_unit->fetch(PDO::FETCH_OBJ);
                      }
                      echo "
            					  <tr class='gradeC'>
            					    <td>$i</td>
            					    <td>".($kebutuhan == 'umum' ? 'Umum' : 'Unit '.$data_unit->no_unit)."</td>
              						<td>".number_format($data->harga, 0, ".", ".")." IDR</td>
              						<td>$data->jumlah</td>
              						<td>".number_format($data->harga*$data->jumlah, 0, ".", ".")." IDR</td>
                          <td>$data->keterangan</td>
              						<td>
                            <div class='btn-group'>
                              <center>
                                <button data-toggle='dropdown' class='btn btn-success dropdown-toggle'>Action <span class='caret'></span></button>
                                <ul class='dropdown-menu'>
                                  <li><a href='#popup-bayar' data-toggle='modal' onClick='btnBayar($kode)'>Bayar</a></li>
                                  <li class='divider'></li>
                                  <li><a class='hapus' href='../../../proses/transaksi_umum.php?delete_transaksi_umum=$data->kd_transaksi_umum'>Hapus</a></li>
                                </ul>
                              </center>
                            </div>
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

<!-- Modal Popup Bayar -->
<div id="popup-bayar" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Pilih sumber dana pembayaran</h3>
  </div>
  <div class="modal-body">
	<form action="../../../proses/transaksi_umum.php" method="post" class="form-horizontal">
	  <div class="control-group">
      <script>
        function btnBayar(kode){
          document.getElementById('kd_transaksi_umum').value = kode;
        }
      </script>
  		<label class="control-label">Sumber Dana :</label>
  		<div class="controls">
        <input id="kd_transaksi_umum" name="kd_transaksi_umum" value="tes" class="hide" />
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
  		  <input type="submit" name="paymentBilling" class="btn btn-success" value="Bayar">
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
<script src="../../../asset/js/jquery.uniform.js"></script>
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
</body>
</html>
