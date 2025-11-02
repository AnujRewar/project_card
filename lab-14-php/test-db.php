<?php
// test-db.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$dbFile = __DIR__ . '/loginsystemtut.db';

try {
    $conn = new PDO('sqlite:' . $dbFile);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h3>Testing Database Insert</h3>";
    
    // Test inserting into visiting_cards
    $sql = "INSERT INTO visiting_cards (user_id, full_name, designation, company, email, mobile) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([1, 'Test User', 'Developer', 'Test Company', 'test@test.com', '1234567890']);
    
    if ($result) {
        echo "✅ Successfully inserted into visiting_cards table!<br>";
    } else {
        echo "❌ Failed to insert into visiting_cards<br>";
    }
    
    // Test inserting into user_profiles
    $sql = "INSERT INTO user_profiles (user_id, full_name, designation, company, email, mobile) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([1, 'Test User', 'Developer', 'Test Company', 'test@test.com', '1234567890']);
    
    if ($result) {
        echo "✅ Successfully inserted into user_profiles table!<br>";
    } else {
        echo "❌ Failed to insert into user_profiles<br>";
    }
    
    echo "<h3 style='color: green;'>Database test completed!</h3>";
    echo "<a href='visitingcard.php'>Go to Visiting Card Form</a>";
    
} catch (PDOException $e) {
    echo "<h3 style='color: red;'>Error: " . $e->getMessage() . "</h3>";
}
?>
