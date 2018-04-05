<?php
  require("../../../class/transaksi.php");
  require("../../../../config/database.php");

  $thisPage = "Transaksi";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Laporan Transaksi</a></div>
    <a href="transaksi.php" class="btn btn-success btn-add"><i class="icon-plus"></i> Transaksi Baru</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
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
                            <a class='btn btn-info' href='../../../proses/transaksi.php?addConfirm=$data->kd_transaksi'>Confirm</a>
                            <a class='btn btn-primary' href='kwitansi_dp.php?kwitansi=$data->kd_transaksi'>Kwitansi DP</a>
                          </center>
                        </td>
            						<td>
                          <center>
                            <a class='btn btn-success' id='pembayaran' name='pembayaran' href='laporan_transaksi.php?pembayaran=$data->kd_transaksi'>Pembayaran</a>
              						  <a class='btn btn-primary' href='edit.php?edit_transaksi=$data->kd_transaksi'>Edit</a>
              						  <a class='btn btn-danger hapus' href='../../../proses/transaksi.php?delete_transaksi=$data->kd_transaksi'>Hapus</a>
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

<?php
//Pembayaran
if(isset($_GET['pembayaran'])){
  $show = $Proses->editTransaksi($_GET['pembayaran']);
  $data1 = $show->fetch(PDO::FETCH_OBJ);

  echo'
    <!--Modal Tambah Pembayaran-->
    <script type="text/javascript">
      $(document).ready(function(){
      $("#close").click(function(){
        $(".modal").addClass("hide");
      });
      });
    </script>
    <div id="popup-pembayaran" class="modal">
      <div class="modal-header">
        <button id="close" data-dismiss="modal" class="close" type="button">×</button>
        <h3>Pembayaran</h3>
      </div>
      <div class="modal-body">
      	<form action="" method="post" class="form-horizontal">
          <div class="control-group">
            <label class="control-label">Total Tagihan</label>
            <label class="control-label">'.number_format($data1->total_tagihan, 0, ".", ".").' IDR</label>
          </div>
          <div class="control-group">
            <label class="control-label">DP</label>
            <label class="control-label">'.number_format($data1->sisa_pelunasan, 0, ".", ".").' IDR</label>
          </div>
          <div class="control-group">
            <label class="control-label">Pembayaran</label>
            <label class="control-label">0 IDR</label>
          </div>
          <div class="control-group">
      		  <label class="control-label">Jumlah Pembayaran</label>
        		<div class="controls">
        		  <input name="pembayaran" type="number" class="span2" placeholder="" value="0" required/>
        		</div>
      	  </div>
      	  <div class="control-group">
        		<div class="controls">
        		  <input type="submit" name="" class="btn btn-success" value="Tambah Pembayaran">
        		</div>
      	  </div>
      	</form>
      </div>
    </div>';
  }

//Detail Transaksi
  if(isset($_GET['detail'])){
    $show = $Proses->editTransaksi($_GET['detail']);
    $detail = $show->fetch(PDO::FETCH_OBJ);

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
        <h3>Transaksi</h3>
        </div>
        <div class="modal-body">
        <div class="widget-content">
          <div class="row-fluid">
          <div class="span8">
            <table class="">
            <tbody>
              <tr>
              <td><h4>Detail Penyewa</h4></td>
              </tr>
              <tr>
              <td>Nama</td>
              <td>: '.$detail->nama.'</td>
              </tr>
              <tr>
              <td>Alamat</td>
              <td>: '.$detail->alamat.'</td>
              </tr>
              <tr>
              <td>Jenis Kelamin</td>
              <td>: '.$detail->jenis_kelamin.'</td>
              </tr>
              <tr>
              <td>No Telpon</td>
              <td>: '.$detail->no_tlp.'</td>
              </tr>
              <tr>
              <td>E-Mail</td>
              <td>: '.$detail->email.'</td>
              </tr>
            </tbody>
            </table>
          </div>
          </div>
          <div class="row-fluid">
            <div class="span12">
            <table style="margin-top: 20px;" class="table table-bordered table-invoice">
              <tbody>
              <tr>
                <th colspan="2">Detail Kwitansi Penyewaan</th>
                <tr>
                <td class="width30">Kwitansi ID:</td>
                <td class="width70"><strong>COZ-'.$detail->kd_transaksi.'</strong></td>
                </tr>
                <tr>
                <td>Invoice Date:</td>
                <td><strong>'.$detail->tgl_transaksi.'</strong></td>
                </tr>
                <tr>
                <td>Apartemen:</td>
                <td><strong>'.$detail->nama_apt.'</strong></td>
                </tr>
                <tr>
                <td class="width30">Unit:</td>
                <td class="width70"><strong>'.$detail->no_unit.'</strong></td>
                </tr>
                <tr>
                <td class="width30">Booking Via:</td>
                <td class="width70"><strong>'.$detail->booking_via.'</strong></td>
                </tr>
                <tr>
                <td class="width30">Check In:</td>
                <td class="width70"><strong>'.$detail->check_in.'</strong></td>
                </tr>
                <tr>
                <td class="width30">Check Out:</td>
                <td class="width70"><strong>'.$detail->check_out.'</strong></td>
                </tr>
                <tr>
                <td class="width30">Jumlah Hari:</td>
                <td class="width70"><strong>'.$detail->hari.'</strong></td>
                </tr>
                <tr>
                <td class="width30">Jumlah Tamu:</td>
                <td class="width70"><strong>'.$detail->tamu.'</strong></td>
                </tr>
                <tr>
                <td class="width30">Sewa Perhari:</td>
                <td class="width70"><strong>'.number_format($detail->harga_sewa, 0, ".", ".").' IDR</strong></td>
                </tr>
                <tr>
                <td class="width30">Diskon:</td>
                <td class="width70"><strong>'.number_format($detail->diskon, 0, ".", ".").' IDR</strong></td>
                </tr>
                <tr>
                <td class="width30">Ekstra Charge:</td>
                <td class="width70"><strong>'.number_format($detail->ekstra_charge, 0, ".", ".").' IDR</strong></td>
                </tr>
                <tr>
                <td class="width30">Total Tagihan:</td>
                <td class="width70"><strong>'.number_format($detail->total_tagihan, 0, ".", ".").' IDR</strong></td>
                </tr>
                <tr>
                <td class="width30">Pembayaran DP:</td>
                <td class="width70"><strong>'.number_format($detail->dp, 0, ".", ".").' IDR</strong></td>
                </tr>
                <tr>
                <td class="width30">DP Via:</td>
                <td class="width70"><strong>'.$detail->nama_bank.'</strong></td>
                </tr>
                <tr>
                <td class="width30">Sisa Pelunasan:</td>
                <td class="width70"><strong>'.number_format($detail->sisa_pelunasan, 0, ".", ".").' IDR</strong></td>
                </tr>
                <tr>
                <td class="width30">Note:</td>
                <td class="width70"><strong>'.$detail->catatan.'</strong></td>
                </tr>
              </tr>
              </tbody>
            </table>
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
<script src="../../../asset/js/select2.min.js"></script>
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
</body>
</html>
