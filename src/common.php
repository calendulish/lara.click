<?php
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