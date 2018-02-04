<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li <?php if($thisPage == "Dashboard") echo "class='active'"; ?>><a href="home.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li <?php if($thisPage == "Unit") echo "class='active'"; ?>><a href="unit.php"><i class="icon icon-edit"></i> <span>Listing Unit</span></a> </li>
	  <li <?php if($thisPage == "Booking_via") echo "class='active'"; ?>><a href="booking_via.php"><i class="icon icon-pencil"></i> <span>Request Unit</span></a> </li>
  </ul>
</div>
<!--sidebar-menu-->
