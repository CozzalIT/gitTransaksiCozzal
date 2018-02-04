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
  require("../../class/unit.php");
  require("../../config/database.php");
  $proses = new Unit($db);
    if (isset($_POST['upload_gambar'])){
    $img_baru = ''; $img = '';
    $kd_unit = $_POST['kd_unit'];
    $jumlah = count($_FILES['gambar']['name']);
    $tanggal = date('dmyHis');
    if ($jumlah > 0) {
      for ($i=0; $i < $jumlah; $i++) {
        if(!file_exists('../../asset/img/unit/'.$kd_unit)) mkdir('../../asset/img/unit/'.$kd_unit);
        $file_name = $_FILES['gambar']['name'][$i];
        $tmp_name = $_FILES['gambar']['tmp_name'][$i];
        $tmp2 = explode('.', $file_name);
        $file_name_new = $tanggal.$i.'.'.$tmp2[1];
        move_uploaded_file($tmp_name, "../../asset/img/unit/".$kd_unit.'/'.$file_name_new);
        if($img_baru==''){
          $img_baru = $file_name_new;
        } else {
          $img_baru = $img_baru.'+'.$file_name_new;
        }
      }
      if($_POST['img']=='None'){
        $img = $img_baru;
      }
      else{
        $img = $_POST['img'].'+'.$img_baru;
      }
      $add = $proses->updateGambar_unit($kd_unit, $img);
      if(!$add == "Success"){
        die('gagal upload gambar');
      }
    }
    }

  if(isset($_GET['detail_unit'])){
      $Proses = new Unit($db);
      $show2 = $Proses->showDetail_Unit($_GET['detail_unit']);
      $dapur =''; $water_heater = ''; $tv = ''; $wifi = '';$amenities = '';$merokok = '';  $img_t = 'Nothing';
      $flag = 0;        
      while($data = $show2->fetch(PDO::FETCH_OBJ)){
        $flag = 1;
        $dapur ='Tersedia';
        $water_heater = 'Tersedia';
        $tv = 'Tersedia';
        $wifi = 'Tersedia';
        $amenities = 'Tersedia';
        $merokok = 'Boleh';    
        $img_t = $data->img;    
        if($data->dapur=='N') $dapur = 'Tidak Tersedia';
        if($data->water_heater=='N') $water_heater = 'Tidak Tersedia';
        if($data->tv=='N') $tv = 'Tidak Tersedia';
        if($data->wifi=='N') $wifi = 'Tidak Tersedia';
        if($data->amenities=='N') $amenities = 'Tidak Tersedia';
        if($data->merokok=='N') $merokok = 'Tidak Boleh';
      }
      $show = $Proses->showUnitbyId($_GET['detail_unit']);
      while($data = $show->fetch(PDO::FETCH_OBJ)){
        echo '
            <!--main-container-part-->
            <div id="content">
              <div id="content-header">
                <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
                <form action="" onsubmit="return validasi_upload()" method="POST" enctype="multipart/form-data" style="padding-top: 20px;padding-left: 20px;">
                  <input type="text" name="kd_unit" value='.$data->kd_unit.' style="display:none">
                  <input type="text" id="kd_img" name="img" value='.$img_t.' style="display:none">
                  <input type="file" id="img" name="gambar[]" multiple>
                  <input class="btn btn-success" type="submit" name="upload_gambar" value="Upload Gambar">
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
                              <center>';
                                if($img_t=='None')
                                  echo '
                                <img class="mySlides" src="../../asset/img/none.png" style="width:100%; height:350px; padding-top:20px">
                              </center>
                                  <table class="">
                                    <tbody>
                                      <tr><td></td></tr>
                                      <tr>
                                        <td>
                                          <div class="" style="padding-top:10px">
                                          Gambar belum tersedia, silahan anda upload terlebih dahulu
                                          </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                  </table>
                            </div>
                                      ';
                                else {
                                $image = explode('+', $img_t);
                                $n = count($image); $j = 0 - 3;
                                $dir = $data->kd_unit;
                                foreach ($image as $nama_file_gambar) {
                                  echo '<img class="mySlides" src="../../asset/img/unit/'.$dir.'/'.$nama_file_gambar.'" style="width:100%; height:350px">';
                                }
                              echo'
                              </center>
                                  <table class="">
                                    <tbody>
                                      <tr><td></td></tr>';
                              while ($n>0) {
                                  $j = $j+3;
                                  $s = 3;
                                  if($n<3) $s=$n;
                                  echo'<tr>';
                                  for ($x=$j;$x<$j+$s;$x++)
                                  {
                                      $curdiv = $x+1;
                                      echo'
                                          <td>
                                            <div class="foto-unit">
                                              <img class="demo" src="../../asset/img/unit/'.$dir.'/'.$image[$x].'" style="width:100%" onclick="currentDiv('.$curdiv.')">
                                            </div>
                                          </td>';
                                      $n = $n - 1;
                                  }
                                  echo'</tr>';
                              }
                              echo '
                                    </tbody>
                                  </table>
                            </div> ';
                          }
                            echo '
                            <div class="span5">
                              <div class="control-group">
                                <div class="control">
                                  <center>
                                  <table class="detail-unit">
                                    <tbody>
                                      <tr>
                                      <td><h4>Detail Unit '.$data->no_unit.' ('.$data->nama_apt.')</h4></p></td>
                                      </tr>
                                      <tr style="border-bottom-width: 2px;border-bottom-style: solid;">
                                      <td><strong>Info Pemilik</strong></td>
                                      </tr>
                                      <td>Nama Pemilik</td>
                                      <td>: '.$data->nama.'</td>
                                      </tr>
                                      <tr>
                                        <td>
                                           <a class="btn btn-small" href="#">Edit Info Pemilik</a>
                                        </td>
                                      </tr>
                                      <tr style="border-bottom-width: 2px;border-bottom-style: solid;">
                                      <td><strong>Harga</strong></td>
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
                                      </tr>
                                      <tr style="border-bottom-width: 2px;border-bottom-style: solid;">
                                      <td><strong>Fasilitas</strong></td>
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
<script src="../../asset/js/slidegambar.js"></script>
<script src="../../asset/js/bootstrap.min.js"></script>
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
</html>
