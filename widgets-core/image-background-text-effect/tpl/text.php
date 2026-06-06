<div class="tm-image-background-text-effect">
      <?php if( !empty( $text ) ) : ?>
      <<?php echo esc_attr( $text_tag );?> class="text">
          <?php echo esc_html( $text );?>
      </<?php echo esc_attr( $text_tag );?>>
      <?php endif; ?>
      <?php if( !empty( $subtitle ) ) : ?>
      <<?php echo esc_attr( $subtitle_tag );?> class="subtitle">
          <?php echo esc_html( $subtitle );?>
      </<?php echo esc_attr( $subtitle_tag );?>>
      <?php endif; ?>
</div>