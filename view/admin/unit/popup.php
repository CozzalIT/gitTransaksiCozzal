
<!-- Popup blok kalender -->
<div id="popup-blok" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Blok Tanggal</h3>
  </div>
  <form action="../../../proses/calendar.php" method="post" class="form-horizontal">
    <div class="modal-body">
  	  <label class="control-label">Awal :</label>
    	<div class="controls">
    		 <input name="awal" type="date" class="span2" required/>
    	</div>
      <label class="control-label">Akhir :</label>
      <div class="controls">
        <input name="akhir" type="date" class="span2" required/>
      </div>
      <label class="control-label">Catatan :</label>
      <div class="controls">
        <input name="catatan" type="text" class="span2" required/>
        <input name="kd_unit" type="text" class="span2 hide" value="<?php echo $kd_unit; ?>" required/>
      </div>
      <div class="control-group">
        <div class="controls">
          <input type="submit" name="blokCalendar" class="btn btn-success">
          <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- popup maintenance -->
<div id="popup-maintenance" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Maintenance</h3>
  </div>
  <div class="modal-body">
  	<form action="../../../proses/calendar.php" method="post" class="form-horizontal">
  	  <div class="control-group">
  		  <label class="control-label">Awal : </label>
    		<div class="controls">
    		  <input name="awal" type="date" class="span2" required/>
    		</div>
        <label class="control-label">Akhir :</label>
        <div class="controls">
          <input name="akhir" type="date" class="span2" required/>
        </div>
        <label class="control-label">Catatan :</label>
        <div class="controls">
          <input name="catatan" type="text" class="span2" required/>
          <input name="kd_unit" type="text" class="span2 hide" value="<?php echo $kd_unit; ?>" required/>
        </div>
  	  </div>
  	  <div class="control-group">
    		<div class="controls">
    		  <input type="submit" name="addMaintenance" class="btn btn-success">
    		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
    		</div>
  	  </div>
  	</form>
  </div>
</div>

<!-- popup mod harga -->
<div id="popup-mod-harga" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Edit Harga</h3>
  </div>
  <div class="modal-body">
  	<form action="../../../proses/calendar.php" method="post" class="form-horizontal">
  	  <div class="control-group">
  		  <label class="control-label">Unit : </label>
    		<div class="controls">
    		  <input name="unit" type="text" class="span2" value="<?php echo $no_unit.' ('.$nama_apt.')'; ?>" disabled/>
    		</div>
        <label class="control-label">Awal : </label>
    		<div class="controls">
    		  <input name="awal" type="date" class="span2" required/>
    		</div>
        <label class="control-label">Akhir : </label>
    		<div class="controls">
    		  <input name="akhir" type="date" class="span2" required/>
    		</div>
        <label class="control-label">Catatan : </label>
    		<div class="controls">
    		  <input name="note" type="text" class="span2" required/>
    		</div>
        <label class="control-label">Edit Harga :</label>
        <div class="controls">
          <input type="radio" name="jenis" value="hargaWeekend" onclick="(this.checked ? hargaWeekend() : '')" required> Harga Weekend<br>
          <input type="radio" name="jenis" value="hargaBaru" onclick="(this.checked ? hargaBaru() : '')" required> Harga Baru
        </div>
        <label id="label_harga_sewa" class="control-label hide">Harga Sewa :</label>
        <div class="controls">
          <input name="harga_sewa" id="harga_sewa" type="number" class="span2 hide" value="0" required/>
        </div>
        <label id="label_harga_owner" class="control-label  hide">Harga Owner:</label>
        <div class="controls">
          <input name="harga_owner" id="harga_owner" type="number" class="span2 hide" value="0" required/>
        </div>
  	  </div>
      <input name="kd_unit" type="text" class="span2 hide" value="<?php echo $kd_unit; ?>" required/>
  	  <div class="control-group">
    		<div class="controls">
    		  <input type="submit" name="addModHarga" value="Submit" class="btn btn-success">
    		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
    		</div>
  	  </div>
  	</form>
  </div>
</div>

