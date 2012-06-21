<?php
require_once("db.php");
require_once("xmlparse.php");
require_once("phpcoord-2.3.php");
require_once("json.php");
//require_once("electoraldistrict.php");

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
		exit;
	}

	if (strstr($postcode, " ")) {
		header ('HTTP/1.1 301 Moved Permanently');
	
		if (strlen($_GET['format']) > 0) {
			header("Location: http://www.uk-postcodes.com/postcode/".str_replace(" ", "", $postcode).".".$_GET['format']);
		} else {
			header("Location: http://www.uk-postcodes.com/postcode/".str_replace(" ", "", $postcode));
		}
		exit;
	}

	if (strlen($postcode) == 6) {
		$postcode = substr($postcode, 0, 3) ." ". substr($postcode, 3, 3);
	} elseif (strlen($postcode) == 5) {
		$postcode = substr($postcode, 0, 2) ."  ". substr($postcode, 2, 3);
	}

	$result = mysql_query("SELECT postcode, lat, lng, easting, northing, postcodes.county AS countygss, counties.county AS countyname, counties.snacid AS countysnac, postcodes.council AS councilgss, councils.snacid AS councilsnac, councils.council AS councilname, postcodes.ward AS wardgss, wards.ward as wardname, wards.snacid as wardsnac, postcodes.constituency AS constituencygss, constituencies.constituency AS constituencyname, constituencies.snacid AS constituencycode, postcodes.parish AS parishgss, parishes.snacid AS parishsnac, parishes.parish AS parishname FROM postcodes LEFT JOIN councils ON postcodes.council = councils.code LEFT JOIN wards ON postcodes.ward = wards.code LEFT JOIN counties ON postcodes.county = counties.code LEFT JOIN constituencies ON postcodes.constituency = constituencies.code LEFT JOIN parishes ON postcodes.parish = parishes.code WHERE postcodes.postcode = '$postcode' LIMIT 0,1");

} else {
	$lat = mysql_real_escape_string($_GET['lat']);
	$lng = mysql_real_escape_string($_GET['lng']);
	$result = mysql_query("SELECT postcode, ( 3959 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance FROM postcodes ORDER BY distance LIMIT 0,1");
	$row = mysql_fetch_array($result);
	
	$query = "SELECT postcode, lat, lng, easting, northing, postcodes.county AS countygss, counties.county AS countyname, counties.snacid AS countysnac, postcodes.council AS councilgss, councils.snacid AS councilsnac, councils.council AS councilname, postcodes.ward AS wardgss, wards.ward as wardname, wards.snacid as wardsnac, postcodes.constituency AS constituencygss, constituencies.constituency AS constituencyname, constituencies.snacid AS constituencycode, postcodes.parish AS parishgss, parishes.snacid AS parishsnac, parishes.parish AS parishname FROM postcodes LEFT JOIN councils ON postcodes.council = councils.code LEFT JOIN wards ON postcodes.ward = wards.code LEFT JOIN counties ON postcodes.county = counties.code LEFT JOIN constituencies ON postcodes.constituency = constituencies.code LEFT JOIN parishes ON postcodes.parish = parishes.code WHERE postcodes.postcode = '$row[postcode]' LIMIT 0,1";
	$result = mysql_query($query);
	$_GET['format'] = str_replace(".", "", $_GET['format']);
}

$single = TRUE;

$num_rows = mysql_num_rows($result);

if ($num_rows == 0) {
	header("HTTP/1.0 404 Not Found");
	include("404.php");
	exit;
}

$row = mysql_fetch_array($result);

$updatepostcode = $row['postcode'];

if (!strstr(" ", $row['postcode'])) {
	$row['postcode'] = substr($row['postcode'], 0, 4) ." ". substr($row['postcode'], -3);
}

$lat = $row['lat'];
$lng = $row['lng'];

$easting = 	$row['easting'];
$northing = $row['northing'];

$geohash = file_get_contents("http://geohash.org?q=".$lat.",".$lng."&format=url");

$mapit = null;
if (!strstr($row['countygss'], "99999999")) {

	$countytitle = $row['countyname'];
	$countycode = $row['countysnac'];

	if (strlen($row['electoraldistrict']) == 0) {
		
		$mapit = json_decode(file_get_contents("http://mapit.mysociety.org/postcode/". urlencode($updatepostcode) .".json"));
					
		foreach ($mapit->areas as $area) {
			if ($area->type_name == "County council ward") {
				$edistrict['uri'] = "http://data.ordnancesurvey.co.uk/doc/7". str_pad($area->codes->unit_id, 15, "0", STR_PAD_LEFT);
				$edistrict['code'] = $area->codes->unit_id;
				$edistrict['name'] = $area->name;
			}
		}
	
		mysql_query("UPDATE postcodes SET electoraldistrict = '$edistrict[code]' WHERE postcode = '$updatepostcode'");	
	}

}

$districttitle = $row['councilname'];
$districtcode = $row['councilsnac'];

$wardtitle = $row['wardname'];

// Fix for NI wards, who have the "GSS" code, not the Snac in URIs
if (strlen($row['wardgss']) == "6") {
	$wardcode = $row['wardgss'];
	$row['wardsnac'] = str_replace(" ", "_", $row['wardgss']);
} else {
	$wardcode = $row['wardsnac'];
}

$constituencycode = $row['constituencycode'];
$constituencytitle = $row['constituencyname'];

if (strlen($constituencycode) == 3) {
	$ngnote = "<em>(Irish National Grid)</em>";
	$constituencyuri = "http://statistics.data.gov.uk/doc/parliamentary-constituency/". $constituencycode ;
} else {
	$constituencyuri = "http://data.ordnancesurvey.co.uk/doc/7". str_pad($constituencycode, 15, "0", STR_PAD_LEFT);
}

if (strlen($row['parish'] == 0)) {

	if (!$mapit) {
		$mapit = json_decode(file_get_contents("http://mapit.mysociety.org/postcode/". urlencode($updatepostcode) .".json"));
	}

	foreach ($mapit->areas as $area) {
		if ($area->type_name == "Civil Parish") {
			$parishcode = $area->codes->ons;
			$parishuri = "http://data.ordnancesurvey.co.uk/doc/7". str_pad($area->codes->unit_id, 15, "0", STR_PAD_LEFT);
			$parishname = $area->name;
		}
	}

	mysql_query("UPDATE postcodes SET parish = '$parishcode' WHERE postcode = '$updatepostcode'");

} else {
	$parishname = $row['parishname'];
	$parishcode = $row['parishsnac'];
}

// Santa Easter Egg

if ($row['postcode'] == "SAN  TA1") {
	$row['postcode'] = "SAN TA1";
	$constituencytitle = "North Pole";
	$constituencyuri = "http://www.northpole.com/";
	$districttitle = "Reindeerland";
	$row['countygss'] = "99999999";
	$wardtitle = "Santa’s Grotto";
	$easting = "N/A";
	$northing = "N/A";
} 

if ($_GET['format'] == "xml" || $_SERVER['HTTP_ACCEPT'] == "application/xml") {
	header ("content-type: application/xml");
	include("xml.php");
} elseif ($_GET['format'] == "json" || $_SERVER['HTTP_ACCEPT'] == "application/json") {
	$callback = $_GET['callback'];
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

