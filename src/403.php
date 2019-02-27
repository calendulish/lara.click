<?php
require_once('src/gtk.php');

$error = new Window();
$error->set_expand(True);

$title = new Label();
$title->set_expand(True);
$title->set_text('404');
$title->set_tag('h1');
$error->add($title);

$contents = new Label();
$contents->set_expand(True);

if($_SESSION['lang'] == 'en_US') {
    $contents->set_text('You dont have permission to access the requested page or file.');
} else {
    $contents->set_text('Você não tem permissão para acessar a página ou arquivo requisitado.');
}

$error->add($contents);

$home = new Button();
$home->connect('home');
$home->set_contents(_('Back'));
$error->add($home);

$error->show_all();
