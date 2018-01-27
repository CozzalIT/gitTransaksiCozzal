<?php
  session_start();

  if(!isset($_SESSION['username'])) {
    header('location:login.php');
  }else {
    $username = $_SESSION['username'];
  }

  $thisPage = "Edit";

  include "template/head.php";
?>
<body>
<?php
  include "template/header.php";
  include "template/sidebar.php";
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
	  <?php
		require('proses/proses.php');
//edit data penyewa
		if(isset($_GET['edit'])){
		  $Proses = new Proses();
		  $show = $Proses->editPenyewa($_GET['edit']);
		  $edit = $show->fetch(PDO::FETCH_OBJ);
		  echo '
			<div class="span3">
			</div>
			<div class="span6">
			  <div class="widget-box">
				<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
				  <h5>Personal-info</h5>
				</div>
				<div class="widget-content nopadding">
				  <form action="proses/proses_update.php" method="post" class="form-horizontal">
					<div class="control-group">
					  <div class="controls">
						<input name="kd_penyewa" type="text" class="span11 hide" placeholder="Nama" value="'.$edit->kd_penyewa.'"/>
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label">Nama :</label>
					  <div class="controls">
						<input name="nama" type="text" class="span11" placeholder="Nama" value="'.$edit->nama.'"/>
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label">Alamat :</label>
					  <div class="controls">
						<input name="alamat" type="text" class="span11" placeholder="Alamat" value="'.$edit->alamat.'"/>
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label">No Telpon :</label>
					  <div class="controls">
						<input name="no_tlp" type="text" class="span11" placeholder="Ex : 081..." value="'.$edit->no_tlp.'"/>
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label">Jenis Kelamin :</label>
          ';

					if ($edit->jenis_kelamin == 'Laki-laki') {
					  echo '
						<div class="controls">
						  <label>
							<input type="radio" name="jenis_kelamin" value="Laki-laki" checked/> Laki-laki
						  </label>
						  <label>
							<input type="radio" name="jenis_kelamin" value="Perempuan" /> Perempuan
						  </label>
						</div>

					  ';
					} else {
					  echo '
						<div class="controls">
						  <label>
							<input type="radio" name="jenis_kelamin" value="Laki-laki" /> Laki-laki
						  </label>
						  <label>
							<input type="radio" name="jenis_kelamin" value="Perempuan" checked/> Perempuan
						  </label>
						</div>
					  ';
					}
          //button here
					echo '
					  </div>
            <div class="control-group">
  					  <label class="control-label">No Telpon :</label>
  					  <div class="controls">
  						<input name="email" type="text" class="span11" placeholder="Ex : abc@gmail.com" value="'.$edit->email.'"/>
  					  </div>
  					</div>
					  <div class="form-actions" style="text-align:right">
						<button name="updatePenyewa" type="submit" class="btn btn-success">Update</button>
					  </div>
					</form>
				  </div>
				</div>
			  </div>
			  <div class="span3">
			  </div>
		  ';
		}

//edit data apartemen
		if (isset($_GET['edit_apt']))
		{
		  $Proses = new Proses();
		  $show = $Proses->editApartemen($_GET['edit_apt']);
		  $edit = $show->fetch(PDO::FETCH_OBJ);
		  echo '
			<div class="span3">
			</div>
			<div class="span6">
			  <div class="widget-box">
				<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
				  <h5>Apartement-info</h5>
				</div>
				<div class="widget-content nopadding">
				  <form action="proses/proses_update.php" method="post" class="form-horizontal">
					<div class="control-group">
					  <label class="control-label hide">Kode Apartement :</label>
					  <div class="controls">
						<input name="kd_apt" type="text" class="span11 hide" placeholder="Kode" value="'.$edit->kd_apt.'"/>
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label">Nama Apartemen :</label>
					  <div class="controls">
						<input name="nama_apt" type="text" class="span11" placeholder="Nama" value="'.$edit->nama_apt.'"/>
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label">Alamat :</label>
					  <div class="controls">
						<input name="alamat_apt" type="text" class="span11" placeholder="Alamat" value="'.$edit->alamat_apt.'"/>
					  </div>
					</div>';
//button here
					echo '
					  <div class="form-actions" style="text-align:right">
						<button name="updateApartemen" type="submit" class="btn btn-success">Update</button>
					  </div>
					</form>
				  </div>
				</div>
			  </div>
			  <div class="span3">
			  </div>
		  ';
		}

