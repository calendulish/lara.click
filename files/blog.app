<?php
$app = new AppFromTemplate('Blog', 'icons/documents.svg');
$window = $app->get_window();

if(!isset($_GET['post'])) {
    $window->add_raw("<div class='post'>\n");
    $window->add_raw("<h1>Blogs</h1>\n");
    $window->add_raw("<p>As vezes escrevo coisas aleatórias...</p>\n");
}

$app->footer();
$window->show_all();