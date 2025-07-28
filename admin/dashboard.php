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
  <title>Admin Dashboard - Lensa TigaD</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .sidebar {
      min-height: 100vh;
      background-color: #343a40;
    }

    .sidebar a {
      color: #fff;
      padding: 12px 20px;
      display: block;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .sidebar a:hover {
      background-color: #495057;
    }

    .sidebar .active {
      background-color: #495057;
    }
    .sidebar h4 {
      color: #fff;
      padding: 20px 0;
      text-align: center;
      border-bottom: 1px solid #6c757d;
      font-weight: bold;
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

<div class="container-fluid">
  <div class="row">

    <!-- Sidebar -->
    <div class="col-md-3 col-lg-2 sidebar p-0">
      <h4 class="text-center mb-4">Admin Panel</h4>
      <nav class="d-flex flex-column">
        <a href="dashboard_new.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>  
        <a href="dashboard.php" class="active"><i class="bi bi-camera-video me-2"></i>Upload Video</a>
        <a href="add_article.php"><i class="bi bi-journal-text me-2"></i>Upload Article</a>
        <a href="all_videos.php"><i class="bi bi-collection-play me-2"></i>List Video</a>
        <a href="all_article.php"><i class="bi bi-journal-text"></i>List Article</a>
        <a href="logout_admin.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
      </nav>
    </div>

    <!-- Content -->
    <div class="col-md-9 col-lg-10 p-4">
      <div class="card shadow-sm">
        <div class="card-body">

        <?php if (isset($_SESSION['upload_success'])): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php 
      echo $_SESSION['upload_success']; 
      unset($_SESSION['upload_success']); 
    ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<?php if (isset($_SESSION['upload_error'])): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?php 
      echo $_SESSION['upload_error']; 
      unset($_SESSION['upload_error']); 
    ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

          <h2 class="mb-4">Selamat datang, admin!</h2>
          <h4 class="mb-3">Upload Video Baru</h4>

          <form action="upload_video.php" method="POST">
            <div class="mb-3">
              <label for="title" class="form-label">Tajuk Video</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Contoh: Podcast Episod 1" required>
            </div>

            <label for="category">Category</label>
              <select name="category" id="category" class="form-control" required>
                <option value="">-- Select Category --</option>
                <option value="sports">Sports</option>
                <option value="business">Business</option>
                <option value="education">Education</option>
                <option value="infotainment">Infotainment</option>
              </select>

            <br>
            <div class="mb-3">
              <label for="description" class="form-label">Deskripsi Video</label>
              <textarea class="form-control" id="description" name="description" rows="4" placeholder="Ringkasan atau penerangan..." required></textarea>
            </div>

            <div class="mb-3">
              <label for="youtube_link" class="form-label">YouTube Embed Link</label>
              <input type="text" class="form-control" id="youtube_link" name="youtube_link" placeholder="https://www.youtube.com/embed/..." required>
            </div>

            <button type="submit" class="btn btn-success">
              <i class="bi bi-cloud-upload me-1"></i> Upload Video
            </button>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-4">
  &copy; <?php echo date('Y'); ?> Lensa TigaD. All rights reserved.
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
