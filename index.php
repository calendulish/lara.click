<?php
require_once("config.php");
require_once("cute-php-explorer/init.php");

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userlang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

if(isset($_POST['lang'])) {
    $_SESSION['lang'] = $_POST['lang'];
} else {
    if(isset($_GET['lang'])) {
        $_SESSION['lang'] = $_GET['lang'];
    } elseif(!isset($_SESSION['lang'])) {
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

$language_domain = "laraclick";
setlocale(LC_ALL, $_SESSION['lang'] . '.utf8');
//putenv('LANGUAGE=' . $_SESSION['lang']);
bindtextdomain($language_domain, dirname(__FILE__) . "/locale");
//bind_textdomain_codeset($language_domain, "UTF-8");
textdomain($language_domain);

if(isset($_GET['page'])) {
    if(file_exists($_GET['page'].'.php')) {
        $page = $_GET['page'];
    } else {
        header("HTTP/1.0 404 Not Found");
        $page = "404";
    }
} else {
    $page = 'home';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>lara.click - HOME</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <?php include_once("cute-php-explorer/head.php") ?>
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
    <link href="style.css" rel="stylesheet">
    <link href="data:image/x-icon;base64,AAABAAEAEBAQAAAAAAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAACESfcAnCv8ANOf/wC8cP8A////AOC5/wDJ//8A8Nn/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAREREREREREREREQzQzMEREREQ3ISUmBEREQ3IFVyMEREQ3IDMwMwREQzMCcnIARERDQCd3J3UERDRAJydzIgREREA3cnI2BEREQDVzMzMERERAUHNmMEREREBQU2YwREREQGUDMwRERERAIgNjBEREREQAQABERERERERERERET//wAA/IcAAPgDAADwAwAA4AMAAMAHAADQAwAAsAMAAPADAADwAwAA8AcAAPAHAADwDwAA8A8AAPkfAAD//wAA" rel="icon" type="image/x-icon" />
    <script src="scripts/analytics.js"></script>
    <script src="scripts/mobile_resize.js"></script>
</head>

<body>
<?php include_once("menu.php"); ?>
<div id="animation" class="contents">
<?php include_once($page . ".php") ?>
</div>
<footer>
<?php include_once("footer.php") ?>
</footer>
</body>
</html>
