<?php

add_action('init', function () {
    /*custom nav behavior*/
    register_nav_menu('primary', 'Main Nav');

    /* show wordpress toolbar for admins (omit if statement to show to all logged in WP users) */
    if(current_user_can('manage_options')) {
        show_admin_bar(true);
    } else {
        show_admin_bar(false);
    }
});

add_action('after_setup_theme', function () {
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
});


require_once(__DIR__ . '/include/tgm.php');
require_once(__DIR__ . '/include/cpt.php');
require_once(__DIR__ . '/include/columns.php');
require_once(__DIR__ . '/vendor/autoload.php');
if(!class_exists('Timber\Timber')) {
    return;
}
require_once(__DIR__ . '/include/timber_setup.php');
require_once(__DIR__ . '/include/slick-gallery.php');
require_once(__DIR__ . '/include/JoCoCruisePost.php');
require_once(__DIR__ . '/include/ArtistPost.php');
require_once(__DIR__ . '/include/MapCityPost.php');
require_once(__DIR__ . '/include/SponsorPost.php');
require_once(__DIR__ . '/include/FAQPost.php');

if(function_exists('acf_add_options_page')) {
    acf_add_options_page([
                             'page_title' => 'Theme General Settings',
                             'menu_title' => 'Theme Settings',
                             'menu_slug'  => 'theme-general-settings',
                             'capability' => 'edit_posts',
                             'redirect'   => false,
                         ]);
}

add_filter('acf/load_field/name=faq_section_header', function ($field) {
// Loads FAQ categories from theme page as options for FAQ post type
    $field['choices'] = [];
    $choices = get_field('faq_categories', 'option', false);
    $choices = explode("\n", $choices);
    $choices = array_map('trim', $choices);
    if(is_array($choices)) {
        foreach($choices as $choice) {
            if(strlen($choice)) {
                $field['choices'][$choice] = $choice;
            }
        }
    }
    return $field;
});

add_action('acf/init', function () {
    $cruise_year = get_field('cruise_year', 'option');
    $availableCruiseYears = array_reverse(range(2011, intval($cruise_year), 1));

    add_filter('acf/load_field/name=faq_year', function ($field) use ($availableCruiseYears) {
        foreach($availableCruiseYears as $year) {
            $field['choices'][$year] = $year;
        }
        return $field;
    });

// create a year / type entry for each artist
    foreach($availableCruiseYears as $year) {
        acf_add_local_field([
                                'key'           => 'field_customArtistType_' . $year,
                                'name'          => 'artist_type' . $year,
                                'label'         => 'Artist Type ' . $year,
                                'type'          => 'select',
                                'parent'        => 'group_acf_artist',
                                'choices'       => [
                                    'artist'          => "Performer",
                                    'featured artist' => "Featured Guest",
                                    'spotlight item'  => "Spotlight Item",
                                    'podcast'         => "Podcast",
                                    'did not attend'  => "Did not attend this year",
                                ],
                                'default_value' => 'did not attend',
                            ]);
    }
});
//enqueue main styles
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('joco_main', get_template_directory_uri() . '/css/bootstrap.css');
});

add_action('login_enqueue_scripts', function () {
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/css/login.css');
});


add_action('bp_init', function () {
    $fields = [
        [
            'field_group_id' => 1,
            'name'           => 'About',
            'description'    => 'Tell us about yourself',
            'field_order'    => 1,
            'is_required'    => false,
            'type'           => 'textbox',
        ],
        [
            'field_group_id' => 1,
            'name'           => 'Twitter',
            'field_order'    => 2,
            'is_required'    => false,
            'type'           => 'textbox',
        ],
        [
            'field_group_id' => 1,
            'name'           => 'Facebook',
            'field_order'    => 3,
            'is_required'    => false,
            'type'           => 'url',
        ],
        [
            'field_group_id' => 1,
            'name'           => 'Instagram',
            'field_order'    => 4,
            'is_required'    => false,
            'type'           => 'url',
        ],
        [
            'field_group_id' => 1,
            'name'           => 'Google+',
            'field_order'    => 5,
            'is_required'    => false,
            'type'           => 'url',
        ],
        [
            'field_group_id' => 1,
            'name'           => 'LinkedIn',
            'field_order'    => 6,
            'is_required'    => false,
            'type'           => 'url',
        ],
    ];
    if(function_exists('xprofile_get_field_id_from_name')) {
        foreach($fields as $field) {
            if(!xprofile_get_field_id_from_name($field['name'])) {
                xprofile_insert_field($field);
            }
        }
    }
});
?>