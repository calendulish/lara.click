<h1>Blog da Lara</h1>

<p class="postContents">Esse é um blog pessoal, não relacionado a programação ou linux<br/>
Se você procura informações técnicas visite o <a href="?page=tecblog">tecblog clicando aqui</a>.
<br/><br/>

<?php
require_once('comments.php');

if(!isset($_GET['blogpg'])||$_GET['blogpg'] == ""||$_GET['blogpg'] == 0) {
    $blogpg = 1;
} else {
    $blogpg = $_GET['blogpg'];
}

$posts_per_page = 5;

$ignores = array('.', '..', 'comments', 'media', 'index.php');
$files = array_values(array_diff(scandir('blog', 1), $ignores));

for($i = $posts_per_page*$blogpg-$posts_per_page; $i < $posts_per_page*$blogpg; $i++) {
    if($i == count($files)) break;
    $file = $files[$i];
    list($date, $title) = explode('_', str_replace('.php', '', $file));
    print("<div class='post'>\n");
    print('<div class="postInfo"><p>'.$date."</p> por <p>Lara Maia</p></div>\n");
    print('<h2 class="postTitle">'.$title."</h2>\n");
    print("<div class='postContents'>\n");
    include('blog/'.$file);
    print("<p class='postSignature'><i>Lara Maia</i></p>\n</div>\n");
?>
<div class="commentsForm">
    <form class="commentsFormAlign" action="" method="POST">
        <p class="commentsFormName">Nome: <input id='focus' type="text" name="name" required></p>
        <textarea class="commentsFormText" name="message" rows="6" cols="40"
        placeholder="Escreva seu comentário aqui." required></textarea>
        <input class="commentsFormSubmit" type="submit" name="comment" value="Enviar">
    </form>
<?php
    $commentsFile = 'blog/comments/'.$title.'.json';
    if (isset($_POST['comment'])) {
        if(writeComment($commentsFile) == 1) {
            print("<p class='commentdup'>Comentário duplicado. Não será publicado.</p>");
        }
    }
    if(file_exists($commentsFile)) {
        readComment($commentsFile);
    }

    print("</div>\n</div>\n");
}

if($blogpg > 1) {
printf("<a href='?page=blog&blogpg=%d'>Anterior</a>\n", $blogpg-1);
}
if($posts_per_page*$blogpg < count($files)) {
    printf("<a href='?page=blog&blogpg=%d'>Próxima</a>\n", $blogpg+1);
}
