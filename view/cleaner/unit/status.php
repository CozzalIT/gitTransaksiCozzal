<?php
  session_start();
  require("../../../class/cleaner.php");
  require("../../../class/apartemen.php");
  require("../../../../config/database.php");

  $thisPage = "Status";

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
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Status Unit</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Unit</th>
                  <th>Nama Apartemen</th>
				          <th class='hiderespons'>Alamat</th>
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
                          $button = "<a class='btn btn-success popup' data-toggle='modal' id='$data->kd_unit"."-btn-bersih' href='#popup-task' >Bersihkan</a>";
                      }
                      elseif($data->check_out==$sekarang && $jam_now<$jam12){
                          $status = 'Check Out';
                          $button = "<a class='btn btn-info popup' data-toggle='modal' id='$data->kd_unit"."-btn-lihat' href='#popup-task' >Lihat</a>";
                      }
            					echo "
            					  <tr>
                          <td>$i</td>
            					    <td>$data->no_unit</td>
            					    <td>$data->nama_apt</td>
            						  <td class='hiderespons'>$data->alamat_apt</td>
                          <td>$status</td>
                          <td class='kotor' id='$data->kd_unit'>Kotor</td>
                          <td>
                            <center>
                               $button
                            </center>
                          </td>
            					  </tr>
                      ";
                    }
            			};

                    $Proses = new Cleaner($db);
                    $show2 = $Proses->showUnit2($sekarang);
                    while($data = $show2->fetch(PDO::FETCH_OBJ)){
                      if ($data->kd_unit != 0){ $i++;
                        if($jam_now<$jam12){
                          $status = "<td class='kotor' id='$data->kd_unit'>Kotor</td>";
                          $button = "<a class='btn btn-success popup' data-toggle='modal' id='$data->kd_unit"."-btn-bersih' href='#popup-task' >Bersihkan</a>";
                          $tersedia = "<td>Ck_Out & Ck_In</td>";
                        } else {
                          $status = "<td>Bersih</td>";
                          $button = "<a class='btn btn-info popup' data-toggle='modal' id='$data->kd_unit"."-btn-lihat' href='#popup-task' >Lihat</a>";
                          $tersedia = "<td class='status' id='$data->kd_unit'>Memuat...</td>";
                        }                        
                        echo "
                          <tr>
                            <td>$i</td>
                            <td>$data->no_unit</td>
                            <td>$data->nama_apt</td>
                            <td class='hiderespons'>$data->alamat_apt</td>
                            $tersedia
                            $status
                            <td>
                              <center>
                                $button
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
                        if($jam_now<$jam12){
                          $status = "<td class='kotor' id='$data->kd_unit'>Kotor</td>";
                          $button = "<a class='btn btn-success popup' data-toggle='modal' id='$data->kd_unit"."-btn-bersih' href='#popup-task' >Bersihkan</a>";
                          $tersedia = "<td>Check_in</td>";
                        } else {
                          $status = "<td>Bersih</td>";
                          $button = "<a class='btn btn-info popup' data-toggle='modal' id='$data->kd_unit"."-btn-lihat' href='#popup-task' >Lihat</a>";
                          $tersedia = "<td class='status' id='$data->kd_unit'>Memuat...</td>";
                        }
                        echo "
                          <tr>
                            <td>$i</td>
                            <td>$data->no_unit</td>
                            <td>$data->nama_apt</td>
                            <td class='hiderespons'>$data->alamat_apt</td>
                            $tersedia
                            $status
                            <td>
                              <center>
                                $button
                              </center>
                            </td>
                          </tr>
                        ";
                      }
                    };
                  $Proses = new Cleaner($db);
                  $show4 = $Proses->showUnit_normal($sekarang);
                  while($data = $show4->fetch(PDO::FETCH_OBJ)){
                    if ($data->kd_unit != 0){ $i++;
                      echo "
                       <tr>
                          <td>$i</td>
                          <td>$data->no_unit</td>
                          <td>$data->nama_apt</td>
                          <td class='hiderespons'>$data->alamat_apt</td>
                          <td class='status' id='$data->kd_unit'>Memuat...</td>
                          <td>Bersih</td>
                          <td>
                            <center>
                              <a class='btn btn-info popup' data-toggle='modal' id='$data->kd_unit"."-btn-lihat' href='#popup-task' >Lihat</a>
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

<!--modal popup tambah unit-->
<div id="popup-task" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Detail Status</h3>
  </div>
  <form action="../../../proses/task.php" method="post" class="form-horizontal">
    <div style="display:none">
      <input name="task-temp" id="task-temp" type="text"/>
      <a id="del-note">Hide</a>
      <p id="del">s</p>
      <input name="unit" id="unit" type="text"/>
    </div>
    <div id="task-induk">
      <div class="widget-title" id="task-bar" style="cursor:pointer;"> <span class="icon"><i class="icon-th"></i></span>
        <h5 id="task-cap">Task Tersisa</h5>
      </div>    
      <div id="task-anak">
        <div class="control-group newpadd">
          <div id="task-anak-isi">
            <!-- Dynamic Element -->
          </div>
        </div>
        <div id="btn-bersihkan" class="controls">
          <input type="submit" id="submit" name="bersih_task" class="btn btn-success" value="Bersihkan"/>
        </div>        
      </div>
    </div>

    <div id="note-induk">
      <div class="widget-title" id="note-bar" style="cursor:pointer;"> <span class="icon"><i class="icon-th"></i></span>
        <h5 id="note-cap">Catatan</h5>
      </div>    
      <div id="note-anak">
        <div class="control-group newpadd">
          <div id="note-anak-isi">
            <!-- Dynamic Element -->
          </div>
          <div class="note newnote">
            <input name="note-baru" id="note-baru" type="text" class="span2" style="width:50%; float:left;" placeholder="Note here..." />
            <a class='btn btn-success' id="note-simpan" style="width:15%; float:left; margin-left:5px;">Simpan</a>
            <a class='btn btn-danger' id="note-batal" onclick="$('.newnote').hide();$('#tambah-note').show();" style="width:15%; float:left; margin-left:5px;">Batal</a>
          </div>
        </div>
        <div class="controls">
          <a class='btn' id="tambah-note">Tambah Catatan</a>
        </div>        
      </div>
    </div>    
  </form>
</div>
<!-- //modal popup tambah unit-->

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--End-Footer-part-->
<script src="../../../asset/js/sweetalert.min.js"></script>
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
