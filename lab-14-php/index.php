<?php 
require "header.php";
?>

<style>
    /* Hero Section Styles */
    .hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 120px 20px 80px;
        background: radial-gradient(ellipse at center,
                rgba(153, 69, 255, 0.1) 0%,
                transparent 50%);
    }

    .hero-content {
        text-align: center;
        max-width: 800px;
        z-index: 2;
    }

    .hero-title {
        font-size: 72px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 4px;
        margin-bottom: 30px;
        line-height: 1.1;
        background: linear-gradient(135deg,
                var(--accent-cyan) 0%,
                var(--accent-purple) 25%,
                var(--accent-blue) 50%,
                var(--accent-green) 75%,
                var(--accent-cyan) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        background-size: 200% 200%;
        animation: gradientFlow 5s ease infinite;
    }

    @keyframes gradientFlow {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    .hero-subtitle {
        font-size: 24px;
        color: var(--text-secondary);
        margin-bottom: 50px;
        line-height: 1.6;
        font-weight: 300;
    }

    .hero-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-primary {
        padding: 15px 40px;
        background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
        border: none;
        border-radius: 30px;
        color: var(--text-primary);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 5px 15px rgba(153, 69, 255, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(153, 69, 255, 0.5);
    }

    .btn-secondary {
        padding: 15px 40px;
        background: transparent;
        border: 2px solid var(--accent-purple);
        border-radius: 30px;
        color: var(--accent-purple);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-secondary:hover {
        background: var(--accent-purple);
        color: var(--text-primary);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(153, 69, 255, 0.3);
    }

    /* Status Messages */
    .status-message {
        max-width: 600px;
        margin: 30px auto;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        font-weight: 600;
    }

    .status-success {
        background: rgba(0, 255, 136, 0.1);
        border: 1px solid var(--accent-green);
        color: var(--accent-green);
    }

    .status-error {
        background: rgba(255, 51, 51, 0.1);
        border: 1px solid var(--accent-red);
        color: var(--accent-red);
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 48px;
        }

        .hero-subtitle {
            font-size: 18px;
        }

        .hero-buttons {
            flex-direction: column;
            align-items: center;
        }

        .btn-primary, .btn-secondary {
            width: 200px;
        }
    }
</style>

<main>
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">
                REFRACTING REALITY
            </h1>
            <p class="hero-subtitle">
                Transform your digital presence with cutting-edge solutions. 
                Create stunning visiting cards and build your professional identity 
                with PRISM FLUX's innovative platform.
            </p>

            <?php if (isset($_GET['login']) && $_GET['login'] == 'success'): ?>
                <div class="status-message status-success">
                    ✅ Login successful! Welcome back.
                </div>
            <?php elseif (isset($_GET['logout']) && $_GET['logout'] == 'success'): ?>
                <div class="status-message status-success">
                    ✅ Logout successful! See you soon.
                </div>
            <?php elseif (isset($_GET['error'])): ?>
                <div class="status-message status-error">
                    <?php
                    switch ($_GET['error']) {
                        case 'emptyfields': echo "⚠️ Please fill in all fields."; break;
                        case 'wrongpwd': echo "❌ Incorrect password."; break;
                        case 'nouser': echo "🚫 User not found."; break;
                        case 'notloggedin': echo "🔒 Please log in to access this feature."; break;
                        default: echo "❗ An error occurred."; break;
                    }
                    ?>
                </div>
            <?php endif; ?>

            <div class="hero-buttons">
                <?php if (isset($_SESSION['userId'])): ?>
                    <a href="visitingcard.php" class="btn-primary">Create Visiting Card</a>
                    <a href="portfolio.php" class="btn-secondary">View Portfolio</a>
                <?php else: ?>
                    <a href="signup.php" class="btn-primary">Get Started</a>
                    <a href="about.php" class="btn-secondary">Learn More</a>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php 
require "footer.php";
?>
