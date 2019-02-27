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
    $contents->set_text('The page that you tried to access does not exist. If you got here from an external link
    please, notify the admin of the site that he is linking a broken link. If you got here from
    a link on google.com, please notify google. If you typed this adress on your own, try going
    to the front of lara.click instead and navigating using the menu, I created for this purpose.
    if the menu dont work, its because im too stupid, just ignore it.');
} else {
    $contents->set_text('A página que você tentou acessar não existe. Se você chegou aqui através de um
    link externo por favor, notifique o administrador do site que ele está linkando um
    link quebrado. Se você veio aqui através de um link do google.com, por favor notifique
    o google. Se foi você mesmo que escreveu esse endereço, tente ir para o início do
    lara.click em vez disso e navegue usando o menu, eu o criei para esse propósito.
    Se o menu não funcionar, isso é porque eu sou muito estúpida, somente ignore.');
}

$error->add($contents);

$home = new Button();
$home->connect('home');
$home->set_contents(_('Back'));
$error->add($home);

$error->show_all();
