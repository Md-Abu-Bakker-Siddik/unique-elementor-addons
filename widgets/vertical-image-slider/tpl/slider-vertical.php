<?php
	// Build swiper data attributes
	$slider_direction = isset($slider_direction) ? $slider_direction : 'vertical';
	$swiper_data = array();
	$swiper_data[] = 'data-direction="' . esc_attr($slider_direction) . '"';
	$swiper_data[] = 'data-speed="' . esc_attr(isset($speed) ? $speed : 3000) . '"';

	// Responsive slides per view
	$slides_per_view = isset($slides_per_view) ? $slides_per_view : '2.5';
	$slides_per_view_tablet = isset($slides_per_view_tablet) ? $slides_per_view_tablet : '';
	$slides_per_view_mobile = isset($slides_per_view_mobile) ? $slides_per_view_mobile : '';
	$swiper_data[] = 'data-slides-per-view="' . esc_attr($slides_per_view) . '"';
	if (!empty($slides_per_view_tablet)) {
		$swiper_data[] = 'data-slides-per-view-tablet="' . esc_attr($slides_per_view_tablet) . '"';
	}
	if (!empty($slides_per_view_mobile)) {
		$swiper_data[] = 'data-slides-per-view-mobile="' . esc_attr($slides_per_view_mobile) . '"';
	}

	$swiper_data[] = 'data-space-between="' . esc_attr(isset($space_between) ? $space_between : 20) . '"';
	$swiper_data[] = 'data-loop="' . ((isset($loop) && $loop === 'yes') ? 'true' : 'false') . '"';
	$swiper_data[] = 'data-mousewheel="' . ((isset($mousewheel) && $mousewheel === 'yes') ? 'true' : 'false') . '"';
	$swiper_data[] = 'data-allow-drag="' . ((isset($allow_drag) && $allow_drag === 'yes') ? 'true' : 'false') . '"';
	$swiper_data[] = 'data-free-mode="' . ((isset($free_mode) && $free_mode === 'yes') ? 'true' : 'false') . '"';
	$swiper_data[] = 'data-reverse-direction="' . ((isset($reverse_direction) && $reverse_direction === 'yes') ? 'true' : 'false') . '"';

	if (isset($autoplay) && $autoplay === 'yes') {
		$swiper_data[] = 'data-autoplay="true"';
		$swiper_data[] = 'data-autoplay-delay="' . esc_attr(isset($autoplay_delay) ? $autoplay_delay : 0) . '"';
	} else {
		$swiper_data[] = 'data-autoplay="false"';
	}

	$image_hover_effect = isset($image_hover_effect) ? $image_hover_effect : 'zoom';
?>
<?php if ( isset($slider_images_array) && $slider_images_array ) : ?>
	<div id="<?php echo esc_attr( isset($holder_id) ? $holder_id : 'tm-vertical-slider' ) ?>" class="tm-sc-vertical-image-slider tm-vertical-image-slider slider-direction-<?php echo esc_attr($slider_direction); ?> hover-effect-<?php echo esc_attr($image_hover_effect); ?>" <?php echo implode(' ', $swiper_data) ?>>
		<div class="tm-vertical-image-slider-wrapper">
			<?php if ( isset($gradient_overlays_array) && !empty($gradient_overlays_array) ) : ?>
				<div class="tm-gradient-overlays">
					<?php foreach ( $gradient_overlays_array as $index => $gradient_overlay ) : ?>
						<?php
							$side = isset($gradient_overlay['gradient_side']) ? $gradient_overlay['gradient_side'] : 'left';
							$color = isset($gradient_overlay['gradient_color']) ? $gradient_overlay['gradient_color'] : '#000000';
							$opacity = isset($gradient_overlay['gradient_opacity']['size']) ? $gradient_overlay['gradient_opacity']['size'] : 0.8;
							$size = isset($gradient_overlay['gradient_size']['size']) ? $gradient_overlay['gradient_size']['size'] : 30;
							$size_unit = isset($gradient_overlay['gradient_size']['unit']) ? $gradient_overlay['gradient_size']['unit'] : '%';
							$blur = isset($gradient_overlay['gradient_blur']['size']) ? $gradient_overlay['gradient_blur']['size'] : 0;
							$zindex = isset($gradient_overlay['gradient_zindex']) ? $gradient_overlay['gradient_zindex'] : 100;

							// Convert hex to rgba
							$rgb = sscanf($color, "#%02x%02x%02x");
							$rgba_start = sprintf("rgba(%d, %d, %d, %s)", $rgb[0], $rgb[1], $rgb[2], $opacity);
							$rgba_end = sprintf("rgba(%d, %d, %d, 0)", $rgb[0], $rgb[1], $rgb[2]);

							// Build gradient based on side
							$gradient_direction = '';
							switch($side) {
								case 'left':
									$gradient_direction = "to right, {$rgba_start} 0%, {$rgba_end} 100%";
									break;
								case 'right':
									$gradient_direction = "to left, {$rgba_start} 0%, {$rgba_end} 100%";
									break;
								case 'top':
									$gradient_direction = "to bottom, {$rgba_start} 0%, {$rgba_end} 100%";
									break;
								case 'bottom':
									$gradient_direction = "to top, {$rgba_start} 0%, {$rgba_end} 100%";
									break;
							}

							$gradient_style = "background: linear-gradient({$gradient_direction}); --gradient-size: {$size}{$size_unit}; z-index: {$zindex};";
							if ($blur > 0) {
								$gradient_style .= " backdrop-filter: blur({$blur}px); -webkit-backdrop-filter: blur({$blur}px);";
							}
						?>
						<div class="tm-gradient-overlay tm-gradient-overlay-<?php echo esc_attr($side); ?> elementor-repeater-item-<?php echo esc_attr($gradient_overlay['_id']); ?>"
							 style="<?php echo esc_attr($gradient_style); ?>"></div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<div class="swiper">
				<div class="swiper-wrapper">
					<!-- the loop -->
					<?php foreach (  $slider_images_array as $slider_item ) { ?>
						<?php
							$item_params = array(
								'slider_item' => $slider_item,
								'featured_image_size' => isset($featured_image_size) ? $featured_image_size : 'medium_large',
								'show_title' => isset($show_title) ? $show_title : 'no'
							);
						?>
						<div class="swiper-slide elementor-repeater-item-<?php echo esc_attr($slider_item['_id']); ?>">
							<?php unique_addons_get_shortcode_template_part( 'slider-item', null, 'vertical-image-slider/tpl', $item_params, false ); ?>
						</div>
					<?php } ?>
					<!-- end of the loop -->
				</div>
			</div>
		</div>
	</div>
<?php else : ?>
	<?php unique_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>


