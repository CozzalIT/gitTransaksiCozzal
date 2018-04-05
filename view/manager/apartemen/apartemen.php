<?php
  require("../../../class/apartemen.php");
  require("../../../../config/database.php");

  $thisPage = "Apartemen";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Data Apartemen</a></div>
    <a href="#popup-apartemen" data-toggle="modal" class="btn btn-info btn-add"><i class="icon-plus"></i> Tambah Data</a>
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
                  <th class="span1">No</th>
                  <th>Nama Apartemen</th>
                  <th>Alamat Apartemen</th>
				          <th class="span3">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $Proses = new Apartemen($db);
        				  $show = $Proses->showApartemen();
        				  $i = 1;
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    if ($data->kd_apt != 0){
                      echo "
            					  <tr class=gradeC'>
            					    <td style='text-align:center;'>$i</td>
            					    <td>$data->nama_apt</td>
            						  <td>$data->alamat_apt</td>
            						  <td>
            						    <a class='btn btn-primary' href='edit.php?edit_apt=$data->kd_apt'>Edit</a>
            						    <a class='btn btn-danger hapus' href='../../../proses/apartemen.php?delete_apt=$data->kd_apt'>Hapus</a>
            						  </td>
            					  </tr>";
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

<!--Modal Popup Tambah Apartemen -->
<div id="popup-apartemen" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Apartemen Baru</h3>
  </div>
  <div class="modal-body">
	<form action="../../../proses/apartemen.php" method="post" class="form-horizontal">
	  <div class="control-group">
		<label class="control-label">Nama Apartemen</label>
		<div class="controls">
		  <input name="nama_apt" type="text" class="span2" placeholder="Nama" required/>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Alamat Apartemen</label>
		<div class="controls">
		  <input name="alamat_apt" type="text" class="span2" placeholder="Alamat" required/>
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <input type="submit" name="addApartemen" class="btn btn-success">
		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
		</div>
	  </div>
	</form>
  </div>
</div>
<!-- //Modal Popup Tambah Apartemen -->

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
