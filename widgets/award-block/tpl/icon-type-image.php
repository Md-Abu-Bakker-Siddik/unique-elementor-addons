
		<?php
			$image_alt = get_post_meta($image_icon['id'], '_wp_attachment_image_alt', TRUE);
		?>
<img src="<?php $image = wp_get_attachment_image_src( $image_icon['id'], $image_icon_predefined_image_size); echo esc_url( $image[0] );?>" <?php if( !empty( $image_icon_custom_size ) ) echo 'width="'.$image_icon_custom_size.'"'; ?> alt="<?php echo esc_html( $image_alt ) ?>">