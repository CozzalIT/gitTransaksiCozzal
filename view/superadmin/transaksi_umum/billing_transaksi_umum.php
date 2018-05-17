<?php
  require("../../../class/transaksi_umum.php");
  require("../../../class/unit.php");
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
                                  <li><a href='#'>Bayar</a></li>
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
