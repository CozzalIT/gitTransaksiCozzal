<?php
  require("../../../class/calendar.php");
  require("../../../../config/database.php");

  $thisPage = "Kalender";

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
    <h1>Calendar Unit </h1>
    <a href="unit.php" class="btn btn-primary btn-add"><i class="icon-chevron-left"></i> Kembali</a>
    <a href="#popup-blok" data-toggle="modal" class="btn btn-danger btn-add"><i class="icon-minus-sign"></i> Blok Tanggal</a>
  </div>
  <div class="container-fluid">
    <!--
    <iframe src="https://calendar.google.com/calendar/embed?src=vf29062bpinhtpnklil5cns6bs%40group.calendar.google.com&ctz=Asia%2FJakarta" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
    -->
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <script>
          $(document).ready(function() {
            $('#calendar').fullCalendar({
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
  	<form action="" method="post" class="form-horizontal">
  	  <div class="control-group">
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
  	  </div>
  	  <div class="control-group">
    		<div class="controls">
    		  <input type="submit" name="blokCalendar" class="btn btn-success">
    		  <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
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
<script src="../../../asset/js/select2.min.js"></script>
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/jquery.uniform.js"></script>
<script src="../../../asset/js/select2.min.js"></script>
</body>
</html>
