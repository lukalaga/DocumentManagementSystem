<?php 
include('../templates/header.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error'] = 'Access denied!';
    header('Location: index.php');
    exit();
}

require '../config/db.php';

$stmt = $conn->prepare("SELECT documents.*, users.username FROM documents JOIN users ON documents.user_id = users.id");
$stmt->execute();
$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
    <h2>Admin Dashboard</h2>
    <p>Here you can manage all documents.</p>

    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Actions</th>
                <th>Document</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($documents as $document): ?>
            <tr>
                <td><?= htmlspecialchars($document['title']) ?></td>
                <td><?= htmlspecialchars($document['username']) ?></td>
                <td>
                    <a href="edit_document.php?id=<?= $document['id'] ?>" class="btn btn-sm btn-info">Edit</a>
                    <a href="../actions/deleteDocument.php?doc_id=<?= $document['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this document?');">Delete</a>
                </td>
                <td>
                    <?php if (!empty($document['attachment_path'])): ?>
                        <?= htmlspecialchars(basename($document['attachment_path'])) ?>
                        <a href="../actions/download.php?file=<?= urlencode($document['attachment_path']) ?>" class="btn btn-sm btn-success">Download</a>
                    <?php else: ?>
                        N/A
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('../templates/footer.php'); ?>
