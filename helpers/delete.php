<?php
session_start();

if (!isset($_SESSION['user'])) {
    exit("Not allowed.");
}

$username = $_SESSION['user'];

// Base folder for this user
$baseDir = realpath(__DIR__ . "/users/$username");

// Requested folder location
$currentdir = isset($_GET['dir']) ? realpath($_GET['dir']) : $baseDir;

// Validate current directory
if ($currentdir === false || strpos($currentdir, $baseDir) !== 0) {
    exit("Invalid directory.");
}

// Handle deletion
if (isset($_GET['filetodelete'])) {

    // Resolve the actual file path
    $file = realpath($_GET['filetodelete']);

    // Check path is valid AND inside user folder
    if ($file === false || strpos($file, $baseDir) !== 0) {
        exit("Invalid path.");
    }

    // Does file exist?
    if (!file_exists($file)) {
        exit("The file does not exist.");
    }

    // Delete folder
    if (is_dir($file)) {
        if (deleteDir($file)) {
            exit("Folder deleted successfully");
        } else {
            exit("Folder could not be deleted");
        }
    }

    // Delete file
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
