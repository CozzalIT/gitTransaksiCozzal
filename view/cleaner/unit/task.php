<?php
  require("../../../class/unit.php");
  require("../../../class/task.php");
  require("../../../../config/database.php");

  $thisPage = "Task";

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
                  <th>Sifat</th>
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
                          <td>$data->task</td>
            					    <td>Semua Unit</td>
            						  <td>$data->sifat</td>
                          <td>
                            <center>
                            <a class='btn btn-danger hapus' href='../../../proses/task.php?delete_task=$data->kd_task'>Hapus</a>
                            <a class='btn btn-info edit' id='$data->kd_task' href='#'>Edit</a>
                            </center>
                          </td>
            					  </tr>
                      ";
            			};
                  $show2 = $Proses->showTask_unit();
                  while($data = $show2->fetch(PDO::FETCH_OBJ)){
                      echo "
                        <tr class=gradeC'>
                          <td>$data->task</td>
                          <td>$data->no_unit - $data->nama_apt</td>
                          <td>$data->sifat</td>
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
	<form action="../../../proses/task.php" id="act" method="post" class="form-horizontal">
	  <div class="control-group">
  		<label class="control-label">Nama Task :</label>
  		<div class="controls">
  		  <input name="task" id="task" type="text" class="span2" placeholder="Task" />
        <input name="kd_task" id="kd_task" type="text" class="span2" style="display:none;" />
  		</div>
	  </div>
	  <div class="control-group">
  		<label class="control-label">Untuk Unit :</label>
  		<div class="controls">
  		  <select name="unit" id="unit" class="span2">
  		  <option value="Semua">Semua Unit</option>
  			<?php
          $Proses = new Unit($db);
          $show = $Proses->showUnit();
          while($data = $show->fetch(PDO::FETCH_OBJ)){
            if ($data->kd_owner != 0){
              echo "<option value='$data->kd_unit'>$data->no_unit - $data->nama_apt</option>";
            }
    			}
  			?>
  		  </select>
  		</div>
	  </div>
    <div class="control-group">
      <label class="control-label">Sifat :</label>
      <div class="controls">
        <select name="sifat" id="sifat" class="span2">
        <option value="Rutin">Rutin</option>
        <option value="Sekali">Sekali</option>
        </select>
      </div>
    </div>
	  <div class="control-group">
		<div class="controls">
		  <input type="submit" id="submit" name="addTask" class="btn btn-success" value="Submit"/>
		  <a data-dismiss="modal" class="btn btn-inverse closes" href="#">Cancel</a>
		</div>
	  </div>
	</form>
  </div>
</div>
<!-- //modal popup tambah unit-->

<script>
$('.edit').click(function(){
  var i = $(this).attr('id');
    $.ajax({
      type: "POST", 
      url: "../../../proses/task.php", 
      data: {id : i}, 
      dataType: "json",
      beforeSend: function(e) { 
        if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
        }
      },
      success: function(response){ 
          $("#task").val(response.task);
          $("#unit").val(response.unit);
          $("#sifat").val(response.sifat);
          $("#kd_task").val(i);
          $("#submit").attr('name','updateTask');
          $("#popup").click();
      },
      error: function (xhr, ajaxOptions, thrownError) { 
        alert(thrownError); 
      }
    });  
});

$('.closes').click(function(){
  $("#submit").attr('name','addTask');
  $("#kd_task").val('null');

});
</script>


<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--End-Footer-part-->
<script src="../../../asset/js/sweetalert.min.js"></script>
<script src="../../../asset/js/hapus.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/unit.js"></script>
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
</body>
<?php
  include '../template/modal.php';
?>
</html>
