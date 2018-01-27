<?php
//Detail Transaksi
  if(isset($_GET['detail'])){
	$show = $Proses->editTransaksi($_GET['detail']);
	$detail = $show->fetch(PDO::FETCH_OBJ);

    echo '
	<div id="popup-detail" class="modal">
	  <div class="modal-header">
		<button id="tambah" data-dismiss="modal" class="close" type="button">×</button>
		<script type="text/javascript">
		  $(document).ready(function(){
			$("#tambah").click(function(){
			  $(".modal").addClass("hide");
			});
		  });
		</script>
		<h3>Transaksi</h3>
	  </div>
	  <div class="modal-body">
		<div class="widget-content">
		  <div class="row-fluid">
			<div class="span8">
			  <table class="">
				<tbody>
				  <script>
					function Detail(x) {
					  document.getElementById("demo").innerHTML = "hai";
					}
				  </script>
				  <tr>
					<td><h4>Detail Penyewa</h4><p id="demo"></p></td>
				  </tr>
				  <tr>
					<td>Nama</td>
					<td>: '.$detail->nama.'</td>
				  </tr>
				  <tr>
					<td>Alamat</td>
					<td>: '.$detail->alamat.'</td>
				  </tr>
				  <tr>
					<td>Jenis Kelamin</td>
					<td>: '.$detail->jenis_kelamin.'</td>
				  </tr>
				  <tr>
					<td>No Telpon</td>
					<td>: '.$detail->no_tlp.'</td>
				  </tr>
				  <tr>
					<td>E-Mail</td>
					<td>: '.$detail->email.'</td>
				  </tr>
				</tbody>
			  </table>
			</div>
		  </div>

			<div class="row-fluid">
			  <div class="span12">
				<table style="margin-top: 20px;" class="table table-bordered table-invoice">
				  <tbody>
					<tr>
					  <th colspan="2">Detail Kwitansi Penyewaan</th>
					  <tr>
						<td class="width30">Kwitansi ID:</td>
						<td class="width70"><strong>COZ-'.$detail->kd_transaksi.'</strong></td>
					  </tr>
					  <tr>
						<td>Invoice Date:</td>
						<td><strong>'.$detail->tgl_transaksi.'</strong></td>
					  </tr>
					  <tr>
						<td>Apartemen:</td>
						<td><strong>'.$detail->nama_apt.'</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Unit:</td>
						<td class="width70"><strong>'.$detail->no_unit.'</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Booking Via:</td>
						<td class="width70"><strong>'.$detail->booking_via.'</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Check In:</td>
						<td class="width70"><strong>'.$detail->check_in.'</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Check Out:</td>
						<td class="width70"><strong>'.$detail->check_out.'</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Jumlah Hari:</td>
						<td class="width70"><strong>'.$detail->hari.'</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Jumlah Tamu:</td>
						<td class="width70"><strong>'.$detail->tamu.'</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Sewa Perhari:</td>
						<td class="width70"><strong>'.number_format($detail->harga_sewa, 0, ".", ".").' IDR</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Diskon:</td>
						<td class="width70"><strong>'.number_format($detail->diskon, 0, ".", ".").' IDR</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Ekstra Charge:</td>
						<td class="width70"><strong>'.number_format($detail->ekstra_charge, 0, ".", ".").' IDR</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Total Tagihan:</td>
						<td class="width70"><strong>'.number_format($detail->total_tagihan, 0, ".", ".").' IDR</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Pembayaran DP:</td>
						<td class="width70"><strong>'.number_format($detail->dp, 0, ".", ".").' IDR</strong></td>
					  </tr>
					  <tr>
						<td class="width30">DP Via:</td>
						<td class="width70"><strong>'.$detail->nama_bank.'</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Sisa Pelunasan:</td>
						<td class="width70"><strong>'.number_format($detail->sisa_pelunasan, 0, ".", ".").' IDR</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Note:</td>
						<td class="width70"><strong>'.$detail->catatan.'</strong></td>
					  </tr>
					</tr>
				  </tbody>
				</table>
			  </div>
			</div>
		</div>
	  </div>
	</div>
	';
  }

  //detail data owner
    if(isset($_GET['detail_owner'])){
  	$show = $Proses->editOwner($_GET['detail_owner']);
  	$detail = $show->fetch(PDO::FETCH_OBJ);

      echo '
  	<div id="popup-detail" class="modal">
  	  <div class="modal-header">
		<form action="owner.php" >
			<button id="tambah" data-dismiss="modal" class="close" type="submit">×</button>
		</form>
  		<script type="text/javascript">
  		  $(document).ready(function(){
  			$("#tambah").click(function(){
  			  $(".modal").addClass("hide");
  			});
  		  });
  		</script>
  		<h3>Transaksi</h3>
  	  </div>
  	  <div class="modal-body">
  		<div class="widget-content">
  		  <div class="row-fluid">
  			<div class="span8">
  			  <table class="">
  				<tbody>
  				  <script>
  					function Detail(x) {
  					  document.getElementById("demo").innerHTML = "hai";
  					}
  				  </script>
  				  <tr>
  					<td><h4>Detail Owner</h4><p id="demo"></p></td>
  				  </tr>
  				  <tr>
  					<td>Nama</td>
  					<td>: '.$detail->nama.'</td>
  				  </tr>
  				  <tr>
  					<td>Alamat</td>
  					<td>: '.$detail->alamat.'</td>
  				  </tr>
  				  <tr>
  					<td>Jenis Kelamin</td>
  					<td>: '.$detail->jenis_kelamin.'</td>
  				  </tr>
  				  <tr>
  					<td>No Telpon</td>
  					<td>: '.$detail->no_tlp.'</td>
  				  </tr>
  				  <tr>
  					<td>E-Mail</td>
  					<td>: '.$detail->email.'</td>
  				  </tr>
  				  <tr>
  					<td>Tanggal Bergabung</td>
  					<td>: '.$detail->tgl_gabung.'</td>
  				  </tr>
  				  <tr>
  					<td>Jumlah Unit</td>
  					<td>: '.$detail->jumlah_unit.'</td>
  				  </tr>

  				  <tr>
  					<td>Bank</td>
  					<td>: '.$detail->nama_bank.'</td>
  				  </tr>
  				  <tr>
  					<td>No Rekening</td>
  					<td>: '.$detail->no_rek.'</td>
  				  </tr>
  				</tbody>
  			  </table>
  			</div>
  		  </div>
  		</div>
  	  </div>
  	</div>
  	';
    }
