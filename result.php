<?php
if ($single) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
	<title>UK Postcodes | Data for <?php echo strtoupper($row['postcode']); ?></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link type="text/css" rel="stylesheet" href="http://www.blueprintcss.org/blueprint/src/grid.css" />
<link type="text/css" rel="stylesheet" href="http://www.blueprintcss.org/blueprint/src/typography.css" />
<link type="text/css" rel="stylesheet" href="http://www.blueprintcss.org/blueprint/src/forms.css" />
<link type="text/css" rel="stylesheet" href="/style.css" />
<link rel="stylesheet" href="/leaflet/leaflet.css" />
<!--[if lte IE 8]><link rel="stylesheet" href="/leaflet/leaflet.ie.css" /><![endif]-->
<script src="/leaflet/leaflet.js"></script>
<script type="text/javascript" src="http://openlayers.org/dev/OpenLayers.js"></script>
</head>
<body onload="init();">
<div id="header">
<h1><a href="http://www.uk-postcodes.com">UK Postcodes</a></h1>
</div>
<div id="main" class="vcard">
<div class="adr">
<h2>Data for <span class="fn org postal-code"><?php echo strtoupper($row['postcode']); ?></span></h2>
<div id="wrapper" class="result geo">
<div id="map" style="width: 300px; height: 300px; float: right; margin: 0 0 20px 20px;"></div>

<script type="text/javascript"> 
var map = new L.Map('map');
var cloudmadeUrl = 'http://{s}.tile.cloudmade.com/3a36067fc4f2404eb235c892bb344b06/997/256/{z}/{x}/{y}.png',
		cloudmadeAttrib = 'Map data &copy; 2011 OpenStreetMap contributors, Imagery &copy; 2011 CloudMade',
		cloudmade = new L.TileLayer(cloudmadeUrl, {maxZoom: 18, attribution: cloudmadeAttrib});
	
	var latlng = new L.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>); 
map.setView(latlng, 16).addLayer(cloudmade);

var marker = new L.Marker(latlng);
map.addLayer(marker);
</script> 

<p><strong>Latitude</strong> <span class="latitude"><?php echo $lat; ?></span></p>
<p><strong>Longitude</strong> <span class="longitude"><?php echo $lng; ?></span></p>
<p><strong>Easting</strong> <?php echo $easting; ?> <?php echo $ngnote; ?></p>
<p><strong>Northing</strong> <?php echo $northing; ?> <?php echo $ngnote; ?></p>
<p><strong>Geohash URI</strong> <a href="<?php echo $geohash; ?>" class="url"><?php echo $geohash; ?></a></p>
<p><strong>Openly Local URL</strong> <a href="http://openlylocal.com/areas/postcodes/<?php echo $row['postcode']; ?>" rel="tag" class="url">http://openlylocal.com/areas/postcodes/<?php echo $row['postcode']; ?></a></p>
<p><strong>Constituency</strong><a href="<?php echo $constituencyuri; ?>"><?php echo $constituencytitle; ?></a></p>
<?php 
if (!strstr($row['countygss'], "99999999")) {
?>
<p><strong>County</strong> <a href="<?php echo "http://statistics.data.gov.uk/doc/local-authority/". $row['countysnac']; ?>"><?php echo $countytitle; ?></a></p>
<p><strong>County Electoral District</strong> <a href="<?php echo $edistrict['uri']; ?>"><?php echo $edistrict['name']; ?></a></p>
<?php } ?>
<p><strong>District</strong> <a href="<?php echo "http://statistics.data.gov.uk/doc/local-authority/". $row['councilsnac']; ?>"><?php echo $districttitle; ?></a></p>
<p><strong>Ward</strong> <a href="<?php echo "http://statistics.data.gov.uk/doc/electoral-ward/".  $row['wardsnac'];?>" class="locality"><?php echo $wardtitle; ?></a></p>
<?php
if (strlen($parishname) > 0) {
?>
<p><strong>Parish / Community Council</strong> <a href="<?php echo $parishuri; ?>"><?php echo $parishname; ?></a></p>
<?php } ?>
</div>
</div>
</div>
<div id="formats">
<p>Get this information as <a href="http://www.uk-postcodes.com<?php echo $_SERVER['REQUEST_URI']; ?>.xml">XML</a>, <a href="http://www.uk-postcodes.com<?php echo $_SERVER['REQUEST_URI']; ?>.csv">CSV</a>, <a href="http://www.uk-postcodes.com<?php echo $_SERVER['REQUEST_URI']; ?>.json">JSON</a> or <a href="http://www.uk-postcodes.com<?php echo $_SERVER['REQUEST_URI']; ?>.rdf">RDF</a> <img src="http://www.uk-postcodes.com/microformats.png" alt="Microformats" style="float:right; margin-left: 10px;" /> <img src="http://m.okfn.org/images/ok_buttons/od_80x15_blue.png" alt="Open Data" style="float:right;" /></p>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-511839-16");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
<?php } elseif($distance) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
	<title>UK Postcodes | Postcodes within <?php echo $distance; ?> miles of <?php echo $title; ?></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link type="text/css" rel="stylesheet" href="http://www.blueprintcss.org/blueprint/src/grid.css" />
<link type="text/css" rel="stylesheet" href="http://www.blueprintcss.org/blueprint/src/typography.css" />
<link type="text/css" rel="stylesheet" href="http://www.blueprintcss.org/blueprint/src/forms.css" />
<link type="text/css" rel="stylesheet" href="/style.css" />
</head>
<body>
<div id="header">
<h1><a href="http://www.uk-postcodes.com">UK Postcodes</a></h1>
</div>
<div id="main">
<h2>Postcodes within <?php echo $distance; ?> miles of <?php echo $title; ?></h2>
<div id="wrapper" class="result">
<ul>
<?php
while ($row = mysql_fetch_array($result)) {
?>
<li><a href="http://www.uk-postcodes.com/postcode/<?php echo str_replace(" ", "", $row['postcode']); ?>"><?php echo $row['postcode']; ?></a></li>
<?php
}
?>
</ul>
</div>
</div>
<div id="formats">
<p>Get this information as <a href="http://www.uk-postcodes.com<?php echo $_SERVER['REQUEST_URI']; ?>&amp;format=xml">XML</a>, <a href="http://www.uk-postcodes.com<?php echo $_SERVER['REQUEST_URI']; ?>&amp;format=csv">CSV</a>, <a href="http://www.uk-postcodes.com<?php echo $_SERVER['REQUEST_URI']; ?>&amp;format=json">JSON</a>, <a href="http://www.uk-postcodes.com<?php echo $_SERVER['REQUEST_URI']; ?>&amp;format=rdf">RDF</a> or <a href="http://www.uk-postcodes.com<?php echo $_SERVER['REQUEST_URI']; ?>&amp;format=kml">KML</a> <img src="http://m.okfn.org/images/ok_buttons/od_80x15_blue.png" alt="Open Data" style="float:right;" /></p>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-511839-16");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
<?php } ?>