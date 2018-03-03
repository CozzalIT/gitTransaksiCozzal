<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li <?php if($thisPage == "Dashboard") echo "class='active'"; ?>><a href="../home/home.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>	
    <li <?php if($thisPage == "Status") echo "class='active'"; ?>><a href="../unit/status.php"><i class="icon icon-file"></i> <span>Status Unit</span></a> </li>
    <li <?php if($thisPage == "Task") echo "class='active'"; ?>><a href="../unit/task.php"><i class="icon icon-edit"></i> <span>Task Cleaner</span></a> </li>  
</ul>
</div>
<!--sidebar-menu-->