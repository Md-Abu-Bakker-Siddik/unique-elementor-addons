<?php if ( $show_excerpt == 'yes' ) : ?>
  <?php if ( empty($excerpt_length) ) { ?>
    <div class="excerpt">
      <?php echo esc_html( strip_shortcodes( get_the_excerpt() ) )?>
    </div>
  <?php } else { ?>
    <div class="excerpt">
      <?php $excerpt = get_the_excerpt(); echo esc_html( unique_addons_slice_excerpt_by_length( $excerpt, $excerpt_length ) ); ?>
    </div>
  <?php } ?>
<?php endif; ?>