<?php  
  session_start();
  
  if(!isset($_SESSION['username'])) {
    header('location:login.php'); 
  }else { 
    $username = $_SESSION['username']; 
  }

  $thisPage = "Penyewa";

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
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>No Telpon</th>
                  <th>Jenis Kelamin</th>
                  <th>Tanggal Input</th>
				  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
				  require("proses/proses.php");
				  $Proses = new Proses();
				  $show = $Proses->showPenyewa();
				  while($data = $show->fetch(PDO::FETCH_OBJ)){
					echo "
					  <tr class=gradeC'>
					    <td>$data->nama</td>
					    <td>$data->alamat</td>
						<td>$data->no_tlp</td>
						<td>$data->jenis_kelamin</td>
						<td>$data->tgl_gabung</td>
						<td class='hide'>$data->tgl_gabung</td>
						<td>
						  <a class='btn btn-success' href='transaksi.php?edit=$data->kd_penyewa'>Transaksi</a>
						  <a class='btn btn-primary' href='edit.php?edit=$data->kd_penyewa'>Edit</a>
						  <a class='btn btn-danger' href='proses/delete/delete_penyewa.php?delete=$data->kd_penyewa'>Hapus</a>
						</td>
					  </tr>";
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
	<form action="proses/add/add_penyewa.php" method="post" class="form-horizontal">
	  <div class="control-group">
		<label class="control-label">Nama :</label>
		<div class="controls">
		  <input name="nama" type="text" class="span2" placeholder="Nama" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Alamat :</label>
		<div class="controls">
		  <input name="alamat" type="text" class="span2" placeholder="Alamat" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">No Telpon :</label>
		<div class="controls">
		  <input name="no_tlp" type="text"  class="span2" placeholder="ex: 0812...."  />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Jenis Kelamin :</label>
		<div class="controls">
		  <label>
			<input type="radio" name="jenis_kelamin" value="Laki-laki" checked/> Laki-laki
		  </label>
		  <label>
			<input type="radio" name="jenis_kelamin" value="Perempuan" /> Perempuan
		  </label>
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <input type="submit" name="addPenyewa" class="btn btn-success">
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
