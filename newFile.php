<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadTo = '/var/www/192.168.1.93/php-task/users/' . $user;
    $fileName = $_FILES['uploadedFile']['name'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileError = $_FILES['uploadedFile']['error'];
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];

    if ($fileError == UPLOAD_ERR_OK) {
        $destPath = $uploadTo . $fileName;
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            echo "File uploaded successfully!<br>";
        } 
        echo $uploadTo;
    }
}
