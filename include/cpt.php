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

/**
 * Custom Post Types Supporting the
 * THE EXPERIENCE
 * Page
 *
 */
// dw custom
add_action('init', function() {
    // piecse of the experience page
    register_post_type('experience', array(
        'label' => 'experience',
        'description' => '',
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        // these apparently block front end visibility
        // along with making the creation of new posts impossible
        'hierarchical' => false,
        'public' => false,
        'has_archive' => false,
        'publicly_queryable' => false,
        'capabilities' => array('create_posts' => false, ),
        'rewrite' => array(
            'slug' => 'experience',
            'with_front' => true
        ),
        'query_var' => false,
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
            'name' => 'Experience Pieces',
            'singular_name' => 'Experience Piece',
            'menu_name' => 'The Experience',
            'add_new' => 'Add New Experience Piece',
            'add_new_item' => 'Add New Experience Piece',
            'edit' => 'Edit',
            'edit_item' => 'Edit Experience Piece',
            'new_item' => 'New Experience Piece',
            'view' => 'View Experience Pieces',
            'view_item' => 'View Experience Piece',
            'search_items' => 'Search Experience Pieces',
            'not_found' => 'No Experience Pieces Found',
            'not_found_in_trash' => 'No Experience Pieces Found in Trash',
            'parent' => 'Parent Experience Pieces',
        )
    ));

    // featured events
    register_post_type('featured-event', array(
        'label' => 'featured-event',
        'description' => '',
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        // these apparently block front end visibility
        'hierarchical' => false,
        'public' => false,
        'has_archive' => false,
        'publicly_queryable' => false,
        'rewrite' => array(
            'slug' => 'featured-event',
            'with_front' => true
        ),
        'query_var' => false,
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
            'name' => 'Featured Events',
            'singular_name' => 'Featured Event',
            'menu_name' => 'Featured Events (Exp. Pg.)',
            'add_new' => 'Add New Featured Event',
            'add_new_item' => 'Add New Featured Event',
            'edit' => 'Edit',
            'edit_item' => 'Edit Featured Event',
            'new_item' => 'New Featured Event',
            'view' => 'View Featured Events',
            'view_item' => 'View Featured Event',
            'search_items' => 'Search Featured Events',
            'not_found' => 'No Featured Events Found',
            'not_found_in_trash' => 'No Featured Events Found in Trash',
            'parent' => 'Parent Featured Events',
        )
    ));
});

/**
 * Prepopulate experience pieces...
 * This array contains name, title, and content for the posts
 * If a post with that name does not exist, it will be created
 * and populated with the dummy content and title given here.
 * This is partly for convenience, but also because
 * posts cannot be created on the front end
 */
//var_dump(get_page_by_path('intro-post'));
$pieces = array(//
    array(
        'post_name' => 'exp-intro',
        'post_title' => 'What is the JoCo Cruise?',
        'post_content' => "
<p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse a sem a felis placerat egestas. In laoreet purus augue, non egestas tellus lobortis non. Proin sit amet leo ut risus pellentesque ornare in a urna.
</p>

<p>
    Quisque rutrum, diam vitae porttitor convallis, lorem purus tempus mi, a mattis magna turpis vel nisl. Nullam ullamcorper lacinia ornare. Suspendisse potenti. Ut vel volutpat purus, in aliquam massa. Quisque convallis erat vel tortor feugiat, mollis aliquet sapien dictum. Pellentesque luctus ultricies euismod.
</p>

<p>
    Nam viverra placerat ante non hendrerit.
</p>
        ",
    ),
    array(
        'post_name' => 'exp-main-stage',
        'post_title' => 'On the | Main Stage',
        'post_content' => "
<p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse a sem a felis placerat egestas. In laoreet purus augue, non egestas tellus lobortis non. Proin sit amet leo ut risus pellentesque ornare in a urna.
</p>
        ",
    ),
    array(
        'post_name' => 'exp-featured-events-header',
        'post_title' => 'JoCo Cruise 2016 | Featured Events',
        'post_content' => "",
    ),
    array(
        'post_name' => 'exp-gaming-track',
        'post_title' => 'The Gaming Track &amp; 24/7 Game Room',
        'post_content' => "
        <p>
        Discover new games, play in tournaments, be part of beta tests, and meet the game makers behind some of your favorites. Response to Official gaming events was so great in 2015 that we’ll be making even more room for them in this year’s schedule; look for details in the coming months.
        </p>
        ",
    ),
    array(
        'post_name' => 'exp-writing-track',
        'post_title' => 'The Writing Track',
        'post_content' => "
        <p>
        Meet and learn from the greats!  Led by New York Times bestseller, handsome devil, and veteran Sea Monkey                 John Scalzi, JoCo Cruise’s Official Writing Track will feature panels, readings, and hangouts throughout the week. Look for more information in the coming months.
        </p>
        ",
    ),
    array(
        'post_name' => 'exp-community',
        'post_title' => 'The Shadow Cruise | Our Amazing Community',
        'post_content' => "
        <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.
        </p>
        <ul>
        <li>Cocktail Parties</li><li>
        Dance Parties</li><li>
        Karaoke Parties</li><li>
        Beach Parties</li><li>
        Panel Discussions</li><li>
        Open Mics</li><li>
        Song Circles</li><li>
        Meetups</li><li>
        Movie Nights</li><li>
        and so much more!</li>
        </ul>
        ",
    ),
    array(
        'post_name' => 'exp-photos-gallery',
        'post_title' => 'Photos and Videos',
        'post_content' => "
        insert the gallery here using the media box
        ",
    ),
    array(
        'post_name' => 'exp-more-info',
        'post_title' => 'More Information and Links',
        'post_content' => "
<p>
    Listen, we can’t possibly be lying about how much fun this thing is, because there’s no way we could plant this much stuff all over the internet.
</p>
<p>
    You can see what people say in the Jonathan Coulton forums,
    <br/>
    Join the JCC2016 Facebook group (this is a closed group, you’ll need to request membership),
    <br/>
    Watch a ton of other videos on YouTube,
    <br/>
    or Read about past/future cruises in the Jonathan Coulton wiki.
    <br/>
</p>
<p>
    It really is great, and we really hope you join us.
</p>
",
    ),
);
foreach($pieces as $piece) {
    if(!get_page_by_path($piece['post_name'], OBJECT, 'experience')) {
        wp_insert_post(array(
            'post_name' => $piece['post_name'],
            'post_title' => $piece['post_title'],
            'post_content' => $piece['post_content'],
            'post_status' => 'publish',
            'post_type' => 'experience',
            'ping_status' => 'closed',
        ), true);
    }

}
?>