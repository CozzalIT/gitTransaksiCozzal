<?php
  session_start();
  require("../../../class/kas.php");
  require("../../../../config/database.php");

  $thisPage = "Kas";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Kas</a></div>
   <a href="#popup-saldo" data-toggle="modal" class="btn btn-success btn-add">Tambah Saldo</a>
   <a href="#popup-mutasi" data-toggle="modal" class="btn btn-success btn-add">Mutasi Dana</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span5">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Tambah Kas</h5>
          </div>
          <div class="widget-content">
            <form action="../../../proses/kas.php" method="post">
  			      <table class="">
                <tbody>
            			<tr>
            				<td class="span4">Sumber Dana </td>
            				<td class="span8"><input type="text" name="sumber_dana" required/></td>
            			</tr>
                  <tr>
            				<td class="span4">Saldo </td>
            				<td class="span8"><input type="number" name="saldo" required/></td>
            			</tr>
                  <tr>
                    <td class="span4"></td>
                    <td class="span8"><input type="submit" name="addKas" class="btn btn-success" value="Submit"/></td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
      <div class="span7">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Kas</h5>
          </div>
          <div class="widget-content nopadding">
			      <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Sumber Dana</th>
                  <th>Saldo</th>
                  <th>Mutasi Terakhir</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $proses = new Kas($db);
                  $show = $proses->showKas();
                  $i = 1;
                  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    echo "
                    <tr class='gradeC'>
                      <td>$i</td>
                      <td>$data->sumber_dana</td>
                      <td>".number_format($data->saldo, 0, ".", ".")." IDR</td>
                      <td>$data->tanggal</td>
                    </tr>
                    ";
                    $i++;
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Mutasi Kas</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Mutasi Dana</th>
                  <th>Jenis Mutasi</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $proses = new Kas($db);
                  $show = $proses->showMutasiKas();
                  $i = 1;
                  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    if($data->jenis == 1){
                      $jenis = "Masuk";
                    }else{
                      $jenis = "Keluar";
                    }
                    switch ($data->keterangan) {
                      case 1:
                        $keterangan = "Dari Kas";
                        break;
                      case 2:
                        $keterangan = "Sumber Non Kas";
                        break;
                      case 3:
                        $keterangan = "Transaksi Umum";
                        break;
                      case 4:
                        $keterangan = "Pembayaran Owner";
                        break;
                      default:
                        $keterangan = "Penggajian Karyawan";
                        break;
                    }
                    echo "
                    <tr class='gradeC'>
                      <td>$i</td>
                      <td>$data->tanggal</td>
                      <td>".number_format($data->mutasi_dana, 0, ".", ".")." IDR</td>
                      <td>$jenis</td>
                      <td>$keterangan</td>
                    </tr>
                    ";
                    $i++;
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

<!-- Modal Popup Mutasi Dana -->
<div id="popup-mutasi" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Mutasi Dana</h3>
  </div>
  <div class="modal-body">
    <form action="../../../proses/kas.php" method="post" class="form-horizontal">
	    <div class="control-group">
		    <label class="control-label">Sumber :</label>
        <div class="controls">
          <select name="sumber">
            <option name="kd_kas" value="">-- Pilih Sumber Dana --</option>
            <?php
              $Proses = new Kas($db);
              $show = $Proses->showKas();
              while($data = $show->fetch(PDO::FETCH_OBJ)){
                if ($data->kd_kas != 0){
                  echo "<option name='kd_kas' value='$data->kd_kas'>$data->sumber_dana</option>";
                }
              }
            ?>
          </select>
        </div>
	    </div>
	    <div class="control-group">
		    <label class="control-label">Tujuan :</label>
        <div class="controls">
          <select name="tujuan">
            <option name="kd_kas" value="">-- Pilih Sumber Dana --</option>
            <?php
              $Proses = new Kas($db);
              $show = $Proses->showKas();
              while($data = $show->fetch(PDO::FETCH_OBJ)){
                if ($data->kd_kas != 0){
                  echo "<option name='kd_kas' value='$data->kd_kas'>$data->sumber_dana</option>";
                }
              }
            ?>
          </select>
        </div>
	    </div>
      <div class="control-group">
        <label class="control-label">Saldo :</label>
        <div class="controls">
          <input name="saldo" type="number" class="span2" placeholder="Saldo" required/>
        </div>
      </div>
	    <div class="control-group">
		    <div class="controls">
		      <input type="submit" name="mutasiDana" value="submit" class="btn btn-success">
		      <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
		    </div>
	    </div>
	  </form>
  </div>
</div>
<!-- //Modal Popup Mutasi -->

<!-- Modal Popup Tambah Saldo -->
<div id="popup-saldo" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Mutasi Dana</h3>
  </div>
  <div class="modal-body">
    <form action="../../../proses/kas.php" method="post" class="form-horizontal">
	    <div class="control-group">
		    <label class="control-label">Kas :</label>
        <div class="controls">
          <select name="kas">
            <option name="kd_kas" value="">-- Pilih Kas --</option>
            <?php
              $Proses = new Kas($db);
              $show = $Proses->showKas();
              while($data = $show->fetch(PDO::FETCH_OBJ)){
                if ($data->kd_kas != 0){
                  echo "<option name='kd_kas' value='$data->kd_kas'>$data->sumber_dana</option>";
                }
              }
            ?>
          </select>
        </div>
	    </div>
      <div class="control-group">
        <label class="control-label">Jumlah Dana :</label>
        <div class="controls">
          <input name="jumlah" type="number" class="span2" placeholder="Saldo" required/>
        </div>
      </div>
	    <div class="control-group">
		    <div class="controls">
		      <input type="submit" name="addSaldo" value="submit" class="btn btn-success">
		      <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
		    </div>
	    </div>
	  </form>
  </div>
</div>
<!-- //Modal Popup Mutasi -->

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../../asset/js/sweetalert.min.js"></script>
<script src="../../../asset/js/hapus.js"></script>
<script src="../../../asset/js/jquery.min.js"></script>
<script src="../../../asset/js/jquery.ui.custom.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/jquery.uniform.js"></script>
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
</body>
</html>
