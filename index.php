<?php
session_start();
require 'includes/db.php';

// Ambil 3 video lain selepas yang latest tadi
$allVideos = $conn->query("SELECT * FROM videos ORDER BY created_at DESC LIMIT 3");
?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lensa TigaD - Home</title>

  <!-- AOS CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      line-height: 1.6;
      margin: 0;
      padding: 0;
      background: #fff;
      color: #000;
    }

    .hero {
      background: #000;
      color: #fff;
      padding: 100px 20px;
      display: flex;
      justify-content: flex-start;
      align-items: center;
      min-height: 300px;
    }

    .banner {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 40px 20px;
      background: #111;
    }

    .banner div {
      flex: 1 1 220px;
      max-width: 260px;
      background: #000;
      color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(255,255,255,0.1);
      text-align: center;
    }

    .intro {
      padding: 40px 20px;
      text-align: center;
      background: #fff;
      color: #000;
    }

    .video-section {
      padding: 40px 20px;
      background: #f5f5f5;
      display: flex;
      flex-direction: column;
      gap: 30px;
    }

    .video-box {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 20px;
      background: #fff;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
    }

    .video-box iframe {
      width: 300px;
      height: 170px;
    }

    .video-box .description {
      flex: 1;
      color: #000;
    }

    a {
      color: #000;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .hero {
        flex-direction: column;
        text-align: center;
        padding: 80px 15px;
      }

      .hero-text {
        max-width: 100%;
      }

      .banner {
        flex-direction: column;
        align-items: center;
      }

      .video-box {
        flex-direction: column;
      }

      .video-box iframe {
        width: 100%;
        height: 200px;
      }
    }
  </style>
</head>
<body>

  <!-- HERO -->
  <div class="hero" data-aos="fade-left">
    <div class="hero-text">
      <h1>Welcome to Lensa TigaD 🎥</h1>
      <p>Your trusted platform that brings together Sports, Business, Education, and Infotainment — offering a comprehensive space to discover, gain knowledge, and experience quality content all in one place.</p>
    </div>
  </div>

  <!-- BANNER SECTION -->
  <div class="banner">
    <div data-aos="fade-left" data-aos-delay="200">
      <h3>Sports</h3>
      <p>Engaging video content covering both local and international sports, offering insights, highlights, and updates for enthusiasts and casual viewers alike.</p>
    </div>
    <div data-aos="fade-left" data-aos-delay="400">
      <h3>Business</h3>
      <p>Content that dives into market trends, financial tips, and real-world business advice to help sharpen your entrepreneurial mind.</p>
    </div>
    <div data-aos="fade-left" data-aos-delay="600">
      <h3>Education</h3>
      <p>Educational videos and knowledge-sharing content from a wide range of fields, designed to inspire learning and promote continuous personal development.</p>
    </div>
    <div data-aos="fade-left" data-aos-delay="800">
      <h3>Infotainment</h3>
      <p>Enjoy a variety of entertainment shows, podcasts, and much more — carefully curated to keep you informed, entertained, and connected with the latest trends.</p>
    </div>
  </div>

  <!-- INTRO -->
  <div class="intro" data-aos="fade-up">
    <h2>What is Lensa TigaD?</h2>
    <p>Lensa TigaD is a video platform that showcases a wide range of topics and podcast episodes for your viewing pleasure. Join our growing community today and stay connected with informative, inspiring, and entertaining content tailored just for you.</p>
  </div>

  <!-- LATEST VIDEOS -->
  <div class="video-section">
    <h2 data-aos="fade-up">🎬 3 Latest Video</h2>
    <?php while ($video = $allVideos->fetch_assoc()): ?>
      <div class="video-box" data-aos="fade-up">
        <iframe src="<?= htmlspecialchars($video['youtube_link']) ?>" frameborder="0" allowfullscreen></iframe>
        <div class="description">
          <h4><a href="video.php?id=<?= $video['id'] ?>"><?= htmlspecialchars($video['title']) ?></a></h4>
          <p><?= htmlspecialchars($video['description']) ?></p>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <?php include 'includes/footer.php'; ?>

  <!-- AOS JS -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 1000,
      once: false // animasi akan dimainkan setiap kali scroll up/down
    });
  </script>
</body>
</html>
