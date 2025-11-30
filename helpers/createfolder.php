<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : null;

$currentdir = rtrim($_POST['currentdir'], '/');
$folderName = trim($_POST['createFolder']);

if ($folderName === "") {
    header("Location: ../index.php?dir=" . urlencode($currentdir));
    exit();
}

$folder = $currentdir . '/' . $folderName;

if (!file_exists($folder)) {
    if (mkdir($folder, 0777, true)) {
        chmod($folder, 0777);
        header("Location: ../index.php?dir=" . urlencode($currentdir));
        exit();
    } else {
        header("Location: ../index.php?dir=" . urlencode($currentdir));
        exit();
    }
} else {
    header("Location: ../index.php?dir=" . urlencode($currentdir));
    exit();
}
