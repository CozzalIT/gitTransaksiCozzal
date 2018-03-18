<?php
  require("../../../class/dp_via.php");
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
  <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="dp_via.php" title="Go to DP Via" class="tip-bottom">DP Via</a> <a href="#" class="current">Edit</a> </div> 
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
	  <?php
    //edit data bank
    		if (isset($_GET['edit_bank']))
    		{
    		  $Proses = new dpVia($db);
    		  $show = $Proses->editDp_via($_GET['edit_bank']);
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
    				  <form action="../../../proses/dp.php" method="post" class="form-horizontal">
    					<div class="control-group">
    					  <label class="control-label hide">Kode :</label>
    					  <div class="controls">
    						<input name="kd_bank" type="text" class="span11 hide" placeholder="No Rekening" value="'.$edit->kd_bank.'"/>
    					  </div>
    					</div>
    					<div class="control-group">
    					  <label class="control-label">Nama Bank :</label>
    					  <div class="controls">
    						<input name="nama_bank" type="text" class="span11" placeholder="Nama Bank" value="'.$edit->nama_bank.'"/>
    					  </div>
    					</div>
    					';
              //button here
    					echo '
    					  <div class="form-actions" style="text-align:right">
    						<button name="updateBank" type="submit" class="btn btn-success">Update</button>
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
