=== Primary Category ===
Contributors: aftab.alam8028
Tags: search, taxonomy, category
Donate link: https://aftabablog.wordpress.com
Requires at least: 3.0.1
Tested up to: 5.7.2
Requires PHP: 5.6
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The plugin enables the admin/editor to select a Primary Category for each post.
Website Visitors can search the content based on the Primary Category.

== Description ==

The plugin enables the admin/editor to select a Primary Category for each post.
It adds a Primary Category Metabox to Post content type and admin can select a Primary Category.
Website Visitors can search the content based on the Primary Category.
This plugins also helps in adding the Primary Category Metabox for different post types with help of "primary_category_cpt" filter.

== Installation ==
 
This section describes how to install the plugin and get it working.
1. Download the zip of this file.
2. Extract the zip and place it in wp-content/plugins/ folder.
3. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Can we add Primary Category Metabox to other Custom Post type?
Ans : Yes you can use the filter 'primary_category_cpt' to extend it.
Eg : Add it in your active theme functions.php file

`<?php
/**
 * 
 * Return all the post type for which Primary Category should be activated.
 * 
 * @param array $post_type default post type as post
 * 
 * @return array all post type slug.
 */
function get_primary_category_cpt( $post_type ) {
    return array( 'post', 'post-type-2' );
}
add_filter( 'primary_category_cpt', 'get_primary_category_cpt', 10 );`
