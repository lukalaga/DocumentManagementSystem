<?php 
include('../templates/header.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    $_SESSION['error'] = 'You must be logged in to access this page.';
    header('Location: login.php');
    exit;
}
?>

<div class="container mt-4">
    <h2>Add New Document</h2>
    <form action="../actions/addDocument.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="attachment">Attachment:</label>
            <input type="file" class="form-control-file" id="attachment" name="attachment">
        </div>
        <button type="submit" class="btn btn-primary">Add Document</button>
    </form>
</div>

<?php
include('../templates/footer.php');
?>
