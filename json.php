<?php
if ($single) {
$result = array();
$result['postcode'] = $row['postcode'];
$result['geo']['lat'] = $lat;
$result['geo']['lng'] = $lng;
$result['geo']['easting'] = $easting;
$result['geo']['northing'] = $northing;
$result['geo']['geohash'] = $geohash;
if ($row['county'] != "00") {
$result['administrative']['county']['title'] = $countytitle;
$result['administrative']['county']['uri'] = "http://statistics.data.gov.uk/id/local-authority/". $row['county'];
$result['administrative']['countyelectoral']['title'] = $edistrict['name'];
$result['administrative']['countyelectoral']['uri'] = $edistrict['uri'];
}
$result['administrative']['district']['title'] = $districttitle;
$result['administrative']['district']['uri'] = "http://statistics.data.gov.uk/id/local-authority/". $row['county'] . $row['district'];
$result['administrative']['ward']['title'] = $wardtitle;
$result['administrative']['ward']['uri'] = "http://statistics.data.gov.uk/id/electoral-ward/". $row['county'] . $row['district'] . $row['ward'];
	
	if ($_GET['callback']) {
	$callback = $_GET['callback'];
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
$json[$num]['uri'] = "http://www.uk-postcodes.com/postcode/". str_replace(" ", "", $row['postcode']);
$num++;
}
echo json_encode($json);
}
?>