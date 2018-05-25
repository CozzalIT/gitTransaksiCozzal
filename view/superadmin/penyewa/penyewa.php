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
    <a onclick="$('#popup-penyewa').show();$('#popup-redudansi').hide();" href="#popup-general" data-toggle="modal" class="btn btn-info btn-add"><i class="icon-plus"></i> Tambah Data</a>
    <a onclick="$('#popup-penyewa').hide();$('#popup-redudansi').show();" href="#popup-general" data-toggle="modal" class="btn btn-warning btn-add"><i class="icon-copy"></i> Cek Redudansi</a>
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
        					$kd = $data->kd_penyewa;
                  echo "
        					  <tr class='gradeC'>
        					    <td class='penyewa' id='$kd'>$data->nama</td>
        					    <td id='alamat-$kd'>$data->alamat</td>
        						  <td id='tlp-$kd'>$data->no_tlp</td>
        						  <td id='jk-$kd'>$data->jenis_kelamin</td>
                      <td id='email-$kd'>$data->email</td>
        						  <td>$data->tgl_gabung</td>
        						<td>
        						  <a class='btn btn-success' href='../transaksi/transaksi.php?transaksi=$kd'>Transaksi</a>
        						  <a class='btn btn-primary' href='edit.php?edit=$kd'>Edit</a>
        						  <a class='btn btn-danger hapus' href='../../../proses/penyewa.php?delete_penyewa=$kd'>Hapus</a>
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

<!-- Modal Popup General -->
<div id="popup-general" class="modal hide">
<!-- Modal Popup Tambah Penyewa -->
<div id="popup-penyewa">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Pelanggan Baru</h3>
  </div>
  <div class="modal-body">
	<form action="../../../proses/penyewa.php" method="post" class="form-horizontal">
	  <div class="control-group">
		<label class="control-label">Nama :</label>
		<div class="controls">
		  <input id="nama" name="nama" type="text" class="span2" placeholder="Nama" required/>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Alamat :</label>
		<div class="controls">
		  <input id="alamat" name="alamat" type="text" class="span2" placeholder="Alamat" required/>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">No Telpon :</label>
		<div class="controls">
		  <input id="no_tlp" name="no_tlp" type="text"  class="span2" placeholder="ex: 0812...." required/>
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
      <br> <img id="gif-cek-penyewa" src="../../../asset/images/loading.gif" width="18"> 
      <small id="stat-cek-penyewa">Menganalisis Data Penyewa ...</small>
		</div>
	  </div>
	</form>
  </div>
</div>
<!-- //Modal Popup Tambah Penyewa -->

<!-- Modal Popup Redudansi -->
<div id="popup-redudansi">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3 id="head-cap">Data Redudansi Penyewa</h3>
  </div>
  <form action="../../../proses/task.php" method="post" class="form-horizontal">
   <div style="overflow-y: auto; max-height: 250px;" id="global-red">

    <!-- Dynamic Element -->
   
   </div>
    <div class="controls" style="margin: 0px;">
      <center>
        <img id="gif-status" src="../../../asset/images/loading.gif" width="18"> 
        <small id="text-status">Menganalisis Data Penyewa ...</small>
      </center>
    </div> 
  </form>
</div>
<!-- //Modal Popup Redudansi -->
</div>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<style type="text/css">
  .selected, .selected2{
    font-size: 10px;
    float: right;
    border-radius: 2px;
    color: white;
    padding: 3px;
    cursor: pointer;
    margin-left: 5px;
  }
   .selected:hover, .selected2:hover{
    color: white;
    padding: 4px;
    cursor: pointer;
  } 
  .selected{
    background-color: blue;
  }
  .selected2{
    background-color: red;
  }
</style>
<script src="../../../asset/js/penyewa.js"></script>
<script src="../../../asset/js/sweetalert.min.js"></script>
<script src="../../../asset/js/hapus.js"></script>
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
