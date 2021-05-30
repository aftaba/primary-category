<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Adds a custom column in WP Post Listing
 *
 * Added a custom column for displaying the selected Primary Category name in
 * newly added custom column.
 *
 * @since      1.0.0
 * @package    Primary_Category
 * @subpackage Primary_Category/admin
 * @author     Aftab Alam <aftab.alam8028@gmail.com>
 */
class Primary_Category_Column {
 
    /**
     * Constructor.
     */
    public function __construct() {
        
        add_filter( 'manage_post_posts_columns', array( $this, 'add_new_column_primary_category' ) );
        add_action( 'manage_post_posts_custom_column' , array( $this, 'display_column_primary_category_value' ), 10, 2 );


    }
 
    /**
     * Add a custom column for display Primary Category in WP Post Listing.
     * 
     * @param array the default column values.
     * 
     * @return array the modified column values.
     */
    function add_new_column_primary_category( $columns ) {
        
        $columns['primary-category'] = __( 'Primary Category', 'primary-category' );
        return $columns;
    }

    /**
     * Display the value of Primary Category in WP Post Listing.
     * 
     * @param array the default column values.
     * @param int the post id
     * 
     * @return string the value to be displayed.
     */
    function display_column_primary_category_value( $column, $post_id ) {
        
        switch ( $column ) {
            case 'primary-category' :
                $primary_category_id = get_post_meta( $post_id, '_primary_category_id', true );
                
                if ( $primary_category_id && $primary_category_id > 0 ) {

                    $term_name = get_term( $primary_category_id )->name;
                    echo $term_name;
                }
                break;
        }
    }
}
 
