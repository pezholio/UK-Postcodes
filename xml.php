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
			<title><?php echo $countytitle; ?></title>
			<uri>http://statistics.data.gov.uk/id/local-authority/<?php echo $row['county']; ?></uri>
		</county>
<?php } ?>
		<district>
			<title><?php echo $districttitle; ?></title>
			<uri>http://statistics.data.gov.uk/id/local-authority/<?php echo $row['county'] . $row['district']; ?></uri>
		</district>
		<ward>
			<title><?php echo $wardtitle; ?></title>
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