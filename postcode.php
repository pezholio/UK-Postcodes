<?php
require_once("xmlparse.php");
require_once("phpcoord-2.3.php");
require_once("electoraldistrict.php");

$db_name     = '';
$db_username = '';
$db_password = '';

mysql_connect('localhost', $db_username, $db_password);
mysql_select_db($db_name) or die(mysql_error());

if ($_GET['postcode']) {

	$postcode = mysql_real_escape_string($_GET['postcode']);
	
if ($postcode != strtoupper($postcode)) {
	header ('HTTP/1.1 301 Moved Permanently');
	
	if (strlen($_GET['format']) > 0) {
		header("Location: http://www.uk-postcodes.com/postcode/".strtoupper($postcode).".".$_GET['format']);
	} else {
		header("Location: http://www.uk-postcodes.com/postcode/".strtoupper($postcode));
	}
}

	$result = mysql_query("SELECT * FROM postcodes WHERE REPLACE(postcode,' ','') = '$postcode'");

} else {
	$lat = mysql_real_escape_string($_GET['lat']);
	$lng = mysql_real_escape_string($_GET['lng']);
	$result = mysql_query("SELECT *, ( 3959 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance FROM postcodes ORDER BY distance LIMIT 0,1");
	$_GET['format'] = str_replace(".", "", $_GET['format']);
}

$single = TRUE;

$num_rows = mysql_num_rows($result);

if ($num_rows == 0) {
	header("HTTP/1.0 404 Not Found");
	include("404.php");
} else {

	$row = mysql_fetch_array($result);
	
	$lat = $row['lat'];
	$lng = $row['lng'];
	
	$ll2w = new LatLng($lat, $lng);
	$ll2w->WGS84ToOSGB36();
	$os2w = $ll2w->toOSRef();
	$eastingnorthing = $os2w->toSplitString();
	
	$easting = $eastingnorthing['easting'];
	$northing = $eastingnorthing['northing'];
	
	$geohash = file_get_contents("http://geohash.org?q=".$lat.",".$lng."&format=url");

if ($row['county'] != "00") {
$county = get_xml("http://statistics.data.gov.uk/doc/local-authority/". $row['county'] .".rdf");
$countytitle = $county['rdf:RDF']['rdf:Description'][0]['skos:prefLabel']['value'];
$countycode = $county['rdf:RDF']['rdf:Description'][0]['skos:notation']['value'];

$edistrict = electoralDistrict($easting, $northing);
}

$district = get_xml("http://statistics.data.gov.uk/doc/local-authority/". $row['county'] . $row['district'] .".rdf");
$districttitle = $district['rdf:RDF']['rdf:Description'][0]['skos:prefLabel']['value'];
$districtcode = $district['rdf:RDF']['rdf:Description'][0]['skos:notation']['value'];

$ward = get_xml("http://statistics.data.gov.uk/doc/electoral-ward/". $row['county'] . $row['district'] . $row['ward'] .".rdf");
$wardtitle = $ward['rdf:RDF']['rdf:Description'][0]['rdfs:label'][1]['value'];

if ($_GET['format'] == "xml" || $_SERVER['HTTP_ACCEPT'] == "application/xml") {
	header ("content-type: application/xml");
	include("xml.php");
} elseif ($_GET['format'] == "json" || $_SERVER['HTTP_ACCEPT'] == "application/json") {
	header('Content-type: application/json');
	include("json.php");
} elseif ($_GET['format'] == "rdf" || $_SERVER['HTTP_ACCEPT'] == "application/rdf+xml") {
	header ("Content-type: application/rdf+xml");
	include("rdf.php");
} elseif ($_GET['format'] == "csv" || $_SERVER['HTTP_ACCEPT'] == "text/csv") {
	header("Content-type: application/octet-stream");
	include("csv.php");
} elseif (strlen($_GET['format']) == 0) {
	header ("content-type: text/html");
	include("result.php");
}

}
?>