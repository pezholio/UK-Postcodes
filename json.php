<?php
require 'jsonwrapper.php';

if ($single) {
$result = array();
$result['postcode'] = $row['postcode'];
$result['geo']['lat'] = $lat;
$result['geo']['lng'] = $lng;
$result['geo']['easting'] = $easting;
$result['geo']['northing'] = $northing;
$result['geo']['geohash'] = $geohash;
$result['administrative']['constituency']['title'] = $constituencytitle;
$result['administrative']['constituency']['uri'] = $constituencyuri;
$result['administrative']['constituency']['code'] = $constituencycode;
if (!strstr($row['countygss'], "99999999")) {
$result['administrative']['county']['title'] = $countytitle;
$result['administrative']['county']['uri'] = "http://statistics.data.gov.uk/id/local-authority/". $row['countysnac'];
$result['administrative']['county']['snac'] = $row['countysnac'];
$result['administrative']['countyelectoral']['title'] = $edistrict['name'];
$result['administrative']['countyelectoral']['uri'] = $edistrict['uri'];
$result['administrative']['countyelectoral']['code'] = $edistrict['code'];
}
$result['administrative']['district']['title'] = $districttitle;
$result['administrative']['district']['uri'] = "http://statistics.data.gov.uk/id/local-authority/". $row['councilsnac'];
$result['administrative']['district']['snac'] = $row['councilsnac'];
$result['administrative']['ward']['title'] = $wardtitle;
$result['administrative']['ward']['uri'] = "http://statistics.data.gov.uk/id/electoral-ward/". $row['wardsnac'];
$result['administrative']['ward']['snac'] = $row['wardsnac'];
if (strlen($parishname) > 0) {
$result['administrative']['parish']['title'] = $parishname;
$result['administrative']['parish']['uri'] = $parishuri;
$result['administrative']['parish']['snac'] = $parishcode;
}
	
	if ($callback) {
	echo $callback . '(' . json_encode($result) . ')';
	} else {
	echo json_encode($result);
	}
} elseif ($distance) {
$json = array();
$num = 0;
while ($row = mysql_fetch_array($result)) {
$json[$num]['postcode'] = $row['postcode'];
$json[$num]['lat'] = $row['lat'];
$json[$num]['lng'] = $row['lng'];
$json[$num]['distance'] = $row['distance'];
$json[$num]['uri'] = "http://".$_SERVER['SERVER_NAME']."/postcode/". str_replace(" ", "", $row['postcode']);
$num++;
}
	if ($callback) {
	echo $callback . '(' . json_encode($json) . ')';
	} else {
	echo json_encode($json);
	}
}
?>