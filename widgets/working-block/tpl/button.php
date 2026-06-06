<div class="btn-view-details <?php if( isset($settings['button_alignment']) & !empty($settings['button_alignment']) ) echo esc_attr( $settings['button_alignment'] );?>">
    <a
      <?php unique_addons_print_link_target_attrs( $working_block_link ); ?>
      href="<?php echo esc_url( $working_block_link['url'] );?>"
      class="<?php echo esc_attr(implode(' ', $settings['btn_classes'])); ?>">
      <?php echo esc_html( $settings['view_details_button_text']  ); ?>
    </a>
</div>