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
  <link rel="stylesheet" href="css/article.css">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f5f5f5;
    }
    .articles-section {
      max-width: 1000px;
      margin: 50px 0 50px 50px;
      padding: 0 15px;
      text-align: left;
    }
    .category-heading {
      border-left: 5px solid black;
      padding-left: 10px;
      font-size: 1.4rem;
      font-weight: 600;
      margin-top: 50px;
      margin-bottom: 25px;
    }
    .article-card {
      display: flex;
      gap: 15px;
      margin-bottom: 25px;
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      align-items: flex-start;
    }
    .article-thumbnail {
      width: 300px;
      height: 180px;
      object-fit: contain;
      object-position: center;
      background-color: #fff;
      flex-shrink: 0;
      border: 1px solid #ddd;
    }
    .article-body {
      padding: 15px 10px 15px 0;
      flex: 1;
    }
    .card-title {
      font-size: 1.1rem;
      font-weight: bold;
      margin-bottom: 5px;
    }
    .card-text {
      font-size: 0.95rem;
      color: #444;
      font-weight: bold;
    }
    .publish-date {
      font-size: 0.85rem;
      color: #777;
    }
    .view-all-btn {
      display: inline-block;
      margin-top: 10px;
      margin-bottom: 40px;
    }
  </style>
</head>
<body>

<section class="articles-section">
  <h2 class="mb-4" style="font-weight: bold;">📘 List Article</h2>

  <?php
  // List kategori ikut nama sebenar dalam DB
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
      echo '<div class="category-heading">' . htmlspecialchars($label) . '</div>';

      while ($row = $result->fetch_assoc()) {
        $preview = substr(strip_tags($row['content']), 0, 200);
        if (strlen($row['content']) > 200) $preview .= '...';
        $img = !empty($row['thumbnail']) ? 'uploads/' . $row['thumbnail'] : 'images/default-thumbnail.jpg';

        echo '<div class="article-card">';
        echo '<img src="' . htmlspecialchars($img) . '" class="article-thumbnail" alt="Thumbnail">';
        echo '<div class="article-body">';
        echo '<div class="card-title">' . htmlspecialchars($row['title']) . '</div>';
        echo '<div class="card-text">' . nl2br(htmlspecialchars($preview)) . '</div>';
        echo '<div class="publish-date mt-2">📅 ' . date("d M Y, h:i A", strtotime($row['created_at'])) . '</div>';
        echo '<a href="view_article.php?id=' . $row['id'] . '" class="btn btn-sm btn-primary mt-2">Read More</a>';
        echo '</div>';
        echo '</div>';
      }

      echo '<a href="category.php?type=' . $kategori . '" class="btn btn-outline-secondary view-all-btn">View All ' . htmlspecialchars($label) . '</a>';
    }

    $stmt->close();
  }
  ?>
</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>
