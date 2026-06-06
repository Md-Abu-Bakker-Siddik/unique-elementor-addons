<?php $random_number = wp_rand( 111111, 999999 ); ?>
<div id="twentytwenty-slider-<?php echo esc_attr( $random_number );?>" class="twentytwenty-container tm-sc-before-after-slider <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>" data-orientation="<?php echo esc_attr( $orientation ); ?>" data-offset-percent="<?php echo esc_attr( $default_offset_pct ); ?>" data-no-overlay="<?php echo esc_attr( $no_overlay ); ?>" data-before-label="<?php echo esc_attr( $before_label ); ?>" data-after-label="<?php echo esc_attr( $after_label ); ?>">
  <?php if( isset( $slider_items['before_image'] ) && !empty( $slider_items['before_image'] ) ): ?>
  <img src="<?php $image = wp_get_attachment_image_src( $slider_items['before_image']['id'], 'full'); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'unique-elementor-addons'); ?>">
  <?php endif; ?>

  <?php if( isset( $slider_items['after_image'] ) && !empty( $slider_items['after_image'] ) ): ?>
  <img src="<?php $image = wp_get_attachment_image_src( $slider_items['after_image']['id'], 'full'); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'unique-elementor-addons'); ?>">
  <?php endif; ?>
</div>
