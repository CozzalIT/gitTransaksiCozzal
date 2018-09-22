<?php
  require("../../../class/transaksi.php");
  require("../../../class/kas.php");
  require("../../../class/unit.php");
  require("../../../class/apartemen.php");
  require("../../../../config/database.php");

  $thisPage = "Transaksi Umum";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Transaksi Umum</a></div>
    <h1>Transaksi Umum</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box" style="overflow-x:auto;">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Transaksi Umum</h5>
          </div>
          <div class="widget-content nopadding">
            <?php
              if(isset($_GET['umum']) || isset($_GET['unit'])){
                echo '
                <div class="alert alert-danger" role="alert">
                  <strong>Saldo Tidak Mencukupi !</strong>
                </div>
                ';
              }
            ?>
            <div class="widget-content">
              <form  action="../../../proses/transaksi_umum.php" method="POST" class="form-horizontal">
                <div class="control-group">
                  <label class="control-label">Kebutuhan : </label>
                  <div class="controls">
                    <select id="kebutuhan" name="kebutuhan" onchange="jenisKebutuhan()">
                      <option>-- Pilih Kebutuhan --</option>
                      <option value="tu">Transaksi Umum</option>
                      <option value="u">Kebutuhan Unit</option>
                      <option value="btu">Billing Transaksi Umum</option>
                      <option value="bu">Billing Kebutuhan Unit</option>
                    </select>
                  </div>
                </div>
                <script>
                  function jenisKebutuhan(){
                    var selectApt = document.getElementById("controlApt");
                    var selectUnit = document.getElementById("controlUnit");
                    var selectKas = document.getElementById("controlKas");
                    var jatuhTempo = document.getElementById("controlJT");
                    var allForm = document.getElementById("allForm");
                    var kebutuhan = document.getElementById("kebutuhan");
                    var valKebutuhan = kebutuhan.options[kebutuhan.selectedIndex].value;
                    allForm.classList.remove("hide");

                    if(valKebutuhan=="tu" || valKebutuhan=="btu"){
                      selectApt.classList.add("hide");
                      selectUnit.classList.add("hide");
                      if(valKebutuhan=="btu"){
                        jatuhTempo.classList.remove("hide");
                        selectKas.classList.add("hide");
                      }else{
                        jatuhTempo.classList.add("hide");
                        selectKas.classList.remove("hide");
                        $('#inJT').removeAttr('required');
                      }
                    }else if(valKebutuhan=="u" || valKebutuhan=="bu"){
                      selectApt.classList.remove("hide");
                      selectUnit.classList.remove("hide");
                      if(valKebutuhan=="bu"){
                        jatuhTempo.classList.remove("hide");
                        selectKas.classList.add("hide");
                      }else{
                        jatuhTempo.classList.add("hide");
                        selectKas.classList.remove("hide");
                        $('#inJT').removeAttr('required');
                      }
                    }
                  }
                </script>
                <div id="allForm" class="hide">
                  <div id="controlApt" class="control-group">
                    <label id="lblApt" class="control-label">Apartemen :</label>
                    <div class="controls" id="form_apt" name="form_apt">
                      <select id="apartemen" name="apartemen" class="">
                        <option name="" value="">-- Pilih Apartemen --</option>
                        <?php
                          $Proses = new Apartemen($db);
                          $show = $Proses->showApartemen();
                          while($data = $show->fetch(PDO::FETCH_OBJ)){
                            if ($data->kd_apt != 0){
                              echo "<option name='kd_apt' value='$data->kd_apt'>$data->nama_apt</option>";
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div id="controlUnit" class="control-group">
                    <label id="lblUnit" class="control-label">Unit :</label>
                    <div class="controls">
                      <select name="unit" id="unit" class="" onchange="biaya(this.form)">
                        <option value="">-- Pilih Unit --</option>
                      </select>
                      <div id="loading">
                        <img src="" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Harga : </label>
                    <div class="controls">
                      <input name="harga" type="number" value="0"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Jumlah :</label>
                    <div class="controls">
                      <input name="jumlah" type="number" value="1"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Keterangan :</label>
                    <div class="controls">
                      <input name="keterangan" type="Text" required/>
                    </div>
                  </div>
                  <div id="controlJT" class="control-group">
                    <label class="control-label">Jatuh Tempo :</label>
                    <div class="controls">
                      <input id="inJT" name="jatuh_tempo" type="date" required/>
                    </div>
                  </div>
                  <div id="controlKas" class="control-group">
                    <label class="control-label">Sumber Dana :</label>
                    <div class="controls">
                      <select name="kd_kas" id="kd_kas">
                        <?php
                          $Proses = new Kas($db);
                          $show = $Proses->showKas();
                          while($data = $show->fetch(PDO::FETCH_OBJ)){
                            if ($data->kd_kas != 0){
                              echo "<option value='$data->kd_kas'>$data->sumber_dana</option>";
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <div class="controls">
                      <button class="btn btn-success" type="submit" name="addTU">Submit</button>
                      <a href="transaksi_umum.php" class="btn btn-inverse">Kembali</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--modal popup tambah penyyewa baru-->
<div id="popup-penyewa-baru" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Pelanggan Baru</h3>
  </div>
  <div class="modal-body">
  <form action="../../../proses/transaksi.php" method="post" class="form-horizontal">
    <div class="control-group">
    <label class="control-label">Nama :</label>
    <div class="controls">
      <input name="nama" type="text" class="span2" placeholder="Nama" required/>
    </div>
    </div>
    <div class="control-group">
    <label class="control-label">Alamat :</label>
    <div class="controls">
      <input name="alamat" type="text" class="span2" placeholder="Alamat" required/>
    </div>
    </div>
    <div class="control-group">
      <label class="control-label">No Telpon :</label>
      <div class="controls">
        <input name="no_tlp" type="text"  class="span2" placeholder="ex: 0812...." required/>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Jenis Kelamin :</label>
      <div class="controls">
        <label>
          <input type="radio" name="jenis_kelamin" value="Laki-laki" checked/> Laki-laki
        </label>
        <label>
          <input type="radio" name="jenis_kelamin" value="Perempuan" /> Perempuan
        </label>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Email :</label>
      <div class="controls">
        <input name="email" type="text"  class="span2" placeholder="ex: abc@gmail.com" required/>
      </div>
    </div>
    <div class="control-group">
    <div class="controls">
      <input type="submit" name="addPenyewaTransaksi" class="btn btn-success">
      <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
    </div>
    </div>
  </form>
  </div>
</div>
<!-- //modal popup tambah unit-->

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../../asset/js/sweetalert.min.js"></script>
<script src="../../../asset/js/jquery.min.js"></script>
<script src="../../../asset/js/jquery.ui.custom.js"></script>
<script src="../../../asset/js/bootstrap.min.js"></script>
<!--<script src="js/jquery.validate.js"></script> -->
<script src="../../../asset/js/jquery.wizard.js"></script>
<script src="../../../asset/js/matrix.js"></script>
<script src="../../../asset/js/matrix.wizard.js"></script>
<script src="../../../asset/js/transaksi.js"></script>
<script src="../../../asset/js/jquery.uniform.js"></script>
<!-- <script src="js/select2.min.js"></script> -->
<script src="../../../asset/js/jquery.dataTables.min.js"></script>
<script src="../../../asset/js/matrix.tables.js"></script>
</body>
</html>
