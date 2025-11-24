<?php
//  session_start();
// $username = isset($_SESSION['user']) ? $_SESSION['user'] : null;
// $currentdir = rtrim($_POST['currentdir'], '/');


// if (isset($_FILES['uploadedFile'])) {

//     $fileName = $_FILES['uploadedFile']['name'];
//     $fileType = $_FILES['uploadedFile']['type'];
//     $fileSize = $_FILES['uploadedFile']['size'];
//     $fileError = $_FILES['uploadedFile']['error'];
//     $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];

//     if ($fileError == UPLOAD_ERR_OK) {
//         $dest = $currentdir . '/' . $fileName;

//         if (move_uploaded_file($fileTmpPath, $dest)) {

//             header("Location: index.php?dir=" . urlencode($currentdir));
//             exit();
//         }
//     }
//     echo "error uploading file<br>";
//     exit();
// }

// // if (isset($_POST['createFolder'])) {
// //     $folderName = trim($_POST['createFolder']);

// //     if ($folderName === "") {
// //         exit("Folder name can't be empty");
// //     }

// //     $folder = $currentdir . '/' . $folderName;

// //     if (!file_exists($folder)) {
// //         if (mkdir($folder, 0777, true)) {
// //             header("Location: index.php?dir=" . urlencode($currentdir));
// //             exit();
// //         } else {
// //             exit("Failed to create directory.");
// //         }
// //     } else {
// //         exit("Folder already exists.");
// //     }
// // }

// if (isset($_GET['filetodelete'])) {
//     $file = urldecode($_GET['filetodelete']);

//     if (file_exists($file)) {
//         if (is_dir($file)) {
//             if (deleteDir($file))
//                 echo "Folder deleted successfully";
//             else
//                 echo "Folder couldnt be deleted";
//             exit();
//         }
//         if (unlink($file)) {
//             echo "The file $file has been deleted.";
//         } else {
//             echo "The file $file could not be deleted.";
//         }
//     } else {
//         echo "The file $file does not exist.";
//     }
//     exit();
// }

// function deleteDir($dir)
// {
//     $files = array_diff(scandir($dir), ['.', '..']);
//     foreach ($files as $file) {
//         $path = "$dir/$file";
//         is_dir($path) ? deleteDir($path) : unlink($path);
//     }
//     return rmdir($dir);
// }



// function createUserdir()
// {
//     $username = isset($_SESSION['user']) ? $_SESSION['user'] : null;

//     $base_dir = 'users/';
//     $user_dir = $base_dir . $username . '/';
//     if (!is_dir($user_dir)) {
//         if (mkdir($user_dir, 0777, true)) {
//             chmod ($user_dir, 0777);
//             header('Location: index.php');
//             exit();
//             return true;
//         } else {
//             echo "Failed to create directory: " . $user_dir;
//             header('Location: index.php');
//             exit();
//             return false;
//         }
//     }
// }



// function displaytable($dir)
// {
//     $items = [];
//     foreach (scandir($dir) as $item) {
//         if ($item == '.' || $item == '..') {
//             continue;
//         }
//         $path = $dir . '/' . $item;
//         $items[] = $path;
//     }
//     return $items;
// }

// function printingtable()
// {
//     $username = isset($_SESSION['user']) ? $_SESSION['user'] : null;
//     $currentdir = isset($_GET['dir']) ? $_GET['dir'] : 'users/' . $username;

//     $allFiles = displaytable($currentdir);
//     foreach ($allFiles as $file) {
//         $fileName = basename($file);
//         if (is_dir($file)) {
//             $filelink = 'index.php?dir=' . urlencode($file);
//             $fileType = "Directory";
//         } else {
//             $filelink = htmlspecialchars($file, ENT_QUOTES, 'UTF-8');

//             $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
//             switch ($fileType) {
//                 case 'txt':
//                     $fileType = 'Text File';
//                     break;
//                 case 'png':
//                     $fileType = 'Image / PNG';
//                     break;
//                 case 'jpg':
//                     $fileType = 'Image / JPG';
//                     break;
//                 case 'svg':
//                     $fileType = 'Image3 / SVG';
//                     break;
//                 case 'gif':
//                     $fileType = 'Image / GIF';
//                     break;
//                 case 'ico':
//                     $fileType = 'Icon';
//                     break;
//                 case 'html':
//                     $fileType = 'HTML File';
//                     break;
//                 case 'php':
//                     $fileType = 'PHP File';
//                     break;
//                 case 'css':
//                     $fileType = 'CSS File';
//                     break;
//                 case 'js':
//                     $fileType = 'JavaScript File';
//                     break;
//                 case 'pdf':
//                     $fileType = 'PDF File';
//                     break;
//                 case 'zip':
//                     $fileType = 'ZIP Archive';
//                     break;
//             }
//         }
//         $fileDate = date('j / m / Y g:i A', filemtime($file));
//         print("
//                     <tr>
//                         <td><a href = '$filelink' >$fileName</td>
//                         <td>$fileType</td>
//                         <td>$fileDate</td>
                        
//                         <td><button class='btn btn-danger'><a href='helpers.php?filetodelete=" . urlencode($file) . "' class='text-light'>Delete</a></button>
//                         </td>
//                     </tr>");
//     }
// }
