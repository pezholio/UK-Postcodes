<?php
if ($single) {
header("Content-Disposition: attachment; filename=\"". $postcode .".csv\"");
echo $postcode .",". $lat .",". $lng. ",". $easting .",". $northing .",". $geohash .",". $row['countysnac'] . ",". $countytitle . ",".$edistrict['name'].",".$edistrict['code'].",".$row['councilsnac'] .",". $districttitle .",". $row['wardsnac'].",".$wardtitle;
} elseif ($distance) {
header("Content-Disposition: attachment; filename=\"".$distance." miles of ". $title .".csv\"");
while ($row = mysql_fetch_array($result)) {
echo $row['postcode'] .",". $row['lat'] .",". $row['lng']. ",http://www.uk-postcodes.com/postcode/". str_replace(" ", "", $row['postcode']) ."\r\n";
}
}
?>