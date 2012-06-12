<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Fetching Location...</title>
<script type="text/javascript">
var count = 0

function getCoords() {
//navigator.geolocation.getCurrentPosition(showMap, error, {enableHighAccuracy: true});
var watch = navigator.geolocation.watchPosition(showMap, error)

function showMap(position) {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;
	accuracy = position.coords.accuracy;
  if (accuracy < 250) {
  window.location="http://www.uk-postcodes.com/latlng/"+ latitude +","+ longitude;
	}  
}
 
function error(error) {
	alert("Couldn't get location!");
	}
}
</script>
</head>

<body onload="getCoords();">
</body>
</html>

