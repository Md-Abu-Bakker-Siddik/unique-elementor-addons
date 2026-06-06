
		<?php if ( $show_subtitle == 'yes' &&  !empty( $subtitle ) ) : ?>
		<<?php echo esc_attr( $subtitle_tag );?> class="subtitle">
			<?php if( $link_subtitle == 'yes' && !empty( $url ) ): ?>
			<a 
				<?php <?php unique_addons_print_link_target_attrs( $link ); ?>
				href="<?php echo esc_url( $url );?>">
				<?php echo esc_html( $subtitle );?>
				<?php include('subtitle-parts.php');?>
			</a>
			<?php else: ?>
				<?php echo esc_html( $subtitle );?>
				<?php include('subtitle-parts.php');?>
			<?php endif ?>
		</<?php echo esc_attr( $subtitle_tag );?>>
		<?php endif; ?>