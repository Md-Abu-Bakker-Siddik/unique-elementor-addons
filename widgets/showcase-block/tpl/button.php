<?php
  //link url
    $url1 = ( $btn1_link && $btn1_link['url'] ) ? $btn1_link['url'] : '';


    $url2 = ( $btn2_link && $btn2_link['url'] ) ? $btn2_link['url'] : '';
?>

<div class="showcase-buttons">
  <?php if( !empty( $url1 ) ): ?>
  <div class="showcase-button"><a class="btn btn-theme-colored1" <?php unique_addons_print_link_target_attrs( $btn1_link ); ?> href="<?php echo esc_url( $url1 );?>"><?php echo esc_html($btn1_text); ?></a></div>
  <?php endif ?>
  <?php if( !empty( $url2 ) ): ?>
  <div class="showcase-button"> <a class="btn btn-theme-colored2" <?php unique_addons_print_link_target_attrs( $btn2_link ); ?> href="<?php echo esc_url( $url2 );?>"><?php echo esc_html($btn2_text); ?></a></div>
  <?php endif ?>
</div>