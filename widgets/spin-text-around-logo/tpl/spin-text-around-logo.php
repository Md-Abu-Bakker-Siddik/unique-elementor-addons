<div class="spin-text-around-logo">
	<?php if( isset( $spin_image ) && !empty( $spin_image ) ): ?>
		<?php
			$image_alt = get_post_meta($spin_image['id'], '_wp_attachment_image_alt', TRUE);
		?>
	<img class="spin-img" src="<?php $image = wp_get_attachment_image_src( $spin_image['id'], 'full'); echo esc_url( $image[0] );?>" alt="<?php echo esc_html( $image_alt ) ?>">
	<?php endif; ?>
	<span class="letter"><?php echo esc_html( $text );?></span>
</div>