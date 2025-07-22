<?php
require '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - Lensa TigaD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Gaya CSS Dikemaskini -->
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #343a40;
            padding: 30px 20px;
            color: white;
        }

        .sidebar h4 {
            font-weight: bold;
            margin-bottom: 30px;
            font-size: 22px;
            text-align: center;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #dee2e6;
            text-decoration: none;
            padding: 10px 12px;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: background 0.2s ease;
            font-size: 16px;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: white;
        }

        .sidebar i {
            font-size: 18px;
        }

        .content {
            padding: 40px;
        }

        .card-stat {
            border-left: 5px solid #0d6efd;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: transform 0.2s ease;
        }

        .card-stat:hover {
            transform: translateY(-3px);
        }

        footer {
            background: #212529;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="d-flex">

    <!-- Sidebar HTML -->
    <div class="sidebar">
        <h4>Admin Panel</h4>
        <a href="dashboard_new.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="dashboard.php"><i class="bi bi-camera-video"></i> Upload Video</a>
        <a href="add_article.php"><i class="bi bi-file-earmark-text"></i> Upload Article</a>
        <a href="all_videos.php"><i class="bi bi-collection-play"></i> List Video</a>
        <a href="all_article.php"><i class="bi bi-journal-text"></i> List Article</a>
        <a href="logout_admin.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
    </div>

    <!-- Main content -->
    <div class="content flex-grow-1">
        <h2 class="mb-4">Selamat Datang, Admin</h2>

        <div class="row">
            <?php
            $video_count = $conn->query("SELECT COUNT(*) as total FROM videos")->fetch_assoc()['total'];
            $article_count = $conn->query("SELECT COUNT(*) as total FROM articles")->fetch_assoc()['total'];
            $like_count = $conn->query("SELECT COUNT(*) as total FROM likes WHERE type = 'like'")->fetch_assoc()['total'];
            $comment_count = $conn->query("SELECT COUNT(*) as total FROM comments")->fetch_assoc()['total'];
            ?>

            <div class="col-md-3 mb-4">
                <div class="card card-stat p-3">
                    <h5 class="text-muted">Jumlah Video</h5>
                    <h2><?php echo $video_count; ?></h2>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card card-stat p-3">
                    <h5 class="text-muted">Jumlah Artikel</h5>
                    <h2><?php echo $article_count; ?></h2>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card card-stat p-3">
                    <h5 class="text-muted">Jumlah Like</h5>
                    <h2><?php echo $like_count; ?></h2>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card card-stat p-3">
                    <h5 class="text-muted">Jumlah Komen</h5>
                    <h2><?php echo $comment_count; ?></h2>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h4>Statistik Ringkas</h4>
            <table class="table table-striped table-bordered mt-3 bg-white">
                <thead class="table-dark">
                    <tr>
                        <th>Item</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Video</td><td><?php echo $video_count; ?></td></tr>
                    <tr><td>Artikel</td><td><?php echo $article_count; ?></td></tr>
                    <tr><td>Like</td><td><?php echo $like_count; ?></td></tr>
                    <tr><td>Komen</td><td><?php echo $comment_count; ?></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer>
    <p>&copy; <?php echo date('Y'); ?> Lensa TigaD. Semua Hak Terpelihara.</p>
</footer>

<!-- Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</body>
</html>
