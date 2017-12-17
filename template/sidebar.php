<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li <?php if($thisPage == "Dashboard") echo "class='active'"; ?>><a href="index.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
	<li class="submenu <?php if($thisPage == "Transaksi") echo " active"; ?>"> <a href="transaksi.php"><i class="icon icon-money"></i> <span>Transaksi</span></a>
      <ul>
        <li><a href="transaksi.php">Input Transaksi</a></li>
        <li><a href="laporan_transaksi.php">Laporan Transaksi</a></li>
      </ul>
    </li>
	<li <?php if($thisPage == "Penyewa") echo "class='active'"; ?>><a href="penyewa.php"><i class="icon icon-user"></i> <span>Data Penyewa</span></a> </li>
    <li <?php if($thisPage == "Owner") echo "class='active'"; ?>><a href="owner.php"><i class="icon icon-th-large"></i> <span>Data Owner</span></a> </li>
    <li <?php if($thisPage == "Apartemen") echo "class='active'"; ?>><a href="apartemen.php"><i class="icon icon-columns"></i> <span>Data Apartemen</span></a> </li>
    <li <?php if($thisPage == "Unit") echo "class='active'"; ?>><a href="unit.php"><i class="icon icon-home"></i> <span>Data Unit</span></a> </li>
	<li <?php if($thisPage == "Booking_via") echo "class='active'"; ?>><a href="booking_via.php"><i class="icon icon-pencil"></i> <span>Booking Via</span></a> </li>
	<li <?php if($thisPage == "Dp_via") echo "class='active'"; ?>><a href="dp_via.php"><i class="icon icon-strikethrough"></i> <span>Dp Via</span></a> </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Sub Menu</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="form-common.html">Basic Form</a></li>
        <li><a href="form-validation.html">Form with Validation</a></li>
        <li><a href="form-wizard.html">Form with Wizard</a></li>
      </ul>
    </li>
	<li>
	  <ul>
	  <ul>
	</li>
  </ul>
</div>
<!--sidebar-menu-->
