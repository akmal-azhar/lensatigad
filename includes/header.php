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

    .main-header .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
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

    .navbar ul {
      list-style: none;
      display: flex;
      gap: 40px;
      margin: 0;
      padding: 0;
    }

    .navbar a {
      color: white;
      text-decoration: none !important;
      position: relative;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 6px;
      padding-bottom: 5px;
      transition: all 0.3s ease;
    }

    /* Garisan hover */
    .navbar a::after {
      content: '';
      position: absolute;
      width: 0%;
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: white;
      transition: width 0.3s ease;
    }

    .navbar a:hover::after {
      width: 100%;
    }

    .navbar a:hover,
    .navbar a:focus,
    .navbar a:active {
      text-decoration: none !important;
      outline: none;
    }

    @media (max-width: 768px) {
      .main-header .container {
        flex-direction: column;
        align-items: flex-start;
      }

      .navbar ul {
        flex-direction: column;
        gap: 15px;
        padding-top: 10px;
      }
    }
  </style>
</head>
<body>

<!-- Header -->
<header class="main-header">
  <div class="container">

    <!-- Logo & Nama Website -->
    <div class="logo">
      <a href="index.php">
        <img src="images/bw logo.png" alt="Logo" />
        LensaTigaD
      </a>
    </div>

    <!-- Navbar -->
    <nav class="navbar">
      <ul>
        <li><a href="index.php"><i class="bi bi-house-door"></i> Home</a></li>
        <li><a href="episode.php"><i class="bi bi-camera-reels"></i> Episode</a></li>
        <li><a href="article.php"><i class="bi bi-file-earmark-text"></i> Article</a></li>
        <li><a href="about.php"><i class="bi bi-info-circle"></i> About</a></li>
        <li><a href="contact.php"><i class="bi bi-envelope"></i> Contact</a></li>
        <?php if (isset($_SESSION['user'])): ?>
          <li><a href="logout_client.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
        <?php else: ?>
          <li><a href="login_client.php"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
        <?php endif; ?>
      </ul>
    </nav>

  </div>
</header>
