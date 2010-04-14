<?php
function myWithin($myPolygon,$point) {
$counter = 0;
// get rid of unnecessary stuff
$myPolygon = str_replace("MULTIPOLYGON","",$myPolygon);
$myPolygon = str_replace("(","",$myPolygon);
$myPolygon = str_replace(")","",$myPolygon);
$point = str_replace("POINT","",$point);
$point = str_replace("(","",$point);
$point = str_replace(")","",$point);
// make an array of points of the polygon
$polygon = explode(",",$myPolygon);
// get the x and y coordinate of the point
$p = explode(" ",$point);
$px = $p[0];
$py = $p[1];
// number of points in the polygon
$n = count($polygon);
$poly1 = $polygon[0];
for ($i=1; $i <= $n; $i++) {
$poly1XY = explode(" ",$poly1);
$poly1x = $poly1XY[0];
$poly1y = $poly1XY[1];
$poly2 = $polygon[$i % $n];
$poly2XY = explode(" ",$poly2);
$poly2x = $poly2XY[0];
$poly2y = $poly2XY[1];
if ($py > min($poly1y,$poly2y)) {
if ($py <= max($poly1y,$poly2y)) {
if ($px <= max($poly1x,$poly2x)) {
if ($poly1y != $poly2y) {
$xinters = ($py-$poly1y)*($poly2x-$poly1x)/($poly2y-$poly1y)+$poly1x;
if ($poly1x == $poly2x || $px <= $xinters) {
$counter++;
}
}
}
}
}
$poly1 = $poly2;
} // end of While each polygon
if ($counter % 2 == 0) {
return FALSE; // outside
} else {
return TRUE; // inside
}
}

function electoralDistrict($easting, $northing) {

$result = mysql_query("SELECT *, AsText(ogc_geom) AS myPolygon FROM `county_electoral_division_region` WHERE Contains(`ogc_geom`, GeomFromText('Point($easting $northing)'))");

while ($row = mysql_fetch_array($result)) {
if (myWithin($row['myPolygon'], $easting." ".$northing) === TRUE) {
$district['uri'] = "http://data.ordnancesurvey.co.uk/doc/7". str_pad($row['UNIT_ID'], 15, "0", STR_PAD_LEFT);
$district['code'] = "7". str_pad($row['UNIT_ID'], 15, "0", STR_PAD_LEFT);;
$district['name'] = str_replace(" ED", "", $row['NAME']);
}
}

return $district;

}
?>