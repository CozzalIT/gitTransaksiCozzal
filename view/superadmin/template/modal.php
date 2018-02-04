<?php
	//notifikasi info bahwa detail unit kosong
	if(isset($_GET['info_unit'])){
		echo'
			<div id="popup-detail" class="modal">
	  		<div class="modal-header">
			<form action="unit.php" >
				<button id="tambah" data-dismiss="modal" class="close" type="submit">×</button>
			</form>
  				<script type="text/javascript">
		  			$(document).ready(function(){
						$("#tambah").click(function(){
			  			$(".modal").addClass("hide");
						});
		  			});
				</script>
  				<h3>Info belum tersedia</h3>
	  		</div>
        <div class="modal-body">
      		<div class="widget-content">
      			<div class="row-fluid">
      			  <div class="span12">
                Detail fasilitas pada unit ini belum tersedia!! Klik button dibawah untuk menambahkan!!
                <br>
                <br>
                <a class="btn btn-info" href="edit.php?tambah_detail_unit='.$_GET["info_unit"].'"><i class="icon-plus"></i> Tambahkan Detail</a>
              </div>
            </div>
          </div>
        </div>
	  	</div>';
	 }

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


?>