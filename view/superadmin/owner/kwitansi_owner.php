<?php
  if(!empty($_POST['kd_transaksi'])) {
    foreach($_POST['kd_transaksi'] as $kd_transaksi) {
      echo 'COZ-'.strtoupper(dechex($kd_transaksi)).'<br>';
    }
  }
?>
