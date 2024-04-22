<?php 
include('../templates/header.php');  // Ensure this path is correctly pointed to your header file
require '../config/db.php';

// Assuming session start and user check is in header.php, otherwise, add here
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM documents WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
    <h2>My Documents</h2>
    <p>Here you can view and manage your documents.</p>

    <a href="add_document.php" class="btn btn-primary mb-3">Add New Document</a>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Title</th>
                <th>Actions</th>
                <th>Download Document</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($documents as $document): ?>
            <tr>
                <td><?= htmlspecialchars($document['title']) ?></td>
                <td>
                    <a href="edit_document.php?id=<?= $document['id'] ?>" class="btn btn-info btn-sm">Edit</a>
                    <a href="../actions/deleteDocument.php?doc_id=<?= $document['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this document?');">Delete</a>
                </td>
                <td>
                    <?php if (!empty($document['attachment_path'])): ?>
                        <?= htmlspecialchars(basename($document['attachment_path'])) ?> <!-- Displaying the filename -->
                        <a href="../actions/download.php?file=<?= urlencode($document['attachment_path']) ?>" class="btn btn-success btn-sm">Download</a>
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