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
		<constituency>
			<title><?php echo $constituencytitle; ?></title>
			<uri><?php echo $constituencyuri; ?></uri>
			<code><?php echo $constituencycode; ?></code>
		</constituency>
<?php 
if (!strstr($row['countygss'], "99999999")) {
?>
		<county>
			<title><?php echo htmlentities($countytitle); ?></title>
			<uri>http://statistics.data.gov.uk/id/local-authority/<?php echo $row['countysnac']; ?></uri>
			<snac><?php echo $row['county']; ?></snac>
		</county>
		<electoral-district>
			<title><?php echo htmlentities($edistrict['name']); ?></title>
			<uri><?php echo $edistrict['uri']; ?></uri>
			<code><?php echo $edistrict['code']; ?></code>
		</electoral-district>
<?php } ?>
		<district>
			<title><?php echo htmlentities($districttitle); ?></title>
			<uri>http://statistics.data.gov.uk/id/local-authority/<?php echo $row['councilsnac']; ?></uri>
			<snac><?php echo $row['councilsnac']; ?></snac>
		</district>
		<ward>
			<title><?php echo htmlentities($wardtitle); ?></title>
			<uri>http://statistics.data.gov.uk/id/electoral-ward/<?php echo $row['wardsnac']; ?></uri>
			<snac><?php echo $row['wardsnac']; ?></snac>
		</ward>
<?php
if (strlen($parishname) > 0) {
?>
		<parish>
			<title><?php echo $parishname; ?></title>
			<uri><?php echo $parishuri; ?></uri>
			<snac><?php echo $parishcode; ?></snac>
		</parish>	
<?php } ?>
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