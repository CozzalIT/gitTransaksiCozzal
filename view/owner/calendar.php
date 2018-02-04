<?php
  session_start();

  if(!isset($_SESSION['username'])) {
    header('location:index.php');
  }else {
    $username = $_SESSION['username'];
  }

  $thisPage = "Unit";

  include "template/head.php";
?>
<body>
<?php
  include "template/header.php";
  include "template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"><a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Sample pages</a> <a href="#" class="current">Calendar</a></div>
    <h1>Calendar</h1>
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
                <?php
                  if (isset($_GET['calendar_unit'])){
                    require("proses/proses.php");
                    require("config/database.php");
          				  $Proses = new Proses($db);
            		    $show = $Proses->showTransaksiUnit($_GET['calendar_unit']);
            		    while($data = $show->fetch(PDO::FETCH_OBJ)){
                      echo "
                      {
                        title: 'Booked',
                        start: '$data->check_in',
                        end: '$data->check_out',
                      },
                      ";
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
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
</body>
</html>
