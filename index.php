<?php
if ($_POST['form'] == 1) {
header("Location: http://www.uk-postcodes.com/postcode/".str_replace(" ", "", $_POST['postcode']). $_POST['type']);
} elseif ($_POST['form'] == 2) {
header("Location: http://www.uk-postcodes.com/distance.php?postcode=".str_replace(" ", "", $_POST['postcode'])."&distance=". $_POST['distance'] ."&format=". $_POST['type']);
} elseif ($_POST['form'] == 3) {
header("Location: http://www.uk-postcodes.com/latlng/".$_POST['lat'].",".$_POST['lng']. $_POST['type']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
	<title>UK Postcodes | Open data for postcodes</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link type="text/css" rel="stylesheet" href="http://www.blueprintcss.org/blueprint/src/grid.css" />
<link type="text/css" rel="stylesheet" href="http://www.blueprintcss.org/blueprint/src/typography.css" />
<link type="text/css" rel="stylesheet" href="http://www.blueprintcss.org/blueprint/src/forms.css" />
<link type="text/css" rel="stylesheet" href="style.css" />
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load("jquery", "1");
 
  google.setOnLoadCallback(function() {
  
  $('.tab').click(function() {
  	target = this.title;
  	$('.tab').removeClass('selected');
  	$('#postcode').attr('style','display:none');
  	$('#nearest').attr('style','display:none');
  	$('#reverse').attr('style','display:none');
  	$('#'+ target).attr('style','display:block');
  	$(this).addClass('selected');
  	return false;
  });

  });
</script>

</head>
<body>
<div id="header">
<h1><a href="http://www.uk-postcodes.com">UK Postcodes</a></h1>
<div id="corner">Now including Northern Ireland postcodes!</div>

<ul id="tab">
<li><a href="#postcode" title="postcode" class="tab selected">Postcode</a></li>
<li><a href="#nearest" title="nearest" class="tab">Nearest</a></li>
<li><a href="#reverse" title="reverse" class="tab">Reverse Geocode</a></li>
</ul>
<form method="post" style="display:block;" id="postcode">
<input type="hidden" name="form" value="1" />
<h2>Give me data for <input type="text" name="postcode" onclick="this.value=''" value="Postcode" /> in 
<select name="type">
<option value="">HTML</option>
<option value=".xml">XML</option>
<option value=".csv">CSV</option>
<option value=".json">JSON</option>
<option value=".rdf">RDF</option>
</select>
format <button type="submit" class="btn" name="pc"><span><span>please</span></span></button>
</h2>
</form>
<form method="post" style="display:none;" id="nearest">
<input type="hidden" name="form" value="2" />
<h2>Show me postcodes within <input type="text" name="distance" style="width: 30px;" value="" /> miles of <input type="text" name="postcode" onclick="this.value=''" value="Postcode" /> in 
<select name="type">
<option value="">HTML</option>
<option value="xml">XML</option>
<option value="csv">CSV</option>
<option value="json">JSON</option>
<option value="rdf">RDF</option>
<option value="kml">KML</option>
</select>
format <button type="submit" class="btn" name="nearest"><span><span>please</span></span></button>
</h2>
</form>
<form method="post" style="display:none;" id="reverse">
<input type="hidden" name="form" value="3" />
<h2>Give me data for the nearest postcode to <input type="text" name="lat" onclick="this.value=''" value="Latitude" /> , <input type="text" name="lng" onclick="this.value=''" value="Longitude" /> in 
<select name="type">
<option value="">HTML</option>
<option value=".xml">XML</option>
<option value=".csv">CSV</option>
<option value=".json">JSON</option>
<option value=".rdf">RDF</option>
</select>
format <button type="submit" class="btn" name="latlng"><span><span>please</span></span></button>
</h2>
</form>
</div>

<div id="formats">
<p>Created using <a href="http://www.ordnancesurvey.co.uk/oswebsite/opendata/">Ordnance Survey Open Data</a> | <a href="api.php">API</a> | <a href="http://www.uk-postcodes.com/alternative.php">Alternative services</a> | <a href="apps.php">Apps</a><img src="http://m.okfn.org/images/ok_buttons/od_80x15_blue.png" alt="Open Data" style="float:right;" /></p>
<p>Built by <a href="http://www.pezholio.co.uk">Pezholio</a></p>
</div>
<div id="copyright">
<p style="text-align: center;">This site uses Royal Mail and Ordnance Survey data &copy; Crown copyright and database right 2010. Data may be used under the terms of the <a href="http://www.ordnancesurvey.co.uk/oswebsite/opendata/faq.html">OS OpenData licence</a>.</p>
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