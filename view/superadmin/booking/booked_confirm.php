<?php
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
  <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="laporan_transaksi.php" title="Go to Laporan Transaksi" class="tip-bottom">Laporan Transaksi</a> <a href="#" class="current">Edit</a> </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
	  <?php
//Edit Transaksi
      if (isset($_GET['kd_reservasi']))
      {
        require("../../../class/penyewa.php");
        require("../../../../config/database.php");
        require("../../../class/unit.php");
        require("../../../class/apartemen.php");
        require("../../../class/booking.php");
        require("../../../class/dp_via.php");
        $Proses = new Booking($db);
        $show = $Proses->showRequestBook_byId($_GET['kd_reservasi']);
        $edit = $show->fetch(PDO::FETCH_OBJ);
        $t1 = new DateTime($edit->check_in);
        $t2 = new DateTime($edit->check_out);
        $t3 = $t1->diff($t2);
        $jumlah_hari = $t3->days;
      }
?>

         <div class="span3">
          </div>
          <div class="span6">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Data Penyewa</h5>
              </div>
              <div class="widget-content nopadding">
                <form action="../../../proses/transaksi.php" method="post" class="form-horizontal">
                  <div class="control-group">
                    <input name="kd_reservasi" class="hide" type="text" value="<?php echo $edit->kd_reservasi; ?>"/>
                    <label class="control-label">Nama Lengkap:</label>
                  <div class="controls">
                    <input name="nama" type="text" class="span11" value="<?php echo $edit->nama; ?>" required/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Jenis Kelamin :</label>
                    <div class="controls">
                      <select name="jenis_kelamin">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Alamat :</label>
                    <div class="controls">
                    <input name="alamat" type="text" class="span11" placeholder="Alamat" required/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">No Telepon / HP</label>
                    <div class="controls">
                    <input name="no_tlp" type="text" class="span11" value="<?php echo $edit->no_tlp; ?>" required/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">E-Mail</label>
                    <div class="controls">
                    <input name="email" type="text" class="span11" placeholder="Email" required/>
                    </div>
                  </div>

                  <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Data Transaksi</h5>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Check In :</label>
                    <div class="controls">
                    <input name="check_in" id="check_in" type="date" class="span11" required placeholder="" value="<?php echo $edit->check_in; ?>" onchange="keepvalid(this.form)"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Check Out :</label>
                    <div class="controls">
                    <input name="check_out" id="check_out" type="date" class="span11" required placeholder="" value="<?php echo $edit->check_out; ?>" onchange="keepvalid2(this.form)"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Apartemen :</label>
                    <div class="controls" id="form_apt" name="form_apt">
                      <select id="apartemen" name="apartemen" required>
                        <option>-- Pilih Apartemen --</option>
<?php
                         $Proses = new Apartemen($db);
                          $show = $Proses->showApartemen();
                          while($data = $show->fetch(PDO::FETCH_OBJ)){
                            if ($data->kd_apt != 0){
                              if ($edit->kd_apt==$data->kd_apt){
                                echo "<option name='kd_apt' value='$data->kd_apt' selected='true'>$data->nama_apt</option>"; 
                              }
                            }
                          }
?>
                      </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Unit :</label>
                    <div class="controls">
                      <select name="unit" id="unit" onchange="biaya(this.form)" required >
                        <option>-- Pilih Unit --</option>
<?php
                          $harga_asal = 0;
                          $Proses = new Unit($db);
                          $show = $Proses->showUnitByApt($edit->kd_apt);
                          while($data = $show->fetch(PDO::FETCH_OBJ)){
                            if ($data->kd_unit!=0){
                              $val=$data->kd_unit.'+'.$data->h_sewa_wd.'+'.$data->h_sewa_we.'+'.$data->ekstra_charge;
                              if ($edit->kd_unit!=$data->kd_unit){
                                echo "<option name='kd_unit' value='$val'>$data->no_unit</option>";
                              }else{
                                echo "<option name='kd_unit' value='$val' selected='true'>$data->no_unit</option>";
                                $hari_ke = Date('w',strtotime($edit->check_in))+1;
                                if($hari_ke>5) $harga_asal = $data->h_sewa_we; else $harga_asal = $data->h_sewa_wd;
                              }
                            }
                          }
                          $harga_total = $jumlah_hari*$harga_asal;

?>
                     </select>
                      <div id="loading">
                        <img src="../../../asset/images/loading.gif" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Harga Sewa :</label>
                    <div class="controls">
                    <input name="harga_sewa_asli" type="number" style="display:none;" value="<?php echo $harga_asal; ?>"/>
                    <input name="harga_sewa" min="0" step="1000" required id="harga_sewa" type="number" class="span11" placeholder="Harga Sewa" value="<?php echo $harga_asal; ?>" onChange="hasil(this.form)"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Tamu :</label>
                    <div class="controls">
                    <input name="tamu" onChange="ECH(this.form)" type="number" placeholder="Jumlah Tamu" required min="0" class="span11"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Ekstra Charge :</label>
                    <div class="controls">
                    <input name="ekstra_charge" min="0" step="1000" placeholder="Ekstra Charge" type="number" onChange="hasil(this.form)" required class="span11"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Total Biaya :</label>
                    <div class="controls">
                    <input name="total" min="0" step="1000" class="span11" type="number" required value="<?php echo $harga_total; ?>"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Booking Via :</label>
                    <div class="controls">
                      <select name="booking_via" required>
                        <option>-- Pilih Booking Via --</option>
<?php
                          $Proses = new Booking($db);
                          $show = $Proses->showBooking_via();
                          while($data = $show->fetch(PDO::FETCH_OBJ)){
                              echo "<option name='kd_booking' value='$data->kd_booking'>$data->booking_via</option>";
                          }
?>
                      </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">DP Via :</label>
                    <div class="controls">
                    <select name="dp_via" required>
                      <option>-- Pilih DP Via --</option>
<?php
                        $Proses = new dpVia($db);
                        $show = $Proses->showDp_via();
                        while($data = $show->fetch(PDO::FETCH_OBJ)){
                            echo "<option name='kd_bank' value='$data->kd_bank'>$data->nama_bank</option>";
                        }
?>
                    </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">DP :</label>
                    <div class="controls">
                    <input name="dp" type="number" class="span11" placeholder="Nominal DP" value="'.$edit->dp.'" required/>
                    </div>
                  </div>
                  <div class="control-group">
                    <div class="controls">
                      <div class="form-actions" style="text-align:right">
                         <button name="moveTransaksi" type="submit" class="btn btn-success">Transaksi</button>
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
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
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
</body>
</html>
