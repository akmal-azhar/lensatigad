<?php
session_start();
require 'includes/db.php';
?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - Lensa TigaD</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- AOS CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #ffffff;
      color: #111;
    }

    .hero {
      background: linear-gradient(to right, #e3f2fd, #bbdefb);
      color: #0d47a1;
      padding: 100px 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .section {
      padding: 60px 20px;
    }

    .icon-section {
      background-color: #f0f8ff;
      padding: 60px 20px;
    }

    .icon-box {
      text-align: center;
      padding: 30px;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      transition: transform 0.3s;
    }

    .icon-box:hover {
      transform: translateY(-5px);
    }

    .icon-box i {
      font-size: 40px;
      color: #0d6efd;
      margin-bottom: 15px;
    }

    .extra-section {
      background: #f9f9f9;
      padding: 60px 20px;
      text-align: center;
    }

    @media (max-width: 768px) {
      .hero {
        flex-direction: column;
        padding: 60px 20px;
      }
    }
  </style>
</head>
<body>

  <!-- HERO SECTION -->
  <div class="hero" data-aos="fade-down">
    <div>
      <h1 class="display-5 fw-bold">About Lensa TigaD</h1>
      <p class="lead mt-3">Watch. Listen. Read. All in one platform.</p>
    </div>
  </div>

  <!-- ABOUT INFO SECTION -->
  <div class="section container" data-aos="fade-up">
    <h2 class="fw-bold text-primary text-center mb-4">Who Are We?</h2>
    <p class="text-center mx-auto" style="max-width: 800px;">
      <strong>Lensa TigaD</strong> is a digital media platform that combines <strong>podcasts and articles</strong> focusing on four main topics: <strong>Sports, Business, Education, and Infotainment</strong>.
      We deliver knowledge, insights, and entertainment in audio-visual and written formats — all easily accessible by everyone.
    </p>
    <p class="text-center mx-auto mt-3" style="max-width: 800px;">
      Whether you’re a sports fan, aspiring entrepreneur, curious learner, or someone looking for meaningful content, Lensa TigaD has something for you.
    </p>
    <p class="text-center mx-auto mt-3 fw-semibold" style="max-width: 800px;">
      Join our community and experience a 3-dimensional approach to content — <em>watch, listen, and read</em> in one place.
    </p>
  </div>

  <!-- ICON TOPIC SECTION -->
  <div class="icon-section">
    <div class="container">
      <h3 class="fw-bold text-primary text-center mb-5" data-aos="fade-up">Our Main Topics</h3>
      <div class="row g-4">
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
          <div class="icon-box">
            <i class="bi bi-trophy"></i>
            <h5 class="fw-semibold text-primary">Sports</h5>
            <p>Match reviews, sports news, and inspirational athlete stories.</p>
          </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
          <div class="icon-box">
            <i class="bi bi-bar-chart-line"></i>
            <h5 class="fw-semibold text-primary">Business</h5>
            <p>Entrepreneurship insights, finance tips, and business strategies.</p>
          </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
          <div class="icon-box">
            <i class="bi bi-book"></i>
            <h5 class="fw-semibold text-primary">Education</h5>
            <p>Learning guides and educational content for students and beyond.</p>
          </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
          <div class="icon-box">
            <i class="bi bi-camera-reels"></i>
            <h5 class="fw-semibold text-primary">Infotainment</h5>
            <p>Entertaining and informative podcasts, social discussions, and more.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- EXTRA SECTION (CTA) -->
  <div class="extra-section" data-aos="fade-up">
    <div class="container">
      <h3 class="fw-bold text-primary mb-3">Be Part of Our Community!</h3>
      <p class="lead">Create your account today to access all our exciting videos, podcasts & articles.</p>
      <a href="register.php" class="btn btn-primary mt-3 px-4">Join Now</a>
    </div>
  </div>

  <?php include 'includes/footer.php'; ?>

  <!-- AOS JS -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 1000,
      once: false
    });
  </script>
</body>
</html>
