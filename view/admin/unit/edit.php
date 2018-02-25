<?php
  session_start();
  require("../../../class/unit.php");
  require("../../../class/apartemen.php");
  require("../../../class/owner.php");
  require("../../../../config/database.php");

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
  <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="unit.php" title="Go to Data Unit" class="tip-bottom">Data Unit</a> <a href="#" class="current">Edit</a> </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
	  <?php
  //Edit informasi dasar unit
    if (isset($_GET['edit_info_unit']))
    {
      $Proses = new Unit($db);
      $show = $Proses->editUnit($_GET['edit_info_unit']);
      $edit = $show->fetch(PDO::FETCH_OBJ);
      echo '
      <div class="span3">
      </div>
      <div class="span6">
        <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Informasi dasar unit</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="../../../proses/unit.php" method="post" class="form-horizontal">
          <div class="control-group">
          <input name="kd_owner_lama" class="hide" type="text" value="'.$edit->kd_owner.'"/>  <!--Hiden Flag-->
          <input name="kd_unit" class="hide" type="text" value="'.$edit->kd_unit.'"/>  <!--Hiden Flag-->
          <label class="control-label">Apartemen :</label>
          <div class="controls">
            <select name="apartemen">
              <option>-- Pilih Apartemen --</option>';
                $Proses = new Apartemen($db);
                $show = $Proses->showApartemen();
                while($data = $show->fetch(PDO::FETCH_OBJ)){
                if($data->kd_apt!='0'){
                  if ($edit->kd_apt!=$data->kd_apt){
                    echo "<option name='kd_apt' value='$data->kd_apt'>$data->nama_apt - $data->alamat_apt</option>";
                  }else{
                    echo "<option name='kd_apt' value='$data->kd_apt' selected='true'>$data->nama_apt - $data->alamat_apt</option>";
                  }
                }
                }
            echo '
            </select>
          </div>
            </div>
            <div class="control-group">
            <label class="control-label">No Unit :</label>
            <div class="controls">
              <input name="no_unit" type="text" placeholder="No Unit" value="'.$edit->no_unit.'"/>
            </div>
            </div>
           <div class="control-group">
            <label class="control-label">Owner :</label>
            <div class="controls">
              <select name="owner">
              <option>-- Pilih Owner --</option>';
             $Proses = new Owner($db);
                $show = $Proses->showOwner();
                while($data = $show->fetch(PDO::FETCH_OBJ)){
                if($data->kd_owner!=0){
                  if ($edit->kd_owner!=$data->kd_owner){
                    echo "<option name='kd_owner' value='$data->kd_owner'>$data->nama</option>";
                  }else{
                    echo "<option name='kd_owner' value='$data->kd_owner' selected='true'>$data->nama</option>";
                  }
                }
                }
            echo '
            </select>
          </div>
            </div>
          ';
          echo '
          <div class="form-actions" style="text-align:right">
          <button name="updateInfoUnit" type="submit" class="btn btn-success">Update</button>
          </div>
        </form>
        </div>
      </div>
      </div>
      <div class="span3">
      </div>';
      }

