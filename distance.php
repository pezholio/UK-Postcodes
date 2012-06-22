<?php
require_once("db.php");

$link = mysql_connect('localhost', $db_username, $db_password);
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

$distance = mysql_real_escape_string($_GET['distance']);

$result = mysql_query("SELECT *, ( 3959 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance FROM postcodes HAVING distance <= $distance ORDER BY distance");

if ($_GET['format'] == "xml" || $_SERVER['HTTP_ACCEPT'] == "application/xml") {
header ("content-type: application/xml");
include("xml.php");
} elseif ($_GET['format'] == "kml" || $_SERVER['HTTP_ACCEPT'] == "application/vnd.google-earth.kml+xml") {
header ("content-type: application/vnd.google-earth.kml+xml");
include("kml.php");
} elseif ($_GET['format'] == "csv" || $_SERVER['HTTP_ACCEPT'] == "text/csv") {
header("Content-type: application/octet-stream");
include("csv.php");
} elseif ($_GET['format'] == "json" || $_SERVER['HTTP_ACCEPT'] == "application/json") {
header('Content-type: application/json');
include("json.php");
} elseif ($_GET['format'] == "rdf" || $_SERVER['HTTP_ACCEPT'] == "application/rdf+xml") {
header ("Content-type: application/rdf+xml");
include("rdf.php");
} else {
header ("content-type: text/html");
include("result.php");
} 

mysql_close($link);
