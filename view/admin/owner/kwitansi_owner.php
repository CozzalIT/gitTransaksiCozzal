<?php
  require("../../../../config/database.php");
  require("../../../class/transaksi.php");
  require("../../../class/transaksi_umum.php");
  require("../../../class/kas.php");
  require("../../../class/unit.php");
  require("../../../class/owner.php");

  $thisPage = "Transaksi";

  include "../template/head.php";
  echo '<body>';
  include "../template/header.php";
  include "../template/sidebar.php";

  if(!empty($_POST['ownerPayment'])) {
    foreach($_POST['ownerPayment'] as $ownerPayment) {
      $cek = explode("/",$ownerPayment);
      if($cek[0] == 't'){
        $transaksi[] = $cek[1];
      }elseif($cek[0] == 'mk'){
        $transaksi_umum[] = $cek[1];
      }
    }
    $transaksi[999] = 'dummy';
    $transaksi_umum[999] = 'dummy';
    $kd_owner = $_SESSION['kd_owner'];
  }
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Owner Payment</a> </div>
    <form action="owner_payment.php" method="post">
      <button type="submit" class="btn btn-primary btn-add"><i class="icon-arrow-left"></i> Kembali</button>
      <input type="text" name="kd_owner" value="<?php echo $kd_owner; ?>" style="visibility:hidden" />
    </form>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
            <h5>Pengeluaran & Pendapatan</h5>
          </div>
          <form method="post" id="formOwnerPayment">
            <div class="widget-content">
              <div class="row-fluid">
                <div class="span6">
                </div>
                <div class="span6">
                  <table class="table table-bordered table-invoice">
                    <tbody>
                      <?php
                        if(isset($_SESSION['kd_owner'])){
                          $proses_o = new Owner($db);
                          $show_o = $proses_o->editOwner($_SESSION['kd_owner']);
                          $data_o = $show_o->fetch(PDO::FETCH_OBJ);
                        }
                      ?>
                      <tr>
                        <tr>
                          <td class="width30">Tanggal Pembayaran</td>
                          <td class="width70"><strong><?php echo date('Y-m-d'); ?></strong></td>
                        </tr>
                        <tr>
                          <td class="width30">Nama Owner</td>
                          <td class="width70"><strong><?php echo $data_o->nama; ?></strong></td>
                        </tr>
                        <tr>
                          <td class="width30">Alamat</td>
                          <td class="width70"><strong><?php echo $data_o->alamat; ?></strong></td>
                        </tr>
                        <tr>
                          <td class="width30">Kontak</td>
                          <td class="width70"><strong><?php echo $data_o->no_tlp; ?></strong></td>
                        </tr>
                        <tr>
                          <td class="width30">Email</td>
                          <td class="width70"><strong><?php echo $data_o->email; ?></strong></td>
                        </tr>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row-fluid">
                <div class="span12">
                  <table class="table table-bordered table-invoice-full">
                    <thead>
                      <tr>
                        <th colspan="6">Pengeluaran Unit</th>
                      </tr>
                      <tr>
                        <th class='hide'><input type='text' name='kd_owner' value='<?php echo $data_o->kd_owner; ?>' /></th>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $proses_tu = new TransaksiUmum($db);
                        $i=1;
                        $total_out=0;
                        $subtotal_out=0;
                        foreach($transaksi_umum as $kd_transaksi_umum) {
                          if($kd_transaksi_umum <> 'dummy'){
                            $show_tu = $proses_tu->editTransaksiUmum($kd_transaksi_umum);
                            $data_tu = $show_tu->fetch(PDO::FETCH_OBJ);
                            $tanggal = explode(" ",$data_tu->tanggal);
                            $subtotal_out = $data_tu->harga*$data_tu->jumlah;
                            echo "
                              <tr>
                                <td class='hide'><input type='text' name='transaksiUmum[]' value='$kd_transaksi_umum' /></td>
                                <td>$i</td>
                                <td>$tanggal[0]</td>
                                <td>$data_tu->keterangan</td>
                                <td>".number_format($data_tu->harga, 0, ".",".")." IDR</td>
                                <td>$data_tu->jumlah</td>
                                <td>".number_format($subtotal_out, 0, ".",".")." IDR</td>
                              </tr>
                            ";
                            $i++;
                            $total_out = $total_out+$subtotal_out;
                          }
                        }
                      ?>
                      <tr>
                        <td colspan="5"><strong>Total Pengeluaran</strong></td>
                        <td><?php echo number_format($total_out, 0, ".","."); ?> IDR</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table table-bordered table-invoice-full">
                    <thead>
                      <tr>
                        <th colspan="7">Pendapatan Unit</th>
                      </tr>
                      <tr>
                        <th>No</th>
                        <th>Check In / Out</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Weekend</th>
                        <th>Weekday</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $proses_t = new Transaksi($db);
                      $i=1;
                      $total_in=0;
                      $subtotal_in=0;
                      foreach($transaksi as $kd_transaksi) {
                          if($kd_transaksi <> 'dummy'){
                            $show_t = $proses_t->editTransaksi($kd_transaksi);
                            $data_t = $show_t->fetch(PDO::FETCH_OBJ);
                            $subtest= $data_t ->total_harga_owner;
              							if($subtest>0){
              								$subtotal_in = $data_t->total_harga_owner;
              								$weekend = 0;
              								$weekday = 0;
              							}else{
              								$weekend = $data_t->hari_weekend*$data_t->harga_owner_weekend;
              								$weekday = $data_t->hari_weekday*$data_t->harga_owner;
              								$subtotal_in = $weekday+$weekend;
              							}
                            echo "
                              <tr>
                                <td class='hide'><input type='text' name='transaksi[]' value='$kd_transaksi' /></td>
                                <td>$i</td>
                                <td>$data_t->check_in / $data_t->check_out</td>
                                <td>$data_t->nama</td>
                                <td>$data_t->hari Hari</td>
                                <td>".($weekend == 0 ? '-' : number_format($weekend, 0, ".",".").' IDR')."</td>
                                <td>".($weekday == 0 ? '-' : number_format($weekday, 0, ".",".").' IDR')."</td>
                                <td>".number_format($subtotal_in, 0, ".",".")." IDR</td>
                              </tr>
                            ";
                            $i++;
                            $total_in = $total_in+$subtotal_in;
                          }
                        }
                        $earnings = $total_in-$total_out;
                      ?>
                      <tr>
                        <td colspan="6"><strong>Total Pendapatan</strong></td>
                        <td><?php echo number_format($total_in, 0, ".","."); ?> IDR</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table table-bordered table-invoice-full">
                    <tbody>
                      <tr>
                        <td class="msg-invoice" width="85%"><h4>Payment method: </h4>
                          <select id="kas" name="kas" class="span4" required>
              					    <option value="">-- Kas --</option>
                					  <?php
                              $Proses = new Kas($db);
                    				  $show = $Proses->showKas();
                    				  while($data = $show->fetch(PDO::FETCH_OBJ)){
                  						  echo "<option name='kd_kas' value='$data->kd_kas'>$data->sumber_dana</option>";
                  						}
                					  ?>
              					  </select>
                      </tr>
                    </tbody>
                  </table>
                  <div class="pull-right">
                    <h4><span>EARNINGS: </span><?php echo number_format($earnings, 0, ".","."); ?> IDR</h4>
                    <br>
                    <div class='hide'><input type='text' name='earnings' value='<?php echo $earnings;?>' /></div>
                    <button class="btn btn-success btn-large pull-right" type="submit" name="ownerPayment" style="margin-left:10px;" onclick="submitForm('../../../proses/owner.php')">Bayar</button>
                    <button class="btn btn-primary btn-large pull-right" type="submit" style="margin-left:10px;" onclick="submitForm('pdf.php')">Download/Print</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function submitForm(action){
    document.getElementById('formOwnerPayment').action = action;
    document.getElementById('formOwnerPayment').submit();
  }
</script>
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
<!--end-Footer-part-->
</body>
</html>
