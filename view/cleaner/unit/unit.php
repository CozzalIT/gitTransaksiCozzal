<?php
  session_start();
  require("../../../class/cleaner.php");
  require("../../../class/apartemen.php");
  require("../../../config/database.php");

  $thisPage = "Unit";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Data Unit</a></div>
    <a href="#popup-unit" data-toggle="modal" class="btn btn-info btn-add"><i class="icon-plus"></i> Tambah Data</a>
    <a id='hidenbtn' href='#' style='display:none'></a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Penyewa</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Unit</th>
                  <th>Nama Apartemen</th>
				          <th>Alamat</th>
                  <th>Status</th>
                  <th>Kebersihan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  date_default_timezone_set('Asia/Jakarta');
                  $sekarang = date('Y-m-d'); 
                  $jam_now = strtotime(date('H:i'));
                  $jam12 = strtotime('12:00');
                  $i=0;
        				  $Proses = new Cleaner($db);
        				  $show1 = $Proses->showUnit1($sekarang);
        				  while($data = $show1->fetch(PDO::FETCH_OBJ)){
                    if ($data->kd_unit != 0){ $i++;
                      if($data->check_out!=$sekarang || ($data->check_out==$sekarang && $jam_now>$jam12)){
                          $status = 'Kosong';
                          $button = "<a class='btn btn-success' href='../../../proses/unit.php?unit_kotor=".$data->kd_unit."' >Bersihkan</a>"; 
                      }
                      elseif($data->check_out==$sekarang && $jam_now<$jam12){
                          $status = 'Check Out';
                          $button = "Belum Ada";
                      }
            					echo "
            					  <tr>
                          <td>$i</td>
            					    <td>$data->no_unit</td>
            					    <td>$data->nama_apt</td>
            						  <td>$data->alamat_apt</td>
                          <td>$status</td>
                          <td>Kotor</td>
                          <td>
                            <center>
                               $button 
                            </center>
                          </td>
            					  </tr>
                      ";
                    }
            			};
                  if($jam_now<$jam12){
                    $Proses = new Cleaner($db);
                    $show2 = $Proses->showUnit2($sekarang);
                    while($data = $show2->fetch(PDO::FETCH_OBJ)){
                      if ($data->kd_unit != 0){ $i++;
                        echo "
                          <tr>
                            <td>$i</td>
                            <td>$data->no_unit</td>
                            <td>$data->nama_apt</td>
                            <td>$data->alamat_apt</td>
                            <td>Ck_Out & Ck_In</td>
                            <td>Kotor</td>
                            <td>
                              <center>
                                <a class='btn btn-success' href='../../../proses/unit.php?unit_kotor=".$data->kd_unit."' >Bersihkan</a>
                              </center>
                            </td>
                          </tr>
                        ";
                      }
                    };    
                    $Proses = new Cleaner($db);
                    $show3 = $Proses->showUnit3($sekarang);
                    while($data = $show3->fetch(PDO::FETCH_OBJ)){
                      if ($data->kd_unit != 0){ $i++;
                        echo "
                          <tr>
                            <td>$i</td>
                            <td>$data->no_unit</td>
                            <td>$data->nama_apt</td>
                            <td>$data->alamat_apt</td>
                            <td>Check_in</td>
                            <td>Kotor</td>
                            <td>
                              <center>
                                <a class='btn btn-success' href='../../../proses/unit.php?unit_kotor=".$data->kd_unit."' >Bersihkan</a>
                              </center>
                            </td>
                          </tr>
                        ";
                      }
                    };                 
                  }
                  $Proses = new Cleaner($db);
                  $show3 = $Proses->showUnit_normal($sekarang);
                  while($data = $show3->fetch(PDO::FETCH_OBJ)){
                    if ($data->kd_unit != 0){ $i++;
                      echo "
                       <tr>
                          <td>$i</td>
                          <td>$data->no_unit</td>
                          <td>$data->nama_apt</td>
                          <td>$data->alamat_apt</td>
                          <td class='status' id='$data->kd_unit'>Memuat...</td>
                          <td>Bersih</td>
                          <td>
                            <center>
                              Tidak Ada
                            </center>
                          </td>
                        </tr>
                      ";
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
<!--end-main-container-part-->

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--End-Footer-part-->
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/cleaner.js"></script>
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
<?php
  include '../template/modal.php';
?>
</html>
