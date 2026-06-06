<nav id="top-primary-nav-elementor-<?php echo esc_attr( $holder_id ); ?>" class="menuzord-primary-nav menuzord menuzord-responsive">
<?php
	$menu_class = 'menuzord-menu';
	$walker     = class_exists( 'Unique_Addons_Nav_Walker' ) ? new Unique_Addons_Nav_Walker() : '';

	if ( ! empty( $custom_primary_nav_menu ) ) {
		wp_nav_menu(
			array(
				'menu'        => $custom_primary_nav_menu,
				'menu_class'  => $menu_class,
				'menu_id'     => 'main-nav-' . esc_attr( $holder_id ),
				'container'   => '',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'walker'      => $walker,
			)
		);
	} elseif ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'menu_class'     => $menu_class,
				'menu_id'        => 'main-nav-' . esc_attr( $holder_id ),
				'container'      => '',
				'link_before'    => '<span>',
				'link_after'     => '</span>',
				'walker'         => $walker,
			)
		);
	}
?>
</nav>