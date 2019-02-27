<?php
print("<nav class='menu'>");

if(isset($_SESSION['mobile']) && $_SESSION['mobile'] == "on") {
    $start_menu = new Menu('start', _('☰'));
    $start_menu->set_align('right');

    $start_menu->add_item(null, _('Home'), parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $start_menu->add_item(null, 'pt_BR ' . _('(Portuguese)'), $CuteExplorer->make_query('lang', 'pt_BR'));
    $start_menu->add_item(null, 'en_US ' . _('(English)'), $CuteExplorer->make_query('lang', 'en_US'));

    if(isset($_SESSION['overlay']) && $_SESSION['overlay'] == 'off') {
        $start_menu->add_item(null, _("Tablet Mode On"), $CuteExplorer->make_query('overlay', 'on'));
    } else {
        $start_menu->add_item(null, _("Tablet Mode Off"), $CuteExplorer->make_query('overlay', 'off'));
    }

    $start_menu->show_all();
} else {
    $start_menu = new Menu('start', _('Start'));
    $start_menu->add_item('icons/contact.svg', _('About'), '#');

    $start_menu->show_all();

    print("<div class='clock right'></div>\n");

    $language_menu = new Menu('language', _('Language'));
    $language_menu->set_align('right');
    $language_menu->add_item(null, 'pt_BR ' . _('(Portuguese)'), $CuteExplorer->make_query('lang', 'pt_BR'));
    $language_menu->add_item(null, 'en_US ' . _('(English)'), $CuteExplorer->make_query('lang', 'en_US'));
    $language_menu->show_all();

    $disable_overlay_menu = new Menu('disable_overlay', _("Power"));
    $disable_overlay_menu->set_align('right');

    if(isset($_SESSION['overlay']) && $_SESSION['overlay'] == 'off') {
        $disable_overlay_menu->add_item(null, _("Tablet Mode On"), $CuteExplorer->make_query('overlay', 'on'));
    } else {
        $disable_overlay_menu->add_item(null, _("Tablet Mode Off"), $CuteExplorer->make_query('overlay', 'off'));
    }

    $disable_overlay_menu->show_all();
}



if(isset($_GET['program'])) {
    $taskbar = new Menu('taskbar', $_GET['program'], 'location.href="' . $CuteExplorer->make_query('task', $_GET['program'], ['program']) . '"');
    $taskbar->show_all();
} elseif(isset($_GET['task'])) {
    $taskbar = new Menu('taskbar', $_GET['task'], 'location.href="' . $CuteExplorer->make_query('program', $_GET['task'], ['task']) . '"');
    $taskbar->show_all();
}

print("</nav>\n");