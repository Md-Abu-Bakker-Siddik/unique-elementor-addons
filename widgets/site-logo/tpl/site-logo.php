
<a class="menuzord-brand site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
	<?php if( !$use_logo ): ?>
	<?php echo esc_html( $site_brand ); ?>
	<?php else: ?>
		<?php if( !$use_switchable_logo ): ?>
		<img class="logo-default logo-1x" src="<?php echo esc_url( $logo_default ); ?>" alt="<?php esc_attr_e( 'Logo', 'unique-elementor-addons' ); ?>">
		<?php else: ?>
		<img class="logo-light logo-1x" src="<?php echo esc_url( $logo_light ); ?>" alt="<?php esc_attr_e( 'Logo', 'unique-elementor-addons' ); ?>">
		<img class="logo-dark logo-1x" src="<?php echo esc_url( $logo_dark ); ?>" alt="<?php esc_attr_e( 'Logo', 'unique-elementor-addons' ); ?>">
		<?php endif; ?>
	<?php endif; ?>
</a>