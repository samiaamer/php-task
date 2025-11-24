<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : null;
// $baseDir = __DIR__;
$currentdir = isset($_POST['currentdir']) ? trim($_POST['currentdir'], '/') : '';
$absolutePath =  $currentdir;
// $currentdir = isset($_POST['currentdir']) ? trim($_POST['currentdir'], '/') : $username;


if (isset($_FILES['uploadedFile'])) {

    $fileName = $_FILES['uploadedFile']['name'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileError = $_FILES['uploadedFile']['error'];
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];

    if ($fileError == UPLOAD_ERR_OK) {
        $dest = $absolutePath . '/' . $fileName;

        if (move_uploaded_file($fileTmpPath, $dest)) {

            header("Location: ../index.php?dir=" . urlencode($currentdir));
            exit();
        }
    }
    echo "error uploading file<br>";
    exit();
}
