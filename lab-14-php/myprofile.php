<?php
require "header.php";

if (!isset($_SESSION['userId'])) {
    header("Location: index.php?error=notloggedin");
    exit();
}

require 'includes/dbh.inc.php';

// Get user profile
$sql = "SELECT * FROM user_profiles WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION['userId']]);
$profile = $stmt->fetch(PDO::FETCH_ASSOC);

// Get user's visiting cards
$sql = "SELECT * FROM visiting_cards WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION['userId']]);
$cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .profile-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .profile-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .profile-title {
        font-size: 48px;
        font-weight: 900;
        background: linear-gradient(135deg, var(--accent-cyan), var(--accent-purple));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 20px;
    }

    .profile-container {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 40px;
    }

    .profile-sidebar {
        background: linear-gradient(135deg, rgba(42, 42, 42, 0.3), rgba(26, 26, 26, 0.5));
        border: 1px solid var(--metal-dark);
        border-radius: 15px;
        padding: 30px;
        text-align: center;
    }

    .profile-picture {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: var(--carbon-dark);
        margin: 0 auto 20px;
        overflow: hidden;
        border: 3px solid var(--accent-purple);
    }

    .profile-picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-name {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .profile-designation {
        color: var(--accent-cyan);
        margin-bottom: 20px;
    }

    .profile-info {
        text-align: left;
        margin-top: 20px;
    }

    .info-item {
        margin-bottom: 15px;
        padding: 10px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
    }

    .info-label {
        font-size: 12px;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .info-value {
        color: var(--text-primary);
        font-weight: 600;
    }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .card-preview {
        background: linear-gradient(135deg, rgba(42, 42, 42, 0.3), rgba(26, 26, 26, 0.5));
        border: 1px solid var(--metal-dark);
        border-radius: 15px;
        padding: 25px;
        transition: all 0.3s ease;
    }

    .card-preview:hover {
        transform: translateY(-5px);
        border-color: var(--accent-purple);
        box-shadow: 0 10px 30px rgba(153, 69, 255, 0.2);
    }

    /* Card Shapes */
    .card-shape-1 { border-radius: 10px; }
    .card-shape-2 { border-radius: 20px; }
    .card-shape-3 { border-radius: 50% 20px 20px 20px; }
    .card-shape-4 { border-radius: 20px 20px 0 20px; }
    .card-shape-5 { 
        border-radius: 30px 0 30px 0;
        transform: skew(-2deg);
    }
    .card-shape-6 { 
        clip-path: polygon(0 0, 100% 0, 100% 80%, 80% 100%, 0 100%);
    }
    .card-shape-7 { border-radius: 50%; }
    .card-shape-8 { 
        clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
    }
    .card-shape-9 { 
        clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
    }
    .card-shape-10 { 
        border-radius: 20px;
        position: relative;
    }
    .card-shape-11 { 
        border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
    }
    .card-shape-12 { 
        border-radius: 15px;
        border: 2px dashed rgba(255, 255, 255, 0.3);
    }

    /* Card Templates */
    .template-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .template-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .template-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .template-4 { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: #333; }

    .card-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .card-logo {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        margin-right: 15px;
        overflow: hidden;
        flex-shrink: 0;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .card-logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-logo-fallback {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        margin-right: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
        border: 2px dashed rgba(255, 255, 255, 0.3);
    }

    .card-name {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 5px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }

    .card-designation {
        font-size: 14px;
        opacity: 0.9;
        font-weight: 500;
    }

    .card-contact {
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .card-company {
        font-weight: 600;
        margin-top: 15px;
        font-size: 14px;
        padding: 8px 12px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        display: inline-block;
    }

    .no-cards {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-secondary);
    }

    .create-card-btn {
        display: inline-block;
        padding: 12px 30px;
        background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        margin-top: 20px;
    }

    .create-card-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(153, 69, 255, 0.4);
    }

    @media (max-width: 768px) {
        .profile-container {
            grid-template-columns: 1fr;
        }
        
        .cards-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<main>
    <div class="profile-wrapper">
        <div class="profile-header">
            <h1 class="profile-title">My Profile</h1>
            <a href="visitingcard.php" class="create-card-btn">Create New Card</a>
        </div>

        <div class="profile-container">
            <!-- Profile Sidebar -->
            <div class="profile-sidebar">
                <div class="profile-picture">
                    <?php 
                    if ($profile && !empty($profile['profile_picture'])) {
                        $image_filename = $profile['profile_picture'];
                        $image_path = 'uploads/' . $image_filename;
                        
                        if (file_exists($image_path)) {
                            echo '<img src="' . $image_path . '" alt="Profile Picture">';
                        } else {
                            echo '<div style="display: flex; align-items: center; justify-content: center; height: 100%; color: var(--text-secondary);">';
                            echo 'No Image<br><small>File missing</small>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div style="display: flex; align-items: center; justify-content: center; height: 100%; color: var(--text-secondary);">';
                        echo 'No Image';
                        echo '</div>';
                    }
                    ?>
                </div>
                
                <?php if ($profile): ?>
                    <h2 class="profile-name"><?php echo htmlspecialchars($profile['full_name']); ?></h2>
                    <div class="profile-designation"><?php echo htmlspecialchars($profile['designation']); ?></div>
                    <div class="profile-company"><?php echo htmlspecialchars($profile['company']); ?></div>
                    
                    <div class="profile-info">
                        <div class="info-item">
                            <div class="info-label">Email</div>
                            <div class="info-value"><?php echo htmlspecialchars($profile['email']); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Mobile</div>
                            <div class="info-value"><?php echo htmlspecialchars($profile['mobile']); ?></div>
                        </div>
                        <?php if ($profile['website']): ?>
                        <div class="info-item">
                            <div class="info-label">Website</div>
                            <div class="info-value"><?php echo htmlspecialchars($profile['website']); ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <p>No profile information found. <a href="visitingcard.php">Create your first visiting card</a> to set up your profile.</p>
                <?php endif; ?>
            </div>

            <!-- Visiting Cards -->
            <div class="profile-content">
                <h2 style="margin-bottom: 30px; color: var(--text-primary);">My Visiting Cards</h2>
                
                <?php if ($cards): ?>
                    <div class="cards-grid">
                        <?php foreach ($cards as $card): ?>
                            <div class="card-preview card-shape-<?php echo $card['card_shape']; ?> template-<?php echo $card['design_template']; ?>">
                                <div class="card-header">
                                    <?php 
                                    if (!empty($card['logo_path'])) {
                                        $image_filename = $card['logo_path'];
                                        $image_path = 'uploads/' . $image_filename;
                                        
                                        if (file_exists($image_path)) {
                                            echo '<div class="card-logo">';
                                            echo '<img src="' . $image_path . '" alt="Logo">';
                                            echo '</div>';
                                        } else {
                                            echo '<div class="card-logo-fallback">';
                                            echo '👤';
                                            echo '</div>';
                                        }
                                    } else {
                                        echo '<div class="card-logo-fallback">';
                                        echo '👤';
                                        echo '</div>';
                                    }
                                    ?>
                                    <div>
                                        <div class="card-name"><?php echo htmlspecialchars($card['full_name']); ?></div>
                                        <div class="card-designation"><?php echo htmlspecialchars($card['designation']); ?></div>
                                    </div>
                                </div>
                                
                                <div class="card-contact">
                                    <div>📧 <?php echo htmlspecialchars($card['email']); ?></div>
                                    <div>📱 <?php echo htmlspecialchars($card['mobile']); ?></div>
                                    <?php if ($card['address']): ?>
                                    <div>📍 <?php echo htmlspecialchars($card['address']); ?></div>
                                    <?php endif; ?>
                                    <?php if ($card['website']): ?>
                                    <div>🌐 <?php echo htmlspecialchars($card['website']); ?></div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="card-company"><?php echo htmlspecialchars($card['company']); ?></div>
                                
                                <div style="margin-top: 15px; font-size: 11px; color: rgba(255,255,255,0.7);">
                                    Created: <?php echo date('M j, Y', strtotime($card['created_at'])); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-cards">
                        <h3>No visiting cards created yet</h3>
                        <p>Create your first professional visiting card to get started!</p>
                        <a href="visitingcard.php" class="create-card-btn">Create Your First Card</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php
require "footer.php";
?>
