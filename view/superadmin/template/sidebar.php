<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li <?php if($thisPage == "Dashboard") echo "class='active'"; ?>><a href="../home/home.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
	  <li class="submenu <?php if($thisPage == "Transaksi") echo " active"; ?>"> <a href="#"><i class="icon icon-money"></i> <span>Transaksi</span></a>
      <ul>
        <li <?php if($thisPage == "Transaksi") echo "class='active'"; ?>><a href="../transaksi/transaksi.php">Input Transaksi</a></li>
        <li <?php if($thisPage == "Laporan Transaksi") echo "class='active'"; ?>><a href="../transaksi/laporan_transaksi.php">Laporan Transaksi</a></li>
        <li <?php if($thisPage == "Cancel Transaksi") echo "class='active'"; ?>><a href="../transaksi/cancel_transaksi.php">Cancel Transaksi</a></li>
        <li <?php if($thisPage == "Confirm Transaksi") echo "class='active'"; ?>><a href="../transaksi/confirm_transaksi.php">Confirm Transaksi</a></li>
      </ul>
    </li>
    <li class="submenu <?php if($thisPage == "Transaksi Umum") echo " active"; ?>"> <a href="#"><i class="icon icon-money"></i> <span>Transaksi Umum</span></a>
      <ul>
        <li <?php if($thisPage == "Transaksi Umum") echo "class='active'"; ?>><a href="../transaksi_umum/transaksi_umum.php">Input Transaksi Umum</a></li>
        <li <?php if($thisPage == "Laporan Transaksi Umum") echo "class='active'"; ?>><a href="../transaksi_umum/laporan_transaksi_umum.php">Laporan Transaksi Umum</a></li>
      </ul>
    </li>
    <li <?php if($thisPage == "Kas") echo "class='active'"; ?>><a href="../kas/kas.php"><i class="icon icon-credit-card"></i> <span>Kas Cozzal</span></a> </li>
    <li <?php if($thisPage == "Account Management") echo "class='active'"; ?>><a href="../account/account_management.php"><i class="icon icon-sitemap"></i> <span>Account Management</span></a> </li>
    <li <?php if($thisPage == "Booking Request") echo "class='active'"; ?>><a href="../booking/booking_request.php"><i class="icon icon-file"></i> <span>Booking Request</span></a> </li>
    <li <?php if($thisPage == "Listing Request") echo "class='active'"; ?>><a href="../unit/listing_request.php"><i class="icon icon-edit"></i> <span>Listing Request</span></a> </li>
    <li class="submenu <?php if($thisPage == "Unit") echo " active"; ?>"> <a href="#"><i class="icon icon-money"></i> <span>Data Unit</span></a>
      <ul>
        <li><a href="../unit/unit.php">List Unit</a></li>
        <li><a href="../unit/task.php">Task Cleaner</a></li>
        <li><a href="../unit/status.php">Status Unit</a></li>
      </ul>
    </li>
    <li class="submenu <?php if($thisPage == "Data") echo " active"; ?>"> <a href="#"><i class="icon icon-th-large"></i> <span>Data</span></a>
      <ul>
        <li <?php if($thisPage == "Penyewa") echo "class='active'"; ?>><a href="../penyewa/penyewa.php"> <span>Penyewa</span></a> </li>
        <li <?php if($thisPage == "Owner") echo "class='active'"; ?>><a href="../owner/owner.php"> <span>Owner</span></a> </li>
        <li <?php if($thisPage == "Apartemen") echo "class='active'"; ?>><a href="../apartemen/apartemen.php"> <span>Apartemen</span></a> </li>
      </ul>
    </li>
	  <li <?php if($thisPage == "Booking_via") echo "class='active'"; ?>><a href="../booking/booking_via.php"><i class="icon icon-pencil"></i> <span>Booking Via</span></a> </li>
	</ul>
</div>
<!--sidebar-menu-->
