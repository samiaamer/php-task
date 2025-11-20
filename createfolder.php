<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$currentdir = isset($_GET['dir']) ? $_GET['dir'] : 'users/' . $username;

if (isset($_POST['createFolder'])) {
    // $base_dir = $currentdir . '/';
    // $user_dir = $base_dir . $_GET['createFolder'];
    $currentdir = rtrim($currentdir, '/');
    $user_dir = $currentdir . '/' . $_POST['createFolder'];
    echo "<script> alert ('$currentdir');</script>";

    if (!file_exists($user_dir)) {
        if (mkdir($user_dir, 0777, true)) {
            chmod($user_dir, 0777);
            echo "Folder Created!";
            echo "<script> alert ('Folder Created');</script>";
        } else {
            echo "Failed to create directory.";
        }
    } else
        echo "<script> alert ('error');</script>";
    header("Location: index.php?dir=" . urlencode($currentdir));
    exit();
}