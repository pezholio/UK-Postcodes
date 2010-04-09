<?php
if ($single) {
$row['postcode'] = str_replace(" ", "", $row['postcode']);
?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#" xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#" xmlns:spatialrelations="http://data.ordnancesurvey.co.uk/ontology/spatialrelations/" xmlns:admingeo="http://statistics.data.gov.uk/def/administrative-geography/" xmlns:elecgeo="http://statistics.data.gov.uk/def/electoral-geography/" >
 <rdf:Description rdf:about="http://www.uk-postcodes.com/postcode/<?php echo strtoupper($row['postcode']); ?>">
   <geo:lat rdf:datatype="http://www.w3.org/2001/XMLSchema#decimal"><?php echo $lat; ?></geo:lat>
   <geo:long rdf:datatype="http://www.w3.org/2001/XMLSchema#decimal"><?php echo $lng; ?></geo:long>
   <spatialrelations:easting rdf:datatype="http://www.w3.org/2001/XMLSchema#float"><?php echo $easting; ?></spatialrelations:easting>
   <spatialrelations:northing rdf:datatype="http://www.w3.org/2001/XMLSchema#float"><?php echo $northing; ?></spatialrelations:northing>
<?php if ($row['county'] != "00") { ?> 
   <spatialrelations:t_spatiallyInside rdf:resource="http://statistics.data.gov.uk/id/local-authority/<?php echo $row['county']; ?>" />
<?php } ?>
   <spatialrelations:t_spatiallyInside rdf:resource="http://statistics.data.gov.uk/id/local-authority/<?php echo $row['county']; ?><?php echo $row['district']; ?>" />
   <spatialrelations:t_spatiallyInside rdf:resource="http://statistics.data.gov.uk/id/electoral-ward/<?php echo $row['county']; ?><?php echo $row['district']; ?><?php echo $row['ward']; ?>" />
   <?php if ($row['county'] != "00") { ?> 
   <admingeo:localAuthority rdf:resource="http://statistics.data.gov.uk/id/local-authority/<?php echo $row['county']; ?>" />
<?php } ?>
   <admingeo:localAuthority rdf:resource="http://statistics.data.gov.uk/id/local-authority/<?php echo $row['county']; ?><?php echo $row['district']; ?>" />
   <elecgeo:ward rdf:resource="http://statistics.data.gov.uk/id/electoral-ward/<?php echo $row['county']; ?><?php echo $row['district']; ?><?php echo $row['ward']; ?>" />
 </rdf:Description>
 <?php if ($row['county'] != "00") { ?> 
 <rdf:Description rdf:about="http://statistics.data.gov.uk/id/local-authority/<?php echo $row['county']; ?>">
   <rdfs:label><?php echo $countytitle; ?></rdfs:label>
 </rdf:Description>
<?php } ?>
 <rdf:Description rdf:about="http://statistics.data.gov.uk/id/local-authority/<?php echo $row['county']; ?><?php echo $row['district']; ?>">
   <rdfs:label><?php echo $districttitle; ?></rdfs:label>
 </rdf:Description>
 <rdf:Description rdf:about="http://statistics.data.gov.uk/id/electoral-ward/<?php echo $row['county']; ?><?php echo $row['district']; ?><?php echo $row['ward']; ?>">
   <rdfs:label><?php echo $wardtitle; ?></rdfs:label>
 </rdf:Description>
</rdf:RDF>
<?php } elseif ($distance) { ?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
  xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
  xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#">
<?php
while ($row = mysql_fetch_array($result)) {
$row['postcode'] = str_replace(" ", "", $row['postcode']);
?>
  <rdf:Description rdf:about="http://www.uk-postcodes.com/postcode/<?php echo strtoupper($row['postcode']); ?>">
  	  <rdfs:label><?php echo strtoupper($row['postcode']); ?></rdfs:label>
   	  <geo:lat rdf:datatype="http://www.w3.org/2001/XMLSchema#decimal"><?php echo $lat; ?></geo:lat>
      <geo:long rdf:datatype="http://www.w3.org/2001/XMLSchema#decimal"><?php echo $lng; ?></geo:long>	
  </rdf:Description>
<?php } ?>
</rdf:RDF>
<?php } ?>