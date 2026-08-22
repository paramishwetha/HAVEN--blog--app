<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$post_id = intval($_GET['id'] ?? 0);
$user_id = $_SESSION['user_id'];
$error = '';

// Authorization Check: Query base table 'blogpost' directly
$stmt = $conn->prepare("SELECT * FROM blogpost WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $post_id, $user_id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();

if (!$post) {
    header("Location: blog_posts.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if (!empty($title) && !empty($content)) {
        // Target base table 'blogpost' directly to allow updates
        $update_stmt = $conn->prepare("UPDATE blogpost SET title = ?, content = ?, updated_at = NOW() WHERE id = ? AND user_id = ?");
        $update_stmt->bind_param("ssii", $title, $content, $post_id, $user_id);
        if ($update_stmt->execute()) {
            header("Location: single_post.php?id=" . $post_id);
            exit();
        } else {
            $error = "Update failed. Please try again.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - HAVEN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

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
            max-width: 720px;
            margin: 3rem auto;
            padding: 0 1.5rem;
            width: 100%;
            flex: 1;
        }

        .card {
            background: rgba(15, 23, 42, 0.25);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.3), 0 0 30px rgba(14, 116, 144, 0.15);
        }

        .card h2 {
            font-family: 'Cinzel', serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 0.4rem;
            letter-spacing: 1px;
            text-shadow: 0 0 15px rgba(56, 189, 248, 0.4);
        }

        .card .subtitle {
            color: rgba(224, 242, 254, 0.85);
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.25);
            color: #fca5a5;
            padding: 0.8rem 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(239, 68, 68, 0.4);
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.6rem;
            color: #ffffff;
            letter-spacing: 0.5px;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 0.85rem 1rem;
            background: rgba(15, 23, 42, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 12px;
            font-size: 0.95rem;
            color: #ffffff;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-group textarea {
            height: 200px;
            resize: vertical;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-submit {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff;
            padding: 0.85rem 1.8rem;
            border-radius: 12px;
            border: none;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(2, 132, 199, 0.35);
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%);
            transform: translateY(-2px);
        }

        .btn-cancel {
            color: rgba(224, 242, 254, 0.85);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
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
        <a href="single_post.php?id=<?= $post_id; ?>" class="btn-nav"><i class="fa-solid fa-arrow-left"></i> Cancel</a>
    </header>

    <main class="container">
        <div class="card">
            <h2>Edit Story</h2>
            <p class="subtitle">Modify your previously shared reflection</p>

            <?php if ($error): ?>
                <div class="alert-danger">
                    <i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($post['title']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" required><?= htmlspecialchars($post['content']); ?></textarea>
                </div>

                <div class="actions">
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-check"></i> Save Changes
                    </button>
                    <a href="single_post.php?id=<?= $post_id; ?>" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> HAVEN Studio • All rights reserved</p>
    </footer>

</body>
</html>