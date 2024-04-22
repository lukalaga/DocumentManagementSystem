<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

$doc_id = $_POST['doc_id'] ?? 0;
$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';

if (!empty($title) && !empty($content) && $doc_id > 0) {
    $stmt = $conn->prepare("UPDATE documents SET title = :title, content = :content WHERE id = :doc_id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':doc_id', $doc_id);
    $stmt->execute();

    $_SESSION['message'] = 'Document updated successfully';
} else {
    $_SESSION['error'] = 'All fields are required';
}

header("Location: ../public/admin.php");
exit();
?>