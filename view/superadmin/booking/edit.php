<?php
  session_start();
  require("../../../class/booking.php");
  require("../../../../config/database.php");

  $thisPage = "Edit";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>

<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="booking_via.php" title="Go to Booking Via" class="tip-bottom">Booking Via</a> <a href="#" class="current">Edit</a> </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
	  <?php
    //edit booking_via
    		if (isset($_GET['edit_booking']))
    		{
    		  $Proses = new Booking($db);
    		  $show = $Proses->editBooking_via($_GET['edit_booking']);
    		  $edit = $show->fetch(PDO::FETCH_OBJ);
    		  echo '
    			<div class="span3">
    			</div>
    			<div class="span6">
    			  <div class="widget-box">
    				<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
    				  <h5>Data Baru</h5>
    				</div>
    				<div class="widget-content nopadding">
    				  <form action="../../../proses/booking.php" method="post" class="form-horizontal">
    					<div class="control-group">
    					  <label class="control-label hide">Kode :</label>
    					  <div class="controls">
    						<input name="kd_booking" type="text" class="span11 hide" placeholder="Kode" value="'.$edit->kd_booking.'"/>
    					  </div>
    					</div>
    					<div class="control-group">
    					  <label class="control-label">Booking Via :</label>
    					  <div class="controls">
    						<input name="booking_via" type="text" class="span11" placeholder="Dari" value="'.$edit->booking_via.'"/>
    					  </div>
    					</div>
    					';
              //button here
    					echo '
    					  <div class="form-actions" style="text-align:right">
    						<button name="updateBooking" type="submit" class="btn btn-success">Update</button>
    					  </div>
    					</form>
    				  </div>
    				</div>
    			  </div>
    			  <div class="span3">
    			  </div>
    		  ';
    		}
      ?>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../../js/jquery.min.js"></script>
<script src="../../../js/jquery.ui.custom.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script src="../../../js/jquery.uniform.js"></script>
<script src="../../../js/transaksi.js"></script>
<!--<script src="js/select2.min.js"></script>-->
<script src="../../../js/jquery.dataTables.min.js"></script>
<script src="../../../js/matrix.js"></script>
<script src="../../../js/matrix.tables.js"></script>
</body>
</html>
