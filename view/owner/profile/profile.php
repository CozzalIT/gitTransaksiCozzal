<?php
  session_start();
  require("../../../class/penyewa.php");
  require("../../../config/database.php");

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
                  <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="unit.php" title="Go to Listing Unit" class="tip-bottom">Listing Unit</a> <a href="#" class="current">Kelola Unit</a> 
                </div>
              </div>
                <div class="row-fluid">
                  <div class="span12">
                    <div class="widget-box">
                      <div class="widget-content">
                        <div class="row-fluid" style="max-width:1200px">
                            <div class="span6" style="width:25%">
                              <img class="profile" src="../../../asset/img/profile.png">
                              <ul id="me">
                                <li id="info" class="active" onclick="changenav('info')"><a href="#" class="tip-bottom" >Info Personal</a></li>
                                <li id="other" class="non" onclick="changenav('other')"><a href="#" class="tip-bottom" >Lainnya</a></li>
                                <li id="user" class="non" onclick="changenav('user')"><a href="#" class="tip-bottom" >Ubah Username</a></li>
                                <li id="pass" class="non" onclick="changenav('pass')"><a href="#" class="tip-bottom" >Ubah Password</a></li>
                              </ul>
                            </div> 
                            <div class="span5" style="width:60%; margin-top:20px; padding-left:10%">
                              <form id="form_profile" action="" method="POST">
                                <div class="control-group">
                                  <label class="control-label">Nama Lengkap :</label>
                                  <div class="controls">
                                    <input name="nama" type="text" value="<?php echo 'euy'; ?>" disabled/>
                                  </div>
                                </div>  
                                <!-- button here --> 
                                <div class="control-group">
                                  <div class="controls">
                                    <button name="updateInfoUnitbyOwner" type="submit" class="btn btn-success">Ubah data</button>
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
