<?php
use \Timber\Timber;

Timber::$locations = get_template_directory() . '/twig_templates';
Timber::$cache = false;


add_action('acf/init', function () {
    // load the context filter once we have acf installed...
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
            'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' .
            "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}";
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
$loader = new Twig_Loader_Filesystem(get_template_directory() . '/twig_templates');
$twig = new Twig_Environment($loader, [
    'cache' => false,
    //__DIR__.'/twig_cache',
]);