<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['card-submit'])) {
    require 'dbh.inc.php';

    // Check if user is logged in
    if (!isset($_SESSION['userId'])) {
        header("Location: ../visitingcard.php?error=notloggedin");
        exit();
    }

    $user_id = $_SESSION['userId'];
    
    // Get form data
    $full_name = trim($_POST['full_name']);
    $designation = trim($_POST['designation']);
    $company = trim($_POST['company']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $website = isset($_POST['website']) ? trim($_POST['website']) : '';
    $card_shape = isset($_POST['card_shape']) ? intval($_POST['card_shape']) : 1;
    $template = isset($_POST['template']) ? intval($_POST['template']) : 1;

    // Basic validation
    $errors = [];
    
    if (empty($full_name)) $errors[] = "Full name is required";
    if (empty($designation)) $errors[] = "Designation is required";
    if (empty($company)) $errors[] = "Company is required";
    if (empty($email)) $errors[] = "Email is required";
    if (empty($mobile)) $errors[] = "Mobile number is required";
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (!preg_match('/^[0-9]{10}$/', $mobile)) {
        $errors[] = "Mobile number must be 10 digits";
    }

    // If there are errors, redirect back with error messages
    if (!empty($errors)) {
        $error_string = implode("|", $errors);
        header("Location: ../visitingcard.php?error=validation&details=" . urlencode($error_string) . "&name=" . urlencode($full_name) . "&designation=" . urlencode($designation) . "&company=" . urlencode($company) . "&email=" . urlencode($email) . "&mobile=" . urlencode($mobile));
        exit();
    }

    // Handle file upload
// Handle file upload - CORRECTED VERSION
$logo_path = null;
if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
    
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $max_size = 2 * 1024 * 1024; // 2MB
    
    $file_name = $_FILES['logo']['name'];
    $file_type = $_FILES['logo']['type'];
    $file_size = $_FILES['logo']['size'];
    $file_tmp = $_FILES['logo']['tmp_name'];
    
    // CORRECT: Upload directory is in root
    $upload_dir = __DIR__ . '/../uploads/';
    
    // Create directory if it doesn't exist
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    if (in_array($file_type, $allowed_types) && $file_size <= $max_size) {
        // Generate unique filename
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $filename = 'profile_' . $user_id . '_' . time() . '.' . $file_extension;
        
        // CORRECT: Store just the filename, not the path
        $logo_path = $filename; // NOT 'uploads/filename'
        
        // Full path for moving file
        $full_path = $upload_dir . $filename;
        
        if (move_uploaded_file($file_tmp, $full_path)) {
            // Verify file was moved successfully
            if (file_exists($full_path)) {
                error_log("✅ File uploaded successfully: $full_path");
                // Set proper permissions
                chmod($full_path, 0644);
            } else {
                error_log("❌ File move failed");
                $logo_path = null;
            }
        } else {
            error_log("❌ move_uploaded_file() failed");
            $logo_path = null;
        }
    } else {
        error_log("File validation failed - Type: $file_type, Size: $file_size");
    }
} else {
    $upload_error = $_FILES['logo']['error'] ?? 'No file';
    error_log("File upload error: $upload_error");
}

    try {
        // Start transaction
        $conn->beginTransaction();

        // Save to visiting cards table
        $sql = "INSERT INTO visiting_cards (user_id, full_name, designation, company, email, mobile, address, website, logo_path, card_shape, design_template) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id, $full_name, $designation, $company, $email, $mobile, $address, $website, $logo_path, $card_shape, $template]);
        
        // Save/Update user profile
        $sql = "INSERT OR REPLACE INTO user_profiles (user_id, full_name, designation, company, email, mobile, address, website, profile_picture, updated_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, datetime('now'))";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id, $full_name, $designation, $company, $email, $mobile, $address, $website, $logo_path]);
        
        $conn->commit();
        
        header("Location: ../visitingcard.php?success=1");
        exit();
        
    } catch (PDOException $e) {
        // Rollback transaction on error
        if ($conn->inTransaction()) {
            $conn->rollBack();
        }
        
        // Log the error for debugging
        error_log("Database error in savecard.inc.php: " . $e->getMessage());
        
        header("Location: ../visitingcard.php?error=dberror&message=" . urlencode($e->getMessage()));
        exit();
    }
    
} else {
    // Form not submitted properly
    header("Location: ../visitingcard.php");
    exit();
}
?>
