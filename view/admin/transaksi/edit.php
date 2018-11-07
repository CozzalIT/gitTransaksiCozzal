<?php
  require("../../../class/penyewa.php");
  require("../../../../config/database.php");
  require("../../../class/unit.php");
  require("../../../class/apartemen.php");
  require("../../../class/booking.php");
  require("../../../class/kas.php");
  require("../../../class/owner.php");
  require("../../../class/transaksi.php");

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
      if (isset($_GET['edit_transaksi']))
      {
        $Proses = new Transaksi($db);
        $show = $Proses->editTransaksi($_GET['edit_transaksi']);
        $edit = $show->fetch(PDO::FETCH_OBJ);
        $action = ($edit->status_broker=="B" ? '../../../proses/transaksi_broker.php' : '../../../proses/transaksi.php');
        echo '
          <div class="span3">
          </div>
          <div class="span6">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Edit Transaksi</h5>
              </div>
              <div class="widget-content nopadding">
                <form action="'.$action.'" method="post" class="form-horizontal">
                  <div class="control-group">
                    <input name="pembayaran" class="hide" type="text" value="'.$edit->pembayaran.'"/>
                    <input name="kd_transaksi" class="hide" type="text" value="'.$edit->kd_transaksi.'"/>
                    <label class="control-label">Nama :</label>
                  <div class="controls">
                    <input name="nama" type="text" class="span11" placeholder="Nama" value="'.$edit->nama.'" disabled/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Check In :</label>
                    <div class="controls">
                    <input name="check_in" id="check_in" type="date" class="span11" required placeholder="" value="'.$edit->check_in.'" onchange="keepvalid(this.form)"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Check Out :</label>
                    <div class="controls">
                    <input name="check_out" id="check_out" type="date" class="span11" required placeholder="" value="'.$edit->check_out.'" onchange="keepvalid2(this.form)"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Jumlah Hari :</label>
                    <div class="controls">
                    <input name="jumhari" type="number" class="span11" min="1" value="'.$edit->hari.'" onchange="tambah(this.form)"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Apartemen :</label>
                    <div class="controls" id="form_apt" name="form_apt">
                      <select id="apartemen" name="apartemen" required>
                        <option>-- Pilih Apartemen --</option>';
                          $Proses = new Apartemen($db);
                          $show = $Proses->showApartemen();
                          while($data = $show->fetch(PDO::FETCH_OBJ)){
                            if ($data->kd_apt != 0){
                              if ($edit->kd_apt!=$data->kd_apt){
                                echo "<option name='kd_apt' value='$data->kd_apt'>$data->nama_apt</option>";
                              }else{
                                echo "<option name='kd_apt' value='$data->kd_apt' selected='true'>$data->nama_apt</option>";
                              }
                            }
                          }
                          echo '
                      </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Unit :</label>
                    <div class="controls">
                      <select name="unit" id="unit" onchange="biaya(this.form)" required >
                        <option>-- Pilih Unit --</option>';
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
                                $harga_asal = $data->h_sewa_wd."/".$data->h_sewa_we;
                              }
                            }
                          }
                          echo '
                      </select>
                      <div id="loading">
            						<img src="../../../asset/images/loading.gif" width="18"> <small>Loading...</small>
            					</div>
                    </div>
                  </div>
                  <div class="control-group" id="harga_sewa-C">
                    <label class="control-label">Harga Sewa Weekday:</label>
                    <div class="controls">
                      <input name="harga_sewa" min="0" value="'.$edit->harga_sewa.'" required class="span11" id="harga_sewa" type="number" onChange="hasil(this.form)" />
                    </div>
                  </div>
                  <div class="control-group" id="harga_sewa_we-C">
                    <label class="control-label">Harga Sewa Weekend:</label>
                    <div class="controls">
                      <input name="harga_sewa_we" min="0" value="'.$edit->harga_sewa_weekend.'" required class="span11" id="harga_sewa_we" type="number" onChange="hasil(this.form)" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Jumlah Tamu :</label>
                    <div class="controls">
                      <input name="tamu" min="0" type="number" value="'.$edit->tamu.'" onChange="ECH(this.form)"/>
                      <input name="harga_sewa_asli" type="text" style="display:none;" value="'.$harga_asal.'"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Ekstra Charge :</label>
                    <div class="controls">
                    <input name="ekstra_charge" min="0"  type="number" onChange="hasil(this.form)" required class="span11" value="'.$edit->ekstra_charge.'"/>
                    </div>
                  </div>
				  <div class="control-group">
					<label class="control-label">Deposit :</label>
					<div class="controls">
						<input name="deposit" min = "0" id="deposit"  type="number" value="'.$edit->deposit.'" />
					</div>
				  </div>
                  <div class="control-group">
                    <label class="control-label">Total Biaya :</label>
                    <div class="controls">
                    <input name="total" min="0"  class="span11" type="number" required value="'.$edit->total_tagihan.'"/>
                    </div>
                  </div>
				          <div class="control-group">
                    <label class="control-label">Total Harga Owner :</label>
                    <div class="controls">
                    <input name="total_harga_owner" min="0"  class="span11" type="number" required value="'.$edit->total_harga_owner.'"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Booking Via :</label>
                    <div class="controls">
                      <select name="booking_via" required>
                        <option>-- Pilih Booking Via --</option>';
                          $Proses = new Booking($db);
                          $show = $Proses->showBooking_via();
                          while($data = $show->fetch(PDO::FETCH_OBJ)){
                            if ($edit->kd_booking!=$data->kd_booking){
                              echo "<option name='kd_booking' value='$data->kd_booking'>$data->booking_via</option>";
                            }else{
                              echo "<option name='kd_booking' value='$data->kd_booking' selected='true'>$data->booking_via</option>";
                            }
                          }
                          echo '
                      </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">DP Via :</label>
                    <div class="controls">
                    <select name="kas" required>
                      <option>-- Pilih Kas --</option>';
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
                    <label class="control-label">DP :</label>
                    <div class="controls">
                    <input name="dp" type="number" class="span11" placeholder="Alamat" value="'.$edit->dp.'" required/>
                    </div>
                  </div> 
				  <div class="control-group">
					<label class="control-label">Catatan :</label>
					<div class="controls">
						<textarea id = "catatan" name="catatan" rows="4" class="span11">' .$edit->catatan. '</textarea>
					</div>
				</div>
                  <div class="control-group">
                    <div class="controls">
                      <div class="form-actions" style="text-align:right">
                			   <button name="updateTransaksi" type="submit" class="btn btn-success" onclick="ConvertText()">Update</button>
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
