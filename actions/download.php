<?php
include('../templates/header.php');

$filePath = urldecode($_GET['file'] ?? '');

// Validate the file path to prevent directory traversal attacks
if (!empty($filePath) && file_exists($filePath) && is_readable($filePath)) {
    // Ensure that the file is within the designated uploads directory to prevent unauthorized access
    $uploadsDir = realpath('../uploads/');
    if (strpos(realpath($filePath), $uploadsDir) === 0) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush(); // Flush system output buffer
        readfile($filePath);
        exit;
    }
}

$_SESSION['error'] = 'File not found or access denied';
header('Location: ../public/user.php');
exit();
?>