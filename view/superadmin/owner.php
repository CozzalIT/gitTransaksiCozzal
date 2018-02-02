<?php
  session_start();
  require("../../class/owner.php");
  require("../../class/dp_via.php");
  require("../../config/database.php");

  if(!isset($_SESSION['username'])) {
    header('location:index.php');
  }else {
    $username = $_SESSION['username'];
  }

  $thisPage = "Owner";

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
    <a href="#popup-owner" data-toggle="modal" class="btn btn-info btn-add"><i class="icon-plus"></i> Tambah Data</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Owner</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
        				  <th>Alamat</th>
        				  <th>No Telepon</th>
                  <th>E-mail</th>
      				  <th>Action</th>
      				</tr>
              </thead>
              <tbody>
                <?php
          $Proses = new Owner($db);
				  $i = 1;
				  $show = $Proses->showOwner();
				  while($data = $show->fetch(PDO::FETCH_OBJ)){
            if ($data->kd_owner != 0){
              echo "
    					  <tr class=gradeC'>
    						<td>$i</td>
    					    <td>$data->nama</td>
    						<td>$data->alamat</td>
    						<td>$data->no_tlp</td>
    						<td>$data->email</td>
    						<td>
    						  <a class='btn btn-success' href='owner.php?detail_owner=$data->kd_owner'>Detail</a>
    						  <a class='btn btn-primary' href='edit.php?edit_owner=$data->kd_owner'>Edit</a>
    						  <a class='btn btn-danger' href='owner.php?delete_owner=$data->kd_owner'>Hapus</a>
    						</td>
    					  </tr>";
              $i++;
            }
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

<!-- Modal Popup Tambah Owner -->
<div id="popup-owner" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Data Owner Baru</h3>
  </div>
  <div class="modal-body">
	<form action="" method="post" class="form-horizontal">
	  <div class="control-group">
		<label class="control-label">Nama :</label>
		<div class="controls">
		  <input name="nama" type="text" class="span2" placeholder="Nama Lengkap" required/>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Alamat :</label>
		<div class="controls">
		  <input name="alamat" type="text" class="span2" placeholder="Alamat" required/>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">No Telepon :</label>
		<div class="controls">
		  <input name="no_tlp" type="text" class="span2" placeholder="ex : 0812.." required/>
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
		<label class="control-label">Bank :</label>
		<div class="controls">
		  <select name="kd_bank">
		  <option name="" value="" >-- Pilih Bank --</option>
			<?php
				$Proses = new dpVia($db);
        $show = $Proses->showDp_via();
        while($data = $show->fetch(PDO::FETCH_OBJ)){
				  echo "<option name='kd_bank' value='$data->kd_bank'>$data->nama_bank</option>";
			  }
			?>
		  </select>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">No Rekening :</label>
		<div class="controls">
		  <input name="no_rek" type="text" class="span2" placeholder="No Rekening" required/>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">E-mail :</label>
		<div class="controls">
		  <input name="email" type="text" class="span2" placeholder="Alamat E-Mail" required/>
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <input type="submit" name="addOwner" class="btn btn-success">
		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
		</div>
	  </div>
	</form>
  </div>
</div>
<!-- //Modal Popup Tambah Owner -->

<!-- detail data owner -->
<?php
if(isset($_GET['detail_owner'])){
$Proses = new Owner($db);
$show = $Proses->editOwner($_GET['detail_owner']);
$detail = $show->fetch(PDO::FETCH_OBJ);

echo '
<div id="popup-detail" class="modal">
  <div class="modal-header">
<form action="owner.php" >
  <button id="tambah" data-dismiss="modal" class="close" type="submit">×</button>
</form>
  <script type="text/javascript">
    $(document).ready(function(){
    $("#tambah").click(function(){
      $(".modal").addClass("hide");
    });
    });
  </script>
  <h3>Transaksi</h3>
  </div>
  <div class="modal-body">
  <div class="widget-content">
    <div class="row-fluid">
    <div class="span8">
      <table class="">
      <tbody>
        <tr>
        <td><h4>Detail Owner</h4><p id="demo"></p></td>
        </tr>
        <tr>
        <td>Nama</td>
        <td>: '.$detail->nama.'</td>
        </tr>
        <tr>
        <td>Alamat</td>
        <td>: '.$detail->alamat.'</td>
        </tr>
        <tr>
        <td>Jenis Kelamin</td>
        <td>: '.$detail->jenis_kelamin.'</td>
        </tr>
        <tr>
        <td>No Telpon</td>
        <td>: '.$detail->no_tlp.'</td>
        </tr>
        <tr>
        <td>E-Mail</td>
        <td>: '.$detail->email.'</td>
        </tr>
        <tr>
        <td>Tanggal Bergabung</td>
        <td>: '.$detail->tgl_gabung.'</td>
        </tr>
        <tr>
        <td>Jumlah Unit</td>
        <td>: '.$detail->jumlah_unit.'</td>
        </tr>

        <tr>
        <td>Bank</td>
        <td>: '.$detail->nama_bank.'</td>
        </tr>
        <tr>
        <td>No Rekening</td>
        <td>: '.$detail->no_rek.'</td>
        </tr>
      </tbody>
      </table>
    </div>
    </div>
  </div>
  </div>
</div>
';
}
?>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../asset/js/jquery.min.js"></script>
<script src="../../asset/js/jquery.ui.custom.js"></script>
<script src="../../asset/js/bootstrap.min.js"></script>
<!--<script src="js/jquery.uniform.js"></script> -->
<script src="../../asset/js/select2.min.js"></script>
<script src="../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../asset/js/matrix.js"></script>
<script src="../../asset/js/matrix.tables.js"></script>
</body>
</html>