//Edit harga Unit by owner
    if (isset($_GET['edit_harga_owner']))
    {
      $Proses = new Unit($db);
      $show = $Proses->editUnit($_GET['edit_harga_owner']);
      $edit = $show->fetch(PDO::FETCH_OBJ);
      echo '
      <div class="span3">
      </div>
      <div class="span6">
        <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Data Harga</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="../../../proses/unit.php" method="post" class="form-horizontal">
            <div class="control-group">
            <input name="kd_unit" class="hide" type="text" value="'.$edit->kd_unit.'"/>  <!--Hiden Flag-->
            <label class="control-label">No Unit :</label>
            <div class="controls">
              <input name="no_unit" type="text" placeholder="No Unit" value="'.$edit->no_unit.'" disabled/>
            </div>
            </div>
            <div class="control-group">
            <label class="control-label">Harga Owner WD :</label>
            <div class="controls">
              <input name="h_owner_wd" type="number" min="0" step="1000" value="'.$edit->h_owner_wd.'"/>
            </div>
            </div>
            <div class="control-group">
            <label class="control-label">Harga Owner WE :</label>
            <div class="controls">
              <input name="h_owner_we" type="number" min="0" step="1000" value="'.$edit->h_owner_we.'" />
            </div>
            </div>
            <div class="control-group">
            <label class="control-label">Harga Sewa WD :</label>
            <div class="controls">
              <input name="h_sewa_wd" type="number" min="0" step="1000" value="'.$edit->h_sewa_wd.'" />
            </div>
            </div>
            <div class="control-group">
            <label class="control-label">Harga Sewa WE :</label>
            <div class="controls">
              <input name="h_sewa_we" type="number" min="0" step="1000" value="'.$edit->h_sewa_we.'" />
            </div>
            </div><div class="control-group">
            <label class="control-label">Ekstra Charge :</label>
            <div class="controls">
              <input name="ekstra_charge" type="number" min="0" step="1000" value="'.$edit->ekstra_charge.'" />
            </div>
            </div> ';
          echo '
          <div class="form-actions" style="text-align:right">
          <button name="updateHargaUnit" type="submit" class="btn btn-success">Update</button>
          </div>
        </form>
        </div>
      </div>
      </div>
      <div class="span3">
      </div>
          ';
      }

      //Edit data detail unit
      		if (isset($_GET['edit_detail_unit']) || isset($_GET['tambah_detail_unit']))
      		{
      		  $lantai = 0; $jml_kmr = 0; $jml_bed = 0; $jml_ac = 0; $water_heater='Tidak Tersedia';
      		  $dapur='Tidak Tersedia'; $wifi='Tidak Tersedia'; $tv='Tidak Tersedia'; $kd_unit=0; $act='';
      		  $amenities='Tidak Tersedia'; $merokok='Tidak Boleh'; $type='';
      		  if(isset($_GET['edit_detail_unit']))
      		  {
      		  		$Proses = new Unit($db);
      		  		$show = $Proses->showDetail_unit($_GET['edit_detail_unit']);
      		  		$edit = $show->fetch(PDO::FETCH_OBJ);
      		  		$lantai = $edit->lantai; $jml_kmr = $edit->jml_kmr; $jml_bed = $edit->jml_bed; $type=$edit->type;
      		  		$jml_ac = $edit->jml_ac; $kd_unit = $_GET['edit_detail_unit']; $act = 'update_detail_unit';
      		  		if($edit->water_heater=='Y'){
      					$water_heater='Tersedia';
      				}
      				if($edit->dapur=='Y'){
      					$dapur='Tersedia';
      				}
      				if($edit->wifi=='Y'){
      					$wifi='Tersedia';
      				}
      				if($edit->tv=='Y'){
      					$tv='Tersedia';
      				}
      				if($edit->amenities=='Y'){
      					$amenities='Tersedia';
      				}
      				if($edit->merokok=='Y'){
      					$merokok='Boleh';
      				}
      		  }
      		  else
      		  {
      		  		$kd_unit = $_GET['tambah_detail_unit'];
      		  		$act = 'add_detail_unit';
      		  }
      		  echo '
      			<div class="span3">
      			</div>
      			<div class="span6">
      			  <div class="widget-box">
        				<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
        				  <h5>Detail Fasilitas Unit</h5>
        				</div>
        				<div class="widget-content nopadding">
        				  <form action="../../../proses/unit.php" method="post" class="form-horizontal">
      					<div class="control-group">
        					  <label class="control-label">Type Unit :</label>
        					  <div class="controls">
      						<select name="type" class="span11">
      							<option name="type" value="" '; if($type=='') echo'selected="true"'; echo'>-- Pilih Type Unit --</option>
      							<option name="type" value="Studio" '; if($type=='Studio') echo'selected="true"'; echo'>Studio</option>
      							<option name="type" value="1BR" '; if($type=='1BR') echo'selected="true"'; echo'>1BR</option>
      							<option name="type" value="2BR" '; if($type=='2BR') echo'selected="true"'; echo'>2BR</option>
      							<option name="type" value="3BR" '; if($type=='3BR') echo'selected="true"'; echo'>3BR</option>
      						</select>
      					  </div>
      					</div>
        					<div class="control-group">
        					  <input name="kd_unit" class="hide" type="text" value="'.$kd_unit.'"/>
        					  <label class="control-label">Posisi lantai :</label>
        					  <div class="controls">
        						<input name="lantai" type="number" min="0" class="span11" value="'.$lantai.'"/>
        					  </div>
        					</div>
        					<div class="control-group">
        					  <label class="control-label">Jumlah Kamar :</label>
        					  <div class="controls">
        						<input name="jml_kmr" type="number" min="0" class="span11" value="'.$jml_kmr.'"/>
        					  </div>
        					</div>
        					<div class="control-group">
        					  <label class="control-label">Jumlah Kasur :</label>
        					  <div class="controls">
        						<input name="jml_bed" type="number" min="0" class="span11"  value="'.$jml_bed.'"/>
        					  </div>
        					</div>
        					<div class="control-group">
        					  <label class="control-label">Jumlah AC :</label>
        					  <div class="controls">
        						<input name="jml_ac" type="number" min="0" class="span11"  value="'.$jml_ac.'"/>
        					  </div>
        					</div>

        					<div class="control-group">
        					  <label class="control-label">Ruang Dapur :</label>
        						<div class="controls">
        						  <label>
        							<input type="radio" name="dapur" value="Y"';
        							 if($dapur=="Tersedia") echo 'checked';
        							 echo '/> Tersedia
        						  </label>
        						  <label>
        							<input type="radio" name="dapur" value="N"';
        							 if($dapur=="Tidak Tersedia") echo 'checked';
        							 echo '/> Tidak Tersedia
        						  </label>
        						</div>
        					</div>

        					<div class="control-group">
        					  <label class="control-label">Water Heater :</label>
        						<div class="controls">
        						  <label>
        							<input type="radio" name="water_heater" value="Y"';
        							 if($water_heater=="Tersedia") echo 'checked';
        							 echo '/> Tersedia
        						  </label>
        						  <label>
        							<input type="radio" name="water_heater" value="N"';
        							 if($water_heater=="Tidak Tersedia") echo 'checked';
        							 echo '/> Tidak Tersedia
        						  </label>
        						</div>
        					</div>

        					<div class="control-group">
        					  <label class="control-label">Tv Cable :</label>
        						<div class="controls">
        						  <label>
        							<input type="radio" name="tv" value="Y"';
        							 if($tv=="Tersedia") echo 'checked';
        							 echo '/> Tersedia
        						  </label>
        						  <label>
        							<input type="radio" name="tv" value="N"';
        							 if($tv=="Tidak Tersedia") echo 'checked';
        							 echo '/> Tidak Tersedia
        						  </label>
        						</div>
        					</div>

        					<div class="control-group">
        					  <label class="control-label">Wifi :</label>
        						<div class="controls">
        						  <label>
        							<input type="radio" name="wifi" value="Y"';
        							 if($wifi=="Tersedia") echo 'checked';
        							 echo '/> Tersedia
        						  </label>
        						  <label>
        							<input type="radio" name="wifi" value="N"';
        							 if($wifi=="Tidak Tersedia") echo 'checked';
        							 echo '/> Tidak Tersedia
        						  </label>
        						</div>
        					</div>

        					<div class="control-group">
        					  <label class="control-label">Amenities :</label>
        						<div class="controls">
        						  <label>
        							<input type="radio" name="amenities" value="Y"';
        							 if($amenities=="Tersedia") echo 'checked';
        							 echo '/> Tersedia
        						  </label>
        						  <label>
        							<input type="radio" name="amenities" value="N"';
        							 if($amenities=="Tidak Tersedia") echo 'checked';
        							 echo '/> Tidak Tersedia
        						  </label>
        						</div>
        					</div>

        					<div class="control-group">
        					  <label class="control-label">Merokok :</label>
        						<div class="controls">
        						  <label>
        							<input type="radio" name="merokok" value="Y"';
        							 if($merokok=="Boleh") echo 'checked';
        							 echo '/> Boleh
        						  </label>
        						  <label>
        							<input type="radio" name="merokok" value="N"';
        							 if($merokok=="Tidak Boleh") echo 'checked';
        							 echo '/> Tidak Boleh
        						  </label>
        						</div>
        					</div>
        					';
                    //button here
        					  echo '
        					  <div class="form-actions" style="text-align:right">
        						<button name="'.$act.'" type="submit" class="btn btn-success">Update</button>
        					  </div>
        					</form>
        				  </div>
        				</div>
      			  </div>
      		  ';
      		}
      ?>
<!--Footer-part-->
<div class="row-fluid">
<div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../../js/jquery.min.js"></script>
<script src="../../../js/jquery.ui.custom.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script src="../../../js/jquery.uniform.js"></script>
<script src="../../../js/transaksi.js"></script>
<!--<script src="js/select2.min.js"></script>-->
<script src="../../../js/jquery.dataTables.min.js"></script>
<script src="../../../js/matrix.js"></script>
<script src="../../../js/matrix.tables.js"></script>
</body>
</html>
