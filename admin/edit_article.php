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

// Dapatkan data asal
$stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Artikel tidak dijumpai.";
    exit;
}

$article = $result->fetch_assoc();

// Bila form dihantar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (!empty($title) && !empty($content)) {
        $stmt = $conn->prepare("UPDATE articles SET title = ?, content = ? WHERE id = ?");
        $stmt->bind_param("ssi", $title, $content, $id);
        $stmt->execute();

        header("Location: all_article.php?updated=1");
        exit;
    } else {
        $error = "Sila isi semua medan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px 0;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
            border-radius: 5px;
            padding-left: 10px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h5 class="text-white mb-4">Admin Panel</h5>
            <a href="dashboard_new.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="upload_video.php"><i class="bi bi-upload"></i> Upload Video</a>
            <a href="all_videos.php"><i class="bi bi-collection-play"></i> Senarai Video</a>
            <a href="upload_article.php"><i class="bi bi-file-earmark-plus"></i> Upload Artikel</a>
            <a href="all_article.php"><i class="bi bi-journal-text"></i> Senarai Artikel</a>
            <a href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>

        <!-- Content -->
        <div class="col-md-10 p-4">
            <h3>Edit Artikel</h3>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Tajuk</label>
                    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($article['title']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Kandungan</label>
                    <textarea name="content" class="form-control" rows="8" required><?= htmlspecialchars($article['content']) ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kemaskini</button>
                <a href="all_article.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
