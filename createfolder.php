<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : null;


if (isset($_POST['createFolder'])) {
    $base_dir = 'users/' . $username . '/';
    $user_dir = $base_dir . $_POST['createFolder'];
    if (!file_exists($user_dir)) {
        if (mkdir($user_dir, 0777, true)) {
            echo "Folder Created!";
        } else {
            echo "Failed to create directory.";
        }
    }
    header('Location: index.php');
    exit();
}
