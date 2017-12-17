<?php  
  session_start();
  
  if(!isset($_SESSION['username'])) {
    header('location:login.php'); 
  }else { 
    $username = $_SESSION['username']; 
  }

  $thisPage = "Edit";

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
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
	  <?php
		require('proses/proses.php');
 
		if(isset($_GET['edit'])){
		  $Proses = new Proses();
		  $show = $Proses->editPenyewa($_GET['edit']);
		  $edit = $show->fetch(PDO::FETCH_OBJ);
		  echo '
			<div class="span3">
			</div>
			<div class="span6">
			  <div class="widget-box">
				<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
				  <h5>Personal-info</h5>
				</div>  
				<div class="widget-content nopadding">
				  <form action="proses/update/update_penyewa.php" method="post" class="form-horizontal">
					<div class="control-group">
					  <label class="control-label">Kode Penyewa :</label>
					  <div class="controls">
						<input name="kd_penyewa" type="text" class="span11" placeholder="Nama" value="'.$edit->kd_penyewa.'"/>
					  </div>
					</div>
					<div class="control-group">
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
						<input name="no_tlp" type="text" class="span11" placeholder="Ex : 081..." value="'.$edit->no_tlp.'"/>
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
					  ';
					}
				
				  echo '
					  </div>
					  <div class="form-actions" style="text-align:right">
						<button name="updatePenyewa" type="submit" class="btn btn-success">Update</button>
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
	</div>
  </div>
</div>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.uniform.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/matrix.js"></script>
<script src="js/matrix.tables.js"></script>
</body>
</html>
