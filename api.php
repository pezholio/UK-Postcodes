
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
	<title>UK Postcodes | Open data for postcodes</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link type="text/css" rel="stylesheet" href="http://www.blueprintcss.org/blueprint/src/grid.css" />
<link type="text/css" rel="stylesheet" href="http://www.blueprintcss.org/blueprint/src/typography.css" />
<link type="text/css" rel="stylesheet" href="http://www.blueprintcss.org/blueprint/src/forms.css" />
<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
<div id="header">
<h1><a href="http://www.uk-postcodes.com">UK Postcodes</a></h1>
</div>

<div id="main">
<h2>API</h2>
<div id="wrapper">
<p>Get the data you want simply by constructing your URLs as follows:</p>
<h3>Return data for a postcode</h3>
<code>http://www.uk-postcodes.com/postcode/<strong>[postcode (no space)]</strong>.<strong>['xml', 'csv', 'json'* or 'rdf']</strong></code>
<h3>Return data for the nearest postcode to a point</h3>
<code>http://www.uk-postcodes.com/latlng/<strong>[latitude]</strong>,<strong>[longitude]</strong>.<strong>['xml', 'csv', 'json'* or 'rdf']</strong></code>
<h3>Return data for postcodes within x distance (miles) of a postcode or lat/lng</h3>
<code>http://www.uk-postcodes.com/distance.php?<strong>postcode=[postcode]</strong>&<strong>distance=[distance in miles]</strong>&<strong>format=[xml|csv|json]</strong></code>
<code>http://www.uk-postcodes.com/distance.php?<strong>lat=[latitude]</strong>&<strong>lng=[longitude]</strong>&<strong>distance=[distance in miles]</strong>&<strong>format=[xml|csv|json]</strong></code>
<p>That's it! Be nice to the server and cache your requests!</p>
<p><small>* If using JSON, add '?callback=<strong>[some function call]</strong>' to the url to return JSONP</small></p>
<h2 id="libraries">Helper Libraries</h2>
<p>To make things even easier, a bunch of people have built helper libraries to make the process easier. Built one yourself? <a href="http://twitter.com/pezholio">Drop me a line via Twitter</a>.</p>
<ul>
<li><a href="https://github.com/stefl/pat">Ruby Gem</a> (cleverly called Pat) By <a href="http://stef.io">Stef Lewandowski</a></li>
<li><a href="http://gist.github.com/364477">PHP Function</a> by <a href="http://www.pezholio.co.uk">Stuart Harrison</a></li>
</ul>
</div>
</div>

<div id="formats">
<p>Created using <a href="http://www.ordnancesurvey.co.uk/oswebsite/opendata/">Ordnance Survey Open Data</a> | <a href="api.php">API</a> | <a href="http://www.uk-postcodes.com/alternative.php">Alternative services</a> | <a href="apps.php">Apps</a><img src="http://m.okfn.org/images/ok_buttons/od_80x15_blue.png" alt="Open Data" style="float:right;" /></p>
<p>Built by <a href="http://www.pezholio.co.uk">Pezholio</a></p>
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