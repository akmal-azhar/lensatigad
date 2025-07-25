<?php
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('964211957933-hbf9h7d1bdci4flmlkvbqfftkbhfhh7r.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/lensatigad/google_callback.php');
$client->addScope('email');
$client->addScope('profile');

$login_url = $client->createAuthUrl();
header('Location: ' . $login_url);
exit();
