<?php $settings['settings'] = $settings; ?>
<?php
	wp_enqueue_style( 'swiper' );
	wp_enqueue_script( 'swiper' );
	//Swiper Slider Data
	$swiper_slide_data_info = unique_addons_swiper_data_params( $settings );
?>
<?php if ( $showcase_items_array ) : ?>
	<div id="<?php echo esc_attr( $holder_id ) ?>" class="tm-showcase-carousel tm-swiper-container" <?php echo html_entity_decode( esc_attr( implode(' ', $swiper_slide_data_info) ) ) ?>>
		<div class="swiper-container-inner">
			<div class="swiper-wrapper">
				<!-- the loop -->
				<?php foreach (  $showcase_items_array as $showcase_item ) { ?>
					<?php $settings['showcase_item'] = $showcase_item; ?>
					<div class="swiper-slide">
						<?php unique_addons_get_shortcode_template_part( 'showcase-item', $_skin, 'showcase-block/tpl', $settings, false ); ?>
					</div>
				<?php } ?>
				<!-- end of the loop -->
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