<?php
  session_start();
  require("../../../class/calendar.php");
  require("../../../config/database.php");

  $thisPage = "Unit";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";

  if (isset($_GET['calendar_unit'])){
    $calendar = new Calendar($db);
    $show = $calendar->showNoUnit($_GET['calendar_unit']);
    $data = $show->fetch(PDO::FETCH_OBJ);
    $kd_unit = $_GET['calendar_unit'];
    $no_unit = $data->no_unit;
    $nama_apt = $data->nama_apt;
  }
?>
<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="unit.php" title="Go to Data Unit" class="tip-bottom">Data Unit</a> <a href="#" class="current">Kalender Unit <?php echo $no_unit; ?></a> </div>
    <h1>Calendar Unit
    <?php
      echo $no_unit;
      if(!isset($_POST['editCalendar']) && !isset($_POST['editBlok'])){
        echo ' ('.$nama_apt.')</h1>';
      }elseif((isset($_POST['editCalendar']) && !isset($_POST['batal'])) || isset($_POST['editBlok']) || isset($_POST['close'])){
        echo ' </h1><p class="btn-add" style="color:red;">(Mode: EDIT EVENT) *klik event untuk mengedit</p>';
      }
    ?>
    <form action="" method="POST">
      <a href="unit.php" class="btn btn-light btn-add"><i class="icon-chevron-left"></i> Kembali</a>
      <a href="#popup-blok" data-toggle="modal" class="btn btn-danger btn-add"><i class="icon-minus-sign"></i> Blok Tanggal</a>
      <a href="#popup-maintenance" data-toggle="modal" class="btn btn-warning btn-add" style="color:black;"><i class="icon-cogs"></i> Maintenance</a>
      <?php
        if((isset($_POST['editCalendar']) && !isset($_POST['batal'])) || isset($_POST['editBlok']) || isset($_POST['close'])){
          echo '
            <button type="submit" name="batal" class="btn btn-inverse btn-add"><i class="icon-minus-sign"></i> Batal</button>
          ';
        }elseif(!isset($_POST['editCalendar']) && !isset($_POST['editBlok'])){
          echo '
            <button type="submit" name="editCalendar" class="btn btn-primary btn-add"><i class="icon-pencil"></i> Edit Event</button>
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
            $('#popup-editEvent').modal('show');
            arrayNote = id.split("+")
            document.editEvent.id.value = arrayNote[0];
            document.editEvent.jenis.value = title;
            document.editEvent.awal.value = awal;
            document.editEvent.akhir.value = akhir;
            document.editEvent.catatan.value = arrayNote[1];
            hapusBlok(arrayNote[0]);
          }
          $(document).ready(function() {
            $('#calendar').fullCalendar({

                <?php
                  if(isset($_POST['editCalendar']) || isset($_POST['editBlok']) || isset($_POST['close'])){
                    echo "
                      eventClick: function(event, element) {
                        if(event.title != 'Confirm' && event.title != 'Booked') {
                          id = event.id;
                          title = event.title;
                          awal = event.start.format('DD MMM YYYY');
                          akhir = event.end.format('DD MMM YYYY');
                          popupEdit(id, title, awal, akhir);
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
            		    $show = $calendar->showCalendarBooked($_GET['calendar_unit']);
            		    while($data = $show->fetch(PDO::FETCH_OBJ)){
                      echo "
                      {
                        title: 'Booked',
                        start: '$data->check_in',
                        end: '$data->check_out',
                      },
                      ";
                    }
            		    $show = $calendar->showCalendarConfirm($_GET['calendar_unit']);
            		    while($data = $show->fetch(PDO::FETCH_OBJ)){
                      echo "
                      {
                        title: 'Confirm',
                        start: '$data->check_in',
                        end: '$data->check_out',
                        color: '#359b20'
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
                          start: '$data->start_date',
                          end: '$data->end_date',
                          color: '#faa732',
                          textColor: '#000000'
                        },
                        ";
                      }elseif($data->jenis == 2){
                        echo "
                        {
                          id: '$data->kd_mod_calendar+$data->note',
                          title: 'Block by Owner',
                          start: '$data->start_date',
                          end: '$data->end_date',
                          color: '#da4f49',
                        },
                        ";
                      }elseif($data->jenis == 3){
                        echo "
                        {
                          id: '$data->kd_mod_calendar+$data->note',
                          title: 'Block by Admin',
                          start: '$data->start_date',
                          end: '$data->end_date',
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
      var  element = document.getElementById("close");
      var popup = document.querySelectorAll(".hapus");
      element.onclick = function(){
        popup[0].classList.remove("show");
      }

      function hapusBlok(id){
        $("#hapusBlok").attr("href","../../../proses/calendar.php?delete_event="+id);
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
              <label class="control-label">Jenis :</label>
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
              <label class="control-label">Catatan :</label>
              <div class="controls">
                <input name="catatan" type="text" class="span2" disabled/>
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <input type="submit" name="editBlok" class="btn btn-primary" value="Edit" />
                <a class="btn btn-danger" id="hapusBlok">Hapus</a>
              </div>
            </div>
          </div>
        </form>
        ';
      }elseif(isset($_POST['editBlok'])){
        $calendar = new Calendar($db);
        $show = $calendar->editModCalendar($_POST['id']);
        $data = $show->fetch(PDO::FETCH_OBJ);
        echo '
        <form action="" method="post" class="form-horizontal">
          <div class="control-group">
            <div class="control-group">
              <label class="control-label hide">ID :</label>
              <div class="controls">
                <input name="id" type="text" class="span2 hide" value="'.$data->kd_mod_calendar.'" required/>
              </div>
              <label class="control-label">Tanggal Awal :</label>
              <div class="controls">
                <input name="awal" type="date" class="span2" value="'.$data->start_date.'" />
              </div>
              <label class="control-label">Tanggal Akhir :</label>
              <div class="controls">
                <input name="akhir" type="date" class="span2" value="'.$data->end_date.'" />
              </div>
              <label class="control-label">Catatan :</label>
              <div class="controls">
                <input name="catatan" type="text" class="span2" value="'.$data->note.'" />
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <button type="submit" name="" class="btn btn-success">tes button</button>
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
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../../asset/js/select2.min.js"></script>
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/jquery.uniform.js"></script>
<script src="../../../asset/js/select2.min.js"></script>
</body>
</html>
