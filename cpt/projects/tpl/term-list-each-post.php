<?php
	$terms = get_the_terms(get_the_ID(), $ptTaxKey);
	if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
		foreach ($terms as $term) {
			$term_link = get_term_link( $term );
			echo '<li>'.$term->name.'<span>'.' /'.'</span></li>';
		}
	}
?>