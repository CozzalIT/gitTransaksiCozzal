<?php
  session_start();
  require("../../../class/account.php");
  require("../../../config/database.php");

  $thisPage = "Account Management";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Account Management</a></div>
    <a href="#popup-penyewa" data-toggle="modal" class="btn btn-info btn-add"><i class="icon-plus"></i> Tambah Data</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Account Management</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Hak Akses</th>
                  <th>Status</th>
				          <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
        				  $Proses = new Account($db);
        				  $show = $Proses->showAccount();
                  $i = 1;
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
        					echo "
        					  <tr class='gradeC'>
        					    <td>$i</td>
        					    <td>$data->username</td>
        						  <td>$data->hak_akses</td>
                      <td>Terhubung dan Aktif</td>
          						<td>
                        <center>
            						  <a class='btn btn-primary' href='#'>Edit</a>
            						  <a class='btn btn-danger' href='#'>Hapus</a>
                        </center>
          						</td>
        					  </tr>";
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

<!-- Modal Popup Tambah Penyewa -->
<div id="popup-penyewa" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" onclick="$('#reset').click()" type="button">×</button>
    <h3>Akun Baru</h3>
  </div>
  <div class="modal-body">
	<form action="../../../proses/account.php" method="post" class="form-horizontal">
	  <div class="control-group">
  		<label class="control-label">Username :</label>
  		<div class="controls">
  		  <input name="username" type="text" class="span2" placeholder="Username" required/>
  		</div>
  	</div>
	  <div class="control-group">
  		<label class="control-label">Password :</label>
  		<div class="controls">
  		  <input name="password" type="password" class="span2" placeholder="Password" required/>
  		</div>
	  </div>
	  <div class="control-group">
		  <label class="control-label">Hak Akses :</label>
		  <div class="controls">
        <select name="hak_akses" id="hak_akses" class="span2" required>
          <option value="" >--Pilih Hak Akses--</option>
          <option value="superadmin" >Superadmin</option>
          <option value="admin" >Admin</option>
          <option value="manager" >Property Manager</option>
          <option value="owner" >Property Owner</option>
        </select>
		  </div>
	  </div>
    <div class="control-group" id="owner">
      <label class="control-label">Nama Owner :</label>
      <div class="controls">
        <select name="kd_owner" id="kd_owner" class="span2">
          <option value="superadmin" >Superadmin</option>
          <option value="admin" >Admin</option>
          <option value="manager" >Property Manager</option>
          <option value="owner" >Property Owner</option>
        </select>
      </div>
    </div>
	  <div class="control-group">
		<div class="controls">
		  <input type="submit" name="addAccount" value="Tambahkan Akun" class="btn btn-success">
		  <button data-dismiss="modal" class="btn btn-inverse" onclick="$('#reset').click()">Batal</button>
      <button type="reset" id="reset" style="display:none">Batal</button>
		</div>
	  </div>
	</form>
  </div>
</div>
<!-- //Modal Popup Tambah Penyewa -->

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../../asset/js/jquery.min.js"></script>
<script src="../../../asset/js/jquery.ui.custom.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/jquery.uniform.js"></script>
<!--<script src="../../../asset/js/select2.min.js"></script> -->
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
<script src="../../../asset/js/account.js"></script>
</body>
</html>
