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
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
	    <form class="form-horizontal">
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
                <form method="post">
				<ul class="bs-docs-tooltip-examples">
                  <li><button name="penyewaBaru" class="btn btn-success">Penyewa Baru</button> </li>
                  <li><button href="#popup-penyewa" data-toggle="modal" class="btn btn-success">Penyewa Lama</button> </li>
				</ul>
				</form>
			  </div>
			  <?php
			  if(isset($_POST['penyewaBaru'])){
				  echo '
			  <div class="widget-content">
			    
				  <div class="control-group">
				    <label class="control-label">ID :</label>
				    <div class="controls">
				      <input name="kd_penyewa" type="text" class="span3" placeholder="ID" />
				    </div>
			      </div>
			      <div class="control-group">
				    <label class="control-label">Nama :</label>
				    <div class="controls">
				      <input name="nama" type="text" class="span3" placeholder="Nama" />
				    </div>
			      </div>
			      <div class="control-group">
				    <label class="control-label">Alamat :</label>
				    <div class="controls">
				      <input name="alamat" type="text" class="span3" placeholder="Alamat" />
				    </div>
			      </div>
			      <div class="control-group">
			  	    <label class="control-label">No Telpon :</label>
				    <div class="controls">
				      <input name="no_tlp" type="text"  class="span3" placeholder="ex: 0812...."  />
				    </div>
			      </div>
			      <div class="control-group">
				    <label class="control-label">Jenis Kelamin :</label>
				    <div class="controls">
				      <label>
					    <input type="radio" name="jenis_kelamin" value="Laki-laki" /> Laki-laki
				      </label>
				      <label>
					    <input type="radio" name="jenis_kelamin" value="Perempuan" /> Perempuan
				      </label>
				    </div>
			      </div>
			      <div class="control-group">
				    <div class="controls">
					  <button data-parent="#collapse-group" href="#collapseUnit" data-toggle="collapse" class="btn btn-success">Lanjut</button>
					</div>
			      </div>
			   
			  </div>';}
			  ?>
			  <?php
			    if(isset($_POST['penyewaLama'])){
					
				  $Proses = new Proses();
				  $show = $Proses->editPenyewa($_GET['edit']);
				  $edit = $show->fetch(PDO::FETCH_OBJ);
				  echo '
			  <div class="widget-content">
			    
				  <div class="control-group">
				    <label class="control-label">ID :</label>
				    <div class="controls">
				      <input name="kd_penyewa" type="text" class="span3" placeholder="ID" />
				    </div>
			      </div>
			      <div class="control-group">
				    <label class="control-label">Nama :</label>
				    <div class="controls">
				      <input name="nama" type="text" class="span3" placeholder="Nama" value="'.$edit->nama.'"/>
				    </div>
			      </div>
			      <div class="control-group">
				    <label class="control-label">Alamat :</label>
				    <div class="controls">
				      <input name="alamat" type="text" class="span3" placeholder="Alamat" />
				    </div>
			      </div>
			      <div class="control-group">
			  	    <label class="control-label">No Telpon :</label>
				    <div class="controls">
				      <input name="no_tlp" type="text"  class="span3" placeholder="ex: 0812...."  />
				    </div>
			      </div>
			      <div class="control-group">
				    <label class="control-label">Jenis Kelamin :</label>
				    <div class="controls">
				      <label>
					    <input type="radio" name="jenis_kelamin" value="Laki-laki" /> Laki-laki
				      </label>
				      <label>
					    <input type="radio" name="jenis_kelamin" value="Perempuan" /> Perempuan
				      </label>
				    </div>
			      </div>
			      <div class="control-group">
				    <div class="controls">
					  <button data-parent="#collapse-group" href="#collapseUnit" data-toggle="collapse" class="btn btn-success">Lanjut</button>
					</div>
			      </div>
			   
			  </div>';}
			  ?>
            </div>
          </div>
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseUnit" data-toggle="collapse"> <span class="icon"><i class="icon-eye-open"></i></span>
                <h5>Pilih Unit</h5>
                </a> </div>
            </div>
            <div class="collapse accordion-body" id="collapseUnit">
			  
				<div class="control-group" id="form_apt" name="form_apt" onsubmit="return false">
				  
				    <label class="control-label">Apartemen :</label>
				  
				  <div class="controls" id="form_apt" name="form_apt">
					<select id="apartemen" name="apartemen" class="span4">
					  <option value="">-- Pilih Apartemen --</option>
					  <?php
						include "config.php";
					
						$sql = $pdo->prepare("SELECT * FROM tb_apt ORDER BY nama_apt");
						$sql->execute();
					
						while($data = $sql->fetch()){
						  echo "<option name='kd_apt' value='".$data['kd_apt']."'>".$data['nama_apt']."</option>";
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
				  <label class="control-label">Jumlah Tamu :</label>
				  <div class="controls">
				    <input type="number" />
				  </div>
			    </div>
			    <div class="control-group">
				  <div class="controls">
				    <button data-parent="#collapse-group" href="#collapseGFour" data-toggle="collapse" class="btn btn-success">Lanjut</button>
				 </div>
			   </div>
			  
            </div>
          </div>
		  <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGFour" data-toggle="collapse"> <span class="icon"><i class="icon-eye-open"></i></span>
                <h5>Pilih Tanggal</h5>
                </a> </div>
            </div>
            <div class="collapse accordion-body" id="collapseGFour">
              <form action="proses/add/add_penyewa.php" method="post" class="form-horizontal">
			    <div class="control-group">
				  <label class="control-label">Check In :</label>
				  <div class="controls">
				    <input type="date" />
				  </div>
			    </div>
				<div class="control-group">
				  <label class="control-label">Check Out :</label>
				  <div class="controls">
				    <input type="date" />
				  </div>
			    </div>
				<div class="control-group">
				  <label class="control-label">Harga Sewa :</label>
				  <div class="controls">
				    <input type="number" />
				  </div>
			    </div>
				<div class="control-group">
				  <label class="control-label">Ekstra Charge :</label>
				  <div class="controls">
				    <input type="number" />
				  </div>
			    </div>
			    <div class="control-group">
				  <div class="controls">
				    <button data-parent="#collapse-group" href="#collapseGFive" data-toggle="collapse" class="btn btn-success">Lanjut</button>
				 </div>
			   </div>
			  </form>
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
				    <select>
					  <option>tes1</option>
					  <option>tes2</option>
					</select>
				  </div>
			    </div>
			    <div class="control-group">
				  <label class="control-label">DP Via :</label>
				  <div class="controls">
				    <select>
					  <option>tes1</option>
					  <option>tes2</option>
					</select>
				  </div>
			    </div>
				<div class="control-group">
				  <label class="control-label">Jumlah DP :</label>
				  <div class="controls">
				    <input type="number" />
				  </div>
			    </div>
			    <div class="control-group" >
				  <div class="controls">
				    <input type="submit" name="" class="btn btn-success">
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

<div id="popup-penyewa" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Pelanggan Baru</h3>
  </div>
  <div class="modal-body">
	<div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Penyewa</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>No Telpon</th>
				  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
				  $Proses = new Proses();
				  $show = $Proses->showPenyewa();
				  while($data = $show->fetch(PDO::FETCH_OBJ)){
					echo "
					  <tr class=gradeC'>
					    <td>$data->nama</td>
					    <td>$data->alamat</td>
						<td>$data->no_tlp</td>
						<form method='post'>
						<td>
						  <button name='penyewaLama' class='btn btn-success' href='transaksi.php?edit=$data->kd_penyewa'>Pilih</button>
						</td>
						</form>
					  </tr>";
				  };
				?>
              </tbody>
            </table>
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
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/jquery.wizard.js"></script>
<script src="js/matrix.js"></script>
<script src="js/matrix.wizard.js"></script>

<script src="js/jquery.uniform.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/matrix.tables.js"></script>
</body>
</html>
