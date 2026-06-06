<?php
	$term_slugs_list = wp_get_post_terms( get_the_ID(), $ptTaxKey, array("fields" => "slugs") );
	// Handle potential WP_Error
	if ( is_wp_error( $term_slugs_list ) ) {
		$term_slugs_list = array();
	}
	$term_slugs_list_string = implode( ' ', $term_slugs_list );
?>