<?php 
  require("../class/unit.php");
  require("../class/apartemen.php");
  require("../class/booking.php");  
  require("../class/kas.php");
  require("../../config/database.php");

  	if($_POST['request']=="showNo_unitByApt" && isset($_POST['key'])){
  		if($_POST['key']=="kaf9lals"){
  			$kd_apt = $_POST['id'];
  			$unit = new Unit($db);
  			$show = $unit->showUnitByApt($kd_apt);
  			$response = array();

  			while($data = $show->fetch(PDO::FETCH_OBJ)){	
  				$response[] = array(
	              	"kd_unit"  => $data->kd_unit,
	              	"no_unit" => $data->no_unit
  				);
  			}
  			echo json_encode($response);
  		} else {
  			echo "UNAUTHORIZED";
  		}

  	} 

  	elseif($_POST['request']=="showListAptName" && isset($_POST['key'])){
  		if($_POST['key']=="kaf9l4ls"){
  			$apt = new Apartemen($db);
  			$show = $apt->showApartemen();
  			$response = array();

  			while($data = $show->fetch(PDO::FETCH_OBJ)){	
  				$response[] = array(
	              	"kd_apt"  => $data->kd_apt,
	              	"nama_apt" => $data->nama_apt
  				);
  			}
  			echo json_encode($response);
  		} else {
  			echo "UNAUTHORIZED";
  		}
  	}

  	elseif($_POST['request']=="showListKas" && isset($_POST['key'])){
  		if($_POST['key']=="p4f9l4l5"){
  			$kas = new Kas($db);
  			$show = $kas->showKas();
  			$response = array();

  			while($data = $show->fetch(PDO::FETCH_OBJ)){	
  				$response[] = array(
	              	"kd_kas"  => $data->kd_kas,
	              	"sumber_dana" => $data->sumber_dana
  				);
  			}
  			echo json_encode($response);
  		} else {
  			echo "UNAUTHORIZED";
  		}
  	}

    elseif($_POST['request']=="showListBooking_via" && isset($_POST['key'])){
      if($_POST['key']=="mf0m4ol5"){
        $kas = new Booking($db);
        $show = $kas->showBooking_via();
        $response = array();

        while($data = $show->fetch(PDO::FETCH_OBJ)){  
          $response[] = array(
                  "kd_booking"  => $data->kd_booking,
                  "booking_via" => $data->booking_via
          );
        }
        echo json_encode($response);
      } else {
        echo "UNAUTHORIZED";
      }
    }

?>