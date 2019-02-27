<?php
/*
 * The Lara.Click website is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * The Lara.Click website is distributed in the hope that it will be
 * useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Lara Maia <dev@lara.click> © 2019
 *
 * DO NOT USE THAT! IT'S UGLY! IT'S RUDE! THANKS!
 
 * but it's cool...
 */
 
 class Widget {
    private $expand = false;
    private $homogeneous = true;
    
    public function get_html() {
        return null;
    }
    
    public function set_params(&$widget) {
        if($this->expand) {
            $widget .= " expand";
        } elseif($this->homogeneous) {
            $widget .= " homogeneous";
        }
    }
    
    public function set_expand($expand) {
        $this->expand = $expand;
    }
    
    public function set_homogeneous($homogeneous) {
        $this->homogeneous = $homogeneous;
    }
    
    public function show() {
        print($this->get_html());
    }
}

class Window extends Widget {
    protected $window = "<div class='window";
    protected $headerbar = "<a class='headerbar";
    protected $icon = "<a class='thumbnail";
    protected $extra;
    protected $close_button_callback;
    protected $close_button_params;

    private $title;
    private $icon_image;
    private $hyperlink;

    public function __construct($title = null, $icon = null, $hyperlink = null, $expand = false, $homogeneous = true) {
        $this->title = $title;
        $this->icon_image = $icon;
        $this->hyperlink = $hyperlink;
        $this->expand = $expand;
        $this->homogeneous = $homogeneous;
    }
    
    public function get_html() {
        parent::set_params($this->window);
        
        if(!empty($this->title)) {
            $this->window .= "' id='" . $this->title;
        }
        
        $this->window .= "'>\n";

        if(!empty($this->hyperlink)) {
            $this->icon .= "' href='" . $this->hyperlink;
            $this->headerbar .= "' href='" . $this->hyperlink;
        }

        $this->icon .= "'>";

        if(!empty($this->title)) {
            $this->headerbar .= "'>" . $this->title;
        } else {
            $this->headerbar .= "'><br/>";
        }

        $this->headerbar .= "</a>\n";

        if(!empty($this->icon_image)) {
            $this->icon .= "<img title='" . $this->title . "' src='" . $this->icon_image . "' width='25'/></a>\n";
        } else {
            $this->icon = null;
        }

        $close_button = null;
            
        if(!empty($this->close_button_callback)) {
            $close_button = "<button class='close_button' onclick='" . $this->close_button_callback . '(';

            foreach($this->close_button_params as $param) {
                $close_button .= '"' . $param . '",';
            }

            $close_button .= ");'>X</button>";
        }
        
        return $this->window . $this->headerbar . $close_button . $this->icon;
    }

    public function set_close_button($close_button_callback, $close_button_params) {
        $this->close_button_callback = $close_button_callback;
        $this->close_button_params = $close_button_params;
    }

    public function set_title($title) {
        $this->title = $title;    
    }
    
    public function set_icon($icon) {
        $this->icon_image = $icon;
    }
    
    public function set_hyperlink($hyperlink) {
        $this->hyperlink = $hyperlink;
    }
    
    public function add(&$widget) {
        $this->extra .= $widget->get_html();
    }
    
    public function add_raw($contents) {
        $this->extra .= $contents;
    }
    
    public function show() {
        parent::show();
        print("</div>\n");
    }
    
    public function show_all() {
        parent::show();
        print($this->extra);
        print("</div>\n");
    }
}

class Entry extends Widget {
    protected $entry = "<div class='entry";
    
    private $text;
    
    public function __construct($text = null) {
        $this->text = $text;
    }
    
    public function get_html() {
        parent::set_params($this->entry);
        $this->entry .= "'>";
        return $this->entry . "\n<p>\n" . $this->text . "\n</p>\n</div>\n";
    }
    
    public function set_text($text) {
        $this->text = wordwrap(str_replace("\n", ' ', $text));
    }
    
    public function get_text() {
        return $this->text;
    }
}

class Image extends Widget {
    protected $image = "<div class='image";
    
    private $image_file;
    private $title;
    private $hyperlink;
    
    public function __construct($image = null, $title = null, $hyperlink = null) {
        $this->image_file = $image;
        $this->title = $title;
        $this->hyperlink = $hyperlink;
    }
    
