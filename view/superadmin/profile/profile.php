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
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Data Penyewa</a></div>
    <h1>Profile </h1>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="control-group">
            <div class="controls span2">
              <img class="profile" src="../../../asset/img/profile.png">
            </div>
            <div class="controls span10 profile-detail">
              <table>
                <tr>
                  <td class="span5">Nama</td>
                  <td><input type="text"/></td>
                </tr>
                <tr>
                  <td class="span5">Alamat</td>
                  <td><input type="text"/></td>
                </tr>
                <tr>
                  <td class="span5">No Telpon</td>
                  <td><input type="text"/></td>
                </tr>
                <tr>
                  <td class="span5">Email</td>
                  <td><input type="text"/></td>
                </tr>
              </table>
          </div>
          <div class="controls span10 profile-detail">
            <table>
              <tr>
                <td class="span5">Username</td>
                <td><input type="text"/></td>
              </tr>
              <tr>
                <td class="span5">Password</td>
                <td><input type="password"/></td>
              </tr>
              <tr>
                <td class="span5"></td>
                <td><a class="btn btn-success">Update</a></td>
              </tr>
            </table>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<br>
<br>
<br>

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
