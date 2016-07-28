<?php add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup()
{
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;

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

add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'blankslate' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
function blankslate_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?><
/li>
<?php
}
add_filter( 'get_comments_number', 'blankslate_comments_number' );
function blankslate_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
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
    require_once(__DIR__.'/include/acf.php');
});

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
    include __DIR__.'/theme_variables.php';

    $context['settings'] = $settings;
    $context['site_title'] = $site_title;
    $context['cruise_year'] = $cruise_year;
    $context['cruise_year'] = $cruise_year;
    $context['faq_section_headers_ordered'] = $faq_section_headers_ordered;
    $context['booking_url'] = $booking_url;
    $context['hero_book_now'] = $hero_book_now;
    $context['hero_already_booked'] = $booked;
    $context['hero_already_booked_url'] = $booked_url;
    $context['booking_enabled'] = $booking_enabled;
    $context['booking_cta'] = $booking_cta;
    $context['cruise_fb'] = $cruise_fb;
    $context['cruise_twitter'] = $cruise_twitter;
    $context['cruise_rss'] = $cruise_rss;
    $context['travel_desc'] = $travel_desc;
    $context['travel_desc_more'] = $travel_desc_more;
    $context['cont_gen_q'] = $cont_gen_q;
    $context['cont_gen_q_addy'] = $cont_gen_q_addy;
    $context['cont_book_q'] = $cont_book_q;
    $context['cont_book_q_addy'] = $cont_book_q_addy;
    $context['cont_tel'] = $cont_tel;
    $context['cont_tel_addy'] = $cont_tel_addy;
    $context['map_copy'] = $map_copy;
    $context['news_header'] = $news_header;
    $context['news_view_all'] = $news_view_all;
    $context['news_view_url'] = $news_view_url;
    $context['footer_text'] = $footer_text;
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

    $context['mailing_cta'] = transform_piped_header(jcctheme_get_option('mac_mailing_list_cta'));
    $context['talent_header'] = transform_piped_header(jcctheme_get_option('mac_talent_header'));
    $context['talent_intro_para'] = jcctheme_get_option('mac_talent_intro_para');
    $context['talent_year'] = jcctheme_get_option('mac_talent_year');
    $context['performer_header'] = transform_piped_header(jcctheme_get_option('mac_performer_header'));
    $context['featuredguest_header'] = transform_piped_header(jcctheme_get_option('mac_featuredguest_header'));
    $context['evenmore_header'] = transform_piped_header(jcctheme_get_option('mac_evenmore_header'));
    $context['coming_soon_header'] = transform_piped_header(jcctheme_get_option('coming_soon_header'));
    $context['cruise_insta'] = jcctheme_get_option('mac_insta_url');

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
