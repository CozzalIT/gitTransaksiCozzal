<?php
  session_start();
  require("../../../class/account.php");
  require("../../../../config/database.php");

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
    <a href="#popup-penyewa" data-toggle="modal" class="btn btn-info btn-add"><i class="icon-plus"></i>Tambah Akun</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
<?php
if (file_exists('../../../proses/gagal')){
echo'   <div class="alert alert-danger" role="alert">
          <strong>Gagal menambahkan akun. </strong>Username yang anda tambahkan sudah tersedia
        </div>';
rmdir('../../../proses/gagal');
}
?>
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Account Management</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Hak Akses</th>
                  <th>Status</th>
                  <th>Pemilik</th>
				          <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
//-------------------------
      function getHakAkses($name){
        switch ($name) {
        case "admin": return "Admin"; break;
        case "superadmin": return "Superadmin"; break;
        case "manager"; return "Property Manager"; break;
        case "owner": return "Property Owner"; break;
        case "cleaner": return "Cleaner"; break;
        default: return "Undefined";
        }
      }
//-------------------------
        				  $Proses = new Account($db);
        				  $show = $Proses->showAccount_owner();
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    if($data->status==1) {
                     $status_aktif = 'Aktif';
                     $button1 = "<a class='btn btn-warning' href='../../../proses/account.php?non_aktif=".$data->username."'>Non Aktifkan</a>";
                     $button2 = "<a class='btn btn-primary' href='../../../proses/account.php?delete_rel=".$data->username."'>Hapus Relasi</a>";
                    }
                    elseif($data->status==2){
                     $status_aktif = 'Non Aktif';
                     $button1 = "<a style='padding: 4px 26px 4px' class='btn btn-success' href='../../../proses/account.php?aktif=".$data->username."&ha=".$data->hak_akses."'>Aktifkan</a>";
                     $button2 = "<a class='btn btn-primary' href='../../../proses/account.php?delete_rel=".$data->username."'>Hapus Relasi</a>";
                    }
                    $hak_akses = getHakAkses($data->hak_akses);
        					echo "
        					  <tr class='gradeC'>
        					    <td>$data->username</td>
        						  <td>$hak_akses</td>
                      <td>$status_aktif</td>
                      <td>$data->nama</td>
          						<td>
                        <center>
            						  $button1
            						  $button2
                        </center>
          						</td>
        					  </tr>";
        				  }

                  $show2 = $Proses->showAccount_status2();
                  while($data = $show2->fetch(PDO::FETCH_OBJ)){
                    $hak_akses = getHakAkses($data->hak_akses);
                  echo "
                    <tr class='gradeC'>
                      <td>$data->username</td>
                      <td>$hak_akses</td>
                      <td>Non Aktif</td>
                      <td>Tidak diketahui</td>
                      <td>
                        <center>
                          <a style='padding: 4px 26px 4px' class='btn btn-success' href='../../../proses/account.php?aktif=".$data->username."&ha=".$data->hak_akses."'>Aktifkan</a>
                          <a style='padding: 4px 16px 4px' class='btn btn-danger' href='../../../proses/account.php?delete_akun=".$data->username."'>Hapus Akun</a>
                        </center>
                      </td>
                    </tr>";
                  }

                  $show3 = $Proses->showAccount_status3();
                  while($data = $show3->fetch(PDO::FETCH_OBJ)){
                     if($data->hak_akses=='owner') {
                     $status_aktif = 'Non Aktif'; $nama = 'Tidak terelasi';
                     $button1 = "<a id='$data->username' style='padding: 4px 21px 4px' class='btn btn-info relasi' data-toggle='modal' href='#popup-relasi'>Relasikan</a>";
                     $button2 = "<a style='padding: 4px 16px 4px' class='btn btn-danger' href='../../../proses/account.php?delete_akun=".$data->username."'>Hapus Akun</a>";
                    }
                    else{
                     $status_aktif = 'Aktif'; $nama = 'Tidak diketahui';
                     $button1 = "<a class='btn btn-warning' href='../../../proses/account.php?non_aktif=".$data->username."'>Non Aktifkan</a>";
                     $button2 = "<a style='padding: 4px 16px 4px' class='btn btn-danger' href='../../../proses/account.php../../../proses/account.php?aktif=".$data->username."delete_akun=".$data->username."'>Hapus Akun</a>";
                    }
                    $hak_akses = getHakAkses($data->hak_akses);
                  echo "
                    <tr class='gradeC'>
                      <td>$data->username</td>
                      <td>$hak_akses</td>
                      <td>$status_aktif</td>
                      <td>$nama</td>
                      <td>
                        <center>
                          $button1
                          $button2
                        </center>
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
    <button data-dismiss="modal" class="close" onclick="$('#reset').click()" type="button">×</button>
    <h3>Akun Baru</h3>
  </div>
  <div class="modal-body">
	<form action="../../../proses/account.php" onsubmit="return validasi_username()" method="post" class="form-horizontal">
	  <div class="control-group">
  		<label class="control-label">Username :</label>
  		<div class="controls">
  		  <input id="username" name="username" type="text" class="span2" placeholder="Username" required/>
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
          <option value="cleaner" >Cleaner</option>
        </select>
		  </div>
	  </div>
    <div class="control-group" id="ow">
      <label class="control-label">Nama Owner :</label>
      <div class="controls">
        <select name="kd_owner" id="kd_owner" class="span2">
          <option value="null" >Relasikan Nanti</option>
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

<!-- // Popup relasikan -->
<div id="popup-relasi" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Relasi Akun</h3>
  </div>
  <div class="modal-body">
  <form action="../../../proses/account.php" onsubmit="return validasi_username()" method="post" class="form-horizontal">
    <div class="control-group">
      <label class="control-label">Username :</label>
      <div class="controls">
        <input id="username2" name="username2" type="text" class="span2" disabled/>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Nama Owner :</label>
      <div class="controls">
        <select name="kd_owner2" id="get_owner" class="span2" required>
          <option value="null" >Relasikan Nanti</option>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Set Status :</label>
      <div class="controls">
        <select name="status" class="span2" required>
          <option value="2" >Non-Aktif</option>
          <option value="1" >Aktif</option>
        </select>
      </div>
    </div>
    <div class="control-group">
    <div class="controls">
      <input type="submit" name="addRelasi" id="addRelasi" value="Update" class="btn btn-success">
      <button data-dismiss="modal" class="btn btn-inverse">Batal</button>
    </div>
    </div>
  </form>
  </div>
</div>
<!-- // Popup relasikan -->

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../../asset/js/sweetalert.min.js"></script>
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
