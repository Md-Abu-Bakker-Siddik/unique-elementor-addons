
		<?php if( !empty( $subtitle ) ) : ?>
		<<?php echo esc_attr( $subtitle_tag );?> class="skill-subtitle">
			<?php if( !empty( $url ) ): ?>
			<a
				<?php unique_addons_print_link_target_attrs( $skill_block_link ); ?>
				href="<?php echo esc_url( $url );?>">
				<?php echo esc_html( $subtitle );?>
			</a>
			<?php else: ?>
				<?php echo esc_html( $subtitle );?>
			<?php endif ?>
		</<?php echo esc_attr( $subtitle_tag );?>>
		<?php endif; ?>