?>

<!--modal popup tambah unit-->
<div id="popup-unit" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Pelanggan Baru</h3>
  </div>
  <div class="modal-body">
	<form action="proses/proses_add.php" method="post" class="form-horizontal">
	  <div class="control-group">
		<label class="control-label">Apartemen :</label>
		<div class="controls">
		  <select name="apartemen" class="span2">
		  <option>--Pilih Apartemen--</option>
			<?php
      $Proses = new Proses();
      $show = $Proses->showApartemen();
      while($data = $show->fetch(PDO::FETCH_OBJ)){
        if ($data->kd_apt != 0){
          echo "<option name='apartemen' value='$data->kd_apt'>$data->nama_apt</option>";
        }
			}
			?>
		  </select>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">No Unit :</label>
		<div class="controls">
		  <input name="no_unit" type="text" class="span2" placeholder="No Unit" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Owner :</label>
		<div class="controls">
		  <select name="kd_owner" class="span2">
		  <option>--Pilih Owner--</option>
			<?php
      $show = $Proses->showOwner();
      while($data = $show->fetch(PDO::FETCH_OBJ)){
        if ($data->kd_owner != 0){
          echo "<option name='kd_owner' value='$data->kd_owner'>$data->nama</option>";
        }
			}
			?>
		  </select>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Harga Owner WD :</label>
		<div class="controls">
		  <input name="h_owner_wd" type="number" min="0" step="1000" class="span2" placeholder="Owner Week Day"  />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Harga Owner WE :</label>
		<div class="controls">
		  <input name="h_owner_we" type="number" min="0" step="1000"  class="span2" placeholder="Owner Week End"  />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Harga Sewa WD :</label>
		<div class="controls">
		  <input name="h_sewa_wd" type="number" min="0" step="1000"  class="span2" placeholder="Sewa Week Day"  />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Harga Sewa WE :</label>
		<div class="controls">
		  <input name="h_sewa_we" type="number" min="0" step="1000"  class="span2" placeholder="Sewa Week End"  />
		</div>
	  </div><div class="control-group">
		<label class="control-label">Ekstra Charge :</label>
		<div class="controls">
		  <input name="ekstra_charge" type="number" min="0" step="1000"  class="span2" placeholder="Sewa Week Day"  />
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <input type="submit" name="addUnit" class="btn btn-success" value="Submit"/>
		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
		</div>
	  </div>
	</form>
  </div>
