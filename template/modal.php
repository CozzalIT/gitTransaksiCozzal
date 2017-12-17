<?php
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
						<td class="width70"><strong>'.$detail->via.'</strong></td>
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
?>

<!--modal popup tambah unit-->
<div id="popup-unit" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Pelanggan Baru</h3>
  </div>
  <div class="modal-body">
	<form action="proses/add/add_penyewa.php" method="post" class="form-horizontal">
	  <div class="control-group">
		<label class="control-label">Apartemen :</label>
		<div class="controls">
		  <select>
		  <option name="" value="">-- Pilih Apartemen --</option>
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
		<label class="control-label">No Unit :</label>
		<div class="controls">
		  <input name="no_unit" type="text" class="span2" placeholder="No Unit" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Harga Owner WD :</label>
		<div class="controls">
		  <input name="h_owner_wd" type="text"  class="span2" placeholder="Owner Week Day"  />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Harga Owner WE :</label>
		<div class="controls">
		  <input name="h_owner_we" type="text"  class="span2" placeholder="Owner Week End"  />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Harga Sewa WD :</label>
		<div class="controls">
		  <input name="h_sewa_wd" type="text"  class="span2" placeholder="Sewa Week Day"  />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Harga Sewa WE :</label>
		<div class="controls">
		  <input name="h_sewa_wd" type="text"  class="span2" placeholder="Sewa Week End"  />
		</div>
	  </div><div class="control-group">
		<label class="control-label">Ekstra Charge :</label>
		<div class="controls">
		  <input name="ekstra_charge" type="text"  class="span2" placeholder="Sewa Week Day"  />
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