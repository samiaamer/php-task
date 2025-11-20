<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$currentdir = isset($_GET['dir']) ? $_GET['dir'] : 'users/' . $username;

if (isset($_GET['filetodelete'])) {
    $name = $_GET['filetodelete'];

    if (file_exists($name)) {
        if (unlink($name)) {
            echo "The file $name has been deleted.";
        } else {
            echo "Error: The file $name could not be deleted.";
        }
    } else {
        echo "Error: The file $name does not exist.";
    }

    header("Location: index.php?dir=" . $currentdir);
    exit();
}
