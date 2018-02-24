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
?>
