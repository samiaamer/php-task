<?php
function displaytable($dir)
{
    $items = [];
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        $path = $dir . '/' . $item;
        $items[] = $path;
    }
    return $items;
}

function printingtable()
{
    $username = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    $baseDir = 'users/' . $username;
    $currentdir = isset($_GET['dir']) ? trim($_GET['dir'], '/') : $baseDir;

    $allFiles = displaytable($currentdir);
    foreach ($allFiles as $file) {
        $fileName = basename($file);

        $fileRelative = ltrim(str_replace($baseDir, '', $file), '/');

        if (is_dir($file)) {
            $filelink = 'index.php?dir=' . urlencode($file);
            $fileType = "Directory";
        } else {
            $filelink = htmlspecialchars($file, ENT_QUOTES, 'UTF-8');

            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
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
        }
        $fileDate = date('j / m / Y g:i A', filemtime($file));
        print("
                    <tr>
                        <td><a href = '$filelink' >$fileName</td>
                        <td>$fileType</td>
                        <td>$fileDate</td>
                        
                        <td><button class='btn btn-danger'><a href='helpers/delete.php?filetodelete=" . urlencode($fileRelative) . "' class='text-light'>Delete</a></button>
                        </td>
                    </tr>");
    }
}
