<?php $settings['settings'] = $settings; ?>
<?php
	wp_enqueue_style( 'swiper' );
	wp_enqueue_script( 'swiper' );
	//Swiper Slider Data
	$swiper_slide_data_info = unique_addons_swiper_data_params( $settings );
?>
<?php if ( $skill_block_items_array ) : ?>
	<div id="<?php echo esc_attr( $holder_id ) ?>" class="tm-sc-skill tm-skill-carousel tm-swiper-container" <?php echo html_entity_decode( esc_attr( implode(' ', $swiper_slide_data_info) ) ) ?>>
		<div class="swiper-container-inner">
			<div class="swiper-wrapper">
				<!-- the loop -->
				<?php foreach (  $skill_block_items_array as $skill_item ) { ?>
					<?php $settings['skill_item'] = $skill_item; ?>
					<?php
						$animation = "";
						$animation_delay = "";
						if(isset($skill_item['wow_appear_animation']) && !empty($skill_item['wow_appear_animation'])) {
							$animation = $skill_item['wow_appear_animation'];
						}
						if(isset($skill_item['wow_animation_delay']) && !empty($skill_item['wow_animation_delay'])) {
							$animation_delay = $skill_item['wow_animation_delay'] . 'ms';
						}
					?>
					<div class="swiper-slide elementor-repeater-item-<?php echo esc_attr( $skill_item['_id'] ); ?> <?php echo esc_attr($animation);?>" data-wow-delay="<?php echo esc_attr($animation_delay);?>">
						<?php unique_addons_get_shortcode_template_part( 'skill-block-item', $_skin, 'skill-block/tpl', $settings, false ); ?>
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