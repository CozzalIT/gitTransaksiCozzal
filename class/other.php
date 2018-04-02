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

}
?>
