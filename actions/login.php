<?php
session_start();
require '../config/db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (!empty($username) && !empty($password)) {
    $password = md5($password);  // Encrypt the password input with MD5 to match the database
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Authentication success
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['logged_in'] = true;
        header('Location: ../public/index.php');
    } else {
        // Authentication failed
        $_SESSION['error'] = 'Invalid username or password';
        header('Location: ../public/login.php');
    }
} else {
    $_SESSION['error'] = 'Username and password are required';
    header('Location: ../public/login.php');
}
exit();
?>
