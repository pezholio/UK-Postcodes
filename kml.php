<?php
if ($distance) {
?>
<kml xmlns="http://www.opengis.net/kml/2.2">
<Document>
	<name>UK Postcodes</name>
	<description>Postcodes within <?php echo $distance; ?> miles of <?php echo $title; ?></description>
<?php
while ($row = mysql_fetch_array($result)) {
?>
  <Placemark>
    <name><?php echo $row['postcode']; ?></name>
    <description>
    <![CDATA[
<a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/postcode/<?php echo str_replace(" ", "", $row['postcode']); ?>"><?php echo $row['postcode']; ?></a>
	]]>
</description>
    <Point>
      <coordinates><?php echo $row['lng']; ?>, <?php echo $row['lat']; ?></coordinates>
    </Point>
  </Placemark>
<?php } ?>
</Document>
</kml>
<?php } ?>