
		<?php if( !empty( $title ) ) : ?>
		<<?php echo esc_attr( $title_tag );?> class="title">
			<?php if( $link_title == 'yes' && !empty( $url ) ): ?>
			<a 
				<?php <?php unique_addons_print_link_target_attrs( $link ); ?>
				href="<?php echo esc_url( $url );?>">
				<?php echo wp_kses_post( $title ); ?>
			</a>
			<?php else: ?>
				<?php echo wp_kses_post( $title ); ?>
			<?php endif ?>
		</<?php echo esc_attr( $title_tag );?>>
		<?php endif; ?>