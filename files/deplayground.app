<?php
$app = new AppFromTemplate('DEPlayground', 'icons/deplayground.png');
$window = $app->get_window();

if(!isset($_GET['post'])) {
    $window->add_raw("<div class='post'>");
    $window->add_raw("<h1>RaspberryPi<img alt='RaspberryPi' src='raspberrypi/media/raspberrypi.gif' width=100/></h1>\n");
    $window->add_raw("<h3>Você não sabe o que é um RaspberryPi?</h3>\n");
    $window->add_raw('<div style="padding:25%;position:relative;"><iframe src="https://player.vimeo.com/video/90103691?title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>');
}

$app->footer();
$window->show_all();