</div>

<!-- Modal Popup Tambah Owner -->
<div id="popup-owner" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Data Owner Baru</h3>
  </div>
  <div class="modal-body">
	<form action="proses/proses_add.php" method="post" class="form-horizontal">
	  <div class="control-group">
		<label class="control-label">Nama :</label>
		<div class="controls">
		  <input name="nama" type="text" class="span2" placeholder="Nama Lengkap" required/>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Alamat :</label>
		<div class="controls">
		  <input name="alamat" type="text" class="span2" placeholder="Alamat" required/>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">No Telepon :</label>
		<div class="controls">
		  <input name="no_tlp" type="text" class="span2" placeholder="ex : 0812.." required/>
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
		<label class="control-label">Bank :</label>
		<div class="controls">
		  <select name="kd_bank">
		  <option name="" value="" >-- Pilih Bank --</option>
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
		<label class="control-label">No Rekening :</label>
		<div class="controls">
		  <input name="no_rek" type="text" class="span2" placeholder="No Rekening" required/>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">E-mail :</label>
		<div class="controls">
		  <input name="email" type="text" class="span2" placeholder="Alamat E-Mail" required/>
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <input type="submit" name="addOwner" class="btn btn-success">
		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
		</div>
	  </div>
	</form>
  </div>
</div>

<!-- Modal Popup Tambah Penyewa -->
<div id="popup-penyewa" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Pelanggan Baru</h3>
  </div>
  <div class="modal-body">
	<form action="proses/proses_add.php" method="post" class="form-horizontal">
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
			<input type="radio" name="jenis_kelamin" value="Perempuan"/> Perempuan
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
		  <input type="submit" name="addPenyewa" class="btn btn-success">
		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
		</div>
	  </div>
	</form>
  </div>
</div>

<!-- Modal Popup Tambah Penyewa di Transaksi-->
<div id="popup-penyewa-baru" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Pelanggan Baru</h3>
  </div>
  <div class="modal-body">
	<form action="proses/proses_add.php" method="post" class="form-horizontal">
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
		<div class="controls">
		  <input type="submit" name="addPenyewaTransaksi" class="btn btn-success">
		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
		</div>
	  </div>
	</form>
  </div>
</div>

<!--Modal Popup Tambah Apartemen -->
<div id="popup-apartemen" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Apartemen Baru</h3>
  </div>
  <div class="modal-body">
	<form action="proses/proses_add.php" method="post" class="form-horizontal">
	  <div class="control-group">
		<label class="control-label">Nama Apartemen</label>
		<div class="controls">
		  <input name="nama_apt" type="text" class="span2" placeholder="Nama" required/>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Alamat Apartemen</label>
		<div class="controls">
		  <input name="alamat_apt" type="text" class="span2" placeholder="Alamat" required/>
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <input type="submit" name="addApartemen" class="btn btn-success">
		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
		</div>
	  </div>
	</form>
  </div>
</div>

<!--Modal Popup Tambah Booking Via-->
<div id="popup-booking" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Data Baru</h3>
  </div>
  <div class="modal-body">
	<form action="proses/proses_add.php" method="post" class="form-horizontal">
	  <div class="control-group">
		<label class="control-label">Booking Via :</label>
		<div class="controls">
		  <input name="booking_via" type="text" class="span2" placeholder="Dari" required/>
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <input type="submit" name="addBooking_via" class="btn btn-success">
		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
		</div>
	  </div>
	</form>
  </div>
</div>

<!--Modal Tambah DP Via-->
<div id="popup-dp" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Data Baru</h3>
  </div>
  <div class="modal-body">
	<form action="proses/proses_add.php" method="post" class="form-horizontal">
	  <div class="control-group">
		<label class="control-label">Nama Bank :</label>
		<div class="controls">
		  <input name="nama_bank" type="text" class="span2" placeholder="Bank" required/>
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <input type="submit" name="addDp_via" class="btn btn-success">
		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
		</div>
	  </div>
	</form>
  </div>
