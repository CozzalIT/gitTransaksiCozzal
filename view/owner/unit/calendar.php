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
?>
<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="unit.php" title="Go to Data Unit" class="tip-bottom">Data Unit</a> <a href="#" class="current">Kalender Unit</a> </div>
    <?php
      if (isset($_GET['calendar_unit'])){
        $arrayunit = array();
        $calendar = new Calendar($db);
        $kd_unit = $_GET['calendar_unit'];
        $show = $calendar->showNoUnit();
        while($data = $show->fetch(PDO::FETCH_OBJ)){
          if($data->kd_unit==$kd_unit){
            $no_unit = $data->no_unit;
            $nama_apt = $data->nama_apt;
            $kd_apt = $data->kd_apt;

          } else {
            $arrayunit[] = $data->kd_unit;
            $arrayunit[] = $data->no_unit." - ".$data->nama_apt;
          }
        }
      }
    ?>
    <h1>Calendar Unit <?php echo $no_unit.' ('.$nama_apt.')'; ?></h1>
    <a href="unit.php" class="btn btn-primary btn-add"><i class="icon-chevron-left"></i> Kembali</a>
    <a href="#popup-blok" data-toggle="modal" class="btn btn-danger btn-add"><i class="icon-minus-sign"></i> Blok Tanggal</a>
  </div>
  <div class="container-fluid">
    <!--
    <iframe src="https://calendar.google.com/calendar/embed?src=vf29062bpinhtpnklil5cns6bs%40group.calendar.google.com&ctz=Asia%2FJakarta" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
    -->
    <hr>
    <div class="row-fluid">
          <div class="alert alert-info" role="alert">
            Klik event untuk mengedit atau menghapus
          </div>
      <div class="span12">
        <script>
          $(document).ready(function() {
            function editPopUp(id, note, start, end){
              var b = new Date(end);
              var c = new Date();
              c.setHours(7); c.setMinutes(0); c.setSeconds(0); c.setMilliseconds(0);
              if(b>=c){
                $("#awal").val(start);
                $("#akhir").val(end);
                $("#catatan").val(note);
                $("#id").val(id);
                $("#hapusBlok").attr("href","../../../proses/calendar.php?delete_event="+id+"&status_mod=false");
                $('#popup-edit-blok').modal('show');
              } else swal("Tanggal sudah tidak bisa dirubah");
            }

            $('#calendar').fullCalendar({
              eventClick: function(event, element) {
                  alert('1');
                if(event.note !== undefined){
                    alert('2');
                  var id = event.id;
                  var note = event.note;
                  var start = event.start.format("YYYY-MM-DD");
                  var end = event.end.format("YYYY-MM-DD");
                  editPopUp(id, note, start, end);
                }
                
              }, 
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
                          id: '$data->kd_mod_calendar',
                          note: '$data->note',
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
                      }elseif($data->jenis == 4){
                        echo "
                        {
                          id: '$data->kd_mod_calendar+$data->note',
                          title: 'Block by Partner',
                          start: '".$data->start_date."T12:00:00',
                          end: '".$data->end_date."T13:00:00',
                          color: '#da4f49',
                        },
                        ";
                      } elseif($data->jenis == 5){
                          echo "
                          {
                            id: '$data->kd_mod_calendar+$data->note',
                            title: 'Kalender Lain',
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
</div>

<div id="popup-blok" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Blok Tanggal</h3>
  </div>
  <div class="modal-body">
    <form action="../../../proses/calendar.php" method="post" class="form-horizontal">
      <div class="control-group">
        <label class="control-label">Awal :</label>
        <div class="controls">
          <input id="awal1" name="awal" type="date" class="span2" required/>
        </div>
        <label class="control-label">Akhir :</label>
        <div class="controls">
          <input id="akhir1" name="akhir" type="date" class="span2" required/>
        </div>
        <label class="control-label">Catatan :</label>
        <div class="controls">
          <input name="catatan" type="text" class="span2" required/>
          <input name="kd_unit" type="text" class="span2 hide" value="<?php echo $kd_unit; ?>" required/>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <input type="submit" id="blokCalendar" name="blokCalendar" class="btn btn-success hide">
          <a class="btn btn-success" onclick="cekTanggal('blokCalendar','awal1','akhir1')" role="button" href="#">Submit</a>
          <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
          <div id="ind-blokCalendar">
            <img src="../../../asset/images/loading.gif" width="18">
            <small>Menganalisis Tanggal...</small> 
          </div>            
        </div>
      </div>
    </form>
  </div>
</div>


<div id="popup-edit-blok" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Blok Tanggal</h3>
  </div>
  <div class="modal-body">
    <form action="../../../proses/calendar.php" method="post" class="form-horizontal">
      <div class="control-group">
        <label class="control-label">Awal :</label>
        <div class="controls">
          <input id="awal" name="awal" type="date" class="span2" required/>
        </div>
        <label class="control-label">Akhir :</label>
        <div class="controls">
          <input id="akhir" name="akhir" type="date" class="span2" required/>
        </div>
        <label class="control-label">Catatan :</label>
        <div class="controls">
          <input id="catatan" name="catatan" type="text" class="span2" required/>
          <input id="id" name="id" type="text" class="span2 hide"/>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <input type="submit" id="updateModCal" name="updateModCal" class="btn btn-success hide">
          <a class="btn btn-success" onclick="cekTanggal('updateModCal','awal','akhir')" role="button" href="#">Simpan Perubahan</a>
          <a class="btn btn-danger hapus" id="hapusBlok" href="#">Hapus</a>
          <div id="ind-updateModCal">
            <img src="../../../asset/images/loading.gif" width="18">
            <small>Menganalisis Tanggal...</small> 
          </div>          
        </div>
      </div>
    </form>
  </div>
</div>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; Brought to you by <a href="http://www.booking.cozzal.com">Cozzal IT</a> </div>
</div>
<!--end-Footer-part-->
<script type="text/javascript">
  $("#ind-blokCalendar").hide();
  $("#ind-updateModCal").hide();

  function cekTanggal(id,awal,akhir){
    var unit_id = <?php echo $kd_unit; ?>;
    var start = $("#"+awal).val();
    var end = $("#"+akhir).val();
    var d1 = new Date(end);
    var d2 = new Date(start);
    var d3 = new Date();
    d3.setHours(7); d3.setMinutes(0); d3.setSeconds(0); d3.setMilliseconds(0);
    if(d1>d3 && d2>=d3){
      $("#ind-"+id).show();
      $.post("../../../proses/option_unit.php", {id1 : unit_id, tci1:start, tco1:end},
      function (data) {
        res = JSON.parse(data);
        if(res.ketersediaan=="Ada"){
          $("#"+id).click();
        } else swal(res.ketersediaan);
        $("#ind-"+id).hide();  
      });   
    } else swal("Tanggal Sudah Terlewat");   
  }
</script>
<script src="../../../asset/js/sweetalert.min.js"></script>
<script src="../../../asset/js/hapus.js"></script>
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/jquery.uniform.js"></script>
<script src="../../../asset/js/select2.min.js"></script>
</body>
</html>
