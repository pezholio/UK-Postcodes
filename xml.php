<?php
if ($single) {
?>
<result>
	<postcode><?php echo $row['postcode']; ?></postcode>
	<geo>
		<lat><?php echo $lat; ?></lat>
		<lng><?php echo $lng; ?></lng>
		<easting><?php echo $easting; ?></easting>
		<northing><?php echo $northing; ?></northing>
		<geohash><?php echo $geohash; ?></geohash>
	</geo>
	<administrative>
<?php 
if ($row['county'] != "00") {
?>
		<county>
			<title><?php echo htmlentities($countytitle); ?></title>
			<uri>http://statistics.data.gov.uk/id/local-authority/<?php echo $row['county']; ?></uri>
		</county>
		<electoral-district>
			<title><?php echo htmlentities($edistrict['name']); ?></title>
			<uri><?php echo $edistrict['uri']; ?></uri>
		</electoral-district>
<?php } ?>
		<district>
			<title><?php echo htmlentities($districttitle); ?></title>
			<uri>http://statistics.data.gov.uk/id/local-authority/<?php echo $row['county'] . $row['district']; ?></uri>
		</district>
		<ward>
			<title><?php echo htmlentities($wardtitle); ?></title>
			<uri>http://statistics.data.gov.uk/id/electoral-ward/<?php echo $row['county'] . $row['district'] . $row['ward']; ?></uri>
		</ward>
	</administrative>
</result>
<?php } elseif($distance) { ?>
<result>
	<postcodes>
<?php
while ($row = mysql_fetch_array($result)) {
?>
		<postcode>
			<lat><?php echo $row['lat']; ?></lat>
			<lng><?php echo $row['lng']; ?></lng>
			<distance><?php echo $row['distance']; ?></distance>
			<uri>http://www.uk-postcodes.com/postcode/<?php echo str_replace(" ", "", $row['postcode']); ?></uri>
		</postcode>
<?php } ?>
	</postcodes>
</result>
<?php } ?>