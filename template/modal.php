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
						<td class="width70"><strong>COZ-6546</strong></td>
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
						<td class="width70"><strong>'.$detail->harga_sewa.'</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Diskon:</td>
						<td class="width70"><strong>'.$detail->diskon.'</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Ekstra Charge:</td>
						<td class="width70"><strong>'.$detail->ekstra_charge.'</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Total Tagihan:</td>
						<td class="width70"><strong>'.$detail->total_tagihan.'</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Pembayaran DP:</td>
						<td class="width70"><strong>'.$detail->dp.'</strong></td>
					  </tr>
					  <tr>
						<td class="width30">DP Via:</td>
						<td class="width70"><strong>'.$detail->nama_bank.'</strong></td>
					  </tr>
					  <tr>
						<td class="width30">Sisa Pelunasan:</td>
						<td class="width70"><strong>'.$detail->sisa_pelunasan.'</strong></td>
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
				echo "<option name='apartemen' value='$data->kd_apt'>$data->nama_apt</option>";
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
				echo "<option name='kd_owner' value='$data->kd_owner'>$data->nama</option>";
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
		  <input name="nama" type="text" class="span2" placeholder="Nama Lengkap" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Alamat :</label>
		<div class="controls">
		  <input name="alamat" type="text" class="span2" placeholder="Alamat" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">No Telepon :</label>
		<div class="controls">
		  <input name="no_tlp" type="text" class="span2" placeholder="ex : 0812.." />
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
		  <input name="no_rek" type="text" class="span2" placeholder="No Rekening" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">E-mail :</label>
		<div class="controls">
		  <input name="email" type="text" class="span2" placeholder="Alamat E-Mail" />
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
		  <input name="nama" type="text" class="span2" placeholder="Nama" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Alamat :</label>
		<div class="controls">
		  <input name="alamat" type="text" class="span2" placeholder="Alamat" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">No Telpon :</label>
		<div class="controls">
		  <input name="no_tlp" type="text"  class="span2" placeholder="ex: 0812...."  />
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
		  <input name="nama" type="text" class="span2" placeholder="Nama" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Alamat :</label>
		<div class="controls">
		  <input name="alamat" type="text" class="span2" placeholder="Alamat" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">No Telpon :</label>
		<div class="controls">
		  <input name="no_tlp" type="text"  class="span2" placeholder="ex: 0812...."  />
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
		  <input name="nama_apt" type="text" class="span2" placeholder="Nama" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Alamat Apartemen</label>
		<div class="controls">
		  <input name="alamat_apt" type="text" class="span2" placeholder="Alamat" />
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
		  <input name="booking_via" type="text" class="span2" placeholder="Dari" />
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
		  <input name="nama_bank" type="text" class="span2" placeholder="Bank" />
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
