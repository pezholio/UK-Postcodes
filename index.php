<?php
if ($_POST['form'] == 1) {
header("Location: /postcode/".str_replace(" ", "", $_POST['postcode']). $_POST['type']);
} elseif ($_POST['form'] == 2) {
header("Location: /distance.php?postcode=".str_replace(" ", "", $_POST['postcode'])."&distance=". $_POST['distance'] ."&format=". $_POST['type']);
} elseif ($_POST['form'] == 3) {
header("Location: /latlng/".$_POST['lat'].",".$_POST['lng']. $_POST['type']);
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
<h1><a href="/">UK Postcodes</a></h1>
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

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="text-align: center">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>

</div>

<div id="formats">
<p>Created using <a href="http://www.ordnancesurvey.co.uk/oswebsite/opendata/">Ordnance Survey Open Data</a> | <a href="api.php">API</a> | <a href="/alternative.php">Alternative services</a> | <a href="apps.php">Apps</a><img src="http://m.okfn.org/images/ok_buttons/od_80x15_blue.png" alt="Open Data" style="float:right;" /></p>
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