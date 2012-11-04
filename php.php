<?php
function ernest_marples($postcode) {

$postcode = str_replace(" ", "", $postcode);

$url = "http://".$_SERVER['SERVER_NAME']."/postcode/". urlencode($postcode) .".csv"; // Build the URL

$file = file_get_contents($url);

if (strpos($file, "html") === FALSE) { // Some error checking - if the file contains html, then we've been redirected to the homepage and something has gone wrong
$pieces = explode(",", $file);
$result['postcode'] = $pieces[0];
$result['lat'] = $pieces[1];
$result['lng'] = $pieces[2];
} else {
$result['error'] = TRUE; // If an error, return one
}

return $result;
}

print_r(ernest_marples("fdsdfs"));
?>