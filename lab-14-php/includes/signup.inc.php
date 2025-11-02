<style>
    .wrapper-main {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        padding: 120px 20px 80px;
    }

    .section-default {
        background: linear-gradient(135deg,
                rgba(42, 42, 42, 0.3),
                rgba(26, 26, 26, 0.5));
        padding: 40px;
        border-radius: 20px;
        border: 1px solid var(--metal-dark);
        width: 400px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
        position: relative;
        overflow: hidden;
    }

    .section-default::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg,
                transparent,
                var(--accent-purple),
                transparent);
    }

    .section-default h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        background: linear-gradient(135deg, var(--text-primary), var(--accent-purple));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .form-signup input {
        width: 100%;
        padding: 15px;
        margin: 10px 0;
        background: var(--carbon-dark);
        border: 1px solid var(--metal-dark);
        border-radius: 8px;
        color: var(--text-primary);
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-signup input:focus {
        outline: none;
        border-color: var(--accent-purple);
        box-shadow: 0 0 10px rgba(153, 69, 255, 0.2);
    }

    .form-signup button {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
        border: none;
        border-radius: 8px;
        color: var(--text-primary);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 20px;
        box-shadow: 0 5px 15px rgba(153, 69, 255, 0.3);
    }

    .form-signup button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(153, 69, 255, 0.5);
    }

    .error {
        color: var(--accent-red);
        font-size: 0.9em;
        margin: 15px 0;
        padding: 10px;
        background: rgba(255, 51, 51, 0.1);
        border: 1px solid var(--accent-red);
        border-radius: 6px;
        text-align: center;
    }

    .password-wrapper {
        position: relative;
    }

    .password-wrapper input {
        padding-right: 45px;
    }

    .toggle-eye {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--text-secondary);
        transition: color 0.3s ease;
        background: none;
        border: none;
        font-size: 16px;
    }

    .toggle-eye:hover {
        color: var(--accent-cyan);
    }
</style>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['signup-submit'])) {
    require 'dbh.inc.php';

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&uid=" . $username . "&mail=" . $email);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid=" . $username);
        exit();
    }

else if (!preg_match("/^[a-zA-Z0-9_. ]*$/", $username)) {
    header("Location: ../signup.php?error=invaliduid&mail=" . $email);
    exit();
}

    else if ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&uid=" . $username . "&mail=" . $email);
        exit();
    }
    else {
        // Check if username already exists
        $sql = "SELECT uidUsers FROM users WHERE uidUsers = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            header("Location: ../signup.php?error=usertaken&mail=" . $email);
            exit();
        } else {
            // Insert new user using your real column names
            $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            $stmt->execute([$username, $email, $hashedPwd]);
            header("Location: ../signup.php?signup=success");
            exit();
        }
    }
} else {
    header("Location: ../signup.php");
    exit();
}
?>

