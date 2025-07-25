<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'includes/db.php';

$client = new Google_Client();
$client->setClientId('964211957933-hbf9h7d1bdci4flmlkvbqfftkbhfhh7r.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/lensatigad/google_callback.php');
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (isset($token['error'])) {
        echo "Error fetching token: " . $token['error'];
        exit;
    }
    $client->setAccessToken($token);

    $oauth = new Google_Service_Oauth2($client);
    $userData = $oauth->userinfo->get();

    $google_id = $userData->id;
    $name = $userData->name;
    $email = $userData->email;

    // Semak jika user dah ada dalam DB
    $stmt = $conn->prepare("SELECT * FROM users WHERE google_id = ? OR email = ?");
    $stmt->bind_param("ss", $google_id, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Update google_id jika belum ada
        if (empty($user['google_id'])) {
            $update = $conn->prepare("UPDATE users SET google_id = ? WHERE id = ?");
            $update->bind_param("si", $google_id, $user['id']);
            $update->execute();
        }
    } else {
        // Insert user baru
        $role = 'client';
        $type = 'google';
        $stmt = $conn->prepare("INSERT INTO users (name, email, google_id, role, type, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $name, $email, $google_id, $role, $type);
        $stmt->execute();
        $user = ['name' => $name, 'email' => $email, 'role' => $role];
    }

    $_SESSION['user'] = $user;
    header('Location: index.php');
    exit();
} else {
    echo "Akses ditolak atau tidak sah.";
}
