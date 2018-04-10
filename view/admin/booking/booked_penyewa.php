<?php
  $thisPage = "Edit";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>

<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="booked.php" title="Go to Booked" class="tip-bottom">Booked List</a> <a href="#" class="current">Pendaftaran Penyewa</a> </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
	  <?php
// Audit transaksi
      if (isset($_GET['kd_booked']))
      {
        require("../../../../config/database.php");
        require("../../../class/booked.php");
        $Proses = new Booked($db);
        $kd_booked = $_GET['kd_booked'];
        $show = $Proses->showDetail_booked($kd_booked);
        $edit = $show->fetch(PDO::FETCH_OBJ);
      }
?>

         <div class="span3">
          </div>
          <div class="span6">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i id="icon-title" class="icon-user"></i> </span> <h5 id="cap-title">Data Penyewa Baru</h5>
              </div>
              <div class="widget-content nopadding">
                <form id="p_baru" class="form-horizontal">
                  <div class="control-group">
                    <label class="control-label">Nama Lengkap:</label>
                    <div class="controls">
                    <input id="nama" type="text" class="span11" value="<?php echo $edit->penyewa; ?>"disabled/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Jenis Kelamin :</label>
                    <div class="controls">
                      <select onchange="setkelamin(this.value);" name="pilihan_jk">
                        <option value=""> --Pilih jenis kelamin-- </option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Alamat :</label>
                    <div class="controls">
                    <input id="alamat" type="text" class="span11" placeholder="Alamat" value="Jakarta"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">No Telepon / HP</label>
                    <div class="controls">
                    <input id="no_tlp" type="text" class="span11" value="<?php echo $edit->no_tlp; ?>"disabled/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">E-Mail</label>
                    <div class="controls">
                    <input id="email" type="text" class="span11" placeholder="Email" value="guest@airbnb.com" disabled/>
                    </div>
                  </div>  
                  <div class="controls" style="padding: 10px; text-align:right;">
                    <a class='btn btn-success' id="pilih-penyewa">Daftarkan</a>
                  </div>                                                                 
                </form>
                <form id="p_lama" action="booked_transaksi.php" method="post" class="form-horizontal">
                  <div id="note-anak">
                    <div class="control-group newpadd" style="max-height: 290px;">
                      <div id="note-anak-isi">
                        <div class="note loading">
                          <img src="../../../asset/images/loading.gif" width="18"> <small>Loading...</small>                          
                        </div>
                      </div>
                    </div>
                    <div class="controls" style="padding: 10px; text-align:right;">
                      <button name="next-booked" id="next" type="submit" class="btn btn-success" disabled="">Pilih Penyewa</button>
                    </div>          
                  </div>  
                  <div style="display: none;">
                    <input type="text" name="kd_penyewa" id="kd_penyewa" value="0"/>  
                    <input name="kd_booked" type="text" value="<?php echo $_GET['kd_booked']; ?>"/>
                    <input type="text" name="jenis_kelamin" id="jenis_kelamin" value=""/>
                  </div>                                 
                </form>
                <div class="control-group" style="padding:10px;background-color:#ECECEC;margin: 0px;">
                  <center>
                    <input type="checkbox" checked="true" href="#popup-penyewa" data-toggle="" id="ck" class="span11"/> Penyewa adalah penyewa baru
                  </center>
                </div>                 
              </div>
            </div>           
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; Brought to you by <a href="http://www.booking.cozzal.com">Cozzal IT</a> </div>
</div>
<!--end-Footer-part-->

<!-- Extend stylesheet -->
<style type="text/css">
  .active,.list-penyewa:hover{
    background-color: #C9E5EF;
  }
</style>

<!--extend js -->
<script type="text/javascript">
  var a = document.getElementById('nama').value;
  var has_loaded = false;
  $("#p_lama").hide();

  function setkelamin(jenis){
      $("#jenis_kelamin").val(jenis);
  }

  function request_penyewa(jenis){
      $.post('../../../proses/booked.php', {getList : a, jenis : jenis},
      function (data) {
      response = JSON.parse(data);
        $(".loading").hide();
        $("#note-anak-isi").append(response.isi);
        has_loaded = true;
      }); 
  }

  function select(x){
    //alert(x.id);
    $(".active").removeClass("active");
    $(x).addClass("active");
    $("#kd_penyewa").val(x.id);
    $("#next").removeAttr("disabled");
  }

  $("#ck").click(function(){
    if(!this.checked){
      $("#p_lama").show();
      $("#p_baru").hide();
      $("#cap-title").text("Pilih Penyewa");
      $("#icon-title").attr("class","icon-signin");
      if(!has_loaded){
        $(".loading").show();
        request_penyewa("like");        
      }
    } else {
      $("#p_lama").hide();
      $("#p_baru").show();      
      $("#cap-title").text("Data Penyewa Baru");
      $("#icon-title").attr("class","icon-user");
    }
  });

  $("#pilih-penyewa").click(function(){
    var nama = $("#nama").val();
    var alamat = $("#alamat").val();
    var jenis_kelamin = $("#jenis_kelamin").val();
    var email = $("#email").val();
    var no_tlp = $("#no_tlp").val();
    if(nama!="" && alamat!="" && jenis_kelamin!="" && email!="" && no_tlp!=""){
      $(this).attr({"disabled":"disabled"});
      $(this).text("Mendaftaran Penyewa...");
      $.post('../../../proses/booked.php', {
        daftar_penyewa : nama, alamat : alamat, email : email,
        jenis_kelamin : jenis_kelamin, no_tlp : no_tlp 
      },
      function (data) {
        $("#pilih-penyewa").text("Penyewa telah terdaftar, mohon tunggu ...");    
        $.post('../../../proses/booked.php', {getPenyewa : nama, no_tlp : no_tlp },
        function (data) {
          response = JSON.parse(data);
          $("#kd_penyewa").val(response.kd_penyewa);
          $("#next").removeAttr("disabled");
          $("#next").click();
        }); 
      }); 
    } else {
      alert("Lengkapi data terlebih dahulu");
    }    
  });

</script>

<script src="../../../asset/js/jquery.min.js"></script>
<script src="../../../asset/js/jquery.ui.custom.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<script src="../../../asset/js/jquery.uniform.js"></script>
<!--<script src="js/select2.min.js"></script>-->
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
</body>
</html>
