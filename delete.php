<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$currentdir = isset($_GET['dir']) ? $_GET['dir'] : 'users/' . $username;

if (isset($_GET['filetodelete'])) {
    $file = urldecode($_GET['filetodelete']);

    if (file_exists($file)) {
        if (is_dir($file)) {
            if (deleteDir($file))
                echo "Folder deleted successfully";
            else
                echo "Folder couldnt be deleted";
            exit();
        }
        if (unlink($file)) {
            echo "The file $file has been deleted.";
        } else {
            echo "The file $file could not be deleted.";
        }
    } else {
        echo "The file $file does not exist.";
    }
    exit();
}

function deleteDir($dir)
{
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = "$dir/$file";
        is_dir($path) ? deleteDir($path) : unlink($path);
    }
    return rmdir($dir);
}
