<?php
// Initialize database tables
require 'dbh.inc.php';

try {
    // Create visiting_cards table
    $conn->exec("CREATE TABLE IF NOT EXISTS visiting_cards (
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

    // Create user_profiles table
    $conn->exec("CREATE TABLE IF NOT EXISTS user_profiles (
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

    echo "Database tables created successfully!";
    
} catch (PDOException $e) {
    echo "Error creating tables: " . $e->getMessage();
}
?>
