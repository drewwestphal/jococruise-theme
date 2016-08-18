<?php
use \Timber\Timber;

add_action('init', function () {
    /*custom nav behavior*/
    register_nav_menu('primary', 'Main Nav');
});


add_action('after_setup_theme', function () {
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
});

require_once __DIR__ . '/include/tgm.php';

if(function_exists('acf_add_options_page')) {
    acf_add_options_page([
                             'page_title' => 'Theme General Settings',
                             'menu_title' => 'Theme Settings',
                             'menu_slug'  => 'theme-general-settings',
                             'capability' => 'edit_posts',
                             'redirect'   => false,
                         ]);
}

/* show wordpress toolbar for admins (omit if statement to show to all logged in WP users) */
if(current_user_can('manage_options')) {
    show_admin_bar(true);
} else {
    show_admin_bar(false);
}

require_once(__DIR__ . '/include/cpt.php');
require_once(__DIR__ . '/include/columns.php');
require_once __DIR__ . '/vendor/autoload.php';


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

$cruise_year = get_field('cruise_year', 'option');
$availableCruiseYears = array_reverse(range(2011, intval($cruise_year), 1));

add_filter('acf/load_field/name=faq_year', function ($field) use ($availableCruiseYears) {
    foreach($availableCruiseYears as $year) {
        $field['choices'][$year] = $year;
    }
    return $field;
});

Timber::$locations = __DIR__ . '/twig_templates';
Timber::$cache = false;

add_filter('timber/context', function ($context) {
    $context['options'] = get_fields('options');
    $context['is_booking_page'] =
        !!current_theme_supports('cruisecontrol'); // Using this to load booking css in base.twig
    $context['year'] = date("Y");

    $post = get_post();
    $title = get_bloginfo('name');
    $user_img_tag = '';
    if(!current_theme_supports('cruisecontrol')) {
        // if in booking engine do the default
        if($post && ($user_title = get_field('social_post_title', $post->ID))) {
            $title = $user_title;
        }
        if($post && ($user_image_url = get_field('social_post_image_url', $post->ID))) {
            $user_img_tag = sprintf('<meta property="og:image" content="%s" />', $user_image_url);
        }
    }
    $context['meta_title'] = $title;
    $context['meta_user_img_tag'] = $user_img_tag;
    $context['meta_url'] =
        'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}";
    $context['meta_desc'] = htmlentities(wp_strip_all_tags(get_field('travel_description', 'option')), ENT_QUOTES);
    $context['nav_menu'] = new \Timber\Menu('primary');
    $context['sponsors'] = Timber::get_posts(
        [
            'post_type'      => 'sponsor',
            'posts_per_page' => -1,
        ], 'SponsorPost'
    );

    return $context;
});

add_filter('timber/twig/filters', function (\Twig_Environment $twig) {
    $twig->addFilter(new \Twig_SimpleFilter('markdown', function ($string) {
        return \ParsedownExtra::instance()->parse($string);
    }));
    $twig->addFilter(new \Twig_SimpleFilter('piped_header', function ($string) {
        if(!trim($string)) {
            return '';
        }
        $pcs = explode('|', $string);
        if(count($pcs) > 1) {
            return "<span>$pcs[0]</span><br/>$pcs[1]";
        } else {
            return $string;
        }
    }));
    $twig->addFilter(new \Twig_SimpleFilter('joco_cruise_to_image', function ($string) {
        $imageTag = sprintf('<image src="%s" alt="JoCo Cruise" id="what-is-logo"/> ',
            get_template_directory_uri() . '/img/WhatIs_JoCo_LoGo.svg');
        return str_ireplace('JoCo Cruise', $imageTag, $string);
    }));
    return $twig;
}, 10, 3);

Twig_Autoloader::register();

// this for compatibility assuming we don't got timber e'rywhere
$loader = new Twig_Loader_Filesystem(__DIR__ . '/twig_templates');
$twig = new Twig_Environment($loader, [
    'cache' => false,
    //__DIR__.'/twig_cache',
]);

require_once(__DIR__ . '/include/slick-gallery.php');
require_once(__DIR__ . '/include/JoCoCruisePost.php');
require_once(__DIR__ . '/include/ArtistPost.php');
require_once(__DIR__ . '/include/MapCityPost.php');
require_once(__DIR__ . '/include/SponsorPost.php');

?>