<li>
	<<?php echo esc_attr( $title_tag );?>
		<?php if ( 'a' === $title_tag ) : ?>
		href="<?php echo esc_url( $link_url['url'] ); ?>"
		<?php unique_addons_print_link_target_attrs( $link_url ); ?>
		<?php endif; ?>
		>
		<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
		<?php if(!empty($prefix)) {?><span class="prefix"><?php echo esc_html( $prefix );?></span><?php } ?><?php echo esc_html( $title );?></<?php echo esc_attr( $title_tag );?>>
</li>