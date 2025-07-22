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
  <title>Senarai Video - Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
        background-color: #f8f9fa;
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

    .table thead {
        background-color: #343a40;
        color: white;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">

    <!-- Sidebar -->
    <div class="sidebar">
      <h4>Admin Panel</h4>
      <a href="dashboard_new.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
      <a href="dashboard.php"><i class="bi bi-camera-video"></i> Upload Video</a>
      <a href="add_article.php"><i class="bi bi-file-earmark-text"></i> Upload Article</a>
      <a href="all_videos.php"><i class="bi bi-collection-play-fill"></i> List Video</a>
      <a href="all_article.php"><i class="bi bi-journal-text"></i> List Article</a>
      <a href="logout_admin.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
    </div>

    <!-- Content -->
    <div class="col-md-9 col-lg-10 p-4">
      <h3 class="mb-4">Senarai Video Dimuat Naik</h3>
      
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Tajuk</th>
              <th>Tarikh Upload</th>
              <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM videos ORDER BY created_at DESC";
            $result = $conn->query($sql);
            $no = 1;

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['title']}</td>
                        <td>" . date('d-m-Y', strtotime($row['created_at'])) . "</td>
                        <td>
                          <a href='../video.php?id={$row['id']}' class='btn btn-primary btn-sm' target='_blank'><i class='bi bi-eye'></i></a>
                          <a href='edit_video.php?id={$row['id']}' class='btn btn-warning btn-sm'><i class='bi bi-pencil'></i></a>
                          <a href='delete_video.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Padam video ini?')\"><i class='bi bi-trash'></i></a>
                        </td>
                      </tr>";
                $no++;
              }
            } else {
              echo "<tr><td colspan='4' class='text-center'>Tiada video dimuat naik.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-4">
  &copy; <?php echo date('Y'); ?> Lensa TigaD. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
