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
    wp_enqueue_style('bootstrapcss', //
    get_template_directory_uri() . '/css/bootstrap.css',//
     array(), 1, 'screen');


    // magnific
    // it is just registered here
    // call it a dep to include it on a page
    /* JS IS INCLUDED IN BOWER
    wp_register_script('magnificjs',// 
    get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', //
     array('jquery'), 1, true);
    wp_register_style('magnificcss',//
    get_template_directory_uri() . '/css/magnific-popup.css', //
     array(), 1, true);
	 */



    $maindeps = array(
        'bootstrapcss',
    );
    // this is a hack for booking engine visual
    // dev speed... we don't want to load the reset
    // when the bk engine is running
    if(!current_theme_supports('cruisecontrol')) {
        $maindeps[] = 'reset';
    } else {
        // load bk styles
        wp_enqueue_style('bookingcss', //
        get_template_directory_uri() . '/css/booking.css', //
        array(
            'base',
            'macstyle'
        ),//
        1, 'screen');
    }

	/* STYLING DONE IN CUSTOM BOOTSTRAP
    $stylePath = __DIR__.'/css/style.css';
    wp_enqueue_style('macstyle', //
    	get_template_directory_uri() . '/style.css', //
    	$maindeps, md5(filemtime($stylePath).filesize($stylePath)), 'screen');
	 */

    // according to this place you don't wanna enqueue shit on the admin side...
    //http://digwp.com/2009/06/use-google-hosted-javascript-libraries-still-the-right-way/
    if(!is_admin()) {
        wp_deregister_script('jquery');
    	wp_enqueue_script('bower', get_template_directory_uri().'/js/bower.min.js', array(), 1, false);
        wp_enqueue_script('recaptcha', '//www.google.com/recaptcha/api.js', array(), 1, false);
    	/*
        wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array(), 1, false);
		if ( wp_is_mobile() ) {
	        wp_enqueue_script('jquery_mobile', get_template_directory_uri() . '/js/jquery.mobile.custom.min.js', array(), 1, false);
		}

        // this is also just for the front-end
        //bootstrap.js is dependant on jquery
        wp_enqueue_script('bootstrapjs',//
        get_template_directory_uri() . '/js/bootstrap.min.js', //
         array('jquery'), 1, false);
		 *
		 */

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
		//wp_enqueue_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array(), 1, false);
    }
}

require_once(__DIR__.'/include/cpt.php');
require_once(__DIR__.'/include/columns.php');

// fix CMB2 include path
add_filter('cmb2_meta_box_url', function ($url) {
    // this function is retardedly implemented on the cmb2 side...
    // gives me great faith in the rest of their work!
    return get_template_directory_uri() . '/vendor/plugins/cmb2';
});

require_once __DIR__.'/vendor/autoload.php';
// yes you CAN include a file that returns a value...
// look it up!
$ThemeOptions = new CCWPOptions_Page('mac_settings','JoCo Cruise Theme Options',include(__DIR__.'/include/theme_options_fields_arr.php'));
function jcctheme_get_option($key){
    global $ThemeOptions;
    return $ThemeOptions->get_option($key);
}
if(function_exists('acf')) {
    $acf = acf();
    $acf -> settings['dir'] = plugins_url() . '/advanced-custom-fields/';
}

add_action('cmb2_init', function() {
    // we wwant to have our options all set up so we can use them here
    include __DIR__.'/theme_variables.php';
    //require_once(__DIR__.'/include/acf.php');
});

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

// Should really get rid of all this
// But copied from acf.php to not break things
$artistTypeChoices = [
    'artist'          => 'Performer',
    'featured artist' => 'Featured Guest',
    'spotlight item'  => 'Spotlight Item',
    'did not attend'  => 'Did not attend this year',
];
$artistYearAndTypeFields = [];
// we have to do the field counter stuff bc
// that is how they were numbered when they
// were created and we don't want to mess with the
// db
$fieldCounter = 5459;
$cruise_year = get_field('cruise_year', 'option');
$availableCruiseYears = [];
for($year = 2011; $year <= $cruise_year; $year++) {
    $artistYearAndTypeFields[] = [
        // the below is post-dec, which will dec
        // after returning current val
        'key'           => 'field_54b703017' . $fieldCounter--,
        'label'         => 'Artist Type ' . $year,
        'name'          => 'artist_type' . $year,
        'type'          => 'select',
        'choices'       => $artistTypeChoices,
        'default_value' => '',
        'allow_null'    => 1,
        'multiple'      => 0,
    ];
    $availableCruiseYears[] = $year;
}
$availableCruiseYears = array_reverse($availableCruiseYears);
$artistYearAndTypeFields = array_reverse($artistYearAndTypeFields);
// share this for other pieces of theme
$_ENV['cc_valid_cruise_years'] = $availableCruiseYears;
$_ENV['cc_artist_type_and_year_fields_desc'] = $artistYearAndTypeFields;

