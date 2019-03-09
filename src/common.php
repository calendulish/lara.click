<?php

require_once('src/gtk.php');

class Menu {
    private $items = [];
    private $menu_id;
    private $menu_name;
    private $custom;
    private $align;

    public function __construct($id, $name, $custom = null, $align = 'left') {
        $this->menu_id = $id;
        $this->menu_name = $name;
        $this->custom = $custom;
        $this->align = $align;
    }

    public function show_all() {
        $extra_class = "' class='left";

        if($this->align == 'right') {
            $extra_class = "' class='right";
        }

        if(empty($this->items)) {
            $extra_class .= " " . $this->menu_id;
        }

        if(!empty($this->custom)) {
            print("<button onclick='" . $this->custom . $extra_class . "'>" . $this->menu_name . "</button>\n");
        } else {
            print("<button onclick='toggle_dropdown(\"" . $this->menu_id . "\")" . $extra_class . "'>" . $this->menu_name . "</button>\n");
        }

        if(!empty($this->items)) {
            print("<div id='" . $this->menu_id . $extra_class . "'>\n");

            foreach($this->items as $item) {
                print("<a href='" . $item[2] . "'>");

                if(!empty($item[0])) {
                    print("<img src='" . $item[0] . "' width='30'/>");
                }

                print($item[1] . "</a>\n");
            }

            print("</div>\n");
        }
    }

    public function add_item($icon, $name, $hyperlink) {
        array_push($this->items, [$icon, $name, $hyperlink]);
    }

    public function set_align($align) {
        $this->align = $align;
    }
}

function should_set($key) {
    if(isset($_POST[$key])) {
        $_SESSION[$key] = $_POST[$key];
        return False;
    } else {
        if(isset($_GET[$key])) {
            $_SESSION[$key] = $_GET[$key];
            return False;
        } elseif(!isset($_SESSION[$key])) {
            return True;
        }
    }
}

class AppFromTemplate {
    private $window;

    public function __construct($name, $icon) {
        global $CuteExplorer;

        $this->window = new Window();
        $this->window->set_title($name);
        $this->window->set_icon($icon);
        $this->window->set_expand(True);
        $this->window->set_minimize_button('update_query', [['program'], ['task'], [$_GET['program']]]);
        $this->window->set_close_button('update_query', [['program', 'post']]);
        $this->window->add_raw("<div class='grid'>\n");

        ob_start();
        require_once('cute-php-explorer/explorer.php');
        $sidebar = ob_get_contents();
        ob_clean();

        $this->window->add_raw("<div class='sidebar'>");
        $this->window->add_raw("<div class='title'>" . _('Files') . "</div>" . $sidebar . "</div>\n");

        if(isset($_GET['post'])) {
            $content_file = str_replace('.app', '', $_GET['program']) . '/' . $_SESSION['lang'] . '/' . $_GET['post'];

            if(!file_exists($content_file)) {
                header('Location: ' . $CuteExplorer->make_query('program', $_GET['program'], ['post']));
                exit(1);
            }

            ob_start();
            include_once($content_file);
            $contents = ob_get_contents();
            ob_clean();

            $this->window->add_raw("<div class='post'><div class='paper lined'>\n");
            $this->window->add_raw("<p class='header'>" . str_replace('.post', '', $_GET['post']) . "</p>\n");

            if($_SESSION['lang'] == 'en_US') {
                $custom_date = datefmt_create('en_US'. NULL, NULL);
                $custom_date->setPattern('MMMM dd, yyyy');
                $this->window->add_raw("<p class='date'>" . $custom_date(filemtime($content_file)) . "</p>\n");
            } else {
                $custom_date = datefmt_create('pt_BR', NULL, NULL);
                $custom_date->setPattern("dd 'de' MMMM, yyyy");
                $this->window->add_raw("<p class='date'>" . datefmt_format($custom_date, filemtime($content_file)) . "</p>\n");
            }

            $this->window->add_raw("<div class='margin'>\n" . $contents . "</div>\n");
            $this->window->add_raw("</div></div>\n");
        }
    }

    public function get_window() {
        return $this->window;
    }

    public function footer() {
        $this->window->add_raw("</div>\n");
    }
}