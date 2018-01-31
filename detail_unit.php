<?php
  session_start();

  if(!isset($_SESSION['username'])) {
    header('location:login.php');
  }else {
    $username = $_SESSION['username'];
  }

  $thisPage = "Unit";

  include "template/head.php";
  include "template/header.php";
  include "template/sidebar.php";
  if(isset($_GET['detail_unit'])){
      require('proses/proses.php');
      $Proses = new Proses();
      $show = $Proses->showUnitbyId($_GET['detail_unit']);
      while($data = $show->fetch(PDO::FETCH_OBJ)){
        $dapur ='Tersedia';
        $water_heater = 'Tersedia';
        $tv = 'Tersedia';
        $wifi = 'Tersedia';
        $amenities = 'Tersedia';
        $merokok = 'Boleh';
        if($data->dapur=='N') $dapur = 'Tidak Tersedia';
        if($data->water_heater=='N') $water_heater = 'Tidak Tersedia';
        if($data->tv=='N') $tv = 'Tidak Tersedia';
        if($data->wifi=='N') $wifi = 'Tidak Tersedia';
        if($data->amenities=='N') $amenities = 'Tidak Tersedia';
        if($data->merokok=='N') $merokok = 'Tidak Boleh';
        echo '        
            <!--main-container-part-->
            <div id="content">
              <div id="content-header">
                <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
                <form action="" method="POST" enctype="multipart/form-data" style="padding-top: 20px;padding-left: 20px;">
                  <input type="file" name="gambar[]" multiple>
                  <input class="btn btn-success" type="submit" name="upload" value="Upload Gambar">
                </form>
              </div>
              <div class="container-fluid">
                <hr>
                <a class="btn btn-primary" href="edit.php?edit_detail_unit='.$_GET["detail_unit"].'">Ubah Fasilitas</a>
                <div class="row-fluid">
                  <div class="span12">
                    <div class="widget-box">
                      <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Detail Unit</h5>
                      </div>
                      <div class="widget-content">
                        <div class="w3-container">
                          <h2>Foto Unit '.$data->no_unit.' ('.$data->nama_apt.')</h2>
                        </div>
                        <div class="row-fluid" style="max-width:1200px">
                            <div class="span6">
                              <center>
                                <img class="mySlides" src="img/unit/01.jpg" style="width:100%; height:350px">
                                <img class="mySlides" src="img/unit/02.jpg" style="width:100%; height:350px">
                                <img class="mySlides" src="img/unit/03.jpg" style="width:100%; height:350px">
                                <img class="mySlides" src="img/unit/04.jpg" style="width:100%; height:350px">
                                <img class="mySlides" src="img/unit/05.jpg" style="width:100%; height:350px">
                              </center>
                                  <table class="">
                                    <tbody>
                                      <tr><td></td></tr>
                                      <tr>
                                        <td>
                                          <div class="foto-unit">
                                            <img class="demo" src="img/unit/01.jpg" style="width:100%" onclick="currentDiv(1)">
                                          </div>
                                        </td>
                                        <td>
                                          <div class="foto-unit">
                                            <img class="demo" src="img/unit/02.jpg" style="width:100%" onclick="currentDiv(2)">
                                          </div>
                                        </td>
                                        <td>
                                          <div class="foto-unit">
                                            <img class="demo" src="img/unit/03.jpg" style="width:100%" onclick="currentDiv(3)">
                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>
                                          <div class="foto-unit">
                                            <img class="demo" src="img/unit/04.jpg" style="width:100%" onclick="currentDiv(4)">
                                          </div>
                                        </td>
                                        <td>
                                          <div class="foto-unit">
                                            <img class="demo" src="img/unit/05.jpg" style="width:100%" onclick="currentDiv(5)">
                                          </div>
                                        </td>  
                                    </tr>
                                    </tbody>
                                  </table>
                            </div>
                            <div class="span5">
                              <div class="control-group">
                                <div class="control">
                                  <center>
                                  <table class="detail-unit">
                                    <tbody>
                                      <tr>
                                      <td><h4>Detail Unit '.$data->no_unit.' ('.$data->nama_apt.')</h4></p></td>
                                      </tr>
                                      <td>Nama Pemilik</td>
                                      <td>: '.$data->nama.'</td>
                                      </tr>
                                      <tr>
                                      <td>Harga Sewa WeekDay</td>
                                      <td>: '.number_format($data->h_sewa_wd, 0, ".", ".").' IDR</td>
                                      </tr>
                                      <tr>
                                      <td>Harga Sewa WeekEnd</td>
                                      <td>: '.number_format($data->h_sewa_we, 0, ".", ".").' IDR</td>
                                      </tr>
                                      <tr>
                                      <td>Harga Owner WeekDay</td>
                                      <td>: '.number_format($data->h_owner_wd, 0, ".", ".").' IDR</td>
                                      </tr>
                                      <tr>
                                      <td>Harga Owner WeekEnd</td>
                                      <td>: '.number_format($data->h_owner_we, 0, ".", ".").' IDR</td>
                                      </tr>
                                      <tr>
                                      <td>Harga Ekstra Charge</td>
                                      <td>: '.number_format($data->ekstra_charge, 0, ".", ".").' IDR</td>
                                      </tr>
                                      <tr>
                                      <td>Type Unit</td>
                                      <td>: '.$data->type.'</td>
                                      </tr>
                                      <tr>
                                      <td>Posisi Lantai</td>
                                      <td>: '.$data->lantai.'</td>
                                      </tr>
                                      <tr>
                                      <td>Jumlah Kamar</td>
                                      <td>: '.$data->jml_kmr.'</td>
                                      </tr>
                                      <tr>
                                      <td>Jumlah Kasur</td>
                                      <td>: '.$data->jml_bed.'</td>
                                      </tr>
                                      <tr>
                                      <td>Jumlah AC</td>
                                      <td>: '.$data->jml_ac.'</td>
                                      </tr>
                                      <tr>
                                      <td>Ruang Dapur</td>
                                      <td>: '.$dapur.'</td>
                                      </tr>
                                      <tr>
                                      <td>Water Heater</td>
                                      <td>: '.$water_heater.'</td>
                                      </tr>
                                      <tr>
                                      <td>Tv Cable</td>
                                      <td>: '.$tv.'</td>
                                      </tr>
                                      <tr>
                                      <td>Wifi</td>
                                      <td>: '.$wifi.'</td>
                                      </tr>
                                      <tr>
                                      <td>Amenities</td>
                                      <td>: '.$amenities.'</td>
                                      </tr>
                                      <tr>
                                      <td>Merokok</td>
                                      <td>: '.$merokok.'</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </center>
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>';          
  }
}
?>
<!--end-main-container-part-->

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--End-Footer-part-->
<script src="js/slidegambar.js"></script>
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

</body>
</html>
