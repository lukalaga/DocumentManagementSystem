<?php 
include('../templates/header.php');
?>

<h2>Welcome to the Document Management System</h2>
<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
    <p>Welcome back, <?= htmlspecialchars($_SESSION['username']); ?>! <a href="user.php">View your documents.</a></p>
<?php else: ?>
    <p>Please <a href="../public/login.php">log in</a> to manage documents.</p>
<?php endif; ?>

<?php include('../templates/footer.php'); ?>
