<?php
/**
 * CMB2 Theme Options
 * @version 0.1.0
 *
 * modified from from https://github.com/WebDevStudios/CMB2-Snippet-Library/blob/master/options-and-settings-pages/theme-options-cmb.php
 *
 */
class CCTheme_Admin {

    /**
     * Option key, and option page slug
     * @var string
     */
    private $key = null;

    /**
     * Options page metabox id
     * @var string
     */
    private $metabox_id = null;

    /**
     * Options Page title
     * @var string
     */
    protected $title = null;

    /**
     * Options Page hook this is filled in add_options_page by wp
     * @var string
     */
    protected $options_page = null;

    /**
     * Fields to add to options page
     *
     * Numerically index array with
     * subarrays like so
     *
     * array(
     'name' => __( 'Test Text', 'cctheme' ),
     'desc' => __( 'field description (optional)', 'cctheme' ),
     'id'   => 'test_text',
     'type' => 'text',
     'default' => 'Default Text',
     )
     *
     *
     * @var array
     */
    protected $field_array = null;

    static $singleton_instance = null;

    /**
     * Constructor
     * @since 0.1.0
     */
    public function __construct() {
        // Set our title
        $this -> title = $_ENV['CCTHEMEADMIN_OPTION_PAGE_TITLE'];
        $this -> key = $_ENV['CCTHEMEADMIN_OPTION_PAGE_KEY'];
        $this -> metabox_id = $_ENV['CCTHEMEADMIN_OPTION_PAGE_METABOXID'];
        $this -> field_array = $_ENV['CCTHEMEADMIN_OPTION_PAGE_FIELDS'];

        // run hooks
        add_action('admin_init', array(
            $this,
            'init'
        ));
        add_action('admin_menu', array(
            $this,
            'add_options_page'
        ));
        add_action('cmb2_init', array(
            $this,
            'add_options_page_metabox'
        ));
        add_filter('cmb2_meta_box_url', function($url) {
            // this function is retardedly implemented...
            // gives me great faith in the rest of their work!
            return plugins_url() . '/cmb2';
        });

    }

    /**
     * Register our setting to WP
     * @since  0.1.0
     */
    public function init() {
        register_setting($this -> key, $this -> key);
    }

    /**
     * Add menu options page
     * @since 0.1.0
     */
    public function add_options_page() {
        $this -> options_page = add_menu_page($this -> title, $this -> title, 'manage_options', $this -> key, array(
            $this,
            'admin_page_display'
        ));

        // Include CMB CSS in the head to avoid FOUT
        add_action("admin_print_styles-{$this->options_page}", array(
            'CMB2_hookup',
            'enqueue_cmb_css'
        ));
    }

    /**
     * Admin page markup. Mostly handled by CMB2
     * @since  0.1.0
     */
    public function admin_page_display() {
        printf('<div class="wrap cmb2-options-page %s"><h2>%s</h2>', //
        $this -> key, //
        esc_html(get_admin_page_title()));
        cmb2_metabox_form($this -> metabox_id, $this -> key, array('cmb_styles' => false));
        echo "</div>";
    }

    /**
     * Add the options metabox to the array of metaboxes
     * @since  0.1.0
     */
    function add_options_page_metabox() {

        $cmb = new_cmb2_box(array(
            'id' => $this -> metabox_id,
            'hookup' => false,
            'show_on' => array(
                // These are important, don't remove
                'key' => 'options-page',
                'value' => array($this -> key, )
            ),
        ));

        // Set our CMB2 fields
        foreach($this->field_array as $fa) {
            $cmb -> add_field($fa);
        }
    }

    /**
     * Public getter method for retrieving protected/private variables
     * @since  0.1.0
     * @param  string  $field Field to retrieve
     * @return mixed          Field value or exception is thrown
     */
    public function __get($field) {
        // Allowed fields to retrieve
        if(in_array($field, array(
            'key',
            'metabox_id',
            'title',
            'options_page'
        ), true)) {
            return $this -> {$field};
        }

        throw new Exception('Invalid property: ' . $field);
    }

    /**
     * THIS IS A SINGLETON CLASS
     *
     * from http://www.phptherightway.com/pages/Design-Patterns.html#singleton
     *
     */
    public static function getInstance() {
        static $instance = null;
        if(null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function cctheme_get_option($key = '') {
    return cmb2_get_option(CCTheme_Admin::getInstance() -> key, $key);
}
?>