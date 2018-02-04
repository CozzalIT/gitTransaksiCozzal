<?php
  session_start();
  require("../../class/booking.php");
  require("../../config/database.php");

  if(!isset($_SESSION['username'])) {
    header('location:../../index.php');
  }else {
    $username = $_SESSION['username'];
  }

  $thisPage = "Booking_via";

  include "template/head.php";
?>
<body>
<?php
  include "template/header.php";
  include "template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <a href="#popup-booking" data-toggle="modal" class="btn btn-info btn-add"><i class="icon-plus"></i> Tambah Data</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Booking Via</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Booking Via</th>
				          <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $Proses = new Booking($db);
        				  $show = $Proses->showBooking_via();
        				  $i = 1;
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
        					echo "
        					  <tr class='gradeC'>
        					    <td>$i</td>
        					    <td>$data->booking_via</td>
        						<td>
        						  <a class='btn btn-primary' href='edit.php?edit_booking=$data->kd_booking'>Edit</a>
        						  <a class='btn btn-danger' href='booking_via.php?delete_booking=$data->kd_booking'>Hapus</a>
        						</td>
        					  </tr>";
        					$i++;
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

<!--Modal Popup Tambah Booking Via-->
<div id="popup-booking" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Data Baru</h3>
  </div>
  <div class="modal-body">
	<form action="" method="post" class="form-horizontal">
	  <div class="control-group">
		<label class="control-label">Booking Via :</label>
		<div class="controls">
		  <input name="booking_via" type="text" class="span2" placeholder="Dari" required/>
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <input type="submit" name="addBooking_via" class="btn btn-success">
		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
		</div>
	  </div>
	</form>
  </div>
</div>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../asset/js/jquery.min.js"></script>
<script src="../../asset/js/jquery.ui.custom.js"></script>
<script src="../../asset/js/bootstrap.min.js"></script>
<script src="../../asset/js/jquery.uniform.js"></script>
<script src="../../asset/js/select2.min.js"></script>
<script src="../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../asset/js/matrix.js"></script>
<script src="../../asset/js/matrix.tables.js"></script>
</body>
</html>