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
              if((!isset($_POST['kebutuhanUmum']) && !isset($_POST['kebutuhanUnit'])) and !isset($_GET['umum']) and !isset($_GET['unit'])){
                echo '
                  <div class="widget-content center" style="text-align:center"> Jenis Transaksi </div>
                  <div class="widget-content">
                    <ul class="bs-docs-tooltip-examples">
                      <form method="POST">
                        <li><button name="kebutuhanUmum" type="submit" class="btn btn-success" class="btn btn-info btn-add">Kebutuhan Umum</button> </li>
                        <li><button name="kebutuhanUnit" type="submit" class="btn btn-success" class="btn btn-info btn-add">Kebutuhan Unit</button> </li>
                      </form>
                    </ul>
                  </div>
                ';
              }
              if(isset($_POST['kebutuhanUmum']) || isset($_GET['umum'])){
                echo '
                <div class="widget-content">
                  <form action="../../../proses/transaksi_umum.php" method="POST" class="form-horizontal">
                    <div class="control-group">
                      <div class="controls">
                        <label class="control-label"><strong>KEBUTUHAN UMUM</strong></label>
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
                        <input name="keterangan" type="Text"/>
                        <input name="kebutuhan" type="Text" value="umum" class="hide"/>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Sumber Dana :</label>
                      <div class="controls">
                        <select name="kd_kas">
                          <option name="kd_kas" value="">-- Pilih Sumber Dana --</option>
                          ';
                            $Proses = new Kas($db);
                            $show = $Proses->showKas();
                            while($data = $show->fetch(PDO::FETCH_OBJ)){
                              if ($data->kd_kas != 0){
                                echo "<option name='kd_kas' value='$data->kd_kas'>$data->sumber_dana</option>";
                              }
                            }
                          echo '
                        </select>
                      </div>
                    </div>
                    <div class="control-group">
                      <div class="controls">
                        <button class="btn btn-success" name="addTransaksiUmum" type="submit">Submit</button>
                        <a href="transaksi_umum.php" class="btn btn-inverse">Kembali</a>
                      </div>
                    </div>
                  </form>
                </div>
                ';
              }elseif(isset($_POST['kebutuhanUnit']) || isset($_GET['unit'])){
                echo '
                <div class="widget-content">
                <form action="../../../proses/transaksi_umum.php" method="POST" class="form-horizontal">
                  <div class="control-group">
                    <div class="controls">
                      <label class="control-label"><strong>KEBUTUHAN UNIT</strong></label>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Apartemen :</label>
                    <div class="controls" id="form_apt" name="form_apt">
                      <select id="apartemen" name="apartemen" class="span4">
                        <option name="" value="">-- Pilih Apartemen --</option>
                        ';

                          $Proses = new Apartemen($db);
                          $show = $Proses->showApartemen();
                          while($data = $show->fetch(PDO::FETCH_OBJ)){
                            if ($data->kd_apt != 0){
                              echo "<option name='kd_apt' value='$data->kd_apt'>$data->nama_apt</option>";
                            }
                          }
                        echo '
                      </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Unit :</label>
                    <div class="controls">
                      <select name="unit" id="unit" class="span4" onchange="biaya(this.form)">
                        <option value="">-- Pilih Unit --</option>
                      </select>
                      <div id="loading">
                        <img src="../../asset/images/loading.gif" width="18"> <small>Loading...</small>
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
                      <input name="keterangan" type="Text"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Sumber Dana :</label>
                    <div class="controls">
                      <select name="kd_kas">
                        <option name="" value="">-- Pilih Sumber Dana --</option>
                        ';
                          $Proses = new Kas($db);
                          $show = $Proses->showKas();
                          while($data = $show->fetch(PDO::FETCH_OBJ)){
                            if ($data->kd_kas != 0){
                              echo "<option name='kd_kas' value='$data->kd_kas'>$data->sumber_dana</option>";
                            }
                          }
                        echo '
                      </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <div class="controls">
                      <button class="btn btn-success" name="addTransaksiUnit" type="submit">Submit</button>
                      <a href="transaksi_umum.php" class="btn btn-inverse">Kembali</a>
                    </div>
                  </div>
                </form>
                </div>
                ';
              }
            ?>
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
