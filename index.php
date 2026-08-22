<?php
require_once 'db.php';

// Target base table 'blogpost' directly
$query = "SELECT blogpost.*, user.username FROM blogpost 
          JOIN user ON blogpost.user_id = user.id 
          ORDER BY blogpost.created_at DESC LIMIT 4";   
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAVEN - Deep Within</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Cormorant+Garamond:ital,wght@1,400;1,500;1,600&family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        html, body {
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        body {
            background-color: #061126;
            color: #ffffff;
        }

        /* Fixed Fullscreen Background Video */
        #main-bg-video {
            position: fixed;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -2;
            transform: translate(-50%, -50%);
            object-fit: cover;
            filter: brightness(120%) contrast(102%);
        }

        /* Overlay Tint Layer */
        .bg-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 50% 50%, rgba(14, 116, 144, 0.15) 0%, rgba(3, 7, 18, 0.4) 70%),
                linear-gradient(180deg, rgba(3, 7, 18, 0.25) 0%, rgba(3, 7, 18, 0.5) 100%);
            z-index: -1;
        }

        /* Smooth Fullpage Wrapper */
        .page-wrapper {
            width: 100%;
            height: 100%;
            transition: transform 0.8s cubic-bezier(0.65, 0, 0.35, 1);
            will-change: transform;
        }

        /* COMMON SECTION STYLING */
        section {
            height: 100vh;
            width: 100vw;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: clamp(1rem, 3vh, 2.5rem) 5%;
            position: relative;
        }

        /* SECTION 1: TOP HERO */
        .top-hero-section {
            background: transparent;
        }

        .header-bar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
        }

        .header-bar .logo {
            font-size: clamp(1.1rem, 2.2vw, 1.6rem);
            font-weight: 800;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: 3px;
            text-shadow: 0 0 20px rgba(56, 189, 248, 0.6), 0 2px 8px rgba(0,0,0,0.8);
        }

        .btn-auth {
            padding: 0.5rem 1.2rem;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(14, 116, 144, 0.35);
            backdrop-filter: blur(12px);
            color: #ffffff;
            font-weight: 700;
            font-size: clamp(0.75rem, 1.2vw, 0.88rem);
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
        }

        .btn-auth:hover {
            background: #ffffff;
            color: #030712;
            box-shadow: 0 0 25px rgba(56, 189, 248, 0.6);
            border-color: #ffffff;
        }

        .quote-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 100%;
        }

        .quote-heading {
            max-width: 900px;
            width: 100%;
            font-family: 'Cinzel', serif;
            font-size: clamp(1.3rem, 3.5vw, 2.8rem);
            font-weight: 600;
            letter-spacing: 2px;
            line-height: 1.35;
            color: #ffffff;
            text-shadow: 0 4px 25px rgba(0, 0, 0, 0.95), 0 0 25px rgba(2, 132, 199, 0.6);
            
            will-change: transform, opacity;
            animation: emergeFromDeep 5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .quote-subtitle {
            margin-top: clamp(0.8rem, 2vh, 1.5rem);
            max-width: 800px;
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1rem, 2vw, 1.5rem);
            font-weight: 400;
            font-style: italic;
            color: #ffffff;
            letter-spacing: 1px;
            line-height: 1.4;
            text-shadow: 0 2px 15px rgba(0, 0, 0, 0.95), 0 0 12px rgba(56, 189, 248, 0.5);
            
            opacity: 0;
            will-change: transform, opacity;
            animation: emergeFromDeep 3.5s cubic-bezier(0.16, 1, 0.3, 1) 2s forwards;
        }

        @keyframes emergeFromDeep {
            0% {
                opacity: 0;
                transform: translateY(28px) scale(0.96);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .scroll-hint {
            text-align: center;
            color: #ffffff;
            font-size: clamp(0.7rem, 1.5vw, 0.85rem);
            letter-spacing: 1.5px;
            text-shadow: 0 2px 8px rgba(0,0,0,0.9);
            animation: floatGently 2.5s ease-in-out infinite;
            text-transform: lowercase;
            cursor: pointer;
        }

        @keyframes floatGently {
            0%, 100% { transform: translateY(0); opacity: 0.8; }
            50% { transform: translateY(-8px); opacity: 1; }
        }

        .bottom-menu-section {
            background: linear-gradient(180deg, rgba(3, 7, 18, 0.2) 0%, rgba(3, 7, 18, 0.65) 100%);
            justify-content: center;
            gap: 1.5rem;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: clamp(1.2rem, 3vh, 2.2rem);
            width: 100%;
            max-width: 1050px; 
        }

        .video-card {
            position: relative;
            height: clamp(160px, 26vh, 250px); 
            border-radius: 22px;
            overflow: hidden;
            text-decoration: none;
            border: 1px solid rgba(56, 189, 248, 0.25);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            align-items: flex-end;
            padding: clamp(1.2rem, 2.5vh, 2rem);
            background: rgba(15, 23, 42, 0.4);
        }

        .video-card:hover,
        .video-card:focus {
            transform: translateY(-6px) scale(1.02);
            border-color: rgba(125, 211, 252, 0.6);
            box-shadow: 0 20px 45px rgba(14, 116, 144, 0.5);
        }

        .video-card video {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            z-index: 1;
            transform: translate(-50%, -50%);
            object-fit: cover;
            filter: brightness(110%) saturate(110%);
            opacity: 1;
        }

        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, rgba(3, 7, 18, 0.1) 0%, rgba(3, 7, 18, 0.75) 100%);
            z-index: 2;
        }

        .card-label {
            position: relative;
            z-index: 3;
            color: #ffffff;
            font-size: clamp(1rem, 2.2vw, 1.35rem);
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-shadow: 0 2px 12px rgba(0, 0, 0, 0.9);
            letter-spacing: 0.5px;
        }

        .card-label i {
            color: #7dd3fc;
        }

        /* RECENT STORIES / BLOG LIST */
        .blogs-section {
            background: linear-gradient(180deg, rgba(3, 7, 18, 0.65) 0%, rgba(3, 7, 18, 0.95) 100%);
            justify-content: center;
            gap: 1rem;
        }

        .section-heading {
            font-family: 'Cinzel', serif;
            font-size: clamp(1.2rem, 2.5vw, 1.8rem);
            letter-spacing: 2px;
            text-shadow: 0 0 20px rgba(56, 189, 248, 0.6);
            text-align: center;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: clamp(0.8rem, 1.8vh, 1.4rem);
            width: 100%;
            max-width: 1050px;
        }

        .blog-card {
            background: rgba(15, 23, 42, 0.35);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            padding: clamp(0.8rem, 1.5vh, 1.2rem);
            text-decoration: none;
            color: #ffffff;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            height: clamp(100px, 16vh, 150px);
            overflow: hidden;
        }

        .blog-card:hover {
            transform: translateY(-4px);
            border-color: rgba(56, 189, 248, 0.6);
            box-shadow: 0 0 25px rgba(14, 116, 144, 0.4);
        }

        .blog-card h3 {
            font-family: 'Cinzel', serif;
            font-size: clamp(0.88rem, 1.5vw, 1.1rem);
            margin-bottom: 0.3rem;
            color: #7dd3fc;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .blog-card p {
            font-size: clamp(0.75rem, 1.2vw, 0.82rem);
            color: rgba(240, 249, 255, 0.8);
            line-height: 1.35;
            margin-bottom: 0.5rem;
            overflow: hidden;
            max-height: 2.7em;
        }

        .blog-meta {
            font-size: 0.72rem;
            color: rgba(255, 255, 255, 0.55);
            display: flex;
            justify-content: space-between;
        }

        .btn-view-all {
            padding: 0.5rem 1.4rem;
            border-radius: 12px;
            background: rgba(14, 116, 144, 0.35);
            border: 1px solid rgba(56, 189, 248, 0.4);
            color: #ffffff;
            font-weight: 700;
            font-size: clamp(0.75rem, 1.2vw, 0.85rem);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-view-all:hover {
            background: #ffffff;
            color: #030712;
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.6);
        }

        @media (max-width: 768px) {
            .menu-grid, .blog-grid {
                grid-template-columns: 1fr;
                gap: 0.8rem;
            }
            .video-card {
                height: clamp(100px, 15vh, 140px);
            }
            .blog-card {
                height: auto;
            }
        }
    </style>
