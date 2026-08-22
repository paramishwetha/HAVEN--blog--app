<?php
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$error = '';
$selected_category = $_GET['category'] ?? 'Coding & Tech';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $category = trim($_POST['category'] ?? 'General');
    $user_id = $_SESSION['user_id'];

    if (!empty($title) && !empty($content)) {
        $stmt = $conn->prepare("INSERT INTO blogpost (user_id, title, content, category) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $title, $content, $category);
        if ($stmt->execute()) {
            header("Location: blog_posts.php?category=" . urlencode($category));
            exit();
        } else {
            $error = "Failed to create post. Please try again.";
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
    <title>Create Post - HAVEN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        * { 
            box-sizing: border-box; 
            margin: 0; 
            padding: 0; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }

        body { 
            background: #030712; 
            background-image: 
                radial-gradient(circle at 50% 20%, rgba(14, 116, 144, 0.25) 0%, transparent 60%),
                linear-gradient(180deg, #030712 0%, #081a38 100%);
            background-attachment: fixed;
            color: #ffffff; 
            min-height: 100vh; 
            display: flex; 
            flex-direction: column; 
            justify-content: space-between; 
        }

        .header-bar { 
            width: 100%; 
            padding: 1.5rem 3rem; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }

        .header-bar .logo { 
            font-size: 1.5rem; 
            font-weight: 800; 
            color: #ffffff; 
            text-decoration: none; 
            font-family: 'Cinzel', serif; 
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
            backdrop-filter: blur(10px);
        }

        .btn-nav:hover {
            background: #ffffff;
            color: #030712;
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.6);
        }

        .container { 
            max-width: 700px; 
            margin: 2rem auto; 
            padding: 0 1.5rem; 
            width: 100%; 
            flex: 1; 
        }

        .card { 
            background: rgba(15, 23, 42, 0.4); 
            backdrop-filter: blur(16px); 
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.18); 
            border-radius: 20px; 
            padding: 2.5rem; 
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }

        .form-group { 
            margin-bottom: 1.5rem; 
            display: flex;
            flex-direction: column;
        }

        .form-group label { 
            display: block; 
            margin-bottom: 0.5rem; 
            font-weight: 600; 
            font-size: 0.9rem; 
            color: #ffffff;
        }

        .form-group input, 
        .form-group select, 
        .form-group textarea { 
            width: 100%; 
            padding: 0.85rem 1rem; 
            background: rgba(15, 23, 42, 0.35); 
            border: 1px solid rgba(255, 255, 255, 0.2); 
            border-radius: 12px; 
            color: #ffffff; 
            outline: none; 
            font-size: 0.95rem; 
            transition: all 0.3s ease;
        }

        .form-group select option { 
            background: #0f172a; 
            color: #ffffff; 
        }

        .form-group textarea { 
            height: 180px; 
            resize: vertical; 
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: rgba(56, 189, 248, 0.8);
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.25);
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            margin-top: 2rem;
        }

        .btn-submit { 
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); 
            color: #ffffff; 
            padding: 0.85rem 1.8rem; 
            border-radius: 12px; 
            border: none; 
            font-weight: 700; 
            font-size: 0.9rem;
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
            transition: color 0.2s ease;
        }

        .btn-cancel:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        footer { 
            text-align: center; 
            padding: 1.5rem; 
            color: rgba(255, 255, 255, 0.5); 
            font-size: 0.82rem; 
        }
    </style>
</head>
<body>

    <header class="header-bar">
        <a href="index.php" class="logo">HAVEN</a>
        <a href="index.php" class="btn-nav"><i class="fa-solid fa-house"></i> Home</a>
    </header>

    <main class="container">
        <div class="card">
            <h2 style="font-family: 'Cinzel', serif; margin-bottom: 1.5rem;">GIVE VOICE TO THOUGHT</h2>
            
            <?php if ($error): ?>
                <p style="color: #fca5a5; margin-bottom: 1rem;"><?= htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label>Topic Category</label>
                    <select name="category">
                        <option value="Coding & Tech" <?= $selected_category === 'Coding & Tech' ? 'selected' : ''; ?>>Coding & Tech</option>
                        <option value="Creative Writing" <?= $selected_category === 'Creative Writing' ? 'selected' : ''; ?>>Creative Writing</option>
                        <option value="Science & Systems" <?= $selected_category === 'Science & Systems' ? 'selected' : ''; ?>>Science & Systems</option>
                        <option value="Design & Aesthetics" <?= $selected_category === 'Design & Aesthetics' ? 'selected' : ''; ?>>Design & Aesthetics</option>
                        <option value="Personal Growth" <?= $selected_category === 'Personal Growth' ? 'selected' : ''; ?>>Personal Growth</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" placeholder="Title of your reflection" required>
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" placeholder="Share your knowledge or reflection..." required></textarea>
                </div>

                <div class="actions">
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-paper-plane"></i> Publish Reflection
                    </button>
                    <a href="blog_posts.php" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> HAVEN Studio • All rights reserved</p>
    </footer>

</body>
</html>