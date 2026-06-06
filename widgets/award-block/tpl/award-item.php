<!-- Training Block Style2-->
<div class="award-block-current-item-style2">
  <div class="inner-box">
    <div class="date-box">
      <span class="count"><?php echo esc_html( $award_item['count'] );?></span>
      <span class="year"><?php echo esc_html( $award_item['year'] );?></span>
    </div>
    <div class="content-box">
      <?php unique_addons_get_shortcode_template_part( 'title', null, 'award-block/tpl', $award_item, false );?>
      <?php unique_addons_get_shortcode_template_part( 'content', null, 'award-block/tpl', $award_item, false );?>
    </div>
    <div class="info-box">
      <?php unique_addons_get_shortcode_template_part( 'sub-title', null, 'award-block/tpl', $award_item, false );?>
      <span class="company">Graphicriver</span>
    </div>
  </div>
</div>