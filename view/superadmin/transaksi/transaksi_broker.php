<?php
  require("../../../class/transaksi.php");
  require("../../../class/unit.php");
  require("../../../class/penyewa.php");
  require("../../../class/apartemen.php");
  require("../../../class/booking.php");
  require("../../../class/kas.php");
  require("../../../../config/database.php");

  $thisPage = "Transaksi";

  include "../template/head.php";
?>
<body>
<?php
  include "../template/header.php";
  include "../template/sidebar.php";
?>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="../home/home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="current">Transaksi</a></div>
    <h1>Transaksi Broker</h1>
  <a href="laporan_transaksi.php" class="btn btn-success btn-add"><i class="icon-edit"></i> Laporan Transaksi</a>
  <a href="transaksi.php" class="btn btn-secondary btn-add"><i class="icon-edit"></i> Transaksi Normal</a>
  <a href="transaksi_penyewa_broker.php" class="btn btn-warning btn-add"><i class="icon-edit"></i> Transaksi Penyewa Broker</a>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
      <form action="../../../proses/transaksi_broker.php" method="post" class="form-horizontal" name="general">
        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse"> <span class="icon"><i class="icon-ok"></i></span>
                <h5>Data Broker</h5>
                </a> </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
              <div class="widget-content center" style="text-align:center"> Piih Data Broker </div>
                <div class="widget-content">
                  <ul class="bs-docs-tooltip-examples">
                    <li><button name="penyewaBaru" class="btn btn-success" href="#popup-penyewa-baru" data-toggle="modal" class="btn btn-info btn-add">Broker Baru</button> </li>
                    <li><a data-toggle="modal" href="#penyewaLama" class="btn btn-success">Broker Lama</a> </li>
                  </ul>
                </div>

                <div class="widget-content" id="IDPenyewa">
                    <input type="hidden" name="kd_penyewa" id="kd_penyewa">
                    <div class="control-group">
                      <label class="control-label">Nama :</label>
                      <div class="controls">
                        <input type="text" class="span3" id="nama_penyewa" disabled/>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Email :</label>
                      <div class="controls">
                        <input type="text" class="span3" id="email_penyewa" disabled/>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Alamat :</label>
                      <div class="controls">
                        <input type="text" class="span3" id="alamat_penyewa" disabled/>
                      </div>
                    </div>
                </div>

            </div>
          </div>
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href='#' id="head-tgl" data-toggle="collapse">
              <span class="icon"><i class="icon-eye-open"></i></span>
              <h5>Pilih Tanggal</h5>
              </a> </div>
            </div>
            <div class="collapse accordion-body" id="collapseGFour">
              <div class="control-group">
                <label class="control-label">Check In : </label>
                <div class="controls">
                  <input name="check_in" id="check_in" type="date" onchange="keepvalid(this.form)"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Check Out :</label>
                <div class="controls">
                  <input name="check_out" id="check_out" type="date" onchange="keepvalid2(this.form); validasi2(this.form)"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Jumlah Hari :</label>
                <div class="controls">
                  <input name="jumhari" min="0" type="number" onchange="tambah(this.form)"/>
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                  <button data-parent="#collapse-group" href="#" id="btn1" onclick="valid1(general)" data-toggle="collapse" class="btn btn-success">Lanjut</button>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href="#" onclick="valid1(general)" id="col1" data-toggle="collapse"> <span class="icon"><i class="icon-eye-open"></i></span>
                <h5>Pilih Unit</h5>
                </a> </div>
            </div>
            <div class="collapse accordion-body" id="collapseUnit">
              <div class="control-group">
                <label class="control-label">Apartemen :</label>
                <div class="controls" id="form_apt" name="form_apt">
                  <select id="apartemen" name="apartemen" class="span4">
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
              <div class="control-group" id="harga_sewa-C">
                <label class="control-label">Harga Sewa Weekday:</label>
                <div class="controls">
                  <input name="harga_sewa" min="0"  id="harga_sewa" type="number" onChange="hasil(this.form)" />
                </div>
              </div>
              <div class="control-group" id="harga_sewa_we-C">
                <label class="control-label">Harga Sewa Weekend:</label>
                <div class="controls">
                  <input name="harga_sewa_we" min="0"  id="harga_sewa_we" type="number" onChange="hasil(this.form)" />
                </div>
              </div>
        <div class="control-group" id="harga_sewa_gbg-C">
                <label class="control-label">Harga Sewa :</label>
                <div class="controls">
                  <input name="harga_sewa_gbg" min="0"  id="harga_sewa_gbg" type="number" onChange="hasil(this.form)" />
                </div>
              </div>
       <div class="control-group" id="tamu-C">
                <label class="control-label">Jumlah Tamu :</label>
                <div class="controls">
                  <input name="tamu" min="0" type="number" value="5" onChange="ECH(this.form)"/>
                  <input name="harga_sewa_asli" type="text" style="display:none;"/>
                </div>
              </div>
              <div class="control-group" id="ekstra_charge-C">
                <label class="control-label">Ekstra Charge :</label>
                <div class="controls">
                  <input name="ekstra_charge" min="0"  type="number" onChange="hasil(this.form)" />
                </div>
              </div>
        <div class="control-group">
                <label class="control-label">Total Biaya :</label>
                <div class="controls">
                  <input name="total" id="total" min="0"  type="number" />
                </div>
              </div>
        <div class="control-group" id="deposit-C">
              <label class="control-label">Deposit :</label>
                <div class="controls">
                  <input name="deposit" min = "0" id="deposit"  type="number" />
                </div>
              </div>
          <div class="control-group" id="total_bayar-C">
                <label class="control-label">Total Bayar :</label>
                <div class="controls">
                  <input name="total_bayar" id="total_bayar" min="0"  type="number" disabled />
                </div>
              </div>
        <div class="control-group" id="total_harga_owner-C">
              <label class="control-label">Total Harga Owner :</label>
                <div class="controls">
                  <input name="total_harga_owner" min="0" id="total_harga_owner"  type="number" />
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                  <button data-parent="#collapse-group" href="#" id="btn2" data-toggle="collapse" class="btn btn-success">Lanjut</button>
                </div>
               </div>
             </div>
           </div>
           <div class="accordion-group widget-box">
             <div class="accordion-heading">
               <div class="widget-title">
                 <a data-parent="#collapse-group" href="#" id="col2" data-toggle="collapse"> <span class="icon"><i class="icon-eye-open"></i></span>
                   <h5>Booking dan DP</h5>
                 </a>
               </div>
            </div>
            <div class="collapse accordion-body" id="collapseGFive">
              <div class="control-group">
                <label class="control-label">Booking Via :</label>
              <div class="controls">
                <select id="booking_via" name="booking_via" class="span4" required>
                  <option value="">-- Booking --</option>
                  <?php
                    $Proses = new Booking($db);
                    $show = $Proses->showBooking_via();
                    while($data = $show->fetch(PDO::FETCH_OBJ)){
                      echo "<option name='kd_booking' value='$data->kd_booking'>$data->booking_via</option>";
                    }
                  ?>
                </select>
              </div>
          </div>
          <div class="control-group">
            <label class="control-label">DP Via :</label>
            <div class="controls">
              <select id="kas" name="kas" class="span4" required>
                <option value="">-- Kas --</option>
                <?php
                  $Proses = new Kas($db);
                  $show = $Proses->showKas();
                  while($data = $show->fetch(PDO::FETCH_OBJ)){
                    echo "<option name='kd_kas' value='$data->kd_kas'>$data->sumber_dana</option>";
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Jumlah DP :</label>
            <div class="controls">
              <input name="dp" min="0"  type="number" required/>
            </div>
            </div>
        <div class="control-group">
          <label class="control-label">Catatan :</label>
          <div class="controls">
            <textarea id = "catatan" name="catatan" rows="5" class="span11"></textarea>
          </div>
        </div>
          <div class="control-group" >
            <div class="controls">
              <input type="submit" name="transaksiBroker" value="Submit" class="btn btn-success">
              <a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  </div>
</div>
</div>
</div>

<!--modal popup tambah penyewa baru-->
<div id="popup-penyewa-baru" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Pelanggan Baru</h3>
  </div>
  <div style="padding: 0px;" class="modal-body">
    <form id="p_baru" class="form-horizontal">
      <div class="control-group">
        <label class="control-label">Nama Lengkap:</label>
        <div class="controls">
        <input style="cursor: text;" id="nama" type="text" class="span4"/>
        </div>
      </div>
      <div class="control-group">
        <input type="hidden" id="jenis_kelamin">
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
        <input id="alamat" type="text" class="span4" placeholder="Alamat"/>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">No Telepon / HP</label>
        <div class="controls">
        <input id="no_tlp" type="text" class="span4"/>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">E-Mail</label>
        <div class="controls">
        <input id="email" type="text" class="span4" placeholder="Email"/>
        </div>
      </div>
      <div class="controls" style="padding: 10px; text-align:right;">
        <a class='btn btn-success' id="pilih-penyewa">Daftarkan</a>
      </div>
    </form>
  <div id="detail">
    <div onclick="showDetail()" class="widget-title" style="cursor:pointer;"> <span class="icon"><i id="icon-detail" class="icon-chevron-down"></i></span><h5>Detail Penyewa Lainnya</h5></div>
    <div id="detail_red" class="control-group newpadd">
      <!-- <div class="note"><a onclick="submite(kd_penyewa);" class="selected">Gunakan Ini</a>Purnima Iyer - Perempuan<br>Jakarta -  +66 983 157 976<br>guest@airbnb.com</div> -->
    </div>
  </div> 
</div>  
</div>
<!-- //modal popup tambah unit-->

<!--modal popup tambah penyewa baru-->
<div id="penyewaLama" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Daftar Broker Lama</h3>
  </div>
  <div style="padding: 0px;" class="modal-body">

  <form method="post" class="form-horizontal" style="">
    <div id="note-anak">
      <input class="search" placeholder="Masukkan nama yang dicari" style="margin:10px;width: 80%;" onkeyup="filter()" onkeydown="stop_filter()" type="text">
      <div class="control-group newpadd" style="max-height: 290px;">
        <div id="note-anak-isi">

        </div>
        <div class="note loading">
          <img src="../../../asset/images/loading.gif" width="18"> <small>Loading...</small>
        </div>
      </div>
    </div>
  </form>

  </div>  
</div>
<!-- //modal popup tambah unit-->

<style type="text/css">
  .selected{
    font-size: 10px;
    float: right;
    border-radius: 2px;
    color: white;
    padding: 3px;
    cursor: pointer;
    margin-left: 5px;
    background-color: blue;
  }
   .selected:hover{
    color: white;
    padding: 4px;
    cursor: pointer;
  } 
</style>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; Brought to you by <a href="http://www.booking.cozzal.com">Cozzal IT</a> </div>
</div>
<!--end-Footer-part-->
<script src="../../../asset/js/customJs/penyewa_broker2.js"></script>
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
