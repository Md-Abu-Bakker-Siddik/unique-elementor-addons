<?php if ( $settings['show_paragraph'] == 'yes' ) { ?>
<?php echo wp_kses_post( $content ); ?>
<?php } ?>