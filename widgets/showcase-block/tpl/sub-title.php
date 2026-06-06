	<?php if( !empty( $subtitle ) ) : ?>
	<?php
		$url = ( $btn1_link && $btn1_link['url'] ) ? $btn1_link['url'] : '';
	?>
	<<?php echo esc_attr( $subtitle_tag );?> class="showcase-subtitle">
		<?php if( !empty( $url ) ): ?>
		<a
			<?php unique_addons_print_link_target_attrs( $btn1_link ); ?>
			href="<?php echo esc_url( $url );?>">
			<?php echo esc_html( $subtitle ); ?>
		</a>
		<?php else: ?>
			<?php echo esc_html( $subtitle ); ?>
		<?php endif ?>
	</<?php echo esc_attr( $subtitle_tag );?>>
	<?php endif; ?>

