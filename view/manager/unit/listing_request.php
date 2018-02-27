<?php
  session_start();
  require("../../../class/unit.php");
  require("../../../../config/database.php");

  $thisPage = "Listing Request";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Booking Resuest</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <h3>Listing Request</h3>
        <hr>
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Listing Request</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>No Telepon</th>
                  <th>Email</th>
                  <th>Apartemen</th>
                  <th>Tipe</th>
                  <th>Lantai</th>
				          <th>Kondisi</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $Proses = new Unit($db);
        				  $show = $Proses->showRequestListing();
                  $i = 1;
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
          					echo "
          					  <tr class=gradeC'>
          					    <td>$i</td>
          					    <td>$data->nama</td>
          						  <td>$data->alamat</td>
          						  <td>$data->no_tlp</td>
                        <td>$data->email</td>
          						  <td>$data->apartemen</td>
                        <td>$data->tipe</td>
                        <td>$data->lantai</td>
                        <td>$data->kondisi</td>
                        <td>$data->status</td>
            						<td>
            						  <a class='btn btn-primary' href=''>Edit</a>
            						  <a class='btn btn-danger hapus' href=''>Hapus</a>
            						</td>
          					  </tr>
                    ";
                    $i++;
        				  }
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
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
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
