<?php
if(isset($_GET['page'])) {
    if(file_exists($_GET['page'] . ".php")) {
        $page = $_GET['page'];
    } else {
        header("HTTP/1.0 404 Not Found");
        $page = "404";
    }
} else {
    $page = "home";
}

if($page == "downloads") {
    require_once("config.php");
    require_once("cute-php-explorer/init.php");
}
?>

<!DOCTYPE html>
<html lang="en_US">
<head>
    <?php if($page == "downloads") { include_once("cute-php-explorer/head.php"); } ?>
    <title>lara.click - HOME</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
    <link href="style.css" rel="stylesheet">
    <link href="data:image/x-icon;base64,AAABAAEAEBAQAAAAAAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAACESfcAnCv8ANOf/wC8cP8A////AOC5/wDJ//8A8Nn/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAREREREREREREREQzQzMEREREQ3ISUmBEREQ3IFVyMEREQ3IDMwMwREQzMCcnIARERDQCd3J3UERDRAJydzIgREREA3cnI2BEREQDVzMzMERERAUHNmMEREREBQU2YwREREQGUDMwRERERAIgNjBEREREQAQABERERERERERERET//wAA/IcAAPgDAADwAwAA4AMAAMAHAADQAwAAsAMAAPADAADwAwAA8AcAAPAHAADwDwAA8A8AAPkfAAD//wAA" rel="icon" type="image/x-icon" />
</head>

<body>
<?php include_once("menu.php"); ?>
<div class="loadingAnim">
<div class="contents">
<?php include_once($page . ".php") ?>
</div>
<footer>
<?php include_once("footer.php"); ?>
</footer>
</div>
</body>
</html>
