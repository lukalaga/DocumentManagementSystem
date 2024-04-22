<?php 
include('../templates/header.php');
require '../config/db.php';

$doc_id = $_GET['id'] ?? 0;  // Retrieve the ID, or set to 0 if not present
if ($doc_id > 0) {
    $stmt = $conn->prepare("SELECT * FROM documents WHERE id = :doc_id");
    $stmt->bindParam(':doc_id', $doc_id);
    $stmt->execute();
    $document = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$document) {
    echo "<div class='alert alert-warning'>Document not found.</div>";
} else {
?>

<div class="container mt-4">
    <h2>Edit Document</h2>
    <form action="../actions/editDocument.php" method="post">
        <input type="hidden" name="doc_id" value="<?= $document['id'] ?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($document['title']) ?>" required>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content" rows="5" required><?= htmlspecialchars($document['content']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Document</button>
    </form>
</div>

<?php 
}
include('../templates/footer.php');
?>
