<?php if ( $settings['show_paragraph'] == 'yes' ) { ?>
<div class="working-details"><?php echo wp_kses_post( $content ); ?></div>
<?php } ?>