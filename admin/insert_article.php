<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    echo "Akses tidak sah.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $category = trim($_POST['category']);

    // Thumbnail utama
    $thumbnail_name = '';
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
        $thumbnail_tmp = $_FILES['thumbnail']['tmp_name'];
        $thumbnail_name = time() . '_' . basename($_FILES['thumbnail']['name']);
        $upload_path = '../uploads/' . $thumbnail_name;

        if (!is_dir('../uploads')) {
            mkdir('../uploads', 0777, true);
        }

        move_uploaded_file($thumbnail_tmp, $upload_path);
    }

    // Thumbnail kedua
    $thumbnail_secondary_name = '';
    if (isset($_FILES['thumbnail_secondary']) && $_FILES['thumbnail_secondary']['error'] === UPLOAD_ERR_OK) {
        $thumb2_tmp = $_FILES['thumbnail_secondary']['tmp_name'];
        $thumbnail_secondary_name = time() . '_2_' . basename($_FILES['thumbnail_secondary']['name']);
        $upload_path2 = '../uploads/' . $thumbnail_secondary_name;

        if (!is_dir('../uploads')) {
            mkdir('../uploads', 0777, true);
        }

        move_uploaded_file($thumb2_tmp, $upload_path2);
    }

    if (!empty($title) && !empty($content) && !empty($category)) {
        $stmt = $conn->prepare("INSERT INTO articles (title, content, category, thumbnail, thumbnail_secondary, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $title, $content, $category, $thumbnail_name, $thumbnail_secondary_name);

        if ($stmt->execute()) {
            echo "<div style='padding: 20px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px;'>
                    Artikel berjaya dimuat naik!
                  </div><br>";
            echo "<a href='add_article.php'>Kembali ke Upload Article</a> | <a href='articles.php'>Lihat Semua Artikel</a>";
            exit;
        } else {
            echo "<div style='color: red;'>Ralat semasa simpan artikel.</div>";
        }
    } else {
        echo "<div style='color: red;'>Sila isi semua ruangan.</div>";
    }
} else {
    echo "<div style='color: red;'>Akses tidak sah.</div>";
}
?>
