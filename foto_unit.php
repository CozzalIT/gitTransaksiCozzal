<?php
  session_start();

  if(!isset($_SESSION['username'])) {
    header('location:login.php');
  }else {
    $username = $_SESSION['username'];
  }

  $thisPage = "Unit";

  include "template/head.php";
?>
<body>
<?php
  include "template/header.php";
  include "template/sidebar.php";
?>
<style>
.mySlides {display:none}
.demo {cursor:pointer}
</style>
<body>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <form action="" method="POST" enctype="multipart/form-data" style="padding-top: 20px;padding-left: 20px;">
      <input type="file" name="gambar[]" multiple>
      <input class="btn btn-success" type="submit" name="upload" value="Upload">
    </form>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Detail Unit</h5>
          </div>
          <div class="widget-content">
            <div class="w3-container">
              <h2>Foto Unit (No. Unit)</h2>
            </div>
            <div class="row-fluid" style="max-width:1200px">
                <div class="span6">
                  <center>
                    <img class="mySlides" src="img/unit/01.jpg" style="width:100%">
                    <img class="mySlides" src="img/unit/02.jpg" style="width:100%">
                    <img class="mySlides" src="img/unit/03.jpg" style="width:100%">
                    <img class="mySlides" src="img/unit/04.jpg" style="width:100%">
                    <img class="mySlides" src="img/unit/05.jpg" style="width:100%">
                  </center>
                </div>
                <div class="span1">
                  <div class="foto-unit">
                    <img class="demo w3-opacity w3-hover-opacity-off" src="img/unit/01.jpg" style="width:100%" onclick="currentDiv(1)">
                  </div>
                  <div class="foto-unit">
                    <img class="demo w3-opacity w3-hover-opacity-off" src="img/unit/02.jpg" style="width:100%" onclick="currentDiv(2)">
                  </div>
                  <div class="foto-unit">
                    <img class="demo w3-opacity w3-hover-opacity-off" src="img/unit/03.jpg" style="width:100%" onclick="currentDiv(3)">
                  </div>
                  <div class="foto-unit">
                    <img class="demo w3-opacity w3-hover-opacity-off" src="img/unit/04.jpg" style="width:100%" onclick="currentDiv(4)">
                  </div>
                  <div class="foto-unit">
                    <img class="demo w3-opacity w3-hover-opacity-off" src="img/unit/05.jpg" style="width:100%" onclick="currentDiv(5)">
                  </div>
                </div>
                <div class="span5">
                  <center>
                    <h3>Detail Unit Coming Soon!!</h3>
                  </center>
                </div>
            </div>
            <script>
              var slideIndex = 1;
              showDivs(slideIndex);

              function plusDivs(n) {
                showDivs(slideIndex += n);
              }

              function currentDiv(n) {
                showDivs(slideIndex = n);
              }

              function showDivs(n) {
                var i;
                var x = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("demo");
                if (n > x.length) {
                  slideIndex = 1
                }
                if (n < 1) {
                  slideIndex = x.length
                }
                for (i = 0; i < x.length; i++) {
                   x[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                   dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
                }
                x[slideIndex-1].style.display = "block";
                dots[slideIndex-1].className += " w3-opacity-off";
              }
            </script>
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
<!--End-Footer-part-->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.gritter.min.js"></script>
<script src="js/jquery.peity.min.js"></script>
<script src="js/matrix.interface.js"></script>
<script src="js/matrix.popover.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<!--<script src="js/jquery.uniform.js"></script> -->
<script src="js/select2.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/matrix.js"></script>
<script src="js/matrix.tables.js"></script>

<?php
  include 'template/modal.php';
?>
</body>
</html>
