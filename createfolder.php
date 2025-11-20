<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$currentdir = isset($_GET['dir']) ? $_GET['dir'] : 'users/' . $username;

if (isset($_GET['createFolder'])) {
    $base_dir = $currentdir . '/';
    $user_dir = $base_dir . $_GET['createFolder'];
    if (!file_exists($user_dir)) {
        if (mkdir($user_dir, 0777, true)) {
            chmod($user_dir, 0777);
            echo "Folder Created!";
            // echo "<script> alert ('Folder Created');</script>";
        } else {
            echo "Failed to create directory.";
        }
    }
    // header('Location: index.php');
    exit();
}


// session_start();
// $username = isset($_SESSION['user']) ? $_SESSION['user'] : null;
// $currentdir = isset($_GET['dir']) ? $_GET['dir'] : 'users/' . $username;


// if (isset($_GET['createFolder'])) {
//     // $base_dir = 'users/' . $username . '/';
//     $user_dir = $currentdir . '/' .  $_GET['createFolder'];
//     echo "<script> alert ('user dir ->  $user_dir');</script>";

//     // if (!file_exists($user_dir)) {
//     //     echo "<script> alert ('file doesnt exists');</script>";

//     //     if (mkdir($user_dir, 0777, true)) {
//     //         chmod($user_dir, 0777);
//     //         echo "Folder Created";
//     //         header("Location: index.php?dir=" . urlencode($currentdir));
//     //         exit();
//     //     } else {
//     //         echo "Failed to create directory.";
//     //     }
//     // } else
//     //     echo "file already exists";

//     exit();
// }
