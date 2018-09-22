<?php
  require("../../../class/apartemen.php");
  require("../../../class/unit.php");
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
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Owner</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Owner</th>
        				  <th>Unit</th>
        				  <th>Judul</th>
                  <th>Pesan</th>
                  <th>Perubahan Harga</th>
                  <th>Status</th>
        				  <th>Action</th>
        				</tr>
              </thead>
              <tbody>
                <?php
                  $Proses = new Owner($db);
        				  $i = 1;
        				  $show = $Proses->showPenawaranOwner();
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    if ($data->kd_owner != 0){
                      if ($data->status == 0){
                        $status = "<div style='color:blue;'>Waiting</div>";
                      }elseif ($data->status == 1) {
                        $status = "<div style='color:green;'>Accepted</div>";
                      }else {
                        $status = "<div style='color:red;'>Rejected</div>";
                      }
                      if ($data->h_owner_wd != 0){
                        $wd = "- Weekday = ".number_format($data->h_owner_wd, 0, ".", ".")." IDR";
                      }else {
                        $wd = null;
                      }
                      if ($data->h_owner_we != 0){
                        $we = "<br>- Weekend = ".number_format($data->h_owner_we, 0, ".", ".")." IDR";
                      }else {
                        $we = null;
                      }
                      if ($data->h_owner_mg != 0){
                        $mg = "<br>- Mingguan = ".number_format($data->h_owner_mg, 0, ".", ".")." IDR";
                      }else {
                        $mg = null;
                      }
                      if ($data->h_owner_bln != 0){
                        $bln = "<br>- Bulanan = ".number_format($data->h_owner_bln, 0, ".", ".")." IDR";
                      }else {
                        $bln = null;
                      }
                      $popupPackage = '"'.$data->kd_unit."/".$data->kd_owner."/".$wd."/".$we."/".$mg."/".$bln.'"';
                      echo "
            					  <tr class='gradeC'>
            						  <td>$i</td>
            					    <td>$data->nama</td>
              						<td>$data->no_unit</td>
              						<td>$data->judul</td>
                          <td>".substr($data->pesan,0,20)."...<a href='#' style='font-size:90%;'>Read More</a></td>
                          <td>$wd $we $mg $bln</td>
              						<td><strong>$status</strong></td>
                          <td>
                            <div class='btn-group' style='margin-left: 20px;'>
                              <button data-toggle='dropdown' class='btn btn-success dropdown-toggle'>Action <span class='caret'></span></button>
                              <ul class='dropdown-menu'>
                                <li><a id='detail' name='detail' href='../../../proses/owner.php?deletePenawaran=$data->kd_penawaran''>Hapus</a></li>
                                ";
                                if($data->status == 1){
                                  echo "
                                    <li><a id='detail' name='detail' href='#' onClick='updateSewa($popupPackage)'>Update harga sewa</a></li>
                                  ";
                                }
                                echo"
                              </ul>
                            </div>
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

<!-- Modal Popup Tambah Penawaran -->
<div id="popup-penawaran" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Penawaran Owner</h3>
  </div>
  <div class="modal-body">
	<form action="../../../proses/owner.php" method="post" class="form-horizontal">
    <div class="control-group">
      <label class="control-label">Owner :</label>
      <div class="controls">
        <select id="owner" name="owner" class="span3">
          <option name="" value="">-- Pilih Owner --</option>
          <?php
            $Proses = new Owner($db);
            $show = $Proses->showOwner();
            while($data = $show->fetch(PDO::FETCH_OBJ)){
              echo "<option name='kd_owner' value='$data->kd_owner'>$data->nama</option>";
            }
          ?>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Unit :</label>
      <div class="controls">
        <select name="unit" id="unit" class="span3">
          <option value="">-- Pilih Unit --</option>
        </select>
      </div>
    </div>
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
  		  <input type="submit" name="addPenawaran" value="Send" class="btn btn-success">
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

<!-- Modal Popup Update Harga Sewa -->
<script>
  function updateSewa(x){
    $("#popup-sewa").removeClass("hide");
    //0: kd_unit 1:kd_owner 2:wd 3:we 4:mg 5:bln
    var splitPackage = x.split("/");
    $("#kd_unit").val(splitPackage[0]);
    $("#kd_owner").val(splitPackage[1]);
    if (splitPackage[2] == "") {
      $("#groupWd").addClass("hide");
    }
    if (splitPackage[3] == "") {
      $("#groupWe").addClass("hide");
    }
    if (splitPackage[4] == "") {
      $("#groupMg").addClass("hide");
    }
    if (splitPackage[5] == "") {
      $("#groupBln").addClass("hide");
    }
  }
  $(document).ready(function(){
    $("#close").click(function(){
      $(".modal").addClass("hide");
    });
  });
</script>
<div id="popup-sewa" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" id="close" class="close" >×</button>
    <h3>Update Harga Sewa</h3>
  </div>
  <div class="modal-body">
	<form action="../../../proses/unit.php" method="post" class="form-horizontal">
    <div class="control-group hide">
  		<label class="control-label">Kode Unit :</label>
  		<div class="controls">
  		  <input name="kd_unit" id="kd_unit" type="text" class="span3" value=""/>
  		</div>
	  </div>
    <div class="control-group hide">
  		<label class="control-label">Kode Owner :</label>
  		<div class="controls">
  		  <input name="kd_owner" id="kd_owner" type="text" class="span3" value=""/>
  		</div>
	  </div>
    <div class="control-group" id="groupWd">
  		<label class="control-label">Harga Weekday :</label>
  		<div class="controls">
  		  <input name="h_sewa_wd" type="number" class="span3" value="0"/>
  		</div>
	  </div>
    <div class="control-group" id="groupWe">
  		<label class="control-label">Harga Weekend :</label>
  		<div class="controls">
  		  <input name="h_sewa_we" type="number" class="span3" value="0"/>
  		</div>
	  </div>
    <div class="control-group" id="groupMg">
  		<label class="control-label">Harga Mingguan :</label>
  		<div class="controls">
  		  <input name="h_sewa_mg" type="number" class="span3" value="0"/>
  		</div>
	  </div>
    <div class="control-group" id="groupBln">
  		<label class="control-label">Harga Bulanan :</label>
  		<div class="controls">
  		  <input name="h_sewa_bln" type="number" class="span3" value="0"/>
  		</div>
	  </div>
	  <div class="control-group">
  		<div class="controls">
  		  <input type="submit" name="updateSewa" value="Update" class="btn btn-success">
  		</div>
	  </div>
	</form>
  </div>
</div>
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
