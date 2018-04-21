<?php
  require("../../../class/transaksi.php");
  require("../../../class/unit.php");
  require("../../../class/penyewa.php");
  require("../../../class/apartemen.php");
  require("../../../class/booking.php");
  require("../../../class/kas.php");
  require("../../../../config/database.php");

  $thisPage = "Transaksi";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Transaksi</a></div>
    <h1>Transaksi</h1>
	<a href="laporan_transaksi.php" class="btn btn-success btn-add"><i class="icon-edit"></i> Laporan Transaksi</a>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
	    <form action="../../../proses/transaksi.php" method="post" class="form-horizontal" name="general">
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
                    <li><a href="../penyewa/penyewa.php" class="btn btn-success">Penyewa Lama</a> </li>
          				</ul>
        			  </div>
        			  <?php
        			  if(isset($_GET['transaksi'])){
                $Proses = new Penyewa($db);
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
        				      <input name="kd_penyewa" type="text" class="span3 hide" placeholder="ID" value="'.$_GET['kd_penyewa'].'" />
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
              <?php
              $ref = "#";
              if(isset($_GET['transaksi']) || isset($_GET['nama'])) $ref = "#collapseGFour";
                echo'
                <div class="widget-title"> <a data-parent="#collapse-group" href='.$ref.' data-toggle="collapse">';
              ?>
              <span class="icon"><i class="icon-eye-open"></i></span>
              <h5>Pilih Tanggal</h5>
              </a> </div>
            </div>
            <div class="collapse accordion-body" id="collapseGFour">
    			    <div class="control-group">
      				  <label class="control-label">Check In :  <?$tgl=date('d-m-Y');echo $tgl;?></label>
      				  <div class="controls">
      				    <input name="check_in" id="check_in" type="date" onchange="validasi(this.form)"/>
      				  </div>
    			    </div>
      				<div class="control-group">
      				  <label class="control-label">Check Out :</label>
      				  <div class="controls">
      				    <input name="check_out" id="check_out" type="date" onchange="validasi2(this.form)"/>
      				  </div>
      				</div>
      				<div class="control-group">
      				  <label class="control-label">Jumlah Hari :</label>
      				  <div class="controls">
      				    <input name="jumhari" min="0" type="number" onchange="tambah(this.form)"/>
      				  </div>
      				</div>
    			    <div class="control-group">
      				  <div class="controls">
      				    <button data-parent="#collapse-group" href="#" id="btn1" onclick="valid1(general)" data-toggle="collapse" class="btn btn-success">Lanjut</button>
      				  </div>
    				  </div>
            </div>
          </div>
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href="#" onclick="valid1(general)" id="col1" data-toggle="collapse"> <span class="icon"><i class="icon-eye-open"></i></span>
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
                      $Proses = new Apartemen($db);
          				    $show = $Proses->showApartemen();
          				    while($data = $show->fetch(PDO::FETCH_OBJ)){
                        if ($data->kd_apt != 0){
        						      echo "<option name='kd_apt' value='$data->kd_apt'>$data->nama_apt</option>";
                        }
        						  }
        					  ?>
					        </select>
				        </div>
			        </div>
			        <div class="control-group">
      				  <label class="control-label">Unit :</label>
      				  <div class="controls">
				          <select name="unit" id="unit" class="span4" onchange="biaya(this.form)">
					          <option value="">-- Pilih Unit --</option>
					        </select>
        					<div id="loading">
        						<img src="../../asset/images/loading.gif" width="18"> <small>Loading...</small>
        					</div>
				        </div>
			        </div>
              <div class="control-group" id="harga_sewa-C">
      				  <label class="control-label">Harga Sewa Weekday:</label>
      				  <div class="controls">
      				    <input name="harga_sewa" min="0"  id="harga_sewa" type="number" onChange="hasil(this.form)" />
                </div>
      			  </div>
              <div class="control-group" id="harga_sewa_we-C">
                <label class="control-label">Harga Sewa Weekend:</label>
                <div class="controls">
                  <input name="harga_sewa_we" min="0"  id="harga_sewa_we" type="number" onChange="hasil(this.form)" />
                </div>
              </div>
      				<div class="control-group">
      				  <label class="control-label">Jumlah Tamu :</label>
      				  <div class="controls">
      				    <input name="tamu" min="0" type="number" value="5" onChange="ECH(this.form)"/>
                  <input name="harga_sewa_asli" type="text" style="display:none;"/>
      				  </div>
      			  </div>
              <div class="control-group">
                <label class="control-label">Ekstra Charge :</label>
                <div class="controls">
                  <input name="ekstra_charge" min="0"  type="number" onChange="hasil(this.form)" />
                </div>
              </div>
		          <div class="control-group">
                <label class="control-label">Total Biaya :</label>
                <div class="controls">
                  <input name="total" id="total" min="0"  type="number" />
                </div>
              </div>
    			    <div class="control-group">
      				  <div class="controls">
      				    <button data-parent="#collapse-group" href="#" id="btn2" data-toggle="collapse" class="btn btn-success">Lanjut</button>
                </div>
      			   </div>
             </div>
           </div>
		       <div class="accordion-group widget-box">
             <div class="accordion-heading">
               <div class="widget-title">
                 <a data-parent="#collapse-group" href="#" id="col2" data-toggle="collapse"> <span class="icon"><i class="icon-eye-open"></i></span>
                   <h5>Booking dan DP</h5>
                 </a>
               </div>
            </div>
            <div class="collapse accordion-body" id="collapseGFive">
    			    <div class="control-group">
    				    <label class="control-label">Booking Via :</label>
    				  <div class="controls">
    				    <select id="booking_via" name="booking_via" class="span4" required>
    					    <option value="">-- Booking --</option>
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
  				    <select id="kas" name="kas" class="span4" required>
  					    <option value="">-- Kas --</option>
    					  <?php
                  $Proses = new Kas($db);
        				  $show = $Proses->showKas();
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
      						  echo "<option name='kd_kas' value='$data->kd_kas'>$data->sumber_dana</option>";
      						}
    					  ?>
  					  </select>
				    </div>
			    </div>
  				<div class="control-group">
  				  <label class="control-label">Jumlah DP :</label>
  				  <div class="controls">
  				    <input name="dp" min="0"  type="number" required/>
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

