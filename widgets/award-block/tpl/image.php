
		<?php
			$image_alt = get_post_meta($featured_image['id'], '_wp_attachment_image_alt', TRUE);
		?>
        <?php if( isset( $featured_image['id'] ) && !empty( $featured_image['id'] ) ): ?>
          <img src="<?php $image = wp_get_attachment_image_src( $featured_image['id'], $featured_image_size); echo esc_url( $image[0] );?>" alt="<?php echo esc_html( $image_alt ) ?>">
        <?php endif; ?>