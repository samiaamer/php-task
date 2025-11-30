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
    $projectRoot = "/php-task/";

    if ($currentdir === false || strpos($currentdir, $baseDir) !== 0) {
        $currentdir = $baseDir;
    }

    $allFiles = displaytable($currentdir);

    foreach ($allFiles as $file) {
        $fileName = basename($file);
        $filePath = str_replace('\\', '/', realpath($file));
        $relative = strstr($filePath, 'users');
        $fileDate = date('j / m / Y g:i A', filemtime($file));
        if (is_dir($file)) {
            $filelink = "index.php?dir=" . urlencode($filePath);
            $fileType = "Directory";

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
        } else {
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $publicPath =  $relative;

            if (in_array($ext, ['png', 'jpg', 'jpeg', 'gif', 'svg'])) {
                $fileType = strtoupper($ext) . " / Image";

                print("               
                <tr>
                    <td><a href='#' onclick=\"openImage('$publicPath'); return false;\">$fileName</a></td>
                    <td>$fileType</td>
                     <td>$fileDate</td>
                    <td>
                        <button class='btn btn-danger' onclick=\"deleteFile('$filePath', this)\">Delete</button>
                    </td>
                </tr>
                ");
            } else {
                $fileType = strtoupper($ext) . " File";

                print("
                <tr>
                    <td><a href='$publicPath' target='_blank'>$fileName</a></td>
                    <td>$fileType</td>
                    <td>$fileDate</td>
                    <td>
                        <button class='btn btn-danger' onclick=\"deleteFile('$filePath', this)\">Delete</button>
                    </td>
                </tr>
                ");
            }
        }
    }
}
?><script>
    function deleteFile(filePath, btn) {
        if (!confirm('Are you sure you want to delete this file/folder?')) return;
        fetch('helpers/delete.php?filetodelete=' + encodeURIComponent(filePath))
            .then(res => res.text())
            .then(msg => {
                btn.closest('tr').remove();
            })
            .catch(err => alert('Error: ' + err));
    }
</script>