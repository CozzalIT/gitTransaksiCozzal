<?php
  require("../../../class/owner.php");
  require("../../../class/dp_via.php");
  require("../../../../config/database.php");

  $thisPage = "Dashboard";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
          <!--main-container-part-->
            <div id="content">
              <div id="content-header">
                <div id="breadcrumb"> 
                  <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">My Profile</a> 
                </div>
              </div>
                <div class="row-fluid">
                  <div class="span12">
                    <div class="widget-box">
                      <div class="widget-content">
                        <div class="row-fluid" style="max-width:1200px">
                            <div class="headprof">
                              <img class="profile" src="../../../asset/img/profile.png">
                              <ul id="me">
                                <li id="info" class="active a" onclick="changenav('info')"><a href="#" class="tip-bottom" >Informasi Akun</a></li>
                                <li id="user" class="non a" onclick="changenav('user')"><a href="#" class="tip-bottom" >Ubah Username</a></li>
                                <li id="pass" class="non a" onclick="changenav('pass')"><a href="#" class="tip-bottom" >Ubah Password</a></li>
                              </ul>
                            </div> 
<?php
$jenis_error = 'none';
if(file_exists('../../../proses/gagalpass1')) {
  $jenis_error = 'gagalpass1'; rmdir('../../../proses/gagalpass1');
  $pesan = 'Password yang anda masukkan tidak cocok'; $warna = "alert-danger";
}
elseif(file_exists('../../../proses/gagalpass2')) {
  $jenis_error = 'gagalpass2'; rmdir('../../../proses/gagalpass2');
  $pesan = 'Password lama tidak cocok'; $warna = "alert-danger";
}
elseif(file_exists('../../../proses/gagaluser')) {
  $jenis_error = 'gagaluser'; rmdir('../../../proses/gagaluser');
  $pesan = 'Username yang anda minta sudah tersedia'; $warna = "alert-danger";
}
elseif(file_exists('../../../proses/succesuser')) {
  $jenis_error = 'succesuser'; rmdir('../../../proses/succesuser');
  $pesan = 'Username berhasil diganti'; $warna = "alert-success";
}
elseif(file_exists('../../../proses/succespass')) {
  $jenis_error = 'succespass'; rmdir('../../../proses/succespass');
  $pesan = 'Password berhasil diganti'; $warna = "alert-success";
}
?>
                            <div class="span5" style="margin-top:20px; padding-left:10%">
                        <div id='<?php echo $jenis_error; ?>' class="error_alert">
<?php
if ($jenis_error!='none')
  echo'
                        <div class="alert '.$warna.'" role="alert">
                          <strong>'.$pesan.'</strong>
                        </div>
      ';
?>
                        </div>
                              <form id="form_info" action="../../../proses/account.php" method="POST" onsubmit="return validasi1()">
                                <div class="control-group">
                                  <label class="control-label">Username :</label>
                                  <div class="controls">
                                    <input class="form1" name="nama" id="nama" type="text" value="<?php echo $_SESSION['username']; ?>" disabled/>
                                  </div>
                                </div>  
                                <div class="control-group">
                                  <label class="control-label">Hak Akses</label>
                                  <div class="controls">
                                    <input class="form1" name="alamat"  id="alamat" type="text" value="Admin" disabled/>
                                  </div>
                                </div>  
                                <div class="control-group">
                                  <label class="control-label">Status :</label>
                                  <div class="controls">
                                    <input class="form1" name="no_tlp"  id="no_tlp" type="text" value="Aktif" disabled/>
                                  </div>
                                </div>     
                              </form>

                              <form id="form_user" action="../../../proses/account.php" onsubmit="return validasi3()" method="POST">
                                <div class="control-group">
                                  <label class="control-label">Username aktif :</label>
                                  <div class="controls">
                                    <input name="username" type="text" value="<?php echo $username ?>" disabled/>
                                  </div>
                                </div>  
                                <div class="control-group">
                                  <label class="control-label">Request Username baru :</label>
                                  <div class="controls">
                                    <input class="remote" id="user_new" name="user_new" type="text" value="" required/>
                                  </div>
                                </div>  
                                <div class="control-group">
                                  <label class="control-label">Konfirmasi Password :</label>
                                  <div class="controls">
                                    <input class="remote" name="konfr_pass1" type="password" value="" required/>
                                  </div>
                                </div>  
                                <!-- button here --> 
                                <div class="control-group">
                                  <div class="controls">
                                    <button name="updateuser" type="submit" class="btn btn-success">Update</button>
                                    <button onclick="has_change=false; $('#info').click();" type="reset" class="btn btn-warning">Batal</button>
                                  </div>
                                </div>     
                              </form>

                              <form id="form_pass" action="../../../proses/account.php" method="POST" onsubmit="return validasi4()">
                                <div class="control-group">
                                  <label class="control-label">Password Lama</label>
                                  <div class="controls">
                                    <input class="remote" name="old_pass" type="password" required/>
                                  </div>
                                </div>  
                                <div class="control-group">
                                  <label class="control-label">Password Baru</label>
                                  <div class="controls">
                                    <input class="remote" id="new_pass" name="new_pass" type="password" required/>
                                  </div>
                                </div>  
                                <div class="control-group">
                                  <label class="control-label">Konfirmasi Password Baru</label>
                                  <div class="controls">
                                    <input class="remote" id="konfr_pass2" name="konfr_pass2" type="password" required/>
                                  </div>
                                </div>  
                                <!-- button here --> 
                                <div class="control-group">
                                  <div class="controls">
                                    <button name="updatepass" type="submit" class="btn btn-success">Update</button>
                                    <button type="reset" onclick="has_change=false; $('#info').click();" class="btn btn-warning">Batal</button>
                                  </div>
                                </div>     
                              </form>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
<!--end-main-container-part-->

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../../asset/js/jquery.min.js"></script>
<script src="../../../asset/js/jquery.ui.custom.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/jquery.uniform.js"></script>
<script src="../../../asset/js/select2.min.js"></script>
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/profil.js"></script>
</body>
</html>
