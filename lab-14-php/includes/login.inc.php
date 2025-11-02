<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['login-submit'])) {
    require 'dbh.inc.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
        // Match user by username or email
        $sql = "SELECT * FROM users WHERE uidUsers = ? OR emailUsers = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$mailuid, $mailuid]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            //Verify password
            if (password_verify($password, $user['pwdUsers'])) {
                // Correct password → start session
                $_SESSION['userId'] = $user['idUsers'];
                $_SESSION['userUid'] = $user['uidUsers'];

                header("Location: ../index.php?login=success");
                exit();
            } else {
                header("Location: ../index.php?error=wrongpwd");
                exit();
            }
        } else {
            header("Location: ../index.php?error=nouser");
            exit();
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>

