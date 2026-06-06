<?php
	$terms = get_the_terms(get_the_ID(), $ptTaxKey);
	if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
		foreach ($terms as $term) {
			echo '<li><a href="'.get_term_link($term->slug, $ptTaxKey).'">'.$term->name.'</a><span>,</span></li>';
		}
	}
?>