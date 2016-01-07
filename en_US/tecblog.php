<h1>TecBlog</h1>
<h3>Interesting discoveries about technology</h3>
<?php
require_once('comments.php');

if(!isset($_GET['tecblogpg'])||$_GET['tecblogpg'] == ""||$_GET['tecblogpg'] == 0) {
    $blogpg = 1;
} else {
    $blogpg = $_GET['tecblogpg'];
}

$posts_per_page = 5;

$ignores = array('.', '..', 'comments', 'media', 'index.php');
$files = array_values(array_diff(scandir('tecblog/en_US', 1), $ignores));

for($i = $posts_per_page*$blogpg-$posts_per_page; $i < $posts_per_page*$blogpg; $i++) {
    if($i == count($files)) break;
    $file = $files[$i];
    list($date, $title) = explode('_', str_replace('.php', '', $file));
    print("<div class='post'>\n");
    print('<div class="info"><p>'.$date."</p> por <p>Lara Maia</p></div>\n");
    print('<h2 class="title">'.$title."</h2>\n");
    print("<div class='postcontents'>\n");
    include('tecblog/en_US/'.$file);
    print("<p class='signature'><i>Lara Maia</i></p>\n</div>\n");
}
?>
<div class="commentsForm">
    <form class="commentsFormAlign" action="" method="POST">
        <p>Name: <input id='focus' class="commentsFormName" type="text" name="name" required>
        <textarea class="commentsFormText" name="message" rows="6" cols="40"
        placeholder="Writes your comment here." required></textarea></p>
        <input class="commentsFormSubmit" type="submit" name="comment" value="Submit">
    </form>
<?php
    $commentsFile = 'tecblog/en_US/comments/'.$title.'.json';
    if (isset($_POST['comment'])) {
        if(writeComment($commentsFile) == 1) {
            print("<p class='commentdup'>Duplicate comment.It will not be published</p>");
        }
    }
    if(file_exists($commentsFile)) {
        readComment($commentsFile);
    }

    print("</div>\n</div>\n");

if($blogpg > 1) {
printf("<a href='?page=tecblog&tecblogpg=%d'>Previous</a>\n", $blogpg-1);
}
if($posts_per_page*$blogpg < count($files)) {
    printf("<a href='?page=tecblog&tecblogpg=%d'>Next</a>\n", $blogpg+1);
}