function is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

if(!is_admin() && !is_login_page()) {
	require_once(__DIR__.'/page-experience-gallery.php');
}
use \Timber\Timber;
Timber::$locations = __DIR__.'/twig_templates';
Timber::$cache = false;

function transform_piped_header($header){
    if(!trim($header)) { return ''; }
    $pcs = explode('|',$header);
    if (count($pcs)>1)
        return "<span>$pcs[0]</span><br/>$pcs[1]";
    else
        return $header;
}
add_filter('timber/context', function($context) {
    //include __DIR__.'/theme_variables.php';

    $settings = $context['settings'] = get_option('mac_settings');
    $context['site_title'] = get_bloginfo('name');
    $cruise_year = get_field('cruise_year', 'option');
    $context['cruise_year'] = $cruise_year<2015?2015:$cruise_year;
    $context['talent_year'] = get_field('talent_year', 'option');
    $context['booking_enabled'] = get_field('enable_booking', 'option');
    $context['booking_url'] = get_field('booking_path', 'option');
    $context['booking_cta'] = get_field('button_call_to_action', 'option');
    $context['travel_desc'] = get_field('travel_description', 'option');
    $context['travel_desc_more'] = get_field('travel_description_more', 'option');
    $context['hero_book_now'] = get_field('hero_book_now_button', 'option');
    $context['hero_already_booked'] = get_field('hero_already_booked_button', 'option');
    $context['hero_already_booked_url'] = get_field('hero_already_booked_url', 'option');
    $context['mailing_cta'] = transform_piped_header(get_field('mailing_list_call_to_action', 'option'));
    $context['cruise_fb'] = get_field('link_to_facebook_page', 'option');
    $context['cruise_twitter'] = get_field('link_to_twitter', 'option');
    $context['cruise_rss'] = get_field('link_to_rss_feed', 'option');
    $context['cruise_insta'] = get_field('link_to_instagram', 'option');
    $context['talent_header'] = transform_piped_header(get_field('talent_section_header', 'option'));
    $context['talent_intro_para'] = get_field('performer_intro_content', 'option');
    $context['performer_header'] = transform_piped_header(get_field('performer_header', 'option'));
    $context['featuredguest_header'] = transform_piped_header(get_field('featured_guest_header', 'option'));
    $context['evenmore_header'] = transform_piped_header(get_field('even_more_header', 'option'));
    $context['coming_soon_header'] = transform_piped_header(get_field('coming_soon_header', 'option'));
    $context['cont_gen_q'] = get_field('general_questions_header', 'option');
    $context['cont_gen_q_addy'] = get_field('general_questions_address', 'option');
    $context['cont_book_q'] = get_field('booking_questions_header', 'option');
    $context['cont_book_q_addy'] = get_field('booking_questions_address', 'option');
    $context['cont_tel'] = get_field('phone_questions_header', 'option');
    $context['cont_tel_addy'] = get_field('phone_questions_number', 'option');
    $context['map_copy'] = get_field('map_info_copy', 'option');
    $context['news_header'] = get_field('news_header', 'option');
    $context['news_view_all'] = get_field('news_view_all_copy', 'option');
    $context['news_view_url'] = get_field('news_view_all_url', 'option');
    $context['faq_section_headers_ordered'] = array_map('trim', explode('\n', get_field('faq_categories', 'option')));
    $context['footer_text'] = trim(get_field('footer_text', 'option'));
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
    $context['meta_desc'] = htmlentities(wp_strip_all_tags($settings['mac_travel_description']), ENT_QUOTES);
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
