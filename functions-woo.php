<?php

if (!function_exists('unique_addons_woocommerce_get_product_label_stock')) {
    function unique_addons_woocommerce_get_product_label_stock() {
        /**
         * @var $product WC_Product
         */
        global $product;
        if ($product->get_stock_status() == 'outofstock') {
            echo '<span class="stock-label">' . esc_html__('Out Of Stock', 'unique-elementor-addons') . '</span>';
        }
    }
}
if (!function_exists('unique_addons_quickview_button')) {
    function unique_addons_quickview_button() {
        if (function_exists('woosq_init')) {
            echo do_shortcode('[woosq]');
        }
    }
}

if (!function_exists('unique_addons_compare_button')) {
    function unique_addons_compare_button() {
        if (function_exists('woosc_init')) {
            echo do_shortcode('[woosc]');
        }
    }
}

if (!function_exists('unique_addons_wishlist_button')) {
    function unique_addons_wishlist_button() {
        if (function_exists('woosw_init')) {
            echo do_shortcode('[woosw]');
        }
    }
}

if (!function_exists('unique_addons_header_search_product_popup')) {
    function unique_addons_header_search_product_popup() {
        ?>
        <div class="site-search-popup">
            <div class="site-search-popup-wrap">
                <a href="#" class="site-search-popup-close"></a>
                <?php
                if (class_exists( 'WooCommerce' )) {
                    unique_addons_product_search("product");
                } else {
                    unique_addons_product_search();
                }
                ?>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('unique_addons_header_search_popup')) {
    function unique_addons_header_search_popup() {
        ?>
        <div class="site-search-popup">
            <div class="site-search-popup-wrap">
                <a href="#" class="site-search-popup-close"></a>
                <?php
                unique_addons_product_search();
                ?>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('unique_addons_product_search')) {
    /**
     * Display Product Search
     *
     * @return void
     * @uses  unique_addons_is_woocommerce_activated() check if WooCommerce is activated
     * @since  1.0.0
     */
    function unique_addons_product_search($woo = "default") {
        if (class_exists( 'WooCommerce' )) {
            static $index = 0;
            $index++;
            ?>
            <div class="tm-widget-search-form">
                <form role="search" method="get" class="search-form-default" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" id="woocommerce-product-search-field-<?php echo isset($index) ? absint($index) : 0; ?>" class="form-control search-field" placeholder="<?php echo esc_attr__('Search products&hellip;', 'unique-elementor-addons'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                    <button type="submit" class="search-submit"><i class="lnr lnr-icon-search"></i></button>
                    <?php if($woo == "product") {?>
                    <input type="hidden" name="post_type" value="product">
                    <?php } ?>
                </form>
            </div>
            <?php
        }
    }
}

if ( ! function_exists( 'unique_addons_woocommerce_get_product_short_description' ) ) {
	/**
	 * Output trimmed product short description for shop widgets.
	 *
	 * @param int $word_length Optional word limit.
	 * @return void
	 */
	function unique_addons_woocommerce_get_product_short_description( $word_length = 0 ) {
		global $product;

		if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
			return;
		}

		$description = $product->get_short_description();
		if ( empty( $description ) ) {
			return;
		}

		$word_length = absint( $word_length );
		if ( $word_length > 0 ) {
			$description = wp_trim_words( wp_strip_all_tags( $description ), $word_length, '&hellip;' );
		}

		echo '<div class="product-short-description">' . wp_kses_post( $description ) . '</div>';
	}
}

if ( ! function_exists( 'unique_addons_woocommerce_time_sale_layout_2' ) ) {
	/**
	 * Output a simple on-sale countdown placeholder for product cards.
	 *
	 * @return void
	 */
	function unique_addons_woocommerce_time_sale_layout_2() {
		global $product;

		if ( ! $product || ! is_a( $product, 'WC_Product' ) || ! $product->is_on_sale() ) {
			return;
		}

		$date_to = $product->get_date_on_sale_to();
		if ( ! $date_to ) {
			return;
		}

		echo '<div class="unique-addons-countdown tm-onsale-countdown" data-end="' . esc_attr( $date_to->date( 'Y-m-d H:i:s' ) ) . '"></div>';
	}
}

if ( ! function_exists( 'unique_addons_floating_cart_sidebar' ) ) {
	/**
	 * Output a side-panel wrapper for the floating cart experience.
	 *
	 * @return void
	 */
	function unique_addons_floating_cart_sidebar() {
		if ( ! class_exists( 'WooCommerce' ) || ! function_exists( 'woocommerce_mini_cart' ) ) {
			return;
		}
		?>
		<div id="unique-addons-floating-cart-sidebar" class="unique-addons-floating-cart-sidebar">
			<div class="unique-addons-floating-cart-sidebar-inner">
				<?php woocommerce_mini_cart(); ?>
			</div>
		</div>
		<?php
	}
}