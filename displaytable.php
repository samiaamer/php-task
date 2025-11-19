<?php
session_start();

function displaytable()
{
    $username = isset($_SESSION['user']) ? $_SESSION['user'] : null;

    $directory = opendir('users/' . $username . '/');

    while (($file = readdir(($directory))) !== false) {
        if ($file != '.' && $file != '..') {
            $dirarray[] = $file;
        }
    }
    $fileCount = count($dirarray);
    closedir($directory);

    for ($i = 0; $i < $fileCount; $i++) {
        $fileName = $dirarray[$i];
        $filelink = 'users/' .  $username . '/' . $fileName;

        $fileType = pathinfo($dirarray[$i], PATHINFO_EXTENSION);
        switch ($fileType) {
            case 'txt':
                $fileType = 'Text File';
                break;
            case 'png':
                $fileType = 'Image / PNG';
                break;
            case 'jpg':
                $fileType = 'Image / JPG';
                break;
            case 'svg':
                $fileType = 'Image3 / SVG';
                break;
            case 'gif':
                $fileType = 'Image / GIF';
                break;
            case 'ico':
                $fileType = 'Icon';
                break;
            case 'html':
                $fileType = 'HTML File';
                break;
            case 'php':
                $fileType = 'PHP File';
                break;
            case 'css':
                $fileType = 'CSS File';
                break;
            case 'js':
                $fileType = 'JavaScript File';
                break;
            case 'pdf':
                $fileType = 'PDF File';
                break;
            case 'zip':
                $fileType = 'ZIP Archive';
                break;
        }
        $fileDate = date('j / m / Y g:i A' . filemtime($fileName));
        if ($fileType == null) {
            $fileType = "Directory";
        }
        print("
                    <tr>
                        <td><a href='./$filelink' class='text-dark'>$fileName </a></td>
                        <td>$fileType </td>
                        <td>$fileDate</td>
                        
                        <td><button class='btn btn-danger'><a href='delete.php?filetodelete=" . $filelink . "' class='text-light'>Delete</a></button></td>
                    </tr>");
    }
}
