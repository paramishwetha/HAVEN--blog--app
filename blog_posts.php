<?php
require_once 'db.php';

$category = $_GET['category'] ?? '';

if (!empty($category)) {
    $stmt = $conn->prepare("SELECT blogPost.*, user.username FROM blogPost JOIN user ON blogPost.user_id = user.id WHERE blogPost.category = ? ORDER BY blogPost.created_at DESC");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $query = "SELECT blogPost.*, user.username FROM blogPost JOIN user ON blogPost.user_id = user.id ORDER BY blogPost.created_at DESC";
    $result = $conn->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= !empty($category) ? htmlspecialchars($category) : 'Echoes of the Deep'; ?> - HAVEN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #030712; color: #ffffff; min-height: 100vh; display: flex; flex-direction: column; justify-content: space-between; }
        .header-bar { width: 100%; padding: 1.5rem 3rem; display: flex; justify-content: space-between; align-items: center; }
        .header-bar .logo { font-size: 1.5rem; font-weight: 800; color: #ffffff; text-decoration: none; font-family: 'Cinzel', serif; }
        .btn-nav { padding: 0.6rem 1.2rem; border-radius: 12px; border: 1px solid rgba(255, 255, 255, 0.2); background: rgba(14, 116, 144, 0.25); color: #ffffff; font-weight: 700; font-size: 0.88rem; text-decoration: none; }
        .main-container { max-width: 900px; margin: 2rem auto; padding: 0 1.5rem; width: 100%; flex: 1; }
        .top-action-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; }
        .page-title { font-family: 'Cinzel', serif; font-size: 2rem; }
        .btn-create { background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); color: #ffffff; padding: 0.75rem 1.4rem; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 0.9rem; }
        .blog-list { display: flex; flex-direction: column; gap: 1.5rem; }
        .blog-card { background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.18); border-radius: 18px; padding: 1.8rem; text-decoration: none; color: #ffffff; transition: transform 0.3s ease; }
        .blog-card:hover { transform: translateY(-4px); border-color: rgba(56, 189, 248, 0.6); }
        .blog-card h3 { font-family: 'Cinzel', serif; font-size: 1.3rem; margin-bottom: 0.5rem; color: #7dd3fc; }
        .blog-card p { font-size: 0.92rem; color: rgba(240, 249, 255, 0.85); line-height: 1.6; margin-bottom: 1rem; }
        .blog-meta { font-size: 0.8rem; color: rgba(255, 255, 255, 0.55); display: flex; justify-content: space-between; }
        footer { text-align: center; padding: 1.5rem; color: rgba(255, 255, 255, 0.5); font-size: 0.82rem; }
    </style>
</head>
<body>

    <header class="header-bar">
        <a href="index.php" class="logo">HAVEN</a>
        <a href="aesthetic.php" class="btn-nav"><i class="fa-solid fa-layer-group"></i> Topics</a>
    </header>

    <main class="main-container">
        <div class="top-action-bar">
            <h1 class="page-title"><?= !empty($category) ? htmlspecialchars($category) : 'ECHOES OF THE DEEP'; ?></h1>
            <a href="create_post.php?category=<?= urlencode($category); ?>" class="btn-create">
                <i class="fa-solid fa-pen"></i> Write a <?= !empty($category) ? htmlspecialchars($category) : ''; ?> Story
            </a>
        </div>

        <div class="blog-list">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($post = $result->fetch_assoc()): ?>
                    <a href="single_post.php?id=<?= $post['id']; ?>" class="blog-card">
                        <h3><?= htmlspecialchars($post['title']); ?></h3>
                        <p><?= htmlspecialchars(substr($post['content'], 0, 180)) . '...'; ?></p>
                        <div class="blog-meta">
                            <span><i class="fa-regular fa-user"></i> <?= htmlspecialchars($post['username']); ?></span>
                            <span><?= date('M j, Y', strtotime($post['created_at'])); ?></span>
                        </div>
                    </a>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="text-align: center; color: rgba(255,255,255,0.6); padding: 3rem 0;">
                    No reflections in this topic yet. Be the first to share one!
                </p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> HAVEN Studio • All rights reserved</p>
    </footer>

</body>
</html>