<div class="pageTitleImage">
    <img alt="RaspberryPi" src="raspberrypi/media/raspberrypi.gif"/>
</div>

<h1 class="pageTitle">RaspberryPi</h1>

<h3 class="pageSubTitle">Você não sabe o que é um RaspberryPi?
    <a href=https://player.vimeo.com/video/90103691?autoplay=1 target="_blank">Clique aqui</a>
</h3>

<?php
require_once('comments.php');

function make_query($topic) {
    $query = parse_url($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], PHP_URL_QUERY);

    // If any query exist, check if "[?&]dir=" is already present and updates it.
    if($query) {
        parse_str($query, $params);
        $params["topic"] = $topic;
        $link = "?".urldecode(http_build_query($params));
    } else {
        $link = "?topic=".$topic;
    }

    return $link;
}

function get_info($file) {
    list($order, $raw) = explode('.', str_replace('.php', '', $file));

    return explode('_', $raw);
}

if(!isset($_GET['topic'])||$_GET['topic'] == ""||$_GET['topic'] == 0) {
    $topic = 1;
} else {
    $topic = $_GET['topic'];
}

// Create a list of files in the directory
$ignores = array('.', '..', 'media', 'index.php');
$files = array_values(array_diff(scandir('raspberrypi/pt_BR'), $ignores));

// Build the menu
print("<ul class='postMenu'>\n");
print("<li class='postMenuTitle'>Menu</li>");
for($i = 0; $i < count($files); $i++) {
    // Get post info from filename
    list($date, $title, $author) = get_info($files[$i]);
    if($topic-1 == $i) {
        print("<li class='postMenuItem'><a class='active'>".$title."</a></li>\n");
    } else {
        print("<li class='postMenuItem'><a href=".make_query($i+1).">".$title."</a></li>\n");
    }

}
print("</ul>\n");

// Attach the current topic in the page
$file = $files[$topic-1];
list($date, $title, $author) = get_info($file);
print("<div class='post'>\n");
print('<div class="postInfo"><p>'.$date."</p> por <p>".$author."</p></div>\n");
print('<h2 class="postTitle">'.$title."</h2>\n");
print("<div class='postContents'>\n");
include('raspberrypi/pt_BR/'.$file);
print("</div>\n</div>\n");

?>
