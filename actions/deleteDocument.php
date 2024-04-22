<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error'] = 'Access denied!';
    header('Location: ../public/index.php');
    exit();
}

require '../config/db.php';

// Ensure doc_id is provided and is a valid integer
$doc_id = $_GET['doc_id'] ?? null;
if (!is_numeric($doc_id)) {
    $_SESSION['error'] = 'Invalid document ID';
    header('Location: ../public/admin.php');
    exit();
}

// Prepare and execute the delete query
$stmt = $conn->prepare("DELETE FROM documents WHERE id = :id");
$stmt->bindParam(':id', $doc_id);
$stmt->execute();

$_SESSION['message'] = 'Document deleted successfully';
header('Location: ../public/admin.php');
exit();
?>
