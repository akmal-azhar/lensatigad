<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login_admin.php");
    exit;
}

// Dapatkan semua artikel
$stmt = $conn->prepare("SELECT * FROM articles ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Senarai Artikel - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
    }

    .sidebar {
      height: 100vh;
      background-color: #343a40;
      color: white;
      position: fixed;
      width: 250px;
      padding-top: 20px;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 12px 20px;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #495057;
    }

    .content {
      margin-left: 250px;
      padding: 30px;
    }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <h4 class="text-center mb-4">Admin Panel</h4>
  <a href="dashboard_new.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
  <a href="dashboard.php"><i class="bi bi-upload me-2"></i>Upload Video</a>
  <a href="add_article.php"><i class="bi bi-file-earmark-plus me-2"></i>Upload Article</a>
  <a href="all_videos.php"><i class="bi bi-collection-play me-2"></i>List Video</a>
  <a href="all_article.php" class="active"><i class="bi bi-file-earmark-text me-2"></i>List Article</a>
  <a href="logout_admin.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
</div>

<!-- KANDUNGAN UTAMA -->
<div class="content">
  <h3>Senarai Artikel</h3>

  <?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">Artikel berjaya dipadam.</div>
  <?php endif; ?>

  <?php if (isset($_GET['updated'])): ?>
    <div class="alert alert-success">Artikel berjaya dikemaskini.</div>
  <?php endif; ?>

  <table class="table table-bordered mt-4">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tajuk</th>
        <th>Tarikh</th>
        <th>Tindakan</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['title']) ?></td>
          <td><?= date('d-m-Y', strtotime($row['created_at'])) ?></td>
          <td>
            <a href="../article.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info" target="_blank">View</a>
            <a href="edit_article.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="delete_article.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Padam artikel ini?')">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

</body>
</html>
