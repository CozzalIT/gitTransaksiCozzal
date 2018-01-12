<?php
  session_start();

  if(!isset($_SESSION['username'])) {
    header('location:login.php');
  }else {
    $username = $_SESSION['username'];
  }

  $thisPage = "Owner";

  include "template/head.php";
?>
<body>
<?php
  include "template/header.php";
  include "template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <a href="#popup-owner" data-toggle="modal" class="btn btn-info btn-add"><i class="icon-plus"></i> Tambah Data</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Owner</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
				  <th>Alamat</th>
				  <th>No Telepon</th>
                  <th>E-mail</th>
				  <th>Action</th>
				</tr>
              </thead>
              <tbody>
                <?php
				  require("proses/proses.php");
				  $Proses = new Proses();
				  $i = 1;
				  $show = $Proses->showOwner();
				  while($data = $show->fetch(PDO::FETCH_OBJ)){
            if ($data->kd_owner != 0){
              echo "
    					  <tr class=gradeC'>
    						<td>$i</td>
    					    <td>$data->nama</td>
    						<td>$data->alamat</td>
    						<td>$data->no_tlp</td>
    						<td>$data->email</td>
    						<td>
    						  <a class='btn btn-success' href='owner.php?detail_owner=$data->kd_owner'>Detail</a>
    						  <a class='btn btn-primary' href='edit.php?edit_owner=$data->kd_owner'>Edit</a>
    						  <a class='btn btn-danger' href='proses/proses_delete.php?delete_owner=$data->kd_owner'>Hapus</a>
    						</td>
    					  </tr>";
              $i++;
            }
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

<?php
  include 'template/modal.php';
?>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/jquery.uniform.js"></script> -->
<script src="js/select2.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/matrix.js"></script>
<script src="js/matrix.tables.js"></script>
</body>
</html>
