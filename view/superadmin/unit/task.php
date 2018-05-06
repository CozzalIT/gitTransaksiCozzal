<?php
  require("../../../class/unit.php");
  require("../../../class/task.php");
  require("../../../../config/database.php");

  $thisPage = "Unit";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Data Unit</a></div>
    <a id='popup' href="#popup-task" data-toggle="modal" class="btn btn-info btn-add"><i class="icon-plus"></i> Tambah Task</a>
    <a id='hidenbtn' href='#' style='display:none'></a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Unit</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Nama Task</th>
				          <th>Unit</th>
                  <th>Berlaku</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
        				  $Proses = new Task($db);
        				  $show = $Proses->showTask_semua();
        				  while($data = $show->fetch(PDO::FETCH_OBJ)){
            					echo "
            					  <tr class=gradeC'>
                          <td>$data->task</td>";

                          if($data->unit=="Semua"){
                            echo "<td><a href='#'>Semua Unit</a></td>";
                          } elseif($data->unit[0]=="!"){
                            echo "<td><a class='exclusions' data-content='...' id='t-$data->kd_task-$data->unit' data-placement='right' data-toggle='popover' href='#' data-original-title='Unit Exlusions'>Tidak Semua Unit</a></td>";
                          } else {
                            $arr = explode("&",$data->unit);
                            if(count($arr)<3){ //kalo unit nya cman 1
                              echo "<td><a class='one' id='t-$data->kd_task-$arr[1]' href='#'>...</a></td>";
                            } else {
                              echo "<td><a class='some' data-content='...' id='t-$data->kd_task-$data->unit' data-placement='right' data-toggle='popover' href='#' data-original-title='Unit Exlusions'>Beberapa Unit</a></td>";
                            }
                          }

            					    if($data->sifat=="Rutin"){
                            echo "<td>$data->sifat</td>";
                          } else {
                            if($data->tgl_task==null){
                              echo "<td>Telah Digunakan</td>";
                            } else {
                              echo "<td>$data->tgl_task</td>";
                            }
                          }

                      echo "    
                          <td>
                            <center>
                            <a class='btn btn-danger hapus' href='../../../proses/task.php?delete_task=$data->kd_task'>Hapus</a>
                            <a class='btn btn-info edit' id='$data->kd_task' href='#'>Edit</a>
                            </center>
                          </td>
            					  </tr>
                      ";
            			};
        				?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end-main-container-part-->

<!--modal popup tambah unit-->
<div id="popup-task" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close closes" type="button">×</button>
    <h3>Task Baru</h3>
  </div>
  <div class="modal-body">
	<form action="../../../proses/task.php" onsubmit="return validate()" id="act" method="post" class="form-horizontal">
	  <div class="control-group">
  		<label class="control-label">Nama Task :</label>
  		<div class="controls">
  		  <input name="task" id="task" type="text" class="span2" placeholder="Task" />
  		</div>
	  </div>
    <div class="control-group hidden-C" style="display: none;">
      <div class="controls">
        <input name="kd_task" id="kd_task" type="text" class="span2" />
      </div>
    </div>    
	  <div class="control-group">
  		<label class="control-label">Sasaran Unit :</label>
  		<div class="controls">
  		  <select name="unit" id="unit" class="span2">
  		  <option value="Semua">Semua Unit</option>
        <option value="Beberapa">Beberapa Unit</option>
  		  </select>
  		</div>
	  </div>
    <div class="control-group">
      <label class="control-label">Periode Waktu :</label>
      <div class="controls">
        <select name="sifat" id="sifat" class="span2">
        <option value="Rutin">Rutin</option>
        <option value="Sekali">Sekali</option>
        </select>
      </div>
    </div>
    <div id="tgl-C" class="control-group">
      <label class="control-label">Tanggal :</label>
      <div class="controls">
        <input name="tgl_task" id="tgl_task" type="date" class="span2" placeholder="Tanggal Task" />
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">
        <div class="my" style="padding-top: 0px;" id="check-stat"><input class="ck" id='has_look' type="checkbox"><p style="float: right;" id="cap-s">Exclusion Unit :</p></div>
      </label>
      <div class="controls">
        <div class="text-box">
          <div id="selected-items">
            <!--
            <div id="sel-11" class="items">12BD <a  class="mineClose">×</a></div>
            <div id="sel-12" class="items">EC 21 7 SA <a class="mineClose">×</a></div>
          -->
          </div> 
          <input id="searchh" type="text" disabled placeholder="Cari unit disini ..."/><br>
          <div id="unit-option">
            <!--contoh penuisan
            <a id="opt-1" class="items-opt"> Unit 1 </a>
            <a id="opt-2" class="items-opt"> Unit 2 </a>
            <a id="opt-3" class="items-opt"> Unit 3 </a>
            -->
          </div>
        </div>      
      </div>
    </div>        
	  <div class="control-group">
    	<div class="controls">
    	  <input type="submit" id="submit" name="addTask" class="btn btn-success" value="Tambah"/>
    	  <a data-dismiss="modal" class="btn btn-inverse closes" href="#">Cancel</a>
    	</div>
	  </div>
	</form>
  </div>
</div>
<!-- //modal popup tambah unit-->

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; Brought to you by <a href="http://www.booking.cozzal.com">Cozzal IT</a> </div>
</div>
<!--End-Footer-part-->
<link rel="stylesheet" href="../../../asset/css/task.css" />
<script src="../../../asset/js/sweetalert.min.js"></script>
<script src="../../../asset/js/hapus.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/jquery.gritter.min.js"></script>
<script src="../../../asset/js/jquery.peity.min.js"></script>
<script src="../../../asset/js/matrix.interface.js"></script>
<script src="../../../asset/js/matrix.popover.js"></script>
<script src="../../../asset/js/jquery.ui.custom.js"></script>
<!--<script src="js/jquery.uniform.js"></script> -->
<script src="../../../asset/js/select2.min.js"></script>
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>

<script>
var obj_unit = {"0":{"no_unit":"naon","nama_apt":"naon_deui"}
  <?php
    $Proses = new Unit($db);
    $show = $Proses->showUnit();
    $string_unit="";
    while($data = $show->fetch(PDO::FETCH_OBJ)){
      if ($data->kd_owner != 0){
        $string_unit .= $data->kd_unit."##";
        echo ", '$data->kd_unit':{'no_unit':'$data->no_unit', 'nama_apt':'$data->nama_apt'}"; 
      }
    }
    echo ", 'universe_unit':'$string_unit'";
  ?>
};
var x = obj_unit.universe_unit;
x = x.split("##");
for(i=0;i<x.length-1;i++){
  $('#unit-option').append("<a onclick='add_sel("+x[i]+")' id=opt-"+x[i]+" class='items-opt'>"+obj_unit[x[i]].no_unit+" - "+obj_unit[x[i]].nama_apt+"</a>");
}
$("#tgl-C").hide();
$(".popovers").popover();
</script>

<script src="../../../asset/js/task.js"></script>
</body>
<?php
  include '../template/modal.php';
?>
</html>
