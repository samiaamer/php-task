<?php


if (isset($_GET['filetodelete'])) {
    $name = $_GET['filetodelete'];
    displaytable($name, $path);
    exit();
}