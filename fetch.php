<?php
/*Written By: Andy 'shad0wMaster' Kukuc*/

/*secret file container*/
  require_once __DIR__.'/../vendor/autoload.php';
  $dotenv=Dotenv\Dotenv::createImmutable(dirname(__DIR__).'/');
  $dotenv->load();
  /*load decryption key*/
  //$keycontents=file_get_contents('/usr/local/key');
  //$decryption_key=\Defuse\Crypto\Key::loadFromAsciiSafeString($keycontents);
  /*encrypt everything*/
  //$encrypted_username=Defuse\Crypto\Crypto::encrypt($_ENV['username'],$decryption_key,$raw_binary=false);
  //$encrypted_password=Defuse\Crypto\Crypto::encrypt($_ENV['password'],$decryption_key,$raw_binary=false);
  /*decrypt everything*/
  //$decrypted_username=Defuse\Crypto\Crypto::decrypt($encrypted_username,$decryption_key,$raw_binary=false);
  //$decrypted_password=\Defuse\Crypto\Crypto::decrypt($encrypted_password,$decryption_key,$raw_binary=false);
/***********************/

//epoch time converter so basically convert todays date to epoch and return the data from a specific time in point so it will be minutes
$current_time=time()*1000;
//print($current_time."\n");
//$converted_time=$current_time-3600000;
//$converted_time=$current_time-86400000;
/*week ago*/ $converted_time=$current_time-604800000;
//print($converted_time."\n");
/***********************************************************************************************************************************************************************/
//$remote_url_main='https://cloud.estimote.com/v3/lte/device_events?app_id=yjFaxdjn4z&app_release=0&since='.$converted_time;
$remote_url_blue_beacon='https://cloud.estimote.com/v3/lte/device_events?identifier=9b863659fd9527ba6b18e62262a4ae11&since='.$converted_time;
$remote_url_green_beacon='https://cloud.estimote.com/v3/lte/device_events?identifier=d784a2665ab1f35079bcec89588d5d1d&since='.$converted_time;

$opts=array('http'=>array('method'=>"GET",'header'=>"Authorization: Basic ".base64_encode(("".$_ENV['username'].":".$_ENV['password'].""))));

$context=stream_context_create($opts);

// Open the file using the HTTP headers set abov
$file_green_beacon=file_get_contents($remote_url_green_beacon, false, $context);
$file_blue_beacon=file_get_contents($remote_url_blue_beacon,false,$context);

//new code for testing
$json_green=json_decode($file_green_beacon,true);
$json_blue=json_decode($file_blue_beacon,true);
$size=json_size($json_blue,$json_green);

//yes location data blue beacon
//echo print_r($json_blue,true);

//yes location data green beacon
//echo print_r($json_green,true);

//name space
$return_long;
$return_speed;
$return_lat;
$temperature_1;
/*Used for calculating mean (average) $temperature_average;*/
/*Used to find the lowest temperature in array $temperature_lowest_point;*/
$return_correct_beacon_ids;
$beacon_identifer_array=["9b863659fd9527ba6b18e62262a4ae11"/*Blue Beacon*/,"d784a2665ab1f35079bcec89588d5d1d"/*Green Beacon*/];
function getbeaconids($json_meth){
  global $size;
  global $beacon_identifer_array;
  global $return_correct_beacon_ids;
  for($i=0;$i<$size-1;$i++){
    if($json_meth['data'][$i]['device_identifier']===$beacon_identifer_array[0]){
      $return_correct_beacon_ids===print "Truck 1 Blue";
      break;
    }
    if($json_meth['data'][$i]['device_identifier']===$beacon_identifer_array[1]){
      $return_correct_beacon_ids===print "Truck 2 Green";
      break;
    }
  }

}
function math_on_meth($json_meth){
  global $size;
  global $temperature_1;
  /* Needed to get average and lowest
  global $temperature_average;
  global $temperature_lowest_point;
  $mean===0;
  $num===0;
  $lowest===0;
  */
  $latest=0;
  $run_once=0;
  for($i=0;$i<$size-1;$i++){
    $container=round($json_meth['data'][$i]['payload']['temperature'],1);
    if($run_once==0){
      //$lowest=$container;
      $latest=$container;
      $run_once++;
    }/* Could be added for future release not necessary now returns the average mean and lowest temperature point found in array.
    $mean+=$container;
    $num++;
    if($container<=$lowest){
      $lowest===$container;
    }*/
  }
  $temperature1=$latest;
  $converted_to_fahrenheit=round(($latest*9/5)+32,1);
  echo $converted_to_fahrenheit." &#8457";
  //$temperature_average="${name} Average: ".round($mean/$num,2);
  //$temperature_lowest_point="${name} Lowest One: ".$lowest."\n"."\n";
}
function find_latest_gps_data($json_meth){
  global $return_long;
  global $return_speed;
  global $return_lat;
  global $size;
  $kilo=1.609344;
  for($i=0;$i<$size-1;$i++){
    $return_speed=round($json_meth['data'][$i]['payload']['speed'],2);//kilometer by default
    $convert_to_mph=round($return_speed/$kilo,1);
    echo $convert_to_mph." mph";
    $return_lat=round($json_meth['data'][$i]['payload']['lat'],5);
    echo "<td id=lat_map_data>".$return_lat."</td>";
    $return_long=round($json_meth['data'][$i]['payload']['long'],5);
    echo "<td id=long_map_data>".$return_long."</td>";
    break;
  }
}
function json_size($json_meth){
  $size=0;
  for($i=0;$i<count($json_meth['data']);$i++) {
    $size++;
  }
  return $size;
}
?>
