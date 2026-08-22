<?php
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning New Things - HAVEN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background: #030712;
            background-image: 
                radial-gradient(circle at 50% 20%, rgba(14, 116, 144, 0.25) 0%, transparent 60%),
                radial-gradient(circle at 80% 80%, rgba(56, 189, 248, 0.15) 0%, transparent 50%),
                linear-gradient(180deg, #030712 0%, #081a38 50%, #030712 100%);
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
            letter-spacing: 2px;
            font-family: 'Cinzel', serif;
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

        .main-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
            max-width: 1100px;
            margin: 0 auto;
            width: 100%;
        }

        .page-title {
            font-family: 'Cinzel', serif;
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 600;
            letter-spacing: 3px;
            text-align: center;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 20px rgba(56, 189, 248, 0.5);
        }

        .page-subtitle {
            color: rgba(224, 242, 254, 0.85);
            font-size: clamp(0.9rem, 1.8vw, 1.1rem);
            text-align: center;
            margin-bottom: 2.5rem;
            letter-spacing: 1px;
        }

        .learning-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.8rem;
            width: 100%;
        }

        .learning-card {
            position: relative;
            height: 200px;
            border-radius: 20px;
            overflow: hidden;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.6) 0%, rgba(14, 116, 144, 0.25) 100%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 1.8rem;
        }

        .learning-card:hover {
            transform: translateY(-8px) scale(1.02);
            border-color: rgba(125, 211, 252, 0.6);
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.75) 0%, rgba(14, 116, 144, 0.4) 100%);
            box-shadow: 0 20px 45px rgba(14, 116, 144, 0.4);
        }

        .card-content { color: #ffffff; }
        .card-content h3 { font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.6rem; }
        .card-content h3 i { color: #7dd3fc; font-size: 1.3rem; }
        .card-content p { font-size: 0.85rem; color: rgba(224, 242, 254, 0.85); line-height: 1.45; }

        footer { text-align: center; padding: 1.5rem; color: rgba(255, 255, 255, 0.5); font-size: 0.82rem; }
    </style>
</head>
<body>

    <header class="header-bar">
        <a href="index.php" class="logo">HAVEN</a>
        <a href="index.php" class="btn-nav"><i class="fa-solid fa-house"></i> Home</a>
    </header>

    <main class="main-container">
        <h1 class="page-title">LEARNING NEW THINGS</h1>
        <p class="page-subtitle">Select a topic to explore community reflections or write your own</p>

        <div class="learning-grid">
            
            <!-- Box 1 -->
            <a href="blog_posts.php?category=Coding%20%26%20Tech" class="learning-card">
                <div class="card-content">
                    <h3><i class="fa-solid fa-code"></i> Coding & Tech</h3>
                    <p>Master programming languages, algorithms, and digital tools.</p>
                </div>
            </a>

            <!-- Box 2 -->
            <a href="blog_posts.php?category=Creative%20Writing" class="learning-card">
                <div class="card-content">
                    <h3><i class="fa-solid fa-feather-pointed"></i> Creative Writing</h3>
                    <p>Express thoughts, construct narratives, and refine your storytelling voice.</p>
                </div>
            </a>

            <!-- Box 3 -->
            <a href="blog_posts.php?category=Science%20%26%20Systems" class="learning-card">
                <div class="card-content">
                    <h3><i class="fa-solid fa-atom"></i> Science & Systems</h3>
                    <p>Explore embedded systems, physics, and how things work beneath the surface.</p>
                </div>
            </a>

            <!-- Box 4 -->
            <a href="blog_posts.php?category=Design%20%26%20Aesthetics" class="learning-card">
                <div class="card-content">
                    <h3><i class="fa-solid fa-palette"></i> Design & Aesthetics</h3>
                    <p>Understand visual composition, UI aesthetics, and graphic styling.</p>
                </div>
            </a>

            <!-- Box 5 -->
            <a href="blog_posts.php?category=Personal%20Growth" class="learning-card">
                <div class="card-content">
                    <h3><i class="fa-solid fa-brain"></i> Personal Growth</h3>
                    <p>Develop critical thinking, build habits, and explore new perspectives.</p>
                </div>
            </a>

        </div>
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> HAVEN Studio • All rights reserved</p>
    </footer>

</body>
</html>