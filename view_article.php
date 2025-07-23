<?php
require 'includes/db.php';
include 'includes/header.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Ralat: Artikel tidak dijumpai.";
    exit;
}

$id = intval($_GET['id']);

// Dapatkan artikel yang diminta
$stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$article = $stmt->get_result()->fetch_assoc();

if (!$article) {
    echo "Artikel tidak dijumpai.";
    exit;
}

// Dapatkan gambar utama dan sekunder
$stmtImg = $conn->prepare("SELECT * FROM article_images WHERE article_id = ?");
$stmtImg->bind_param("i", $id);
$stmtImg->execute();
$images = $stmtImg->get_result();

$primary = null;
$secondary = null;
while ($img = $images->fetch_assoc()) {
    if ($img['type'] === 'primary') $primary = $img['image_path'];
    if ($img['type'] === 'secondary') $secondary = $img['image_path'];
}

// Dapatkan 8 artikel terkini
$latest = $conn->query("SELECT id, title FROM articles ORDER BY created_at DESC LIMIT 8");
?>

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f4f4f4;
    margin: 0;
    padding: 0;
}
.container {
    display: flex;
    align-items: flex-start; /* Ini penting! */
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
    gap: 30px;
}

.container {
    display: flex;
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
    gap: 30px;
}
.article-main {
    width: 70%;
    background: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0,0,0,0.08);
    border-radius: 8px;
}
.article-main h2 {
    font-size: 2em;
    margin-bottom: 5px;
}
.article-meta {
    font-size: 0.9em;
    color: #777;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}
.article-main img {
    width: 100%;
    max-height: 500px;
    object-fit: cover;
    margin: 25px 0;
    border-radius: 5px;
}
.article-main p {
    font-size: 1.1em;
    text-align: justify;
    line-height: 1.6;
    margin-bottom: 20px;
}

.sidebar {
    width: 30%;
    align-self: flex-start; /* Boleh tambah sebagai backup */
    margin-top: 200px; /* Ubah nilai ni ikut tinggi gambar */
}

.sidebar h3 {
    margin-top: 0;
    font-size: 1.3em;
    margin-bottom: 15px;
    border-bottom: 2px solid #333;
    padding-bottom: 5px;
}
.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.sidebar ul li {
    margin-bottom: 12px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 8px;
}
.sidebar ul li a {
    text-decoration: none;
    color: #0066cc;
    font-weight: 500;
}
.sidebar ul li a:hover {
    color: #003366;
}
</style>

<div class="container">
    <!-- Artikel Utama -->
    <div class="article-main">
        <h2><?php echo htmlspecialchars($article['title']); ?></h2>
        <div class="article-meta">
            Kategori: <?php echo htmlspecialchars($article['category']); ?> |
            Tarikh: <?php echo date("d M Y, h:i A", strtotime($article['created_at'])); ?>
        </div>

        <?php if ($primary): ?>
            <img src="uploads/<?php echo $primary; ?>" alt="Gambar utama">
        <?php endif; ?>

        <?php
        // Pecahkan content ikut perenggan
        $paragraphs = explode("\n", trim($article['content']));
        $paraCount = 0;

        foreach ($paragraphs as $para) {
            if (!empty(trim($para))) {
                echo "<p>" . nl2br(htmlspecialchars($para)) . "</p>";
                $paraCount++;

                // Masukkan gambar sekunder selepas perenggan ke-3 jika ada
                if ($paraCount == 3 && $secondary) {
                    echo "<img src='uploads/$secondary' alt='Gambar tambahan'>";
                }
            }
        }
        ?>
    </div>

    <!-- Artikel Terkini -->
    <div class="sidebar">
        <h3>Artikel Terkini</h3>
        <ul>
            <?php while ($row = $latest->fetch_assoc()): ?>
                <li>
                    <a href="view_article.php?id=<?php echo $row['id']; ?>">
                        <?php echo htmlspecialchars($row['title']); ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
