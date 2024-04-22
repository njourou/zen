<?php
// proxy.php

$seriesId = $_GET['seriesId'];
$seasonNumber = $_GET['seasonNumber'];

// Your API key
$apiKey = "your_api_key_here";

// API endpoint
$url = "https://api.themoviedb.org/3/tv/" . $seriesId . "/season/" . $seasonNumber . "?api_key=" . $apiKey;

// Make request to API
$response = file_get_contents($url);

// Forward response
echo $response;
?>
