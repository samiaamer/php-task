<?php


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

    header("Location:index.php");
    exit();
}
