<?php
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - HAVEN Sanctuary</title>
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
                radial-gradient(circle at 50% 30%, rgba(14, 116, 144, 0.35) 0%, transparent 60%),
                radial-gradient(circle at 10% 80%, rgba(56, 189, 248, 0.25) 0%, transparent 50%),
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
            max-width: 800px;
            margin: 3.5rem auto;
            padding: 0 1.5rem;
            flex: 1;
        }

        .card {
            background: rgba(15, 23, 42, 0.25); /* Reduced darkness */
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
        }

        .card h1 {
            font-family: 'Cinzel', serif;
            font-size: 2.2rem;
            font-weight: 600;
            letter-spacing: 2px;
            margin-bottom: 1rem;
            color: #ffffff;
            text-shadow: 0 0 15px rgba(56, 189, 248, 0.4);
        }

        .card p {
            font-size: 1.05rem;
            line-height: 1.8;
            color: rgba(240, 249, 255, 0.9);
            margin-bottom: 1.5rem;
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
        <a href="index.php" class="btn-nav"><i class="fa-solid fa-house"></i> Home</a>
    </header>

    <main class="container">
        <div class="card">
            <h1>About the Sanctuary</h1>
            <p>HAVEN was created as a peaceful digital sanctuary for personal thoughts, reflections, and quiet self-expression. Inspired by the deep ocean and the echoing songs of whales, this platform gives voice to the hidden feelings inside every soul.</p>
            <p>Write your thoughts, explore shared stories, and find your aesthetic in a space free from noise.</p>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> HAVEN Studio • All rights reserved</p>
    </footer>

</body>
</html>