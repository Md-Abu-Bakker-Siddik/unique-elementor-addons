<div class="tm-sc-image-with-rotated-text <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<div class="image-text-wrapper">
		<?php if ( ! empty( $image_rotate_text ) ) : ?>

			<?php if ($text_position === 'bottom-left' || $text_position === 'top-left' ) : ?>
				<div class="text-holder" style="<?php echo esc_attr( $text_inline_css ); ?>">
					<div class="text-inner">
						<div class="text <?php echo esc_attr( $text_class ); ?>"><?php echo esc_html($image_rotate_text); ?></div>
					</div>
				</div>
			<?php endif;?>

		<?php endif; ?>

		<div class="image-inner">
			<?php if( isset( $image['id'] ) && !empty( $image['id'] ) ): ?>
		<?php
			$image_alt = get_post_meta($image['id'], '_wp_attachment_image_alt', TRUE);
		?>
			<img src="<?php $image = wp_get_attachment_image_src( $image['id'], 'full'); echo esc_url( $image[0] );?>" alt="<?php echo esc_html( $image_alt ) ?>">
			<?php endif; ?>
		</div>

		<?php if ( ! empty( $image_rotate_text ) ) : ?>

			<?php if ($text_position === 'bottom-right' || $text_position === 'top-right' ) : ?>
				<div class="text-holder" style="<?php echo esc_attr( $text_inline_css ); ?>">
					<div class="text-inner">
						<div class="text <?php echo esc_attr( $text_class ); ?>"><?php echo esc_html($image_rotate_text); ?></div>
					</div>
				</div>
			<?php endif;?>

		<?php endif; ?>
	</div>
</div>
