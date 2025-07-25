<?php
require_once __DIR__ . '/vendor/autoload.php';

$client = new Google_Client();
// Tak perlu set apa-apa lagi untuk test class

$oauth = new Google_Service_Oauth2($client);
echo "Class wujud!";
