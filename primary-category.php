<?php

/**
 * Plugin Name:       Primary Category
 * Plugin URI:        https://10up.com
 * Description:       Create a Primary Category Field for Post and allow user to query content based on that.
 * Version:           1.0.4
 * Author:            Aftab Alam
 * Author URI:        http://aftabablog.wordpress.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       primary-category
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


class Primary_Category{

    /**
     * Stores the plugin path.
     *  
     */
    protected $plugin_path;


    /**
     * Stores the unique plugin name.
     *  
     */
    protected $plugin_name;

    /**
     * Constructor.
     */
    public function __construct() {
        
        $this->plugin_path = plugin_dir_path( __FILE__ );
        $this->plugin_name = "primary-category";
        
        $this->set_locale();
        $this->load_dependencies();
        $this->run();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * @param null
     * 
     * @return null
     */
    private function set_locale() {
        
        /**
         * Class to handle the internationalization of text.
         */
        require_once $this->plugin_path . '/admin/primary-category-i18n.php';
        new Primary_Category_i18n();
    }

    /**
     * Load all the dependent classes for this plugin
     * 
     * @param null
     * 
     * @return null
     */
    private function load_dependencies() {
        
        /**
         * Class to handle the metabox fields for Primary Category and saving it in database.
         */
        require_once $this->plugin_path . '/admin/primary-category-metabox.php';
        
        /**
         *  Class to display a new column in WP Post Listing for chosen Primary Category.
         */
        require_once $this->plugin_path . '/admin/primary-category-column.php';
        
        /**
         *  Class to alter the search form and also changing WP_Query to display filtered result.
         */
        require_once $this->plugin_path . '/admin/primary-category-search-box.php';
    }


    /**
     * Run by initialising all the classes.
     * 
     * @param null
     * 
     * @return null
     */
    private function run() {
        
        /**
         *  Inialize all classes.
         */
        new Primary_Category_Metabox();
        new Primary_Category_Column();
        new Primary_Category_Search_Box();
    }
}

new Primary_Category();