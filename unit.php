<?php
  session_start();

  if(!isset($_SESSION['username'])) {
    header('location:login.php');
  }else {
    $username = $_SESSION['username'];
  }

  $thisPage = "Unit";

  include "template/head.php";
?>
<body>
<?php
  include "template/header.php";
  include "template/sidebar.php";
?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
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
                  <th>No Unit</th>
                  <th>Nama Apartemen</th>
				          <th>Owner</th>
                  <th>Sewa WeekDay</th>
                  <th>Sewa WeekEnd</th>
                  <!--
                  <th>Owner WeekDay</th>
                  <th>Owner WeekEnd</th>
                  -->
				          <th>Detail</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
        				  require("proses/proses.php");
        				  $Proses = new Proses();
        				  $show = $Proses->showUnit();
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    if ($data->kd_unit != 0){
            					echo "
            					  <tr class=gradeC'>
            					    <td>
                            <a>$data->no_unit</a>
                          </td>
            					    <td>$data->nama_apt</td>
            						  <td>$data->nama</td>
            						  <td><a title='' id='owner_wd' data-content='".number_format($data->h_owner_wd, 0, ".", ".")." IDR' data-placement='right' data-toggle='popover' href='' data-original-title='Owner WeekDay'>".number_format($data->h_sewa_wd, 0, ".", ".")." IDR</a></td>
            						  <td><a title='' id='owner_we' data-content='".number_format($data->h_owner_we, 0, ".", ".")." IDR' data-placement='right' data-toggle='popover' href='' data-original-title='Owner WeekEnd'>".number_format($data->h_sewa_we, 0, ".", ".")." IDR</a></td>
                          <!-- ('In Active')
                            <td>".number_format($data->h_owner_wd, 0, ".", ".")." IDR</td>
              						  <td>".number_format($data->h_owner_we, 0, ".", ".")." IDR</td>
                          -->
            						  <td>
                            <center>
                              <a class='btn btn-info' href='calendar.php?calendar_unit=$data->kd_unit'>Calendar</a>
                              <a class='btn btn-success' href='#' onclick='cek_detail_unit(".$data->kd_unit.")'>Detail</a>                      
                            </center>
                          </td>
                          <td>
                            <center>
                              <a class='btn btn-primary' href='edit.php?edit_unit=$data->kd_unit'>Edit</a>
                              <a class='btn btn-danger' href='proses/proses_delete.php?delete_unit=$data->kd_unit&kurangi_ju=$data->kd_owner'>Hapus</a>
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
<script src="js/bootstrap.min.js"></script>
<script src="js/unit.js"></script>
<script src="js/jquery.gritter.min.js"></script>
<script src="js/jquery.peity.min.js"></script>
<script src="js/matrix.interface.js"></script>
<script src="js/matrix.popover.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<!--<script src="js/jquery.uniform.js"></script> -->
<script src="js/select2.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/matrix.js"></script>
<script src="js/matrix.tables.js"></script>

<?php
  include 'template/modal.php';
?>
</body>
</html>