<!-- popup edit event -->
<div id="popup-editEvent" class="hapus modal hide <?php if(isset($_POST['editBlok'])){ echo 'show'; }?>">
  <div class="modal-header">
    <form action="" method="post">
      <button id="close" name="close" data-dismiss="modal" class="close" type="submit">×</button>
    </form>
    <?php
      if(isset($_POST['close'])){
        unset($_COOKIE['editBlok']);
      }
    ?>
    <script type="text/javascript">
      var element = document.getElementById("close");
      var popup = document.querySelectorAll(".hapus");
      element.onclick = function(){
        popup[0].classList.remove("show");
      }
      function hapusBlok(id, modHarga){
        $("#hapusBlok").attr("href","../../../proses/calendar.php?delete_event="+id+"&status_mod="+modHarga);
      }
    </script>
    <h3>Edit Event</h3>
  </div>
  <div class="modal-body">
    <?php
      if(!isset($_POST['editBlok'])){
        echo '
        <form name="editEvent" action="" method="post" class="form-horizontal">
          <div class="control-group">
            <div class="control-group">
              <label class="control-label hide">ID :</label>
              <div class="controls">
                <input name="id" type="text" class="span2 hide"/>
              </div>
              <label id="lbl_jenis" class="control-label">Jenis :</label>
              <div class="controls">
                <input name="jenis" type="text" class="span2" disabled/>
              </div>
              <label class="control-label">Tanggal Awal :</label>
              <div class="controls">
                <input name="awal" type="text" class="span2" disabled/>
              </div>
              <label class="control-label">Tanggal Akhir :</label>
              <div class="controls">
                <input name="akhir" type="text" class="span2" disabled/>
              </div>
              <label id="lbl_sewa" class="control-label">Harga Sewa :</label>
              <div id="sewa" class="controls">
                <input name="sewa" type="text" value="0" class="span2 hide" />
                <input name="sewa_clone" type="text" value="0" class="span2" disabled/>
              </div>
              <label id="lbl_owner" class="control-label">Harga Owner :</label>
              <div id="owner" class="controls">
                <input name="owner" type="text" value="0" class="span2 hide" />
                <input name="owner_clone" type="text" value="0" class="span2" disabled/>
              </div>
              <label class="control-label">Catatan :</label>
              <div class="controls">
                <input name="catatan" type="text" class="span2" disabled/>
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <input type="submit" id="editBlok" name="editBlok" class="btn btn-primary" value="Edit" />
                <a class="btn btn-danger" id="hapusBlok">Hapus</a>
              </div>
            </div>
          </div>
        </form>
        ';
      }elseif(isset($_POST['editBlok'])){
        $calendar = new Calendar($db);
        if($_POST['sewa'] == 0 && $_POST['owner'] == 0){
          $show = $calendar->editModCalendar($_POST['id']);
          $data = $show->fetch(PDO::FETCH_OBJ);
          $kode = $data->kd_mod_calendar;
          $modHarga = false;
        }elseif($_POST['sewa'] != 0 && $_POST['owner'] != 0){
          $show = $calendar->editModHarga($_POST['id']);
          $data = $show->fetch(PDO::FETCH_OBJ);
          $kode = $data->kd_mod_harga;
          $modHarga = true;
        }
        echo '
        <form action="../../../proses/calendar.php" method="post" class="form-horizontal">
          <div class="control-group">
            <div class="control-group">
              <label class="control-label hide">ID :</label>
              <div class="controls">
                <input name="id" type="text" class="span2 hide" value="'.$kode.'" required/>
              </div>
              <label class="control-label">Tanggal Awal :</label>
              <div class="controls">
                <input name="awal" type="date" class="span2" value="'.$data->start_date.'" />
              </div>
              <label class="control-label">Tanggal Akhir :</label>
              <div class="controls">
                <input name="akhir" type="date" class="span2" value="'.$data->end_date.'" />
              </div>
        ';
        if($modHarga == true){
          echo '
              <label class="control-label">Harga Sewa :</label>
              <div class="controls">
                <input name="sewa" type="number" class="span2" value="'.$data->harga_sewa.'" />
              </div>
              <label class="control-label">Harga Owner :</label>
              <div class="controls">
                <input name="owner" type="number" class="span2" value="'.$data->harga_owner.'" />
              </div>
          ';
        }
        echo '
              <label class="control-label">Catatan :</label>
              <div class="controls">
                <input name="catatan" type="text" class="span2" value="'.$data->note.'" />
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                '.($modHarga == true ? '<button type="submit" name="updateModHarga" class="btn btn-success">Update</button>' : '<button type="submit" name="updateModCal" class="btn btn-success">Update</button>').'
              </div>
            </div>
          </div>
        </form>
        ';
      }
    ?>
  </div>
</div>

<!-- popup tambah dan kelola url -->
<div id="popup-URL" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3 id="url-cap">Tambah URL</h3>
  </div>
  <div class="modal-body">
    <form action="../../../proses/calendar.php" onsubmit="return insertURLid()" method="post" class="form-horizontal">
      <div class="control-group" id="url_Form">
        <label class="control-label">Nama URL :</label>
        <div class="controls">
          <input id="nama_url" name="nama_url" type="text" class="span2" required/>
        </div>   
        <label class="control-label">URL :</label>
        <div class="controls">
          <input name="url" id="url" type="text" class="span2" required/>
        </div>
        <label class="control-label">Frekuensi Update per Jam :</label>
        <div class="controls">
          <select id="group_update" name="group_update" class="span2" required="">
            <option value="">--Pilih Frekuensi--</option>s 
            <option value="1">20 menit pertama</option>
            <option value="2">20 menit kedua</option>
            <option value="3">20 menit ketiga</option>
          </select>
        </div>      
      </div>
      <div class="control-group">
        <div class="controls">
          <input value="Simpan" id="submitURL" type="submit" name="addURL" class="btn btn-success">
          <a data-dismiss="modal" class="btn btn-inverse" href="#">Batal</a>
        </div>
      </div>
    </form>
  </div>
</div>