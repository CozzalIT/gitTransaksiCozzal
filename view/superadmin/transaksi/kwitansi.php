<?php
  require("../../../../config/database.php");
  require("../../../class/transaksi.php");
  require("../../../class/unit.php");

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
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Addons pages</a> <a href="#" class="current">kwitansi</a> </div>
    <a href="confirm_transaksi.php" class="btn btn-primary btn-add"><i class="icon-arrow-left"></i> Kembali</a>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
            <h5 >Kwitansi Pembayaran</h5>
          </div>
          <?php
            $proses = new Transaksi($db);
            $show = $proses->editTransaksi($_GET['kwitansi']);
            $data = $show->fetch(PDO::FETCH_OBJ);

            $proses_u = new Unit($db);
            $show_u = $proses_u->showDetail_Unit($data->kd_unit);
            $data_u = $show_u->fetch(PDO::FETCH_OBJ);
            if($data_u->lantai == 0){
              $lantai = '-';
            }else{
              $lantai = $data_u->lantai;
            }
          ?>
          <div class="widget-content">
            <div class="row-fluid">
              <div class="span6">
                <table class="">
                  <tbody>
                    <tr>
                      <td><h4><?php echo $data->nama; ?></h4></td>
                    </tr>
                    <tr>
                      <td><?php echo $data->alamat; ?></td>
                    </tr>
                    <tr>
                      <td>Mobile Phone: <?php echo $data->no_tlp; ?></td>
                    </tr>
                    <tr>
                      <td><?php echo $data->email; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="span6">
                <table class="table table-bordered table-invoice">
                  <tbody>
                    <tr>
                    <tr>
                      <td class="width30">Invoice ID</td>
                      <td class="width70"><strong>COZ-<?php echo strtoupper(dechex($data->kd_transaksi)); ?></strong></td>
                    </tr>
                    <tr>
                      <td class="width30">Invoice Date</td>
                      <td class="width70"><strong><?php echo $data->tgl_transaksi; ?></strong></td>
                    </tr>
                    <tr>
                      <td class="width30">Check In</td>
                      <td class="width70"><strong><?php echo $data->check_in; ?></strong></td>
                    </tr>
                    <tr>
                      <td class="width30">Check Out</td>
                      <td class="width70"><strong><?php echo $data->check_out; ?></strong></td>
                    </tr>
                    <tr>
                      <td class="width30">Apartemen</td>
                      <td class="width70"><strong><?php echo $data->nama_apt; ?></strong></td>
                    </tr>
                    <tr>
                      <td class="width30">Lantai</td>
                      <td class="width70"><strong><?php echo $lantai; ?></strong></td>
                    </tr>
                  </tr>
                    </tbody>

                </table>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span12">
                <table class="table table-bordered table-invoice-full">
                  <tbody>
                    <tr>
                      <td>Price Per Night Weekday</td>
                      <td><strong><?php echo number_format($data->harga_sewa,0, ".", "."); ?> IDR</td>
                    </tr>
                    <tr>
                      <td>Price Per Night Weekend</td>
                      <td><strong><?php echo number_format($data->harga_sewa_weekend,0, ".", "."); ?> IDR</td>
                    </tr>
                    <tr>
                      <td>Discount</td>
                      <td><strong><?php echo number_format($data->diskon,0, ".", "."); ?> IDR</td>
                    </tr>
                    <tr>
                      <td>No Of Guest</td>
                      <td><strong><?php echo $data->tamu; ?> Person</td>
                    </tr>
                    <tr>
                      <td>Ekstra Charge</td>
                      <td><strong><?php echo number_format($data->ekstra_charge,0, ".", "."); ?> IDR</td>
                    </tr>
                    <tr>
                      <td>Total No of Stay</td>
                      <td><strong><?php echo $data->hari; ?> Day (<?php echo $data->hari_weekend;?> Weekend, <?php echo $data->hari_weekday;?> Weekday)</td>
                    </tr>
                    <tr>
                      <td>Payment</td>
                      <td><strong><?php echo number_format($data->dp,0, ".", "."); ?> IDR</td>
                    </tr>
                    <tr>
                      <td>Outstanding Balance</td>
                      <td><strong><?php echo number_format($data->sisa_pelunasan,0, ".", "."); ?> IDR</td>
                    </tr>
                  </tbody>
                </table>
                <table class="table table-bordered table-invoice-full">
                  <tbody>
                    <tr>
                      <td class="msg-invoice" width="85%"><h4>Payment method: </h4>
                        Via Bank <?php echo $data->sumber_dana; ?>
                    </tr>
                  </tbody>
                </table>
                <div class="pull-right">
                  <h4><span>Total Amount:</span> <?php echo number_format($data->total_tagihan,0, ".", "."); ?> IDR</h4>
                  <br>
                  <a class="btn btn-success btn-large pull-right" href="pdf.php?kwitansi=<?php echo $data->kd_transaksi; ?>">Download / Print</a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
<?php
  include("../template/footer.php");
?>
<!--end-Footer-part-->
</body>
</html>
