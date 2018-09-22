<?php
Class Other {
  public function selectColor($index){
    switch($index){
      case 1:
        $color = 'red';
        break;
      case 2:
        $color = 'orange';
        break;
      case 3;
        $color = 'yellow';
        break;
      case 4:
        $color = 'green';
        break;
      case 5:
        $color = 'grey';
        break;
      case 6;
        $color = 'purple';
        break;
      case 7;
        $color = 'blue';
      break;
    }
    return $color;
  }

  public function cekKabisat($tahun){
    if($tahun % 400 == 0){
      return true;
    }else if(($tahun % 4 == 0) && ($tahun % 100 != 1) && ($tahun % 400 != 0)){
      return true;
    }else{
      return false;
    }
  }

  public function cekJumHari($kabisat, $bulan){
    if($kabisat && ($bulan==2)){
      $jumlahHari = 29;
    }else{
      switch($bulan){
        case 1:
          $jumlahHari = 31;
          break;
        case 2:
          $jumlahHari = 28;
          break;
        case 3:
          $jumlahHari = 31;
          break;
        case 4:
          $jumlahHari = 30;
          break;
        case 5:
          $jumlahHari = 31;
          break;
        case 6:
          $jumlahHari = 30;
          break;
        case 7:
          $jumlahHari = 31;
          break;
        case 8:
          $jumlahHari = 31;
          break;
        case 9:
          $jumlahHari = 30;
          break;
        case 10:
          $jumlahHari = 31;
          break;
        case 11:
          $jumlahHari = 30;
          break;
        default:
          $jumlahHari = 31;
          break;
      }
    }
    return $jumlahHari;
  }

}
?>
