<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$currentdir = isset($_GET['dir']) ? $_GET['dir'] : 'users/' . $username;

if (isset($_FILES['uploadedFile'])) {

    $fileName = $_FILES['uploadedFile']['name'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileError = $_FILES['uploadedFile']['error'];
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];

    if ($fileError == UPLOAD_ERR_OK) {
        $currentdir = rtrim($currentdir, '/');
        $destPath = $currentdir . '/' . $fileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {

            header("Location: index.php?dir=" . urlencode($currentdir));
            exit();
        }
    }
    echo "error uploading file<br>";
    exit();
}