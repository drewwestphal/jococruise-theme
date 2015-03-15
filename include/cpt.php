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
            'post-formats',
            'wpcom-markdown'
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

add_action('init', 'cptui_register_my_cpt_faq');
function cptui_register_my_cpt_faq() {
    register_post_type('faq', array(
        'label' => 'FAQ',
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array(
            'slug' => 'faq',
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
            'post-formats',
            'wpcom-markdown'
        ),
        'labels' => array(
            'name' => 'FAQ',
            'singular_name' => 'FAQ',
            'menu_name' => 'FAQ',
            'add_new' => 'Add FAQ',
            'add_new_item' => 'Add New FAQ',
            'edit' => 'Edit',
            'edit_item' => 'Edit FAQ',
            'new_item' => 'New FAQ',
            'view' => 'View FAQ',
            'view_item' => 'View FAQ',
            'search_items' => 'Search FAQ',
            'not_found' => 'No FAQ Found',
            'not_found_in_trash' => 'No FAQ Found in Trash',
            'parent' => 'Parent FAQ',
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
            'post-formats',
            'wpcom-markdown'
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
    register_post_type('sponsor', array(
        'label' => 'sponsor',
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array(
            'slug' => 'sponsor',
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
            'post-formats',
            'wpcom-markdown'
        ),
        'labels' => array(
            'name' => 'Sponsors',
            'singular_name' => 'Sponsor',
            'menu_name' => 'Sponsors',
            'add_new' => 'Add Sponsor',
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
add_action('init', 'cptui_register_my_cpt_cities');
function cptui_register_my_cpt_cities() {
    register_post_type('city', array(
        'label' => 'city',
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array(
            'slug' => 'city',
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
            'post-formats',
            'wpcom-markdown'
        ),
        'labels' => array(
            'name' => 'Cities',
            'singular_name' => 'City',
            'menu_name' => 'Cities',
            'add_new' => 'Add City',
            'add_new_item' => 'Add New City',
            'edit' => 'Edit',
            'edit_item' => 'Edit City',
            'new_item' => 'New City',
            'view' => 'View Cities',
            'view_item' => 'View Cities',
            'search_items' => 'Search Cities',
            'not_found' => 'No Cities Found',
            'not_found_in_trash' => 'No Cities Found in Trash',
            'parent' => 'Parent Cities',
        )
    ));
}

?>