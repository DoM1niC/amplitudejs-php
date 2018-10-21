<?php
require "../includes/autoload.php";
$SERVER = $LiveStats; //URL TO YOUR ICECAST SERVER
$STATS_FILE = '/status.xsl'; //PATH TO STATUS.XSL PAGE YOU CAN SEE IN YOUR BROWSER (LEAVE BLANK UNLESS DIFFERENT)

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,$SERVER.$STATS_FILE);

curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

//$output = our stauts.xsl file
$output = curl_exec($ch);

//close curl resource to free up system resources
curl_close($ch);

//build array to store our radio stats for later use
$radio_info = array();
$radio_info['server'] = $SERVER;
$radio_info['title'] = '';
$radio_info['description'] = '';
$radio_info['content_type'] = '';
$radio_info['mount_start'] = '';
$radio_info['bit_rate'] = '';
$radio_info['listeners'] = '';
$radio_info['most_listeners'] = '';
$radio_info['genre'] = '';
$radio_info['url'] = '';
$radio_info['now_playing'] = array();
   $radio_info['now_playing']['artist'] = '';
   $radio_info['now_playing']['track'] = '';

//loop through $ouput and sort into our different arrays
$temp_array = array();

$search_for = "<td\s[^>]*class=\"streamstats\">(.*)<\/td>";
$search_td = array('<td class="streamstats">','</td>');

if(preg_match_all("/$search_for/siU",$output,$matches)) {
   foreach($matches[0] as $match) {
      $to_push = str_replace($search_td,'',$match);
      $to_push = trim($to_push);
      array_push($temp_array,$to_push);
   }
}

//sort our temp array into our ral array
$radio_info['title'] = $temp_array[0];
$radio_info['description'] = $temp_array[1];
$radio_info['bit_rate'] = $temp_array[4];
$radio_info['listeners'] = $temp_array[5];
$radio_info['genre'] = $temp_array[7];

$x = explode(" - ",$temp_array[9]);
$radio_info['now_playing']['artist'] = $x[0];
$radio_info['now_playing']['track'] = $x[1];
?>
<?= $temp_array[5] ?>