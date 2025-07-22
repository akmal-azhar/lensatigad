<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Semak kalau ada ID video dalam URL
if (!isset($_GET['id'])) {
    echo "Video not found.";
    exit;
}

$video_id = $_GET['id'];

// Dapatkan info video
$stmt = $conn->prepare("SELECT * FROM videos WHERE id = ?");
$stmt->bind_param("i", $video_id);
$stmt->execute();
$result = $stmt->get_result();
$video = $result->fetch_assoc();

if (!$video) {
    echo "Video not found.";
    exit;
}

// Dapatkan komen
$stmt = $conn->prepare("
    SELECT comments.*, users.name 
    FROM comments 
    JOIN users ON comments.user_id = users.id 
    WHERE video_id = ? ORDER BY created_at DESC
");
$stmt->bind_param("i", $video_id);
$stmt->execute();
$comments = $stmt->get_result();

// Kira jumlah LIKE
$stmt = $conn->prepare("SELECT COUNT(*) AS like_count FROM likes WHERE video_id = ? AND type = 'like'");
$stmt->bind_param("i", $video_id);
$stmt->execute();
$like_result = $stmt->get_result()->fetch_assoc();
$like_count = $like_result['like_count'];

// Kira jumlah DISLIKE
$stmt = $conn->prepare("SELECT COUNT(*) AS dislike_count FROM likes WHERE video_id = ? AND type = 'dislike'");
$stmt->bind_param("i", $video_id);
$stmt->execute();
$dislike_result = $stmt->get_result()->fetch_assoc();
$dislike_count = $dislike_result['dislike_count'];

//Check dah like ke belum
$userLiked = false;
if (isset($_SESSION['user']) && $_SESSION['user']['type'] === 'client') {
    $stmt = $conn->prepare("SELECT id FROM likes WHERE user_id = ? AND video_id = ?");
    $stmt->bind_param("ii", $_SESSION['user']['id'], $video_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $userLiked = $res->num_rows > 0;
}
$userDisliked = false;
if (isset($_SESSION['user']) && $_SESSION['user']['type'] === 'client') {
    $stmt = $conn->prepare("SELECT id FROM likes WHERE user_id = ? AND video_id = ? AND type = 'dislike'");
    $stmt->bind_param("ii", $_SESSION['user']['id'], $video_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $userDisliked = $res->num_rows > 0;
}

?>


<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f4f9;
        color: #333;
    }

    .video-container {
        max-width: 900px;
        margin: 50px auto;
        background-color: #fff;
        padding: 30px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        border-radius: 12px;
    }

    h2 {
        margin-bottom: 10px;
        color: #333;
    }

    p.description {
        color: #555;
        margin-bottom: 20px;
    }

    iframe {
        width: 100%;
        max-width: 100%;
        height: 500px;
        border-radius: 10px;
    }

    hr {
        margin: 30px 0;
        border: 1px solid #ddd;
    }

    .comment {
        background-color: #f8f8fc;
        padding: 15px;
        margin-bottom: 15px;
        border-left: 4px solid #4a90e2;
        border-radius: 8px;
    }

    .comment strong {
        color: #333;
    }

    .comment-form textarea {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .comment-form button {
        background-color: #4a90e2;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    .comment-form button:hover {
        background-color: #357bd8;
    }

    .delete-button {
        color: red;
        font-size: 13px;
        background: none;
        border: none;
        cursor: pointer;
        padding-left: 10px;
    }

    em {
        color: #999;
    }
</style>

<div class="video-container">
    <h2><?php echo htmlspecialchars($video['title']); ?></h2>
    <p class="description"><?php echo htmlspecialchars($video['description']); ?></p>
<iframe width="100%" height="400" 
        src="<?php echo htmlspecialchars($video['youtube_link']); ?>" 
        title="YouTube video player"
        frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen>
</iframe>

    <hr>

    <h3>Komen:</h3>
    <?php while ($row = $comments->fetch_assoc()): ?>
        <div class="comment">
            <p>
                <strong><?php echo htmlspecialchars($row['name']); ?>:</strong><br>
                <?php echo nl2br(htmlspecialchars($row['comment'])); ?>
            </p>

            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <form action="admin/delete_comment.php" method="get" onsubmit="return confirm('Padam komen ini?');" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="video_id" value="<?php echo $video_id; ?>">
                    <button type="submit" class="delete-button">🗑 Delete</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>

    <hr>

    <p>
        👍 Like: <span id="like-count"><?php echo $like_count; ?></span> &nbsp;&nbsp;
        👎 Dislike: <span id="dislike-count"><?php echo $dislike_count; ?></span>
    </p>

    <?php if (isset($_SESSION['user']) && $_SESSION['user']['type'] === 'client'): ?>
        <button 
            id="like-button" 
            data-liked="<?php echo $userLiked ? '1' : '0'; ?>" 
            style="background-color: transparent; border: none; cursor: pointer; color: #4a90e2; font-size: 16px;"
        >
            👍 <?php echo $userLiked ? 'Unlike' : 'Like'; ?>
        </button>

        <button 
            id="dislike-button" 
            data-disliked="<?php echo $userDisliked ? '1' : '0'; ?>" 
            style="background-color: transparent; border: none; cursor: pointer; color: #e94e77; font-size: 16px;"
        >
            👎 <?php echo $userDisliked ? 'Undislike' : 'Dislike'; ?>
        </button>
    <?php endif; ?>


    <?php if (isset($_SESSION['user']) && $_SESSION['user']['type'] === 'client'): ?>
        <div class="comment-form">
            <h4>Tinggalkan komen:</h4>
            <form action="add_comment.php" method="post">
                <textarea name="comment" rows="3" placeholder="Tulis komen anda..." required></textarea><br>
                <input type="hidden" name="video_id" value="<?php echo $video_id; ?>">
                <button type="submit">Hantar</button>
            </form>
        </div>
    <?php else: ?>
        <p><em>Sila log masuk sebagai client untuk komen.</em></p>
    <?php endif; ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const videoId = <?php echo $video_id; ?>;
    const likeButton = document.getElementById('like-button');
    const dislikeButton = document.getElementById('dislike-button');
    const likeCountSpan = document.getElementById('like-count');
    const dislikeCountSpan = document.getElementById('dislike-count');

    if (likeButton) {
        likeButton.addEventListener('click', function () {
            fetch('like_video.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'video_id=' + videoId + '&type=like'
            })
            .then(res => res.json())
            .then(data => {
                likeCountSpan.innerText = data.like_count;
                dislikeCountSpan.innerText = data.dislike_count;
                likeButton.innerHTML = data.liked ? '👍 Unlike' : '👍 Like';
                dislikeButton.innerHTML = data.disliked ? '👎 Undislike' : '👎 Dislike';
            });
        });
    }

    if (dislikeButton) {
        dislikeButton.addEventListener('click', function () {
            fetch('like_video.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'video_id=' + videoId + '&type=dislike'
            })
            .then(res => res.json())
            .then(data => {
                likeCountSpan.innerText = data.like_count;
                dislikeCountSpan.innerText = data.dislike_count;
                likeButton.innerHTML = data.liked ? '👍 Unlike' : '👍 Like';
                dislikeButton.innerHTML = data.disliked ? '👎 Undislike' : '👎 Dislike';
            });
        });
    }
});
</script>

<?php include 'includes/footer.php'; ?>
