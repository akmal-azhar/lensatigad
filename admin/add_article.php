<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Artikel - Lensa TigaD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
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
    .card {
      animation: fadeInUp 0.5s ease-in-out;
    }
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h4 class="text-center mb-4">Admin Panel</h4>
  <a href="dashboard_new.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
  <a href="dashboard.php"><i class="bi bi-upload me-2"></i>Upload Video</a>
  <a href="add_article.php" class="active"><i class="bi bi-journal-plus me-2"></i>Upload Article</a>
  <a href="all_videos.php"><i class="bi bi-collection-play me-2"></i>List Video</a>
  <a href="all_article.php"><i class="bi bi-journal-text me-2"></i>List Article</a>
  <a href="logout_admin.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
</div>

<!-- Main Content -->
<div class="content">
  <div class="container">
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="card-title mb-4">Tambah Artikel Baru</h3>

        <form action="insert_article.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select class="form-select" id="category" name="category" required>
              <option value="">-- Pilih Kategori --</option>
              <option value="sukan">Sukan</option>
              <option value="business">Business</option>
              <option value="education">Education</option>
              <option value="infotainment">Infotainment</option>
              
            </select>
          </div>

          <div class="mb-3">
            <label for="title" class="form-label">Tajuk Artikel</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Contoh: Tips Belajar Efektif" required>
          </div>

          <div class="mb-3">
            <label for="content" class="form-label">Kandungan</label>
            <textarea class="form-control" id="content" name="content" rows="8" placeholder="Isi penuh artikel..." required></textarea>
          </div>

          <!-- Tambah selepas ruangan kandungan artikel -->
          <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail (Gambar)</label>
            <input class="form-control" type="file" id="thumbnail" name="thumbnail" accept="image/*" required>
          </div>

          <div class="mb-3">
            <label for="thumbnail_secondary" class="form-label">Thumbnail Kedua</label>
            <input type="file" class="form-control" id="thumbnail_secondary" name="thumbnail_secondary" accept="image/*">
          </div>

          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i> Simpan Artikel
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