    public function get_html() {
        parent::set_params($this->image);
        $this->image .= "'>\n<a";
        
        if(!empty($this->hyperlink)) {
            $this->image .= " href='" . $this->hyperlink . "'";
        }
        
        $this->image .= ">";
        
        if(!empty($this->image_file)) {
            $this->image .= "<img title='" . $this->title . "' src='" . $this->image_file . "'/>";
        }
     
        $this->image .= "</a></div>\n";
        
        return $this->image;
    }
    
    public function set_from_file($image) {
        $this->image_file = $image;
    }
    
    public function set_hyperlink($hyperlink) {
        $this->hyperlink = $hyperlink;
    }
    
    public function set_title($title) {
        $this->title = $title;    
    }
}

class Label extends Widget {
    protected $label = "<div class='label";
    
    private $text;
    private $tag;
    
    public function __construct($text = null, $tag = 'p') {
        $this->text = $text;
        $this->tag = $tag;
    }
    
    public function get_html() {
        parent::set_params($this->label);
        $this->label .= "'>";
        
        if(!empty($this->text)) {
            $this->label .= "<" . $this->tag . ">" . $this->text . "</" . $this->tag . ">";
        }
        
        $this->label .= "</div>";
        
        return $this->label;
    }
    
    public function set_text($text) {
        $this->text = $text;
    }
    
    public function set_tag($tag) {
        $this->tag = $tag;
    }
}

class ListStore extends widget {
    protected $treeview = "<ul class='liststore";
    
    private $items = [];
    private $title;
    
    public function __construct($items = [], $title = null) {
        $this->items = $items;
        $this->title = $title;
    }
    
    public function get_html() {
        parent::set_params($this->treeview);
        $this->treeview .= "'>";
        
        if(!empty($this->title)) {
            $this->treeview .= "<lh><p>" . $this->title . "</p></lh>";
        }
        
        foreach($this->items as &$item) {
            $this->treeview .= "<li><p>" . $item . "</p></li>";
        }
        
        $this->treeview .= "</ul>";
        
        return $this->treeview;
    }
    
    public function add_item($item) {
        array_push($this->items, $item);
    }
    
    public function set_title($title) {
        $this->title = $title;
    }
}

class TreeStore extends Widget {
    protected $treeview = "<div class='treestore";
    protected $template = "'";
    protected $headers;
    protected $size;

    private $items = [];

    public function __construct($headers) {
        $title_template = null;
        $column_template = null;

        for($i = 0; $i < count($headers); $i++) {
            $title_template .= "title" . $i . " ";
            $column_template .= "column" . $i . " ";
            $this->headers .= "<p style='grid-area: title". $i . "' class='title'>" . $headers[$i] . "</p>\n";
        }

        $this->template .= $title_template . "' '" . $column_template . "'";
        $this->size = count($headers);
    }

    public function get_html() {
        parent::set_params($this->treeview);
        $this->treeview .= "' style=\"grid-template-areas:" . $this->template . "\">\n";
        $this->treeview .= $this->headers;

        for($i = 0; $i < $this->size; $i++) {
            $this->treeview .= "<div style='grid-area: column" . $i . "'>";

            foreach($this->items as $item) {
                $this->treeview .= "<p>" . $item[$i] . "</p>\n";
            }

            $this->treeview .= "</div>";
        }

        print($this->treeview . "</div>\n");
    }

    public function add_item($item) {
        array_push($this->items, $item);
    }
}

class Button extends Widget {
    protected $button = "<button class='button";
    
    private $contents;
    private $function_;
    private $params_;
    
    public function __construct($contents = null, $function_ = null, $params_ = []) {
        $this->contents = $contents;
        $this->function_ = $function_;
        $this->params_ = $params_;
    }
    
    public function get_html() {
        parent::set_params($this->button);
        
        if(!empty($this->function_)) {
            $this->button .= "' onclick='" . $this->function_ . '(';
            
            foreach($this->params_ as $param) {
                $this->button .= '"' . $param . '",';
            }

            $this->button .= ');';
        }
        
        $this->button .= "'>";
        
        return $this->button . $this->contents . "</button>";
    }
    
    public function connect($function_, $params_) {
        $this->function_ = $function_;
        $this->params_ = $params_;
    }
    
    public function set_contents($contents) {
        $this->contents = $contents;
    }
}