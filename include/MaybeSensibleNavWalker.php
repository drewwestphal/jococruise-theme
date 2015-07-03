<?php

/**
 * This uses the wordpress class to build a linked
 * tree (using arrays).
 *
 * It overrides the start_* and end_* methods to build
 * the tree.
 *
 * It overrides all output from the
 * functions, instead doing its output using the new
 * render method
 * 
 * The render method is abstract and can be implemented
 * in subclasses as necessary
 *
 */
abstract class CCWPNavWalker_Base extends Walker_Nav_Menu {

    // linked list structure...
    private $startel = null;
    private $curel = null;
    private $prevel = null;

    private $parents = array();
    private $levelbump = false;

    /**
     * Theoretically we could decrease line count and
     * have some similar array production functionality
     * by reimplementing this function, but there are
     * a bunch of parameters and different types of walking
     * that we would not support if that were the case.
     */
    public function walk($elements, $max_depth) {
        //traverse however wordpress wants
        parent::walk($elements, $max_depth);
        // but take our output after that is done
        return $this -> render($this -> startel -> toArray());
    }

    /**
     * called before a the first object at hte
     * new level
     *
     * the current element will become the parent of the
     * next element, the level will increment
     */
    public function start_lvl(&$output, $depth = 0, $args = array()) {
        $this -> parents[] = $this -> curel;
        $this -> levelbump = true;
    }

    /**
     * called after the last object in a level
     *
     * the current element is now the parent element of the current
     * string of children and is no longer to be
     * considered a parent
     */
    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $this -> curel = array_pop($this -> parents);
    }

    /**
     * Create the objects for each element encountered
     * and sew them into the hierarchy in the proper place
     *
     * Take level information from other functions
     */
    public function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
        $this -> prevel = $this -> curel;

        // record all function arguments as given
        // a child and next pointer allow us to
        // build the tree
        $this -> curel = new CCWPNavWalker_BareElement();
        $this -> curel -> post = $object;
        $this -> curel -> depth = $depth;
        $this -> curel -> args = $args;
        $this -> curel -> current_object_id = $current_object_id;
        $this -> curel -> nextel = false;
        $this -> curel -> child = false;

        if($this -> levelbump) {
            // if it's a child make the child of its parent
            $this -> prevel -> child = $this -> curel;
            // and don't keep incrementing the level
            $this -> levelbump = false;
        } else if($this -> prevel) {
            // if there is a previous element, link
            // it to this one via its next point
            $this -> prevel -> nextel = $this -> curel;
        } else {
            // if there is no previous element, this is
            // the first element
            $this -> startel = $this -> curel;
        }
    }

    /**
     * NO OP
     */
    public function end_el(&$output, $object, $depth = 0, $args = array()) {
    }

    abstract protected function render($tree);
}

class CCWPNavWalker_RecursiveTwigTemplate extends CCWPNavWalker_Base {
    private $templateName, $elementWrapperName;
    public function __construct($templateName, $elementWrapperName) {
        $this -> templateName = $templateName;
        $this -> elementWrapperName = $elementWrapperName;
    }

    protected function render($tree) {
        global $twig;
        try {
            return $template = $twig -> render($this -> templateName, array($this -> elementWrapperName => $tree));
        } catch(Exception $ex) {
            print_r($ex);
        }
    }

}

/**
 * I didn't want to make this class either, but
 * you need to use this class to avoid the weird
 * copy by value array shit this language does
 *
 * Objects are copy by reference and behave as you
 * would expect for a linked list structure
 */
class CCWPNavWalker_BareElement {
    public $post = null;
    public $args = null;
    public $depth = 0;
    public $current_object_id = 0;
    public $child = null;
    public $nextel = null;

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

}
?>
