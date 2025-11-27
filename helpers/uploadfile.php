<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$currentdir = rtrim($_POST['currentdir'], '/');


if (isset($_FILES['uploadedFile'])) {

    $fileName = $_FILES['uploadedFile']['name'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileError = $_FILES['uploadedFile']['error'];
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];

    if ($fileError == UPLOAD_ERR_OK) {
        $dest = $currentdir . '/' . $fileName;

        if (move_uploaded_file($fileTmpPath, $dest)) {

            header("Location: ../index.php?dir=" . urlencode($currentdir));
            exit();
        }
    }else
    
    echo "<script>alert ('error uploading file')</script>";
    // header("Location: ../index.php?dir=" . urlencode($currentdir));
    exit();
}
