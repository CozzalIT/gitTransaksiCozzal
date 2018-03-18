<?php
  $thisPage = "Unit";

  include "../template/head.php";
  include "../template/header.php";
  include "../template/sidebar.php";
  require("../../../class/unit.php");
  require("../../../../config/database.php");
  $Proses = new Unit($db);
  if(isset($_GET['detail_unit'])){
      $show2 = $Proses->showDetail_Unit($_GET['detail_unit']);
      $img_t = 'Nothing'; $flag = 0; $hreffasil = 'edit.php?tambah_detail_unit=';
      while($data = $show2->fetch(PDO::FETCH_OBJ)){
        $img_t = $data->img;
        $hreffasil = 'edit.php?edit_detail_unit=';
        if($data->isi=='Y'){
          $flag = 1;
          $dapur ='Tersedia';
          $water_heater = 'Tersedia';
          $tv = 'Tersedia';
          $wifi = 'Tersedia';
          $amenities = 'Tersedia';
          $merokok = 'Boleh';
          $lantai = $data->lantai;
          $jml_kmr = $data->jml_kmr;
          $jml_bed = $data->jml_bed;
          $jml_ac = $data->jml_ac;
          $type = $data->type;
          if($data->dapur=='N') $dapur = 'Tidak Tersedia';
          if($data->water_heater=='N') $water_heater = 'Tidak Tersedia';
          if($data->tv=='N') $tv = 'Tidak Tersedia';
          if($data->wifi=='N') $wifi = 'Tidak Tersedia';
          if($data->amenities=='N') $amenities = 'Tidak Tersedia';
          if($data->merokok=='N') $merokok = 'Tidak Boleh';
        }
      }
      $show = $Proses->showUnitbyId($_GET['detail_unit']);
      while($data = $show->fetch(PDO::FETCH_OBJ)){
        echo '
            <!--main-container-part-->
            <div id="content">
              <div id="content-header">
<div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="unit.php" title="Go to Data Unit" class="tip-bottom">Data Unit</a> <a href="#" class="current">Kelola Unit</a> </div>
                <form action="../../../proses/unit.php" onsubmit="return validasi_upload()" method="POST" enctype="multipart/form-data" style="padding-top: 20px;padding-left: 20px;">
                  <input type="text" id="kd_unit" name="kd_unit" value='.$data->kd_unit.' style="display:none">
                  <input type="text" id="kd_img" name="img" value='.$img_t.' style="display:none">
                  <input type="file" id="img" name="gambar[]" multiple>
                  <input class="btn btn-success" type="submit" name="upload_gambar" value="Upload Gambar">
                </form>
              </div>
              <div class="container-fluid">
                 <div class="row-fluid">
                  <div class="span12">
                    <div class="widget-box">
                      <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Detail Unit</h5>
                      </div>
                      <div class="widget-content">
                        <div class="w3-container">
                          <h2>Foto Unit</h2>
                        </div>
                        <div class="row-fluid" style="max-width:1200px">
                            <div class="span6">
                            ';
                                if(($img_t=='None') || ($img_t=='Nothing'))
                                  echo '
                              <center>
                                <img class="mySlides" src="../../../asset/img/none.png" style="width:100%; height:350px; padding-top:20px">
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
                                echo '
                                <a id="hapus_img" class="btn btn-danger" style="margin-bottom: 10px; margin-top: 5px;" href="../../../proses/unit.php?delete_gambar='.$image[0].'&kd_unit='.$dir.'">Hapus Gambar Terpilih</a>
                                <center>';
                                foreach ($image as $nama_file_gambar) {
                                  echo '<img class="mySlides" src="../../../asset/img/unit/'.$dir.'/'.$nama_file_gambar.'" style="width:100%; height:350px">';
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
                                              <img class="demo" src="../../../asset/img/unit/'.$dir.'/'.$image[$x].'" style="width:100%" onclick="currentDiv('.$curdiv.')">
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
                                      <td><h4>Detail Unit</h4></p></td>
                                      </tr>
                                      <tr style="border-bottom-width: 2px;border-bottom-style: solid;">
                                      <td><strong>Informasi Dasar</strong></td>
                                      </tr>
                                      <tr>
                                      <td>No Unit</td>
                                      <td>: '.$data->no_unit.'</td>
                                      </tr>
                                      <tr>
                                      <td>Apartemen</td>
                                      <td>: '.$data->nama_apt.'</td>
                                      </tr>
                                      <tr>
                                      <td>Alamat</td>
                                      <td>: '.$data->alamat_apt.'</td>
                                      </tr>
                                      <tr>
                                      <td>Owner</td>
                                      <td>: '.$data->nama.'</td>
                                      </tr>
                                      <tr>
                                        <td>
                                           <a class="btn btn-small" style="margin-bottom: 12px;" href="edit.php?edit_info_unit='.$data->kd_unit.'">Edit Informasi Dasar</a>
                                        </td>
                                      </tr>
                                      <tr style="border-bottom-width: 2px;border-bottom-style: solid;">
                                      <td><strong>Informasi Owner</strong></td>
                                      </tr>
                                      <tr>
                                      <td>Nama Lengkap</td>
                                      <td>: '.$data->nama.'</td>
                                      </tr>
                                      <tr>
                                      <td>Alamat</td>
                                      <td>: '.$data->alamat.'</td>
                                      </tr>
                                      <tr>
                                      <td>E-mail</td>
                                      <td>: '.$data->email.'</td>
                                      </tr>
                                      <tr>
                                      <td>No Telepon</td>
                                      <td>: '.$data->no_tlp.'</td>
                                      </tr>
                                      <tr>
                                        <td>
                                           <a class="btn btn-small" style="margin-bottom: 12px;" href="../owner/edit.php?edit_owner='.$data->kd_owner.'">Edit Data Owner</a>
                                        </td>
                                      </tr>
                                      <tr style="border-bottom-width: 2px;border-bottom-style: solid;">
                                      <td><strong>Harga</strong></td>
                                      </tr>
                                      <tr>
                                      <td>Owner WeekDay</td>
                                      <td>: '.number_format($data->h_owner_wd, 0, ".", ".").' IDR</td>
                                      </tr>
                                      <tr>
                                      <td>Owner WeekEnd</td>
                                      <td>: '.number_format($data->h_owner_we, 0, ".", ".").' IDR</td>
                                      </tr>
                                      <tr>
                                      <td>Sewa WeekDay</td>
                                      <td>: '.number_format($data->h_sewa_wd, 0, ".", ".").' IDR</td>
                                      </tr>
                                      <tr>
                                      <td>Sewa WeekEnd</td>
                                      <td>: '.number_format($data->h_sewa_we, 0, ".", ".").' IDR</td>
                                      </tr>
                                      <tr>
                                      <td>Ekstra Charge</td>
                                      <td>: '.number_format($data->ekstra_charge, 0, ".", ".").' IDR</td>
                                      </tr>
                                      <tr>
                                        <td>
                                           <a class="btn btn-small" style="margin-bottom: 12px;" href="edit.php?edit_harga_owner='.$data->kd_unit.'">Edit Harga</a>
                                        </td>
                                      </tr>
                                      <tr style="border-bottom-width: 2px;border-bottom-style: solid;">
                                        <td><strong>Fasilitas</strong></td>
                                      </tr>
                                      ';

                                      if($flag==1){
                                          echo'
                                          <tr>
                                          <td>Type Unit</td>
                                          <td>: '.$type.'</td>
                                          </tr>
                                          <tr>
                                          <td>Posisi Lantai</td>
                                          <td>: '.$lantai.'</td>
                                          </tr>
                                          <tr>
                                          <td>Jumlah Kamar</td>
                                          <td>: '.$jml_kmr.'</td>
                                          </tr>
                                          <tr>
                                          <td>Jumlah Kasur</td>
                                          <td>: '.$jml_bed.'</td>
                                          </tr>
                                          <tr>
                                          <td>Jumlah AC</td>
                                          <td>: '.$jml_ac.'</td>
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
                                          <tr>
                                            <td>
                                               <a class="btn btn-small" style="margin-bottom: 12px;" href="'.$hreffasil.$data->kd_unit.'">Edit Info Fasilitas</a>
                                            </td>
                                          </tr>
                                          ';
                                      }else{
                                        echo'
                                          <tr>
                                          <td> Info fasilitas belum diisi</td>
                                          </tr>
                                          <tr>
                                            <td>
                                               <a class="btn btn-small" style="margin-bottom: 12px;" href="'.$hreffasil.$data->kd_unit.'">Tambah Detail Fasilitas</a>
                                            </td>
                                          </tr>
                                        ';
                                      }
                                      echo'
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
<script src="../../../asset/js/slidegambar.js"></script>
<!--
<script src="../../asset/js/bootstrap.min.js"></script>
<script src="../../asset/js/jquery.gritter.min.js"></script>
<script src="../../asset/js/jquery.peity.min.js"></script>
<script src="../../asset/js/matrix.interface.js"></script>
<script src="../../asset/js/matrix.popover.js"></script>
<script src="../../asset/js/jquery.ui.custom.js"></script> -->
<!--<script src="js/jquery.uniform.js"></script> -->
<!--
<script src="../../asset/js/select2.min.js"></script>
<script src="../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../asset/js/matrix.js"></script>
<script src="../../asset/js/matrix.tables.js"></script>
-->
</body>
</html>
