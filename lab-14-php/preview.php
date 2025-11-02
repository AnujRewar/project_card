<?php
require "header.php";

if (!isset($_SESSION['userId'])) {
    header("Location: index.php");
    exit();
}

require 'includes/dbh.inc.php';

// Get user's latest visiting card
$sql = "SELECT * FROM visiting_cards WHERE user_id = ? ORDER BY created_at DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION['userId']]);
$card = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$card) {
    header("Location: visitingcard.php");
    exit();
}
?>

<style>
.visiting-card {
    width: 350px;
    height: 200px;
    padding: 20px;
    margin: 20px auto;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    font-family: Arial, sans-serif;
    position: relative;
}

.card-content {
    display: flex;
    height: 100%;
}

.card-logo {
    width: 60px;
    margin-right: 15px;
}

.card-details {
    flex: 1;
}

.card-name {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
}

.card-designation {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
}

.card-contact {
    font-size: 12px;
    line-height: 1.4;
}

.card-organization {
    font-weight: bold;
    margin-top: 10px;
    font-size: 13px;
}

/* Template Styles */
.template-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
.template-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; }
.template-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; }
.template-4 { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: #333; }

.preview-container {
    text-align: center;
    padding: 20px;
}

.download-btn {
    background: #3498db;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin: 10px;
}

.download-btn:hover {
    background: #2980b9;
}
</style>

<main>
    <div class="preview-container">
        <h2>Your Visiting Card</h2>
        
        <div class="visiting-card template-<?php echo $card['design_template']; ?>">
            <div class="card-content">
                <?php if ($card['logo_path']): ?>
                <div class="card-logo">
                    <img src="../<?php echo $card['logo_path']; ?>" alt="Logo" style="width: 100%;">
                </div>
                <?php endif; ?>
                
                <div class="card-details">
                    <div class="card-name"><?php echo htmlspecialchars($card['full_name']); ?></div>
                    <div class="card-designation"><?php echo htmlspecialchars($card['designation']); ?></div>
                    <div class="card-contact">
                        <div>📧 <?php echo htmlspecialchars($card['email']); ?></div>
                        <div>📱 <?php echo htmlspecialchars($card['mobile']); ?></div>
                    </div>
                    <div class="card-organization"><?php echo htmlspecialchars($card['organization']); ?></div>
                </div>
            </div>
        </div>
        
        <button class="download-btn" onclick="downloadCard()">Download Card</button>
        <a href="visitingcard.php" class="download-btn">Create Another Card</a>
    </div>
</main>

<script>
function downloadCard() {
    // Simple implementation - you can enhance this with html2canvas for actual image download
    alert('Card download functionality can be implemented with html2canvas library');
}
</script>

<?php
require "footer.php";
?>
