<script>
//Chart Pendapatan
var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
var pendapatan = {
  type: 'line',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [
      <?php
        $kd_owner = $_SESSION['pemilik'];
        $proses_u = new Unit($db);
        $other = new Other();
        $show_u = $proses_u->showUnitbyOwner($kd_owner);
        $bulan = date('m');

        $j = 1;
        while($data_u = $show_u->fetch(PDO::FETCH_OBJ)){
          $kd_unit = $data_u->kd_unit;
		  $proses_t = new Owner($db);
          $color = $other->selectColor($j);
          echo "
          {
              label: '$data_u->no_unit',
              backgroundColor: window.chartColors.$color,
              borderColor: window.chartColors.$color,
              data: [";
			   $proses_t = new Owner($db);
              $jumlahHari2 = 0;
              for($i=1;$i<=12;$i++){
				$show_t = $proses_t->showBookingByMY($kd_unit, $i, 2018, 41);
                $pendapatanTotOwner = 0;
                $jumlahHari = 0;
                while($data_t = $show_t->fetch(PDO::FETCH_OBJ)){
                  $bulanCI = explode("-",$data_t->check_in);
                  $bulanCO = explode("-",$data_t->check_out);
                  if($bulanCI[1] != $bulanCO[1]){
                    $kabisat = $other->cekKabisat(2018);
                    $hari1 = $other->cekJumHari($kabisat, $bulanCI[1]);
                    $jumlahHari =  $hari1 + 1 - $bulanCI[2];
                    $jumlahHari2 = $bulanCO[2] - 1;
                  }else{
                    $jumlahHari = $data_t->hari;
                    $jumlahHari2 = 0;
                  }
				  if($data_t->total_harga_owner > 0){
                   $pendapatanOwner = $data_t->total_harga_owner;
				   $pendapatanRata2 = $pendapatanOwner /($data_t->hari);
				   $pendapatanBulanIni = $pendapatanRata2 * $jumlahHari;
                 }else{
                   $pendapatanOwner = ($data_t->hari_weekend * $data_t->h_owner_we) + ($data_t->hari_weekday * $data_t->h_owner_wd);
				   $pendapatanRata2 = $pendapatanOwner / ($data_t->hari_weekend + $data_t->hari_weekday);
				   $pendapatanBulanIni = $pendapatanRata2 * $jumlahHari;
                 }
                 $pendapatanTotOwner = $pendapatanTotOwner + $pendapatanBulanIni;
                }
                echo $pendapatanTotOwner.',';
              }
   

                
          echo
            "],
              fill: false
          },
          ";
          $j++;
        }


      ?>
    ]
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
        }
      }]
    }
  }
};
//Chart Pendapatan beres

//Chart pengeluaran
  var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  var color = Chart.helpers.color;
  var pengeluaran = {
    type: 'line',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        <?php
          $kd_owner = $_SESSION['pemilik'];
          $proses_u = new Unit($db);
          $other = new Other();
          $show_u = $proses_u->showUnitbyOwner($kd_owner);
          $bulan = date('m');
          $j = 1;
          while($data_u = $show_u->fetch(PDO::FETCH_OBJ)){
            $kd_unit = $data_u->kd_unit;
            $kebutuhan = "unit/$kd_unit";
            $color = $other->selectColor($j);
            echo "
            {
                label: '$data_u->no_unit',
                backgroundColor: window.chartColors.$color,
                borderColor: window.chartColors.$color,
                data: [";
                $proses_tu = new TransaksiUmum($db);
                for($i=1;$i<=12;$i++){
                  $show_tu = $proses_tu->showTUByKebutMY($kebutuhan, $i, 2018);
                  $jumlahPengeluaran = 0;
                  while($data_tu = $show_tu->fetch(PDO::FETCH_OBJ)){
                   $jumlahPengeluaran = $jumlahPengeluaran + $data_tu->harga;
                  }
                  echo $jumlahPengeluaran.',';
                }
            echo
                "],
                fill: false
              },
              ";
              $j++;
            }

        ?>
    ]
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
        text: 'Pengeluaran'
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
//Chart pengeluaran beres

//chart data booking
var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
var booking = {
  type: 'line',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [
      <?php
        $kd_owner = $_SESSION['pemilik'];
        $proses_u = new Unit($db);
        $other = new Other();
        $show_u = $proses_u->showUnitbyOwner($kd_owner);
        $bulan = date('m');


        $j = 1;
        while($data_u = $show_u->fetch(PDO::FETCH_OBJ)){
          $kd_unit = $data_u->kd_unit;
          $color = $other->selectColor($j);
          echo "
          {
              label: '$data_u->no_unit',
              backgroundColor: window.chartColors.$color,
              borderColor: window.chartColors.$color,
              data: [";
              $proses_t = new Transaksi($db);
              $jumlahHari2 = 0;
              for($i=1;$i<=12;$i++){
                $show_t = $proses_t->showSumMonthWithKdUnit($kd_unit, $i, 2018, 41);
                $jumlahHari = 0;
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
          echo
              "],
              fill: false
            },
            ";
            $j++;
          }

      ?>
  ]
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
      text: 'Data Booking'
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
//chart data booking beres


//Event Onload
  window.onload = function() {
    var ctxPendapatan = document.getElementById('cv_pendapatan').getContext('2d');
    var ctxPengeluaran = document.getElementById('cv_pengeluaran').getContext('2d');
    var ctxBooking = document.getElementById('cv_booking').getContext('2d');
    window.myLine = new Chart(ctxPendapatan, pendapatan);
    window.myLine = new Chart(ctxPengeluaran, pengeluaran);
    window.myLine = new Chart(ctxBooking, booking);
  };
//Event Onload (End)

//Button Chart View

  function viewPendapatan() {
    var pendapatan = document.getElementById('ctr_pendapatan');
    var pengeluaran = document.getElementById('ctr_pengeluaran');
    var booking = document.getElementById('ctr_booking');
    pendapatan.classList.remove("hide");
    pengeluaran.classList.add("hide");
    booking.classList.add("hide");
  }

  function viewPengeluaran() {
    var pendapatan = document.getElementById('ctr_pendapatan');
    var pengeluaran = document.getElementById('ctr_pengeluaran');
    var booking = document.getElementById('ctr_booking');
    pendapatan.classList.add("hide");
    pengeluaran.classList.remove("hide");
    booking.classList.add("hide");
  }

  function viewBooking() {
    var pendapatan = document.getElementById('ctr_pendapatan');
    var pengeluaran = document.getElementById('ctr_pengeluaran');
    var booking = document.getElementById('ctr_booking');
    pendapatan.classList.add("hide");
    pengeluaran.classList.add("hide");
    booking.classList.remove("hide");
  }
//Button Chart View (End)
</script>
