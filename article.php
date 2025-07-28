<?php require 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Artikel - Lensa TigaD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8f9fa;
    }

    .articles-section {
      max-width: 1100px;
      margin: 60px auto;
      padding: 0 20px;
    }

    .category-heading {
      border-left: 6px solid #4a69bd;
      padding-left: 15px;
      font-size: 1.5rem;
      font-weight: 600;
      margin-top: 60px;
      margin-bottom: 30px;
      color: #333;
    }

    .article-thumbnail {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 8px;
      max-height: 230px;
    }

    .card-title {
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 8px;
      color: #333;
    }

    .card-title:hover {
      color: #4a69bd;
    }

    .card-text {
      font-size: 1rem;
      color: #555;
    }

    .publish-date {
      font-size: 0.85rem;
      color: #999;
      margin-top: 10px;
    }

    .btn-primary {
      background-color: #4a69bd;
      border-color: #4a69bd;
    }

    .btn-primary:hover {
      background-color: #3756a3;
      border-color: #3756a3;
    }

    .view-all-btn {
      display: inline-block;
      margin-top: 5px;
      margin-bottom: 50px;
      color: #4a69bd;
      border-color: #4a69bd;
    }

    .view-all-btn:hover {
      background-color: #4a69bd;
      color: white;
    }

    h2.section-title {
      font-weight: bold;
      color: #333;
      border-bottom: 3px solid #4a69bd;
      display: inline-block;
      padding-bottom: 5px;
      margin-bottom: 30px;
    }
  </style>
</head>
<body>

<section class="articles-section">
  <h2 class="section-title">📘 List Article</h2>

  <?php
  $kategori_list = [
    'sports' => 'Sports',
    'business' => 'Business',
    'education' => 'Education',
    'infotainment' => 'Infotainment'
  ];

  foreach ($kategori_list as $kategori => $label) {
    $stmt = $conn->prepare("SELECT * FROM articles WHERE category = ? ORDER BY created_at DESC LIMIT 3");
    $stmt->bind_param("s", $kategori);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      echo '<div class="category-heading" data-aos="fade-right" data-aos-once="false">' . htmlspecialchars($label) . '</div>';

      $i = 0;
      while ($row = $result->fetch_assoc()) {
        $preview = substr(strip_tags($row['content']), 0, 200);
        if (strlen($row['content']) > 200) $preview .= '...';
        $img = !empty($row['thumbnail']) ? 'uploads/' . $row['thumbnail'] : 'images/default-thumbnail.jpg';

        echo '<div class="card mb-4 shadow-sm border-0" data-aos="fade-up" data-aos-delay="' . ($i * 100) . '" data-aos-once="false">';
        echo '  <div class="row g-0">';
        echo '    <div class="col-md-5">';
        echo '      <img src="' . htmlspecialchars($img) . '" class="article-thumbnail img-fluid" alt="Thumbnail">';
        echo '    </div>';
        echo '    <div class="col-md-7 p-3">';
        echo '      <div class="card-title">' . htmlspecialchars($row['title']) . '</div>';
        echo '      <div class="card-text">' . nl2br(htmlspecialchars($preview)) . '</div>';
        echo '      <div class="publish-date">📅 ' . date("d M Y, h:i A", strtotime($row['created_at'])) . '</div>';
        echo '      <a href="view_article.php?id=' . $row['id'] . '" class="btn btn-sm btn-primary mt-2">Read More</a>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
        $i++;
      }

      echo '<a href="category.php?type=' . $kategori . '" class="btn btn-outline-primary view-all-btn" data-aos="fade-up" data-aos-once="false">View All ' . htmlspecialchars($label) . '</a>';
    }

    $stmt->close();
  }
  ?>
</section>

<?php include 'includes/footer.php'; ?>

<!-- JS AOS -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    once: false,
    duration: 600,
    easing: 'ease-in-out',
  });
</script>

</body>
</html>
