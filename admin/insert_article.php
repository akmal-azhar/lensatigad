<?php
require '../includes/db.php';

// Semak jika borang dihantar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $content = trim($_POST['content']);

    // Upload gambar utama
    $thumbnail = $_FILES['thumbnail'];
    $thumbnail_secondary = $_FILES['thumbnail_secondary'];

    $uploadDir = '../uploads/';
    $thumbnailName = null;
    $thumbnailSecondaryName = null;

    // Simpan thumbnail utama jika ada
    if ($thumbnail['error'] === 0) {
        $thumbnailName = time() . '_' . basename($thumbnail['name']);
        move_uploaded_file($thumbnail['tmp_name'], $uploadDir . $thumbnailName);
    }

    // Simpan thumbnail sekunder jika ada
    if ($thumbnail_secondary['error'] === 0) {
        $thumbnailSecondaryName = time() . '_s_' . basename($thumbnail_secondary['name']);
        move_uploaded_file($thumbnail_secondary['tmp_name'], $uploadDir . $thumbnailSecondaryName);
    }

    // Masukkan ke dalam table articles
    $stmt = $conn->prepare("INSERT INTO articles (title, category, content, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $title, $category, $content);
    
    if ($stmt->execute()) {
        $article_id = $conn->insert_id;

        // Masukkan gambar utama jika ada
        if ($thumbnailName) {
            $stmtImg = $conn->prepare("INSERT INTO article_images (article_id, image_path, type) VALUES (?, ?, 'primary')");
            $path = $thumbnailName;
            $stmtImg->bind_param("is", $article_id, $path);
            $stmtImg->execute();
        }

        // Masukkan gambar sekunder jika ada
        if ($thumbnailSecondaryName) {
            $stmtImg2 = $conn->prepare("INSERT INTO article_images (article_id, image_path, type) VALUES (?, ?, 'secondary')");
            $path2 = $thumbnailSecondaryName;
            $stmtImg2->bind_param("is", $article_id, $path2);
            $stmtImg2->execute();
        }

        echo "<script>alert('Artikel berjaya dimasukkan!'); window.location.href = 'dashboard.php';</script>";
    } else {
        echo "Ralat: " . $stmt->error;
    }
} else {
    echo "Akses tidak sah.";
}
?>
