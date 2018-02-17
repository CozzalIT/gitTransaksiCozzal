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
                                <li class="active" onclick="alert(this.className)"><a href="#personal" class="tip-bottom" >Info Personal</a></li>
                                <li class="non"><a href="#other" class="tip-bottom" >Lainnya</a></li>
                                <li class="non"><a href="#username" class="tip-bottom" >Ubah Username</a></li>
                                <li class="non"><a href="#password" class="tip-bottom" >Ubah Password</a></li>
                              </ul>
                            </div> 
                            <div class="span5" style="width:60%; margin-top:20px; padding-left:10%">
                              <div class="control-group">
                                <label class="control-label">Check Out :</label>
                                <div class="controls">
                                  <input name="check_out" id="check_out" type="date" onchange="validasi2(this.form)"/>
                                </div>
                              </div>   
                             <div class="control-group">
                                <label class="control-label">Check Out :</label>
                                <div class="controls">
                                  <input name="check_out" id="check_out" type="date" onchange="validasi2(this.form)"/>
                                </div>
                              </div>        
                              <div class="control-group">
                                <label class="control-label">Check Out :</label>
                                <div class="controls">
                                  <input name="check_out" id="check_out" type="date" onchange="validasi2(this.form)"/>
                                </div>
                              </div>   
                             <div class="control-group">
                                <label class="control-label">Check Out :</label>
                                <div class="controls">
                                  <input name="check_out" id="check_out" type="date" onchange="validasi2(this.form)"/>
                                </div>
                              </div>                   
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
<script src="../../../asset/js/matrix.tables.js"></script>
</body>
</html>
