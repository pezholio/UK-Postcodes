<?php
require_once("phpcoord-2.3.php");
require_once("jsonwrapper.php");
header('Content-type: application/json');

$easting = $_GET['easting'];
$northing = $_GET['northing'];
$os1 = new OSRef($easting, $northing);
$ll1 = $os1->toLatLng();
$ll1->OSGB36ToWGS84();
$ll = $ll1->toString();
$ll = str_replace(array("(", ")"), "", $ll);
$ll = explode(",", $ll);

$output['lat'] = $ll[0];
$output['lng'] = $ll[1];

echo json_encode($output);
?>