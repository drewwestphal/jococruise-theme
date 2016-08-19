<?php

class JoCoCruisePost extends \Timber\Post {
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
    public function joco_thumbnail_markup($classes = '', $size = 'post-thumbnail') {
        $markup = get_the_post_thumbnail($this->id);
        return str_replace('class="','class="'.$classes.' ', $markup);
    }

    public function joco_cruise_to_image_in_title() {
        // modified header
        $introPostHeaderImageTag =
            sprintf('<image src="%s" alt="JoCo Cruise" id="what-is-logo"/> ', get_template_directory_uri() .
                                                                              '/img/WhatIs_JoCo_LoGo.svg');
        $introPostHeaderParsed = $this->post_title;
        return str_ireplace('JoCo Cruise', $introPostHeaderImageTag, $introPostHeaderParsed);
    }
}


?>