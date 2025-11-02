<?php
// fix-database.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database file path
$dbFile = __DIR__ . '/loginsystemtut.db';

try {
    // Create database connection
    $conn = new PDO('sqlite:' . $dbFile);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Database connected successfully!<br>";
    
    // Drop and recreate visiting_cards table with all columns
    $conn->exec("DROP TABLE IF EXISTS visiting_cards");
    echo "✓ Old visiting_cards table dropped<br>";
    
    $conn->exec("CREATE TABLE visiting_cards (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER NOT NULL,
        full_name TEXT NOT NULL,
        designation TEXT NOT NULL,
        company TEXT NOT NULL,
        email TEXT NOT NULL,
        mobile TEXT NOT NULL,
        address TEXT,
        website TEXT,
        logo_path TEXT,
        card_shape INTEGER DEFAULT 1,
        design_template INTEGER DEFAULT 1,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        is_active INTEGER DEFAULT 1
    )");
    echo "✓ New visiting_cards table created with all columns<br>";
    
    // Drop and recreate user_profiles table
    $conn->exec("DROP TABLE IF EXISTS user_profiles");
    echo "✓ Old user_profiles table dropped<br>";
    
    $conn->exec("CREATE TABLE user_profiles (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER UNIQUE NOT NULL,
        full_name TEXT NOT NULL,
        designation TEXT,
        company TEXT,
        email TEXT NOT NULL,
        mobile TEXT,
        address TEXT,
        website TEXT,
        profile_picture TEXT,
        bio TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    echo "✓ New user_profiles table created with all columns<br>";
    
    echo "<h3 style='color: green;'>Database fixed successfully!</h3>";
    echo "<a href='visitingcard.php' style='padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px;'>Go to Visiting Card Form</a>";
    
} catch (PDOException $e) {
    echo "<h3 style='color: red;'>Error: " . $e->getMessage() . "</h3>";
}
?>
