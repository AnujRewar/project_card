<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Relative path to the SQLite DB file
$dbFile = __DIR__ . '/../loginsystemtut.db';

try {
    $conn = new PDO('sqlite:' . $dbFile);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>

