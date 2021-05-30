<?php

// Get all the categories
$args = array(
    "hide_empty" => false,
);
$terms = get_categories( $args );

// Get the saved primary category id from post_meta
$primary_category_id = get_post_meta( $post->ID, '_primary_category_id', true );
?>

<!-- HTML to render the metabox -->
<select name="primary_category_id">
	<option value="0"> -- Select -- </option>
	<?php foreach( $terms as $term ) : ?>
		<option <?php selected( $primary_category_id, $term->term_id ); ?> value="<?php echo esc_attr( $term->term_id ); ?>"> <?php echo esc_attr( $term->name ); ?> </option>
	<?php endforeach; ?>
</select>