<?php
// Mulakan sesi jika belum dimulakan
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LensaTigaD</title>

  <!-- Google Fonts & Bootstrap Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css?v=3.1">

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    .main-header {
      background-color: #4a69bd;
      padding: 15px 0;
      color: white;
    }

    .logo a {
      display: flex;
      align-items: center;
      text-decoration: none !important;
      color: white;
      font-size: 1.8rem;
      font-weight: bold;
      gap: 14px;
    }

    .logo img {
      height: 60px;
    }

    .navbar-nav .nav-link {
      color: white;
      position: relative;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 6px;
      padding-bottom: 5px;
      transition: all 0.3s ease;
    }

    .navbar-nav .nav-link::after {
      content: '';
      position: absolute;
      width: 0%;
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: white;
      transition: width 0.3s ease;
    }

    .navbar-nav .nav-link:hover::after {
      width: 100%;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link:focus,
    .navbar-nav .nav-link:active {
      text-decoration: none !important;
      outline: none;
    }

    .navbar-toggler {
      border-color: rgba(255, 255, 255, 0.5);
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255, 255, 255, 1%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/ %3E%3C/svg%3E");
    }
  </style>
</head>
<body>

<!-- Header -->
<header class="main-header">
  <div class="container d-flex justify-content-between align-items-center flex-wrap">

    <!-- Logo & Nama Website -->
    <div class="logo">
      <a href="index.php">
        <img src="images/bw logo.png" alt="Logo" />
        LensaTigaD
      </a>
    </div>

    <!-- Navbar Responsive -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house-door"></i> Home</a></li>
          <li class="nav-item"><a class="nav-link" href="episode.php"><i class="bi bi-camera-reels"></i> Episode</a></li>
          <li class="nav-item"><a class="nav-link" href="article.php"><i class="bi bi-file-earmark-text"></i> Article</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php"><i class="bi bi-info-circle"></i> About</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php"><i class="bi bi-envelope"></i> Contact</a></li>
          <?php if (isset($_SESSION['user'])): ?>
            <li class="nav-item"><a class="nav-link" href="logout_client.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="login_client.php"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>

  </div>
</header>

<!-- JS Bootstrap (WAJIB untuk hamburger menu) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
