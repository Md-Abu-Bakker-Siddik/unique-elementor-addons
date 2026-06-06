<?php
$award_item['settings'] = $settings;
$title = $award_item['title'];
$first_letter_title = substr($title, 0, 1);
?>
<!-- Award Block Style2-->
<div class="award-block-current-item-style2 rr-hover-reveal-item2">
  <div class="content">
    <?php unique_addons_get_shortcode_template_part( 'title', null, 'award-block/tpl', $award_item, false );?>
    <div class="bottom">
      <span class="year"><?php echo esc_html( $award_item['year'] );?></span>
      <div class=" award-brand-image">
        <?php unique_addons_get_shortcode_template_part( 'part-company-image', null, 'award-block/tpl', $award_item, false );?>
      </div>
    </div>
  </div>
  <div class="award-image">
    <?php unique_addons_get_shortcode_template_part( 'part-featured-image', null, 'award-block/tpl', $award_item, false );?>
  </div>
</div>