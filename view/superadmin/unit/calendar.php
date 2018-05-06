<?php
  require("../../../class/calendar.php");
  require("../../../../config/database.php");

  $thisPage = "Unit";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";

  if (isset($_GET['calendar_unit'])){
    $arrayunit = array();
    $calendar = new Calendar($db);
    $kd_unit = $_GET['calendar_unit'];
    $show = $calendar->showNoUnit();
    while($data = $show->fetch(PDO::FETCH_OBJ)){
      if($data->kd_unit==$kd_unit){
        $no_unit = $data->no_unit;
        $nama_apt = $data->nama_apt;
        $cal_bnb = $data->url_bnb;
        $cal_cozzal = $data->url_cozzal;
        $kd_apt = $data->kd_apt;
        if($cal_cozzal==""){
          $cal_cozzal = "<a href='../../../proses/unit.php?newics=$kd_unit' class='btn btn-small'>Buat Link</a>";
        }
        if($cal_bnb==""){
          $cal_bnb = "Belum Tersedia";
        }
      } 
      $arrayunit[] = $data->kd_unit;
      $arrayunit[] = $data->no_unit." - ".$data->nama_apt;
    }
  }
?>

<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="unit.php" title="Go to Data Unit" class="tip-bottom">Data Unit</a> <a href="#" class="current">Kalender Unit <?php echo $no_unit; ?></a> </div>
    <h4 onclick="triger()" style="margin-left: 20px;"><?php echo "<div id='drop-sel' style='width: 50%;height: 20px;'>".$no_unit.' '.$nama_apt."</div>"; ?></h4>
    <div id="apartement-dropdown" class="hide-dropdown" style="left: 20px;">
      <input type="text" placeholder="Search.." id="keyword" onkeyup="filter()"/> <br>
      <?php
        if(count($arrayunit)>0){
          for($i=0;$i<count($arrayunit);$i+=2){
            echo '<a id="sel-'.$arrayunit[$i].'" class="content-dropdown" href="calendar.php?calendar_unit='.$arrayunit[$i].'">';
            echo $arrayunit[$i+1]."</a>";
          }
        }
      ?>
    </div>
    <?php
      if((isset($_POST['editCalendar']) && !isset($_POST['batal'])) || isset($_POST['editBlok']) || isset($_POST['close'])){
        echo '
          <div class="alert alert-info" role="alert">
            <strong>Mode edit event. </strong>Klik event untuk mengedit
          </div>
        ';
      }
    ?>
    <form action="" method="POST">
      <?php
        if((isset($_POST['editCalendar']) && !isset($_POST['batal'])) || isset($_POST['editBlok']) || isset($_POST['close'])){
          echo '
            <button type="submit" name="batal" class="btn btn-inverse btn-add" style="margin-top: 0px;"><i class="icon-minus-sign"></i> Batal</button>
          ';
        }elseif(!isset($_POST['editCalendar']) && !isset($_POST['editBlok'])){
          echo '
            <a href="unit.php" class="btn btn-light btn-add"><i class="icon-chevron-left"></i> <strong>Kembali</strong></a>
            <a href="#popup-blok" data-toggle="modal" class="btn btn-danger btn-add"><i class="icon-minus-sign"></i> <strong>Blok Tanggal</strong></a>
            <a href="#popup-maintenance" data-toggle="modal" class="btn btn-warning btn-add"><i class="icon-cogs"></i> <strong>Maintenance</strong></a>
            <a href="#popup-mod-harga" data-toggle="modal" class="btn btn-info btn-add"><i class="icon-money"></i> <strong>Edit Harga</strong></a>
            <button type="submit" name="editCalendar" class="btn btn-primary btn-add"><i class="icon-pencil"></i> <strong>Edit Event</strong></button>
          ';
        }
      ?>
    </form>
  </div>
  <div class="container-fluid">
    <!--
    <iframe src="https://calendar.google.com/calendar/embed?src=vf29062bpinhtpnklil5cns6bs%40group.calendar.google.com&ctz=Asia%2FJakarta" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
    -->
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <script>
          function popupEdit(id, title, awal, akhir){
            var lbl_sewa = document.getElementById('lbl_sewa');
            var lbl_owner = document.getElementById('lbl_owner');
            var sewa = document.getElementById('sewa');
            var owner = document.getElementById('owner');
            lbl_sewa.classList.add('hide');
            lbl_owner.classList.add('hide');
            sewa.classList.add('hide');
            owner.classList.add('hide');

            $('#popup-editEvent').modal('show');
            arrayNote = id.split("+");
            document.editEvent.id.value = arrayNote[0];
            document.editEvent.jenis.value = title;
            document.editEvent.awal.value = awal;
            document.editEvent.akhir.value = akhir;
            document.editEvent.catatan.value = arrayNote[1];
            document.editEvent.sewa.value = 0;
            document.editEvent.sewa_clone.value = 0;
            document.editEvent.owner.value = 0;
            document.editEvent.owner_clone.value = 0;
            hapusBlok(arrayNote[0], 'false');
          }
          function editModHarga(id, title, awal, akhir){
            var lbl_sewa = document.getElementById('lbl_sewa');
            var lbl_owner = document.getElementById('lbl_owner');
            var sewa = document.getElementById('sewa');
            var owner = document.getElementById('owner');
            lbl_sewa.classList.remove('hide');
            lbl_owner.classList.remove('hide');
            sewa.classList.remove('hide');
            owner.classList.remove('hide');

            $('#popup-editEvent').modal('show');
            arrayNote = id.split("+");
            document.editEvent.id.value = arrayNote[0];
            document.editEvent.jenis.value = title;
            document.editEvent.awal.value = awal;
            document.editEvent.akhir.value = akhir;
            document.editEvent.catatan.value = arrayNote[1];
            document.editEvent.sewa.value = arrayNote[2];
            document.editEvent.sewa_clone.value = arrayNote[2];
            document.editEvent.owner.value = arrayNote[3];
            document.editEvent.owner_clone.value = arrayNote[3];
            hapusBlok(arrayNote[0], 'true');
          }
          $(document).ready(function() {
            $('#calendar').fullCalendar({
                <?php
                  if(isset($_POST['editCalendar']) || isset($_POST['editBlok']) || isset($_POST['close'])){
                    echo "
                      eventClick: function(event, element) {
                        var cekTitle = event.title.split(' ');
                        if(event.title != 'Confirm' && event.title != 'Booked' && cekTitle[1] != 'IDR') {
                          id = event.id;
                          title = event.title;
                          awal = event.start.format('DD MMM YYYY');
                          akhir = event.end.format('DD MMM YYYY');
                          popupEdit(id, title, awal, akhir);
                          $('#calendar').fullCalendar('updateEvent', event);
                        }else if(cekTitle[1] == 'IDR'){
                          id = event.id;
                          title = 'Mod Harga';
                          awal = event.start.format('DD MMM YYYY');
                          akhir = event.end.format('DD MMM YYYY');
                          editModHarga(id, title, awal, akhir);
                          $('#calendar').fullCalendar('updateEvent', event);
                        }
                      },
                    ";
                  }
                ?>
              header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listMonth'
              },
              defaultDate: '<?php echo date('Y-m-d')?>',
              navLinks: true, // can click day/week names to navigate views
              businessHours: true, // display business hours
              editable: true,
              events: [
                <?php
                  if (isset($_GET['calendar_unit'])){
            		    $show = $calendar->showCalendar($_GET['calendar_unit']);
            		    while($data = $show->fetch(PDO::FETCH_OBJ)){
                      if($data->status == '1'){
                        echo "
                        {
                          title: 'Booked',
                          start: '$data->check_in',
                          end: '$data->check_out',
                        },
                        ";
                      }
                    }
            		    $show = $calendar->showCalendar($_GET['calendar_unit']);
            		    while($data = $show->fetch(PDO::FETCH_OBJ)){
                      if($data->status == '42' or $data->status == '41'){
                        echo "
                        {
                          title: 'Confirm',
                          start: '$data->check_in',
                          end: '$data->check_out',
                          color: '#359b20'
                        },
                        ";
                      }
                    }
                    $show = $calendar->showModHarga($_GET['calendar_unit']);
            		    while($data = $show->fetch(PDO::FETCH_OBJ)){
                      echo "
                      {
                        id: '$data->kd_mod_harga+$data->note+$data->harga_sewa+$data->harga_owner',
                        title: '".number_format($data->harga_sewa, 0, ".", ".")." IDR',
                        start: '".$data->start_date."T12:00:00',
                        end: '".$data->end_date."T13:00:00',
                        color: '#f48342'
                      },
                      ";
                    }
                    $show = $calendar->showModCalendar($_GET['calendar_unit']);
            		    while($data = $show->fetch(PDO::FETCH_OBJ)){
                      if($data->jenis == 1 ){
                        echo "
                        {
                          id: '$data->kd_mod_calendar+$data->note',
                          title: 'Maintenance',
                          start: '".$data->start_date."T12:00:00',
                          end: '".$data->end_date."T13:00:00',
                          color: '#faa732',
                          textColor: '#000000'
                        },
                        ";
                      }elseif($data->jenis == 2){
                        echo "
                        {
                          id: '$data->kd_mod_calendar+$data->note',
                          title: 'Block by Owner',
                          start: '".$data->start_date."T12:00:00',
                          end: '".$data->end_date."T13:00:00',
                          color: '#da4f49',
                        },
                        ";
                      }elseif($data->jenis == 3){
                        echo "
                        {
                          id: '$data->kd_mod_calendar+$data->note',
                          title: 'Block by Admin',
                          start: '".$data->start_date."T12:00:00',
                          end: '".$data->end_date."T13:00:00',
                          color: '#da4f49',
                        },
                        ";
                      }
                    }
                  }
                ?>
                // red areas where no events can be dropped
                {
                  start: '2017-12-24',
                  end: '2017-12-28',
                  overlap: false,
                  rendering: 'background',
                  color: '#ff9f89'
                },
                {
                  start: '2017-12-06',
                  end: '2017-12-08',
                  overlap: false,
                  rendering: 'background',
                  color: '#ff9f89'
                }
              ]
            });
          });
        </script>
        <div id='calendar'></div>
      </div>
    </div>
  </div>
  <?php include 'calendar_option.php'; ?>
</div>

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

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; Brought to you by <a href="http://www.booking.cozzal.com">Cozzal IT</a> </div>
</div>
<!--end-Footer-part-->
<script>
  var harga_sewa = document.getElementById("harga_sewa");
  var harga_owner = document.getElementById("harga_owner");
  var label_harga_sewa = document.getElementById("label_harga_sewa");
  var label_harga_owner = document.getElementById("label_harga_owner");

  function hargaBaru(){
    label_harga_sewa.classList.remove("hide");
    label_harga_owner.classList.remove("hide");
    harga_sewa.classList.remove("hide");
    harga_owner.classList.remove("hide");
  }

  function hargaWeekend(){
    label_harga_sewa.classList.add("hide");
    label_harga_owner.classList.add("hide");
    harga_sewa.classList.add("hide");
    harga_owner.classList.add("hide");
  }
</script>
<script src="../../../asset/js/select2.min.js"></script>
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/jquery.uniform.js"></script>
<script src="../../../asset/js/select2.min.js"></script>
</body>
</html>
