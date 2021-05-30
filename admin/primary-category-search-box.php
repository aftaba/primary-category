<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Define the functionality related to search.
 *
 * Modify the search box by adding the category dropdown with it. Also change the 
 * WP_query to include the category while searching.
 * 
 * @since      1.0.0
 * @package    Primary_Category
 * @subpackage Primary_Category/admin
 * @author     Aftab Alam <aftab.alam8028@gmail.com>
 */
class Primary_Category_Search_Box {
 
    /**
     * Constructor.
     */
    public function __construct() {
        
        add_filter( 'get_search_form', array( $this, 'modify_search_form_and_add_category' ) );
        add_filter( 'pre_get_posts', array( $this, 'modifty_search_result' ), 10, 3 );
        //add_filter( 'get_search_query', array( $this, 'modify_search_title' ) );
    }


    /**
     * Modify the default search form and add a category drop down.
     * 
     * @param string the default HTML displays for search form.
     * 
     * @return string the modifed HTML for search form.
     */
    function modify_search_form_and_add_category( $form ) {
        
        ob_start(); ?>
            <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                <label>
                    <span class="screen-reader-text">Search For</span>
                    <input type="search" class="search-field" placeholder="Search..." value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="Search for:" />
                </label>
                <?php
                    
                    $primary_category_id = 0; // by default select "Any Category"
                    
                    if ( isset( $_GET[ "primary_category_id" ] ) ) {
                        $primary_category_id = intval( sanitize_text_field( $_GET[ "primary_category_id" ] ) ); 
                    }
                    
                    $swp_cat_dropdown_args = array(
                        'show_option_all' => __( 'Any Category' ),
                        'hide_empty'      => false,
                        'name'            => 'primary_category_id',
                        'selected'        => $primary_category_id,
                    );
                    
                    wp_dropdown_categories( $swp_cat_dropdown_args );
                ?>
                <input type="submit" class="search-submit" value="Search" />
            </form>
        <?php return ob_get_clean();
    }

    /**
     * Modify the WP_Query and run meta_query.
     * 
     * @param object default WP_Query
     * 
     * @return object modified WP_Query
     */
    function modifty_search_result( $q ) {
        
        // check if primary category is being queried.
        if ( isset( $_GET[ "primary_category_id" ] ) ) {
            
            $primary_category_id = intval( sanitize_text_field( $_GET[ "primary_category_id" ] ) );

            // Only modify the main query on the front-end:
            if ( $primary_category_id > 0 && is_search() && ! is_admin() && $q->is_main_query() ) {
                
                $meta_query = array(
                    array(
                        "key"     => "_primary_category_id",
                        "value"   => $primary_category_id,
                    ),
                );
                $q->set( 'meta_query', $meta_query );
            }

        }

    }

    /**
     * Alter the search title and add category also.
     * 
     * @param string default search text 
     * 
     * @return string updated search text
     */
    function modify_search_title( $search_text ){
        
        if ( isset( $_GET[ "primary_category_id" ] ) ) {
            
            $primary_category_id = intval( sanitize_text_field( $_GET[ "primary_category_id" ] ) );
            
            if ( $primary_category_id > 0 ) {
                
                $term_name = get_term( $primary_category_id )->name;
                $search_text = 
                $search_text = "\"$search_text\" and Category : \"$term_name\"";
            }
        }
        
        return $search_text;
    }

}
 
