<?php
$db_name     = '';
$db_username = '';
$db_password = '';

mysql_connect('localhost', $db_username, $db_password);
mysql_select_db($db_name) or die(mysql_error());

if ($_GET['postcode']) {
$postcode = addslashes($_GET['postcode']);
$result = mysql_query("SELECT * FROM postcodes WHERE REPLACE(postcode,' ','') = '$postcode'");
$row = mysql_fetch_array($result);
$lat = $row['lat'];
$lng = $row['lng'];
$postcode = $row['postcode'];
$title = $postcode;
} else {
$lat = addslashes($_GET['lat']);
$lng = addslashes($_GET['lng']);
$title = $lat .",". $lng;
}

$distance = addslashes($_GET['distance']);

$result = mysql_query("SELECT *, ( 3959 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance FROM postcodes HAVING distance <= $distance ORDER BY distance");

if ($_GET['format'] == "xml") {
header ("content-type: text/xml");
include("xml.php");
} elseif ($_GET['format'] == "kml") {
header ("content-type: application/vnd.google-earth.kml+xml");
include("kml.php");
} elseif ($_GET['format'] == "csv") {
header("Content-type: application/octet-stream");
include("csv.php");
} elseif ($_GET['format'] == "json") {
header('Content-type: application/json');
include("json.php");
} elseif ($_GET['format'] == "rdf") {
header ("Content-type: application/rdf+xml");
include("rdf.php");
?>
<?php
} else {
header ("content-type: text/html");
include("result.php");
} 
?>
