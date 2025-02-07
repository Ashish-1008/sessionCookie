<?php
$uploadDir = 'uploads/';

$allowedTypes = ['jpg', 'jpeg', 'png', 'txt'];
$maxFileSize = 2 * 1024 * 1024; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    print_r($_FILES['file']);

    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("File upload error: " . $file['error']);
    }

    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedTypes)) {
        die("Invalid file type.");
    }


    if ($file['size'] > $maxFileSize) {
        die("File too large. Max 2MB allowed.");
    }


    $safeFileName = uniqid('upload_', true) . '.' . $fileExtension;


    if (!move_uploaded_file($file['tmp_name'], $uploadDir . $safeFileName)) {
        die("Error moving uploaded file.");
    }

    echo "File uploaded successfully: " . htmlspecialchars($safeFileName);
} else {
    echo "No file uploaded.";
}
?>