//edit data bank
		if (isset($_GET['edit_bank']))
		{
		  $Proses = new Proses();
		  $show = $Proses->editDp_via($_GET['edit_bank']);
		  $edit = $show->fetch(PDO::FETCH_OBJ);
		  echo '
			<div class="span3">
			</div>
			<div class="span6">
			  <div class="widget-box">
				<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
				  <h5>Data Baru</h5>
				</div>
				<div class="widget-content nopadding">
				  <form action="proses/proses_update.php" method="post" class="form-horizontal">
					<div class="control-group">
					  <label class="control-label hide">Kode :</label>
					  <div class="controls">
						<input name="kd_bank" type="text" class="span11 hide" placeholder="No Rekening" value="'.$edit->kd_bank.'"/>
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label">Nama Bank :</label>
					  <div class="controls">
						<input name="nama_bank" type="text" class="span11" placeholder="Nama Bank" value="'.$edit->nama_bank.'"/>
					  </div>
					</div>
					';
          //button here
					echo '
					  <div class="form-actions" style="text-align:right">
						<button name="updateBank" type="submit" class="btn btn-success">Update</button>
					  </div>
					</form>
				  </div>
				</div>
			  </div>
			  <div class="span3">
			  </div>
		  ';
		}

//edit booking_via
		if (isset($_GET['edit_booking']))
		{
		  $Proses = new Proses();
		  $show = $Proses->editBooking_via($_GET['edit_booking']);
		  $edit = $show->fetch(PDO::FETCH_OBJ);
		  echo '
			<div class="span3">
			</div>
			<div class="span6">
			  <div class="widget-box">
				<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
				  <h5>Data Baru</h5>
				</div>
				<div class="widget-content nopadding">
				  <form action="proses/proses_update.php" method="post" class="form-horizontal">
					<div class="control-group">
					  <label class="control-label hide">Kode :</label>
					  <div class="controls">
						<input name="kd_booking" type="text" class="span11 hide" placeholder="Kode" value="'.$edit->kd_booking.'"/>
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label">Booking Via :</label>
					  <div class="controls">
						<input name="booking_via" type="text" class="span11" placeholder="Dari" value="'.$edit->booking_via.'"/>
					  </div>
					</div>
					';
          //button here
					echo '
					  <div class="form-actions" style="text-align:right">
						<button name="updateBooking" type="submit" class="btn btn-success">Update</button>
					  </div>
					</form>
				  </div>
				</div>
			  </div>
			  <div class="span3">
			  </div>
		  ';
		}
