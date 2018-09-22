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
  <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="booked.php" title="Go to Booked" class="tip-bottom">Booked List</a> <a href="booked_penyewa.php" title="Back to Pendaftara Penyewa" class="tip-bottom">Pendaftaran Penyewa</a> <a href="#" class="current">Data Transaksi</a> </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
    <?php
// Audit transaksi
      if (isset($_POST['next-booked']))
      {
        require("../../../../config/database.php");
        require("../../../class/booked.php");
        require("../../../class/dp_via.php");
        $Proses = new Booked($db);
        $kd_booked = $_POST['kd_booked'];
        $show = $Proses->showDetail_booked($kd_booked);
        $edit = $show->fetch(PDO::FETCH_OBJ);

      }
?>

         <div class="span3">
          </div>
          <div class="span6">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
                <h5>Data Transaksi</h5>
              </div>
              <div class="widget-content nopadding">
                <form action="../../../proses/transaksi.php" method="post" class="form-horizontal">
                  <div class="control-group" style="display: none;">
                    <input name="check_in" id="check_in" type="date" value="<?php echo $edit->check_in; ?>"/>
                    <input name="check_out" id="check_out" type="date" value="<?php echo $edit->check_out; ?>"/>
                    <input name="unit" type="text" value="<?php echo $edit->kd_unit; ?>"/>
                    <input name="apartemen" type="text" value="<?php echo $edit->kd_apt; ?>"/>
                    <input type="text" name="kd_penyewa" value="<?php echo $_POST["kd_penyewa"]; ?>">
                    <input type="text" name="kd_booked" value="<?php echo $_POST["kd_booked"]; ?>">
                    <input type="text" name="booking_via" value="3"/>
                    <input type="text" name="harga_sewa_asli" id="harga_sewa_asli" value="0"/>
                    <input type="text" name="jumhari" id="jumhari" value="0"/>

                  </div>
                  <div class="control-group">
                    <label class="control-label">Check In :</label>
                    <div class="controls">
                    <input type="date" class="span11" disabled value="<?php echo $edit->check_in; ?>"/>
                    <input type="text" name="kd_booked" value="<?php echo $_POST["kd_booked"]; ?>">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Check Out :</label>
                    <div class="controls">
                    <input type="date" class="span11" disabled value="<?php echo $edit->check_out; ?>"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Unit :</label>
                    <div class="controls">
                      <input type="text" class="span11" value="<?php echo $edit->no_unit; ?>" disabled/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Apartemen :</label>
                    <div class="controls">
                      <input type="text" class="span11" value="<?php echo $edit->nama_apt; ?>" disabled/>
                    </div>
                  </div>

                 <div hidden class="control-group" id="harga_sewa-C">
                    <label class="control-label">Harga Sewa Weekday:</label>
                    <div class="controls">
                      <input name="harga_sewa" id='harga_sewa' min="0" required class="span11" id="harga_sewa" type="number" onChange="hasil();" value="0" />
                      <div class="loading">
                        <img src="../../../asset/images/loading.gif" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                  </div>

                  <div class="control-group" id="total_harga_owner-C">
                    <label class="control-label">Total Harga Owner :</label>
                    <div class="controls">
                      <input name="total_harga_owner" min="0" id="total_harga_owner"  type="number" />
                    </div>
                  </div>

                  <div hidden class="control-group"  id="harga_sewa_we-C">
                    <label class="control-label">Harga Sewa Weekend:</label>
                    <div class="controls">
                      <input name="harga_sewa_we" id='harga_sewa_we' min="0" required class="span11" id="harga_sewa_we" type="number" onChange="hasil();" value="0" />
                      <div class="loading">
                        <img src="../../../asset/images/loading.gif" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                  </div>

                  <div hidden class="control-group">
                    <label class="control-label">Tamu :</label>
                    <div class="controls">
                    <input name="tamu" id="tamu" type="number" onChange="ech();" placeholder="Jumlah Tamu" required min="0" class="span11" value="5"/>
                    </div>
                  </div>
                  <div hidden class="control-group">
                    <label class="control-label">Ekstra Charge :</label>
                    <div class="controls">
                    <input name="ekstra_charge" min="0" value="0" placeholder="Ekstra Charge" type="number" id="ekstra_charge" onChange="hasil();" class="span11"/>
                    </div>
                  </div>
				  <div class="control-group">
                    <label class="control-label">Booking Via :</label>
                    <div class="controls">
                      <input type="text" class="span11" value="Airbnb" disabled/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Total Biaya :</label>
                    <div class="controls">
                      <input name="total" min="0" id="total" class="span11" type="number" required/>
                      <div class="loading">
                        <img src="../../../asset/images/loading.gif" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">DP Via :</label>
                    <div class="controls">
                    <select name="kas" required>
                      <!-- <option value="">-- Pilih DP Via --</option> -->
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
                    <input name="dp" type="number" class="span11" placeholder="Nominal DP" id="dp" value="0" disabled/>
                    </div>
                  </div>
				  <div class="control-group">
					<label class="control-label">Catatan :</label>
					<div class="controls">
						<textarea id = "catatan" name="catatan" rows="5" class="span11"></textarea>
					</div>
				</div>
                  <div class="control-group">
                    <div class="controls">
                      <div class="form-actions" style="text-align:right">
                         <button type="submit" name="Transaksi_booked" class="btn btn-success" onclick="ConvertText()">Transaksi</button>
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

<div id="popup-penyewa" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3 id='head-cap'>Detail Status</h3>
  </div>
  <div id="note-induk">
    <div class="widget-title" id="note-bar" style="cursor:pointer;"> <span class="icon"><i class="icon-comment"></i></span>
      <h5 id="note-cap">Catatan</h5>
    </div>
    <div id="note-anak">
      <div class="control-group newpadd">
        <div id="note-anak-isi">
          <div id="1" class="note">Nama Penyewa - Bojong buah - 0824234XXXX</div>
        </div>
      </div>
      <div class="controls" style="padding: 10px; text-align:right;">
        <a class='btn' id="pilih-penyewa">Pilih penyewa</a>
      </div>
    </div>
  </div>
</div>
<script>
function ConvertText() {
    var x = document.getElementById("catatan").value;

}
</script>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; Brought to you by <a href="http://www.booking.cozzal.com">Cozzal IT</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../../asset/js/booked.js"></script>
<script>
  $('#harga_sewa').hide();
  $('#harga_sewa_we').hide();
  $('#total').hide();
  tampilkanharga(<?php echo $edit->kd_unit.",'".$edit->check_in."','".$edit->check_out."'";?>);
</script>
<script src="../../../asset/js/jquery.min.js"></script>
<script src="../../../asset/js/jquery.ui.custom.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/jquery.uniform.js"></script>
<!--<script src="js/select2.min.js"></script>-->
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
</body>
</html>
