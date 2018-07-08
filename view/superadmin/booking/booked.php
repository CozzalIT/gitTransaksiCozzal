<?php
  require("../../../class/booking.php");
  require("../../../../config/database.php");

  $thisPage = "Booking Request";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Booking Resuest</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <h3>Booked by Other</h3>
        <hr>
        <div class="refresh-blok" style="text-align: right;">
            <a style="text-align: right;" href="#" class="btn btn-light"><i class="icon-refresh"></i> <strong>Refresh</strong></a>
            <a id="p" href="#popup-task"  data-toggle="modal" style="text-decoration:none;cursor: pointer;"></a>
        </div>
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Masuk</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>No Telpon</th>
                  <th>Apartemen</th>
                  <th>Unit</th>
                  <th>Check In</th>
                  <th>Check Out</th>
                  <th>Booked By</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $Proses = new Booking($db);
                  $show = $Proses->showBooked_byURL();
                  $i = 1;
                  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    if($data->status=='1'){
                      if($data->title!="")
                        $title = $data->title;
                      else
                        $title = 'Unlisted';
                      echo "
                        <tr class=gradeC'>
                          <td>$i</td>
                          <td>$data->penyewa</td>
                          <td>$data->no_tlp</td>
                          <td>$data->nama_apt</td>
                          <td>$data->no_unit</td>
                          <td>$data->check_in</td>
                          <td>$data->check_out</td>
                          <td>$title</td>
                          <td>
                            <a class='btn btn-success' href='booked_penyewa.php?kd_booked=$data->kd_booked'>Transaksi</a>
                            <a class='btn btn-danger hapus' href='../../../proses/booked.php?hapus=$data->kd_booked&unit=$data->kd_unit&ci=$data->check_in'>Hapus</a>
                          </td>
                        </tr>
                      ";
                      $i++;
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; Brought to you by <a href="http://www.booking.cozzal.com">Cozzal IT</a> </div>
</div>

<!--end-Footer-part-->

<div id="popup-task" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Detail Progres</h3>
  </div>
    <!--Note Part-->
    <div id="note-induk">
      <div class="widget-title" id="note-bar" style="cursor:pointer;"> <span class="icon"><i class="icon-list-ul"></i></span>
        <h5 id="note-cap">List Unit</h5>
      </div>
      <div id="note-anak">
        <div class="control-group newpadd" style="max-height: 200px;">
          <div id="note-anak-isi">
            <!-- Dynamic Element -->
          </div>
        </div>
        <p style="margin: 5px"></p>
      </div>
    </div>
</div>
<!-- //modal popup tambah unit-->

<script type="text/javascript">
  var unit_arr = new Array();
  $("#p").hide();

  function setStatus(s){
    $('p').text(s);
    $('#p').text(s);
  }

  function refresh(i, max_i){
    $("#"+i).attr("class","icon-refresh");
    hit = i+1; max = max_i+1;
    setStatus("Mensinkronkan unit ke-"+hit+" dari "+max+" unit ...");
    a = unit_arr[i];
    $.post("../../../proses/ics.php", {
      generateAll : a.kd_unit,
      kd_apt : a.kd_apt
    },
    function (data) {
      $("#"+i).attr("class","icon-ok");
      if(i==max_i){
        setStatus("Sinkronisasi selesai");
        window.location = "booked.php";
      } else {
        $("#"+i).attr("class","icon-ok");
        refresh(hit, max_i);
      }
    });
  }

  $(".btn-light").click(function(){
    $(this).hide();
    setStatus("Mengambil data unit ...");
    $("#p").show();
    $.post("../../../proses/booked.php", {get_ListUnit : '1'},
    function (data) {
      response = JSON.parse(data);
      var a = response.prop.split(" ^ ");
      for(i=0;i<a.length;i++){
        b = a[i].split(" * ");
        c = {kd_unit: b[0], kd_apt: b[1]};
        unit_arr[i] = c;
        $("#note-anak-isi").append('<div class="note"><span class="icon"><i id="'+i+'" class="icon-time"></i></span>  '+b[2]+' - '+b[3]+'</div>');
      }
      $('#p').click();
      refresh(0, a.length-1);
    });

  });
</script>

<script src="../../../asset/js/sweetalert.min.js"></script>
<script src="../../../asset/js/hapus.js"></script>
<script src="../../../asset/js/jquery.min.js"></script>
<script src="../../../asset/js/jquery.ui.custom.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/jquery.uniform.js"></script>
<script src="../../../asset/js/select2.min.js"></script>
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
</body>
</html>
