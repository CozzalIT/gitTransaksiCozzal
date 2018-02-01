<?php
  require('proses.php');
  $proses = new proses();

//fungsi untuk delete dir dan file nya
function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
        
        foreach( $files as $file )
        {
            delete_files( $file );      
        }
        if(file_exists($target))
        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}

//Delete Penyewa
  if(isset($_GET['delete_penyewa'])){
    $del = $proses->deletePenyewa($_GET['delete_penyewa']);
    header("location:../penyewa.php");
  }

//Delete Apartemen
  if(isset($_GET['delete_apt'])){
    $del = $proses->deleteApartemen($_GET['delete_apt']);
    header("location:../apartemen.php");
  }

//Delete Unit
  if(isset($_GET['delete_unit']) || isset($_GET['kurangi_ju'])){
    $del = $proses->deleteUnit($_GET['delete_unit']);
    if($del=='Success'){
        $del = $proses->deleteDetail_Unit($_GET['delete_unit']);
        $del = $proses->updateKurangi_jumlah_unit_owner($_GET['kurangi_ju']);
        if(file_exists('../img/unit/'.$_GET['delete_unit'])){
            delete_files('../img/unit/'.$_GET['delete_unit']);
        }
    }
    header("location:../unit.php");
  }

//Delete Booking Via
  if(isset($_GET['delete_booking'])){
    $del = $proses->deleteBooking_via($_GET['delete_booking']);
    header("location:../booking_via.php");
  }

//Delete Owner
  if(isset($_GET['delete_owner'])){
	$del = $proses->deleteOwner($_GET['delete_owner']);
	header("location:../owner.php");
  }

//Delete DP Via
  if(isset($_GET['delete_dp'])){
    $del = $proses->deleteDp_via($_GET['delete_dp']);
    header("location:../dp_via.php");
  }

//Delete DP Transakso
  if(isset($_GET['delete_transaksi'])){
    $del = $proses->deleteTransaksi($_GET['delete_transaksi']);
    header("location:../laporan_transaksi.php");
  }
?>
