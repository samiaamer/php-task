<?php
function createUserdir()
{
    $username = isset($_SESSION['user']) ? $_SESSION['user'] : null;

    $base_dir = 'users/';
    $user_dir = $base_dir . $username . '/';
    if (!is_dir($user_dir)) {
        if (mkdir($user_dir, 0777, true)) {
            chmod($user_dir, 0777);
            header('Location: index.php');
            exit();
            return true;
        } else {
            echo "Failed to create directory: " . $user_dir;
            header('Location: index.php');
            exit();
            return false;
        }
    }
}