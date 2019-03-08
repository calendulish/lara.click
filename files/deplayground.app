<?php
//require_once('comments.php');
require_once('src/gtk.php');

$deplayground = new Window();
$deplayground->set_title('DEPlayground');
$deplayground->set_icon('icons/deplayground.png');
$deplayground->set_expand(True);
$deplayground->set_minimize_button('update_query', [['program'], ['task'], ["deplayground.app"]]);
$deplayground->set_close_button('update_query', [['program', 'post']]);
$deplayground->add_raw("<div class='grid'>\n");

ob_start();
require_once('cute-php-explorer/explorer.php');
$sidebar = ob_get_contents();
ob_clean();

$deplayground->add_raw("<div class='sidebar'>");
$deplayground->add_raw("<div class='title'>Files</div>" . $sidebar . "</div>\n");

if(isset($_GET['post'])) {
    $content_file = 'deplayground/' . $_SESSION['lang'] . '/' . $_GET['post'];
    
    if(!file_exists($content_file)) {
        header('Location: ' . $CuteExplorer->make_query('program', $_GET['program'], ['post']));
        exit(1);
    }
    
    ob_start();
    require_once($content_file);
    $contents = ob_get_contents();
    ob_clean();
    
    $deplayground->add_raw("<div class='post'>" . $contents . "</div>\n");
} else {
    $deplayground->add_raw("<div class='post'>");
    $deplayground->add_raw("<h1>RaspberryPi<img alt='RaspberryPi' src='raspberrypi/media/raspberrypi.gif' width=100/></h1>\n");
    $deplayground->add_raw("<h3>Você não sabe o que é um RaspberryPi?</h3>\n");
    $deplayground->add_raw('<div style="padding:25%;position:relative;"><iframe src="https://player.vimeo.com/video/90103691?title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>');
}

$deplayground->add_raw("</div>\n");
$deplayground->show_all();
