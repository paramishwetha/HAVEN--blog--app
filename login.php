<?php
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login_input = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($login_input) && !empty($password)) {
        // Query checks for EITHER username OR email column matching $login_input
        $stmt = $conn->prepare("SELECT id, username, password FROM user WHERE username = ? OR email = ?");
        if ($stmt) {
            $stmt->bind_param("ss", $login_input, $login_input);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($user = $result->fetch_assoc()) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    header("Location: index.php");
                    exit();
                } else {
                    $error = "Invalid password.";
                }
            } else {
                $error = "User not found.";
            }
            $stmt->close();
        } else {
            $error = "Database query failed.";
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
    <title>Login - HAVEN Sanctuary</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        html, body {
            height: 100vh;
            width: 100vw;
            overflow: hidden;
        }

        body {
            background-color: #030712;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #bg-video {
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
            filter: brightness(105%) contrast(102%);
        }

        .bg-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 50% 50%, rgba(14, 116, 144, 0.15) 0%, rgba(3, 7, 18, 0.5) 80%),
                linear-gradient(180deg, rgba(3, 7, 18, 0.3) 0%, rgba(3, 7, 18, 0.6) 100%);
            z-index: -1;
        }

        .header-bar {
            width: 100%;
            padding: 1.2rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-bar .logo {
            font-size: 1.4rem;
            font-weight: 800;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: 2px;
            font-family: 'Cinzel', serif;
            text-shadow: 0 0 15px rgba(56, 189, 248, 0.6);
        }

        .main-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 1rem;
        }

        .auth-card {
            width: 100%;
            max-width: 400px;
            background: rgba(15, 23, 42, 0.35);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 22px;
            padding: 2.2rem 2rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5), 0 0 30px rgba(14, 116, 144, 0.2);
            animation: fadeIn 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(15px) scale(0.98); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        .auth-card h2 {
            font-family: 'Cinzel', serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: #ffffff;
            text-align: center;
            letter-spacing: 2px;
            margin-bottom: 0.3rem;
            text-shadow: 0 0 15px rgba(56, 189, 248, 0.5), 0 2px 8px rgba(0,0,0,0.8);
        }

        .auth-card .subtitle {
            text-align: center;
            color: rgba(224, 242, 254, 0.9);
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            letter-spacing: 0.5px;
            text-shadow: 0 1px 4px rgba(0,0,0,0.8);
        }

        .alert-error {
            background-color: rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 0.6rem 0.8rem;
            border-radius: 10px;
            margin-bottom: 1.2rem;
            border: 1px solid rgba(239, 68, 68, 0.4);
            font-size: 0.82rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-shadow: 0 1px 3px rgba(0,0,0,0.8);
        }

        .form-group {
            margin-bottom: 1.2rem;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 0.82rem;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 0.4rem;
            letter-spacing: 0.5px;
            text-shadow: 0 1px 4px rgba(0,0,0,0.8);
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 1rem;
            color: rgba(125, 211, 252, 0.9);
            font-size: 0.9rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.6rem;
            background: rgba(15, 23, 42, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 12px;
            font-size: 0.9rem;
            color: #ffffff;
            outline: none;
            transition: all 0.3s ease;
            text-shadow: 0 1px 2px rgba(0,0,0,0.8);
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.55);
        }

        .form-group input:focus {
            background: rgba(15, 23, 42, 0.55);
            border-color: rgba(56, 189, 248, 0.8);
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.3);
        }

        .btn-submit {
            width: 100%;
            padding: 0.85rem;
            margin-top: 0.5rem;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, rgba(2, 132, 199, 0.85) 0%, rgba(3, 105, 161, 0.85) 100%);
            color: #ffffff;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(2, 132, 199, 0.35);
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(56, 189, 248, 0.45);
        }

        .auth-footer {
            margin-top: 1.4rem;
            text-align: center;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.85);
            text-shadow: 0 1px 4px rgba(0,0,0,0.8);
        }

        .auth-footer a {
            color: #7dd3fc;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .auth-footer a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        footer {
            text-align: center;
            padding: 1rem;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.78rem;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

    <video autoplay loop muted playsinline id="bg-video">
        <source src="wallpaper/login.mp4" type="video/mp4">
    </video>
    <div class="bg-overlay"></div>

    <header class="header-bar">
        <a href="index.php" class="logo">HAVEN</a>
    </header>

    <main class="main-container">
        <div class="auth-card">
            <h2>WELCOME BACK</h2>
            <p class="subtitle">Return to your deep sanctuary</p>

            <?php if ($error): ?>
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="username">Username or Email</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" id="username" name="username" placeholder="Enter username or email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    ENTER SANCTUARY
                </button>
            </form>

            <div class="auth-footer">
                Don't have an account? <a href="register.php">Create one</a>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> HAVEN Studio • All rights reserved</p>
    </footer>

</body>
</html>