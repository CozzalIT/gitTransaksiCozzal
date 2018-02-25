<?php
  session_start();
  require("../../../class/owner.php");
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
  <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="owner.php" title="Go to Data Owner" class="tip-bottom">Data Owner</a> <a href="#" class="current">Edit</a> </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
	  <?php
    //Edit data owner
    		if (isset($_GET['edit_owner']))
    		{
    		  $Proses = new Owner($db);
    		  $show = $Proses->editOwner($_GET['edit_owner']);
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
    				  <form action="../../../proses/owner.php" method="post" class="form-horizontal">
    					<div class="control-group">
    					  <input name="kd_owner" class="hide" type="text" value="'.$edit->kd_owner.'"/>
    					  <label class="control-label">Nama :</label>
    					  <div class="controls">
    						<input name="nama" type="text" class="span11" placeholder="Nama" value="'.$edit->nama.'"/>
    					  </div>
    					</div>
    					<div class="control-group">
    					  <label class="control-label">Alamat :</label>
    					  <div class="controls">
    						<input name="alamat" type="text" class="span11" placeholder="Alamat" value="'.$edit->alamat.'"/>
    					  </div>
    					</div>
    					<div class="control-group">
    					  <label class="control-label">No Telpon :</label>
    					  <div class="controls">
    						<input name="no_tlp" type="text" class="span11" placeholder="Ex : 08x..." value="'.$edit->no_tlp.'"/>
    					  </div>
    					</div>
    					<div class="control-group">
    					  <label class="control-label">Jenis Kelamin :</label>
                        ';
    					if ($edit->jenis_kelamin == 'Laki-laki') {
    					  echo '
    						<div class="controls">
    						  <label>
    							<input type="radio" name="jenis_kelamin" value="Laki-laki" checked/> Laki-laki
    						  </label>
    						  <label>
    							<input type="radio" name="jenis_kelamin" value="Perempuan" /> Perempuan
    						  </label>
    						</div>
    					  ';
    					} else {
    					  echo '
    						<div class="controls">
    						  <label>
    							<input type="radio" name="jenis_kelamin" value="Laki-laki" /> Laki-laki
    						  </label>
    						  <label>
    							<input type="radio" name="jenis_kelamin" value="Perempuan" checked/> Perempuan
    						  </label>
    						</div>
    					'; }

    					echo '
    						<div class="control-group">
    						  <label class="control-label">Via Bank :</label>
    							<div class="controls">
    								<select name="kd_bank" class="span11">
    									<option name="" value="" >-- Pilih Bank --</option>';
          						$Proses = new dpVia($db);
          						$show = $Proses->showDp_via();
          						while($data = $show->fetch(PDO::FETCH_OBJ)){
            						if ($edit->kd_bank!=$data->kd_bank)
            						  echo "<option name='kd_bank' value='$data->kd_bank'>$data->nama_bank</option>";
            						else  echo "<option name='kd_bank' value='$data->kd_bank' selected='true'>$data->nama_bank</option>";
          						}
          					  echo '
    								</select>
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">No Rekening :</label>
    							<div class="controls">
    								<input name="no_rek" type="text" class="span11" placeholder="No Rekening" value="'.$edit->no_rek.'"/>
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">E-mail :</label>
    							<div class="controls">
    								<input name="email" type="text" class="span11" placeholder="Alamat E-Mail" value="'.$edit->email.'"/>
    							</div>
    						</div>';
                //button here
    					  echo '
    					  <div class="form-actions" style="text-align:right">
    						<button name="updateOwner" type="submit" class="btn btn-success">Update</button>
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
