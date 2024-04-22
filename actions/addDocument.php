<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';
$user_id = $_SESSION['user_id'] ?? 0;
$file = $_FILES['attachment'] ?? null;

if (!empty($title) && !empty($content)) {
    $conn->beginTransaction();
    try {
        $stmt = $conn->prepare("INSERT INTO documents (user_id, title, content) VALUES (:user_id, :title, :content)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->execute();
        $document_id = $conn->lastInsertId();

        if ($file && $file['error'] == 0) {
            $upload_dir = '../uploads/';
            $filename = $document_id . '_' . basename($file['name']);
            $upload_path = $upload_dir . $filename;

            if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                $stmt = $conn->prepare("UPDATE documents SET attachment_path = :attachment_path WHERE id = :document_id");
                $stmt->bindParam(':attachment_path', $upload_path);
                $stmt->bindParam(':document_id', $document_id);
                $stmt->execute();
            } else {
                throw new Exception('Failed to move uploaded file.');
            }
        }

        $conn->commit();
        $_SESSION['message'] = 'Document added successfully';
    } catch (Exception $e) {
        $conn->rollBack();
        $_SESSION['error'] = 'Failed to add document: ' . $e->getMessage();
    }
} else {
    $_SESSION['error'] = 'Both title and content are required';
}

header("Location: ../public/user.php");
exit();
?>