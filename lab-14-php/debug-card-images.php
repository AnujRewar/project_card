<?php
// debug-card-images.php
session_start();
require "includes/dbh.inc.php";

// Simulate logged in user if needed
if (!isset($_SESSION['userId'])) {
    $_SESSION['userId'] = 1;
    $_SESSION['userUid'] = 'testuser';
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Debug Card Images</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .debug-section { background: #f5f5f5; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .success { color: green; }
        .error { color: red; }
        .card-preview { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            color: white; 
            padding: 20px; 
            margin: 10px; 
            border-radius: 10px; 
            width: 300px; 
        }
    </style>
</head>
<body>
    <h2>Card Images Debug</h2>

    <div class="debug-section">
        <h3>Database Check - Cards with Images:</h3>
        <?php
        $stmt = $conn->query("SELECT * FROM visiting_cards WHERE user_id = {$_SESSION['userId']} ORDER BY created_at DESC");
        $cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($cards) {
            foreach ($cards as $card) {
                echo "<div class='card-preview'>";
                echo "<h4>Card ID: {$card['id']}</h4>";
                echo "Logo Path: <strong>" . ($card['logo_path'] ?: 'NULL') . "</strong><br>";
                
                if ($card['logo_path']) {
                    $full_path = '../' . $card['logo_path'];
                    echo "Full Path: $full_path<br>";
                    echo "File Exists: " . (file_exists($full_path) ? '<span class="success">Yes</span>' : '<span class="error">No</span>') . "<br>";
                    echo "File Readable: " . (is_readable($full_path) ? '<span class="success">Yes</span>' : '<span class="error">No</span>') . "<br>";
                    
                    if (file_exists($full_path)) {
                        echo "Image: <img src='$full_path' style='max-height: 100px; border: 2px solid white; margin: 10px 0;'><br>";
                        $image_info = getimagesize($full_path);
                        echo "Image Size: " . ($image_info ? "{$image_info[0]}x{$image_info[1]}" : "Invalid image") . "<br>";
                    }
                }
                
                echo "Name: {$card['full_name']}<br>";
                echo "Designation: {$card['designation']}<br>";
                echo "</div><hr>";
            }
        } else {
            echo "No cards found in database.<br>";
        }
        ?>
    </div>

    <div class="debug-section">
        <h3>Uploads Directory Contents:</h3>
        <?php
        $upload_dir = 'uploads/';
        if (is_dir($upload_dir)) {
            $files = scandir($upload_dir);
            echo "Files in uploads directory:<br>";
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    $file_path = $upload_dir . $file;
                    echo "- $file (" . round(filesize($file_path)/1024, 2) . " KB)";
                    echo " - <img src='$file_path' style='height: 50px; margin-left: 10px;'><br>";
                }
            }
        } else {
            echo "Uploads directory doesn't exist.<br>";
        }
        ?>
    </div>

    <div class="debug-section">
        <h3>Test Image Display Methods:</h3>
        <?php
        // Test different ways to display images
        if ($cards) {
            foreach ($cards as $card) {
                if ($card['logo_path']) {
                    $image_path = $card['logo_path'];
                    echo "<h4>Testing display for: $image_path</h4>";
                    
                    // Method 1: Direct path
                    echo "Method 1 (Direct): ";
                    echo "<img src='../$image_path' height='50' onerror='this.style.display=\"none\";'><br>";
                    
                    // Method 2: With error handling
                    echo "Method 2 (Error Handling): ";
                    if (file_exists('../' . $image_path)) {
                        echo "<img src='../$image_path' height='50'><br>";
                    } else {
                        echo "<span class='error'>File not found</span><br>";
                    }
                    
                    // Method 3: Base64 encode
                    echo "Method 3 (Base64): ";
                    if (file_exists('../' . $image_path)) {
                        $image_data = base64_encode(file_get_contents('../' . $image_path));
                        $image_info = getimagesize('../' . $image_path);
                        $mime_type = $image_info['mime'];
                        echo "<img src='data:$mime_type;base64,$image_data' height='50'><br>";
                    } else {
                        echo "<span class='error'>Cannot base64 - file not found</span><br>";
                    }
                }
            }
        }
        ?>
    </div>
</body>
</html>
