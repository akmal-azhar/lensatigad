<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tentang Kami - Lensa TigaD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f9f9f9;
    }

    .about-section {
      max-width: 1000px;
      margin: 50px auto;
      padding: 30px;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.07);
      text-align: center;
    }

    .about-section h2 {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .about-section p {
      font-size: 1.1rem;
      color: #444;
      line-height: 1.7;
    }

    .about-section img {
      margin-top: 30px;
      max-width: 500px;
      width: 100%;
      height: auto;
      border-radius: 12px;
      border: 2px solid #eee;
    }

    @media (max-width: 768px) {
      .about-section {
        padding: 20px;
        margin: 30px 15px;
      }
    }
    @keyframes fadeInUp {
  0% {
    opacity: 0;
    transform: translateY(30px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
  }

  .about-section {
    opacity: 0;
    animation: fadeInUp 0.8s ease forwards;
    animation-delay: 0.2s;
  }

  </style>
</head>
<body>

<section class="about-section">
  <h2>📺 What is Lensa TigaD?</h2>
  <p>
    <strong>Lensa TigaD</strong> is a digital video platform that delivers engaging content covering the world of <strong>podcast</strong>, <strong>sports</strong>, <strong>business</strong>, <strong>education</strong> and <strong>infotainment</strong>. We are committed to providing informative and entertaining content in a modern visual format that is easily accessible to people from all walks of life.
  </p>
  <img src="images/color logo.png" alt="Lensa TigaD Banner">
</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>
