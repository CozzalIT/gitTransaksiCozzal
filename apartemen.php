<?php
  session_start();

  if(!isset($_SESSION['username'])) {
    header('location:login.php');
  }else {
    $username = $_SESSION['username'];
  }

  $thisPage = "Apartemen";

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
    <a href="#popup-penyewa" data-toggle="modal" class="btn btn-info btn-add"><i class="icon-plus"></i> Tambah Data</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
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
				  require("proses/proses.php");
				  $Proses = new Proses();
				  $show = $Proses->showApartemen();
				  $i = 1;
				  while($data = $show->fetch(PDO::FETCH_OBJ)){
					echo "
					  <tr class=gradeC'>
					    <td style='text-align:center;'>$i</td>
					    <td>$data->nama_apt</td>
						<td>$data->alamat_apt</td>
						<td>
						    <a class='btn btn-primary' href='#'>Edit</a>
						    <a class='btn btn-danger' href='proses/delete/delete_apt.php?delete=$data->kd_apt'>Hapus</a>
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

<div id="popup-penyewa" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Pelanggan Baru</h3>
  </div>
  <div class="modal-body">
	<form action="proses/proses_add.php" method="post" class="form-horizontal">
	  <div class="control-group">
		<label class="control-label">Nama Apartemen</label>
		<div class="controls">
		  <input name="nama_apt" type="text" class="span2" placeholder="Nama" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Alamat Apartemen</label>
		<div class="controls">
		  <input name="alamat_apt" type="text" class="span2" placeholder="Alamat" />
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
