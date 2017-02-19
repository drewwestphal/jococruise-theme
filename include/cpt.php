<?php
add_action('init', 'cptui_register_my_cpt_artist');
function cptui_register_my_cpt_artist() {
    register_post_type('artist', [
        'label'              => 'Artist',
        'description'        => '',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'post',
        'map_meta_cap'       => true,
        'hierarchical'       => false,
        'rewrite'            => [
            'slug'       => 'artist',
            'with_front' => true,
        ],
        'query_var'          => true,
        'supports'           => [
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
            'wpcom-markdown',
        ],
        'labels'             => [
            'name'               => 'Artist',
            'singular_name'      => 'Artist',
            'menu_name'          => 'Artist',
            'add_new'            => 'Add Artist',
            'add_new_item'       => 'Add New Artist',
            'edit'               => 'Edit',
            'edit_item'          => 'Edit Artist',
            'new_item'           => 'New Artist',
            'view'               => 'View Artist',
            'view_item'          => 'View Artist',
            'search_items'       => 'Search Artist',
            'not_found'          => 'No Artist Found',
            'not_found_in_trash' => 'No Artist Found in Trash',
            'parent'             => 'Parent Artist',
        ],
    ]);
}

add_action('init', 'cptui_register_my_cpt_faq');
function cptui_register_my_cpt_faq() {
    register_post_type('faq', [
        'label'           => 'FAQ',
        'description'     => '',
        'public'          => true,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'capability_type' => 'post',
        'map_meta_cap'    => true,
        'hierarchical'    => false,
        'rewrite'         => [
            'slug'       => 'faq',
            'with_front' => true,
        ],
        'query_var'       => true,
        'supports'        => [
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
            'wpcom-markdown',
        ],
        'labels'          => [
            'name'               => 'FAQ',
            'singular_name'      => 'FAQ',
            'menu_name'          => 'FAQ',
            'add_new'            => 'Add FAQ',
            'add_new_item'       => 'Add New FAQ',
            'edit'               => 'Edit',
            'edit_item'          => 'Edit FAQ',
            'new_item'           => 'New FAQ',
            'view'               => 'View FAQ',
            'view_item'          => 'View FAQ',
            'search_items'       => 'Search FAQ',
            'not_found'          => 'No FAQ Found',
            'not_found_in_trash' => 'No FAQ Found in Trash',
            'parent'             => 'Parent FAQ',
        ],
    ]);
}

add_action('init', 'cptui_register_my_cpt_sponsors');
function cptui_register_my_cpt_sponsors() {
    register_post_type('sponsor', [
        'label'           => 'sponsor',
        'description'     => '',
        'public'          => true,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'capability_type' => 'post',
        'map_meta_cap'    => true,
        'hierarchical'    => false,
        'rewrite'         => [
            'slug'       => 'sponsor',
            'with_front' => true,
        ],
        'query_var'       => true,
        'supports'        => [
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
            'wpcom-markdown',
        ],
        'labels'          => [
            'name'               => 'Sponsors',
            'singular_name'      => 'Sponsor',
            'menu_name'          => 'Sponsors',
            'add_new'            => 'Add Sponsor',
            'add_new_item'       => 'Add New Sponsor',
            'edit'               => 'Edit',
            'edit_item'          => 'Edit Sponsor',
            'new_item'           => 'New Sponsor',
            'view'               => 'View Sponsors',
            'view_item'          => 'View Sponsors',
            'search_items'       => 'Search Sponsors',
            'not_found'          => 'No Sponsors Found',
            'not_found_in_trash' => 'No Sponsors Found in Trash',
            'parent'             => 'Parent Sponsor',
        ],
    ]);
}

add_action('init', 'cptui_register_my_cpt_cities');
function cptui_register_my_cpt_cities() {
    register_post_type('city', [
        'label'           => 'city',
        'description'     => '',
        'public'          => true,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'capability_type' => 'post',
        'map_meta_cap'    => true,
        'hierarchical'    => false,
        'rewrite'         => [
            'slug'       => 'city',
            'with_front' => true,
        ],
        'query_var'       => true,
        'supports'        => [
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
            'wpcom-markdown',
        ],
        'labels'          => [
            'name'               => 'Cities',
            'singular_name'      => 'City',
            'menu_name'          => 'Cities',
            'add_new'            => 'Add City',
            'add_new_item'       => 'Add New City',
            'edit'               => 'Edit',
            'edit_item'          => 'Edit City',
            'new_item'           => 'New City',
            'view'               => 'View Cities',
            'view_item'          => 'View Cities',
            'search_items'       => 'Search Cities',
            'not_found'          => 'No Cities Found',
            'not_found_in_trash' => 'No Cities Found in Trash',
            'parent'             => 'Parent Cities',
        ],
    ]);
}

/**
 * Custom Post Types Supporting the
 * THE EXPERIENCE
 * Page
 *
 */
// dw custom
add_action('init', function () {
    // featured events
    register_post_type('featured-event', [
        'label'              => 'featured-event',
        'description'        => '',
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'post',
        'map_meta_cap'       => true,
        // these apparently block front end visibility
        'hierarchical'       => false,
        'public'             => false,
        'has_archive'        => false,
        'publicly_queryable' => false,
        'rewrite'            => [
            'slug'       => 'featured-event',
            'with_front' => true,
        ],
        'query_var'          => false,
        'supports'           => [
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
            'wpcom-markdown',
        ],
        'labels'             => [
            'name'               => 'Featured Events',
            'singular_name'      => 'Featured Event',
            'menu_name'          => 'Featured Events (Exp. Pg.)',
            'add_new'            => 'Add New Featured Event',
            'add_new_item'       => 'Add New Featured Event',
            'edit'               => 'Edit',
            'edit_item'          => 'Edit Featured Event',
            'new_item'           => 'New Featured Event',
            'view'               => 'View Featured Events',
            'view_item'          => 'View Featured Event',
            'search_items'       => 'Search Featured Events',
            'not_found'          => 'No Featured Events Found',
            'not_found_in_trash' => 'No Featured Events Found in Trash',
            'parent'             => 'Parent Featured Events',
        ],
    ]);
});

?>