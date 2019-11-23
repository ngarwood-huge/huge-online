<?php

$apiKey = 'AIzaSyDCL9kzQgJD3119c7fQjPMfOu8Y2gbbx2k';
$postcode1 = $_GET['postcode'] ;
print "User postcode: $postcode1" . PHP_EOL;

// Specify Postcodes to Geocode
$postcode2 = 'E175RA'; // Shop postcode

// Distance Matrix API
$jsonResponse = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$postcode1,UK&destinations=$postcode2,UK&mode=driving&language=en-EN&sensor=false&key=$apiKey");

#print_r($jsonResponse);

$jsonArr = json_decode($jsonResponse,true);

#print_r($jsonArr);

print PHP_EOL . "Metres: {$jsonArr[rows][0][elements][0][distance][value]}";

$km = ($jsonArr[rows][0][elements][0][distance][value])/1000;

// Distance in Miles
$miles = round($km * 0.621371192, 2);

print PHP_EOL . "Miles: $miles";

exit;

// Distance in KM
#$km = round($r * $c, 2);

// Distance in Miles
#$miles = round($km * 0.621371192, 2);

echo 'The distance between '.$postcode1.' and '.$postcode2.' is '.$km.'Km ('.$miles.' miles).';

?>
