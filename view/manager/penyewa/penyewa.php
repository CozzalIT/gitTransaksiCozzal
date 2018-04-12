<?php
  require("../../../class/penyewa.php");
  require("../../../../config/database.php");

  $thisPage = "Penyewa";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Data Penyewa</a></div>
    <a href="#popup-penyewa" data-toggle="modal" class="btn btn-info btn-add"><i class="icon-plus"></i> Tambah Data</a>
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
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>No Telpon</th>
                  <th>Jenis Kelamin</th>
                  <th>Email</th>
                  <th>Tanggal Input</th>
				          <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
        				  $Proses = new Penyewa($db);
        				  $show = $Proses->showPenyewa();
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
        					echo "
        					  <tr class=gradeC'>
        					    <td>$data->nama</td>
        					    <td>$data->alamat</td>
        						  <td>$data->no_tlp</td>
        						  <td>$data->jenis_kelamin</td>
                      <td>$data->email</td>
        						  <td>$data->tgl_gabung</td>
        						<td>
        						  <a class='btn btn-success' href='../transaksi/transaksi.php?transaksi=$data->kd_penyewa'>Transaksi</a>
        						  <a class='btn btn-primary' href='edit.php?edit=$data->kd_penyewa'>Edit</a>
        						</td>
        					  </tr>";
        				  }
        				?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Popup Tambah Penyewa -->
<div id="popup-penyewa" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Pelanggan Baru</h3>
  </div>
  <div class="modal-body">
	<form action="../../../proses/penyewa.php" method="post" class="form-horizontal">
	  <div class="control-group">
		<label class="control-label">Nama :</label>
		<div class="controls">
		  <input name="nama" type="text" class="span2" placeholder="Nama" required/>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Alamat :</label>
		<div class="controls">
		  <input name="alamat" type="text" class="span2" placeholder="Alamat" required/>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">No Telpon :</label>
		<div class="controls">
		  <input name="no_tlp" type="text"  class="span2" placeholder="ex: 0812...." required/>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Jenis Kelamin :</label>
		<div class="controls">
		  <label>
			<input type="radio" name="jenis_kelamin" value="Laki-laki" checked/> Laki-laki
		  </label>
		  <label>
			<input type="radio" name="jenis_kelamin" value="Perempuan"/> Perempuan
		  </label>
		</div>
	  </div>
    <div class="control-group">
		<label class="control-label">Email :</label>
		<div class="controls">
		  <input name="email" type="text"  class="span2" placeholder="ex: abc@gmail.com" required/>
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
<!-- //Modal Popup Tambah Penyewa -->

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; Brought to you by <a href="http://www.booking.cozzal.com">Cozzal IT</a> </div>
</div>
<!--end-Footer-part-->
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
