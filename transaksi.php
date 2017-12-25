<?php
  require('proses/proses.php');
  session_start();

  if(!isset($_SESSION['username'])) {
    header('location:login.php');
  }else {
    $username = $_SESSION['username'];
  }

  $thisPage = "Transaksi";

  include "template/head.php";
?>
<body>
<?php
  include "template/header.php";
  include "template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Form wizard</a> </div>
    <h1>Transaksi</h1>
	<a href="laporan_transaksi.php" class="btn btn-success btn-add"><i class="icon-edit"></i> Laporan Transaksi</a>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
	    <form action="proses/proses_add.php" method="post" class="form-horizontal">
        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse"> <span class="icon"><i class="icon-ok"></i></span>
                <h5>Data Penyewa</h5>
                </a> </div>
            </div>
			<div class="collapse in accordion-body" id="collapseGOne">
			  <div class="widget-content center" style="text-align:center"> Piih Data Penyewa </div>
			  <div class="widget-content">
				<ul class="bs-docs-tooltip-examples">
                  <li><button name="penyewaBaru" class="btn btn-success" href="#popup-penyewa-baru" data-toggle="modal" class="btn btn-info btn-add">Penyewa Baru</button> </li>
                  <li><a href="penyewa.php" class="btn btn-success">Penyewa Lama</a> </li>
				</ul>
			  </div>
			  <?php
			  if(isset($_GET['transaksi'])){
				$Proses = new Proses();
				$show = $Proses->editPenyewa($_GET['transaksi']);
				$edit = $show->fetch(PDO::FETCH_OBJ);
				echo '
				<div class="widget-content">
				  <div class="control-group">
				    <label class="control-label hide">ID :</label>
				    <div class="controls">
				      <input name="kd_penyewa" type="text" class="span3 hide" placeholder="ID" value="'.$edit->kd_penyewa.'" />
				    </div>
			      </div>
			      <div class="control-group">
				    <label class="control-label">Nama :</label>
				    <div class="controls">
				      <input name="nama" type="text" class="span3" placeholder="Nama" value="'.$edit->nama.'" />
				    </div>
			      </div>
			      <div class="control-group">
				    <label class="control-label">Alamat :</label>
				    <div class="controls">
				      <input name="alamat" type="text" class="span3" placeholder="Alamat" value="'.$edit->alamat.'" />
				    </div>
			      </div>
			      <div class="control-group">
			  	    <label class="control-label">No Telpon :</label>
				    <div class="controls">
				      <input name="no_tlp" type="text"  class="span3" placeholder="ex: 0812...." value="'.$edit->no_tlp.'" />
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

				  echo '
			      </div>
			      <div class="control-group">
				    <div class="controls">
					  <button data-parent="#collapse-group" href="#collapseGFour" data-toggle="collapse" class="btn btn-success">Lanjut</button>
					</div>
			      </div>
				</div>';}

			  if(isset($_GET['nama'])){
				echo '
				<div class="widget-content">
				  <div class="control-group">
				    <label class="control-label hide">ID :</label>
				    <div class="controls">
				      <input name="kd_penyewa" type="text" class="span3 hide" placeholder="ID" value="" />
				    </div>
			      </div>
			      <div class="control-group">
				    <label class="control-label">Nama :</label>
				    <div class="controls">
				      <input name="nama" type="text" class="span3" placeholder="Nama" value="'.$_GET['nama'].'" />
				    </div>
			      </div>
			      <div class="control-group">
				    <label class="control-label">Alamat :</label>
				    <div class="controls">
				      <input name="alamat" type="text" class="span3" placeholder="Alamat" value="'.$_GET['alamat'].'" />
				    </div>
			      </div>
			      <div class="control-group">
			  	    <label class="control-label">No Telpon :</label>
				    <div class="controls">
				      <input name="no_tlp" type="text"  class="span3" placeholder="ex: 0812...." value="'.$_GET['no_tlp'].'" />
				    </div>
			      </div>
			      <div class="control-group">
				    <label class="control-label">Jenis Kelamin :</label>
				    ';

					if ($_GET['jenis_kelamin'] == 'Laki-laki') {
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

				  echo '
			      </div>
			      <div class="control-group">
				    <div class="controls">
					  <button data-parent="#collapse-group" href="#collapseGFour" data-toggle="collapse" class="btn btn-success">Lanjut</button>
					</div>
			      </div>
				</div>';}
			  ?>
            </div>
          </div>
		  <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGFour" data-toggle="collapse"> <span class="icon"><i class="icon-eye-open"></i></span>
                <h5>Pilih Tanggal</h5>
                </a> </div>
            </div>
            <div class="collapse accordion-body" id="collapseGFour">

			    <div class="control-group">
				  <label class="control-label">Check In :</label>
				  <div class="controls">
				    <input name="check_in" type="date" onchange="cobaan(this.form)"/>
				  </div>
			    </div>
				<div class="control-group">
				  <label class="control-label">Check Out :</label>
				  <div class="controls">
				    <input name="check_out" type="date" onchange="cobaan2(this.form)"/>
				  </div>
			    <div class="control-group">
          </div>
				  <div class="controls">
				    <button data-parent="#collapse-group" href="#collapseUnit" data-toggle="collapse" class="btn btn-success">Lanjut</button>
				 </div>
			   </div>

            </div>
          </div>
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseUnit" data-toggle="collapse"> <span class="icon"><i class="icon-eye-open"></i></span>
                <h5>Pilih Unit</h5>
                </a> </div>
            </div>
            <div class="collapse accordion-body" id="collapseUnit">
				<div class="control-group">
				    <label class="control-label">Apartemen :</label>
				  <div class="controls" id="form_apt" name="form_apt">
					<select id="apartemen" name="apartemen" class="span4">
					  <option name="" value="">-- Pilih Apartemen --</option>
					  <?php
            $Proses = new Proses();
  				  $show = $Proses->showApartemen();
  				  while($data = $show->fetch(PDO::FETCH_OBJ)){
						  echo "<option name='kd_apt' value='$data->kd_apt'>$data->nama_apt</option>";
						}
					  ?>
					</select>
				  </div>
			    </div>
			    <div class="control-group">
				  <label class="control-label">Unit :</label>
				  <div class="controls">
				    <select name="unit" id="unit" class="span4">
					  <option value="">-- Pilih Unit --</option>
					</select>
					<div id="loading">
						<img src="images/loading.gif" width="18"> <small>Loading...</small>
					</div>
				  </div>
			    </div>
          <div class="control-group">
  				  <label class="control-label">Harga Sewa :</label>
  				  <div class="controls">
  				    <input name="harga_sewa" id="harga_sewa" type="number" />
              <div id="loading2">
    						<img src="images/loading.gif" width="18"> <small>Loading...</small>
    					</div>
            </div>
  			    </div>
				<div class="control-group">
				  <label class="control-label">Jumlah Tamu :</label>
				  <div class="controls">
				    <input name="tamu" type="number" value="5"/>
				  </div>
			    </div>
          <div class="control-group">
            <label class="control-label">Ekstra Charge :</label>
            <div class="controls">
              <input name="ekstra_charge" type="number" />
            </div>
            </div>
			    <div class="control-group">
				  <div class="controls">
				    <button data-parent="#collapse-group" href="#collapseGFive" data-toggle="collapse" class="btn btn-success">Lanjut</button>
				 </div>
			   </div>

            </div>
          </div>
		  <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGFive" data-toggle="collapse"> <span class="icon"><i class="icon-eye-open"></i></span>
                <h5>Booking dan DP</h5>
                </a> </div>
            </div>
            <div class="collapse accordion-body" id="collapseGFive">

			    <div class="control-group">
				  <label class="control-label">Booking Via :</label>
				  <div class="controls">
				    <select id="booking_via" name="booking_via" class="span4">
					  <option>-- Booking --</option>
					  <?php
            $Proses = new Proses();
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
				    <select id="dp_via" name="dp_via" class="span4">
					  <option>-- Bank --</option>
					  <?php
            $Proses = new Proses();
  				  $show = $Proses->showDp_via();
  				  while($data = $show->fetch(PDO::FETCH_OBJ)){
						  echo "<option name='kd_bank' value='$data->kd_bank'>$data->nama_bank</option>";
						}
					  ?>
					</select>
				  </div>
			    </div>
				<div class="control-group">
				  <label class="control-label">Jumlah DP :</label>
				  <div class="controls">
				    <input name="dp" type="number" />
				  </div>
			    </div>
			    <div class="control-group" >
				  <div class="controls">
				    <input type="submit" name="addTransaksi" value="Submit" class="btn btn-success">
				    <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
				 </div>
			   </div>

            </div>
          </div>
        </div>
		</form>
      </div>
    </div>
  </div>
</div>

<?php
  include 'template/modal.php';
?>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/jquery.wizard.js"></script>
<script src="js/matrix.js"></script>
<script src="js/matrix.wizard.js"></script>
<script src="js/imron_tanggal.js"></script>
<script src="js/jquery.uniform.js"></script>
<!-- <script src="js/select2.min.js"></script> -->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/matrix.tables.js"></script>
</body>
</html>
