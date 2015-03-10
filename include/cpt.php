<?php
add_action('init', 'cptui_register_my_cpt_artist');
function cptui_register_my_cpt_artist() {
    register_post_type('artist', array(
        'label' => 'Artist',
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array(
            'slug' => 'artist',
            'with_front' => true
        ),
        'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',
            'post-formats'
        ),
        'labels' => array(
            'name' => 'Artist',
            'singular_name' => 'Artist',
            'menu_name' => 'Artist',
            'add_new' => 'Add Artist',
            'add_new_item' => 'Add New Artist',
            'edit' => 'Edit',
            'edit_item' => 'Edit Artist',
            'new_item' => 'New Artist',
            'view' => 'View Artist',
            'view_item' => 'View Artist',
            'search_items' => 'Search Artist',
            'not_found' => 'No Artist Found',
            'not_found_in_trash' => 'No Artist Found in Trash',
            'parent' => 'Parent Artist',
        )
    ));
}

add_action('init', 'cptui_register_my_cpt_about');
function cptui_register_my_cpt_about() {
    register_post_type('about', array(
        'label' => 'About',
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array(
            'slug' => 'about',
            'with_front' => true
        ),
        'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',
            'post-formats'
        ),
        'labels' => array(
            'name' => 'About',
            'singular_name' => 'About Entry',
            'menu_name' => 'About',
            'add_new' => 'Add About Entry',
            'add_new_item' => 'Add New About Entry',
            'edit' => 'Edit',
            'edit_item' => 'Edit About Entry',
            'new_item' => 'New About Entry',
            'view' => 'View About Entry',
            'view_item' => 'View About Entry',
            'search_items' => 'Search About',
            'not_found' => 'No About Found',
            'not_found_in_trash' => 'No About Found in Trash',
            'parent' => 'Parent About Entry',
        )
    ));
}

add_action('init', 'cptui_register_my_cpt_sponsors');
function cptui_register_my_cpt_sponsors() {
    register_post_type('sponsors', array(
        'label' => 'sponsors',
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array(
            'slug' => 'sponsors',
            'with_front' => true
        ),
        'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',
            'post-formats'
        ),
        'labels' => array(
            'name' => 'Sponsors',
            'singular_name' => 'Sponsor',
            'menu_name' => 'Sponsors',
            'add_new' => 'Add Sponsors',
            'add_new_item' => 'Add New Sponsor',
            'edit' => 'Edit',
            'edit_item' => 'Edit Sponsor',
            'new_item' => 'New Sponsor',
            'view' => 'View Sponsors',
            'view_item' => 'View Sponsors',
            'search_items' => 'Search Sponsors',
            'not_found' => 'No Sponsors Found',
            'not_found_in_trash' => 'No Sponsors Found in Trash',
            'parent' => 'Parent Sponsor',
        )
    ));
}
?>