<!--modal popup tambah penyyewa baru-->
<div id="popup-penyewa-baru" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Pelanggan Baru</h3>
  </div>
  <div class="modal-body">
  <form action="../../../proses/transaksi.php" method="post" class="form-horizontal">
    <div class="control-group">
    <label class="control-label">Nama :</label>
    <div class="controls">
      <input name="nama" type="text" class="span2" placeholder="Nama" required/>
    </div>
    </div>
    <div class="control-group">
    <label class="control-label">Alamat :</label>
    <div class="controls">
      <input name="alamat" type="text" class="span2" placeholder="Alamat" required/>
    </div>
    </div>
    <div class="control-group">
      <label class="control-label">No Telpon :</label>
      <div class="controls">
        <input name="no_tlp" type="text"  class="span2" placeholder="ex: 0812...." required/>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Jenis Kelamin :</label>
      <div class="controls">
        <label>
          <input type="radio" name="jenis_kelamin" value="Laki-laki" checked/> Laki-laki
        </label>
        <label>
          <input type="radio" name="jenis_kelamin" value="Perempuan" /> Perempuan
        </label>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Email :</label>
      <div class="controls">
        <input name="email" type="text"  class="span2" placeholder="ex: abc@gmail.com" required/>
      </div>
    </div>
    <div class="control-group">
    <div class="controls">
      <input type="submit" name="addPenyewaTransaksi" class="btn btn-success">
      <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
    </div>
    </div>
  </form>
  </div>
</div>
<!-- //modal popup tambah unit-->

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; Brought to you by <a href="http://www.booking.cozzal.com">Cozzal IT</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../../asset/js/jquery.min.js"></script>
<script src="../../../asset/js/jquery.ui.custom.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<!--<script src="js/jquery.validate.js"></script> -->
<script src="../../../asset/js/jquery.wizard.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.wizard.js"></script>
<script src="../../../asset/js/transaksi.js"></script>
<script src="../../../asset/js/jquery.uniform.js"></script>
<!-- <script src="js/select2.min.js"></script> -->
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
</body>
</html>
