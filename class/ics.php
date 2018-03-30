<?php
/**
 * ICS.php
 * =======
 * Use this class to create an .ics file.
 *
 * Usage
 * -----
 * Basic usage - generate ics file contents (see below for available properties):
 *   $ics = new ICS($props);
 *   $ics_file_contents = $ics->to_string();
 *
 * Setting properties after instantiation
 *   $ics = new ICS();
 *   $ics->set('summary', 'My awesome event');
 *
 * You can also set multiple properties at the same time by using an array:
 *   $ics->set(array(
 *     'dtstart' => 'now + 30 minutes',
 *     'dtend' => 'now + 1 hour'
 *   ));
 *
 * Available properties
 * --------------------
 * description
 *   String description of the event.
 * dtend
 *   A date/time stamp designating the end of the event. You can use either a
 *   DateTime object or a PHP datetime format string (e.g. "now + 1 hour").
 * dtstart
 *   A date/time stamp designating the start of the event. You can use either a
 *   DateTime object or a PHP datetime format string (e.g. "now + 1 hour").
 * location
 *   String address or description of the location of the event.
 * summary
 *   String short summary of the event - usually used as the title.
 * url
 *   A url to attach to the the event. Make sure to add the protocol (http://
 *   or https://).
 */
class ICS {
  const DT_FORMAT = 'Ymd\THis\Z';
  protected $properties = array();
  protected $ics_props = array();
  protected $file_nama;
  protected $file_handle;
  private $available_properties = array(
    'description',
    'dtend',
    'dtstart',
    'location',
    'summary',
    'url'
  );

  public function __construct($name_file) {
    $this->file_nama = $name_file;
  }

  public function change_file($new_file){
    $this->file_nama = $new_file;
  }

  public function create_ical(){
    $this->ics_props = array();
    $this->build_props('new');    
  }

  public function add_event($props){
    $this->set($props);
    $this->build_props('add');
  }
  
  public function to_string() {
    $rows = $this->build_props('build');
    $myfile = fopen($this->file_nama, "w") or die("Unable to open file!");
    fwrite($myfile, implode("\r\n", $rows));
    fclose($myfile);    
    return 'Success';
  }

  public function cal_to_array(){
    $global_array = array(); $i = 0;
    $this->file_handle = fopen($this->file_nama, "r") or die("Unable to open file!");
    while(!feof($this->file_handle)){
      $isi = fgets($this->file_handle);
      if($isi=="BEGIN:VEVENT\n"){
        $arr_temp = array(); 
        while($isi!="END:VEVENT\n"){
          $isi = fgets($this->file_handle);
          if($isi[0]!=" "){
            $meta1 = $this->formating_content($isi);
            $arr_temp[$meta1['NAME']] = $meta1['VALUE'];
          }
        }
        $global_array[$i] = $arr_temp;
        $i++;
      }
    }
    fclose($this->file_handle);
    return $global_array;
  }
//private function  

  private  function formating_content($isi){
    $ret_arr = array();
    $meta2 = explode(":", $isi);
    if($meta2[0]=='DESCRIPTION'){
      $ret_arr['NAME'] = 'PHONE';
      $tmp = fgets($this->file_handle);
      $trash = fgets($this->file_handle);
      $meta3 = explode("n", $tmp);
      $ret_arr['VALUE'] = str_replace($meta3[0][strlen($meta3[0])-1], "", $meta3[0]);
    } else {
      $ret_arr['NAME'] = $meta2[0];
      $ret_arr['VALUE'] = $meta2[1];   
    }
    return $ret_arr;
  }

  private function set($key, $val = false) {
    if (is_array($key)) {
      foreach ($key as $k => $v) {
        $this->set($k, $v);
      }
    } else {
      if (in_array($key, $this->available_properties)) {
        $this->properties[$key] = $this->sanitize_val($val, $key);
      }
    }
  }

  private function build_props($type) {
    // Build ICS properties - add header
    if($type=='new'){
      $this->ics_props[] = 'BEGIN:VCALENDAR';
      $this->ics_props[] = 'PRODID:-//hacksw/handcal//NONSGML v1.0//EN';
      $this->ics_props[] = 'VERSION:2.0';
      $this->ics_props[] = 'CALSCALE:GREGORIAN';
    } 
    elseif($type=='add'){
      // Build ICS properties - add header
      $this->ics_props[] = 'BEGIN:VEVENT';
      $props = array();
      foreach($this->properties as $k => $v) {
        $props[strtoupper($k . ($k === 'url' ? ';VALUE=URI' : ''))] = $v;
      }
      // Set some default values
      $props['DTSTAMP'] = $this->format_timestamp('now');
      $props['UID'] = uniqid();
      // Append properties
      foreach ($props as $k => $v) {
        $this->ics_props[] = "$k:$v";
      }
      $this->ics_props[] = 'END:VEVENT';
    }
    elseif($type=='build'){
      // Build ICS properties - add footer
      $this->ics_props[] = 'END:VCALENDAR';
      return $this->ics_props;
    }
  }

  private function sanitize_val($val, $key = false) {
    switch($key) {
      case 'dtend':
      case 'dtstamp':
      case 'dtstart':
        $val = $this->format_timestamp($val);
        break;
      default:
        $val = $this->escape_string($val);
    }
    return $val;
  }

  private function format_timestamp($timestamp) {
    $dt = new DateTime($timestamp);
    return $dt->format(self::DT_FORMAT);
  }

  private function escape_string($str) {
    return preg_replace('/([\,;])/','\\\$1', $str);
  }
}