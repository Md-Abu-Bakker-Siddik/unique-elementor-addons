<!-- award Block Style1 -->
<div class="award-block-current-item-style1 spin-border-animation">
  <div class="inner-block">
    <div class="head">
      <div class="count"><?php echo esc_html( $award_item['count'] );?></div>
      <div class="image">
        <?php unique_addons_get_shortcode_template_part( 'part-featured-image', null, 'award-block/tpl', $award_item, false );?>
      </div>
    </div>
    <?php unique_addons_get_shortcode_template_part( 'title', null, 'award-block/tpl', $award_item, false );?>
    <div class="bottom">
      <div class="line"></div>
      <span class="year"><?php echo esc_html( $award_item['year'] );?></span>
    </div>
  </div>
</div>