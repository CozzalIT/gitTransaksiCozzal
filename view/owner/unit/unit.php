<?php
  require("../../../class/unit.php");;
  require("../../../../config/database.php");

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
    <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Listing Unit</a></div>
    <a id='hidenbtn' href='#' style='display:none'></a>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Daftar Unit</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No Unit</th>
                  <th>Nama Apartemen</th>
				          <th>Alamat</th>
                  <th class="hiderespons">Sewa WeekDay</th>
                  <th class="hiderespons">Sewa WeekEnd</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
        				  $Proses = new Unit($db);
        				  $show = $Proses->showUnitbyOwner($_SESSION['pemilik']);
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    if ($data->kd_unit != 0){
            					echo "
            					  <tr class=gradeC'>
            					    <td>$data->no_unit</td>
            					    <td>$data->nama_apt</td>
                          <td>$data->alamat_apt</td>
                          <td class='hiderespons'>".number_format($data->h_owner_wd, 0, ".", ".")." IDR</td>
                          <td class='hiderespons'>".number_format($data->h_owner_we, 0, ".", ".")." IDR</td>
            						  <td>
                            <center>
                              <a class='btn btn-info' href='calendar.php?calendar_unit=$data->kd_unit'>Calendar</a>
                              <a class='btn btn-success' href='detail_unit.php?detail_unit=".$data->kd_unit."' >Kelola Unit</a>
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
<?php
  include "../template/footer.php";
?>
<!--End-Footer-part-->
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/unit.js"></script>
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
</html>
