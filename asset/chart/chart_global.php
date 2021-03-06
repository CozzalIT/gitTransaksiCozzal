<script>
//Chart Transaksi
  var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  var transaksi = {
    type: 'line',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [{
        label: 'Confirm',
        backgroundColor: window.chartColors.purple,
        borderColor: window.chartColors.purple,
        data: [
          <?php
            $proses_t = new Transaksi($db);
            $other = new Other();
            $jumlahHari2 = 0;
            for($i=1;$i<=12;$i++){
              $show_t = $proses_t->showSumMonth($i, 2018, 41);
              $jumlahHari=0;
              while($data_t = $show_t->fetch(PDO::FETCH_OBJ)){
                $bulanCI = explode("-",$data_t->check_in);
                $bulanCO = explode("-",$data_t->check_out);
                if($bulanCI[1] != $bulanCO[1]){
                  $kabisat = $other->cekKabisat(2018);
                  $hari1 = $other->cekJumHari($kabisat, $bulanCI[1]);
                  $jumlahHari = $jumlahHari + $hari1 + 1 - $bulanCI[2];
                  $jumlahHari2 += $bulanCO[2] - 1 ;
                }else{
                  $jumlahHari = $jumlahHari + $data_t->hari;
                  $jumlahHari2 += 0;
                }
              }
              $hariLebih[$i+1] = $jumlahHari2;
              if(empty($hariLebih[$i])){
                $hariLebih[$i] = 0;
              }
              $jumlahHari2=0;
              $subJumlahHari[$i] = $jumlahHari + $hariLebih[$i];
              echo $subJumlahHari[$i].',';
            }
          ?>
        ],
        fill: false,
      }, {
        label: 'Booked',
        backgroundColor: window.chartColors.blue,
        borderColor: window.chartColors.blue,
        data: [
          <?php
            $jumlahHari2 = 0;
            for($i=1;$i<=12;$i++){
              $show_t = $proses_t->showSumMonth($i, 2018, 1);
              $jumlahHari=0;
              while($data_t = $show_t->fetch(PDO::FETCH_OBJ)){
                $bulanCI = explode("-",$data_t->check_in);
                $bulanCO = explode("-",$data_t->check_out);
                if($bulanCI[1] != $bulanCO[1]){
                  $kabisat = $other->cekKabisat(2018);
                  $hari1 = $other->cekJumHari($kabisat, $bulanCI[1]);
                  $jumlahHari = $jumlahHari + $hari1 + 1 - $bulanCI[2];
                  $jumlahHari2 += $bulanCO[2] - 1;
                }else{
                  $jumlahHari = $jumlahHari + $data_t->hari;
                  $jumlahHari2 += 0;
                }
              }
              $hariLebih[$i+1] = $jumlahHari2;
              if(empty($hariLebih[$i])){
                $hariLebih[$i] = 0;
              }
              $jumlahHari2=0;
              $subJumlahHari[$i] = $jumlahHari + $hariLebih[$i];
              echo $subJumlahHari[$i].',';
            }
          ?>
        ],
        fill: false,
      }, {
        label: 'Cancel',
        backgroundColor: window.chartColors.yellow,
        borderColor: window.chartColors.yellow,
        data: [
          <?php
            for($i=1;$i<=12;$i++){
              $show_t = $proses_t->showSumMonth($i, 2018, 2);
              $jumlahHari=0;
              while($data_t = $show_t->fetch(PDO::FETCH_OBJ)){
                $bulanCI = explode("-",$data_t->check_in);
                $bulanCO = explode("-",$data_t->check_out);
                if($bulanCI[1] != $bulanCO[1]){
                  $kabisat = $other->cekKabisat(2018);
                  $hari1 = $other->cekJumHari($kabisat, $bulanCI[1]);
                  $jumlahHari = $jumlahHari + $hari1 + 1 - $bulanCI[2];
                  $jumlahHari2 += $bulanCO[2] - 1;
                }else{
                  $jumlahHari = $jumlahHari + $data_t->hari;
                  $jumlahHari2 += 0;
                }
              }
              $hariLebih[$i+1] = $jumlahHari2;
              if(empty($hariLebih[$i])){
                $hariLebih[$i] = 0;
              }
              $jumlahHari2=0;
              $subJumlahHari[$i] = $jumlahHari + $hariLebih[$i];
              echo $subJumlahHari[$i].',';
            }
          ?>
        ],
        fill: false,
      }]
    },
    options: {
      responsive: true,
      elements: {
        line: {
          tension: 0.000001
        }
      },
      title: {
        display: true,
        text: 'Status Transaksi'
      },
      tooltips: {
        mode: 'index',
        intersect: false,
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Bulan'
          }
        }],
        yAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Hari'
          }
        }]
      }
    }
  };
//Chart Transaksi (End)

