<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li <?php if($thisPage == "Dashboard") echo "class='active'"; ?>><a href="../home/home.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li <?php if($thisPage == "Unit") echo "class='active'"; ?>><a href="../unit/unit.php"><i class="icon icon-edit"></i> <span>Listing Unit</span></a> </li>
    <li <?php if($thisPage == "Booking") echo "class='active'"; ?>><a href="../booking/laporan_booking.php"><i class="icon icon-th-large"></i> <span>Laporan Booking</span></a> </li>
    <li <?php if($thisPage == "Pengeluaran") echo "class='active'"; ?>><a href="../booking/pengeluaran.php"><i class="icon icon-credit-card"></i> <span>Laporan Pengeluaran</span></a> </li>
    <li <?php if($thisPage == "Kwitansi") echo "class='active'"; ?>><a href="../kwitansi/list_kwitansi.php"><i class="icon icon-briefcase"></i> <span>Kwitansi Pembayaran</span></a> </li>
	  <li <?php if($thisPage == "Pendapatan") echo "class='active'"; ?>><a href="../booking/pendapatan.php"><i class="icon icon-money"></i> <span>Pendapatan</span></a> </li>
  </ul>
</div>
<!--sidebar-menu-->
