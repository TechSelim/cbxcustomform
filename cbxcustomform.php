<?php
/**
 * Plugin Name:       CBX Custom Form
 * Plugin URI:        https://codeboxr.com/product/rss-feed-manager-for-custom-post-types
 * Description:       This plugin is only for testing purpose
 * Version:           1.0.0
 * Author:            Codeboxr Team
 * Author URI:        http://codeboxr.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cbxcustomform
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) )
    exit;

/**
 * require file
*/
require_once plugin_dir_path( __FILE__ ) . '/includes/shortcode.php';
require_once plugin_dir_path( __FILE__ ) . '/includes/nq-scripts.php';
require_once plugin_dir_path( __FILE__ ) . '/includes/form-handler.php';
require_once plugin_dir_path( __FILE__ ) . '/includes/custom-posts.php';
require_once plugin_dir_path( __FILE__ ) . '/includes/cbxcf-postmeta.php';

final class CBX_Custom_Form{

    /**
     * plugin version 
    */
    const version = '1.0.0';

    /**
     * Construct
     */
    private function __construct() {
        /**
         * define constants 
        */
        $this->define_constants();

        /**
         * Enque Scripts
        */
        new Nq_Scripts();

        /**
         * make instance of CBXCF_Shortcode
        */
        new CBXCF_Shortcode();
        
        /**
         * instance of Form_Handler if there any ajax request 
        */
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            new Form_Handler();
        }

        /**
         * register custom post cbxcustom
        */
        new CBXCustom_Posts();

        /**
         * Custom post meta
        */
        new CBXCF_Postmeta();
    }

    /**
     * Setup Instance
     * 
     * @return instance
     */
    public static function instance() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'CBXCF_VERSION', self::version );
        define( 'CBXCF_FILE', __FILE__ );
        define( 'CBXCF_PATH', __DIR__ );
        define( 'CBXCF_URL', plugins_url( '', CBXCF_FILE ) );
        define( 'CBXCF_ASSETS', CBXCF_URL . '/assets' );
    }

}

/**
 * Initializes the main class
 * 
 * @return instance of CBX_Custom_Form
 */
function cbxcf_init() {
    return CBX_Custom_Form::instance();
}

/**
 * call cbxcf_init function
*/
cbxcf_init();