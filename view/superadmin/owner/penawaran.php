<?php
  require("../../../class/owner.php");
  require("../../../../config/database.php");

  $thisPage = "Penawaran Owner";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Data Penawaran</a></div>
    <a href="#popup-penawaran" data-toggle="modal" class="btn btn-info btn-add"><i class="icon-plus"></i> Tambah Penawaran</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
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
                /*
                  $Proses = new Owner($db);
        				  $i = 1;
        				  $show = $Proses->showOwner();
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    if ($data->kd_owner != 0){
                      echo "
            					  <tr class='gradeC'>
            						  <td></td>
            					    <td></td>
              						<td></td>
              						<td></td>
              						<td></td>
              						<td>
              						  <a class='btn btn-success' href='#'>Detail</a>
              						  <a class='btn btn-primary' href='#'>Edit</a>
              						  <a class='btn btn-danger hapus' href='#'>Hapus</a>
              						</td>
            					  </tr>";
                      $i++;
                    }
        				  };
                */
        				?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Popup Tambah Penawaran -->
<div id="popup-penawaran" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Penawaran Owner</h3>
  </div>
  <div class="modal-body">
	<form action="../../../proses/owner.php" method="post" class="form-horizontal">
	  <div class="control-group">
  		<label class="control-label">Judul :</label>
  		<div class="controls">
  		  <input name="judul" type="text" class="span3" placeholder="Judul" required/>
  		</div>
	  </div>
	  <div class="control-group">
  		<label class="control-label">Pesan :</label>
  		<div class="controls">
        <textarea name="pesan" class="span3" required></textarea>
  		</div>
	  </div>
    <div class="control-group">
  		<label class="control-label">Harga Weekday :</label>
  		<div class="controls">
        <input name="cb_weekday" id="cb_weekday" type="checkbox" class="span1" onClick="check()"/>
  		  <input name="h_owner_wd" id="h_owner_wd" type="number" class="span2 hide" value="0" required/>
  		</div>
	  </div>
    <div class="control-group">
  		<label class="control-label">Harga Weekend :</label>
  		<div class="controls">
        <input name="cb_weekend" id="cb_weekend" type="checkbox" class="span1" onClick="check()"/>
  		  <input name="h_owner_we" id="h_owner_we" type="number" class="span2 hide" value="0" required/>
  		</div>
	  </div>
    <div class="control-group">
  		<label class="control-label">Harga Mingguan :</label>
  		<div class="controls">
        <input name="cb_mingguan" id="cb_mingguan" type="checkbox" class="span1" onClick="check()"/>
  		  <input name="h_owner_mg" id="h_owner_mg" type="number" class="span2 hide" value="0" required/>
  		</div>
	  </div>
    <div class="control-group">
  		<label class="control-label">Harga Bulanan :</label>
  		<div class="controls">
        <input name="cb_bulanan" id="cb_bulanan" type="checkbox" class="span1" onClick="check()"/>
  		  <input name="h_owner_bln" id="h_owner_bln" type="number" class="span2 hide" value="0" required/>
  		</div>
	  </div>
	  <div class="control-group">
  		<div class="controls">
  		  <input type="submit" name="addPenawaran" class="btn btn-success">
  		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
  		</div>
	  </div>
	</form>
  </div>
</div>
<script>
  function check(){
    var cb_weekday = document.getElementById('cb_weekday');
    var cb_weekend = document.getElementById('cb_weekend');
    var cb_mingguan = document.getElementById('cb_mingguan');
    var cb_bulanan = document.getElementById('cb_bulanan');

    var h_owner_wd = document.getElementById('h_owner_wd');
    var h_owner_we = document.getElementById('h_owner_we');
    var h_owner_mg = document.getElementById('h_owner_mg');
    var h_owner_bln = document.getElementById('h_owner_bln');

    if (cb_weekday.checked == true){
      h_owner_wd.classList.remove("hide");
    }else{
      h_owner_wd.classList.add("hide");
      h_owner_wd.value = 0;
    }

    if (cb_weekend.checked == true){
      h_owner_we.classList.remove("hide");
    }else {
      h_owner_we.classList.add("hide");
      h_owner_we.value = 0;
    }

    if (cb_mingguan.checked == true){
      h_owner_mg.classList.remove("hide");
    }else {
      h_owner_mg.classList.add("hide");
      h_owner_mg.value = 0;
    }

    if (cb_bulanan.checked == true){
      h_owner_bln.classList.remove("hide");
    }else {
      h_owner_bln.classList.add("hide");
      h_owner_bln.value = 0;
    }
  }
</script>
<!-- //Modal Popup Tambah Penawaran -->

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
<!--<script src="js/jquery.uniform.js"></script> -->
<script src="../../../asset/js/select2.min.js"></script>
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
</body>
</html>
