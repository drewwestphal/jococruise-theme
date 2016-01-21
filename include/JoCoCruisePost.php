<?php

class JoCoCruisePost extends TimberPost {
    /**
     * this one people were using ...
     * timber doesn't quite replicate
     */
    public function joco_excerpt($moretag = '(more...)') {
        $prev = $GLOBALS['post'];
        //https://codex.wordpress.org/Function_Reference/setup_postdata
        setup_postdata($GLOBALS['post'] =& $this);
        if(has_excerpt()) {
            the_excerpt();
        } else {
            the_content($moretag);
        }
        setup_postdata($GLOBALS['post'] =& $prev);
    }

    // for compatibility
    public function joco_thumbnail_markup() {
        $prev = $GLOBALS['post'];
        //https://codex.wordpress.org/Function_Reference/setup_postdata
        setup_postdata($GLOBALS['post'] =& $this);
        echo get_the_post_thumbnail();
        setup_postdata($GLOBALS['post'] =& $prev);
    }
}


?>