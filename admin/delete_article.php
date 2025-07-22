<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login_admin.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "Artikel tidak dijumpai.";
    exit;
}

$id = intval($_GET['id']);

// Padam artikel
$stmt = $conn->prepare("DELETE FROM articles WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: all_article.php?deleted=1");
exit;
?>
