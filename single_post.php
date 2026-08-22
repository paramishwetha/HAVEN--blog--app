<?php
require_once 'db.php';

$post_id = intval($_GET['id'] ?? 0);

// Fetch post details with author username directly from the base table 'blogpost'
$stmt = $conn->prepare("SELECT blogpost.*, user.username FROM blogpost JOIN user ON blogpost.user_id = user.id WHERE blogpost.id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();

if (!$post) {
    header("Location: blog_posts.php");
    exit();
}

$is_author = isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $post['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title']); ?> - HAVEN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: #081a38;
            background-image: 
                radial-gradient(circle at 50% 20%, rgba(14, 116, 144, 0.35) 0%, transparent 60%),
                radial-gradient(circle at 80% 80%, rgba(56, 189, 248, 0.25) 0%, transparent 50%),
                linear-gradient(180deg, #091e42 0%, #0d2854 50%, #061530 100%);
            background-attachment: fixed;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header-bar {
            width: 100%;
            padding: 1.5rem 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(9, 30, 66, 0.4);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        .header-bar .logo {
            font-size: 1.5rem;
            font-weight: 800;
            font-family: 'Cinzel', serif;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: 2px;
            text-shadow: 0 0 15px rgba(56, 189, 248, 0.6);
        }

        .btn-nav {
            padding: 0.6rem 1.2rem;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(14, 116, 144, 0.25);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.88rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-nav:hover {
            background: #ffffff;
            color: #081a38;
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.5);
        }

        .container {
            max-width: 820px;
            margin: 3.5rem auto;
            padding: 0 1.5rem;
            flex: 1;
            width: 100%;
        }

        .card {
            background: rgba(15, 23, 42, 0.25);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
        }

        .post-title {
            font-family: 'Cinzel', serif;
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
            color: #ffffff;
            text-shadow: 0 0 15px rgba(56, 189, 248, 0.4);
        }

        .post-meta {
            font-size: 0.88rem;
            color: rgba(186, 230, 253, 0.85);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .post-content {
            font-size: 1.05rem;
            line-height: 1.8;
            color: rgba(240, 249, 255, 0.92);
            margin-bottom: 2.5rem;
            white-space: pre-wrap;
        }

        .author-actions {
            display: flex;
            gap: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            padding-top: 1.5rem;
        }

        .btn-edit {
            background: rgba(14, 116, 144, 0.4);
            border: 1px solid rgba(56, 189, 248, 0.5);
            color: #ffffff;
            padding: 0.65rem 1.4rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-edit:hover {
            background: rgba(56, 189, 248, 0.8);
            color: #081a38;
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.3);
            border: 1px solid rgba(239, 68, 68, 0.5);
            color: #fca5a5;
            padding: 0.65rem 1.4rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-delete:hover {
            background: rgba(239, 68, 68, 0.8);
            color: #ffffff;
        }

        footer {
            text-align: center;
            padding: 1.5rem;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <header class="header-bar">
        <a href="index.php" class="logo">HAVEN</a>
        <a href="blog_posts.php" class="btn-nav"><i class="fa-solid fa-arrow-left"></i> Back to Echoes</a>
    </header>

    <main class="container">
        <article class="card">
            <h1 class="post-title"><?= htmlspecialchars($post['title']); ?></h1>
            <div class="post-meta">
                <span><i class="fa-regular fa-user"></i> <?= htmlspecialchars($post['username']); ?></span>
                <span>•</span>
                <span><i class="fa-regular fa-calendar"></i> <?= date('F j, Y', strtotime($post['created_at'])); ?></span>
            </div>

            <div class="post-content"><?= htmlspecialchars($post['content']); ?></div>

            <?php if ($is_author): ?>
                <div class="author-actions">
                    <a href="edit_post.php?id=<?= $post['id']; ?>" class="btn-edit"><i class="fa-solid fa-pen"></i> Edit Story</a>
                    <a href="delete_post.php?id=<?= $post['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this story?');"><i class="fa-solid fa-trash"></i> Delete Story</a>
                </div>
            <?php endif; ?>
        </article>
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> HAVEN Studio • All rights reserved</p>
    </footer>

</body>
</html>