<div class="tm-pricing-plan-switcher">
  <span class="title-normal"><?php echo esc_html($variant_text_default); ?></span>
  <div class="price-switcher">
    <div class="pricing-switcher-btn">
      <a href="javascript:" aria-label="Pricing" class="btn-toggle" data-pricing-trigger><span class="round"></span></a>
    </div>
  </div>
  <span class="title-secondary"><?php echo esc_html($variant_text_secondary); ?></span>
  <?php if(!empty($variant_text_offer)) { ?><span class="price-offer"><?php echo esc_html($variant_text_offer); ?></span><?php } ?>
</div>