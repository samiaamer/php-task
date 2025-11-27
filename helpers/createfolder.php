<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : null;

$currentdir = rtrim($_POST['currentdir'], '/');
$folderName = trim($_POST['createFolder']);

if ($folderName === "") {
    exit("Folder name can't be empty");
}

$folder = $currentdir . '/' . $folderName;

if (!file_exists($folder)) {
    if (mkdir($folder, 0777, true)) {
        chmod($folder, 0777);
        header("Location: ../index.php?dir=" . urlencode($currentdir));
        exit();
    } else {
        exit("Failed to create directory.");
    }
} else {
    exit("Folder already exists.");
}