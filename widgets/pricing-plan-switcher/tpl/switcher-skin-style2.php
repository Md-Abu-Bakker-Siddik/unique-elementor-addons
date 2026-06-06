<div class="tm-pricing-plan-switcher-button">
  <ul class="switch-buttons">
    <li class="active">
      <a href="javascript:" aria-label="Pricing" class="btn-toggle active" data-pricing-trigger data-show="month"><span class="title"><?php echo esc_html($variant_text_default); ?></span></a>
    </li>
    <li class="">
      <a href="javascript:" aria-label="Pricing" class="btn-toggle" data-pricing-trigger data-show="year"> <span class="title"><?php echo esc_html($variant_text_secondary); ?></span>
      <?php if(!empty($variant_text_offer)) { ?><span class="price-offer"><?php echo esc_html($variant_text_offer); ?></span><?php } ?>
      </a>
    </li>
  </ul>
</div>