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
// if timber is not loaded this will crash the admin interface...
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

// customize ACF fields...
require_once(__DIR__ . '/include/acf-custom.php');
// customize forums
require_once(__DIR__ . '/include/forums-config.php');

//enqueue main styles
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('joco_main', get_template_directory_uri() . '/css/bootstrap.css');
});

add_action('login_enqueue_scripts', function () {
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/css/login.css');
});


?>