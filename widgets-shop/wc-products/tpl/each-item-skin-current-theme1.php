<?php
// Extra classes
$extra_classes = array();
$extra_classes[] = 'tm-woo-product-item';
global $product;
wp_enqueue_script('tm-countdown-script');
?>
<div class="tm-woo-product-style1">
    <div class="product-inner">
        <div class="image-box">
            <div class="image">
                <a href="<?php echo esc_url($product->get_permalink()); ?>">
                    <?php echo wp_kses_post( $product->get_image($image_size) ); ?>
                </a>
            </div>
            <div class="product-button-holder">
                <?php if ( unique_addons_plugin_installed() ) { ?>
                    <?php if (class_exists('WPCleverWoosc')) { ?>
                        <div class="product-meta woocommerce-compare">
                            <?php unique_addons_compare_button(); ?>
                        </div>
                    <?php } ?>
                    <?php if (class_exists('WPCleverWoosw')) { ?>
                        <div class="product-meta woocommerce-wishlist">
                            <?php unique_addons_wishlist_button(); ?>
                        </div>
                    <?php } ?>
                    <?php if (class_exists('WPCleverWoosq')) { ?>
                        <div class="product-meta woocommerce-quick-view">
                            <?php unique_addons_quickview_button(); ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="content-box">
            <?php woocommerce_template_loop_rating(); ?>
            <?php
            if ( ! is_a( $product, 'WC_Product' ) ) {
                $product = wc_get_product( get_the_id() );
            }
            echo '<h4 class="product-title"><a href="'.get_the_permalink().'" class="yourclassname">'.$product->get_name().'</a></h4>';
            ?>
            <?php unique_addons_woocommerce_get_product_short_description( $skin_current_theme1_excerpt_length ); ?>
            <?php woocommerce_template_loop_price(); ?>
            <?php
            echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s single_add_to_cart_button btn btn-theme-colored1 btn-xs btn-round %s">%s</a>',
                     esc_url( $product->add_to_cart_url() ),
                     esc_attr( $product->get_id() ),
                     esc_attr( $product->get_sku() ),
                     esc_attr( isset( $quantity ) ? $quantity : 1 ),
                     $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                     esc_attr( $product->get_type() ),
                     $product->get_type() == 'simple' ? 'ajax_add_to_cart' : '',
                     esc_html( $product->add_to_cart_text() )
                 ),
             $product );
            ?>
            <?php unique_addons_woocommerce_time_sale_layout_2(); ?>
        </div>
    </div>
</div>
