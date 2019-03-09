<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once("src/common.php");
require_once("config.php");

if(should_set('lang')) {
    $userlang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

    switch($userlang) {
        case "pt":
            $_SESSION['lang'] = "pt_BR";
            break;
        default:
            $_SESSION['lang'] = 'en_US';
            break;
        }
}

if(should_set('mobile')) {
    $_SESSION['mobile'] = "on";
}

if(should_set('overlay')) {
    if(!isset($_SESSION['mobile']) || $_SESSION['mobile'] == 'off') {
        $_SESSION['overlay'] = "on";
    } else {
        $_SESSION['overlay'] = "off";
    }
}


$language_domain = "laraclick";
setlocale(LC_ALL, $_SESSION['lang'] . '.utf8');
//putenv('LANGUAGE=' . $_SESSION['lang']);
bindtextdomain($language_domain, dirname(__FILE__) . "/locale");
//bind_textdomain_codeset($language_domain, "UTF-8");
textdomain($language_domain);

if(isset($_GET['program'])) {
    $_CONFIG['files_dir'] = str_replace('.app', '', $_GET['program']) . '/' . $_SESSION['lang'];
    $_SESSION['theme'] = 'minimal2';
} else {
    $_CONFIG['icon_size'] = '64';
    $_SESSION['theme'] = 'minimal';
}

require_once("cute-php-explorer/init.php");

if(isset($_GET['page']) && !isset($_GET['program'])) {
    if(file_exists('src/' . $_GET['page'].'.php')) {
        $page = 'src/' . $_GET['page'];
    } else {
        header("HTTP/1.0 404 Not Found");
        $page = 'src/404';
    }
} else {
    $page = 'src/home';
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
    <link href="data:image/x-icon;base64,AAABAAEAEBAQAAAAAAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAACESfcAnCv8ANOf/wC8cP8A////AOC5/wDJ//8A8Nn/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAREREREREREREREQzQzMEREREQ3ISUmBEREQ3IFVyMEREQ3IDMwMwREQzMCcnIARERDQCd3J3UERDRAJydzIgREREA3cnI2BEREQDVzMzMERERAUHNmMEREREBQU2YwREREQGUDMwRERERAIgNjBEREREQAQABERERERERERERET//wAA/IcAAPgDAADwAwAA4AMAAMAHAADQAwAAsAMAAPADAADwAwAA8AcAAPAHAADwDwAA8A8AAPkfAAD//wAA" rel="icon" type="image/x-icon" />

<?php
$scripts_folder = opendir('scripts');
while(false !== ($current_file = readdir($scripts_folder))) {
    if(substr($current_file, 0, 1) != '.') {
        print("<script src='scripts/" . $current_file . "'></script>\n");
    }
}
closedir($scripts_folder);

$styles_folder = opendir('styles');
while(false !== ($current_file = readdir($styles_folder))) {
    if(substr($current_file, 0, 1) != '.') {
        print("<link href='styles/" . $current_file . "' rel='stylesheet'/>\n");
    }
}
closedir($styles_folder);

print("</head>\n");

if($_SESSION['overlay'] == 'on') {
    print("<body>\n");
    print("<div class='tablet'>\n");
    include_once('src/menu.php');
    if(!isset($_GET['program']) && !isset($_GET['page'])) {
        print("<div class='desktop'>\n");
    }
} else {
    print("<body style='margin: 0; overflow: auto;'>\n");
    print("<div class='notablet'>\n");
    include_once('src/menu.php');
    if(!isset($_GET['program']) && !isset($_GET['page'])) {
        print("<div class='nodesktop'>\n");
    }
}

include_once($page . '.php');

print("</div>\n");

if(!isset($_GET['program']) && !isset($_GET['page'])) {
    print("</div>\n");
}

if($_SESSION['overlay'] == 'off') {
    print("<footer>\n");
    include_once('src/footer.php');
    print("</footer>\n");
}

print("</body></html>\n");