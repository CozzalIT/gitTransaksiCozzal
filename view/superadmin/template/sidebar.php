<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li <?php if($thisPage == "Dashboard") echo "class='active'"; ?>><a href="../home/home.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
	  <li class="submenu <?php if($thisPage == "Transaksi") echo " active"; ?>"> <a href="#"><i class="icon icon-money"></i> <span>Transaksi</span></a>
      <ul>
        <li><a href="../transaksi/transaksi.php">Input Transaksi</a></li>
        <li><a href="../transaksi/laporan_transaksi.php">Laporan Transaksi</a></li>
        <li><a href="../transaksi/confirm_transaksi.php">Confirm Transaksi</a></li>
      </ul>
    </li>
    <li <?php if($thisPage == "Account Management") echo "class='active'"; ?>><a href="../account/account_management.php"><i class="icon icon-sitemap"></i> <span>Account Management</span></a> </li>
    <li <?php if($thisPage == "Booking Request") echo "class='active'"; ?>><a href="../booking/booking_request.php"><i class="icon icon-file"></i> <span>Booking Request</span></a> </li>
    <li <?php if($thisPage == "Listing Request") echo "class='active'"; ?>><a href="../unit/listing_request.php"><i class="icon icon-edit"></i> <span>Listing Request</span></a> </li>
	  <li <?php if($thisPage == "Penyewa") echo "class='active'"; ?>><a href="../penyewa/penyewa.php"><i class="icon icon-user"></i> <span>Data Penyewa</span></a> </li>
    <li <?php if($thisPage == "Owner") echo "class='active'"; ?>><a href="../owner/owner.php"><i class="icon icon-th-large"></i> <span>Data Owner</span></a> </li>
    <li <?php if($thisPage == "Apartemen") echo "class='active'"; ?>><a href="../apartemen/apartemen.php"><i class="icon icon-columns"></i> <span>Data Apartemen</span></a> </li>
    <li class="submenu <?php if($thisPage == "Unit") echo " active"; ?>"> <a href="#"><i class="icon icon-money"></i> <span>Data Unit</span></a>
      <ul>
        <li><a href="../unit/unit.php">List Unit</a></li>
        <li><a href="../unit/task.php">Task Cleaner</a></li>
        <li><a href="../unit/status.php">Status Unit</a></li>
      </ul>
    </li>
	  <li <?php if($thisPage == "Booking_via") echo "class='active'"; ?>><a href="../booking/booking_via.php"><i class="icon icon-pencil"></i> <span>Booking Via</span></a> </li>
	  <li <?php if($thisPage == "Dp_via") echo "class='active'"; ?>><a href="../dp/dp_via.php"><i class="icon icon-strikethrough"></i> <span>Dp Via</span></a> </li>
  </ul>
</div>
<!--sidebar-menu-->
