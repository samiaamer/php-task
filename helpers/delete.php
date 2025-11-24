<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : null;
// $currentdir = isset($_POST['currentdir']) ? trim($_POST['currentdir'], '/') : $username;
$baseDir = __DIR__ . '/../users/' . $username;
$currentdir = isset($_POST['currentdir']) ? trim($_POST['currentdir'], '/') : '';
$absolutePath = $baseDir . '/' . $currentdir;

if (isset($_GET['filetodelete'])) {
    $file = urldecode($_GET['filetodelete']);

    if (file_exists($absolutePath)) {
        if (is_dir($absolutePath)) {
            if (deleteDir($absolutePath)) {
                echo "Folder deleted successfully";
                header("Location: ../index.php?dir=" . 'users/' . urlencode($currentdir));
            } else
                echo "Folder couldnt be deleted";
            exit();
        }
        if (unlink($absolutePath)) {
            echo "The file $absolutePath has been deleted.";
            header("Location: ../index.php?dir=" . 'users/' . urlencode($currentdir));
        } else {
            echo "The file $absolutePath could not be deleted.";
        }
    } else {
        echo "The file $absolutePath does not exist.";
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
