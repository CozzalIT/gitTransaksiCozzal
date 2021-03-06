<?php
  require("../../../class/unit.php");
  require("../../../class/owner.php");
  require("../../../class/apartemen.php");
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
            <h5>Data Unit</h5>
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
				          <th>Ekstra Charge</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
        				  $Proses = new Unit($db);
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
            						  <td>".number_format($data->ekstra_charge, 0, ".", ".")." IDR </td>
                          <td>
                            <center>
                              <a class='btn btn-info' href='calendar.php?calendar_unit=$data->kd_unit'>Calendar</a>
                              <a class='btn btn-success' href='detail_unit.php?detail_unit=".$data->kd_unit."' >Kelola</a>
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
<div id="popup-unit" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Pelanggan Baru</h3>
  </div>
  <div class="modal-body">
	<form action="../../../proses/unit.php" method="post" class="form-horizontal">
	  <div class="control-group">
		<label class="control-label">Apartemen :</label>
		<div class="controls">
		  <select name="apartemen" class="span2">
		  <option>--Pilih Apartemen--</option>
			<?php
  			$Proses = new Apartemen($db);
        $show = $Proses->showApartemen();
        while($data = $show->fetch(PDO::FETCH_OBJ)){
          if ($data->kd_apt != 0){
            echo "<option name='apartemen' value='$data->kd_apt'>$data->nama_apt</option>";
          }
  			}
			?>
		  </select>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">No Unit :</label>
		<div class="controls">
		  <input name="no_unit" type="text" class="span2" placeholder="No Unit" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Owner :</label>
		<div class="controls">
		  <select name="kd_owner" class="span2">
		  <option>--Pilih Owner--</option>
			<?php
        $Proses = new Owner($db);
        $show = $Proses->showOwner();
        while($data = $show->fetch(PDO::FETCH_OBJ)){
          if ($data->kd_owner != 0){
            echo "<option name='kd_owner' value='$data->kd_owner'>$data->nama</option>";
          }
  			}
			?>
		  </select>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Harga Owner WD :</label>
		<div class="controls">
		  <input name="h_owner_wd" type="number" min="0" step="1000" class="span2" placeholder="Owner Week Day"  />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Harga Owner WE :</label>
		<div class="controls">
		  <input name="h_owner_we" type="number" min="0" step="1000"  class="span2" placeholder="Owner Week End"  />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Harga Sewa WD :</label>
		<div class="controls">
		  <input name="h_sewa_wd" type="number" min="0" step="1000"  class="span2" placeholder="Sewa Week Day"  />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Harga Sewa WE :</label>
		<div class="controls">
		  <input name="h_sewa_we" type="number" min="0" step="1000"  class="span2" placeholder="Sewa Week End"  />
		</div>
	  </div><div class="control-group">
		<label class="control-label">Ekstra Charge :</label>
		<div class="controls">
		  <input name="ekstra_charge" type="number" min="0" step="1000"  class="span2" placeholder="Sewa Week Day"  />
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <input type="submit" name="addUnit" class="btn btn-success" value="Submit"/>
		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
		</div>
	  </div>
	</form>
  </div>
</div>
<!-- //modal popup tambah unit-->

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; Brought to you by <a href="http://booking.cozzal.com">Cozzal IT</a> </div>
</div>
<!--End-Footer-part-->
<script src="../../../asset/js/sweetalert.min.js"></script>
<script src="../../../asset/js/hapus.js"></script>
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
<?php
  include '../template/modal.php';
?>
</html>
