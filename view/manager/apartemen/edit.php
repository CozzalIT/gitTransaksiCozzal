<?php
  session_start();
  require("../../../class/apartemen.php");
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
  <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="apartemen.php" title="Go to Apartemen" class="tip-bottom">Data Apartemen</a> <a href="#" class="current">Edit</a> </div>  
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
	  <?php
    //edit data apartemen
    		if (isset($_GET['edit_apt']))
    		{
    		  $Proses = new Apartemen($db);
    		  $show = $Proses->editApartemen($_GET['edit_apt']);
    		  $edit = $show->fetch(PDO::FETCH_OBJ);
    		  echo '
    			<div class="span3">
    			</div>
    			<div class="span6">
    			  <div class="widget-box">
    				<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
    				  <h5>Apartement-info</h5>
    				</div>
    				<div class="widget-content nopading">
    				  <form action="../../../proses/apartemen.php" method="post" class="form-horizontal">
    					<div class="control-group">
    					  <label class="control-label hide">Kode Apartement :</label>
    					  <div class="controls">
    						<input name="kd_apt" type="text" class="span11 hide" placeholder="Kode" value="'.$edit->kd_apt.'"/>
    					  </div>
    					</div>
    					<div class="control-group">
    					  <label class="control-label">Nama Apartemen :</label>
    					  <div class="controls">
    						<input name="nama_apt" type="text" class="span11" placeholder="Nama" value="'.$edit->nama_apt.'"/>
    					  </div>
    					</div>
    					<div class="control-group">
    					  <label class="control-label">Alamat :</label>
    					  <div class="controls">
    						<input name="alamat_apt" type="text" class="span11" placeholder="Alamat" value="'.$edit->alamat_apt.'"/>
    					  </div>
    					</div>';
    //button here
    					echo '
    					  <div class="form-actions" style="text-align:right">
    						<button name="updateApartemen" type="submit" class="btn btn-success">Update</button>
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