//Edit data owner

		if (isset($_GET['edit_owner']))
		{
		  $Proses = new Proses();
		  $show = $Proses->editOwner($_GET['edit_owner']);
		  $edit = $show->fetch(PDO::FETCH_OBJ);
		  echo '
			<div class="span3">
			</div>
			<div class="span6">
			  <div class="widget-box">
				<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
				  <h5>Data Baru</h5>
				</div>
				<div class="widget-content nopadding">
				  <form action="proses/proses_update.php" method="post" class="form-horizontal">
					<div class="control-group">
					  <input name="kd_owner" class="hide" type="text" value="'.$edit->kd_owner.'"/>
					  <label class="control-label">Nama :</label>
					  <div class="controls">
						<input name="nama" type="text" class="span11" placeholder="Nama" value="'.$edit->nama.'"/>
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label">Alamat :</label>
					  <div class="controls">
						<input name="alamat" type="text" class="span11" placeholder="Alamat" value="'.$edit->alamat.'"/>
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label">No Telpon :</label>
					  <div class="controls">
						<input name="no_tlp" type="text" class="span11" placeholder="Ex : 08x..." value="'.$edit->no_tlp.'"/>
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label">Jenis Kelamin :</label>
                    ';
					if ($edit->jenis_kelamin == 'Laki-laki') {
					  echo '
						<div class="controls">
						  <label>
							<input type="radio" name="jenis_kelamin" value="Laki-laki" checked/> Laki-laki
						  </label>
						  <label>
							<input type="radio" name="jenis_kelamin" value="Perempuan" /> Perempuan
						  </label>
						</div>
					  ';
					} else {
					  echo '
						<div class="controls">
						  <label>
							<input type="radio" name="jenis_kelamin" value="Laki-laki" /> Laki-laki
						  </label>
						  <label>
							<input type="radio" name="jenis_kelamin" value="Perempuan" checked/> Perempuan
						  </label>
						</div>
					'; }

					echo '
						<div class="control-group">
						  <label class="control-label">Via Bank :</label>
							<div class="controls">
								<select name="kd_bank" class="span11">
									<option name="" value="" >-- Pilih Bank --</option>';
      						$Proses = new Proses();
      						$show = $Proses->showDp_via();
      						while($data = $show->fetch(PDO::FETCH_OBJ)){
        						if ($edit->kd_bank!=$data->kd_bank)
        						  echo "<option name='kd_bank' value='$data->kd_bank'>$data->nama_bank</option>";
        						else  echo "<option name='kd_bank' value='$data->kd_bank' selected='true'>$data->nama_bank</option>";
      						}
      					  echo '
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">No Rekening :</label>
							<div class="controls">
								<input name="no_rek" type="text" class="span11" placeholder="No Rekening" value="'.$edit->no_rek.'"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">E-mail :</label>
							<div class="controls">
								<input name="email" type="text" class="span11" placeholder="Alamat E-Mail" value="'.$edit->email.'"/>
							</div>
						</div>';
            //button here
					  echo '
					  <div class="form-actions" style="text-align:right">
						<button name="updateOwner" type="submit" class="btn btn-success">Update</button>
					  </div>
					</form>
				  </div>
				</div>
			  </div>
			  <div class="span3">
			  </div>
		  ';
		}

//Edit Data Unit
    if (isset($_GET['edit_unit']))
    {
      $Proses = new Proses();
      $show = $Proses->editUnit($_GET['edit_unit']);
      $edit = $show->fetch(PDO::FETCH_OBJ);
      echo '
      <div class="span3">
      </div>
      <div class="span6">
        <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Data Baru</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="proses/proses_update.php" method="post" class="form-horizontal">
          <div class="control-group">
		    <input name="kd_unit" class="hide" type="text" value="'.$edit->kd_unit.'"/>  <!--Hiden Flag-->
		    <input name="kd_owner_lama" class="hide" type="text" value="'.$edit->kd_owner.'"/>  <!--Hiden Flag-->
      		<label class="control-label">Apartemen :</label>
          <div class="controls">
      		  <select name="apartemen">
        		  <option>-- Pilih Apartemen --</option>';
                $Proses = new Proses();
                $show = $Proses->showApartemen();
                while($data = $show->fetch(PDO::FETCH_OBJ)){
                  if ($edit->kd_apt!=$data->kd_apt){
                    echo "<option name='kd_apt' value='$data->kd_apt'>$data->nama_apt</option>";
                  }else{
                    echo "<option name='kd_apt' value='$data->kd_apt' selected='true'>$data->nama_apt</option>";
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
                $show = $Proses->showOwner();
                while($data = $show->fetch(PDO::FETCH_OBJ)){
                  if ($edit->kd_owner!=$data->kd_owner){
                    echo "<option name='kd_owner' value='$data->kd_owner'>$data->nama</option>";
                  }else{
                    echo "<option name='kd_owner' value='$data->kd_owner' selected='true'>$data->nama</option>";
                  }
                }
            echo '
            </select>
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
    			<button name="updateUnit" type="submit" class="btn btn-success">Update</button>
    		  </div>
    		</form>
    	  </div>
    	</div>
    	</div>
    	<div class="span3">
    	</div>
          ';
      }

      if (isset($_GET['edit_transaksi']))
      {
        $Proses = new Proses();
        $show = $Proses->editTransaksi($_GET['edit_transaksi']);
        $edit = $show->fetch(PDO::FETCH_OBJ);
        echo '
          <div class="span3">
          </div>
          <div class="span6">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Edit Transaksi</h5>
              </div>
              <div class="widget-content nopadding">
                <form action="proses/proses_update.php" method="post" class="form-horizontal">
                  <div class="control-group">
                    <input name="kd_transaksi" class="hide" type="text" value="'.$edit->kd_transaksi.'"/>
                    <label class="control-label">Nama :</label>
                  <div class="controls">
                    <input name="nama" type="text" class="span11" placeholder="Nama" value="'.$edit->nama.'" disabled/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Check In :</label>
                    <div class="controls">
                    <input name="check_in" id="check_in" type="date" class="span11" required placeholder="" value="'.$edit->check_in.'" onchange="validasi(this.form)"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Check Out :</label>
                    <div class="controls">
                    <input name="check_out" id="check_out" type="date" class="span11" required placeholder="" value="'.$edit->check_out.'" onchange="validasi2(this.form)"/>
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
                          $Proses = new Proses();
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
                          $Proses = new Proses();
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
                          echo '
                      </select>
                      <div id="loading">
            						<img src="images/loading.gif" width="18"> <small>Loading...</small>
            					</div>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Harga Sewa :</label>
                    <div class="controls">
                    <input name="harga_sewa_asli" type="number" style="display:none;" value="'.$harga_asal.'"/>
                    <input name="harga_sewa" min="0" step="1000" required id="harga_sewa" type="number" class="span11" placeholder="Harga Sewa" value="'.$edit->harga_sewa.'" onChange="hasil(this.form)"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Tamu :</label>
                    <div class="controls">
                    <input name="tamu" onChange="ECH(this.form)" type="number" required min="0" class="span11" value="'.$edit->tamu.'"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Ekstra Charge :</label>
                    <div class="controls">
                    <input name="ekstra_charge" min="0" step="1000" type="number" onChange="hasil(this.form)" required class="span11" value="'.$edit->ekstra_charge.'"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Total Biaya :</label>
                    <div class="controls">
                    <input name="total" min="0" step="1000" class="span11" type="number" required value="'.$edit->total_tagihan.'"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Booking Via :</label>
                    <div class="controls">
                      <select name="booking_via" required>
                        <option>-- Pilih Booking Via --</option>';
                          $Proses = new Proses();
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
                    <select name="dp_via" required>
                      <option>-- Pilih DP Via --</option>';
                        $Proses = new Proses();
                        $show = $Proses->showDp_via();
                        while($data = $show->fetch(PDO::FETCH_OBJ)){
                          if ($edit->kd_bank!=$data->kd_bank){
                            echo "<option name='kd_bank' value='$data->kd_bank'>$data->nama_bank</option>";
                          }else{
                            echo "<option name='kd_bank' value='$data->kd_bank' selected='true'>$data->nama_bank</option>";
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
                    <div class="controls">
                      <div class="form-actions" style="text-align:right">
                			   <button name="updateTransaksi" type="submit" class="btn btn-success">Update</button>
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

//Edit data detail unit
		if (isset($_GET['edit_detail_unit']) || isset($_GET['tambah_detail_unit']))
		{
		  $lantai = 0; $jml_kmr = 0; $jml_bed = 0; $jml_ac = 0; $water_heater='Tidak Tersedia';
		  $dapur='Tidak Tersedia'; $wifi='Tidak Tersedia'; $tv='Tidak Tersedia'; $kd_unit=0; $act='';
		  $amenities='Tidak Tersedia'; $merokok='Tidak Boleh';
		  if(isset($_GET['edit_detail_unit']))
		  {
		  		$Proses = new Proses();
		  		$show = $Proses->showDetailUnit($_GET['edit_detail_unit']);
		  		$edit = $show->fetch(PDO::FETCH_OBJ);
		  		$lantai = $edit->lantai; $jml_kmr = $edit->jml_kmr; $jml_bed = $edit->jml_bed;
		  		$jml_ac = $edit->jml_ac; $kd_unit = $_GET['edit_detail_unit']; $act = 'proses/proses_update.php';
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
		  		$act = 'proses/proses_add.php';
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
  				  <form action="'.$act.'" method="post" class="form-horizontal">
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
  						<button name="detail_unit" type="submit" class="btn btn-success">Update</button>
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
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.uniform.js"></script>
<script src="js/transaksi.js"></script>
<!--<script src="js/select2.min.js"></script>-->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/matrix.js"></script>
<script src="js/matrix.tables.js"></script>
</body>
</html>
