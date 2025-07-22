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

  <!-- Pautkan fail CSS dan Google Fonts -->
  <link rel="stylesheet" href="css/style.css?v=2.0">
</head>
<body>

  <!-- Header utama laman web -->
  <header class="main-header">
    <div class="container">
      
      <!-- Logo laman web -->
      <div class="logo">
        <a href="index.php">
          <img src="images/bw logo.png" alt="Logo" />
          LensaTigaD
        </a>
      </div>

      <!-- Navigasi laman -->
      <nav class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="episode.php">Episode</a></li>
          <li><a href="article.php">Article</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
          <?php if (isset($_SESSION['user'])): ?>
            <li><a href="logout_client.php">Logout</a></li>
          <?php else: ?>
            <li><a href="login_client.php">Login</a></li>
          <?php endif; ?>
        </ul>
      </nav>

    </div>
  </header>