</head>
<body>

    <!-- Main Background Video (whale.mp4) -->
    <video autoplay loop muted playsinline id="main-bg-video">
        <source src="wallpaper/whale.mp4" type="video/mp4">
    </video>
    <div class="bg-overlay"></div>

    <div class="page-wrapper" id="pageWrapper">
        
        <!-- SECTION 0: HERO QUOTE -->
        <section class="top-hero-section" id="hero-section">
            <header class="header-bar">
                <a href="index.php" class="logo">HAVEN</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="logout.php" class="btn-auth"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn-auth">Login</a>
                <?php endif; ?>
            </header>

            <div class="quote-wrapper">
                <h1 class="quote-heading">
                    "BEAUTIFUL SOULS CREATE BEAUTIFUL STORIES"
                </h1>
                <p class="quote-subtitle">
                    like whale songs echoing across the deep, let your voice reach the world.
                </p>
            </div>

            <div class="scroll-hint" id="scrollHint0">
                <i class="fa-solid fa-chevron-down"></i> dive deeper to explore
            </div>
        </section>

        <!-- SECTION 1: MENU GRID -->
        <section class="bottom-menu-section" id="menu-grid-section">
            <div class="menu-grid">
                
                <!-- Box 1: Create Blog -->
                <a href="create_post.php" class="video-card">
                    <video autoplay loop muted playsinline>
                        <source src="wallpaper/blue.mp4" type="video/mp4">
                    </video>
                    <div class="card-overlay"></div>
                    <div class="card-label">
                        <i class="fa-solid fa-pen-to-square"></i> Give Voice to Thought
                    </div>
                </a>

                <!-- Box 2: Blog Posts -->
                <a href="blog_posts.php" class="video-card">
                    <video autoplay loop muted playsinline>
                        <source src="wallpaper/sea.mp4" type="video/mp4">
                    </video>
                    <div class="card-overlay"></div>
                    <div class="card-label">
                        <i class="fa-solid fa-book-open"></i> Echoes of the Deep
                    </div>
                </a>

                <!-- Box 3: About -->
                <a href="about.php" class="video-card">
                    <video autoplay loop muted playsinline>
                        <source src="wallpaper/box3.mp4" type="video/mp4">
                    </video>
                    <div class="card-overlay"></div>
                    <div class="card-label">
                        <i class="fa-solid fa-compass"></i> About the Sanctuary
                    </div>
                </a>

                <!-- Box 4: Learning New Things -->
                <a href="aesthetic.php" class="video-card">
                    <video autoplay loop muted playsinline>
                        <source src="wallpaper/box4.mp4" type="video/mp4">
                    </video>
                    <div class="card-overlay"></div>
                    <div class="card-label">
                        <i class="fa-solid fa-graduation-cap"></i> Learning New Things
                    </div>
                </a>

            </div>

            <div class="scroll-hint" id="scrollHint1">
                <i class="fa-solid fa-chevron-down"></i> recent echoes
            </div>
        </section>

        <!-- SECTION 2: RECENT STORIES LIST -->
        <section class="blogs-section" id="blogs-section">
            <h2 class="section-heading">RESONATING STORIES</h2>

            <div class="blog-grid">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($post = $result->fetch_assoc()): ?>
                        <a href="single_post.php?id=<?= $post['id']; ?>" class="blog-card">
                            <div>
                                <h3><?= htmlspecialchars($post['title']); ?></h3>
                                <p><?= htmlspecialchars($post['content']); ?></p>
                            </div>
                            <div class="blog-meta">
                                <span><i class="fa-regular fa-user"></i> <?= htmlspecialchars($post['username']); ?></span>
                                <span><?= date('M j, Y', strtotime($post['created_at'])); ?></span>
                            </div>
                        </a>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p style="text-align: center; grid-column: span 2; color: rgba(255,255,255,0.6);">
                        No stories published yet. Be the first to share an echo.
                    </p>
                <?php endif; ?>
            </div>

            <a href="blog_posts.php" class="btn-view-all">View All Stories</a>
        </section>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const pageWrapper = document.getElementById('pageWrapper');
            const scrollHint0 = document.getElementById('scrollHint0');
            const scrollHint1 = document.getElementById('scrollHint1');
            
            let activeSection = 0;
            const totalSections = 3;
            let isLocked = false;

            function updateWrapper() {
                pageWrapper.style.transform = `translateY(-${activeSection * 100}vh)`;
            }

            function navigate(direction) {
                if (isLocked) return;

                if (direction === 'down' && activeSection < totalSections - 1) {
                    activeSection++;
                    updateWrapper();
                    isLocked = true;
                    setTimeout(() => { isLocked = false; }, 850);
                } else if (direction === 'up' && activeSection > 0) {
                    activeSection--;
                    updateWrapper();
                    isLocked = true;
                    setTimeout(() => { isLocked = false; }, 850);
                }
            }

            
            if (scrollHint0) {
                scrollHint0.addEventListener('click', () => navigate('down'));
            }
            if (scrollHint1) {
                scrollHint1.addEventListener('click', () => navigate('down'));
            }

            
            window.addEventListener('wheel', (e) => {
                if (Math.abs(e.deltaY) < 10) return;
                if (e.deltaY > 0) {
                    navigate('down');
                } else {
                    navigate('up');
                }
            }, { passive: true });

            
            let startY = 0;
            window.addEventListener('touchstart', (e) => {
                startY = e.touches[0].clientY;
            }, { passive: true });

            window.addEventListener('touchend', (e) => {
                const endY = e.changedTouches[0].clientY;
                const distance = startY - endY;

                if (distance > 35) {
                    navigate('down');
                } else if (distance < -35) {
                    navigate('up');
                }
            }, { passive: true });

            
            const mainBgVideo = document.getElementById('main-bg-video');
            if (mainBgVideo) {
                mainBgVideo.playbackRate = 0.65;
            }

            const cardVideos = document.querySelectorAll('.video-card video');
            cardVideos.forEach(video => {
                video.playbackRate = 0.5;
            });
        });
    </script>
</body>
</html>