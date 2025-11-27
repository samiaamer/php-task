<?php
session_start();

if (!isset($_SESSION['user'])) {
    exit("Not allowed.");
}

$username = $_SESSION['user'];

$baseDir = realpath(__DIR__ . "/users/$username");

$currentdir = isset($_GET['dir']) ? realpath($_GET['dir']) : $baseDir;

if (strpos($currentdir, $baseDir) !== 0) {
    exit("Invalid directory.");
}

if (isset($_GET['filetodelete'])) {

    $file = realpath($_GET['filetodelete']);

    if ($file === false || strpos($file, $baseDir) !== 0) {
        exit("Invalid path.");
    }
    if (!file_exists($file)) {
        exit("The file does not exist.");
    }
    if (is_dir($file)) {
        if (deleteDir($file)) {
            exit("Folder deleted successfully");
        } else {
            exit("Folder could not be deleted");
        }
    }
    if (unlink($file)) {
        exit("File deleted successfully");
    } else {
        exit("Could not delete the file.");
    }
}

function deleteDir($dir)
{
    $files = array_diff(scandir($dir), ['.', '..']);

    foreach ($files as $file) {
        $path = $dir . '/' . $file;
        is_dir($path) ? deleteDir($path) : unlink($path);
    }
    return rmdir($dir);
}
