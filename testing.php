<?php
session_start();

function displaytable()
{
    $username = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    $startDir = 'users/' . $username;
    if (!file_exists($startDir) || !is_dir($startDir)) {
        echo "Directory not found: $startDir";
    } else {
        echo '<p>Directory Hierarchy of: ' . htmlspecialchars($startDir) . '</p>';
        listFolder($startDir);
    }
}

function listFolder($dir)
{

    $ffs = array_diff(scandir($dir), array('.', '..'));

    $fileType = pathinfo($dir, PATHINFO_EXTENSION);

    // $fileDate = date('j / m / Y g:i A' . filemtime($fileName));
    foreach ($ffs as $ff){
        $fullPath = $dir . DIRECTORY_SEPARATOR . $ff;
            echo ' <tr>';
            if (is_dir($fullPath)) {

                print("
                        <td><a href='' class='text-dark'>$fullPath </a></td>
                        
                        <br>
                   ");
                displaytable();
            }
        
    }
    echo ' <tr>';
}

displaytable();
