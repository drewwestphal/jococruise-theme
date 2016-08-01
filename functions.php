<?php

require_once __DIR__.'/include/tgm.php';

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

add_filter( 'pre_get_posts', 'my_get_posts' );

function my_get_posts( $query ) {

	if ( is_home() && $query->is_main_query() || is_feed() )
		$query->set( 'post_type', array( 'post', 'page', 'artist' ) );

	return $query;
}
function mac_register_theme_menu() {
    register_nav_menu( 'primary', 'Main Nav' );
}


/*custom nav behavior*/

add_action( 'init', 'mac_register_theme_menu' );


/* show wordpress toolbar for admins (omit if statement to show to all logged in WP users) */
if (current_user_can('manage_options')) {
    show_admin_bar(true);
} else {
	show_admin_bar(false);
}

add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );

function blankslate_load_scripts() {

    // load booking styling only on booking pages
    if(current_theme_supports('cruisecontrol')) {
        // load bk styles
        wp_enqueue_style('bookingcss', //
        get_template_directory_uri() . '/css/booking.css', //
        array(), 1, 'screen');
    }

    // according to this place you don't wanna enqueue shit on the admin side...
    //http://digwp.com/2009/06/use-google-hosted-javascript-libraries-still-the-right-way/
    if(!is_admin()) {
        wp_deregister_script('jquery');
    	wp_enqueue_script('bower', get_template_directory_uri().'/js/bower.min.js', array(), 1, false);
        wp_enqueue_script('recaptcha', '//www.google.com/recaptcha/api.js', array(), 1, false);
    }

    // home directory scripts
    if(is_home() || is_page( 'The Experience' )) {
        wp_enqueue_script('js_behavior', get_template_directory_uri() . '/js/js_behavior.js', array('bower'), 1, true);
        wp_enqueue_script('js_contact', get_template_directory_uri() . '/js/js_contact.js', array(
            'js_behavior'
        	), '1', true);
        wp_localize_script('js_contact', 'js_contact_data', //
        array('contact_post_url' => get_template_directory_uri() . '/contact.php'));
    }

    if(is_page('The Experience')) {
        wp_enqueue_script('js_experience',//
        get_template_directory_uri() . '/js/js_experience.js', //
         array('bower'), 1, false);
    }
}

require_once(__DIR__.'/include/cpt.php');
require_once(__DIR__.'/include/columns.php');

require_once __DIR__.'/vendor/autoload.php';

if(function_exists('acf')) {
    $acf = acf();
    $acf -> settings['dir'] = plugins_url() . '/advanced-custom-fields/';
}

function acf_load_faq_field_choices( $field ) {
    // reset choices
    $field['choices'] = array();
    // get the textarea value from options page without any formatting
    $choices = get_field('faq_categories', 'option', false);
    // explode the value so that each line is a new array piece
    $choices = explode("\n", $choices);
    // remove any unwanted white space
    $choices = array_map('trim', $choices);
    // loop through array and add to field 'choices'
    if( is_array($choices) ) {
        foreach( $choices as $choice ) {
            if (strlen($choice)) {
                $field['choices'][$choice] = $choice;
            }
        }
    }
    // return the field
    return $field;
}
add_filter('acf/load_field/name=faq_section_header', 'acf_load_faq_field_choices');

$cruise_year = get_field('cruise_year', 'option');
$availableCruiseYears = array_reverse(range(2011,intval($cruise_year),1));

function is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

if(!is_admin() && !is_login_page()) {
	require_once(__DIR__.'/page-experience-gallery.php');
}
use \Timber\Timber;
Timber::$locations = __DIR__.'/twig_templates';
Timber::$cache = false;

add_filter('timber/context', function($context) {
    $context['options'] = get_fields('options');
    $context['is_booking_page'] = !!current_theme_supports('cruisecontrol'); // Is this necessary?
    $context['year'] = date("Y");

    $post = get_post();
    $title = get_bloginfo('name');
    $user_img_tag = '';
    if(!current_theme_supports('cruisecontrol')) {
        // if in booking engine do the default
        if($post && ($user_title=get_field('social_post_title',$post->ID))){
            $title = $user_title;
        }
        if($post && ($user_image_url=get_field('social_post_image_url',$post->ID))){
            $user_img_tag = sprintf('<meta property="og:image" content="%s" />', $user_image_url);
        }
    }
    $context['meta_title'] = $title;
    $context['meta_user_img_tag'] = $user_img_tag;
    $context['meta_url'] = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}";
    $context['meta_desc'] = htmlentities(wp_strip_all_tags(get_field('travel_description', 'option')), ENT_QUOTES);
    $context['nav_menu'] = wp_nav_menu( array(
        'theme_location' => 'primary',
        'depth'             => 2,
        'container'         => false,
        'menu_class' => 'dropdown-menu',
        'menu_id' => 'nav-dropdown',
        'fallback_cb' => 'CCWPNavWalker_RecursiveTwigTemplate::fallback',
        'echo' => false,
        //Process nav menu using our custom nav walker
        'walker' => new CCWPNavWalker_RecursiveTwigTemplate('navitems.html', 'item')));

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
        if(!trim($string)) { return ''; }
        $pcs = explode('|',$string);
        if (count($pcs)>1)
            return "<span>$pcs[0]</span><br/>$pcs[1]";
        else
            return $string;
    }));
    return $twig;
}, 10, 3);


Twig_Autoloader::register();

// this for compatibility assuming we don't got timber e'rywhere
$loader = new Twig_Loader_Filesystem(__DIR__.'/twig_templates');
$twig = new Twig_Environment($loader, array(
'cache' => false,//__DIR__.'/twig_cache',
));

require_once(__DIR__.'/include/MaybeSensibleNavWalker.php');
require_once(__DIR__.'/include/JoCoCruisePost.php');
require_once(__DIR__.'/include/ExperiencePiecePost.php');
require_once(__DIR__.'/include/MapCityPost.php');
require_once(__DIR__.'/include/SponsorPost.php');

?>