<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : null;

include 'helpers/createUserDir.php';
include 'printtable.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$baseDir = realpath(__DIR__ . "/users/$username");

if (!isset($_GET['dir'])) {
    $currentdir = $baseDir;
} else {
    $requested = realpath($_GET['dir']);
    if ($requested === false || strpos($requested, $baseDir) !== 0) {
        $currentdir = $baseDir;
    } else {
        $currentdir = $requested;
    }
}

createUserdir();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>

<body style="background-color: aliceblue;">
    <nav
        class="navbar navbar-expand-lg p-4 navbar-fixed-top "
        style="z-index: 2000; position: sticky; top: 0; background-color: #646464ff; color:white;">
        <div class="container">
            <div class="navbar-brand" style=" color:white; font-weight: bold; font-size: x-large;">File Management System</div>

            <a href="logout.php" style="color:white; margin:auto;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                </svg>
                Log out
            </a>

            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>
                <?php echo $_SESSION['user']; ?>
            </span>

        </div>
    </nav>
    <div style="background-color:white;height: 15vh">
        <div
            class="container">
            <div class="row pt-3">
                <h1 class="col-md-8">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" fill="currentColor" class="bi bi-folder2" viewBox="0 0 16 16">
                        <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v7a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 12.5zM2.5 3a.5.5 0 0 0-.5.5V6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3zM14 7H2v5.5a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5z" />
                    </svg>
                    File Manager
                </h1>
                <div class="col-md-4">
                    <form action="helpers/uploadfile.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="currentdir" value="<?= htmlspecialchars($currentdir) ?>">
                        <label for="fileUpload">Choose a file to upload:</label>
                        <input type="file" name="uploadedFile" id="fileUpload">
                        <button type="submit" name="uploadedFile">Upload</button>
                    </form>
                    <form action="helpers/createfolder.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="currentdir" value="<?= htmlspecialchars($currentdir) ?>">
                        <input type="text" name="createFolder" id="createFolder">
                        <input class="btn btn-primary btn-lg m-2" type="submit" value="Create Folder">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="table-responsive">
            <?php
            $parent = dirname($currentdir);
            ?>
            <div class="container mt-3">
                <?php if ($currentdir !== $baseDir): ?>
                    <a class="btn btn-secondary mb-3" href="index.php?dir=<?= urlencode($parent) ?>">⬅ Back</a>
                <?php endif; ?>
            </div>
            <?php
            $relativePath = str_replace($baseDir, '', $currentdir);
            $parts = array_filter(explode('/', $relativePath));
            $pathAccum = $baseDir;
            ?>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?dir=<?= urlencode($baseDir) ?>">Home</a></li>
                    <?php foreach ($parts as $part):
                        $pathAccum .= '/' . $part; ?>
                        <li class="breadcrumb-item">
                            <a href="index.php?dir=<?= urlencode($pathAccum) ?>"><?= htmlspecialchars($part) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </nav>

            <table class="table table-hover table-striped ">
                <thead>
                    <th>Title/Name</th>
                    <th>File Type</th>
                    <th>Date Added</th>
                    <th>Manage</th>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    printingtable();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer>
        <div class="text-center" style="background-color: #646464ff; color:white;">
            Created at trainging with Sprintive.
        </div>
    </footer>
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <img id="openImage" src="" class="ing-fluid w-100">
                </div>
            </div>
        </div>
    </div>
    <script>
        function openImage(src) {
            document.getElementById('openImage').src = src;
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();
        }


        // document.addEventListener('DOMcontentLoaded', function() {
        //     const fileInput = document.getElementById('fileUpload');
        //     const uploadButton = document.getElementById('uploadedFile');
        //     uploadButton.disabled = true;

        //     fileInput.addEventListener('change', function() {
        //         if (fileInput.value) {
        //             button.removeAttribute('disabled');
        //         }
        //         else
        //             uploadButton.disabled = true;
        //     })
        // });
    </script>
</body>

</html>