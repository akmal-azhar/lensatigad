<?php
require 'includes/db.php';
include 'includes/header.php';

$kategori = isset($_GET['type']) ? $_GET['type'] : '';

$stmt = $conn->prepare("
    SELECT a.*, i.image_path 
    FROM articles a 
    LEFT JOIN article_images i ON a.id = i.article_id AND i.type = 'primary'
    WHERE a.category = ?
    ORDER BY a.created_at DESC
");
$stmt->bind_param("s", $kategori);
$stmt->execute();
$result = $stmt->get_result();
?>

<style>
body {
    background-color: #f5f5f5;
    color: #212529;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.category-container {
    max-width: 1200px;
    margin: auto;
    padding: 40px 15px;
}
.article-row {
    display: flex;
    flex-direction: row;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    margin-bottom: 25px;
    overflow: hidden;
    transition: transform 0.2s ease;
}
.article-row:hover {
    transform: translateY(-2px);
}
.article-thumbnail {
    flex: 0 0 250px;
    height: 170px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #fff;
    padding: 5px;
}
.article-thumbnail img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
.article-content {
    flex: 1;
    padding: 20px;
}
.article-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
}
.article-meta {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 12px;
}
.article-snippet {
    font-size: 1rem;
    color: #444;
    margin-bottom: 15px;
}
.btn-read {
    background-color: #007bff;
    color: white;
    padding: 8px 14px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 500;
}
.btn-read:hover {
    background-color: #0056b3;
}
h2.section-title {
    font-weight: bold;
    margin-bottom: 35px;
    color: #333;
    border-bottom: 2px solid #007bff;
    display: inline-block;
    padding-bottom: 6px;
}
@media (max-width: 768px) {
    .article-row {
        flex-direction: column;
    }
    .article-thumbnail {
        width: 100%;
        height: 200px;
    }
}
</style>

<div class="category-container">
    <h2 class="section-title">Kategori: <?= ucfirst(htmlspecialchars($kategori)) ?></h2>

    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <?php
                $thumb = $row['image_path'] ?? 'img/default-thumb.jpg';
                $thumb_path = (strpos($thumb, 'uploads/') === 0 || strpos($thumb, 'http') === 0) ? $thumb : 'uploads/' . $thumb;
            ?>
            <div class="article-row">
                <div class="article-thumbnail">
                    <img src="/lensatigad/<?= htmlspecialchars($thumb_path) ?>" alt="Thumbnail">
                </div>
                <div class="article-content">
                    <div class="article-title"><?= htmlspecialchars($row['title']) ?></div>
                    <div class="article-meta">📅 <?= date('d M Y', strtotime($row['created_at'])) ?></div>
                    <div class="article-snippet"><?= substr(strip_tags($row['content']), 0, 250) ?>...</div>
                    <a href="view_article.php?id=<?= $row['id'] ?>" class="btn-read">Baca Selanjutnya</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-muted">Tiada artikel dalam kategori ini buat masa sekarang.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