</div>

<?php
//Detail Unit
  if(isset($_GET['detail_unit'])){
	$show = $Proses->showDetailUnit($_GET['detail_unit']);
	$detail = $show->fetch(PDO::FETCH_OBJ);
	echo '
		<script type="text/javascript">
		  $(document).ready(function(){
			$("#tambah").click(function(){
			  $(".modal").addClass("hide");
			});
		  });
		</script>';
	if($detail->lantai!="")
	{
	$wtr = 'Tersedia'; $dpr=$wtr; $wifi=$wtr; $tv=$dpr; $am=$tv; $roko='Boleh';
	if($detail->water_heater=='N'){
		$wtr='Tidak Tersedia';
	}
	if($detail->dapur=='N'){
		$dpr='Tidak Tersedia';
	}
	if($detail->wifi=='N'){
		$wifi='Tidak Tersedia';
	}
	if($detail->tv=='N'){
		$tv='Tidak Tersedia';
	}
	if($detail->amenities=='N'){
		$am='Tidak Tersedia';
	}
	if($detail->merokok=='N'){
		$roko='Tidak Boleh';
	}
    echo '
	<div id="popup-detail" class="modal">
	  <div class="modal-header">
  		<button id="tambah" data-dismiss="modal" class="close" type="button">×</button>
  		<h3>Fasilitas Unit '.$_GET["no_unit"].'</h3>
	  </div>
    <div class="modal-body">
  		<div class="widget-content">
  			<div class="row-fluid">
  			  <div class="span12">
    			  <a class="btn btn-primary" href="edit.php?edit_detail_unit='.$_GET["detail_unit"].'">Edit Fasilitas</a>
            <a class="btn btn-success" href="foto_unit.php">Foto Unit</a>
            <table style="margin-top: 20px;" class="table table-bordered table-invoice">
    				  <tbody>
      					<tr>
      					  <th colspan="2">Detail Fitur Unit</th>
      					  <tr>
        						<td class="width30">Lantai:</td>
        						<td class="width70"><strong>'.$detail->lantai.'</strong></td>
      					  </tr>
      					  <tr>
        						<td>Jumlah Kamar:</td>
        						<td><strong>'.$detail->jml_kmr.'</strong></td>
      					  </tr>
      					  <tr>
        						<td>Jumlah Kasur:</td>
        						<td><strong>'.$detail->jml_bed.'</strong></td>
      					  </tr>
      					  <tr>
        						<td class="width30">Dapur:</td>
        						<td class="width70"><strong>'.$dpr.'</strong></td>
      					  </tr>
      					  <tr>
        						<td class="width30">Water Heater:</td>
        						<td class="width70"><strong>'.$wtr.'</strong></td>
      					  </tr>
      					  <tr>
        						<td class="width30">Tv Cable:</td>
        						<td class="width70"><strong>'.$tv.'</strong></td>
      					  </tr>
      					  <tr>
        						<td class="width30">Wifi:</td>
        						<td class="width70"><strong>'.$wifi.'</strong></td>
      					  </tr>
      					  <tr>
        						<td class="width30">Amenities:</td>
        						<td class="width70"><strong>'.$am.'</strong></td>
      					  </tr>
      					  <tr>
        						<td class="width30">Boleh Merokok:</td>
        						<td class="width70"><strong>'.$roko.'</strong></td>
      					  </tr>
      					</tr>
    				  </tbody>
    				</table>
          </div>
        </div>
			 </div>
		</div>
	</div>
	';}
	else
	{
		echo'
			<div id="popup-detail" class="modal">
	  		<div class="modal-header">
  				<button id="tambah" data-dismiss="modal" class="close" type="button">×</button>
  				<h3>Fasilitas Unit '.$_GET["no_unit"].'</h3>
	  		</div>
        <div class="modal-body">
      		<div class="widget-content">
      			<div class="row-fluid">
      			  <div class="span12">
                Detail fasilitas pada unit ini belum tersedia!! Klik button dibawah untuk menambahkan!!
                <br>
                <br>
                <a class="btn btn-info" href="edit.php?tambah_detail_unit='.$_GET["detail_unit"].'"><i class="icon-plus"></i> Tambahkan Detail</a>
              </div>
            </div>
          </div>
        </div>
	  	</div>';
	}
}
?>
