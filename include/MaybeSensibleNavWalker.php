<?php

/**
 * This uses the wordpress class to build a linked
 * tree of objects. 
 * 
 * It overrides the start_* and end_* methods to build
 * the tree.
 * 
 * It overrides all output from the 
 * functions, instead doing its output using the new
 * render method
 * 
 * CCWPNavWalker_ElementBase is sufficient for current
 * purposes, but createElement and render are left abstract
 * allowing the create element function to use any class
 * you please and render to be implemented however.
 * 
 * For succinctness CCWPNavWalker_CallbackWalker can be
 * used, which allows the user to supply a callback for
 * render and, optionally, for createElement
 * 
 * If a complex implementation is planned, a custom 
 * class should be used.    
 */
abstract class CCWPNavWalker_Base extends Walker_Nav_Menu {

    // linked list structure...
    private $startel = null;
    private $curel = null;
    private $prevel = null;

    private $parents = array();
    private $levelbump = false;

    public function walk($elements, $max_depth) {
        //traverse however wordpress wants
        parent::walk($elements, $max_depth);
        // but take our output after that is done
        return $this -> render($this -> startel);
    }

    public function start_lvl(&$output, $depth = 0, $args = array()) {
        $this -> parents[] = $this -> curel;
        $this -> levelbump = true;
    }

    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $this -> curel = array_pop($this -> parents);
    }

    public function end_el(&$output, $object, $depth = 0, $args = array()) {
    }

    public function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
        $this -> prevel = $this -> curel;
        $this -> curel = $this -> createElement($object, $depth, $args, $current_object_id);
        if($this -> levelbump) {
            $this -> prevel -> setChild($this -> curel);
            $this -> levelbump = false;
        } else {
            if($this -> prevel) {
                $this -> prevel -> setNext($this -> curel);
            } else {
                $this -> startel = $this -> curel;
            }
        }
    }


    abstract protected function createElement($object, $depth, $args, $current_object_id);
    abstract protected function render($headElement);


    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

}

class CCWPNavWalker_CallbackWalker extends CCWPNavWalker_Base {
    private $elementFactoryCB = null;
    private $renderCB = null;

    public function __construct($renderCB, $elementFactoryCB = null) {
        $this -> renderCB = $renderCB;
        $this -> elementFactoryCB = $elementFactoryCB;
        if(!$this -> elementFactoryCB) {
            $this -> elementFactoryCB = function($object, $depth = 0, $args = array(), $current_object_id = 0) {
                return new CCWPNavWalker_ElementBase($object, $depth, $args, $current_object_id);
            };
        }
    }

    protected function createElement($object, $depth, $args, $current_object_id) {
        // gotta do it this way bc is dumb
        return call_user_func_array($this -> elementFactoryCB, func_get_args());
    }

    protected function render($headElement) {
        // gotta do it this way bc is dumb
        return call_user_func_array($this -> renderCB, func_get_args());
    }

}

class CCWPNavWalker_ElementBase {
    private $post = null;
    private $args = null;
    private $child = null;
    private $nextel = null;
    private $depth = 0;
    private $current_object_id = 0;

    public function __construct($post, $depth = 0, $args = array(), $current_object_id = 0) {
        $this -> post = $post;
        $this -> args = $args;
        $this -> depth = $depth;
        $this -> current_object_id = $current_object_id;
    }

    public function toArray() {
        return array(
            'post' => (array)$this -> post,
            'args' => $this -> args,
            'child' => $this -> child ? $this -> child -> toArray() : false,
            'next' => $this -> nextel ? $this -> nextel -> toArray() : false,
            'depth' => $this -> depth,
            'current_object_id' => $this -> current_object_id,
        );
    }

    public function dbg($level = 0) {
        $id = $this -> post -> ID;
        $title = $this -> post -> title;
        printf("%s$level  ID=$id, title=$title\n", str_repeat("\t", $level));
    }

    public function getKey() {
        return $this -> post -> ID;
    }

    public function getPost() {
        return $this -> post;
    }

    public function getChild() {
        return $this -> child;
    }

    public function setChild(CCWPNavWalker_ElementBase $child) {
        $this -> child = $child;
    }

    public function getNext() {
        return $this -> nextel;
    }

    public function setNext(CCWPNavWalker_ElementBase $next) {
        $this -> nextel = $next;
    }

    public static function dbgwalk(CCWPNavWalker_ElementBase $head, $level = 0) {
        $head -> dbg($level);
        if($child = $head -> getChild()) {
            self::dbgwalk($child, $level + 1);
        }
        if($next = $head -> getNext()) {
            self::dbgwalk($next, $level);
        }
    }

}
?>
