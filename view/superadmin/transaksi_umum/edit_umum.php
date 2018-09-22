<?php
  require("../../../../config/database.php");
  require("../../../class/unit.php");
  require("../../../class/apartemen.php");
  require("../../../class/booking.php");
  require("../../../class/kas.php");
  require("../../../class/owner.php");
  require("../../../class/transaksi_umum.php");

$thisPage = "Edit";

include "../template/head.php";

?>
<body>
  <?php

    include "../template/header.php";
    include "../template/sidebar.php";

  ?>
  <div id="content">
    <div id="content-header">
    <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="laporan_transaksi_umum.php" title="Go to Laporan Transaksi Umum" class="tip-bottom">Laporan Transaksi Umum</a> <a href="#" class="current">Edit</a> </div>
    </div>
    <div class="container-fluid">
      <div class="row-fluid">

        <?php
    //Edit Transaksi
          if (isset($_GET['edit_transaksi_umum']))
          {
            $Proses = new TransaksiUmum($db);
            $show = $Proses->editTransaksiUmum($_GET['edit_transaksi_umum']);
            $edit = $show->fetch(PDO::FETCH_OBJ);
            echo '
              <div class="span3">
              </div>
              <div class="span6">
                <div class="widget-box">
                  <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Edit Transaksi Umum</h5>
                  </div>
                  <div class="widget-content nopadding">
                    <form action="../../../proses/transaksi_umum.php" method="post" onsubmit="berubah()" class="form-horizontal">
                      <div class="control-group">
                        <input name="kd_kas" class="hide" type="text" value="'.$edit->kd_kas.'"/>
                        <input name="kd_transaksi_umum" class="hide" type="text" value="'.$edit->kd_transaksi_umum.'"/>
                        <input name="tanggal_transaksi" class="hide" type="text" value="'.$edit->tanggal.'"/>
                        <label class="control-label">Sumber Dana :</label>
                        <div class="controls">
                        <select name="kas" required>
                          <option>-- Pilih Sumber Dana --</option>';
                            $Proses = new Kas($db);
                            $show = $Proses->showKas();
                            while($data = $show->fetch(PDO::FETCH_OBJ)){
                              if ($edit->kd_kas!=$data->kd_kas){
                                echo "<option name='kd_kas' value='$data->kd_kas'>$data->sumber_dana</option>";
                              }else{
                                echo "<option name='kd_kas' value='$data->kd_kas' selected='true'>$data->sumber_dana</option>";
                              }
                            }
                            echo '
                        </select>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Kebutuhan :</label>
                        <div class="controls">
                          <select id="kebutuhan" name="kebutuhan" required onChange="ganti_kebut()">
                            <option>-- Pilih Kebutuhan --</option>';
                            if($edit->kebutuhan=="umum"){
                              echo '<option name="kebutuhan" value="0" selected>Umum</option>';
                              echo '<option name="kebutuhan" value="1">Unit</option>';
                              $kd_unit = 0;
                            } else {
                              $arr_kebutuhan = explode("/",$edit->kebutuhan);
                              $kd_unit = $arr_kebutuhan[1];
                              echo '<option value="0">umum</option>';
                              echo '<option value="1" selected>unit</option>';
                            }
                              echo '
                          </select>
                        </div>
                      </div>
                      <div class="control-group" id="kd_unit-C">
                        <label class="control-label">Unit :</label>
                      <div class="controls">
                      <select name="unit" id="unit">
                        <option>-- Pilih Unit --</option>';
                        $Proses = new Unit($db);
                        $show = $Proses->showUnit();
                        while($data = $show->fetch(PDO::FETCH_OBJ)){
                          if ($data->kd_unit!=$kd_unit){
                            echo "<option name='unit' value='$data->kd_unit'>$data->no_unit - $data->nama_apt</option>";
                          }else{
                            echo "<option name='unit' value='$data->kd_unit' selected='true'>$data->no_unit - $data->nama_apt.</option>";
                          }
                        }
                        echo '
                      </select>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Harga :</label>
                        <div class="controls">
                        <input onchange="hasil()" name="harga" id="harga" type="text" class="span11" required placeholder="" value="'.$edit->harga.'" onchange="keepvalid2(this.form)"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Jumlah :</label>
                        <div class="controls">
                        <input onChange="hasil()" name="jumlah" id="jumlah" type="number" class="span11" min="1" value="'.$edit->jumlah.'"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Total :</label>
                        <input name="total_umum_lama" class="hide" type="text" value="'.$edit->harga*$edit->jumlah.'"/>
                        <div class="controls">
                        <input name="total_umum_baru" id="total_umum_baru" type="text" class="span11" required placeholder="" value="'.$edit->harga*$edit->jumlah.'" disabled/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Keterangan :</label>
                        <div class="controls">
                          <input name="keterangan" type="text" class="span11" placeholder="Keterangan" value="'.$edit->keterangan.'"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <div class="controls">
                          <div class="form-actions" style="text-align:right">
                    			   <button name="updateTransaksiUmum" type="submit" class="btn btn-success">Update</button>
                    		  </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
        	</div>
      </div>
    </div>
            ';
          }
    ?>

    <!--Footer-part-->
    <div class="row-fluid">
      <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://transaksi.cozzal.com">Cozzal IT</a> </div>
    </div>
    <!--end-Footer-part-->
    <script src="../../../asset/js/jquery.min.js"></script>
    <script src="../../../asset/js/jquery.ui.custom.js"></script>
    <script src="../../../asset/js/bootstrap.min.js"></script>
    <script src="../../../asset/js/jquery.uniform.js"></script>
    <script src="../../../asset/js/transaksi.js"></script>
    <!--<script src="js/select2.min.js"></script>-->
    <script src="../../../asset/js/jquery.dataTables.min.js"></script>
    <script src="../../../asset/js/matrix.js"></script>
    <script src="../../../asset/js/matrix.tables.js"></script>
    <script type="text/javascript">
    var kd_unit = <?php echo $kd_unit.";"; ?>
    ganti_kebut();
      function ganti_kebut(){
        if(document.getElementById('kebutuhan').value == 0){
          $("#kd_unit-C").hide();
        } else {
          $("#kd_unit-C").show();
        }
      }

      function hasil(){
        var jumlah = document.getElementById('jumlah').value;
        var harga = document.getElementById('harga').value;
        document.getElementById('total_umum_baru').value = jumlah * harga;
      }

      function berubah(){
        $("#total_umum_baru").removeAttr('disabled');
      }
    </script>
    </body>
    </html>
