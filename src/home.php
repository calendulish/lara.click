<?php
if(isset($_GET['program'])) {
    if(file_exists('files/' . $_GET['program'])) {
        include_once("files/" . $_GET['program']);
    } else {
        header("HTTP/1.0 404 Not Found");
        include_once('src/404.php');
    }
} else {
    include_once("cute-php-explorer/explorer.php");
}