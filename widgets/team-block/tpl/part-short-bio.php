<?php if ( $settings['show_short_bio'] == 'yes' ) : ?>
	<div class="team-short-bio"><?php echo wp_kses_post( $short_bio ); ?></div>
<?php endif; ?>