<?php $working_item['settings'] = $settings; ?>
  <div class="working-block-style2">
    <div class="inner-block">
      <div class="counter">
        <span><?php unique_addons_get_shortcode_template_part( 'part-count', null, 'working-block/tpl', $working_item, false );?></span>
      </div>
      <div class="content-box">
        <?php unique_addons_get_shortcode_template_part( 'part-subtitle', null, 'working-block/tpl', $working_item, false );?>
        <?php unique_addons_get_shortcode_template_part( 'part-title', null, 'working-block/tpl', $working_item, false );?>
        <?php unique_addons_get_shortcode_template_part( 'part-content', null, 'working-block/tpl', $working_item, false );?>
      </div>

    </div>
  </div>