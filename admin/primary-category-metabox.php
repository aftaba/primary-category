<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Define meta box and list category in dropdown.
 *
 * Add a custom metabox for listing all category in dropdown so that user can 
 * choose it and make it a primary category.
 *
 * @since      1.0.0
 * @package    Primary_Category
 * @subpackage Primary_Category/admin
 * @author     Aftab Alam <aftab.alam8028@gmail.com>
 */
class Primary_Category_Metabox {
 
    /**
     * Constructor.
     */
    public function __construct() {
        if ( is_admin() ) {
            add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
            add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
        }
 
    }
 
    /**
     * Meta box initialization.
     */
    public function init_metabox() {
        add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
        add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );
    }


    /**
     * Adds the meta box.
     */
    public function add_metabox() {
        
        $post_type = $this->get_post_type();
        add_meta_box(
            'primary-category',
            __( 'Primary Category', 'textdomain' ),
            array( $this, 'render_metabox' ),
            $post_type,
            'side',
            'default'
        );
 
    }
 
    /**
     * 
     * Defines the filter so that user can change return the custom post type for which they want to add the Primary Category MetaBox.
     * 
     * @param null
     * 
     * @return array items with all slug of different post types.
     */
    public function get_post_type( ) {
        
        return apply_filters( 'primary_category_cpt', array( 'post' ) );
    }
    
    /**
     * Renders the meta box.
     */
    public function render_metabox( $post ) {

        // Add nonce for security and authentication.
        wp_nonce_field( 'primary_category_action', 'primary_category' );
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/meta-box-content.php';
    }
 
    /**
     * Handles saving the meta box.
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post    Post object.
     * @return null
     */
    public function save_metabox( $post_id, $post ) {
        // Add nonce for security and authentication.
        $nonce_name   = isset( $_POST['primary_category'] ) ? $_POST['primary_category'] : '';
        $nonce_action = 'primary_category_action';
 
        // Check if nonce is valid.
        if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
            return;
        }
 
        // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
 
        // Check if not an autosave.
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }
 
        // Check if not a revision.
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }

        // Update the Primary Category in post_meta table.
        if ( isset( $_POST[ "primary_category_id" ] ) ) {
            
            $primary_category_id = intval( sanitize_text_field( $_POST[ "primary_category_id" ] ) ); 
            update_post_meta( $post_id, "_primary_category_id", esc_attr( $primary_category_id ) );

        }
    }
}
 
