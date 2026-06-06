<?php $settings['settings'] = $settings; ?>
<?php
	wp_enqueue_style( 'swiper' );
	wp_enqueue_script( 'swiper' );
	//Swiper Slider Data
	$swiper_slide_data_info = unique_addons_swiper_data_params( $settings );
?>
<?php if ( $the_query->have_posts() ) : ?>
	<div id="<?php echo esc_attr( $holder_id ) ?>" class="tm-sc-wc-products tm-sc-wc-products-carousel woocommerce tm-swiper-container" <?php echo html_entity_decode( esc_attr( implode(' ', $swiper_slide_data_info) ) ) ?>>
		<div class="swiper-container-inner carousel-layout products">
			<div class="swiper-wrapper">
				<!-- the loop -->
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="swiper-slide">
						<?php unique_addons_get_shortcode_shop_template_part( 'each-item', $_skin, 'wc-products/tpl', $settings, false ); ?>
					</div>
				<?php endwhile; ?>
				<!-- end of the loop -->
				<?php wp_reset_postdata(); ?>
			</div>
		</div>

		<div class="swiper-pagination <?php if( $bullets !== 'yes' ) echo esc_attr( "d-none" ); ?>"></div>

		<div class="tm-swiper-arrow tm-swiper-button-wrap <?php if( $arrow !== 'yes' ) echo esc_attr( "d-none" ); ?>">
			<div class="tm-swiper-arrow tm-swiper-button-prev"><i class="lnr-icon-arrow-left"></i></div>
			<div class="tm-swiper-arrow tm-swiper-button-next"><i class="lnr-icon-arrow-right"></i></div>
		</div>
	</div>

<?php else : ?>
	<?php unique_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>