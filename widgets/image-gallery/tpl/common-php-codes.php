<?php
	$masonry_tiles_image_size_class = '';
	$full_image_url                 = '';
	$thumbnail                      = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

	if ( ! empty( $thumbnail[0] ) ) {
		$full_image_url = $thumbnail[0];
	}

	$gallery_images = array();
	if ( function_exists( 'rwmb_meta' ) ) {
		$gallery_meta = rwmb_meta( 'unique_addons_gallery_mb_settings', array( 'size' => 'full' ), get_the_ID() );
		if ( is_array( $gallery_meta ) && ! empty( $gallery_meta ) ) {
			$gallery_images = $gallery_meta;
		}
	}

	if ( ! has_post_thumbnail( get_the_ID() ) ) {
		if ( ! empty( $gallery_images ) ) {
			$first_image    = reset( $gallery_images );
			$full_image_url = is_array( $first_image ) && isset( $first_image['full_url'] ) ? $first_image['full_url'] : '';
		}

		if ( empty( $full_image_url ) ) {
			$full_image_url = 'https://placehold.co/1920x1080?text=Image+Not+Found';
		}
	}

	$term_slugs_list = wp_get_post_terms( get_the_ID(), $ptTaxKey, array( 'fields' => 'slugs' ) );
	$term_names_list = wp_get_post_terms( get_the_ID(), $ptTaxKey, array( 'fields' => 'names' ) );

	$params['full_image_url']           = $full_image_url;
	$params['gallery_images']           = $gallery_images;
	$params['term_names_list_string']   = implode( ', ', $term_names_list );
	$term_slugs_list_string             = implode( ' ', $term_slugs_list );

	if ( $use_masonry_tiles_featured_image_size == 'yes' ) :
		$meta_featured_image_size = '';
		if ( function_exists( 'rwmb_meta' ) ) {
			$meta_featured_image_size = rwmb_meta( 'masonry_tiles_featured_image_size', array(), get_the_ID() );
		}

		$params['featured_image_size']    = $meta_featured_image_size;
		$masonry_tiles_image_size_class   = 'tm-masonry-default';

		switch ( $meta_featured_image_size ) {
			case 'uae_height':
				$masonry_tiles_image_size_class = 'tm-masonry-large-height';
				break;

			case 'uae_wide':
				$masonry_tiles_image_size_class = 'tm-masonry-large-wide';
				break;

			case 'uae_width_height':
				$masonry_tiles_image_size_class = 'tm-masonry-large-width-height';
				break;

			case 'default':
				$masonry_tiles_image_size_class = 'tm-masonry-default';
				$params['featured_image_size']  = $featured_image_size;
				break;
		}

		if ( $params['display_type'] != 'masonry-tiles' ) {
			$masonry_tiles_image_size_class = '';
		}
	endif;
?>
