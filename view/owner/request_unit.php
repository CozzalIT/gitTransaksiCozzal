<?php
  
  require("../../class/unit.php");
  require("../../class/owner.php");
  require("../../class/apartemen.php");
  require("../../config/database.php");

  $thisPage = "Request Unit";

  include "template/head.php";
?>
<body>
<?php
  include "template/header.php";
  include "template/sidebar.php";
?>
<!--main-container-part-->
<div id="content">
<h1> Under Construct </h1>
</div>
<!--end-main-container-part-->

<!--modal popup tambah unit-->

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--End-Footer-part-->
<script src="../../asset/js/bootstrap.min.js"></script>
<script src="../../asset/js/unit.js"></script>
<script src="../../asset/js/jquery.gritter.min.js"></script>
<script src="../../asset/js/jquery.peity.min.js"></script>
<script src="../../asset/js/matrix.interface.js"></script>
<script src="../../asset/js/matrix.popover.js"></script>
<script src="../../asset/js/jquery.ui.custom.js"></script>
<!--<script src="js/jquery.uniform.js"></script> -->
<script src="../../asset/js/select2.min.js"></script>
<script src="../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../asset/js/matrix.js"></script>
<script src="../../asset/js/matrix.tables.js"></script>
</body>
<?php
  include 'template/modal.php';
?>
</html>
