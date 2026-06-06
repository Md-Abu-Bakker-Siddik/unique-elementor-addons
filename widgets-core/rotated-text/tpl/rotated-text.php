<div class="tm-sc-rotated-text <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<div class="text-wrapper">
		<?php if ( ! empty( $image_rotate_text ) ) : ?>

			<div class="text-holder" style="<?php echo esc_attr( $text_inline_css ); ?>">
				<div class="text-inner">
					<div class="text <?php echo esc_attr( $text_class ); ?>"><?php echo esc_html($image_rotate_text); ?></div>
				</div>
			</div>

		<?php endif; ?>
	</div>
</div>
