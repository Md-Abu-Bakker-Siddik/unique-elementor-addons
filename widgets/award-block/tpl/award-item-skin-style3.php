<!-- award Block Style1 -->
<div class="award-block-current-item-style3">
  <div class="inner-box">
    <div class="content-box">
      <div class="title-box">
        <span class="count"><?php echo esc_html( $award_item['count'] );?></span>
        <?php unique_addons_get_shortcode_template_part( 'title', null, 'award-block/tpl', $award_item, false );?>
      </div>
      <span class="year"><?php echo esc_html( $award_item['year'] );?></span>
      <div class="icon"><i class="lnr-icon-plus"></i></div>
    </div>
  </div>
</div>