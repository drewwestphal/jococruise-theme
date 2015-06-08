<?php add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup()
{
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $cruise_year;
$cruise_year = "2016";
$cruise_year = $cruise_year=="2016" ? "" : $cruise_year;
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;

}
include('mac_options.php');
add_filter( 'pre_get_posts', 'my_get_posts' );

function my_get_posts( $query ) {

	if ( is_home() && $query->is_main_query() || is_feed() )
		$query->set( 'post_type', array( 'post', 'page', 'artist' ) );

	return $query;
}
function mac_register_theme_menu() {
    register_nav_menu( 'primary', 'Main Nav' );
}

// support fb embeds with proper meta tags ...
add_action('wp_head', function(){

    $settings = get_option('mac_settings');
    $site_title = get_bloginfo('name');
    $travel_desc = $settings['mac_travel_description'];

    $url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}";
    $imgurl1 = get_template_directory_uri() . '/img/hero_boat.png';
    $imgurl2 = get_template_directory_uri() . '/img/og2.jpg';
    $desc = htmlentities(wp_strip_all_tags($travel_desc), ENT_QUOTES);
    echo <<<EOF
        <meta name="description" content="$desc" />

        <!-- Twitter Card data -->
        <meta name="twitter:card" value="summary">

        <!-- Open Graph data -->
        <meta property="og:title" content="$site_title" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="$url" />
        <meta property="og:image" content="$imgurl1" />
        <meta property="og:image" content="$imgurl2" />
        <meta property="og:description" content="$desc" />

EOF;
});

add_action('wp_footer', function(){
        echo <<<EOF
        <script type="text/javascript">
            // open external links in new tab
            jQuery('#content').find('a').filter(function() {
                return this.hostname && this.hostname.indexOf(location.hostname)===-1
            }).attr({
                target : "_blank"
            });
        </script>
EOF;
});


/*custom nav behavior*/
function mac_clean_menu() {
	$menu_name = 'primary';
	if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
		$menu = wp_get_nav_menu_object($locations[$menu_name]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		$menu_list='';
		foreach ((array) $menu_items as $key => $menu_item) {
			$has_parent = $menu_item->menu_item_parent;
			$child = '';
			if ($has_parent > 0){
				$child = ' class="child"';
			}
			$title = $menu_item->title;
			$url = $menu_item->url;
			$menu_list .= "\t\t\t\t\t". '<li'.$child.'><a href="'. $url .'"><span>'. $title .'</span></a></li>' ."\n";
		}
	} else {
		// $menu_list = '<!-- no list defined -->';
	}
	echo $menu_list;
}

// sorry double quotes will break acf
$faq_section_headers_ordered = array(
    "What the Heck?",
    "Booking Questions",
    "I’m Booked! Now What?",
    "Managing my Booking",
);
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
    get_template_directory_uri() . '/css/bootstrap.min.css',//
     array(), 1, 'screen');

    wp_register_style('reset', //
    get_template_directory_uri() . '/css/reset.css', //
    array(
        'bootstrapcss',
    ), 1, 'screen');


    // magnific
    // it is just registered here
    // call it a dep to include it on a page
    wp_register_script('magnificjs',//
    get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', //
     array('jquery'), 1, true);
    wp_register_style('magnificcss',//
    get_template_directory_uri() . '/css/magnific-popup.css', //
     array(), 1, true);


    
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
    
    wp_enqueue_style('macstyle', //
    get_template_directory_uri() . '/style.css', //
    $maindeps, 1, 'screen');

    // according to this place you don't wanna enqueue shit on the admin side...
    //http://digwp.com/2009/06/use-google-hosted-javascript-libraries-still-the-right-way/
    if(!is_admin()) {
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array(), 1, false);
        wp_enqueue_script('recaptcha', '//www.google.com/recaptcha/api.js', array(), 1, false);
		if ( wp_is_mobile() ) {
	        wp_enqueue_script('jquery_mobile', get_template_directory_uri() . '/js/jquery.mobile.custom.min.js', array(), 1, false);
		}
        
        // this is also just for the front-end
        //bootstrap.js is dependant on jquery
        wp_enqueue_script('bootstrapjs',//
        get_template_directory_uri() . '/js/bootstrap.min.js', //
         array('jquery'), 1, false);
        
    }

    // home directory scripts
    if(is_home() || is_page( 'The Experience' )) {
        wp_enqueue_script('js_behavior', get_template_directory_uri() . '/js/js_behavior.js', array('jquery'), 1, true);
        wp_enqueue_script('js_contact', get_template_directory_uri() . '/js/js_contact.js', array(
            'jquery',
            'js_behavior'
        ), '1', true);
        wp_localize_script('js_contact', 'js_contact_data', //
        array('contact_post_url' => get_template_directory_uri() . '/contact.php'));
    }
    
    if(is_page('The Experience')) {
        wp_enqueue_script('js_experience',//
        get_template_directory_uri() . '/js/js_experience.js', //
         array('magnificjs'), 1, false);
		wp_enqueue_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array(), 1, false);
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
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}
require_once(__DIR__.'/include/acf.php');
require_once(__DIR__.'/include/cpt.php');
require_once(__DIR__.'/include/columns.php');

function is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

if(!is_admin() && !is_login_page()) {
	require_once(__DIR__.'/page-experience-gallery.php');
}
?>