//Chart Pendapatan
  var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  var pendapatan = {
    type: 'line',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [{
        label: 'Masuk',
        backgroundColor: window.chartColors.orange,
        borderColor: window.chartColors.orange,
        data: [
          <?php
            $proses_t = new Transaksi($db);
            for($i=1;$i<=12;$i++){
              $show_t = $proses_t->showSumPendapatan($i, 2018);
              $jumlahPendapatan=0;
              while($data_t = $show_t->fetch(PDO::FETCH_OBJ)){
                $jumlahPendapatan = $jumlahPendapatan + $data_t->total_tagihan;
              }
              echo $jumlahPendapatan.',';
            }
          ?>
        ],
        fill: false,
      }]
    },
    options: {
      responsive: true,
      elements: {
        line: {
          tension: 0.000001
        }
      },
      title: {
        display: true,
        text: 'Pendapatan'
      },
      tooltips: {
        mode: 'index',
        intersect: false,
        callbacks: {
          label: function(tooltipItem, data) {
            var label = data.datasets[tooltipItem.datasetIndex].label || '';
            if (label) {
              label += ' : ';
            }
            function formatRupiah(nominal){
            	nominal += '';
            	x = nominal.split('.');
            	x1 = x[0];
            	x2 = x.length > 1 ? '.' + x[1] : '';
            	var rgx = /(\d+)(\d{3})/;
            	while (rgx.test(x1)) {
            		x1 = x1.replace(rgx, '$1' + '.' + '$2');
            	}
            	return x1 + x2;
            }
            label += formatRupiah(Math.round(tooltipItem.yLabel * 100) / 100) + ' IDR';
            return label;
          }
        }
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Bulan'
          }
        }],
        yAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Nominal *IDR'
          },
        }]
      }
    }
  };
//Chart Pendapatan (End)

//Chart Keuntungan Kotor
  var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  var keuntunganKotor = {
    type: 'line',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [{
        label: 'Data',
        backgroundColor: window.chartColors.green,
        borderColor: window.chartColors.green,
        data: [
          <?php
            $proses_t = new Transaksi($db);
            for($i=1;$i<=12;$i++){
              $show_t = $proses_t->showSumSewa($i, 2018);
              $keuntunganKotor=0;
              $subKeuntunganKotor=0;
              while($data_t = $show_t->fetch(PDO::FETCH_OBJ)){
                $totalOwner = ($data_t->harga_owner*$data_t->hari_weekday)+($data_t->harga_owner_weekend*$data_t->hari_weekend);
                if($data_t->total_harga_owner != 0){
                  $subKeuntunganKotor = $data_t->total_tagihan-$data_t->total_harga_owner;
                }else{
                  $subKeuntunganKotor = $data_t->total_tagihan-$totalOwner;
                }
                $keuntunganKotor += $subKeuntunganKotor;
              }
              echo $keuntunganKotor.',';
            }
          ?>
        ],
        fill: false,
      }]
    },
    options: {
      responsive: true,
      elements: {
        line: {
          tension: 0.000001
        }
      },
      title: {
        display: true,
        text: 'Keuntungan Kotor'
      },
      tooltips: {
        mode: 'index',
        intersect: false,
        callbacks: {
          label: function(tooltipItem, data) {
            var label = data.datasets[tooltipItem.datasetIndex].label || '';
            if (label) {
              label += ' : ';
            }
            function formatRupiah(nominal){
            	nominal += '';
            	x = nominal.split('.');
            	x1 = x[0];
            	x2 = x.length > 1 ? '.' + x[1] : '';
            	var rgx = /(\d+)(\d{3})/;
            	while (rgx.test(x1)) {
            		x1 = x1.replace(rgx, '$1' + '.' + '$2');
            	}
            	return x1 + x2;
            }
            label += formatRupiah(Math.round(tooltipItem.yLabel * 100) / 100) + ' IDR';
            return label;
          }
        }
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Bulan'
          }
        }],
        yAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Nominal *IDR'
          }
        }]
      }
    }
  };
//Chart Keuntungan Kotor (End)

//Event Onload
  window.onload = function() {
    var ctxTransaksi = document.getElementById('cv_transaksi').getContext('2d');
    var ctxPendapatan = document.getElementById('cv_pendapatan').getContext('2d');
    var ctxKeuntunganKotor = document.getElementById('cv_keuntungan_kotor').getContext('2d');
    window.myLine = new Chart(ctxTransaksi, transaksi);
    window.myLine = new Chart(ctxPendapatan, pendapatan);
    window.myLine = new Chart(ctxKeuntunganKotor, keuntunganKotor);
  };
//Event Onload (End)

//Button Chart View
  function viewTransaksi() {
    var transaksi = document.getElementById('ctr_transaksi');
    var pendapatan = document.getElementById('ctr_pendapatan');
    var keuntungan_kotor = document.getElementById('ctr_keuntungan_kotor');
    transaksi.classList.remove("hide");
    pendapatan.classList.add("hide");
    keuntungan_kotor.classList.add("hide");
  }

  function viewPendapatan() {
    var transaksi = document.getElementById('ctr_transaksi');
    var pendapatan = document.getElementById('ctr_pendapatan');
    var keuntungan_kotor = document.getElementById('ctr_keuntungan_kotor');
    transaksi.classList.add("hide");
    pendapatan.classList.remove("hide");
    keuntungan_kotor.classList.add("hide");
  }

  function viewKeuntunganKotor() {
    var transaksi = document.getElementById('ctr_transaksi');
    var pendapatan = document.getElementById('ctr_pendapatan');
    var keuntungan_kotor = document.getElementById('ctr_keuntungan_kotor');
    transaksi.classList.add("hide");
    pendapatan.classList.add("hide");
    keuntungan_kotor.classList.remove("hide");
  }
//Button Chart View (End)
</script>
