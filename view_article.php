<?php
require 'includes/db.php';
include 'includes/header.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Ralat: Artikel tidak dijumpai.";
    exit;
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Artikel tidak dijumpai.";
    exit;
}

$article = $result->fetch_assoc();
$content = nl2br($article['content']);

$thumbnail = !empty($article['thumbnail']) ? 'uploads/' . $article['thumbnail'] : 'images/default-thumbnail.jpg';
$thumbnail_secondary = !empty($article['thumbnail_secondary']) ? 'uploads/' . $article['thumbnail_secondary'] : null;
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($article['title']); ?> - Lensa TigaD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f9f9f9;
    }

    .article-wrapper {
      padding: 40px 20px;
    }

    .article-title {
      font-size: 2rem;
      font-weight: 700;
      color: #333;
    }

    .article-meta {
      color: #666;
      font-size: 0.9rem;
      margin-bottom: 15px;
    }

    .article-image {
      width: 100%;
      max-width: 500px;
      height: auto;
      margin: 20px 0;
      border-radius: 8px;
    }

    .article-content {
      font-size: 1.1rem;
      line-height: 1.8;
      color: #333;
      max-width: 800px;
    }

    .article-content p {
      margin-bottom: 18px;
      text-align: justify;
    }

    .btn-back {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<div class="article-wrapper">
  <a href="article.php" class="btn btn-outline-secondary btn-sm btn-back">&larr; Kembali</a>

  <h1 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h1>
  <div class="article-meta">
    Kategori: <?php echo ucfirst($article['category']); ?> | Diterbitkan: <?php echo date('d M Y', strtotime($article['created_at'])); ?>
  </div>

  <img src="<?php echo htmlspecialchars($thumbnail); ?>" class="article-image" alt="Thumbnail Utama">

  <div class="article-content">
    <?php
    $paragraphs = explode("\n", strip_tags($article['content']));
    foreach ($paragraphs as $index => $para) {
      if (trim($para) === '') continue;
      echo '<p>' . htmlspecialchars($para) . '</p>';

      if ($index == 2 && $thumbnail_secondary) {
        echo '<img src="' . htmlspecialchars($thumbnail_secondary) . '" class="article-image" alt="Thumbnail Sekunder">';
      } elseif ($index == 5) {
        echo '<img src="' . htmlspecialchars($thumbnail) . '" class="article-image" alt="Thumbnail">';
      }
    }
    ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
