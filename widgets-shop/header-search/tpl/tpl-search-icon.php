<?php
    if($search_type == "product") {
        add_action('wp_footer', 'unique_addons_header_search_product_popup', 1);
    } else {
        add_action('wp_footer', 'unique_addons_header_search_popup', 1);
    }
?>
<div class="tm-widget-search-form">
    <a aria-label="Search" href="#" class="icon-search-popup"><i class="lnr lnr-icon-search"></i></a>
</div>