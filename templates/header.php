<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Document Management System</a>
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="index.php">Home</a>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <a class="nav-item nav-link" href="admin.php">Admin Dashboard</a>
                    <?php endif; ?>
                    <a class="nav-item nav-link" href="user.php">My Documents</a>
                    <a class="nav-item nav-link" href="../actions/logout.php">Logout</a>
                </div>
            <?php else: ?>
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="../public/login.php">Login</a>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <main class="container mt-4">
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success" role="alert">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
