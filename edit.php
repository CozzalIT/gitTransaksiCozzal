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
					  <label class="control-label">Kode Penyewa :</label>
					  <div class="controls">
						<input name="kd_penyewa" type="text" class="span11" placeholder="Nama" value="'.$edit->kd_penyewa.'"/>
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
					  <label class="control-label">Kode Apartement :</label>
					  <div class="controls">
						<input name="kd_apt" type="text" class="span11" placeholder="Kode" value="'.$edit->kd_apt.'"/>
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
					  <label class="control-label">Kode :</label>
					  <div class="controls">
						<input name="kd_bank" type="text" class="span11" placeholder="No Rekening" value="'.$edit->kd_bank.'"/>
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
					  <label class="control-label">Kode :</label>
					  <div class="controls">
						<input name="kd_booking" type="text" class="span11" placeholder="Kode" value="'.$edit->kd_booking.'"/>
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
								<input name="no_rek" type="text" class="span11" placeholder="No Rekening" value="'.$edit->alamat.'"/>
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

    if (isset($_GET['edit_unit']))
    {
    //  $Proses = new Proses();
    //  $show = $Proses->editOwner($_GET['edit_owner']);
    //  $edit = $show->fetch(PDO::FETCH_OBJ);
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
      		<label class="control-label">Apartemen :</label>
      		<div class="controls">
      		  <select name="apartemen">
      		  <option>-- Pilih Apartemen --</option>
      		  </select>
      		</div>
      	  </div>
      	  <div class="control-group">
      		<label class="control-label">No Unit :</label>
      		<div class="controls">
      		  <input name="no_unit" type="text" placeholder="No Unit" />
      		</div>
      	  </div>
      	  <div class="control-group">
      		<label class="control-label">Harga Owner WD :</label>
      		<div class="controls">
      		  <input name="h_owner_wd" type="text" placeholder="Owner Week Day"  />
      		</div>
      	  </div>
      	  <div class="control-group">
      		<label class="control-label">Harga Owner WE :</label>
      		<div class="controls">
      		  <input name="h_owner_we" type="text" placeholder="Owner Week End"  />
      		</div>
      	  </div>
      	  <div class="control-group">
      		<label class="control-label">Harga Sewa WD :</label>
      		<div class="controls">
      		  <input name="h_sewa_wd" type="text" placeholder="Sewa Week Day"  />
      		</div>
      	  </div>
      	  <div class="control-group">
      		<label class="control-label">Harga Sewa WE :</label>
      		<div class="controls">
      		  <input name="h_sewa_we" type="text" placeholder="Sewa Week End"  />
      		</div>
      	  </div><div class="control-group">
      		<label class="control-label">Ekstra Charge :</label>
      		<div class="controls">
      		  <input name="ekstra_charge" type="text" placeholder="Sewa Week Day"  />
      		</div>
      	  </div>
      	  <div class="control-group">
      		<div class="controls">
      		  <input type="submit" name="addUnit" class="btn btn-success">
      		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
      		</div>
      	  </div>
          </form>
          </div>
        </div>
        </div>
        <div class="span3">
        </div>
      ';
    }

	  ?>
	</div>
  </div>
</div>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.uniform.js"></script>
<!--<script src="js/select2.min.js"></script>-->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/matrix.js"></script>
<script src="js/matrix.tables.js"></script>
</body>
</html>
