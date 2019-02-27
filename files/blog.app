<?php

require_once('src/gtk.php');

$blog = new Window();
$blog->set_title('Blog');
$blog->set_icon('icons/documents.svg');
$blog->set_expand(True);
$blog->set_minimize_button('update_query', [['program'], ['task'], ["blog.app"]]);
$blog->set_close_button('update_query', [['program', 'post']]);
$blog->add_raw("<div class='grid'>\n");

ob_start();
require_once('cute-php-explorer/explorer.php');
$sidebar = ob_get_contents();
ob_clean();

$blog->add_raw("<div class='sidebar'>");
$blog->add_raw("<div class='title'>Files</div>" . $sidebar . "</div>\n");

if(isset($_GET['post'])) {
    $content_file = 'blog/' . $_SESSION['lang'] . '/' . $_GET['post'];
    
    if(!file_exists($content_file)) {
        header('Location: ' . $CuteExplorer->make_query('program', $_GET['program'], ['post']));
        exit(1);
    }
    
    ob_start();
    include_once($content_file);
    $contents = ob_get_contents();
    ob_clean();
    $blog->add_raw("<div class='post'>" . $contents . "</div>\n");
} else {
    $blog->add_raw("<div class='post'>\n");
    $blog->add_raw("<h1>Blogs</h1>\n");
}

$blog->add_raw("</div>\n");
$blog->show_all();
