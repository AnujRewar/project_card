<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRISM FLUX - Digital Innovation Studio</title>
    <style>
        /* PRISM FLUX CSS Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-black: #0a0a0a;
            --carbon-dark: #121212;
            --carbon-medium: #1a1a1a;
            --carbon-light: #2a2a2a;
            --metal-dark: #3a3a3a;
            --metal-light: #4a4a4a;
            --accent-red: #ff3333;
            --accent-blue: #00a8ff;
            --accent-green: #00ff88;
            --accent-purple: #9945ff;
            --accent-cyan: #00ffff;
            --text-primary: #ffffff;
            --text-secondary: #b0b0b0;
            --text-dim: #808080;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: var(--primary-black);
            color: var(--text-primary);
            overflow-x: hidden;
            position: relative;
            padding-top: 80px; /* Add padding to prevent header overlap */
        }

        /* Carbon Fiber Background Pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                repeating-linear-gradient(0deg,
                    transparent,
                    transparent 2px,
                    rgba(255, 255, 255, 0.03) 2px,
                    rgba(255, 255, 255, 0.03) 4px),
                repeating-linear-gradient(90deg,
                    transparent,
                    transparent 2px,
                    rgba(255, 255, 255, 0.03) 2px,
                    rgba(255, 255, 255, 0.03) 4px),
                linear-gradient(135deg,
                    var(--primary-black) 0%,
                    var(--carbon-dark) 25%,
                    var(--carbon-medium) 50%,
                    var(--carbon-dark) 75%,
                    var(--primary-black) 100%);
            z-index: -2;
        }

        /* Navigation Header */
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(18, 18, 18, 0.98);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 1000; /* Ensure header stays on top */
            transition: all 0.3s ease;
        }

        .header.scrolled {
            background: rgba(18, 18, 18, 0.98);
            backdrop-filter: blur(30px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
        }

        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            position: relative;
            z-index: 1001;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            margin-right: 15px;
            position: relative;
        }

        .logo-prism {
            width: 100%;
            height: 100%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .prism-shape {
            width: 25px;
            height: 25px;
            position: relative;
            transform: rotate(45deg);
            background: linear-gradient(135deg,
                    var(--accent-red) 0%,
                    var(--accent-blue) 33%,
                    var(--accent-green) 66%,
                    var(--accent-purple) 100%);
            animation: prismShine 3s ease-in-out infinite;
        }

        @keyframes prismShine {
            0%, 100% {
                filter: brightness(1) hue-rotate(0deg);
                transform: rotate(45deg) scale(1);
            }
            50% {
                filter: brightness(1.5) hue-rotate(10deg);
                transform: rotate(45deg) scale(1.1);
            }
        }

        .logo-text {
            font-size: 22px;
            font-weight: 900;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .logo-text .prism {
            background: linear-gradient(135deg, var(--text-primary), var(--accent-cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logo-text .flux {
            color: var(--text-secondary);
            font-weight: 300;
            margin-left: 5px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 10px;
            align-items: center;
        }

        .nav-menu a {
            color: var(--text-secondary);
            text-decoration: none;
            padding: 10px 20px;
            transition: all 0.3s ease;
            position: relative;
            text-transform: uppercase;
            font-weight: 500;
            letter-spacing: 1px;
            font-size: 14px;
        }

        .nav-menu a::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--accent-blue), var(--accent-purple));
            transition: width 0.3s ease;
        }

        .nav-menu a:hover {
            color: var(--text-primary);
        }

        .nav-menu a:hover::before,
        .nav-menu a.active::before {
            width: 80%;
        }

        .nav-menu a.active {
            color: var(--accent-cyan);
        }

        /* Login Form Styles */
        .login-container {
            display: flex;
            align-items: center;
            gap: 15px;
            z-index: 1001;
        }

        .login-form {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .login-form input {
            padding: 8px 12px;
            background: var(--carbon-medium);
            border: 1px solid var(--metal-dark);
            border-radius: 6px;
            color: var(--text-primary);
            font-size: 13px;
            transition: all 0.3s ease;
            width: 120px;
        }

        .login-form input:focus {
            outline: none;
            border-color: var(--accent-purple);
            box-shadow: 0 0 10px rgba(153, 69, 255, 0.2);
        }

        .login-btn {
            padding: 8px 16px;
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
            border: none;
            border-radius: 6px;
            color: var(--text-primary);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(153, 69, 255, 0.4);
        }

        .signup-btn {
            padding: 8px 16px;
            background: transparent;
            border: 2px solid var(--accent-purple);
            border-radius: 6px;
            color: var(--accent-purple);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
            text-decoration: none;
        }

        .signup-btn:hover {
            background: var(--accent-purple);
            color: var(--text-primary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(153, 69, 255, 0.4);
        }

        .user-welcome {
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--text-primary);
        }

        .user-welcome p {
            color: var(--accent-cyan);
            font-weight: 600;
            font-size: 14px;
        }

        .logout-btn {
            padding: 8px 16px;
            background: transparent;
            border: 2px solid var(--accent-red);
            border-radius: 6px;
            color: var(--accent-red);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
        }

        .logout-btn:hover {
            background: var(--accent-red);
            color: var(--text-primary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 51, 51, 0.4);
        }

        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper input {
            padding-right: 35px;
        }

        .toggle-eye {
            position: absolute;
            right: 10px;
            cursor: pointer;
            color: var(--text-secondary);
            transition: color 0.3s ease;
            background: none;
            border: none;
            font-size: 14px;
        }

        .toggle-eye:hover {
            color: var(--accent-cyan);
        }

        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 5px;
            z-index: 1001;
        }

        .menu-toggle span {
            width: 25px;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-blue), var(--accent-purple));
            margin: 3px 0;
            transition: 0.3s;
            border-radius: 2px;
        }

        .menu-toggle.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }

            .menu-toggle {
                display: flex;
            }

            .nav-menu {
                position: fixed;
                left: -100%;
                top: 70px;
                flex-direction: column;
                background: rgba(18, 18, 18, 0.98);
                width: 100%;
                text-align: center;
                transition: 0.3s;
                padding: 30px 0;
                border-bottom: 1px solid var(--metal-dark);
                gap: 0;
                backdrop-filter: blur(20px);
            }

            .nav-menu li {
                margin: 12px 0;
            }

            .nav-menu a {
                display: block;
                padding: 12px 30px;
                font-size: 16px;
            }

            .nav-menu.active {
                left: 0;
            }

            .login-container {
                flex-direction: column;
                gap: 10px;
            }

            .login-form {
                flex-direction: column;
                width: 100%;
            }

            .login-form input {
                width: 100%;
                margin-bottom: 8px;
            }

            .nav-container {
                padding: 12px 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation Header -->
    <header class="header" id="header">
        <nav class="nav-container">
            <a href="index.php" class="logo">
                <div class="logo-icon">
                    <div class="logo-prism">
                        <div class="prism-shape"></div>
                    </div>
                </div>
                <span class="logo-text">
                    <span class="prism">PRISM</span>
                    <span class="flux">FLUX</span>
                </span>
            </a>
            
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php" class="nav-link active">Home</a></li>
                <li><a href="visitingcard.php" class="nav-link">Visiting Card</a></li>
                <li><a href="myprofile.php" class="nav-link">My Profile</a></li>
                <li><a href="portfolio.php" class="nav-link">Portfolio</a></li>
                <li><a href="about.php" class="nav-link">About</a></li>
            </ul>
            
            <div class="login-container">
                <?php if (isset($_SESSION['userId'])): ?>
                    <div class="user-welcome">
                        <p>Welcome, <?php echo htmlspecialchars($_SESSION['userUid']); ?>!</p>
                        <form action="includes/logout.inc.php" method="post" style="display: inline;">
                            <button type="submit" name="logout-submit" class="logout-btn">Logout</button>
                        </form>
                    </div>
                <?php else: ?>
                    <form class="login-form" action="includes/login.inc.php" method="post">
                        <input type="text" name="mailuid" placeholder="Username/E-mail...">
                        <div class="password-wrapper">
                            <input type="password" name="pwd" id="login-pwd" placeholder="Password">
                            <span class="toggle-eye" onclick="togglePassword('login-pwd', this)">👁️</span>
                        </div>
                        <button type="submit" name="login-submit" class="login-btn">Login</button>
                    </form>
                    <a href="signup.php" class="signup-btn">Signup</a>
                <?php endif; ?>
            </div>

            <div class="menu-toggle" id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <script>
        function togglePassword(id, eye) {
            const field = document.getElementById(id);
            if (field.type === "password") {
                field.type = "text";
                eye.textContent = "🔒";
            } else {
                field.type = "password";
                eye.textContent = "👁️";
            }
        }

        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const navMenu = document.getElementById('navMenu');

        menuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            menuToggle.classList.toggle('active');
        });

        // Header scroll effect
        const header = document.getElementById('header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Close mobile menu when clicking on links
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
                menuToggle.classList.remove('active');
            });
        });
    </script>
