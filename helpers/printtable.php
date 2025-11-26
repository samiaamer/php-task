<?php
function displaytable($dir)
{
    $items = [];
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') continue;
        $items[] = $dir . '/' . $item;
    }
    return $items;
}

function printingtable()
{
    $username = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    $baseDir = realpath(__DIR__ . '/users/' . $username);
    $currentdir = isset($_GET['dir']) ? realpath($_GET['dir']) : $baseDir;

    if ($currentdir === false || strpos($currentdir, $baseDir) !== 0) {
        $currentdir = $baseDir;
    }

    $allFiles = displaytable($currentdir);

    foreach ($allFiles as $file) {
        $fileName = basename($file);
        $filePath = str_replace('\\', '/', realpath($file));

        if (is_dir($file)) {
            $filelink = 'index.php?dir=' . urlencode($filePath);
            $fileType = "Directory";
        } else {
            $filelink = htmlspecialchars($filePath, ENT_QUOTES, 'UTF-8');
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $fileTypeMap = [
                'txt' => 'Text File', 'png' => 'Image / PNG', 'jpg' => 'Image / JPG',
                'svg' => 'Image / SVG', 'gif' => 'Image / GIF', 'ico' => 'Icon',
                'html' => 'HTML File', 'php' => 'PHP File', 'css' => 'CSS File',
                'js' => 'JavaScript File', 'pdf' => 'PDF File', 'zip' => 'ZIP Archive'
            ];
            $fileType = $fileTypeMap[$ext] ?? strtoupper($ext) . ' File';
        }

        $fileDate = date('j / m / Y g:i A', filemtime($file));

        print("
            <tr>
                <td><a href='$filelink'>$fileName</a></td>
                <td>$fileType</td>
                <td>$fileDate</td>
                <td>
                    <button class='btn btn-danger' onclick=\"deleteFile('$filePath', this)\">Delete</button>
                </td>
            </tr>
        ");
    }
}
?>
<script>
function deleteFile(filePath, btn) {
    if(!confirm('Are you sure you want to delete this file/folder?')) return;

    fetch('delete.php?filetodelete=' + encodeURIComponent(filePath))
        .then(res => res.text())
        .then(msg => {
            alert(msg); // optional: replace with a nicer notification
            btn.closest('tr').remove(); // remove the row instantly
        })
        .catch(err => alert('Error: ' + err));
}
</script>
