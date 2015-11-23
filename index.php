<?php
session_start();

$userlang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
if(isset($_POST['lang'])) {
    $_SESSION['lang'] = $_POST['lang'];
} else {
    if(!isset($_SESSION['lang'])) {
        switch($userlang) {
        case "pt":
            $_SESSION['lang'] = "pt_BR";
            break;
        default:
            $_SESSION['lang'] = 'en_US';
            break;
        }
    }
}

if(isset($_GET['page'])) {
    if(file_exists($_SESSION['lang'].'/'.$_GET['page'].'.php')) {
        if($_GET['page'] == "downloads") {
            require_once($_SESSION['lang']."/config.php");
            require_once("cute-php-explorer/init.php");
        }
        $page = $_SESSION['lang'].'/'.$_GET['page'];
    } else {
        header("HTTP/1.0 404 Not Found");
        $page = $_SESSION['lang']."/404";
    }
} else {
    $page = $_SESSION['lang'].'/home';
}
?>

<!DOCTYPE html>
<html lang="en_US">
<head>
    <?php if($page == $_SESSION['lang']."/downloads") { include_once("cute-php-explorer/head.php"); } ?>
    <title>lara.click - HOME</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
    <link href="style.css" rel="stylesheet">
    <link href="data:image/x-icon;base64,AAABAAEAEBAQAAAAAAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAACESfcAnCv8ANOf/wC8cP8A////AOC5/wDJ//8A8Nn/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAREREREREREREREQzQzMEREREQ3ISUmBEREQ3IFVyMEREQ3IDMwMwREQzMCcnIARERDQCd3J3UERDRAJydzIgREREA3cnI2BEREQDVzMzMERERAUHNmMEREREBQU2YwREREQGUDMwRERERAIgNjBEREREQAQABERERERERERERET//wAA/IcAAPgDAADwAwAA4AMAAMAHAADQAwAAsAMAAPADAADwAwAA8AcAAPAHAADwDwAA8A8AAPkfAAD//wAA" rel="icon" type="image/x-icon" />
</head>

<body>
<?php include_once($_SESSION['lang']."/menu.php"); ?>
<div class="loadingAnim">
<div class="contents">
<?php include_once($page . ".php") ?>
</div>
<footer>
<?php include_once($_SESSION['lang']."/footer.php"); ?>
</footer>
</div>
</body>
</html>
