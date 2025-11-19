<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if (isset($_POST['uploadedFile'])) {

    $uploadTo = 'users/' . $username . '/';
    $fileName = $_FILES['uploadedFile']['name'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileError = $_FILES['uploadedFile']['error'];
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];

    if ($fileError == UPLOAD_ERR_OK) {
        $destPath = $uploadTo . $fileName;
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            header('Location: index.php');
            exit();
        }
        header('Location: index.php');
        echo "error uploading file<br>";
        exit();
    }
}
