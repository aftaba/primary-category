<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Primary_Category
 * @subpackage Primary_Category/admin
 * @author     Aftab Alam <aftab.alam8028@gmail.com>
 */
class Primary_Category_i18n {

    /**
     * Constructor.
     */
    public function __construct() {
        
        add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
    }

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'primary-category',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
